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
                <!-- Vérification de l'ID pour l'édition -->
                @if ($editId === $skill->id)
                    <!-- Inclusion du composant Livewire SkillForm -->
                    <tr>
                        <livewire:skill-form :skill="$skill" :key="$skill->id"/>
                    </tr>
                @endif
                
            @endforeach
        </tbody>
    </table>
</div>