<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title','book_cover','description','author','price'];
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    /**
     * Get all of the comments for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookchapter()
    {
        return $this->hasMany(BookChapter::class);
    }

    /**
     * Get the user associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookBookmark()
    {
        return $this->hasOne(BooksBookmark::class, 'book_id')->where('user_id', request()->user()->id);
    }

    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($book) { // before delete() method call this
             $book->bookBookmark()->each(function($bookmark) {
                $bookmark->delete(); // <-- direct deletion
             });
             $book->bookchapter()->each(function($bookchapter) {
                $bookchapter->delete(); // <-- raise another deleting event on Post to delete comments
             });
            //  $book->tags()->each(function($tags) {
            //     $tags->delete(); // <-- direct deletion
            //  });
             // do the rest of the cleanup...
        });
    }

}
