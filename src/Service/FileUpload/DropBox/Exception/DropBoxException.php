<?php

namespace App\Service\FileUpload\DropBox\Exception;

use Exception;

class DropBoxException  extends Exception {
    
    protected $message = 'DropBox can\'t upload file.';   // exception message

}