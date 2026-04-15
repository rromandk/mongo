<?php

namespace App\Services;

use Aws\S3\S3Client;

class S3Service
{
    protected $client;

    public function __construct()
    {
        $this->client = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'endpoint' => config('filesystems.disks.s3.endpoint'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);
    }

    public function upload($path, $file)
    {
        return $this->client->putObject([
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $path,
            'Body' => fopen($file, 'r'),
        ]);
    }
}