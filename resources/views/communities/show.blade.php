<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 px-4">
        <div class="bg-white rounded shadow p-6 mb-6">
            <h1 class="text-2xl font-bold">r/{{ $community->name }}</h1>
            <p class="text-gray-500 mt-1">{{ $community->description }}</p>
            <a href="{{ route('communities.posts.create', $community) }}" class="mt-4 inline-block bg-orange-500 text-black px-4 py-2 rounded hover:bg-orange-600">+ Создать пост</a>
        </div>

        @foreach($posts as $post)
        <div class="bg-white rounded shadow p-4 mb-4">
            <div class="text-xs text-gray-500 mb-1">{{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}</div>
            <a href="{{ route('communities.posts.show', [$community, $post]) }}" class="text-lg font-semibold hover:underline">{{ $post->title }}</a>
        </div>
        @endforeach

        {{ $posts->links() }}
    </div>
</x-app-layout>