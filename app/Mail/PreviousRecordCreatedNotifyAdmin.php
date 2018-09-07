<?php

namespace App\Mail;

use App\PreviousRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @property PreviousRecord record
 */
class PreviousRecordCreatedNotifyAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PreviousRecord $record)
    {
        $this->record = $record;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $record = $this->record;

        return $this->subject('Попередній запис')->markdown('emails.claims.user_created_notify_admin', compact('record'));
    }
}
