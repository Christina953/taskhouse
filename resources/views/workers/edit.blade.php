@extends('layouts.app')

@section('title', 'Muuda töömeest')

@section('content')
    <a href="{{ route('workers.index') }}" class="underline">← Tagasi töömeeste juurde</a>

    <h1 class="text-3xl font-bold mt-4 mb-6">Muuda töömeest</h1>

    <form method="POST" action="{{ route('workers.update', $worker) }}"
          class="bg-white border border-gray-300 rounded p-6 flex flex-col gap-4 max-w-md">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-1">
            <label for="name" class="font-semibold">Nimi</label>
            <input type="text" id="name" name="name" value="{{ old('name', $worker->name) }}"
                   class="border border-gray-400 rounded px-3 py-2">
            @error('name')
                <p class="text-red-700 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="hourly_rate" class="font-semibold">Tunnihind (€)</label>
            <input type="text" inputmode="decimal" id="hourly_rate" name="hourly_rate"
                   value="{{ old('hourly_rate', number_format($worker->hourly_rate, 2, ',', '')) }}"
                   class="border border-gray-400 rounded px-3 py-2 w-32">
            @error('hourly_rate')
                <p class="text-red-700 text-sm">{{ $message }}</p>
            @enderror
            <p class="text-sm text-gray-600">Tunnihinna muutmine ei muuda juba sisestatud tööde maksumust.</p>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-6 py-2 rounded bg-gray-900 text-white font-semibold">Salvesta</button>
            <a href="{{ route('workers.index') }}" class="px-6 py-2 rounded border border-gray-900 font-semibold">Tühista</a>
        </div>
    </form>
        <form method="POST" action="{{ route('workers.destroy', $worker) }}"
          onsubmit="return confirm('Kas oled kindel, et soovid töömehe {{ $worker->name }} kustutada?');"
          class="mt-6 max-w-md">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-6 py-2 rounded border border-red-700 text-red-700 font-semibold hover:bg-red-50">
            Kustuta töömees
        </button>
        <p class="text-sm text-gray-600 mt-1">Kustutada saab ainult töömeest, kellel pole tehtud töid.</p>
    </form>
@endsection
