<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Создать сообщество</h1>

        <form method="POST" action="{{ route('communities.store') }}" class="bg-white rounded shadow p-6 flex flex-col gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Название</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Описание</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <button type="submit" class="bg-orange-500 text-black px-4 py-2 rounded hover:bg-orange-600">Создать</button>
        </form>
    </div>
</x-app-layout>