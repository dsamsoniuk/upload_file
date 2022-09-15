<?php

namespace App\Command;

use App\Service\DropBoxService;
use App\Service\FileService;
use App\Service\ImageOptimizer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:upload-file',
    description: 'Upload file to local server',
)]
class UploadFileCommand extends Command
{
    /**
     * @var FileService $fileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'path file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * 
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io     = new SymfonyStyle($input, $output);
        $path   = $input->getArgument('path');

        if (!$path) {

            $io->warning(sprintf('Add path file as first argument' ));
            return Command::FAILURE;

        } else if (!file_exists($path)) {

            $io->warning(sprintf('File not exists.' ));
            return Command::FAILURE;
        }
        
        $file           = $this->fileService->copyFile($path, '/public/image/');

        $optimalizer    = new ImageOptimizer();
        $optimalizer->resize($file->getPathname());

        $dropBox        = new DropBoxService();
        $dropBox->uploadFile($file->getFilename(), $file->getContent(), 'image');

        $io->note(sprintf('Image uploaded successfully.' ));

        return Command::SUCCESS;
    }
}
