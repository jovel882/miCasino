<?php

namespace App\Listeners;

use App\Services\SendEmail as ServicesSendEmail;

class SendEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(public ServicesSendEmail $sendEmail)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        ($this->sendEmail)($event->data);
    }
}
