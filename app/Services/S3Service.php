<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 24/8/19
 * Time: 1:31 PM
 */

namespace App\Services;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class S3Service {

    public static function getRelativeURL($nameSpace) {
        return $nameSpace;
    }

    public static function getFullURL($nameSpace) {
        $baseURL = Config::get('filesystems.disks.s3.url');

        return $baseURL . '/' . self::getRelativeURL($nameSpace);
    }

    public function getPreSignedUrl($fileName) {
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();

        $command = $client->getCommand('PutObject', [
            'Bucket'       => Config::get('filesystems.disks.s3.bucket'),
            'Key'          => self::getRelativeURL($fileName),
            'ACL'          => 'public-read',
            'Content-Type' => 'application/pdf'
        ]);

        $request = $client->createPresignedRequest($command, '+10 minute');

        $url = (string)$request->getUri();

        return $url;
    }

    public function deleteSynopsis($path) {

        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
    }
}
