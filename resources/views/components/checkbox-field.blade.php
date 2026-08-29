@props([
    'name',
    'label',
    'help' => null,
    // Valeur enregistrée : '1' ou '0'. null pour une création, auquel cas
    // on coche par défaut, comme la valeur par défaut des colonnes online.
    'value' => null,
])

@php
    $coche = (bool) old($name, $value ?? '1');
@endphp

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-white">{{ $label }}</label>

    <div class="mt-2 flex items-start gap-3">
        {{-- Une case décochée n'envoie rien : ce champ caché garantit
             qu'une valeur parvient toujours au serveur. --}}
        <input type="hidden" name="{{ $name }}" value="0">

        <input
            type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="1"
            @checked($coche)
            class="mt-0.5 h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-dark__primary"
        >

        @if ($help)
            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $help }}</span>
        @endif
    </div>

    @error($name)
        <div class="error-message flex items-center p-2 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:border-red-800">
            {{ $message }}
        </div>
    @enderror
</div>
