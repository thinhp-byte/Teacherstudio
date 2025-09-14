<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <nav>
            <x-nav-link href="/">Home</x-nav-link>
            <x-nav-link href="/about">About</x-nav-link>
            <x-nav-link href="/contact">Contact</x-nav-link>
        </nav>
        
        <header>
            <div>
            <h1 class="text-3xl font-bold mb-8"> Teacherstudio </h1>
            </div>
        </header>

        <body>
       {{ $slot}}
       </body>
    </body>
</html>
