<x-layout>
  <h1>Resource</h1>  

  <h2 class="font-bold text lg">{{ $resource->title}}</h2>
  <p>
    This is a {{$resource->subject}} resource for {{$resource['grade']}}th grade.
</p class="mt-6">
  <x-button href="/resources/{{$resource->id}}/edit">Edit Resource</x-button>
</x-layout>