<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title','artist', 'description', 'file', 'cover'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the comments for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(VideoComment::class)->with('user');
    }

    /**
     * Get all of the likes for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(VideoLike::class)->where('like', 1);
    }

    /**
     * Get all of the dislikes for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dislikes()
    {
        return $this->hasMany(VideoLike::class)->where('like', 0);
    }

     /**
     * Get the videos that has VideoStream by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userVideoStream()
    {
        // return $this->hasMany(VideoStream::class)->where('user_id', request()->user()->id);
        return $this->hasMany(VideoStream::class);
    }

     // this is the recommended way for declaring event handlers
     public static function boot() {
        parent::boot();
        self::deleting(function($video) { // before delete() method call this
             $video->userVideoStream()->each(function($uservideoStream) {
                $uservideoStream->delete(); // <-- direct deletion
             });
             $video->likes()->each(function($likes) {
                $likes->delete(); // <-- direct deletion
             });
             $video->dislikes()->each(function($dislikes) {
                $dislikes->delete(); // <-- direct deletion
             });
             $video->comments()->each(function($comments) {
                $comments->delete(); // <-- direct deletion
             });
            //  $video->tags()->each(function($tags) {
            //     $tags->delete(); // <-- direct deletion
            //  });
        });
    }
}
