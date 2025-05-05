<?php


namespace App\Contracts;

interface LogErrorInterface
{
    public function logError(string $message, $context = []);
}
