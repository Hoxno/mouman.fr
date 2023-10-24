<x-app-layout :title="'Mes compétences'">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
                {{ __('Dashboard > Mon CV > Mes compétences') }}
            </h2>
            <a href="{{ route('dashboard.skill.create') }}" class="mt-16 py-2.5 px-7 border-2 cursor-pointer hover:bg-[#111827] hover:text-[#fff]">Ajouter</a>
        </div>
    </x-slot>
    
    
    <div class="py-12">
        
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="p-6 text-gray-900">
                    
                    
                    <div class="overflow-x-auto max-h-96">
                        <div class="max-h-96 overflow-y-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="p-3.5 border-b-2 text-center border-r-[1px]">Titre</th>
                                        <th class="p-3.5 border-b-2 text-center border-r-[1px]">Niveau</th>
                                        <th class="p-3.5 border-b-2 text-center border-r-[1px]">Description</th>
                                        <th class="p-3.5 border-b-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($skills as $skill)
                                        <tr>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $skill->title }}</td>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $skill->level }}</td>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{!! nl2br(e($skill->description)) !!}</td>
                                            <td class="p-3.5 border-b-[1px]">
                                                <div class="flex gap-2 justify-end">
                                                    @include('dashboard.skill.partials.edit')
                                                    @include('dashboard.skill.partials.delete')
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
