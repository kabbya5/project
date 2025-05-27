<?php

namespace App\Controllers\Api;

class ApiDocumentController {
    public function index() {
        // Absolute path to the views/index.html file
        $file = __DIR__ . '/../../../views/index.html';

        if (file_exists($file)) {
            header('Content-Type: text/html');
            readfile($file);
        }
    }
}