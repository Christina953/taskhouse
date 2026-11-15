<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TaskHouse')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <header class="bg-white border-b border-gray-300">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('projects.index') }}" class="text-xl font-bold">TaskHouse</a>

            <nav class="flex gap-2">
                <a href="{{ route('projects.index') }}"
                    class="px-4 py-2 rounded {{ request()->routeIs('projects.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-200' }}">
                    Objektid
                </a>
                <a href="{{ route('workers.index') }}"
                    class="px-4 py-2 rounded {{ request()->routeIs('workers.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-200' }}">
                    Töömehed
                </a>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-900">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

</body>

</html>
