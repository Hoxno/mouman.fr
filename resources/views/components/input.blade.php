<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="mt-2 relative rounded-md shadow-sm @error($name) border border-red-300 @enderror">
        @if ($type === 'textarea')
            <textarea class="w-full px-3 py-2 border {{ $errors->has($name) ? 'border-red-300' : 'border-gray-300' }} focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" cols="5" rows="5">{{ old($name, $value) }}</textarea>
        @else
            <input class="w-full px-3 py-2 border {{ $errors->has($name) ? 'border-red-300' : 'border-gray-300' }} focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            >
        @endif

        @if ($type === 'file' && $value)
            <p class="mt-3 text-sm text-gray-500">Fichier actuel : {{ $value }}</p>
            @if ($isImage())
                <img class="mt-2 max-w-full max-h-48" src="{{ asset('storage/' . $value) }}" alt="Image {{ $value }}">
            @elseif ($isPdf())
                <a href="{{ asset('storage/' . $value) }}" target="_blank">Voir le PDF</a>
            @endif
        @endif

        @error($name)
        <div class="flex items-center p-2 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:border-red-800">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
