<div class="max-h-96 overflow-y-auto" x-data="{ selected: []}">
    <x-danger-button x-show="selected.length > 0" x-on:click="$wire.deleteSkills(selected)">Supprimer</x-danger-button>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="p-3.5 border-b-2 text-center border-r-[1px]"></th>
                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Titre</th>
                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Niveau</th>
                <th class="p-3.5 border-b-2 text-center border-r-[1px]">Description</th>
                <th class="p-3.5 border-b-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skills as $skill)
                <tr>
                    <td class="p-3.5 border-b-[1px] border-r-[1px]">
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