<x-layout>
  <h1>Resource Hub</h1>  
   @foreach ($resources as $resource)
    <li><strong>{{ $resource['title']}}</strong> for {{$resource['subject']}} in {{$resource ['grade']}}th grade</li>
  @endforeach

</x-layout>