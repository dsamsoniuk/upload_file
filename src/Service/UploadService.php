<?php
namespace App\Service;

use App\Dto\ImageDto;
use App\Service\FileUpload\DropBox\DropBoxService;
use App\Service\FileUpload\FileUploadInterface;
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
     * @param FileUploadInterface $service
     * @param File $file
     * @param string $target
     * 
     * @return [type]
     */
    public function uploadService(FileUploadInterface $service, File $file){
        $service->upload($file, '/');
    }

    /**
     * @param string $path
     * @param array $services
     * 
     * @return void
     */
    public function uploadImage(string $path, array $services = [], string $localPath = '/') : void {

        $image  = new ImageDto();
        $image->file = new File($path);

        if (count($errors = $this->validator->validate($image))) {
            throw new FileException($errors);
        }

        $imgService = new ImageService();
        $image = $imgService->resize($image, $this->projectDir.$localPath);


        foreach ($services as $service) {
            $this->uploadService($service, $image->file);
        }
    }
}