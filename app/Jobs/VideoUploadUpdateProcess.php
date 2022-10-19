<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class VideoUploadUpdateProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data, $video_id;

    public function __construct($data, $video_id)
    {
        $this->data = $data;
        $this->video_id = $video_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $video_details = Video::find($this->video_id);

        if(Storage::disk('s3')->exists($video_details->file)){
            Storage::disk('s3')->delete($video_details->file); //delete file
        }
        $video_details->file = Storage::disk('s3')->putFile('videos', storage_path().'\app\public\video\\'.$this->data['video'], 'public');
        $video_details->update();
        
        unlink(storage_path().'\app\public\video\\'.$this->data['video']);
        session()->flash('success', ' Video has been updated');
    }
}
