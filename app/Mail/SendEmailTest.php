<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;

    public $userData; // Define a public property to hold the data

    /**
     * Create a new message instance.
     */
    public function __construct($userData)
    {
        $this->userData = $userData; // Assign the passed data to the property
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from  AtoZ store')
            ->view('emails.test')
            ->with(['bill' => $this->userData]); // Pass the data to the view
    }
}
