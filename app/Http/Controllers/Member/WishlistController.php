<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the member's wishlist.
     */
    public function index(Request $request)
    {
        $query = Wishlist::where('id_user', Auth::id())
            ->with(['kamar.tipe']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('kamar', function ($kamarQuery) use ($search) {
                    $kamarQuery->where('nomor_kamar', 'like', '%' . $search . '%');
                })
                ->orWhereHas('kamar.tipe', function ($tipeQuery) use ($search) {
                    $tipeQuery->where('nama_tipe', 'like', '%' . $search . '%');
                });
            });
        }

        // Filter by room type
        if ($request->has('tipe_kamar') && !empty($request->tipe_kamar)) {
            $query->whereHas('kamar.tipe', function ($q) use ($request) {
                $q->where('id_tipe', $request->tipe_kamar);
            });
        }

        // Filter by availability
        if ($request->has('status') && $request->status !== '') {
            $query->whereHas('kamar', function ($q) use ($request) {
                $q->where('status_ketersediaan', $request->status);
            });
        }

        // Filter by price range
        if ($request->has('harga_min') && !empty($request->harga_min)) {
            $query->whereHas('kamar.tipe', function ($q) use ($request) {
                $q->where('harga_dasar', '>=', $request->harga_min);
            });
        }

        if ($request->has('harga_max') && !empty($request->harga_max)) {
            $query->whereHas('kamar.tipe', function ($q) use ($request) {
                $q->where('harga_dasar', '<=', $request->harga_max);
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->join('kamar', 'wishlists.id_kamar', '=', 'kamar.id_kamar')
                      ->join('tipe_kamar', 'kamar.id_tipe', '=', 'tipe_kamar.id_tipe')
                      ->orderBy('tipe_kamar.harga_dasar', 'asc')
                      ->select('wishlists.*');
                break;
            case 'price_high':
                $query->join('kamar', 'wishlists.id_kamar', '=', 'kamar.id_kamar')
                      ->join('tipe_kamar', 'kamar.id_tipe', '=', 'tipe_kamar.id_tipe')
                      ->orderBy('tipe_kamar.harga_dasar', 'desc')
                      ->select('wishlists.*');
                break;
            case 'name':
                $query->join('kamar', 'wishlists.id_kamar', '=', 'kamar.id_kamar')
                      ->orderBy('kamar.nomor_kamar', 'asc')
                      ->select('wishlists.*');
                break;
            default:
                $query->latest();
                break;
        }

        $wishlists = $query->paginate(12)->withQueryString();

        // Get filter options
        $tipeKamarOptions = \App\Models\TipeKamar::whereHas('kamars', function ($q) {
            $q->whereHas('wishlists', function ($w) {
                $w->where('id_user', Auth::id());
            });
        })->get();

        return view('member.wishlist.index', compact('wishlists', 'tipeKamarOptions'));
    }

    /**
     * Add a room to the wishlist.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kamar' => 'required|exists:kamar,id_kamar',
        ]);

        $id_kamar = $request->input('id_kamar');
        $id_user = Auth::id();

        // Check if already in wishlist
        $exists = Wishlist::where('id_user', $id_user)
            ->where('id_kamar', $id_kamar)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Kamar sudah ada di wishlist Anda.'
            ]);
        }

        Wishlist::create([
            'id_user' => $id_user,
            'id_kamar' => $id_kamar,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kamar berhasil ditambahkan ke wishlist.'
        ]);
    }

    /**
     * Remove a room from the wishlist.
     */
    public function destroy($id_kamar)
    {
        $wishlist = Wishlist::where('id_user', Auth::id())
            ->where('id_kamar', $id_kamar)
            ->first();

        if (!$wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan di wishlist Anda.'
            ]);
        }

        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kamar berhasil dihapus dari wishlist.'
        ]);
    }

    /**
     * Check if a room is in the user's wishlist.
     */
    public function check($id_kamar)
    {
        $exists = Wishlist::where('id_user', Auth::id())
            ->where('id_kamar', $id_kamar)
            ->exists();

        return response()->json([
            'in_wishlist' => $exists
        ]);
    }
}
