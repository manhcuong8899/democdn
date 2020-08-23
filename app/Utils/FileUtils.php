<?php

namespace App\Utils;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileUtils {

    public static function save_images($path, $file, $with, $height) {
        $img = Image::make($file)->resize($with, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::disk('images')->put($path,$img->stream());
        return $path;
    }

    public static function save_files($path) {
        Storage::disk('files')->makeDirectory($path);
    }

    public static function save_folderimages($path) {
        Storage::disk('images')->makeDirectory($path);
    }
    public static function delete_folderimages($path) {
        Storage::disk('images')->deleteDirectory($path);
    }

    public static function delete_folderfiles($path) {
        Storage::disk('files')->deleteDirectory($path);
    }

    public static function delete_files($path) {
        File::delete($path);
    }

    public static function move_folder($oldpath,$newpath) {
        Storage::move($oldpath,$newpath);
    }
}