<?php

namespace App\Validators;

use Illuminate\Validation\Rules\File;

class UserUploadValidator
{
    public function avatars(): array
    {
        return [
            'required',
            File::types(['png', 'jpg', 'jpeg', 'fit', 'gpx'])
                ->max(5 * 1024),
        ];
    }
}
