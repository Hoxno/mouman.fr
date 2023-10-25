<section class="py-8 md:pt-32 md:pb-12" id="contact">
    <h2 class="relative text-lg text-secondary mt-4 mb-8 text-center after:content-[''] after:absolute after:w-16 after:h-1 after:bg-secondary after:top-12 after:right-0 after:left-0 after:m-auto md:mb-12 md:after:w-20 md:after:top-12">
        Me contacter
    </h2>
    <div class="gap-y-8 bd-grid md:gap-x-8">
        <form action="{{ route('contact') }}" method="POST">
            @csrf
        
            <x-input label="Nom : " type="text" id="lastname" name="lastname" :value="null" />
            <x-input label="Prénom : " type="text" id="firstname" name="firstname" :value="null" />
            <x-input label="Sujet" type="text" id="subject" name="subject" :value="null" />
            <x-input label="Adresse e-mail : " type="email" id="email" name="email" :value="null" />
            <x-input type="textarea" label="Message : " id="message" name="message" :value="null" />
        
            <div class="mt-6 flex items-center justify-end space-x-6">
                <x-primary-button>{{ __('Envoyer') }}</x-primary-button>
            </div>
        </form>
        
    </div>
</section>
