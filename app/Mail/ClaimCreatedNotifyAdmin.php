<?php

namespace App\Mail;

use App\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClaimCreatedNotifyAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $claim = $this->claim;

        return $this->markdown('emails.claims.user_created_notify_admin', compact('claim'));
    }
}
