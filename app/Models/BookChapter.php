<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookChapter extends Model
{
    use HasFactory;
    // protected $table = 'book_chapters';
    protected $fillable = ['chapter_title','chapter_note','book_id','chapter','chapter_order_no'];

    /**
     * Get the user that owns the BookChapter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user that owns the BookProgress belonging to book chapter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookProgress()
    {
        return $this->hasOne(UsersBookProgress::class, 'chapter_id')->where('user_id', request()->user()->id);
    }

    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($bookchapter) { // before delete() method call this
             $bookchapter->bookProgress()->each(function($bookProgress) {
                $bookProgress->delete(); // <-- direct deletion
             });
        });
    }

    

  
}
