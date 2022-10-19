<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongStream extends Model
{
    use HasFactory;

    protected $fillable = ['song_id', 'user_id'];

    /**
     * Get the videos that owns the SongStream
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
