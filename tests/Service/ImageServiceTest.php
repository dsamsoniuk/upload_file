<?php 

declare(strict_types=1);

use App\Service\ImageService;
use PHPUnit\Framework\TestCase;

final class ImageServiceTest extends TestCase
{
    public function testResize(): void
    {

        $imageService = new ImageService();

        // $imageService->resize();


        // $stack = [];

        // $this->assertSame(0, count($stack));

        // array_push($stack, 'foo');
        // $this->assertSame('foo', $stack[count($stack)-1]);
        // $this->assertSame(1, count($stack));

        // $this->assertSame('foo', array_pop($stack));
        // $this->assertSame(0, count($stack));
    }
}
