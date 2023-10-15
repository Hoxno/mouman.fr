<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased to-blue-950 text-base md:pb-32 h-full">
        {{-- Header --}}
        <header class="flex w-full fixed top-0 left-0 bg-white z-50 shadow">
            
            {{-- Navigation --}}
            <nav class="flex h-16 max-w-5xl mx-auto gap-2 w-full justify-between items-center">
                {{-- Logo --}}
            <a class="" href="{{ route('index') }}">
                Mohamed MOUMAN
            </a>

            <div x-data="{ open: false }" x-cloak>
                <button
                    @click="open = !open"
                    @click.outside="if (open) open = false"
                    class="md:hidden w-8 h-8 flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                    class="md:hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    tabindex="-1"
                >
                    <li><a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon CV</a></li>
                    <li>
                        <a href="" class="flex items-center px-4 py-2 font-semibold text-sm text-indigo-700 hover:bg-gray-100">
                            Blog
                        </a>
                    </li>
                </ul>
                <ul class="hidden md:flex space-x-12 font-semibold ml-12">
                    <li><a class="relative" href="">Mon CV</a></li>
                    <li>
                        <a href="" class="flex items-center group text-indigo-700">
                            Blog
                        </a>
                    </li>
                </ul>
            </div>
            </nav>
            
        </header>
        <main class="mt-10 md:mt-12 lg:mt-16">
            
        </main>
    
</body>
</html>