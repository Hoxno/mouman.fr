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

        // Créez une instance de ContactMail en passant les données validées
        $emailData = [
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ];
        $contactMail = new ContactMail($emailData);

        // Envoyez l'e-mail
        Mail::to('admin@doe.fr')->send($contactMail);

        return back()->with('success', 'Votre message a bien été envoyé');
    }
}
