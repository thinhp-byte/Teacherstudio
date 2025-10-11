<x-layout>
  <x-slot:heading>Log In</x-slot:heading>  


  <p>
   <form method="POST" action="/login">
    @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Register</h2>


        <x-form-field>
          <x-form-label for="email">Email</x-form-label>
          <div class="mt-2">
            <x-form-input id="email" name="email" type="email" :value="old('email')" required/>

            <x-form-error name="email"/>
          </div>
        </x-form-field>

        <x-form-field>
          <x-form-label for="password">Password</x-form-label>
          <div class="mt-2">
            <x-form-input id="password" name="password" required/>

            <x-form-error name="password"/>
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
    <a href="/" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
    <x-form-button>Log In</x-form-button>
  </div>
</form>

</p>
</x-layout>