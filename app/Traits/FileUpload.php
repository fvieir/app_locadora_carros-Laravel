<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public function uploadFile($path, $file) {
        \dd($file);
        return $file->store($path,'public');
    }

    public function deleteFile($file) {
        \dd($file);
        Storage::disk('public')->delete($file);
    }
}
