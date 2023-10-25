<section class="py-4 md:pt-16 md:pb-8" id="contact">
    <h2 class="relative text-lg text-secondary mt-4 mb-4 text-center after:content-[''] after:absolute after:w-12 after:h-1 after:bg-secondary after:top-10 after:right-0 after:left-0 after:m-auto md:mb-8 md:after:w-16 md:after:top-10">
        Me contacter
    </h2>
    <form action="{{ route('contact') }}" method="POST" class="mx-auto my-auto max-w-5xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 md:gap-x-4">
            <div class="md:col-span-1">
                <x-input label="Nom : " type="text" id="lastname" name="lastname" :value="null" />
                <x-input label="Prénom : " type="text" id="firstname" name="firstname" :value="null" />
                <x-input label="Sujet" type="text" id="subject" name="subject" :value="null" />
                <x-input label="Adresse e-mail : " type="email" id="email" name="email" :value="null" />
            </div>
            <div class="md:col-span-1">
                <x-input type="textarea" label="Message : " id="message" name="message" :value="null" />
                <div class="mt-6 text-center">
                    <button class="inline-block bg-primary text-white px-6 py-3 rounded-full border-2 border-primary hover:bg-white hover:text-primary hover:border-primary hover:border-2 transition duration-300">{{ __('Envoyer') }}</button>
                </div>
            </div>
        </div>
    </form>
</section>
