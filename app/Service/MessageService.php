<?php


namespace App\Service;

use App\Contracts\CustomeMessageInterface;
use Illuminate\Support\Facades\Session;

class MessageService implements CustomeMessageInterface
{
    public function flashMessage(string $type, string $message): void
    {
        $validType = ['success', 'error', 'wrong', 'info'];

        if (in_array($type, $validType)) {
            Session::flash($type, $message);
        } else {
            Session::flash('UnKnown', 'Invalid message type!' . implode(',', $validType));
        }
    }
}
