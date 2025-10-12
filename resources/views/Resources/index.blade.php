<x-layout>
  <x-slot:heading>Resources</x-slot:heading>
  
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Resource Hub</h1>
    <p class="mt-2 text-gray-600">Discover and share educational resources from teachers worldwide</p>
  </div>

  <form method="GET" action="/resources" class="mb-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input 
                type="text" 
                name="search" 
                placeholder="Search by title or subject..." 
                value="{{ request('search') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
            />
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Grade Level</label>
            <select 
                name="grade" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
            >
                <option value="">All Grades</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('grade') == $i ? 'selected' : '' }}>
                        Grade {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        
        <div class="flex items-end gap-2">
            <button 
                type="submit" 
                class="flex-1 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold"
            >
                Search
            </button>
            @if(request('search') || request('grade'))
                <a 
                    href="/resources" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                >
                    Clear
                </a>
            @endif
        </div>
    </div>
    
    @if(request('search') || request('grade'))
        <div class="mt-4 text-sm text-gray-600">
            Showing results for:
            @if(request('search'))
                <span class="font-semibold">"{{ request('search') }}"</span>
            @endif
            @if(request('grade'))
                <span class="font-semibold">Grade {{ request('grade') }}</span>
            @endif
        </div>
    @endif
  </form>

  <div class="mt-6 space-y-4">
   @foreach ($resources as $resource)
      <a href="/resources/{{ $resource->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg hover:shadow-md transition bg-white">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            {{-- Collection Name --}}
            <div class="font-bold text-blue-500 text-sm">
                @if($resource->collections->isNotEmpty())
                    {{ $resource->collections->pluck('name')->implode(', ') }}
                @else
                    <span class="text-gray-400">No collection</span>
                @endif
            </div>
            
            {{-- Resource Details --}}
            <div class="mt-1">
              <strong>{{ $resource->title }}</strong> for {{ $resource->subject }} in {{ $resource->grade }}th grade
            </div>
            
            {{-- Teacher Info --}}
            @php
                $firstCollection = $resource->collections->first();
            @endphp
            @if($firstCollection && $firstCollection->user)
              <div class="mt-2 flex items-center text-sm text-gray-600">
                <div class="flex items-center">
                  <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-2">
                    {{ strtoupper(substr($firstCollection->user->name, 0, 1)) }}
                  </div>
                  <div>
                    <div>
                      Shared by 
                      <a href="/profiles/{{ $firstCollection->user->id }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        {{ $firstCollection->user->name }}
                      </a>
                    </div>
                    
                    @if($firstCollection->user->teacherProfile && $firstCollection->user->teacherProfile->school)
                      <div class="text-xs text-gray-500">
                        {{ $firstCollection->user->teacherProfile->school }}
                        @if($firstCollection->user->teacherProfile->specialization)
                          • {{ $firstCollection->user->teacherProfile->specialization }}
                        @endif
                      </div>
                    @endif
                  </div>
                </div>
                
                @auth
                    @if(auth()->id() !== $firstCollection->user->id)
                      <div class="ml-auto">
                        @if(auth()->user()->isFollowing($firstCollection->user))
                          <span class="text-xs text-gray-500">✓ Following</span>
                        @else
                          <form method="POST" action="/users/{{ $firstCollection->user->id }}/follow" class="inline">
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