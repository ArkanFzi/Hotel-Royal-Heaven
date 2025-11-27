@extends('layouts.app')

@section('page_title', 'Daftar Kamar')
@include('components.hero-section')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Daftar Kamar</h1>

    @if($kamars->isEmpty())
        <p>Tidak ada kamar tersedia saat ini.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($kamars as $room)
            <div class="border rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('storage/' . $room->foto_kamar) }}" alt="{{ $room->nomor_kamar }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $room->nomor_kamar }}</h2>
                    <p class="mt-2 text-gray-600">{{ $room->deskripsi }}</p>
                    <p class="mt-2 font-bold">Harga: Rp {{ number_format($room->tipe->harga_dasar, 0, ',', '.') }}</p>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('member.kamar.show', $room) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Detail</a>
                        @if($room->status_ketersediaan === 'available')
                            <a href="{{ route('member.pemesanan.create', ['kamar' => $room->id_kamar]) }}" class="inline-block px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Pesan Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
