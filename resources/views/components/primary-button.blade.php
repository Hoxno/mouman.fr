<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-[#6366F1] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
