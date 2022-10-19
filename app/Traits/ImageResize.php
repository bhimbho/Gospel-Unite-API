<?php
namespace App\Traits;
use Img;

trait ImageResize {
    protected function image_resize ($image){
        $img = Img::make($image);
        $img->resize(null, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img;
    }
}