<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongsBookmark extends Model
{
    use HasFactory;
    protected $fillable = ['song_id', 'user_id'];

      /**
     * Get the user that owns the SongsBookmark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id');
    }

    public function songSearch()
    {
        $searchTerm = request()->searchTerm;
        return $this->belongsTo(Song::class, 'song_id')
        ->where('title', 'LIKE', "%{$searchTerm}%") 
        ->orWhere('artist', 'LIKE', "%{$searchTerm}%") ;
    }

    
}
