@extends('layouts.app')

@section('page_title', 'Wishlist Saya')

@section('content')
{{-- Hero Section --}}
<x-hero-wishlist
    :wishlists="$wishlists"
    title="Your Favorite Rooms"
    subtitle="Personal Collection"
    description="Keep track of your favorite rooms and plan your perfect stay with ease."
    image="user/interiorkamar.jpg"
    ctaText="Explore More Rooms"
    :ctaLink="route('member.kamar.index')"
/>

<div class="min-h-screen bg-gray-50 -mt-24 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Search and Filter Section --}}
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('member.wishlist.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Search Input --}}
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Kamar</label>
                        <div class="relative">
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan nomor kamar atau tipe..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Room Type Filter --}}
                    <div>
                        <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-2">Tipe Kamar</label>
                        <select name="tipe_kamar" id="tipe_kamar"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">Semua Tipe</option>
                            @foreach($tipeKamarOptions as $tipe)
                                <option value="{{ $tipe->id_tipe }}" {{ request('tipe_kamar') == $tipe->id_tipe ? 'selected' : '' }}>
                                    {{ $tipe->nama_tipe }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Availability Filter --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Ketersediaan</label>
                        <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>

                {{-- Price Range and Sort --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="harga_min" class="block text-sm font-medium text-gray-700 mb-2">Harga Minimum</label>
                        <input type="number" name="harga_min" id="harga_min" value="{{ request('harga_min') }}"
                               placeholder="Rp 0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="harga_max" class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimum</label>
                        <input type="number" name="harga_max" id="harga_max" value="{{ request('harga_max') }}"
                               placeholder="Rp 9999999"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select name="sort" id="sort"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama Kamar (A-Z)</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari & Filter
                    </button>
                    <a href="{{ route('member.wishlist.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset Filter
                    </a>
                    @if(request()->hasAny(['search', 'tipe_kamar', 'status', 'harga_min', 'harga_max', 'sort']))
                        <div class="text-sm text-gray-600 flex items-center">
                            <span>{{ $wishlists->total() }} hasil ditemukan</span>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        @if($wishlists->count() > 0)
            <!-- Wishlist Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Room Image -->
                        <div class="relative">
                            @php
                                $images = [];
                                if ($wishlist->kamar->foto_kamar) {
                                    $images[] = $wishlist->kamar->foto_kamar;
                                }
                                if ($wishlist->kamar->foto_detail && is_array($wishlist->kamar->foto_detail)) {
                                    $images = array_merge($images, $wishlist->kamar->foto_detail);
                                }
                            @endphp
                            @if(count($images) > 0)
                                <img src="{{ asset('storage/' . $images[0]) }}"
                                     alt="{{ $wishlist->kamar->nomor_kamar }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Availability Badge -->
                            <div class="absolute top-3 right-3">
                                @if($wishlist->kamar->status_ketersediaan === 'available')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Tidak Tersedia
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Room Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $wishlist->kamar->nomor_kamar }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $wishlist->kamar->tipe->nama_tipe }}</p>

                            <!-- Room Specs -->
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    {{ $wishlist->kamar->tipe->kapasitas }} orang
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    {{ $wishlist->kamar->tipe->luas }} m²
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="text-center mb-4">
                                <div class="text-2xl font-bold text-gray-900">
                                    Rp {{ number_format($wishlist->kamar->tipe->harga_dasar, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-600">per malam</div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('member.kamar.show', $wishlist->kamar->id_kamar) }}"
                                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-center text-sm">
                                    Lihat Detail
                                </a>
                                @if($wishlist->kamar->status_ketersediaan === 'available')
                                    <button onclick="openBookingModal({{ $wishlist->kamar->id_kamar }})"
                                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                                        Pesan
                                    </button>
                                @else
                                    <button disabled
                                            class="flex-1 bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed text-sm">
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($wishlists->hasPages())
                <div class="mt-8">
                    {{ $wishlists->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Wishlist Kosong</h3>
                <p class="text-gray-600 mb-6">Anda belum menambahkan kamar favorit ke wishlist. Jelajahi kamar kami dan tambahkan yang Anda suka!</p>
                <a href="{{ route('member.kamar.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Jelajahi Kamar
                </a>
            </div>
        @endif
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="modalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div id="modalPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Form Pemesanan Kamar
                        </h3>
                        <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="max-h-96 overflow-y-auto">
                        <livewire:booking-form :selectedKamarId="$selectedKamarId ?? null" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedKamarId = null;

    function openBookingModal(kamarId) {
        selectedKamarId = kamarId;
        const modal = document.getElementById('bookingModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Update Livewire component with selected room
        if (window.livewire) {
            window.livewire.find('booking-form').set('selectedKamarId', kamarId);
        }
    }

    function closeBookingModal() {
        const modal = document.getElementById('bookingModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        selectedKamarId = null;
    }

    // Event listeners
    document.getElementById('closeModalBtn').addEventListener('click', closeBookingModal);
    document.getElementById('modalBackdrop').addEventListener('click', closeBookingModal);

    // Listen for booking success event
    window.addEventListener('booking-success', function() {
        closeBookingModal();
    });
</script>
@endsection
