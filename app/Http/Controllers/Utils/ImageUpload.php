<?php
namespace App\Http\Controllers\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageUpload{
    public static function uploadImage($file ,$folder_path, $imageOldPath=null)
    {

        if($imageOldPath){
            if($imageOldPath != 'default.jpg'){
                File::delete(public_path($imageOldPath));
            }
        }

        $path = $file->storeAs('uploads/'. $folder_path, Str::uuid().date('Y-m-d-h-m-s') . $file->getClientOriginalName() ,  ['disk' => 'uploads']);
        return $path;




    }
}
