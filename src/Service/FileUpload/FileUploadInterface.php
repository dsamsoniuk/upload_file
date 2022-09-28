<?php

namespace App\Service\FileUpload;

use Symfony\Component\HttpFoundation\File\File;

interface FileUploadInterface {
    public function upload(File $file);
    public function setPath(string $path);
} 