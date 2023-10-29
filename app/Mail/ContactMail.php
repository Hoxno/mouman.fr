<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Undocumented variable
     *
     * @var array < string> $data
     */
    public array $data;

    /**
     * Undocumented function
     *
     * @param array < string > $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build(): self
    {
        return $this
            ->from($this->data['email'], $this->data['firstname'] . ' ' . $this->data['lastname'])
            ->subject('Nouvelle demande de contact')
            ->markdown('emails.contact', ['data' => $this->data]);
    }
}