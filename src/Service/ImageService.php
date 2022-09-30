<?php
namespace App\Service;

use App\Dto\ImageDto;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Symfony\Component\HttpFoundation\File\File;

class ImageService
{
    private const MAX_WIDTH = 150;
    private const MAX_HEIGHT = 150;
    
    /**
     * @var Imagine $imagine
     */
    private $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    /**
     * @param string $filename
     * 
     * @return ImageDto
     */
    public function resize(ImageDto &$image, ?string $targetDir) : void
    {
        $maxWith = self::MAX_WIDTH;
        $maxHeight = self::MAX_HEIGHT;

        $filePath = $image->file->getPathname();
        $fileName = $image->file->getFilename();

        list($iwidth, $iheight) = getimagesize($filePath);

        $ratio  = $iwidth / $iheight;

        if ($maxWith / $maxHeight > $ratio) {
            $maxWith = $maxHeight * $ratio;
        } else {
            $maxHeight = $maxWith / $ratio;
        }
        $target = $targetDir ? $targetDir.'/'.$fileName : $filePath;

        $photo = $this->imagine->open($filePath);
        $photo
            ->resize(new Box($maxWith, $maxHeight))
            ->save($target);

        $image->file = new File($target);

    }

}