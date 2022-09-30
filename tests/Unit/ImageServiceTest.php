<?php 

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Dto\ImageDto;
use App\Service\ImageService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

// use App\

class ImageServiceTest extends TestCase
{
    /** @test */
    public function upload_file_exceptions(): void
    {
        $image = new ImageDto();
        $this->expectException(FileException::class);
        $image->file = new File('/not_existsting_file.jpg');
    }
    /** @test */
    public function upload_file_assert_exceptions(): void
    {
                // // (1) boot the Symfony kernel
                // self::bootKernel();

                // // (2) use static::getContainer() to access the service container
                // $container = static::getContainer();
                
        $image = new ImageDto();
        // $this->expectException(FileException::class);
        // $image->file = new File(__DIR__.'/../uploads/forest.jpg');

        // $image->file = new File('/not_existsting_file.jpg');
    }
}
