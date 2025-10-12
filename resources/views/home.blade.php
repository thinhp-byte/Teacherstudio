<x-layout>
  <div class="max-w-4xl mx-auto">
    <!-- Hero Section -->
    <div class="text-center mb-12">
      <h1 class="text-5xl font-bold text-gray-900 mb-4">Welcome to TeacherStudio</h1>
      <p class="text-xl text-gray-600 mb-8">
        A community platform for educators to share resources and connect
      </p>
      
      @guest
        <div class="flex justify-center gap-4">
          <a href="/register" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
            Get Started
          </a>
          <a href="/login" class="px-6 py-3 bg-white text-indigo-600 border-2 border-indigo-600 rounded-lg hover:bg-indigo-50 transition font-semibold">
            Log In
          </a>
        </div>
      @endguest
    </div>

    <!-- Features -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
      <div class="text-center p-6 bg-white rounded-lg shadow-sm">
        <div class="text-4xl mb-4">📚</div>
        <h3 class="text-lg font-semibold mb-2">Share Resources</h3>
        <p class="text-gray-600">Create and share educational materials with fellow teachers</p>
      </div>
      
      <div class="text-center p-6 bg-white rounded-lg shadow-sm">
        <div class="text-4xl mb-4">👥</div>
        <h3 class="text-lg font-semibold mb-2">Connect with Teachers</h3>
        <p class="text-gray-600">Follow educators and discover their shared resources</p>
      </div>
      
      <div class="text-center p-6 bg-white rounded-lg shadow-sm">
        <div class="text-4xl mb-4">⭐</div>
        <h3 class="text-lg font-semibold mb-2">Build Your Profile</h3>
        <p class="text-gray-600">Showcase your experience and specializations</p>
      </div>
    </div>

    <!-- Stats -->
    <div class="bg-indigo-600 text-white rounded-lg p-8 text-center">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="text-4xl font-bold">{{ \App\Models\User::count() }}</div>
          <div class="text-indigo-200 mt-2">Teachers</div>
        </div>
        <div>
          <div class="text-4xl font-bold">{{ \App\Models\Resource::count() }}</div>
          <div class="text-indigo-200 mt-2">Resources</div>
        </div>
        <div>
          <div class="text-4xl font-bold">{{ \App\Models\Collection::count() }}</div>
          <div class="text-indigo-200 mt-2">Collections</div>
        </div>
      </div>
    </div>

    <!-- Recent Resources Preview -->
    <div class="mt-12">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Recent Resources</h2>
        <a href="/resources" class="text-indigo-600 hover:text-indigo-800">View all →</a>
      </div>
      
      <div class="space-y-4">
        @foreach(\App\Models\Resource::with('collection.user.teacherProfile')->latest()->take(3)->get() as $resource)
          <a href="/resources/{{ $resource->id }}" class="block p-4 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
            <div class="font-semibold text-gray-900">{{ $resource->title }}</div>
            <div class="text-sm text-gray-600 mt-1">
              {{ $resource->subject }} • {{ $resource->grade }}th grade
            </div>
            @if($resource->collection->user)
              <div class="text-xs text-gray-500 mt-2">
                by {{ $resource->collection->user->name }}
              </div>
            @endif
          </a>
        @endforeach
      </div>
    </div>
  </div>
</x-layout>