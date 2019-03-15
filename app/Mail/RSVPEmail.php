<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RSVPEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rsvp)
    {
        //
		$this->rsvp = $rsvp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sender@example.com')
                    ->view('mails.rsvpconfirmation')
                    ->text('mails.rsvpconfirmation_plain')
                    ->with([
						'receiver' => 'Guest',
						'sender' => 'Host',
					]);
    }
}
