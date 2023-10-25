<x-layout title="Accueil">
    @include('home.about')
    @if(count($skills) > 0)
        @include('home.skill')
    @endif
    @if (count($works) > 0)
        @include('home.work')
    @endif
    @if (count($schools) > 0)
        @include('home.school')
    @endif
    @include('home.contact')
</x-layout>
