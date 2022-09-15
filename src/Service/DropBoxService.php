<?php
namespace App\Service;

use Spatie\Dropbox\Client;

/**
 * DropBox service
 * lib integration: https://github.com/spatie/dropbox-api
 */
class DropBoxService
{
    private const AUTH_TOKEN = 'sl.BPRAEDNxf88ucNkJ9YQewkP-ihMdp2VTZ4Twk6E3mYMXMKnsys0vZk4FCQpqDtRTnWu3qI6EksSrnJkxo4oM0IQlIk83lukdpQ0hFeJ-P59jcRLpgxadUpVtY84hh3mBVMq9R2r-gTA';

    /**
     * @return Client
     */
    public function getClient() : Client {
        return new Client(self::AUTH_TOKEN);
    }
    /**
     * @param string $fileName
     * @param mixed $content
     * @param string $destinyDir
     * 
     * @return void
     */
    public function uploadFile(string $fileName, $content, string $destinyDir = '/') : void {
        $client = $this->getClient();
        $client->upload($destinyDir.'/'.$fileName, $content);
    }

}