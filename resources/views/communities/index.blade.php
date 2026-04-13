<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Сообщества</h1>
            <a href="{{ route('communities.create') }}" class="bg-orange-500 text-black px-4 py-2 rounded hover:bg-orange-600">+ Создать</a>
        </div>

        @foreach($communities as $community)
        <div class="bg-white rounded shadow p-4 mb-4 flex justify-between items-center">
            <div>
                <a href="{{ route('communities.show', $community) }}" class="text-lg font-bold hover:underline">r/{{ $community->name }}</a>
                <p class="text-sm text-gray-500">{{ $community->description }}</p>
            </div>
            <span class="text-sm text-gray-400">{{ $community->posts_count }} постов</span>
        </div>
        @endforeach
    </div>
</x-app-layout>