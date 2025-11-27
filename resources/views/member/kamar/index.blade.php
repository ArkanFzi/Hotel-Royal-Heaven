@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')

{{--
|--------------------------------------------------------------------------
| Custom Header / Hero Section (SEMUA STYLING ADA DI SINI)
|--------------------------------------------------------------------------
| Bagian ini meniru tampilan hero section, Jumbotron, dan Filter Bar
| dari gambar, menggunakan kelas-kelas Tailwind CSS.
--}}

<div class="relative bg-white font-inter">

@section('title', 'Daftar Kamar')

@section('content')

{{--
|--------------------------------------------------------------------------
| Custom Header / Hero Section (SEMUA STYLING ADA DI SINI)
|--------------------------------------------------------------------------
| Diperbaiki untuk meniru potongan diagonal (clip-path effect) dan
| penempatan teks yang spesifik sesuai gambar.
--}}

<div class="relative bg-white font-inter">

{{-- TEMPATKAN PEMANGGILAN NAVBAR ANDA DI SINI --}}
@include('components.Navbar') 
@include('components.herosectionkamar')

{{-- Search/Filter Bar (Diposisikan menindih Hero Section, DITURUNKAN DENGAN MENGURANGI MARGIN NEGATIF) --}}
<div class="relative z-30 -mt-0 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 bg-white p-6 rounded-2xl shadow-2xl ring-2 ring-yellow-500/50">
        {{-- Search Input Styling --}}
        <div class="flex-1">
            <div class="relative">
                <div class="absolute inset-y-8 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.435 4.195l4.156 4.156a.75.75 0 11-1.06 1.06l-4.155-4.156A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                </div>
                <input type="text" placeholder="Search by name or room type" class="block w-full rounded-xl border border-gray-300 py-3 pl-10 pr-4 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm placeholder-gray-500 shadow-inner transition duration-300">
            </div>
        </div>
        
        {{-- Filter Dropdown Styling --}}
        <div class="md:w-1/3 relative">
            <select class="block w-full rounded-xl border border-gray-300 py-3 pl-5 pr-25 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm appearance-none shadow-inner transition duration-300">
                <option>All Type</option>
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        
        <div class="md:w-1/4 relative">
            <select class="block w-full rounded-xl border border-gray-300 py-3 pl-4 pr-10 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm appearance-none shadow-inner transition duration-300">
                <option>Recomendation</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
                <option>Top Rated</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </div>
</div>


</div>

{{--
|--------------------------------------------------------------------------
| Room List Content (SEMUA STYLING ADA DI SINI)
|--------------------------------------------------------------------------
--}}

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
{{-- Grid Kamar (grid-cols-3) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
@forelse($kamars ?? [] as $kamar)
{{-- Kamar Card (Styling: rounded-2xl, shadow-xl, hover:shadow-2xl, hover:scale-[1.01], transition) --}}
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform hover:shadow-2xl hover:scale-[1.01] transition duration-300">

        {{-- Image Placeholder Area --}}
        <div class="relative h-60">
            <img class="w-full h-full object-cover" 
                 src="https://placehold.co/600x400/FACC15/FFFFFF/PNG?text={{ $kamar->tipe->nama_tipe ?? 'ROOM' }}" 
                 alt="Gambar Kamar {{ $kamar->nomor_kamar }}">

            {{-- Status Badge (Styling: rounded-full, bg-green-600/bg-red-600, shadow-lg) --}}
            <span class="absolute top-4 right-4 px-4 py-1.5 rounded-full text-xs font-bold uppercase shadow-lg 
                @if(($kamar->status_ketersediaan ?? 'booked') == 'available') 
                    bg-green-600 text-white 
                @else 
                    bg-red-600 text-white 
                @endif">
                {{ ucfirst($kamar->status_ketersediaan ?? 'Booked') }}
            </span>
        </div>
        
        <div class="p-6">
            {{-- Price (Styling: text-yellow-600, font-extrabold) --}}
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Room</p>
                    <h3 class="text-2xl font-bold text-gray-900">Kamar {{ $kamar->nomor_kamar }}</h3>
                </div>
                <div class="text-right">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Price</p>
                    <p class="text-2xl font-extrabold text-yellow-600">
                        Rp {{ number_format($kamar->tipe->harga_dasar ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</p>
            <p class="text-base font-semibold text-gray-700 mb-2">{{ $kamar->tipe->nama_tipe ?? 'Tipe Standar' }}</p>

            <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Perfect comfort with our selection of luxury hotel rooms.
            </p>

            {{-- Action Buttons --}}
            <div class="flex space-x-4">
                {{-- Detail Button (Styling: bg-gray-100, border, shadow-inner) --}}
                <a href="#" class="flex-1 text-center px-4 py-3 rounded-xl text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition font-semibold shadow-inner">
                    Detail
                </a>
                
                {{-- Booking Button (Styling: bg-yellow-600, shadow-lg shadow-yellow-500/50, hover:-translate-y-0.5) --}}
                @if(($kamar->status_ketersediaan ?? 'booked') == 'available')
                    <a href="{{ route('member.pemesanan.create', ['kamar' => $kamar->id_kamar]) }}" 
                       class="flex-1 text-center px-4 py-3 rounded-xl bg-yellow-600 text-white shadow-lg shadow-yellow-500/50 hover:bg-yellow-700 transition font-semibold transform hover:-translate-y-0.5">
                        Booking
                    </a>
                @else
                    {{-- Booked Button (Disabled) --}}
                    <button disabled class="flex-1 text-center px-4 py-3 rounded-xl bg-red-400 text-white font-semibold cursor-not-allowed opacity-70 shadow-inner">
                        Booked
                    </button>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-20 bg-white rounded-2xl shadow-2xl border border-gray-100">
        <p class="text-3xl font-bold text-gray-900 mb-2">Tidak ada Kamar Ditemukan</p>
        <p class="text-gray-500 text-lg">Saat ini tidak ada kamar yang terdaftar atau tersedia untuk ditampilkan.</p>
    </div>
@endforelse


</div>

<!-- Pagination -->

<div class="mt-16 flex justify-center">
{{ $kamars->links() ?? '' }}
</div>

</div>
@endsection
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.435 4.195l4.156 4.156a.75.75 0 11-1.06 1.06l-4.155-4.156A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                </div>
                <input type="text" placeholder="Search by name or room type" class="block w-full rounded-xl border border-gray-300 py-3 pl-10 pr-4 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm placeholder-gray-500 shadow-inner transition duration-300">
            </div>
        </div>
        
        {{-- Filter Dropdown Styling --}}
        <div class="md:w-1/4 relative">
            <select class="block w-full rounded-xl border border-gray-300 py-3 pl-4 pr-10 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm appearance-none shadow-inner transition duration-300">
                <option>All Type</option>
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        
        <div class="md:w-1/4 relative">
            <select class="block w-full rounded-xl border border-gray-300 py-3 pl-4 pr-10 text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 text-sm appearance-none shadow-inner transition duration-300">
                <option>Recomendation</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
                <option>Top Rated</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </div>
</div>


</div>

{{--
|--------------------------------------------------------------------------
| Room List Content (SEMUA STYLING ADA DI SINI)
|--------------------------------------------------------------------------
--}}

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
{{-- Grid Kamar (grid-cols-3) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
@forelse($kamars ?? [] as $kamar)
{{-- Kamar Card (Styling: rounded-2xl, shadow-xl, hover:shadow-2xl, hover:scale-[1.01], transition) --}}
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform hover:shadow-2xl hover:scale-[1.01] transition duration-300">

            {{-- Image Placeholder Area --}}
            <div class="relative h-60">
                <img class="w-full h-full object-cover" 
                     src="https://placehold.co/600x400/FACC15/FFFFFF/PNG?text={{ $kamar->tipe->nama_tipe ?? 'ROOM' }}" 
                     alt="Gambar Kamar {{ $kamar->nomor_kamar }}">

                {{-- Status Badge (Styling: rounded-full, bg-green-600/bg-red-600, shadow-lg) --}}
                <span class="absolute top-4 right-4 px-4 py-1.5 rounded-full text-xs font-bold uppercase shadow-lg 
                    @if(($kamar->status_ketersediaan ?? 'booked') == 'available') 
                        bg-green-600 text-white 
                    @else 
                        bg-red-600 text-white 
                    @endif">
                    {{ ucfirst($kamar->status_ketersediaan ?? 'Booked') }}
                </span>
            </div>
            
            <div class="p-6">
                {{-- Price (Styling: text-yellow-600, font-extrabold) --}}
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Room</p>
                        <h3 class="text-2xl font-bold text-gray-900">Kamar {{ $kamar->nomor_kamar }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Price</p>
                        <p class="text-2xl font-extrabold text-yellow-600">
                            Rp {{ number_format($kamar->tipe->harga_dasar ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</p>
                <p class="text-base font-semibold text-gray-700 mb-2">{{ $kamar->tipe->nama_tipe ?? 'Tipe Standar' }}</p>

                <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Perfect comfort with our selection of luxury hotel rooms.
                </p>

                {{-- Action Buttons --}}
                <div class="flex space-x-4">
                    {{-- Detail Button (Styling: bg-gray-100, border, shadow-inner) --}}
                    <a href="#" class="flex-1 text-center px-4 py-3 rounded-xl text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition font-semibold shadow-inner">
                        Detail
                    </a>
                    
                    {{-- Booking Button (Styling: bg-yellow-600, shadow-lg shadow-yellow-500/50, hover:-translate-y-0.5) --}}
                    @if(($kamar->status_ketersediaan ?? 'booked') == 'available')
                        <a href="{{ route('member.pemesanan.create', ['kamar' => $kamar->id_kamar]) }}" 
                           class="flex-1 text-center px-4 py-3 rounded-xl bg-yellow-600 text-white shadow-lg shadow-yellow-500/50 hover:bg-yellow-700 transition font-semibold transform hover:-translate-y-0.5">
                            Booking
                        </a>
                    @else
                        {{-- Booked Button (Disabled) --}}
                        <button disabled class="flex-1 text-center px-4 py-3 rounded-xl bg-red-400 text-white font-semibold cursor-not-allowed opacity-70 shadow-inner">
                            Booked
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20 bg-white rounded-2xl shadow-2xl border border-gray-100">
            <p class="text-3xl font-bold text-gray-900 mb-2">Tidak ada Kamar Ditemukan</p>
            <p class="text-gray-500 text-lg">Saat ini tidak ada kamar yang terdaftar atau tersedia untuk ditampilkan.</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-16 flex justify-center">
    {{ $kamars->links() ?? '' }}
</div>


</div>
@endsection