<x-layout>
  <x-slot:heading>Resources</x-slot:heading>
  <h1>Resource Hub</h1>  

  <div class="mt-6 space-y-4">
   @foreach ($resources as $resource)
      <a href="/resources/{{ $resource['id']}}" class ="block px-4 py-6 border border-gray-200 rounded-lg">
      <div class="font-bold text-blue-500 text-sm"->{{$resource->collection->name}}</div>
      <div>
          <strong>{{ $resource['title']}}</strong> for {{$resource['subject']}} in {{$resource ['grade']}}th grade
      </div>      
        </a>
  @endforeach

  <div>
    {{ $resources->links() }}  
    </div>
</div>
</x-layout>