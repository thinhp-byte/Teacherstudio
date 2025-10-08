<x-layout>
  <x-slot:heading>Edit Resource: {{$resource->title}}</x-slot:heading>  


  <p>
   <form method="POST" action="/resources">
    @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
     <h2 class="text-base/7 font-semibold text-gray-900">Edit Resource: {{$resource->title}}</h2>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
             
              <input 
                  id="title" 
                  type="text" 
                  name="title" 
                  class="block min-w-0 grow bg-white py-1.5 px-3 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                  placeholder="Midterm Quiz" 
                  value="{{$resource->title}}"
                  required/>
            </div>

            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="subject" class="block text-sm/6 font-medium text-gray-900">Subject</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
             
              <input 
                  id="subject" 
                  type="text" 
                  name="subject" 
                  class="block min-w-0 grow bg-white py-1.5 px-3 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                  placeholder="Mathematics"
                  value="{{$resource->subject}}"
                  required/>
            
              @error('subject')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="grade" class="block text-sm/6 font-medium text-gray-900">Grade</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
             
              <input 
                  id="grade" 
                  type="text" 
                  name="grade" 
                  class="block min-w-0 grow bg-white py-1.5 px-3 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                  placeholder="5th" 
                  value="{{$resource->grade}}"
                  required/>
            
              @error('grade')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        
         {{-- <div class="mt-10">
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-xs">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
          </div>
          --}}
      </div>
    </div>

  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="/resources/{{$resource->id}}" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
  </div>
</form>

</p>
</x-layout>