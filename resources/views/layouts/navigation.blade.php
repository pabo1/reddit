<nav class="bg-white border-b border-gray-200">
    <div class="max-w-3xl mx-auto px-4 h-14 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-orange-500 font-bold text-xl">Reddit</a>
            <a href="{{ route('communities.index') }}" class="text-sm text-gray-600 hover:text-black">Сообщества</a>
        </div>

        <div class="flex items-center gap-3">
            @auth
                <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-black">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-black">Войти</a>
                <a href="{{ route('register') }}" class="bg-orange-500 text-white text-sm px-3 py-1 rounded hover:bg-orange-600">Регистрация</a>
            @endauth
        </div>
    </div>
</nav>