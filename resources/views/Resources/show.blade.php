<x-layout>
  <div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $resource->title }}</h1>
      
      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <span class="text-sm text-gray-600">Subject:</span>
          <span class="font-semibold">{{ $resource->subject }}</span>
        </div>
        <div>
          <span class="text-sm text-gray-600">Grade:</span>
          <span class="font-semibold">{{ $resource->grade }}th</span>
        </div>
      </div>
      
      @if($resource->collections->isNotEmpty())
        <div class="mb-6">
          <h3 class="text-sm text-gray-600 mb-2">Found in Collections:</h3>
          <div class="flex flex-wrap gap-2">
            @foreach($resource->collections as $collection)
              <a href="/collections/{{ $collection->id }}" 
                 class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm hover:bg-indigo-200 transition">
                {{ $collection->name }}
              </a>
            @endforeach
          </div>
        </div>
      @endif
      
      @auth
        @if($resource->canEditOrDelete(auth()->user()))
          <div class="mt-6 flex gap-4">
            <x-button href="/resources/{{$resource->id}}/edit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
              Edit Resource
            </x-button>
          </div>
        @endif
      @endauth
    </div>
  </div>
</x-layout>