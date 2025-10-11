<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <nav>
            <x-nav-link href="/">Home</x-nav-link>
            <x-nav-link href="/resources">Resource Hub</x-nav-link>
            <x-nav-link href="/contact">Contact</x-nav-link>
            @guest
            <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
            <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
            @endguest
        </nav>
        
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex sm:flex sm:justify-between">
            <h1 class="text-3xl font-bold mb-8"> Teacherstudio </h1>
            
            <x-button href="/resources/create">Create Resource</x-button>
            </div>
        </header>

        <body>
       {{ $slot}}
       </body>
    </body>
</html>
