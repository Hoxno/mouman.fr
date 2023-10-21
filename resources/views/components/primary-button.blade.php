<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1F2937] border border-transparent rounded-md font-semibold text-xs text-[#fff] uppercase tracking-widest hover:bg-gray-[#374151] focus:bg-[#374151] active:bg-[#111827] focus:outline-none focus:ring-2 focus:ring-[#6366F1] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
