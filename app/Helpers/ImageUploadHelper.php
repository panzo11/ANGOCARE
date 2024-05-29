<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageUploadHelper
{
    public static function uploadImage($image, $folder)
    {
        try {
            if ($image && $image->isValid()) {
                // $imageName = md5($image->getClientOriginalName() . strtotime('now')) . "." . $image->extension();
                // $path = $image->storeAs($folder, $imageName, 'public');

                // Se precisar do caminho completo (com URL), utilize o Storage::url:
                // $fullPath = Storage::url($path);

                // $extension= $image->extension();
                $imageName = md5($image->getClientOriginalName() . strtotime('now')) . "." . $image->extension();
                $destino=$image->move(public_path($folder),$imageName);
                $caminho=$folder."/".$imageName;


                return $caminho;
            }

            return 0;
        } catch (\Throwable $th) {
            return 1;
        }

    }
}
