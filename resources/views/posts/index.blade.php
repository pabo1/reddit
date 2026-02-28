<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Лента постов</h1>

        @foreach($posts as $post)
        <div class="bg-white rounded shadow mb-4 p-4 flex gap-4">
            <!-- Голосование -->
            <div class="flex flex-col items-center gap-1 min-w-[40px]">
                <form method="POST" action="{{ route('votes.store') }}">
                    @csrf
                    <input type="hidden" name="votable_id" value="{{ $post->id }}">
                    <input type="hidden" name="votable_type" value="post">
                    <input type="hidden" name="value" value="1">
                    <button class="text-gray-400 hover:text-orange-500 text-xl">▲</button>
                </form>
                <span class="font-bold text-sm">{{ $post->votes_count }}</span>
                <form method="POST" action="{{ route('votes.store') }}">
                    @csrf
                    <input type="hidden" name="votable_id" value="{{ $post->id }}">
                    <input type="hidden" name="votable_type" value="post">
                    <input type="hidden" name="value" value="-1">
                    <button class="text-gray-400 hover:text-blue-500 text-xl">▼</button>
                </form>
            </div>

            <!-- Контент -->
            <div class="flex-1">
                <div class="text-xs text-gray-500 mb-1">
                    <a href="{{ route('communities.show', $post->community) }}" class="font-bold text-black hover:underline">r/{{ $post->community->name }}</a>
                    · {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                </div>
                <a href="{{ route('communities.posts.show', [$post->community, $post]) }}" class="text-lg font-semibold hover:underline">
                    {{ $post->title }}
                </a>
                @if($post->url)
                    <a href="{{ $post->url }}" class="block text-xs text-blue-500 hover:underline">{{ $post->url }}</a>
                @endif
            </div>
        </div>
        @endforeach

        {{ $posts->links() }}
    </div>
</x-app-layout>