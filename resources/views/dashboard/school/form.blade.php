<x-app-layout :title=" $school->exists ? 'Editer une formation' : 'Ajouter une formation'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $school->exists ? 'Editer une formation' : 'Ajouter une formation' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route($school->exists ? 'dashboard.school.update' : 'dashboard.school.store', $school) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method($school->exists ? 'put' : 'post')
                        
                        <div class="space-y-6">
                            <x-input type="text" label="Titre" name="title" :value="$school->title"></x-input>
                            
                            <div class="grid grid-cols-2 gap-6">
                                <x-input type="text" label="Ecole" name="school" :value="$school->school"></x-input>
                                <x-input type="text" label="Ville" name="city" :value="$school->city"></x-input>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-6">
                                <x-input type="date" label="Date de début" name="start_date" :value="$school->start_date"></x-input>
                                <x-input type="date" label="Date de fin" name="end_date" :value="$school->end_date"></x-input>
                            </div>

                            <x-input type="textarea" label="Description" name="description" :value="$school->description"></x-input>
                        </div>
                        
                        <div class="mt-6 flex items-center justify-end">
                            <x-primary-button>
                                @if ($school->exists)
                                    Modifier
                                @else
                                    Créer
                                @endif
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
