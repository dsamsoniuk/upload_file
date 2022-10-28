<?php
namespace App\Service\FileUpload\DropBox;

use App\Service\FileUpload\DropBox\Exception\DropBoxException;
use App\Service\FileUpload\FileUploadInterface;
use Psr\Log\LoggerInterface;
use Spatie\Dropbox\Client;
use Symfony\Component\HttpFoundation\File\File;


/**
 * DropBox service
 * lib integration: https://github.com/spatie/dropbox-api
 */
class DropBoxService implements FileUploadInterface
{

    private $files = [];
    private ?Client $client;
    // private const AUTH_TOKEN = '';
    // = 'sl.BPRAEDNxf88ucNkJ9YQewkP-ihMdp2VTZ4Twk6E3mYMXMKnsys0vZk4FCQpqDtRTnWu3qI6EksSrnJkxo4oM0IQlIk83lukdpQ0hFeJ-P59jcRLpgxadUpVtY84hh3mBVMq9R2r-gTA';

    public function __construct(
        private string $apiTokenDropBox, 
        private string $path = '/'
        )
    {
        $this->client = new Client($apiTokenDropBox);
        $this->path = $path;
    }

    public function addFile(File $file) : void {
        $this->files[] = $file;
    }

    /**
     * @param File $file
     * @param string|null $target
     * 
     * @return [type]
     */
    public function upload() {
        foreach ($this->files as $file) {
            $target = $this->path.$file->getFilename();
            $res    = $this->client->upload($target, $file->getContent());
            if ($res === false) {
                throw new DropBoxException();
            }
        }

        return true;
    }

}