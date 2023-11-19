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
                            <button class="inline-flex items-center px-4 py-2 bg-[#1F2937] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-[#374151] focus:bg-[#374151] active:bg-[#111827] focus:outline-none focus:ring-2 focus:ring-[#6366F1] focus:ring-offset-2 transition ease-in-out duration-150"
                            wire:click="startEdit({{ $skill->id }})">
                                Editer
                            </button>
                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')"
                            >{{ __('Suppression') }}</x-danger-button>

                            <x-modal name="confirm-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('dashboard.skill.destroy', $skill) }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Confimer la suppression') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Êtes-vous sûr de vouloir supprimer cette compétence ?') }}
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Annuler') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Supprimer') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
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