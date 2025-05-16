<?php

namespace App\Listeners;

use App\Events\NewStudentEvent;
use App\Notifications\NewStudentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NewStudentListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handleNewStudent(NewStudentEvent $event): void
    {
        $user = Auth::user();
        Notification::send($user, new NewStudentNotification($event->student->full_name, $event->student->email));
    }
    public function subscribe(Dispatcher $events): array
    {
        return [
            NewStudentEvent::class => 'handleNewStudent',
        ];
    }
}
