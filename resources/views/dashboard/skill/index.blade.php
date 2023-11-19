<x-app-layout :title="'Mes compétences'">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight md:mt-16">
                {{ __('Dashboard > Mon CV > Mes compétences') }}
            </h2>
            <button wire:click="create" class="mt-6 md:mt-16 py-2.5 px-7 border-2 cursor-pointer hover:bg-[#111827] hover:text-[#fff]">Ajouter</button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto max-h-96">
                        
                            <!-- Livewire component rendering -->
                            <livewire:skill-table />

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>