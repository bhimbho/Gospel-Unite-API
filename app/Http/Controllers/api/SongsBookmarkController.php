<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Songs\SongBookmarkRequest;
use App\Models\SongsBookmark;
use Illuminate\Http\Request;

class SongsBookmarkController extends Controller
{
    public function store(SongBookmarkRequest $request)
    {
        $song_id = $request->song_id;
        $query = SongsBookmark::where([
                ['user_id','=', $request->user()->id],
                ['song_id','=', $song_id],
            ]);
        if($query->count()>0){
            $query->delete();
            return response()->json([
                'message' => 'Song has been Unbookmarked',
                201
            ]);
        }
        SongsBookmark::create([
            'song_id' => $song_id,
            'user_id' => $request->user()->id
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Song added to your library',
        ]);
    }
}
