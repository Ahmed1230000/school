<?php

namespace App\Service;

use App\Contracts\LogErrorInterface;
use Illuminate\Support\Facades\Log;

class LogErrorService implements LogErrorInterface
{
    public function logError(string $message, $context = [])
    {
        Log::error($message, $context);
    }
}
