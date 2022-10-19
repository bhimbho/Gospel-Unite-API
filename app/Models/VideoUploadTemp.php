<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUploadTemp extends Model
{
    use HasFactory;
    protected $fillable = ['video_name'];
}
