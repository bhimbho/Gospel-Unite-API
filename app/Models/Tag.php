<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];
    protected $hidden = ['created_at','updated_at'];

    public function videos() 
    {
        return $this->belongsToMany(Video::class);
    }

    public function songs() 
    {
        return $this->belongsToMany(Song::class);
    }

    public function books() 
    {
        return $this->belongsToMany(Book::class);
    }
}
