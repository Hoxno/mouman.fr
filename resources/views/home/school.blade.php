<!-- ===== SCHOOL =====-->
<section class="py-8 md:pt-32 md:pb-12" id="work">
    <h2 class="relative text-secondary mt-4 mb-8 text-center after:content-[''] after:absolute after:w-16 after:h-1 after:bg-secondary after:top-12 after:right-0 after:left-1 after:m-auto md:mb-12 md:after:w-20 md:after:top-12">
        Formation
    </h2>

    <div class="relative ml-3.5 pl-6 pb-3.5 bd-grid">
        @foreach ($schools as $school)
        <h2 
        class="text-secondary before:content-[' '] before:block before:absolute before:w-3.5 before:h-3.5 before:bg-secondary before:rounded-full before:left-0 before:z-1 before:top-1 after:content-[' '] after:block after:absolute after:w-1 after:h-full after:top-1 after:bg-secondary after:left-[5px]"
    >
            @if ($school->end_date == NULL or $school->end_date == '1900-01-01')
                Depuis le {{ Carbon\Carbon::parse($school->start_date)->format( 'j/m/Y' ) }} : {{ $school->title }}
            @else
                De {{ Carbon\Carbon::parse($school->start_date)->format( 'j/m/Y' ) }} au {{ Carbon\Carbon::parse($school->end_date)->format( 'j/m/Y' ) }}
            @endif
        </h2>
        <h3 class="mb-2">
            <i class="fa fa-school mr-[5px] text-base"></i>
            {{ $school->school }} à {{ $school->city }}
        </h3>
        <p class="mb-4">
            {!! nl2br($school->description) !!}
        </p>
        @endforeach
    </div>
</section>