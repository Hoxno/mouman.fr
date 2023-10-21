<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#DC2626] border border-transparent rounded-md font-semibold text-xs text-[#fff] uppercase tracking-widest hover:bg-[#EF4444] active:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-[#EF4444] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
