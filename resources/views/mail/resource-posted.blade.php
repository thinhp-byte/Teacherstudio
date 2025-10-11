<x-mail::message>

<h2>{{ $resource->title }}

</h2>
<p>
# Congrats! A new resource has been posted.
</p>


<x-mail::button :url="url('/resources/' . $resource->id)">
View your Resource Post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
