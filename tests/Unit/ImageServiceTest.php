<?php 

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Command\UploadFileCommand;
use App\Dto\ImageDto;
use App\Service\ImageService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\CalculatorService;
use App\Service\FileUpload\DropBox\DropBoxService;
use App\Service\UploadService;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ImageServiceTest extends TestCase
{

        /** @var UploadService|PHPUnit_Framework_MockObject_MockObject */
        private $uploadServiceMock;
        
        /** @var CommandTester */
        private $commandTester;

    protected function setUp(): void
    {
        $this->calculator = new CalculatorService();

        $this->uploadServiceMock = $this->getMockBuilder(UploadService::class)->disableOriginalConstructor()->getMock();
        $this->dropBoxServiceMock = $this->getMockBuilder(DropBoxService::class)->disableOriginalConstructor()->getMock();

        $application = new Application();
        $application->add(new UploadFileCommand($this->uploadServiceMock, $this->dropBoxServiceMock));
        $command = $application->find('app:upload-file');
        $this->commandTester = new CommandTester($command);

    }
    // public function testExecute(){
    //     $this->expectException(FileException::class);
    //     $this->commandTester->execute([]);

    // }



    /** @test */
    public function upload_file_exceptions(): void
    {
        $image = new ImageDto();
        $this->expectException(FileException::class);
        $image->file = new File('/not_existsting_file.jpg');
    }

    public function dataCalcProvider(){
        return [
            [1,2,3],
            [1,4,5],
        ];
    }

    /** @dataProvider dataCalcProvider */
    public function testData($a,$b,$expected){
        $res = $this->calculator->add($a,$b);
        $this->assertEquals($expected, $res);
    }

    public function testMocking(){
           // Create a stub for the Calculator class.
           
        $calculator = $this->getMockBuilder(CalculatorService::class)
        ->getMock();

        // Configure the stub.
        $calculator->expects($this->any())
        ->method('add')
        ->will($this->returnValue(6))
        ;

        $res = $calculator->add(2,4);

        $this->assertEquals(6, $res);
    }

    // public function testupload_file_assert_exceptions(): void
    // {
    //             // // (1) boot the Symfony kernel
    //             // self::bootKernel();

    //             // // (2) use static::getContainer() to access the service container
    //             // $container = static::getContainer();
                
    //     $image = new ImageDto();
    //     // $this->expectException(FileException::class);
    //     // $image->file = new File(__DIR__.'/../uploads/forest.jpg');

    //     // $image->file = new File('/not_existsting_file.jpg');
    // }
}
