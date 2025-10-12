<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-2">Edit Your Teacher Profile</h1>
        <p class="text-gray-600 mb-6">Update your professional information</p>
        
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <x-form-field>
                <x-form-label for="school">School Name *</x-form-label>
                <div class="mt-2">
                    <x-form-input 
                        id="school" 
                        name="school" 
                        value="{{ old('school', $profile->school) }}"
                        placeholder="e.g., Lincoln Elementary School" 
                        required
                    />
                    <x-form-error name="school"/>
                </div>
            </x-form-field>
            
            <x-form-field>
                <x-form-label for="years_experience">Years of Teaching Experience *</x-form-label>
                <div class="mt-2">
                    <x-form-input 
                        id="years_experience" 
                        name="years_experience" 
                        type="number"
                        min="0"
                        max="50"
                        value="{{ old('years_experience', $profile->years_experience) }}"
                        required
                    />
                    <x-form-error name="years_experience"/>
                </div>
            </x-form-field>
            
            <x-form-field>
                <x-form-label for="specialization">Specialization *</x-form-label>
                <div class="mt-2">
                    <select 
                        id="specialization" 
                        name="specialization"
                        class="block w-full bg-white py-1.5 px-3 text-base text-gray-900 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        required
                    >
                        <option value="">Select a specialization</option>
                        @php
                            $specializations = [
                                'Elementary Education',
                                'Secondary Mathematics',
                                'English Literature',
                                'Science Education',
                                'Special Education',
                                'Social Sciences',
                                'Art & Music',
                                'Physical Education'
                            ];
                        @endphp
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}" {{ old('specialization', $profile->specialization) == $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="specialization"/>
                </div>
            </x-form-field>
            
            <x-form-field>
                <x-form-label for="bio">About You * (50-500 characters)</x-form-label>
                <div class="mt-2">
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4"
                        class="block w-full bg-white py-1.5 px-3 text-base text-gray-900 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        placeholder="Tell other teachers about yourself..."
                        minlength="50"
                        maxlength="500"
                        required
                    >{{ old('bio', $profile->bio) }}</textarea>
                    <x-form-error name="bio"/>
                    <p class="text-xs text-gray-500 mt-1">Minimum 50 characters required</p>
                </div>
            </x-form-field>
            
            <div class="flex gap-4">
                <x-form-button>Update Profile</x-form-button>
                <a href="/profiles/{{ auth()->id() }}" class="text-sm text-gray-600 hover:text-gray-900 self-center">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>