<x-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Collection Header -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $collection->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $collection->subject }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        Created {{ $collection->created_at->diffForHumans() }}
                    </p>
                </div>
                
                @auth
                    @if(auth()->id() === $collection->user_id)
                        <a href="/resources/create?collection_id={{ $collection->id }}" 
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Add Resource
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Resources in this Collection -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Resources ({{ $resources->count() }})
            </h2>
            
            @if($resources->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">No resources in this collection yet.</p>
                    @auth
                        @if(auth()->id() === $collection->user_id)
                            <a href="/resources/create?collection_id={{ $collection->id }}" 
                               class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Add Your First Resource
                            </a>
                        @endif
                    @endauth
                </div>
            @else
                <div class="space-y-4">
                    @foreach($resources as $resource)
                        <a href="/resources/{{ $resource->id }}" 
                           class="block p-4 border border-gray-200 rounded-lg hover:shadow-md transition bg-white">
                            <div class="font-semibold text-gray-900">{{ $resource->title }}</div>
                            <div class="text-sm text-gray-600 mt-1">
                                {{ $resource->subject }} • Grade {{ $resource->grade }}
                            </div>
                            <div class="text-xs text-gray-500 mt-2">
                                Added {{ $resource->created_at->diffForHumans() }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>