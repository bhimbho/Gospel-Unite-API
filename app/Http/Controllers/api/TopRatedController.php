<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BooksBookmark;
use App\Models\SongsBookmark;
use App\Models\VideosBookmark;
use Illuminate\Http\Request;

class TopRatedController extends Controller
{
    public function topBook()
    {
        $query = BooksBookmark::select('book_id')
                ->groupBy('book_id')
                ->orderByRaw('COUNT(*) DESC')
                ->with('book')
                ->limit(3)
                ->get();

        return response()->json([
            'data' => $query,
        ]);
    }

    public function topSong()
    {
        $query = SongsBookmark::select('song_id')
                ->groupBy('song_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->with('song')
                ->get();

        return response()->json([
            'data' => $query,
        ]);
    }

    public function topVideo()
    {
        $query = VideosBookmark::select('video_id')
                ->groupBy('video_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->with('video')
                ->get();

        return response()->json([
            'data' => $query,
        ]);
    }

    public function allTopMedia()
    {
        $bookQuery = BooksBookmark::select('book_id')
                ->groupBy('book_id')
                ->orderByRaw('COUNT(*) DESC')
                ->with('book')
                ->limit(3)
                ->get();
                $songQuery = SongsBookmark::select('song_id')
                ->groupBy('song_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->with('song')
                ->get();
                $videoQuery = VideosBookmark::select('video_id')
                ->groupBy('video_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->with('video')
                ->get();

        return response()->json([
            'bookQuery' => $bookQuery,
            'songQuery' => $songQuery,
            'videoQuery' => $videoQuery,
        ]);
    }

}
