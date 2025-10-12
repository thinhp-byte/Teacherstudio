<x-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center text-3xl font-bold text-indigo-600">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                        @if($profile->school)
                            <p class="text-indigo-100 mt-1">
                                <span class="inline-flex items-center">
                                    📚 {{ $profile->school }}
                                </span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500">Experience</div>
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $profile->years_experience }} years
                        </div>
                        <div class="text-xs text-gray-600 mt-1">
                            {{ $profile->experienceLevel() }}
                        </div>
                    </div>
                    
                    @if($profile->specialization)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Specialization</div>
                            <div class="text-lg font-semibold text-gray-900">
                                {{ $profile->specialization }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500">Resources Shared</div>
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $user->collections()->count() }} collections
                        </div>
                    </div>
                </div>

                @if($profile->bio)
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">About</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->bio }}</p>
                    </div>
                @endif

                <!-- Resources by this teacher -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Resources</h2>
                    <div class="space-y-3">
                        @forelse($user->collections()->latest()->take(5)->get() as $collection)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="font-medium text-gray-900">{{ $collection->name }}</div>
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $collection->resources()->count() }} resources
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No resources shared yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>