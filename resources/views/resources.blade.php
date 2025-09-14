<x-layout>
  <h1>Resource Hub</h1>  

  <ul>
   @foreach ($resources as $resource)
    <li>
      <a href="/resources/{{ $resource['id']}}">
      <strong>{{ $resource['title']}}</strong> for {{$resource['subject']}} in {{$resource ['grade']}}th grade
    </li>
  @endforeach
</ul>
</x-layout>