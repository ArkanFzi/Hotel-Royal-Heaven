<div>
    {{-- Search and Filter Section --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
            {{-- Search Input --}}
            <div class="lg:col-span-2">
                <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Cari Kamar</label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" id="search"
                           placeholder="Cari berdasarkan nomor kamar atau tipe..."
                           class="w-full pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Room Type Filter --}}
            <div>
                <label for="type" class="block text-xs font-medium text-gray-700 mb-1">Tipe Kamar</label>
                <div class="relative">
                    <select wire:model.live="type" id="type"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white appearance-none">
                        <option value="">Semua Tipe</option>
                        @foreach($tipeKamars as $tipe)
                            <option value="{{ $tipe->id_tipe }}">{{ $tipe->nama_tipe }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Availability Filter --}}
            <div>
                <label for="facilities" class="block text-xs font-medium text-gray-700 mb-1">Fasilitas</label>
                <div class="relative">
                    <select wire:model.live="facilities" id="facilities"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white appearance-none">
                        <option value="">Semua Fasilitas</option>
                        <option value="wifi">WiFi</option>
                        <option value="ac">Air Conditioning</option>
                        <option value="tv">TV</option>
                        <option value="bathroom">Private Bathroom</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Price Range and Sort --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
            <div>
                <label for="min_price" class="block text-xs font-medium text-gray-700 mb-1">Harga Min</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-400 font-medium text-sm">Rp</span>
                    </div>
                    <input type="number" wire:model.live.debounce.300ms="min_price" id="min_price"
                           placeholder="0"
                           class="w-full pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                </div>
            </div>
            <div>
                <label for="max_price" class="block text-xs font-medium text-gray-700 mb-1">Harga Max</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-400 font-medium text-sm">Rp</span>
                    </div>
                    <input type="number" wire:model.live.debounce.300ms="max_price" id="max_price"
                           placeholder="9999999"
                           class="w-full pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                </div>
            </div>
            <div>
                <label for="sort" class="block text-xs font-medium text-gray-700 mb-1">Urutkan</label>
                <div class="relative">
                    <select wire:model.live="sort" id="sort"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white appearance-none">
                        <option value="recommendation">Rekomendasi</option>
                        <option value="price_low">Harga Rendah</option>
                        <option value="price_high">Harga Tinggi</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="newest">Terbaru</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-3 border-t border-gray-100 mt-3">
            <button type="button"
                    wire:click="$set('search', ''); $set('type', ''); $set('facilities', ''); $set('min_price', ''); $set('max_price', ''); $set('sort', 'recommendation')"
                    class="inline-flex items-center justify-center px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-md transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Reset
            </button>
            @if($kamars->total() > 0)
                <div class="text-xs text-gray-600 flex items-center ml-auto">
                    <span>{{ $kamars->total() }} hasil ditemukan</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Results Section --}}
    <div class="mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900">Kamar Tersedia</h2>
            <div class="text-sm text-gray-600">
                {{ $kamars->total() }} kamar ditemukan
            </div>
        </div>

        {{-- Rooms Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @forelse($kamars as $kamar)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 group flex flex-col">
                    {{-- Image --}}
                    <div class="h-64 w-full overflow-hidden bg-gray-200 relative">
                        @php
                            $images = [];
                            if ($kamar->foto_kamar) {
                                $images[] = $kamar->foto_kamar;
                            }
                            if ($kamar->foto_detail && is_array($kamar->foto_detail)) {
                                $images = array_merge($images, $kamar->foto_detail);
                            }
                        @endphp

                        @if(count($images) > 0)
                            <img src="{{ asset('storage/' . $images[0]) }}"
                                 alt="{{ $kamar->nomor_kamar }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-900 shadow-sm">
                            {{ $kamar->tipe->nama_tipe }}
                        </div>
                        {{-- Status Badge --}}
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold uppercase shadow-sm
                            @if($kamar->status_ketersediaan === 'available')
                                bg-green-500 text-white
                            @else
                                bg-red-500 text-white
                            @endif">
                            {{ ucfirst($kamar->status_ketersediaan) }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="p-4 bg-gray-100/50 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Kamar {{ $kamar->nomor_kamar }}</h3>
                        <p class="text-gray-500 text-xs line-clamp-2 mb-3 flex-grow">
                            {{ $kamar->deskripsi ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Perfect comfort with our selection of luxury hotel rooms.' }}
                        </p>

                        <div class="flex flex-col gap-1 mb-3">
                            <span class="text-xs font-semibold text-yellow-600 uppercase tracking-wider">Price</span>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($kamar->tipe->harga_dasar, 0, ',', '.') }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mt-auto">
                            <a href="{{ route('daftarkamar.show', $kamar) }}" class="px-2 py-2 text-center text-xs font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-white hover:border-gray-400 transition">
                                Detail
                            </a>
                            @if($kamar->status_ketersediaan === 'available')
                                @auth
                                    @if(auth()->user()->role === 'member')
                                        <button onclick="openBookingModal({{ $kamar->id_kamar }})"
                                               class="px-2 py-2 text-center text-xs font-semibold text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition shadow-md shadow-yellow-200">
                                            Book
                                        </button>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}"
                                       class="px-2 py-2 text-center text-xs font-semibold text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition shadow-md shadow-yellow-200">
                                        Book
                                    </a>
                                @endguest
                            @else
                                <button disabled
                                        class="px-2 py-2 text-center text-xs font-semibold text-white bg-red-400 rounded-lg cursor-not-allowed opacity-70">
                                    N/A
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-.98-5.5-2.5m.5-4C6.5 9 4.5 9 4.5 9s2 0 2.5-2.5M19.5 9s-2 0-2.5-2.5m.5 4c.5-2.5 2.5-2.5 2.5-2.5s-2 0-2.5 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Kamar Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba sesuaikan kriteria pencarian atau filter Anda.</p>
                    <a href="{{ route('member.kamar.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset Pencarian
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($kamars->hasPages())
            <div class="mt-8">
                {{ $kamars->links() }}
            </div>
        @endif
    </div>

    {{-- Booking Modal --}}
    <div id="bookingModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 pt-20 pb-20">
            <!-- Background overlay with blur -->
            <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-all duration-300" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div id="modalPanel" class="relative bg-white rounded-2xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <!-- Header with gradient -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m0 0l-2-2m2 2l2-2m6-6v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2h8a2 2 0 012 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white" id="modal-title">
                                    Pesan Kamar Anda
                                </h3>
                                <p class="text-yellow-100 text-sm mt-1">
                                    Pilih kamar dan lengkapi data pemesanan
                                </p>
                            </div>
                        </div>
                        <button id="closeModalBtn" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-full transition-all duration-200 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-8 py-6 max-h-[calc(90vh-200px)] overflow-y-auto">
                    <livewire:booking-form :selectedKamarId="$selectedKamarId ?? null" />
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Aman & Terpercaya
                            </p>
                        </div>
                        <div class="text-xs text-gray-500">
                            Butuh bantuan? <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium">Hubungi Kami</a>
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
            const modalPanel = document.getElementById('modalPanel');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Trigger animation
            setTimeout(() => {
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);

            // Update Livewire component with selected room
            if (window.livewire) {
                window.livewire.find('booking-form').set('selectedKamarId', kamarId);
            }
        }

        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            const modalPanel = document.getElementById('modalPanel');

            // Trigger close animation
            modalPanel.classList.remove('scale-100', 'opacity-100');
            modalPanel.classList.add('scale-95', 'opacity-0');

            // Hide modal after animation
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                selectedKamarId = null;
            }, 300);
        }

        // Event listeners
        document.getElementById('closeModalBtn').addEventListener('click', closeBookingModal);
        document.getElementById('modalBackdrop').addEventListener('click', closeBookingModal);

        // Listen for booking success event
        window.addEventListener('booking-success', function() {
            closeBookingModal();
        });
    </script>
</div>
