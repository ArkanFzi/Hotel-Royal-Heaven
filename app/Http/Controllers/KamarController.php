<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::with('tipe');

        if ($request->filled('type')) {
            $query->whereHas('tipe', function($q) use ($request){
                $q->where('nama_tipe', 'like', '%'.$request->input('type').'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status_ketersediaan', $request->input('status'));
        }

        if ($request->filled('price_min')) {
            $query->whereHas('tipe', function($q) use ($request){
                $q->where('harga_dasar', '>=', $request->input('price_min'));
            });
        }

        $kamars = $query->paginate(10)->withQueryString();
        return view('kamar.index', compact('kamars'));
    }

    public function create()
    {
        $tipe = TipeKamar::all();
        return view('kamar.create', compact('tipe'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar',
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',
            'deskripsi' => 'nullable|string',
            'status_ketersediaan' => 'required|in:available,booked,maintenance',
        ]);

        Kamar::create($data);
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Kamar $kamar)
    {
        $tipe = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipe'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar,'.$kamar->id_kamar.',id_kamar',
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',
            'deskripsi' => 'nullable|string',
            'status_ketersediaan' => 'required|in:available,booked,maintenance',
        ]);

        $kamar->update($data);
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
