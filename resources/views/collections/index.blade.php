<x-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Collections</h1>
                <p class="text-gray-600 mt-1">Organize your resources into themed collections</p>
            </div>
            <a href="/collections/create" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Create Collection
            </a>
        </div>
        
        @if($collections->isEmpty())
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <p class="text-gray-600 mb-4">You haven't created any collections yet.</p>
                <a href="/collections/create" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Create Your First Collection
                </a>
            </div>
        @else
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($collections as $collection)
                    <a href="/collections/{{ $collection->id }}" class="block p-6 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
                        <h3 class="font-bold text-lg text-gray-900">{{ $collection->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $collection->subject }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ $collection->resources_count }} {{ Str::plural('resource', $collection->resources_count) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>