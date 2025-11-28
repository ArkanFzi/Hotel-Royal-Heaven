<div>
    <!-- Filter Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold mb-4">Filter Kamar</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                <input type="text" wire:model.live="search" id="search" placeholder="Nomor kamar atau deskripsi"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
                <select wire:model.live="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Tipe</option>
                    @foreach($tipeKamars as $tipe)
                        <option value="{{ $tipe->id_tipe }}">{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Min Price -->
            <div>
                <label for="min_price" class="block text-sm font-medium text-gray-700">Harga Min</label>
                <input type="number" wire:model.live="min_price" id="min_price" placeholder="Harga minimum"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Max Price -->
            <div>
                <label for="max_price" class="block text-sm font-medium text-gray-700">Harga Max</label>
                <input type="number" wire:model.live="max_price" id="max_price" placeholder="Harga maksimum"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kamars as $kamar)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Room Image -->
                <div class="aspect-w-16 aspect-h-9">
                    @php
                        $image = $kamar->foto_kamar ?: 'user/GambarHeroSection.jpg';
                    @endphp
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $kamar->nomor_kamar }}" class="w-full h-48 object-cover">
                </div>

                <div class="p-6">
                    <h4 class="text-xl font-semibold mb-2">{{ $kamar->nomor_kamar }}</h4>
                    <p class="text-gray-600 mb-2">{{ $kamar->tipe->nama_tipe }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($kamar->deskripsi, 100) }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($kamar->tipe->harga_dasar, 0, ',', '.') }}</span>
                        <span class="px-2 py-1 text-xs rounded-full {{ $kamar->status_ketersediaan === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $kamar->status_ketersediaan === 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex space-x-3">
                        {{-- Detail Button --}}
                        <a href="{{ route('daftarkamar.show', $kamar) }}" class="flex-1 text-center px-4 py-2 rounded-lg text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition font-medium">
                            Detail
                        </a>

                        {{-- Book Now Button --}}
                        @if($kamar->status_ketersediaan === 'available')
                            @auth
                                @if(auth()->user()->role === 'member')
                                    <button onclick="openBookingModal({{ $kamar->id_kamar }})"
                                       class="flex-1 text-center px-4 py-2 rounded-lg bg-yellow-600 text-white shadow-lg shadow-yellow-500/50 hover:bg-yellow-700 transition font-medium transform hover:-translate-y-0.5">
                                        Pesan Sekarang
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-yellow-600 text-white shadow-lg shadow-yellow-500/50 hover:bg-yellow-700 transition font-medium transform hover:-translate-y-0.5">
                                        Pesan Sekarang
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-yellow-600 text-white shadow-lg shadow-yellow-500/50 hover:bg-yellow-700 transition font-medium transform hover:-translate-y-0.5">
                                    Pesan Sekarang
                                </a>
                            @endauth
                        @else
                            <button disabled class="flex-1 text-center px-4 py-2 rounded-lg bg-red-400 text-white font-medium cursor-not-allowed opacity-70">
                                Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Tidak ada kamar yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $kamars->links() }}
    </div>
</div>
