<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view if no user exists.
     */
    public function create(): View|RedirectResponse
    {
        if (User::count() > 0) {
            // S'il y a dÃ©jÃ  un utilisateur enregistrÃ©, redirigez-le vers une autre vue (par exemple, la page d'accueil).
            return redirect(route('index'));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // VÃ©rifiez Ã  nouveau s'il y a dÃ©jÃ  un utilisateur enregistrÃ©.
        if (User::count() > 0) {
            // S'il y a dÃ©jÃ  un utilisateur enregistrÃ©, redirigez-le vers une autre vue (par exemple, la page d'accueil).
            return redirect(route('index'));
        }

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index'));
    }
}
