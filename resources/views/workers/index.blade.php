@extends('layouts.app')

@section('title', 'Töömehed')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Töömehed</h1>

    <div class="bg-white border border-gray-300 rounded">
        <table class="w-full">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-3">Nimi</th>
                    <th class="px-4 py-3 text-right">Tunnihind</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($workers as $worker)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3 font-semibold">{{ $worker->name }}</td>
                        <td class="px-4 py-3 text-right">{{ number_format($worker->hourly_rate, 2, ',', ' ') }} €/h</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('workers.edit', $worker) }}" class="underline">Muuda</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-gray-600">Töömehi pole veel lisatud.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <section class="mt-8 bg-white border border-gray-300 rounded p-6">
        <h2 class="text-xl font-bold mb-4">Lisa töömees</h2>

        <form method="POST" action="{{ route('workers.store') }}" class="flex flex-wrap items-start gap-4">
            @csrf

            <div class="flex flex-col gap-1 grow">
                <label for="name" class="font-semibold">Nimi</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="border border-gray-400 rounded px-3 py-2">
                @error('name')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="hourly_rate" class="font-semibold">Tunnihind (€)</label>
                <input type="text" inputmode="decimal" id="hourly_rate" name="hourly_rate"
                    value="{{ old('hourly_rate') }}" class="border border-gray-400 rounded px-3 py-2 w-32">
                @error('hourly_rate')
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="mt-7 px-6 py-2 rounded bg-gray-900 text-white font-semibold">Lisa</button>
        </form>
    </section>
@endsection
