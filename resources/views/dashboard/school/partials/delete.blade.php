<x-danger-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')"
>{{ __('Suppression') }}</x-danger-button>

<x-modal name="confirm-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('dashboard.school.destroy', $school) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Confimer la suppression') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('') }}
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