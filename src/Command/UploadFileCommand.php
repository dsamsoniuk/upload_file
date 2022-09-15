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
use Symfony\Component\HttpFoundation\File\File;

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

    /**
     * @var DropBoxService $dropBoxService
     */
    private $dropBoxService;

    /**
     * @var ImageOptimizer $imageOptimizer
     */
    private $imageOptimizer;

    public function __construct(
        FileService $fileService, 
        DropBoxService $dropBoxService,
        ImageOptimizer $imageOptimizer
        )
    {
        $this->fileService = $fileService;
        $this->dropBoxService = $dropBoxService;
        $this->imageOptimizer = $imageOptimizer;
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

        $file = new File($path);
        $file = $this->fileService->copyFile($file, '/public/image/');

        $this->imageOptimizer->resize($file->getPathname());
        $this->dropBoxService->uploadFile($file->getFilename(), $file->getContent(), 'image');

        $io->note(sprintf('Image uploaded successfully.' ));

        return Command::SUCCESS;
    }
}
