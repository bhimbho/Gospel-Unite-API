<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoStreamRequest;
use App\Models\Video;
use App\Models\VideoStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoStreamController extends Controller
{
    public function store(VideoStreamRequest $request)
    {
        VideoStream::create([
            'user_id' => $request->user()->id,
            'status' => $request->status,
            'video_id' => $request->video_id, 
        ]);
        return response()->json(['Stored'], 201);
    }

    public function recentlyPlayed() 
    {
        $query = VideoStream::with('video')
        ->take(10)->orderBy('id','DESC')->get();
        // $query = Video::has('userVideoStream')->orderBy('id', 'DESC')->get();
        return response()->json($query, 201);
    }

    public function recommendedVideos() //ranking video
    {
        // $query = DB::table('video_streams')
        $query = VideoStream::with('video')
        // ->leftJoin('videos', 'video_streams.video_id', '=', 'videos.id')
        ->select(DB::raw("count(video_streams.id) as views_count, video_id"))
        ->groupBy('video_streams.video_id')
        ->orderBy('views_count')
        ->whereNotIn('video_id', DB::table('videos_bookmarks')->pluck('video_id')->toArray())
        ->take(5)
        ->get();
        return response()->json($query, 201);
    }

    public function VideoViews($video_id)
    {
        $query = VideoStream::where('video_id',$video_id)->count();
        return response()->json($query, 201);
    }
}
