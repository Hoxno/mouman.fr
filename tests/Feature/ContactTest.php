<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mail::fake();
});

function donneesContact(array $remplacements = []): array
{
    return array_merge([
        'firstname' => 'Jean',
        'lastname' => 'Dupont',
        'email' => 'jean.dupont@example.com',
        'subject' => 'Une demande',
        'message' => 'Bonjour, je vous contacte au sujet de votre profil.',
    ], $remplacements);
}

it('envoie un mail lorsque le formulaire est valide', function () {
    post('/contact', donneesContact())
        ->assertRedirect()
        ->assertSessionHas('success');

    Mail::assertSent(ContactMail::class, function (ContactMail $mail) {
        return $mail->hasTo('contact@mouman.fr')
            && $mail->data['email'] === 'jean.dupont@example.com'
            && $mail->data['firstname'] === 'Jean';
    });
});

it('refuse une soumission vide sans envoyer de mail', function () {
    post('/contact', [])
        ->assertSessionHasErrors(['firstname', 'lastname', 'email', 'subject', 'message']);

    Mail::assertNothingSent();
});

it('refuse une adresse email invalide', function () {
    post('/contact', donneesContact(['email' => 'pas-une-adresse']))
        ->assertSessionHasErrors('email');

    Mail::assertNothingSent();
});

it('refuse un prenom trop court', function () {
    post('/contact', donneesContact(['firstname' => 'A']))
        ->assertSessionHasErrors('firstname');

    Mail::assertNothingSent();
});

it('bloque au dela de cinq soumissions par minute', function () {
    foreach (range(1, 5) as $i) {
        post('/contact', donneesContact())->assertRedirect();
    }

    post('/contact', donneesContact())->assertStatus(429);

    Mail::assertSentCount(5);
});
