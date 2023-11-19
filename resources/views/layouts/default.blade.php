<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head class="m-0 w-full">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

</head>
<body class="antialiased text-primary dark:bg-dark__body text-base h-full md:m-0">
    
        {{-- Header --}}
<header class="flex w-full fixed top-0 left-0 bg-[#fff] z-50 shadow-3xl dark:bg-dark__body dark:text-white">
    {{-- Navigation --}}
    <nav class="flex h-16 max-w-5xl gap-2 w-full justify-between items-center bd-grid">
        {{-- Logo --}}
        <a class="text-primary dark:text-white" href="{{ route('index') }}">
            Mohamed MOUMAN
        </a>

        <!-- Bouton de bascule du mode sombre -->
        <button id="theme-toggle" type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
        >
        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        </button>

        <div x-data="{ open: false }" x-cloak>
            <button
                @click="open = !open"
                @click.outside="if (open) open = false"
                class="md:hidden w-8 h-8 flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-dark__body dark:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </button>
            <ul
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="md:hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-dark__body dark:text-white"
                tabindex="-1"
            >
                <li><a href="#about" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:bg-dark__body dark:text-white dark:hover:bg-white dark:hover:text-gray-700">A propos</a></li>
                <li><a href="#skills" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:bg-dark__body dark:text-white dark:hover:bg-white dark:hover:text-gray-700">Compétence</a></li>
                <li><a href="#work" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:bg-dark__body dark:text-white dark:hover:bg-white dark:hover:text-gray-700">Expérience</a></li>
                <li><a href="#school" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:bg-dark__body dark:text-white dark:hover:bg-white dark:hover:text-gray-700">Formation</a></li>
                <li><a href="#contact" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:bg-dark__body dark:text-white dark:hover:bg-white dark:hover:text-gray-700">Contact</a></li>
            </ul>

            <ul class="hidden md:flex space-x-12 font-semibold ml-12">
                <li><a href="#about" class="relative">A propos</a></li>
                <li><a href="#skills" class="relative">Compétance</a></li>
                <li><a href="#work" class="relative">Expérience</a></li>
                <li><a href="#school" class="relative">Formation</a></li>
                <li><a href="#contact" class="relative">Contact</a></li>
            </ul>
        </div>
    </nav>
</header>
        <main class="mt-10 md:mt-12 lg:mt-16">
            <x-flash></x-flash>
            {{ $slot }}
        </main>
    <!--=======FOOTER=======-->
    <footer class="footer flex justify-end z-50 bg-footer text-[#f2f2f2] text-center overflow-hidden py-16 text-sm border dark:bg-[#212121] dark:text-white dark:border-[#212121]">
        <div class="mx-auto my-auto max-w-5xl">
            <p class="text-center uppercase text-xs tracking-wider">© {{ date('Y') }} <a href="mouman.fr" class="no-underline text-[#8C8C8C] dark:text-[#8C8C8C]">mouman.fr</a> | tous droits réservés | Version 2.0</p>
        </div>
    </footer>
    
</body>
</html>