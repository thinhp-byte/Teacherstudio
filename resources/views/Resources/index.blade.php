<x-layout>
  <x-slot:heading>Resources</x-slot:heading>
  <h1>Resource Hub</h1>  

  <div class="mt-6 space-y-4">
   @foreach ($resources as $resource)
      <a href="/resources/{{ $resource['id']}}" class="block px-4 py-6 border border-gray-200 rounded-lg hover:shadow-md transition">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="font-bold text-blue-500 text-sm">{{ $resource->collection->name }}</div>
            <div class="mt-1">
              <strong>{{ $resource['title']}}</strong> for {{ $resource['subject'] }} in {{ $resource ['grade'] }}th grade
            </div>
            
            @if($resource->collection->user && $resource->collection->user->teacherProfile)
              <div class="mt-2 text-sm text-gray-600">
                Shared by 
                <a href="/profiles/{{ $resource->collection->user->id }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                  {{ $resource->collection->user->name }}
                </a>
                @if($resource->collection->user->teacherProfile->school)
                  from {{ $resource->collection->user->teacherProfile->school }}
                @endif
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