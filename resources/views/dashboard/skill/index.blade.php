<x-app-layout :title="'Mes compétences'">
    @section('title', 'Mes compétences')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash></x-flash>
            <div class="bg-white border border-gray-200 shadow-md shadow-black/3 p-6 rounded-md dark:bg-dark__body">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">
                        <x-primary-button>
                            <a href="{{ route('dashboard.skill.create') }}">Ajouter une compétance</a>
                        </x-primary-button>
                    </div>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="overflow-hidden">
                        <!-- Livewire component rendering -->
                        <livewire:skill-table />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>