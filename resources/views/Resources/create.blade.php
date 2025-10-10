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