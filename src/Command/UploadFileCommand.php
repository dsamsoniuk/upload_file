<?php

namespace App\Command;

use App\Service\UploadService;
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

    public function __construct(private UploadService $uploadService, )
    {
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

        $this->uploadService->uploadImage($path);

        $io->note(sprintf('Image uploaded successfully.' ));

        return Command::SUCCESS;
    }
}
