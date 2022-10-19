<?php

namespace App\Http\Controllers;

use App\Http\Requests\Songs\CreateAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Album::orderBy('id','desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit</a>
                        <a data-id="'.$data->id.'" id="modal" class="edit_cover btn btn-success btn-sm" data-toggle="modal" data-target=".modal2">Replace Cover</a>
                        <button type="button" id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->addColumn('songs', function($data){
                        $actionBtn = $data->songs->count();
                        return $actionBtn;
                    })
                    ->addColumn('cover', function($data){
                        $img = Storage::disk('s3')->url($data->album_cover);
                        $actionBtn =  '<img src='.$img.' border="0" width="40" class="img-rounded" align="center" />';
                        return $actionBtn;
                    })
                    ->rawColumns(['action','songs','cover']) // returning action column
                    ->make(true);
        }
        return view('administrator.albums.index');
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
    public function store(CreateAlbumRequest $request)
    {

        // $image = $request->album_cover->store('public/album_covers');
        $image = Storage::disk('s3')->put('album_covers', $request->album_cover, 'public');
        Album::create([
            'title' => $request->title,
            'description' => $request->description,
            'artist' => $request->artist_name,
            'album_cover' => $image,
        ]);
        return response()->json('Album Details Saved', 201);
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
        return response()->json(Album::find($id),200);
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
            'artist_name' => 'required',
            'description' => 'required',
        ]);
        $album = Album::find($id);
        $album->title = $request->title;
        $album->description = $request->description;
        $album->artist = $request->artist_name;
        $album->save();
        return response()->json('Update Successful', 200);
    }

    public function cover_update(Request $request, $id)
    {
        $this->validate($request, [
            'cover'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_update_id' => 'numeric'
            ]);
        $album = Album::findOrFail($request->cover_update_id);
       
        if(Storage::disk('s3')->exists($album->album_cover)){
            Storage::disk('s3')->delete($album->album_cover); //delete file
            $new_image_name = Storage::disk('s3')->put('album_covers', $request->cover, 'public');
            $album->album_cover = $new_image_name;
        }else{
            $new_image_name = Storage::disk('s3')->put('album_covers', $request->cover, 'public');
            $album->album_cover = $new_image_name;
        }
        $album->save();
        return response()->json('Album Cover Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $album->delete();

        return response()->json('Album Delete Successfully', 200);
    }
}
