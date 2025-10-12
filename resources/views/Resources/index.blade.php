<x-layout>
  <x-slot:heading>Resources</x-slot:heading>
  
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Resource Hub</h1>
    <p class="mt-2 text-gray-600">Discover and share educational resources from teachers worldwide</p>
  </div>

  <div class="mt-6 space-y-4">
   @foreach ($resources as $resource)
      <a href="/resources/{{ $resource->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg hover:shadow-md transition bg-white">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            {{-- Collection Name --}}
            <div class="font-bold text-blue-500 text-sm">{{ $resource->collection->name }}</div>
            
            {{-- Resource Details --}}
            <div class="mt-1">
              <strong>{{ $resource->title }}</strong> for {{ $resource->subject }} in {{ $resource->grade }}th grade
            </div>
            
            {{-- Teacher Info --}}
            @if($resource->collection->user)
              <div class="mt-2 flex items-center text-sm text-gray-600">
                <div class="flex items-center">
                  <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-2">
                    {{ strtoupper(substr($resource->collection->user->name, 0, 1)) }}
                  </div>
                  <div>
                    <div>
                      Shared by 
                      <a href="/profiles/{{ $resource->collection->user->id }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        {{ $resource->collection->user->name }}
                      </a>
                    </div>
                    
                    @if($resource->collection->user->teacherProfile && $resource->collection->user->teacherProfile->school)
                      <div class="text-xs text-gray-500">
                        {{ $resource->collection->user->teacherProfile->school }}
                        @if($resource->collection->user->teacherProfile->specialization)
                          • {{ $resource->collection->user->teacherProfile->specialization }}
                        @endif
                      </div>
                    @endif
                  </div>
                </div>
                
                @auth
                  @if(auth()->id() !== $resource->collection->user->id)
                    <div class="ml-auto">
                      @if(auth()->user()->isFollowing($resource->collection->user))
                        <span class="text-xs text-gray-500">✓ Following</span>
                      @else
                        <form method="POST" action="/users/{{ $resource->collection->user->id }}/follow" class="inline">
                          @csrf
                          <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-800">
                            + Follow
                          </button>
                        </form>
                      @endif
                    </div>
                  @endif
                @endauth
              </div>
            @endif
          </div>
        </div>
      </a>
  @endforeach

  <div>
    {{ $resources->links() }}  
  </div>
</div>
</x-layout>