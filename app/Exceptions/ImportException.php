<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ImportException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report(): void
    {
        Log::error('Image not created');
    }
}
