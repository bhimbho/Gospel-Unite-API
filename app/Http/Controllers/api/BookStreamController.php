<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookStreamController extends Controller
{
    public function store(Request $request)
    {
        BookStream::create([
            'user_id' => $request->user()->id,
            'status' => $request->status,
            'book_id' => $request->book_id,
        ]);
        return response()->json(['Stored'], 201);
    }

    public function recentlyPlayed()
    {
        $query = BookStream::with('book')
        ->take(10)->orderBy('id','DESC')->get();
        return response()->json($query, 201);
    }

    public function recommendedBooks() 
    {
        $query = BookStream::with('book')
        ->select(DB::raw("count(book_streams.id) as views_count, book_id"))
        ->groupBy('book_streams.book_id')
        ->orderBy('views_count')
        ->whereNotIn('book_id', DB::table('books_bookmarks')->pluck('book_id')->toArray())
        ->take(5)
        ->get();
        return response()->json($query, 201);
    }

    public function BookViews($book_id)
    {
        $query = BookStream::where('book_id',$book_id)->count();
        return response()->json($query, 201);
    }
}
