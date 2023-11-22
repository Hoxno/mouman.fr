<section class="inline-block w-full h-full bg-primary py-24 clip-path-mypolygon dark:bg-[#0A2647] dark:text-white" id="about">
    @foreach ($users as $user)
    <div class="mx-auto my-auto max-w-5xl grid md:grid-cols-2 md:text-left md:items-center text-center">
        <div class="justify-self-center w-64 h-64 md:w-[320px] md:h-[312px] border border-white border-solid rounded-full dark:border-gray-300" id="about__img">
            <img src="{{ str_starts_with($user->image, 'http') ? $user->image : asset('storage/' . $user->image) }}" alt="" class="md:inline-block w-64 h-64 p-1 rounded-full border-0 md:w-[320px] md:h-[310px] dark:filter dark:brightness-75 dark:grayscale">
        </div>
    
        <div>
            <h2 class="mb-4 text-secondary font-bold text-xl dark:text-white" id="about__title">{{ $user->jobtitle }}</h2>
            <p class="text-[#fff] dark:text-gray-300" id="about__description">{{ $user->about }}</p>
            <a href="{{ asset('storage/' . $user->pdf_file) }}" download class="inline-block bg-secondary text-[#fff] dark:text-gray-300 px-11 py-3 rounded-lg border-0 mt-4">Télécharger mon CV</a>
        </div>
    </div>
    @endforeach
</section>