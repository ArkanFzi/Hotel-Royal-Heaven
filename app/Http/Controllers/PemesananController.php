<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $pemesanan = Pemesanan::with(['user','kamar'])->paginate(15);
        } else {
            $pemesanan = $user->bookings()->with('kamar')->paginate(15);
        }
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $kamars = Kamar::where('status_ketersediaan', 'available')->get();
        return view('pemesanan.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'tgl_check_in' => 'required|date',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
            'pilihan_pembayaran' => 'required|string',
        ]);

        $user = Auth::user();
        $kamar = Kamar::findOrFail($data['id_kamar']);
        $total_malam = (new \DateTime($data['tgl_check_out']))->diff(new \DateTime($data['tgl_check_in']))->days;
        $total_harga = $total_malam * ($kamar->tipe->harga_dasar ?? 0);

        $p = Pemesanan::create([
            'kode_pemesanan' => 'KD'.time().rand(100,999),
            'id_user' => $user->id,
            'id_kamar' => $kamar->id_kamar,
            'tgl_check_in' => $data['tgl_check_in'],
            'tgl_check_out' => $data['tgl_check_out'],
            'total_malam' => $total_malam,
            'total_harga' => $total_harga,
            'pilihan_pembayaran' => $data['pilihan_pembayaran'],
            'status_pemesanan' => 'pending',
            'tgl_pemesanan' => now(),
        ]);

        // mark kamar as booked
        $kamar->status_ketersediaan = 'booked';
        $kamar->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function show(Pemesanan $pemesanan)
    {
        $user = Auth::user();
        if (!$user->isAdmin() && $pemesanan->id_user != $user->id) {
            abort(403);
        }
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $request->validate(['status_pemesanan' => 'required|in:pending,confirmed,cancelled,completed']);
        $pemesanan->status_pemesanan = $request->input('status_pemesanan');
        $pemesanan->save();
        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
