<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosBookmark extends Model
{
    use HasFactory;
    protected $fillable = ['video_id', 'user_id'];

    /**
     * Get the user that owns the VideosBookmark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function videoSearch()
    {
        $searchTerm = request()->searchTerm;
        return $this->belongsTo(Video::class, 'video_id')
        ->where('title', 'LIKE', "%{$searchTerm}%");
    }

}
