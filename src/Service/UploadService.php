<?php
namespace App\Service;

use App\Dto\ImageDto;
use App\Service\FileUpload\DropBox\DropBoxService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class UploadService
{

    /**
     * @param  projectDir
     * @param  DropBoxService $dropBoxService
     */
    public function __construct(private string $projectDir, private DropBoxService $dropBoxService){}

    /**
     * @param string $path
     * 
     * @return void
     */
    public function uploadImage(string $path) : void {

        $image  = new ImageDto();
        $image->file = new File($path);

        if (count($errors = $this->validator->validate($image))) {
            throw new FileException($errors);
        }

        $imgService = new ImageService();
        $image = $imgService->resize($image, $this->projectDir.'/public/image');

        $this->dropBoxService->upload($image->file, null);
    }
}