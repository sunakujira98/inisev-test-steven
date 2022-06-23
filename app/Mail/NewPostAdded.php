<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostAdded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $title;
    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-post-added')->with([
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}
