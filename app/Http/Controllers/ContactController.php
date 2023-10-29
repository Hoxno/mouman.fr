<?php

namespace App\Http\Controllers;


use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function contact(ContactRequest $request)
{
    // Validez la requête
    $validatedData = $request->validated();

    // Créez une instance de ContactMail en passant les données validées et l'adresse du destinataire
    $emailData = [
        'firstname' => $validatedData['firstname'],
        'lastname' => $validatedData['lastname'],
        'email' => $validatedData['email'],
        'subject' => $validatedData['subject'],
        'message' => $validatedData['message'],
    ];
    $contactMail = new ContactMail($emailData);

    // Envoyez l'e-mail en utilisant l'adresse e-mail du destinataire
    Mail::to('contact@mouman.fr')->send($contactMail);

    return back()->with('success', 'Votre message a bien été envoyé');
}
}
