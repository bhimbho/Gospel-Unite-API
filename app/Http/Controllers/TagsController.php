<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\TagsRequests;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Tag::orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit</a>
                        
                        <button type="button" id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action']) // returning action column
                    ->make(true);
        }
        return view('administrator.tags.index');
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
    public function store(TagsRequests $request)
    {
        Tag::create([
            'name' => $request->tags,
            'slug' => $request->tags
       ]);
       return response()->json('Tags Added Successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Tag::find($id),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $tags =Tag::find($id);
        $tags->name = $request->tags;
        $tags->save();
        return response()->json('Tag Updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return response()->json('Tags Delete Successfully', 200);
    }
}
