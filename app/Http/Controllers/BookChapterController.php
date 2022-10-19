<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\BooksChaptersRequest;
use App\Models\Book;
use App\Models\BookChapter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('administrator.book-chapters.index');
    }

    /**
     * Show all chapters belonging to a book a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book_with_chapters(Request $request, $id)
    {
        //
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
    public function store(BooksChaptersRequest $request)
    {
        $query = BookChapter::where([['chapter_order_no','!=', 0],['book_id', $request->get('book_id')],['chapter_order_no', $request->chapter_number]])->first();
        if(!($query == NULL)){
            return response()->json('Record Already Exist');
        }
        else{
            $chapter = BookChapter::Create([
                'chapter_title' => $request->title,
                'chapter_note' => $request->notes,
                'chapter' => $request->content,
                'book_id' => $request->book_id,
                'chapter_order_no' => $request->chapter_number
            ]);
        }
//        return response()->json("Chapter Created Successfully", 201);
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo "a";
        // return view('administrator.book-chapters.index')->with('chapters', $chapters);
    }

    /**
     * Display the all chpaters for a book resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_chapters(Request $request, $id)
    {
        if($request->ajax()){
            $data = BookChapter::where('book_chapters.book_id',$id)->orderBy('chapter_order_no', 'asc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a data-id="'.$data->id.'" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Edit Chapter</a>
                        <button id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->editColumn('book', function($data){
                        $actionBtn = $data->book->title;
                        return $actionBtn;
                    })
                    ->rawColumns(['action','book']) // returning action column
                    ->make(true);
        }

        // $chapters = BookChapter::where('book_id',$id)->get();
        return view('administrator.book-chapters.index')
        // ->with('chapters', $chapters)
        ->with('book_id', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BookChapter $books_chapter)
    {
        return response()->json($books_chapter, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookChapter $books_chapter)
    {
        $books_chapter->chapter = $request->chapter;
        $books_chapter->chapter_title = $request->chapter_title;
        $books_chapter->update();
        return response()->json("Chapter Updated", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = BookChapter::find($id);
        $chapter->delete();
        return response()->json('Chapter Deleted', 200);
    }
}
