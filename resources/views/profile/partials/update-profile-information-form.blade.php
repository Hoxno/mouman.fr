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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="firstname" :value="__('Prénom')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Nom')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->lastname)" required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>
        <div>
            <x-input-label for="jobtitle" :value="__('Métier')" />
            <x-text-input id="jobtitle" name="jobtitle" type="text" class="mt-1 block w-full" :value="old('jobtitle', $user->jobtitle)" required autofocus autocomplete="jobtitle" />
            <x-input-error class="mt-2" :messages="$errors->get('jobtitle')" />
        </div>

        <div>
            <x-input id="about" name="A propos" type="textarea" class="mt-1 block w-full" :value="old('about', $user->about)" required autofocus autocomplete="about" />
            <x-input-error class="mt-2" :messages="$errors->get('about')" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Image de profile')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" :value="old('image', $user->image)" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div>
            <x-input-label for="doc" :value="__('Upload du CV')" />
            <x-text-input id="doc" name="doc" type="file" class="mt-1 block w-full" :value="old('doc', $user->doc)" required autofocus autocomplete="doc" />
            <x-input-error class="mt-2" :messages="$errors->get('doc')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

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
        </div>

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
