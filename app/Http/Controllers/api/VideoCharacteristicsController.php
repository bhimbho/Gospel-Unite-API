<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Video\CommentRequest;
use App\Http\Requests\Api\Video\LikesRequest;
use App\Http\Requests\Video\SimilarVideoRequest;
use App\Models\Video;
use App\Models\VideoComment;
use App\Models\VideoLike;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VideoCharacteristicsController extends Controller
{
    public function storeLikes($video_id, LikesRequest $request)
    {
        VideoLike::updateOrCreate(
            [ 'video_id' => $video_id],
            ['like' => $request->like_status, 'user_id' => $request->user()->id]
        );
        return response()->json(['status' => 201]);
    }

    public function storeComment($video_id, CommentRequest $request)
    {
        VideoComment::Create(
            [ 'video_id' => $video_id, 'comment' => $request->comment, 'user_id' => $request->user()->id]
        );
        return response()->json([
            'status' => 201,
            'message' => 'Comment has been logged'
        ]);
    }

    public function similarVideos(SimilarVideoRequest $request)
    {
        $tags = $request->tags;
        $query = Video::whereHas('tags', function(Builder $query) use ($tags) {
            $query->whereIn('tag_id', $tags);
        })->with('tags')->inRandomOrder()->take(5)->get();       
        return response()->json($query,200);
    }

    public function recommendedVideos(Request $request)
    {
        $tags = $request->tags;
        $query = Video::whereHas('tags', function(Builder $query) use ($tags) {
            $query->whereIn('tag_id', $tags);
        })->inRandomOrder()->take(5)->get();       
        return response()->json($query,200);
    }
    
}
