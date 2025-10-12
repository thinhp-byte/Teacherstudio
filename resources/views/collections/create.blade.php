<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-2">Create New Collection</h1>
        <p class="text-gray-600 mb-6">Organize your resources into themed collections</p>
        
        <form method="POST" action="{{ route('collections.store') }}" class="space-y-6">
            @csrf
            
            <x-form-field>
                <x-form-label for="name">Collection Name *</x-form-label>
                <div class="mt-2">
                    <x-form-input 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="e.g., 5th Grade Math Unit" 
                        required
                    />
                    <x-form-error name="name"/>
                </div>
            </x-form-field>
            
            <x-form-field>
                <x-form-label for="subject">Subject *</x-form-label>
                <div class="mt-2">
                    <select 
                        id="subject" 
                        name="subject"
                        class="block w-full bg-white py-1.5 px-3 text-base text-gray-900 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        required
                    >
                        <option value="">Select a subject</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="English">English</option>
                        <option value="Science">Science</option>
                        <option value="History">History</option>
                        <option value="Art">Art</option>
                        <option value="Music">Music</option>
                        <option value="PE">PE</option>
                        <option value="Geography">Geography</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Computer Science">Computer Science</option>
                    </select>
                    <x-form-error name="subject"/>
                </div>
            </x-form-field>
            
            <div class="flex gap-4">
                <x-form-button>Create Collection</x-form-button>
                <a href="/collections" class="text-sm text-gray-600 hover:text-gray-900 self-center">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>