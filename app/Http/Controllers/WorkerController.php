<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::orderBy('name')->get();

        return view('workers.index', ['workers' => $workers]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'hourly_rate' => str_replace(',', '.', $request->input('hourly_rate')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:workers,name',
            'hourly_rate' => 'required|numeric|min:0|max:9999.99',
        ], [
            'name.required' => 'Sisesta nimi.',
            'name.max' => 'Nimi on liiga pikk.',
            'name.unique' => 'Sellise nimega töömees on juba olemas.',
            'hourly_rate.required' => 'Sisesta tunnihind.',
            'hourly_rate.numeric' => 'Tunnihind peab olema number, nt 25 või 25,50.',
            'hourly_rate.min' => 'Tunnihind ei saa olla negatiivne.',
            'hourly_rate.max' => 'Tunnihind on liiga suur.',
        ]);

        Worker::create($validated);

        return redirect()->route('workers.index')->with('success', 'Töömees lisatud.');
    }
}
