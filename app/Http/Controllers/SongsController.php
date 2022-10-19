<?php

namespace App\Http\Controllers;

use App\Http\Requests\Songs\CreateSongRequest;
use App\Jobs\SongUploadProcess;
use App\Jobs\SongUploadUpdateProcess;
use App\Models\Album;
use App\Models\Sermon;
use App\Models\Song;
use App\Models\Tag;
use App\Traits\ImageResize;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongsController extends Controller
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
            $data = Song::orderBy('id','DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit Info</a>
                        <a data-id="'.$data->id.'" id="modal" class="edit_song btn btn-success btn-sm text-white" data-toggle="modal" data-target=".modal2">Replace Song File</a>
                        <button id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    // ->editColumn('sermon', function($data){
                    //     $actionBtn = ($data->sermon != NULL)? $data->sermon->title : 'N/A';
                    //     return $actionBtn;
                    // })
                    ->editColumn('song_cover', function($data){
                        $url = $data->cover_image;
                        $img = Storage::disk('s3')->url($url);
                        $actionBtn =  '<img src='.$img.' border="0" width="40" class="img-rounded" align="center" />';
                        return $actionBtn;
                    })
                    ->rawColumns(['action','song_cover']) // returning action column
                    ->make(true);
        }
        return view('administrator.songs.index')
        ->with('tags', Tag::all());
        // ->with('sermons', Sermon::all());
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
    public function store(CreateSongRequest $request)
    {
        $file = $request->file('cover'); // Get file input
        $resized_img = $this->image_resize($file); // Create Intervention instance
        $name = time() . '_' . md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension(); //  file name
        $payload = (string)$resized_img->encode();
        $path = 'songs_cover/'.$name;
        Storage::disk('s3')->put($path, $resized_img, 'public');
        $toArrayRequest = $request->toArray();
        unset($toArrayRequest['cover']);

        SongUploadProcess::dispatch($toArrayRequest, $path);
        return response()->json('Song Processing Initiated', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = Song::find($id);
        $tags = Tag::all();
        $song_tags = $song->tags;
        return response()->json([$song,$tags, $song_tags],200);
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
            'release_date' => 'required',
            'artist_name' => 'required',
        ]);
        $song = Song::findOrFail($id);
        $song->title = $request->title;
        $song->description = $request->description;
        $song->artist = $request->artist_name;
        $song->released_Date = $request->release_date;
        $song->save();
        $song->tags()->sync($request->tags);
        return response()->json('Update Successful', 200);
    }

    
    /**
     * Update the song file resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function song_file_update(Request $request, $id)
    {
        $this->validate($request, [
            'song'=>'required|string'
        ]);

        SongUploadUpdateProcess::dispatch($request->toArray(), $id);
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
        $song = Song::find($id);
        Storage::disk('s3')->delete($song->file);
        Storage::disk('s3')->delete($song->cover_image);
        $song->delete();
        $song->tags()->detach();
        return response()->json('Song Deleted', 200);
    }
}
