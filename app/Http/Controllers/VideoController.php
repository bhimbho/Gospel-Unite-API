<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\VideoRequests;
use App\Jobs\VideoUploadProcess;
use App\Jobs\VideoUploadUpdateProcess;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Tag;
use App\Models\VideoUploadTemp;
use App\Traits\ImageResize;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    use ImageResize;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $data = Video::orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm"  data-toggle="modal" data-target=".bd-example-modal-md">Edit</a>
                        <a data-id="'.$data->id.'" id="modal" class="edit_video btn btn-success btn-sm text-white" data-toggle="modal" data-target=".modal2">Replace Video File</a>
                        <button type="button" id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action']) // returning action column
                    ->make(true);
        }


        return view('administrator.videos.index')
        ->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequests $request)
    {
        $file = $request->file('cover'); // Get file input
        $resized_img = $this->image_resize($file); // Create Intervention instance
        $name = time() . '_' . md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension(); //  file name
        $payload = (string)$resized_img->encode();
        $path = 'video_cover/'.$name;
        $cover = Storage::disk('s3')->put($path, $resized_img, 'public');

        // $temp_video = VideoUploadTemp::create([
        //     'video_name' => $request->video
        // ]);

        $toArrayRequest = $request->toArray();
        unset($toArrayRequest['cover']);

        VideoUploadProcess::dispatch($toArrayRequest, $path);
        return response()->json('Video Processing Initiated', 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        $tags = Tag::all();
        $video_tags = $video->tags;
        return response()->json([$video,$tags, $video_tags],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $tags = Tag::all();
        $video_tags = $video->tags;
        return response()->json([$video,$tags, $video_tags],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'nullable',
            'artist' => 'required',
        ]);
        $video = Video::findOrFail($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->artist = $request->artist;
        $video->update();
        $video->tags()->sync($request->tags);
        return response()->json('Update Successful', 200);
    }

    /**
     * Update the song file resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function video_file_update(Request $request, $id)
    {
        $this->validate($request, [
            'video'=>'required'
        ]);

        VideoUploadUpdateProcess::dispatch($request->toArray(), $id);
        return response()->json('Video Replacement Processing', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        Storage::disk('s3')->delete($video->cover);
        Storage::disk('s3')->delete($video->file);
        $video->delete();
        $video->tags()->detach();
        return response()->json('Video Delete Successfully', 200);
    }
}
