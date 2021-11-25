<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function generateMobileImage($disk, $image, $filename, $destination_path)
    {
        $image = self::resizeImage($image, config('images.mobile_max_width'));
        $filename = self::addToNameImage($filename, config('images.mobile_add_name'), getExtensionByMimetype($image->mime()));
        return self::saveImage($disk, $destination_path.'/'.$filename, $image);
    }

    public static function generateThumbnailImage($disk, $image, $filename, $destination_path)
    {
        $image = self::resizeImage($image, config('images.thumbnail_max_width'));
        $filename = self::addToNameImage($filename, config('images.thumbnail_add_name'), getExtensionByMimetype($image->mime()));
        return self::saveImage($disk, $destination_path.'/'.$filename, $image);
    }

    public static function addToNameImage($filename, $addToFileName, $extension){
        return str_replace($extension, $addToFileName.$extension, $filename);
    }

    public static function saveImage($disk, $path, $image){
        Storage::disk($disk)->put($path, $image->stream());
        return true;
    }

    public static function resizeImage($image, $maxWidth = null, $maxHeight = null){
        $maxWidth = $maxWidth ?? config('images.desktop_max_width');
        return $image->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }

    public static function deleteImage($disk, $path)
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
        $directoryDeleted = ifDirectoryEmptyDelete(getPathImage($path));
        return true;
    }

    public static function ifDirectoryEmptyDelete($path)
    {
        $return = false;
        if($path != ""){
            $dir = scandir($path);
            if (($key = array_search(".", $dir)) !== false) {
                unset($dir[$key]);
            }
            if (($key = array_search("..", $dir)) !== false) {
                unset($dir[$key]);
            }
            if (!count($dir)) {
                rmdir($path);
                $return = true;
            }
        }
        return $return;
    }

    public static function getPathImage($path)
    {
        $path = explode('/', $path);
        array_pop($path);
        return implode('/', $path);
    }
}
