<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use Mail;

class SendMailListener
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
     *
     * @param  SendMailEvent $event
     * @return void
     */
    public function handle(SendMailEvent $event)
    {
        \Log::addInfo("Email Sent", array(
            "to" => $event->getTo(),
            "subject" => $event->getSubject(),
            "isRaw" => $event->isRaw(),
            "raw_message" => $event->getRawMessage(),
            "view_name" => $event->getViewName(),
            "view_data" => $event->getViewData()
        ));

        if ($event->isRaw()) {
            Mail::raw($event->getRawMessage(), function ($msg) use ($event) {
                $msg->subject($event->getSubject());
                $msg->to($event->getTo());
            });
        } else {
            Mail::send($event->getViewName(), $event->getViewData(), function ($msg) use ($event) {
                $msg->subject($event->getSubject());
                $msg->to($event->getTo());
            });
        }

    }
}
