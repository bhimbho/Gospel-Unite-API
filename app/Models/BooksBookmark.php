<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksBookmark extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id'];

    /**
     * Get the user that owns the BooksBookmark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function bookSearch()
    {
        $searchTerm = request()->searchTerm;
        return $this->belongsTo(Book::class, 'book_id')
        ->where('title', 'LIKE', "%{$searchTerm}%") 
        ->orWhere('author', 'LIKE', "%{$searchTerm}%") ;
    }

  
}
