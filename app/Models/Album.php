<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['title','artist','album_cover','description'];


    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
