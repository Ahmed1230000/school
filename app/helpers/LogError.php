<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Log;

trait LogError
{
    public function logError(string $message, $context = [])
    {
        Log::error($message, $context);
    }
}
