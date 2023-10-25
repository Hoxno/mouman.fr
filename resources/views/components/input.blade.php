<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="mt-2 relative rounded-md shadow-sm @if($errors->has($name)) border border-red-300 @else border-gray-300 @endif">
        @if ($type === 'textarea')
            <textarea class="input-field" id="{{ $name }}" name="{{ $name }}" cols="5" rows="8">{{ old($name, $value) }}</textarea>
        @else
            <input class="input-field" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
        @endif

        @if ($type === 'file' && $value)
            <p class="file-info mt-3 text-sm text-gray-500">Fichier actuel : {{ $value }}</p>
            @if ($isImage())
                <img class="file-preview mt-2 max-w-full max-h-48" src="{{ asset('storage/' . $value) }}" alt="Image {{ $value }}">
            @elseif ($isPdf())
                <a href="{{ asset('storage/' . $value) }}" target="_blank">Voir le PDF</a>
            @endif
        @endif

        @error($name)
        <div class="error-message flex items-center p-2 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:border-red-800">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
