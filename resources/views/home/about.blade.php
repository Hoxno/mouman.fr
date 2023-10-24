<!--====== ABOUT ======-->
<section class="inline-block w-full h-full bg-primary py-24 clip-path-mypolygon" id="about">
    @foreach ($users as $user)
    <div class="bd-grid grid md:grid-cols-2 md:text-left md:items-center text-center">
        <div class=" justify-self-center w-64 h-64 md:w-80 md:h-80 border border-white  border-solid rounded-full">
            <img 
            src="{{ str_starts_with($user->image, 'http') ? $user->image : asset('storage/' . $user->image) }}" 
            alt="" 
            class="md:inline-block w-64 h-64 p-1 rounded-full border-0 md:w-80 md:h-80">
        </div>
        <div>
            <h2 class="mb-4 text-secondary font-bold text-xl">{{ $user->jobtitle }}</h2>
            <p class="text-[#fff]">{{ $user->about }}</p>
            <a href="{{ asset('storage/' . $user->pdf_file) }}" download class="inline-block bg-secondary text-[#fff] px-11 py-3 rounded-lg border-0 mt-4">Télécharger mon CV</a>
        </div>
    </div>
    @endforeach
    
</section>