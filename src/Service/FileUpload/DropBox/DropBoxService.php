<?php
namespace App\Service\FileUpload\DropBox;

use App\Service\FileUpload\FileUploadInterface;
use Spatie\Dropbox\Client;
use Symfony\Component\HttpFoundation\File\File;


/**
 * DropBox service
 * lib integration: https://github.com/spatie/dropbox-api
 */
class DropBoxService implements FileUploadInterface
{
    private ?Client $client;
    // private const AUTH_TOKEN = '';
    // = 'sl.BPRAEDNxf88ucNkJ9YQewkP-ihMdp2VTZ4Twk6E3mYMXMKnsys0vZk4FCQpqDtRTnWu3qI6EksSrnJkxo4oM0IQlIk83lukdpQ0hFeJ-P59jcRLpgxadUpVtY84hh3mBVMq9R2r-gTA';

    public function __construct(string $apiTokenDropBox)
    {
        $this->client = new Client($apiTokenDropBox);
    }

    /**
     * @param File $file
     * @param string|null $target
     * 
     * @return [type]
     */
    public function upload(File $file, ?string $target) {
        $target = $target ? $target : '/'.$file->getFilename();
        // to do catch exceptions
        $this->client->upload($target, $file->getContent());
    }

}