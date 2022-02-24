<?php

namespace App\Traits;

use Exception;

trait ErrorException {
    public function ErrorException ($e) {
        return [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ];  
    }
}