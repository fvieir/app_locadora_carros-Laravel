<?php

namespace App\Http\Controllers;

use App\Traits\FileUpload;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileUpload;

    protected function updateFile ($path, $file, $current) {

        if ($current != '') $this->deleteFile($current);
        return $this->uploadFile($path, $file);
    }
}
