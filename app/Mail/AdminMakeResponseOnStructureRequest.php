<?php

namespace App\Mail;

use App\StructureRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @property StructureRequest entity
 */
class AdminMakeResponseOnStructureRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param StructureRequest $entity
     */
    public function __construct(StructureRequest $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $entity = $this->entity;

        return $this->subject('Ваш запит розглянуто')->markdown('emails.structure_requests.admin_make_response', compact('entity'));
    }
}
