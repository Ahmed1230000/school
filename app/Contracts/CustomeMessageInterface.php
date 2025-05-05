<?php

namespace App\Contracts;


interface CustomeMessageInterface
{
    public function flashMessage(string $type, string $message): void;
}
