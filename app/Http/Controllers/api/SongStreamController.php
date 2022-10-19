<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SongStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongStreamController extends Controller
{
    public function store(Request $request)
    {
        SongStream::create([
            'user_id' => $request->user()->id,
            'status' => $request->status,
            'song_id' => $request->song_id,
        ]);
        return response()->json(['Stored'], 201);
    }

    public function recentlyPlayed()
    {
        $query = SongStream::with('song')
        ->take(10)->orderBy('id','DESC')->get();

        return response()->json($query, 201);
    }

    public function recommendedSongs() 
    {
        $query = SongStream::with('song')
        ->select(DB::raw("count(song_streams.id) as views_count, song_id"))
        ->groupBy('song_streams.song_id')
        ->orderBy('views_count')
        ->take(5)
        ->get();
        return response()->json($query, 201);
    }

    public function SongViews($song_id)
    {
        $query = SongStream::where('song_id',$song_id)->count();
        return response()->json($query, 201);
    }
}
