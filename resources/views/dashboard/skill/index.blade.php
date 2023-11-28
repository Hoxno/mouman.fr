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
                        <div class="max-h-96 overflow-y-auto" x-data="{ selected: []}">
                            <x-danger-button x-show="selected.length > 0" x-on:click="$wire.deleteSkills(selected)">Supprimer</x-danger-button>
                            
                            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-dark__body">
                                <thead class="bg-gray-50 dark:bg-dark__body">
                                    <tr>
                                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-600 py-6 px-4  text-left rounded-tl-md rounded-bl-md"></th>
                                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-600 py-6 px-4  text-left rounded-tl-md rounded-bl-md">Titre</th>
                                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-600 py-6 px-4  text-left rounded-tl-md rounded-bl-md">Niveau</th>
                                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-600 py-6 px-4  text-left rounded-tl-md rounded-bl-md">Description</th>
                                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-600 py-6 px-4  text-left rounded-tl-md rounded-bl-md"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                    @foreach ($skills as $skill)
                                        <tr class="hover:bg-gray-50">
                                            <td class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                                <input type="checkbox" x-model="selected" value="{{ $skill->id }}">
                                            </td>
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