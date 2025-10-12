<x-layout>
  <x-slot:heading>Create Resource</x-slot:heading>  


  <p>
   <form method="POST" action="/resources">
    @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Create a New Resource</h2>
      <p class="mt-1 text-sm/6 text-gray-600">Provide details here below</p>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
       
      <x-form-field>
          <x-form-label for="collection_id">Collection</x-form-label>
          <div class="mt-2">
            <select 
              id="collection_id" 
              name="collection_id" 
              class="block w-full bg-white py-1.5 px-3 text-base text-gray-900 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
              required
            >
              <option value="">Select a collection</option>
              @foreach(auth()->user()->collections as $collection)
                <option value="{{ $collection->id }}" {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
                  {{ $collection->name }} ({{ $collection->subject }})
                </option>
              @endforeach
            </select>
            <x-form-error name="collection_id"/>
            <p class="text-xs text-gray-500 mt-1">
              <a href="/collections/create" class="text-indigo-600 hover:text-indigo-800">Create a new collection</a>
            </p>
          </div>
        </x-form-field>

      <x-form-field>
          <x-form-label for="title">Title</x-form-label>
          <div class="mt-2">
            <x-form-input id="title" name="title" placeholder="Midterm" required/>

            <x-form-error name="title"/>
          </div>
        </x-form-field>

        <x-form-field>
          <x-form-label for="title">Subject</x-form-label>
          <div class="mt-2">
            <x-form-input id="subject" name="subject" placeholder="Mathematics" required/>

            <x-form-error name="subject"/>
          </div>
        </x-form-field>

        <x-form-field>
          <x-form-label for="title">Grade</x-form-label>
          <div class="mt-2">
            <x-form-input id="grade" name="grade" placeholder="5th" required/>

            <x-form-error name="grade"/>
          </div>
        </x-form-field>

        
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
    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
    <x-form-button>Save</x-form-button>
  </div>
</form>

</p>
</x-layout>