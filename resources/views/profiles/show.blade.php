<x-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header Section with Gradient Background -->
            <div style="background: linear-gradient(to right, #6366f1, #a855f7); padding: 48px 24px;">
                <div style="display: flex; align-items: center;">
                    <!-- Avatar Circle -->
                    <div style="
                        height: 80px; 
                        width: 80px; 
                        border-radius: 50%; 
                        background-color: white; 
                        display: flex; 
                        align-items: center; 
                        justify-content: center; 
                        font-size: 32px; 
                        font-weight: bold; 
                        color: #6366f1; 
                        flex-shrink: 0;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    ">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    
                    <!-- Name and School -->
                    <div style="margin-left: 24px;">
                        <h1 style="font-size: 30px; font-weight: bold; color: white; margin: 0;">
                            {{ $user->name }}
                        </h1>
                        @if($profile->school)
                            <p style="color: rgba(255,255,255,0.9); margin-top: 4px; display: flex; align-items: center;">
                                <span>📚 {{ $profile->school }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Follow Button Section -->
            <div class="px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center gap-3">
                    @auth
                        {{-- Show follow/unfollow button only when viewing someone else's profile --}}
                        @if(auth()->id() !== $user->id)
                            @if(auth()->user()->isFollowing($user))
                                {{-- Following button - Light purple/indigo, visible --}}
                                <form method="POST" action="/users/{{ $user->id }}/unfollow" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium text-sm">
                                        ✓ Following
                                    </button>
                                </form>
                            @else
                                {{-- Follow button - Darker indigo --}}
                                <form method="POST" action="/users/{{ $user->id }}/follow" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium text-sm">
                                        + Follow
                                    </button>
                                </form>
                            @endif
                            <span class="text-gray-400">•</span>
                        @endif
                    @endauth
                    
                    {{-- Always show follower counts --}}
                    <span class="text-sm text-gray-700 font-medium">
                        {{ $user->followers()->count() }} {{ $user->followers()->count() === 1 ? 'follower' : 'followers' }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span class="text-sm text-gray-700 font-medium">
                        Following {{ $user->following()->count() }}
                    </span>
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
                        <div class="text-sm text-gray-500">Community</div>
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $user->followers()->count() }} {{ $user->followers()->count() === 1 ? 'follower' : 'followers' }}
                        </div>
                        <div class="text-xs text-gray-600 mt-1">
                            Following {{ $user->following()->count() }}
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
                        @php
                            $collections = $user->collections()
                                ->with('resources')
                                ->latest()
                                ->take(5)
                                ->get()
                                ->filter(function($collection) {
                                    return $collection->resources->count() > 0;
                                });
                        @endphp
                        
                        @forelse($collections as $collection)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="font-medium text-gray-900">{{ $collection->name }}</div>
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $collection->resources->count() }} {{ $collection->resources->count() === 1 ? 'resource' : 'resources' }}
                                </div>
                                <div class="mt-2 space-y-1">
                                    @foreach($collection->resources->take(3) as $resource)
                                        <a href="/resources/{{ $resource->id }}" class="block text-sm text-indigo-600 hover:text-indigo-800 hover:underline">
                                            → {{ $resource->title }}
                                        </a>
                                    @endforeach
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