<x-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Teacher Directory</h1>
        <p class="text-gray-600 mb-8">Connect with educators from around the world</p>
        
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($teachers as $teacher)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-20"></div>
                    <div class="p-6 -mt-10">
                        <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center text-2xl font-bold text-indigo-600 border-4 border-white shadow-sm mb-4">
                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                        </div>
                        
                        <h3 class="font-bold text-lg text-gray-900">{{ $teacher->name }}</h3>
                        
                        @if($teacher->teacherProfile)
                            @if($teacher->teacherProfile->school)
                                <p class="text-sm text-gray-600 mt-1">{{ $teacher->teacherProfile->school }}</p>
                            @endif
                            
                            @if($teacher->teacherProfile->specialization)
                                <p class="text-xs text-gray-500 mt-2">{{ $teacher->teacherProfile->specialization }}</p>
                            @endif
                        @endif
                        
                        <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                            <span>{{ $teacher->followers_count }} followers</span>
                            <span>{{ $teacher->collections_count }} collections</span>
                        </div>
                        
                        <div class="flex gap-2 mt-4">
                            <a href="/profiles/{{ $teacher->id }}" class="flex-1 text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm">
                                View Profile
                            </a>
                            
                            @auth
                                @if(auth()->id() !== $teacher->id)
                                    @if(auth()->user()->isFollowing($teacher))
                                        <form method="POST" action="/users/{{ $teacher->id }}/unfollow">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                                                Following
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="/users/{{ $teacher->id }}/follow">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-white border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition text-sm">
                                                Follow
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $teachers->links() }}
        </div>
    </div>
</x-layout>