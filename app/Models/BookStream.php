<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStream extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id'];

    /**
     * Get the videos that owns the BookStream
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
