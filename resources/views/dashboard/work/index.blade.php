<x-app-layout :title="'Mes expériences'">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight md:mt-16">
                {{ __('Dashboard > Mon CV > Mes expériences') }}
            </h2>
            <a href="{{ route('dashboard.work.create') }}" class="mt-6 md:mt-16 py-2.5 px-7 border-2 cursor-pointer hover:bg-[#111827] hover:text-[#fff]">Ajouter</a>
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
                                        <th class="p-3.5 border-b-2 text-center border-r-[1px]">Entreprise</th>
                                        <th class="p-3.5 border-b-2 text-center border-r-[1px]">Description</th>
                                        <th class="p-3.5 border-b-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($works as $work)
                                        <tr>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $work->title }}</td>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{{ $work->company }}</td>
                                            <td class="p-3.5 border-b-[1px] border-r-[1px]">{!! nl2br($work->description) !!}</td>
                                            <td class="p-3.5 border-b-[1px]">
                                                <div class="flex gap-2 justify-end">
                                                    <x-primary-button>
                                                        <a href="{{ route('dashboard.work.edit', $work) }}">Editer</a>
                                                    </x-primary-button>
                                                    <x-danger-button
                                                        x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')"
                                                    >{{ __('Suppression') }}</x-danger-button>

                                                    <x-modal name="confirm-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                                        <form method="post" action="{{ route('dashboard.work.destroy', $work) }}" class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                            <h2 class="text-lg font-medium text-gray-900">
                                                                {{ __('Confirmer la suppression') }}
                                                            </h2>

                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ __('Êtes-vous sûr de vouloir supprimer cette expérience ?') }}
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
