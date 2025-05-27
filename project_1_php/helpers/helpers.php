<?php 

if (!function_exists('uploadFile')) {
    function uploadFile($file, $path) {
        $targetDir = 'storage/' . rtrim($path, '/') . '/';
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $target = $targetDir . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $target);
        return $target;
    }
}
