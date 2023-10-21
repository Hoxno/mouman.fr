<x-app-layout title="Mes compétances">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-16">
            {{ __('Dashboard > Mon CV > Mes compétances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-[#fff] shadow-xl  ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{ __("") }}
                    <a href="{{ route('dashboard.skill.create') }}" class="float-right py-2.5 px-7 border-[2px] cursor-pointer mb-6 hover:bg-[#111827] hover:text-[#fff]">Ajouter</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Titre</th>
                                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Niveau</th>
                                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Description</th>
                                <th class="p-3.5 border-b-2 text-center ">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $skill)
                                <tr class="">
                                    <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $skill->title }}</td>
                                    <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $skill->level }}</td>
                                    <td class="p-3.5 border-b-[1px] border-r-[1px]">{!! nl2br($skill->description) !!}</td>
                                    <td class="p-3.5 border-b-[1px]">
                                        <div class="d-flex gap-2 w-100 justify-content-end">
                                            @include('dashboard.partials.edit')
                                            @include('dashboard.partials.delete')
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
</x-app-layout>