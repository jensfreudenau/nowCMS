<?php

namespace App\Services;

use App\Http\DTO\File;
use App\Services\Interfaces\UploadServiceContract;
use GuzzleHttp\Psr7\UploadedFile;

class UploadService implements UploadServiceContract
{
    public function __construct(
        private readonly UploadContract $avatar,
    ) {}

    public function avatar(UploadedFile $file): File
    {
        return $this->avatar->handle(
            file: $file,
        );
    }


}
