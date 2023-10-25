<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
{
    return $this
        ->from('votre@adresse-email.com', 'Votre Nom') // Adresse e-mail et nom de l'expéditeur
        ->to('admin@doe.fr') // Adresse du destinataire
        ->subject('Contact Mail') // Sujet de l'e-mail
        ->markdown('emails.contact', ['data' => $this->data]); // Vue Markdown pour le contenu de l'e-mail
}
}