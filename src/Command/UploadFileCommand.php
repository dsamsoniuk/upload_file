<?php

namespace App\Command;

use App\Service\DropBoxUploadService;
use App\Service\ImageOptimizer;
use Spatie\Dropbox\Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsCommand(
    name: 'app:upload-file',
    description: 'Upload image',
)]
class UploadFileCommand extends Command
{

    private $projectDir;

    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir; // /var/www/upload_file
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('path', InputArgument::OPTIONAL, 'file path')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('path');
        // $aa = __DIR__; // "/var/www/upload_file/src/Command"

        $pa = $this->projectDir.'/green.jpg';
        $de = $this->projectDir.'/public/image';

        $file = new File($pa);
        $ext = $file->guessExtension();
        // $name = $file->getName();

        $fs = new Filesystem();
        $newFile = $de.'/aaa.'.$ext;
        $fs->copy($pa, $newFile);

        $miniFile = new File($newFile);
        $content = $miniFile->getContent();

        // $fileInfo = $file->getFileInfo();
        // $file->copy($de);
        // $uploadFile = new UploadedFile($pa, 'green.jpg');
        // $uploadFile->move('/var/www/upload_file/public/image/');
        // $optimalizer = new ImageOptimizer();
        // $optimalizer->resize($newFile);
        $dropBox = new DropBoxUploadService();
        $dropBox->uploadFile('greeeeen.jpg', $content, 'image');


        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
