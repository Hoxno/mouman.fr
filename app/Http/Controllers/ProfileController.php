<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    private function isValidImage(UploadedFile $image) :bool
    {
        $validExtensions = ['jpeg', 'jpg', 'png', 'gif'];
        $maxSize = 2048; // Taille maximale en kilo-octets (ici, 2 Mo).

        // Vérifier si le fichier est une image valide en fonction de l'extension et de la taille.
        return $image->isValid() &&
           in_array($image->getClientOriginalExtension(), $validExtensions) &&
           $image->getSize() <= $maxSize * 1024;
    }

    private function isValidPdf(UploadedFile $pdfFile) :bool
    {
        $validExtensions = ['pdf'];
        $maxSize = 2048; // Taille maximale en kilo-octets (ici, 2 Mo).

        // Vérifier si le fichier est un PDF valide en fonction de l'extension et de la taille.
        return $pdfFile->isValid() &&
           in_array($pdfFile->getClientOriginalExtension(), $validExtensions) &&
           $pdfFile->getSize() <= $maxSize * 1024;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Gérer l'image
    if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Vérifier si l'image est valide
        if (!$this->isValidImage($image)) {
            return back()->with('error', 'Le fichier n\'est pas une image valide.');
        }

        // Stocker l'image
        $imagePath = $image->store('images', 'public');

        
        // Mettre à jour l'utilisateur avec le chemin de l'image et du fichier pdf
        $user = $request->user();
        $user->image = $imagePath;
        $user->save();
    }

    // Gérer le fichier PDF
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        if (!$this->isValidPdf($pdfFile)) {
            return back()->with('error', 'Le fichier n\'est pas un PDF valide.');
        }
        // Code pour stocker le fichier PDF (à personnaliser en fonction de votre application).
        // Par exemple :
        $pdfPath = $pdfFile->store('pdfs', 'public');
        // Mettez à jour l'utilisateur avec le chemin du fichier PDF
        $user = $request->user();
        $user->pdf_file = $pdfPath;
        $user->save();
    }

    

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
