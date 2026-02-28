<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Создать пост в r/{{ $community->name }}</h1>

        <form method="POST" action="{{ route('communities.posts.store', $community) }}" class="bg-white rounded shadow p-6 flex flex-col gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Заголовок</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Текст (необязательно)</label>
                <textarea name="body" rows="5" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Ссылка (необязательно)</label>
                <input type="url" name="url" class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-orange-500 text-black px-4 py-2 rounded hover:bg-orange-600">Опубликовать</button>
        </form>
    </div>
</x-app-layout>