<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoStream extends Model
{
    use HasFactory;
    protected $fillable = ['video_id', 'user_id'];

    /**
     * Get the videos that owns the VideoStream
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
