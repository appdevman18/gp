<header class="flex bg-gray-100 p-4 fixed top-0 w-full">
    <div class="mr-auto">{{ config('app.name', 'Laravel') }}</div>
    @if (Route::has('login'))
        <div class="ml-auto">
            @auth
                <a href="{{ url('/user/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endif
        </div>
    @endif
</header>
