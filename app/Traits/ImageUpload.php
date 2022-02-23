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

    public function resize()
    {
        $width = 600;
        $height = 500;
        $file = url('storage/d4PBClbo48mwvmQT7WVK1645532191.webp');
        switch (pathinfo($file)['extension']) {
            case "png":
                return imagepng(imagescale(imagecreatefrompng($file), $width, $height), $file);
            case "gif":
                return imagegif(imagescale(imagecreatefromgif($file), $width, $height), $file);
            case "webp":
                return imagewebp(imagescale(imagecreatefromwebp($file), $width, $height), $file);
            default:
                return imagejpeg(imagescale(imagecreatefromjpeg($file), $width, $height), $file);
        }
    }
}
