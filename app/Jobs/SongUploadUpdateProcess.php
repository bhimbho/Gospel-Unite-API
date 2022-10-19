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

class SongUploadUpdateProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels; 

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data, $song_id;

    public function __construct($data, $song_id)
    {
        $this->data = $data;
        $this->song_id = $song_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $song_details = Song::find($this->song_id);

        if(Storage::disk('s3')->exists($song_details->file)){
            Storage::disk('s3')->delete($song_details->file); //delete file
        }
        $song_details->file = Storage::disk('s3')->putFile('songs', storage_path().'\app\public\song\\'.$this->data['song'], 'public');
        $song_details->update();
        
        unlink(storage_path().'\app\public\song\\'.$this->data['song']);
        // session()->flash('success', ' Video has been updated');
    }
}
