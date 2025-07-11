<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $nasabahs = Nasabah::query();

        if ($q) {
            $nasabahs = $nasabahs->where(function ($query) use ($q) {
                $query->where('id', 'like', "%$q%");
            });
        }

        $nasabahs = $nasabahs->get();

        return view('nasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        Nasabah::create($request->all());
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $nasabah->update($request->all());
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil diperbarui.');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}
