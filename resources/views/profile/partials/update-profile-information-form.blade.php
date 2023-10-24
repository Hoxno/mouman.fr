<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mise à jour des informations du profil.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex space-x-4">
            <div class="w-1/2">
                <x-input :name="'firstname'" :label="'Prénom'" :type="'text'" :value="old('firstname', $user->firstname)" :required="true" :autofocus="true" :autocomplete="'firstname'" :errors="$errors->get('firstname')" />
            </div>
            <div class="w-1/2">
                <x-input :name="'lastname'" :label="'Nom'" :type="'text'" :value="old('lastname', $user->lastname)" :required="true" :autofocus="true" :autocomplete="'lastname'" :errors="$errors->get('lastname')" />
            </div>
        </div>
        <x-input :name="'jobtitle'" :label="'Métier'" :type="'text'" :value="old('jobtitle', $user->jobtitle)" :required="true" :autofocus="true" :autocomplete="'jobtitle'" :errors="$errors->get('jobtitle')" />

        <x-input :name="'about'" :label="'A propos'" :type="'textarea'" :value="$user->about" :errors="$errors->get('about')" />

        <!-- Afficher l'aperçu de l'image actuelle -->
        @if ($user->image)
            <div class="mt-6">
                <p class="text-lg font-semibold text-gray-700">Photo actuelle :</p>
                <div class="mt-3 flex items-center">
                    <img class="w-24 h-24 rounded-full object-cover" src="{{ asset('storage/' . $user->image) }}" alt="Image actuelle">
                </div>
            </div>
        @endif
        <x-input :name="'image'" :label="'Photo de profile'" :type="'file'" :value="$user->image" :errors="$errors->get('image')" />

        <div>
            <x-input :name="'pdf_file'" :label="'Upload du CV'" :type="'file'" :value="old('pdf_file', $user->pdf_file)" :required="true" :autofocus="true" :autocomplete="'pdf_file'" :errors="$errors->get('pdf_file')" />
            @if ($user->pdf_file)
                <p>Fichier PDF actuel : <a href="{{ asset('storage/' . $user->pdf_file) }}" download class="inline-block bg-gray-800 text-[#fff] px-4 py-2 rounded-lg border-0 mt-4">Télécharger le PDF actuel</a></p>
            @endif
        </div>

        <x-input :name="'email'" :label="'Email'" :type="'email'" :value="old('email', $user->email)" :required="true" :autocomplete="'username'" :errors="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}
    
                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sauvegarder.') }}</p>
            @endif
        </div>
    </form>
</section>
