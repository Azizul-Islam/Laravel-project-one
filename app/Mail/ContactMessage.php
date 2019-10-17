<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $first_name_send = "";
     public $message_send = "";

    public function __construct($first_name, $message)
    {
      $this->first_name_send =$first_name;
      $this->message_send = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/contactmessage', compact('first_name_send', 'message_send'));
    }
}
