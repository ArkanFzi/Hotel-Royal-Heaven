<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Dashboard - only accessible to admins
    public function dashboard()
    {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status_ketersediaan', 'available')->count();
        $totalPemesanan = Pemesanan::count();
        $totalMember = User::where('level', 'member')->count();
        $recentBookings = Pemesanan::with(['user', 'kamar'])->latest('tgl_pemesanan')->take(5)->get();

        return view('admin.index', compact(
            'totalKamar',
            'kamarTersedia',
            'totalPemesanan',
            'totalMember',
            'recentBookings'
        ));
    }

    // List kamar (for both admin and members)
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

        if ($request->filled('price_max')) {
            $query->whereHas('tipe', function($q) use ($request){
                $q->where('harga_dasar', '<=', $request->input('price_max'));
            });
        }

        $kamars = $query->paginate(12)->withQueryString();
        $kamarsAll = $query->get();
        $tipeKamars = TipeKamar::all();

        return view('kamar.index', compact('kamars', 'kamarsAll', 'tipeKamars'));
    }

    // Landing page with featured rooms
    public function landing()
    {
        // Fetch 3 most recent available rooms to feature on landing
        $featuredRooms = Kamar::with('tipe')
            ->where('status_ketersediaan', 'available')
            ->latest('id_kamar')
            ->take(3)
            ->get();

        return view('home', compact('featuredRooms'));
    }

    // Create form (admin only)
    public function create()
    {
        $tipe = TipeKamar::all();
        return view('kamar.create', compact('tipe'));
    }

    // Store kamar (admin only)
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar',
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',
            'deskripsi' => 'nullable|string|max:500',
            'status_ketersediaan' => 'required|in:available,booked,maintenance',
        ]);

        Kamar::create($data);
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    // Edit form (admin only)
    public function edit(Kamar $kamar)
    {
        $tipe = TipeKamar::all();
        return view('kamar.edit', compact('kamar', 'tipe'));
    }

    // Update kamar (admin only)
    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'nomor_kamar' => 'required|string|unique:kamar,nomor_kamar,'.$kamar->id_kamar.',id_kamar',
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',
            'deskripsi' => 'nullable|string|max:500',
            'status_ketersediaan' => 'required|in:available,booked,maintenance',
        ]);

        $kamar->update($data);
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    // Delete kamar (admin only)
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
