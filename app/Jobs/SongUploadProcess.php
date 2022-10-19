<?php

namespace App\Jobs;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SongUploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $song_file = Storage::disk('s3')->putFile('songs', storage_path().'/app/public/song/'.$this->data['song'], 'public');
        $song = Song::create([
            'title' => $this->data['title'],
            'artist' => $this->data['artist'],
            'description' => $this->data['description'],
            'file' => $song_file,
            'cover_image' => $this->cover_path,
            'released_Date' => $this->data['release_date'],
        ]);

        $song->tags()->attach($this->data['tags']);
        // Storage::delete('video/'.$this->data['video']);
        unlink(storage_path().'/app/public/song/'.$this->data['song']);
        // session()->flash('success', $this->data['title'].' has bee uploaded successfully');
    }
}

