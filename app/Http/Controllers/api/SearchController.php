<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BooksBookmark;
use App\Models\Song;
use App\Models\SongsBookmark;
use App\Models\Video;
use App\Models\VideosBookmark;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_all_media(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $books_result = Book::query()
        ->where('title', 'LIKE', "%{$searchTerm}%")
        ->orWhere('author', 'LIKE', "%{$searchTerm}%")
        ->get();

        $songs_result = Song::query()
        ->where('title', 'LIKE', "%Pain%")
        ->orWhere('artist', 'LIKE', "%{$searchTerm}%")
        ->get();

        $videos_result = Video::query()
        ->where('title', 'LIKE', "%{$searchTerm}%")
        ->orWhere('artist', 'LIKE', "%{$searchTerm}%")
        ->get();
        return response()->json([
            'status' => 200,
            'searchResult' => [
                'books' => $books_result,
                'songs' => $songs_result,
                'videos' => $videos_result,
                'searchKey' => $searchTerm,
                ]
        ]);
    }

    public function user_library_search(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $books_result = BooksBookmark::query()->with('bookSearch')
        ->where('user_id', request()->user()->id)
        ->get();

        $songs_result = SongsBookmark::query()->with('songSearch')
        ->where('user_id', request()->user()->id)       
        ->get();

        $videos_result = VideosBookmark::query()->with('videoSearch')
        ->where('user_id', request()->user()->id)
        ->get();
        return response()->json([
            'status' => 200,
            'searchResult' => [
                'books' => $books_result, 
                'songs' => $songs_result,
                'videos' => $videos_result
                ] 
        ]);
    }
}
