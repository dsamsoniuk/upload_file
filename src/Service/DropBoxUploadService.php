<?php
namespace App\Service;

use Spatie\Dropbox\Client;

/**
 * drop box
 * lib integration: https://github.com/spatie/dropbox-api
 */
class DropBoxUploadService
{
    private const AUTH_TOKEN = 'sl.BPRAEDNxf88ucNkJ9YQewkP-ihMdp2VTZ4Twk6E3mYMXMKnsys0vZk4FCQpqDtRTnWu3qI6EksSrnJkxo4oM0IQlIk83lukdpQ0hFeJ-P59jcRLpgxadUpVtY84hh3mBVMq9R2r-gTA';

    public function getAuth(){
        return new Client(self::AUTH_TOKEN);
    }

    public function uploadFile(string $fileName, $content, string $destinyDir = '/') : void {

        $client = $this->getAuth();
        $list =  $client->getAccountInfo();
        $aa =1;
        // $client->createFolder('image');
        // $client->upload($destinyDir.'/aaa.jpg', 'image');

        $client->upload($destinyDir.'/'.$fileName, $content);

    }

}