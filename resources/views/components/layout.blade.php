<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TeacherStudio</title>
        
        <!-- Add Vite directive -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900">
    
    {{-- Success Messages --}}
    @if(session('success'))
        <div class="max-w-4xl w-full mx-auto mt-4 mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
        <nav class="bg-white shadow mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-6">
                <a href="/" class="text-gray-900 hover:text-indigo-600 font-medium">Home</a>
                <a href="/resources" class="text-gray-900 hover:text-indigo-600 font-medium">Resource Hub</a>
                <a href="/teachers" class="text-gray-900 hover:text-indigo-600 font-medium">Teachers</a>

                <div class="ml-auto flex items-center gap-4">
                    @guest
                        <a href="/login" class="text-gray-900 hover:text-indigo-600">Log In</a>
                        <a href="/register" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Register</a>
                    @endguest

                    @auth
                        <span class="text-sm text-gray-700">
                            Hello, <strong>{{ auth()->user()->name }}</strong>!
                        </span>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                                Log Out
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
        
        <header class="bg-white shadow mb-8">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">TeacherStudio</h1>
                
                {{-- Only show Create Resource button on home and resources index pages --}}
                @auth
                    @if(request()->is('/') || request()->is('resources'))
                        <a href="/resources/create" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Create Resource
                        </a>
                    @endif
                @endauth
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            {{ $slot }}
        </main>
    </body>
</html>