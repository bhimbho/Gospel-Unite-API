<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\BookBookmarkRequest;
use App\Models\BooksBookmark;
use Illuminate\Http\Request;

class BooksBookmarkController extends Controller
{
    public function store(BookBookmarkRequest $request)
    {
        $book_id = $request->book_id;
        $query = BooksBookmark::where([
                ['user_id','=', $request->user()->id],
                ['book_id','=', $book_id],
            ]);

        if($query->count()>0){ //if exist unbookmark
            $query->delete();
            return response()->json([
                'message' => 'Book has been Unbookmarked',
                201
            ]);
        }
        BooksBookmark::create([
            'book_id' => $book_id,
            'user_id' => $request->user()->id
        ]);
        return response()->json([
            'message' => 'Book added to your library',
            201
        ]);
    }


}
