<!-- ===== WORK =====-->
<section class="py-8 md:pt-32 md:pb-12" id="work">
    <h2 class="relative text-lg text-secondary mt-4 mb-8 text-center after:content-[''] after:absolute after:w-16 after:h-1 after:bg-secondary after:top-12 after:right-0 after:left-0 after:m-auto md:mb-12 md:after:w-20 md:after:top-12">
        Expériences
    </h2>

    <div class="relative bd-grid px-4">
        @foreach ($works as $work)
            <div class="mb-10">
                <h2 class="text-secondary text-xl font-semibold mr-2
             before:content-[''] before:block before:absolute before:w-3 before:h-3 before:border before:border-1 before:border-solid before:border-primary before:bg-secondary before:rounded-full before:left-0 before:z-10 before:mt-1
            after:content-[' '] after:block after:absolute after:w-1 after:h-full after:top-1 after:bg-secondary after:left-[5px]">
                @if ($work->end_date == NULL or $work->end_date == '1900-01-01')
                    Depuis le {{ Carbon\Carbon::parse($work->start_date)->format( 'j/m/Y' ) }} : {{ $work->title }}
                @else
                    De {{ Carbon\Carbon::parse($work->start_date)->format( 'j/m/Y' ) }} au {{ Carbon\Carbon::parse($work->end_date)->format( 'j/m/Y' ) }}
                @endif
            </h2>
            <div class="flex items-center mb-2">
                <i class="fa fa-building mr-2 text-base text-primary"></i>
                {{ $work->company }} à {{ $work->city }}
            </div>
            <p class="text-gray-600">{!! nl2br($work->description) !!}</p>
            </div>
            
        @endforeach
    </div>
</section>