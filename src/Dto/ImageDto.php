<?php 

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class ImageDto {
    /**
     * @Assert\Image(
     *     maxSize = "10M",
     *     minWidth = 200,
     *     maxWidth = 5000,
     *     minHeight = 200,
     *     maxHeight = 5000,
     *     mimeTypes = {
     *      "image/jpeg",
     *      "image/jpg",
     *      "image/png",
     *      "image/gif"
     *     }
     * )
     */
    public ?File $file;
}