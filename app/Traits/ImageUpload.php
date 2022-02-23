<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageUpload
{
    private function storeImage($file, $dir = '')
    {
        $filenameWithExt = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = str($filename)->slug();
        $path = $dir . '/' . str()->random(20) . time() . '.' . $extension;

        Storage::put(
            "public" . $path,
            Image::make($file)->encode($extension)->__toString()
        );

        return [
            'name' => $filenameWithExt,
            'size' => $size,
            'extension' => $extension,
            'path' => 'storage' . $path
        ];
    }

    private function deleteImage($path)
    {
        return Storage::exists($path) ? Storage::delete($path) : false;
    }

    private function checkImage($file)
    {
        return in_array($file->extension(), ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'webp'])
            && $file->getSize() < (1024 * 1024);
    }
}
