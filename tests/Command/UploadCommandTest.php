<?php

namespace App\Tests\Command;

use App\Command\UploadFileCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Spatie\Dropbox\Exceptions\BadRequest;

class UploadCommandTest extends KernelTestCase {

    protected function setUp(): void
    {
        self::bootKernel();

        // this uses a special testing container that allows you to fetch private services
        $command = static::getContainer()->get(UploadFileCommand::class);
        $command->setApplication(new Application(self::$kernel));

        $this->commandTester = new CommandTester($command);
    }

    public function testInputEmpty(){
        $this->expectException(FileNotFoundException::class);

        $this->commandTester->setInputs([]);
        $this->commandTester->execute(['path' => 'not_exist.jpg']);
        // $this->expectException(BadRequest::class);
        // $$this->commandTester->execute(['path' => './green.jpg']);
    }

    public function testInputExistFile(){
        $this->expectException(BadRequest::class);

        $this->commandTester->setInputs([]);
        $this->commandTester->execute(['path' => './green.jpg']);

    }
}