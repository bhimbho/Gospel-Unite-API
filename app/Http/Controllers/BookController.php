<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\CreateBooksRequest;
use App\Http\Requests\Books\UpdateBooksRequest;
use App\Models\Book;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ImageResize;

class BookController extends Controller
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
            $data = Book::orderBy('id','desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit Info</a>
                        <a data-id="'.$data->id.'" id="modal" class="edit_cover btn btn-success btn-sm text-white" data-toggle="modal" data-target=".modal2">Replace Book Cover</a>
                        <a href="'.Route('books-chapters.all_chapters',$data->id).'" class="btn btn-dark btn-sm"">Manage Chapters</a>
                        <button id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->addColumn('book_covers', function($data){
                        $img = Storage::disk('s3')->url($data->book_cover);
                        $actionBtn =  '<img src='.$img.' border="0" width="40" class="img-rounded" align="center" />';
                        return $actionBtn;
                    })
                    ->rawColumns(['action','book_covers']) // returning action column
                    ->make(true);
        }
        return view('administrator.books.index')
        ->with('tags', Tag::all())
        ->with('books', Book::all());
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
    public function store(CreateBooksRequest $request)
    {
        $file = $request->file('cover'); // Get file input
        $resized_img = $this->image_resize($file); // Create Intervention instance
        $name = time() . '_' . md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension(); //  file name
        $payload = (string)$resized_img->encode();
        $path = 'books_cover/'.$name;
        $cover = Storage::disk('s3')->put($path, $resized_img, 'public');

        $book_details = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'book_cover' => $path,
            'description' => $request->description,
            'price' => (double)$request->price
        ]);
        $book_details->tags()->attach($request->tags);
        return response()->json("Upload Successful", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videos = Video::where('id', '=', $id)->firstOrFail();
        return view('administrator.books.edit')->with('videos', $videos)
        ->with('tags', Tag::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $tags = Tag::all();
        $book_tags = $book->tags;
        return response()->json([$book,$tags, $book_tags],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBooksRequest $request, $id)
    {
        $book = Book::find($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->price = (double)$request->price;
        $book->save();
        $book->tags()->sync($request->tags);
        return response()->json('Book Updated', 200);
    }

    /**
     * Update the book cover resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cover_update(Request $request, $id)
    {
        $this->validate($request, [
            'cover' => 'required|image|max:1000',
            'book_id' => 'required|numeric'
            ]);
        
        $file = $request->file('cover'); 
        $resized_img = $this->image_resize($file); // Create Intervention instance
        $name = time() . '_' . md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension(); //  file name
        $payload = (string)$resized_img->encode();
        $path= 'books_cover/'.$name;
        $book = Book::find($request->book_id);
        if(Storage::disk('s3')->exists($book->book_cover)){
            Storage::disk('s3')->delete($book->book_cover); //delete file
            Storage::disk('s3')->put($path, $resized_img, 'public');
            $book->book_cover = $path;
        }else{
            Storage::disk('s3')->put($path, $resized_img, 'public');
            $book->book_cover = $path;
        }
        $book->save();
        return response()->json('Cover Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        Storage::disk('s3')->delete($book->book_cover); //delete file
        $book->delete();
        $book->tags()->detach();
        return response()->json('Song Deleted', 200);
    }

    public function recommendBooks()
    {
        return Book::orderBy('id', 'DESC')->get();
    }
}
