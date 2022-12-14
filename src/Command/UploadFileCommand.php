<?php

namespace App\Command;

use App\Dto\ImageDto;
use App\Service\FileUpload\DropBox\DropBoxService;
use App\Service\UploadService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

#[AsCommand(
    name: 'app:upload-file',
    description: 'Upload file to local server',
)]
class UploadFileCommand extends Command
{

    public function __construct(
        private string $publicImageDir,
        private UploadService $uploadService,
        private DropBoxService $dropBoxService
    ){
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'path file');
        // $this->addOption('path', null, InputOption::VALUE_OPTIONAL, 'Limits the number of users listed', 50);

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
        $path   = $input->getArgument('path') ?: '';

        $image  = new ImageDto();
        $image->setFile(new File($path));

        $image->resize($this->publicImageDir);

        $this->uploadService->uploadImage($image, [
            $this->dropBoxService
        ]);

        $io->note(sprintf('Image uploaded successfully.' ));

        return Command::SUCCESS;
    }
}
