<?php

namespace App\DTO;

readonly class File
{
    public function __construct(
        public string      $name,
        public string      $originalName,
        public string      $mime,
        public string      $path,
        public string      $disk,
        public string      $hash,
        public null|string $collection = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'file_name' => $this->originalName,
            'mime_type' => $this->mime,
            'path' => $this->path,
            'disk' => $this->disk,
            'file_hash' => $this->hash,
            'collection' => $this->collection,
        ];
    }
}
