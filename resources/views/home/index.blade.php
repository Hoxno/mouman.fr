<x-layout title="Accueil">
    @include('home.about')
    @if(count($skills) > 0)
        @include('home.skill')
    @endif
</x-layout>
