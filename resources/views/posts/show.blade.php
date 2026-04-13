<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 px-4">
        <!-- Пост -->
        <div class="bg-white rounded shadow p-6 mb-6">
            <div class="text-xs text-gray-500 mb-2">
                <a href="{{ route('communities.show', $community) }}" class="font-bold text-black hover:underline">r/{{ $community->name }}</a>
                · {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
            </div>
            <h1 class="text-2xl font-bold mb-3">{{ $post->title }}</h1>
            @if($post->body)
                <p class="text-gray-700 mb-3">{{ $post->body }}</p>
            @endif
            @if($post->url)
                <a href="{{ $post->url }}" class="text-blue-500 hover:underline text-sm">{{ $post->url }}</a>
            @endif
        </div>

        <!-- Форма комментария -->
        @auth
        <div class="bg-white rounded shadow p-4 mb-6">
            <form method="POST" action="{{ route('comments.store', $post) }}">
                @csrf
                <textarea name="body" rows="3" placeholder="Написать комментарий..." class="w-full border rounded px-3 py-2 mb-2"></textarea>
                <button type="submit" class="bg-orange-500 text-black px-4 py-2 rounded hover:bg-orange-600">Отправить</button>
            </form>
        </div>
        @endauth

        <!-- Комментарии -->
        <div class="flex flex-col gap-4">
            @foreach($comments as $comment)
            <div class="bg-white rounded shadow p-4">
                <div class="flex items-center gap-3 mb-2">
                    <!-- Голосование за комментарий -->
                    <form method="POST" action="{{ route('votes.store') }}">
                        @csrf
                        <input type="hidden" name="votable_id" value="{{ $comment->id }}">
                        <input type="hidden" name="votable_type" value="comment">
                        <input type="hidden" name="value" value="1">
                        <button style="background:none; border:none; cursor:pointer; font-size:16px;">▲</button>
                    </form>

                    <span style="font-weight:bold; font-size:14px;">{{ $comment->votes()->sum('value') }}</span>

                    <form method="POST" action="{{ route('votes.store') }}">
                        @csrf
                            <input type="hidden" name="votable_id" value="{{ $comment->id }}">
                            <input type="hidden" name="votable_type" value="comment">
                            <input type="hidden" name="value" value="-1">
                            <button style="background:none; border:none; cursor:pointer; font-size:16px;">▼</button>
                        </form>
                    </div>
                <div class="text-xs text-gray-500 mb-1">{{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}</div>
                <p>{{ $comment->body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>