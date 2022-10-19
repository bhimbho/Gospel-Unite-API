<?php

namespace App\Jobs;

use App\Models\Video;
use App\Models\VideoUploadTemp;
use App\Traits\ImageResize;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class VideoUploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ImageResize;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data, $cover_path, $temp_video;
    public function __construct($data, $path)
    {
        $this->cover_path = $path;
        $this->data = $data;
        // $this->temp_video = $temp_video_model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $video_file = Storage::disk('s3')->putFile('videos', storage_path().'/app/public/video/'.$this->data['video'], 'public');
        $video = Video::create([
            'title' => $this->data['title'],
            'artist' => $this->data['artist'],
            'description' => $this->data['description'],
            'file' => $video_file,
            'cover' => $this->cover_path,
        ]);

        $video->tags()->attach($this->data['tags']);
        // Storage::delete('video/'.$this->data['video']);
        unlink(storage_path().'/app/public/video/'.$this->data['video']);
        session()->flash('success', $this->data['title'].' has bee uploaded successfully');
    }
}
