<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan; // Wajib import Model Pemesanan
use App\Models\User; // Import Model User (jika dibutuhkan)

class AdminMemberController extends Controller
{
    /**
     * Menampilkan view 'admin.index'.
     * Karena view ini membutuhkan data dashboard ($recentBookings), 
     * kita harus menyediakannya di sini.
     */
    public function index()
    {
        // FIX: Ambil 5 data pemesanan terbaru yang dibutuhkan oleh view admin.index.blade.php
        $recentBookings = Pemesanan::with(['user', 'kamar'])
                                 ->latest('tgl_pemesanan') // Urutkan berdasarkan tanggal pemesanan terbaru
                                 ->take(5)
                                 ->get();
        
        // PENTING: Jika halaman ini seharusnya menampilkan daftar MEMBER, kamu juga harusnya 
        // mengambil data member di sini. Misalnya:
        // $members = User::where('level', 'member')->get();

        // Melewatkan variabel $recentBookings ke view untuk mengatasi ErrorException
        return view('admin.index', compact('recentBookings')); 
        
        // Catatan: Jika kamu ingin memuat data member, pastikan view-nya diubah 
        // ke 'admin.member.index' atau sejenisnya, dan tambahkan $members ke compact().
    }
}