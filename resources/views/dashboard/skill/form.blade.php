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
                    <form class="w-full" action="{{ route($skill->exists ? 'dashboard.skill.update' : 'dashboard.skill.store', $skill) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method($skill->exists ? 'put' : 'post')

                        <div class="space-y-6">
                            <div class="border-t border-gray-200 pt-6">
                                <h1 class="text-xl font-semibold text-gray-900">
                                    {{ $skill->exists ? "Éditer une compétence" : "Ajouter une compétence" }}
                                </h1>
                                <p class="mt-2 text-gray-600 text-sm">
                                    {{-- Votre texte ici --}}
                                </p>
                            </div>
                            <div class="flex space-x-6">
                                <div class="w-1/2 space-y-4">
                                    <x-input name="title" label="Titre" :type="'text'" :value="$skill->title" />
                                    <x-input name="level" label="Niveau" :type="'text'" :value="$skill->level" />
                                    <x-input name="order" label="Ordre" :type="'text'" :value="$skill->order" />
                                </div>
                                <div class="w-1/2 space-y-4">
                                    <x-input name="description" label="Description" :type="'textarea'" :value="$skill->description" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end space-x-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                @if ($skill->exists)
                                    Modifier
                                @else
                                    Créer
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
