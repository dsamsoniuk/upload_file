<?php

namespace App\Service\FileUpload;

use Symfony\Component\HttpFoundation\File\File;

interface FileUploadInterface {
    public function addFile(File $file);
    public function upload();
} 