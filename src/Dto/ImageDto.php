<?php 

namespace App\Dto;

use App\Service\ImageService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class ImageDto {
    /**
     * @Assert\Image(
     *     maxSize = "10M",
     *     minWidth = 100,
     *     maxHeight = 5000,
     *     mimeTypes = {
     *      "image/jpeg",
     *      "image/jpg",
     *      "image/png",
     *      "image/gif"
     *     }
     * )
     */
    private ?File $file;

    public function resize(string $destinyPath = '/'){
        $imgService = new ImageService();
        $this->file = $imgService->resize($this->file, $destinyPath);
    }

    /**
     * Get maxSize = "10M",
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set maxSize = "10M",
     *
     * @return  self
     */ 
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }
}