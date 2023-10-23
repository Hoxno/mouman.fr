<!--====== SKILLS ======-->
<section class="py-8 md:pt-32 md:pb-12" id="skills">
    <h2 class="relative text-lg text-secondary mt-4 mb-8 text-center after:content-[''] after:absolute after:w-16 after:h-1 after:bg-secondary after:top-12 after:right-0 after:left-0 after:m-auto md:mb-12 md:after:w-20 md:after:top-12">
        Mes compétances
    </h2>
    <div class="gap-y-8 bd-grid md:gap-x-8">
            @foreach ($skills as $skill)
                @if ($skill->level == NULL)
                <h2 class="mb-4 font-bold">{{ $skill->title }}</h2>
                <p class="mb-8">
                    {!! nl2br($skill->description) !!}
                </p>
                @endif

            @endforeach
            <h2 class="mb-4 font-bold">Programmations</h2>
            <p class="mb-8">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates facere molestias explicabo praesentium labore. Eveniet perspiciatis, nostrum aut minima sunt quaerat dignissimos eligendi quas dicta perferendis veritatis. Quaerat, accusantium commodi.
            </p>
            @foreach ($skills as $skill)
                @if ($skill->level != NULL)
                <div class="flex justify-between items-center relative font-normal py-2 px-4 mb-8 rounded-lg shadow-4xl bg-[#fff]">
                    <div class="flex items-center">
                        <i class="fa-brands fa-{{ Str::lower($skill->title) }} mr-2 skills__icon__{{$skill->title}}"></i>
                        <span class="font-bold">{{ $skill->title }}</span>
                    </div>
                    <div>
                        <span class="font-bold">{{ $skill->level }}%</span>
                    </div>
                    <div class="absolute left-0 bottom-0 h-1 rounded-lg z-10 skill__{{ $skill->title }}" style="width: {{ $skill->level }}%" ></div>
                </div>
                @endif
            
            @endforeach
    </div>
</section>