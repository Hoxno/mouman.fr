<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form  class="" action="{{ route($work->exists ? 'dashboard.skill.update' : 'dashboard.skill.store', $work) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method($work->exists ? 'put' : 'post')
                
                        <div class="space-y-12">
                            <div class=" border-gray-900/10 pb-12">
                                <h1 class="text-base font-semibold leading-7 text-gray-900">
                                    {{ $work->exists ? "Editer une expérience" : "Ajouter une expérience" }}
                                </h1>
                                <p class="mt-1 text-sm leading-6 text-gray-600">

                                </p>
                                <div class="mt-10 space-y-8 md:w-2/3 w-full">
                                    <x-input class="col" name="title" label="Titre" :value="$work->title"></x-input>
                                    <div class="w-1/2">
                                        <x-input class="col" name="company" label="Enreprise" :value="$work->company"></x-input>
                                        <x-input class="col" name="start_date" label="Date de début" :value="$work->start_date"></x-input>
                                        <x-input class="col" name="end_date" label="Date de fin" :value="$work->end_date"></x-input>
                                    </div>
                                </div>
                                <x-input type="textarea" label="Description" name="description" :value="$work->description"></x-input>
                        
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                @if ($work->exists)
                                    Modifier
                                @else
                                    Créer
                                @endif
                            </button>
                        </div>
            </div>
        </div>
    </div>
</x-app-layout>