<section class="py-8 md:pt-32 md:pb-12" id="skills">
    <h2 class="relative text-lg text-secondary mt-4 mb-8 text-center after:content-[''] after:absolute after:w-16 after:h-1 after:bg-secondary after:top-12 after:right-0 after:left-0 after:m-auto md:mb-12 md:after:w-20 md:after:top-12">
        Mes compétences
    </h2>

    <div class="mx-auto my-auto max-w-5xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($skills as $skill)
            @if ($skill->level === null)
                <div>
                    <h2 class="text-lg text-primary font-semibold mb-2">{{ $skill->title }}</h2>
                    <p class="text-gray-600">{!! nl2br($skill->description) !!}</p>
                </div>
            @endif
        @endforeach

        <div class="lg:col-span-3"> <!-- Cette ligne prend trois colonnes sur grand écran -->
            <h2 class="text-lg text-primary font-semibold mb-2">Programmation</h2>
            <p class="text-gray-600">Description de compétences en programmation.</p>
        </div>

        @foreach ($skills as $skill)
            @if ($skill->level !== null)
                <div class="relative border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fa-brands fa-{{ Str::lower($skill->title) }} skills__icon__{{$skill->title}}"></i>
                            <span class="font-semibold">{{ $skill->title }}</span>
                        </div>
                        <span class="font-semibold">{{ $skill->level }}%</span>
                    </div>
                    <div class="h-2 bg-transparent mt-2 relative border border-primary rounded">
                        <div class="h-full skills__bar skills__{{$skill->title}}" style="width: {{ $skill->level }}%"></div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
