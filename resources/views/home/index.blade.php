<x-layout title="Accueil">
    @include('home.about')
    @if(count($skills) > 0)
        @include('home.skill')
    @endif
    @if (count($works) > 0)
        @include('home.work')
    @endif
</x-layout>
