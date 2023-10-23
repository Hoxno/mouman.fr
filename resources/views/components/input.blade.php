<div>
    <label for="{{ $name }}" class="block font-medium text-sm text-gray-700">{{ $label }}</label>
    <div @class(['mt-2', 'relative rounded-md shadow-sm' => $errors->has($name)])>
        @if ($type === 'textarea')
        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" cols="30" rows="10">{{ old($name, $value) }}</textarea>
        @else
        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full px-3 py-2 outline-none @error($name) is-invalid @enderror" 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            >
        @endif
        @error($name)
        <div class="flex items-center p-2 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:border-red-800">
            {{ $message }}
        </div>
        @enderror
    </div>
    
</div>