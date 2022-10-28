<?php
namespace App\Service;

use App\Dto\ImageDto;
use App\Service\FileUpload\DropBox\DropBoxService;
use App\Service\FileUpload\FileUploadInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UploadService
{
    /**
     * @param  projectDir
     */
    public function __construct(
        private ValidatorInterface $validator){}


    /**
     * @param string $path
     * @param array $services
     * 
     * @return void
     */
    public function uploadImage(ImageDto $image, array $uploadServices = []) : bool {

        if (count($errors = $this->validator->validate($image))) {
            throw new FileException($errors);
        }

        foreach ($uploadServices as $service) {
            $service->addFile($image->getFile());
            $service->upload();
        }

        return true;
    }

}