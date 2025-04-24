<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Session;

trait CustomMessage
{
    public function flashMessage(string $type, string $message)
    {
        $validType = ['success', 'error', 'warning', 'info'];

        if (in_array($type, $validType)) {
            Session::flash($type, $message);
        } else {
            Session::flash('error', 'Invalid message type!');
        }
    }
}
