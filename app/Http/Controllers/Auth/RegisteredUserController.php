<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view if no user exists.
     */
    public function create(): View|RedirectResponse
    {
        if (User::count() > 0) {
            // S'il y a déjà un utilisateur enregistré, redirigez-le vers une autre vue (par exemple, la page d'accueil).
            return redirect(RouteServiceProvider::HOME);
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Vérifiez à nouveau s'il y a déjà un utilisateur enregistré.
        if (User::count() > 0) {
            // S'il y a déjà un utilisateur enregistré, redirigez-le vers une autre vue (par exemple, la page d'accueil).
            return redirect(RouteServiceProvider::HOME);
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

        return redirect(RouteServiceProvider::HOME);
    }
}
