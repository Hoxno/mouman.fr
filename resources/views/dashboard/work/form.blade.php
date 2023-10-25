<x-app-layout :title="$work->exists ? 'Editer une expérience' : 'Ajouter une expérience'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $work->exists ? 'Editer une expérience' : 'Ajouter une expérience' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route($work->exists ? 'dashboard.work.update' : 'dashboard.work.store', $work) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method($work->exists ? 'put' : 'post')
                        
                        <div class="space-y-6">
                            <x-input type="text" label="Titre" name="title" :value="$work->title" required></x-input>
                            <div class="grid grid-cols-2 gap-6">
                                <x-input type="text" label="Entreprise" name="company" :value="$work->company"></x-input>
                                <x-input type="text" label="Ville" name="city" :value="$work->city"></x-input>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <x-input type="date" label="Date de début" name="start_date" :value="$work->start_date" required></x-input>
                                <x-input type="date" label="Date de fin" name="end_date" :value="$work->end_date" required></x-input>
                            </div>
                            <x-input type="textarea" label="Description" name="description" :value="$work->description" required></x-input>
                        </div>
                        
                        <div class="mt-6 flex items-center justify-end">
                            <x-primary-button>
                                @if ($work->exists)
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
