<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'video' => 'mimetypes:video/mp4, video/x-flv, video/x-msvideo, video/x-ms-wmv'
        ]);
        
        if($request->hasFile('pond-upload')){
            $file = $request->file('pond-upload');
            $ext = $file->getClientOriginalExtension();
            $filename = time().uniqid().'.'.$ext;
            $file->storeAs('/video', $filename);
            return $filename;
        }
        return 'Cannot Upload';
    }

    public function store_song(Request $request)
    {
        $this->validate($request, [
            'video' => 'mimetypes:audio/mp3, audio/3gpp, audio/mpeg4-generic, audio/mpeg, audio/ogg'
        ]);
        
        if($request->hasFile('pond-upload')){
            $file = $request->file('pond-upload');
            $ext = $file->getClientOriginalExtension();
            $filename = time().uniqid().'.'.$ext;
            $file->storeAs('/song', $filename);
            return $filename;
        }
        return 'Cannot Upload';
    }
}
