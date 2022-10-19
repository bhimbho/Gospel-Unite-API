<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoBookmarkRequest;
use App\Models\VideosBookmark;
use Illuminate\Http\Request;

class VideosBookmarkController extends Controller
{
    public function store(VideoBookmarkRequest $request)
    {
        $video_id = $request->video_id;
        $query = VideosBookmark::where([
                ['user_id','=', $request->user()->id],
                ['video_id','=', $video_id],
            ]);
        if($query->count()>0){
            $query->delete();
            return response()->json([
                'message' => 'Video has been Unbookmarked',
                201
            ]);
        }
        VideosBookmark::create([
            'video_id' => $video_id,
            'user_id' => $request->user()->id
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Video added to your library',
        ]);
    }
}
