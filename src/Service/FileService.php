<?php
namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class FileService
{
    private $projectDir;

    /**
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }
    /**
     * @param string $path
     * @param string $destinyDir
     * 
     * @return File
     */
    public function copyFile(File $file, string $destinyDir = '/') : File {

        $destinyPath    = $this->projectDir.$destinyDir;
        $ext            = $file->guessExtension();

        $bytes          = random_bytes(10);
        $fileName       = bin2hex($bytes).'.'.$ext;
        
        $fs             = new Filesystem();
        $filePath       = $destinyPath.$fileName;
        $fs->copy($file->getPathname(), $filePath);
        
        return new File($filePath);
    }

}