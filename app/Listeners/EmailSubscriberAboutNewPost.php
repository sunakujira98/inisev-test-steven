<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\NewPostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailSubscriberAboutNewPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        foreach ($event->newsletter as $newsletter) {
            Mail::to($newsletter->user->email)->send(new NewPostAdded($event->title, $event->content));
        }
    }
}
