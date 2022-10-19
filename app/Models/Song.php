<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    use HasFactory;
    protected $fillable =['title','description','cover_image','song','artist','released_Date','file'];

    // public function album()
    // {
    //     return $this->belongsTo(Album::class);
    // }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the user associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function songBookmark()
    {
        return $this->hasOne(SongsBookmark::class, 'song_id')->where('user_id', request()->user()->id);
    }

    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($song) { // before delete() method call this
             $song->songBookmark()->each(function($songBookmark) {
                $songBookmark->delete(); // <-- direct deletion
             });
            //  $song->tags()->each(function($tags) {
            //     $tags->delete(); // <-- direct deletion
            //  });
        });
    }
}

