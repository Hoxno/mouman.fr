<x-app-layout title="Dashboard">
    @section('title', 'Dashboard')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-dark__body">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash></x-flash>
                    Dashboard
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
