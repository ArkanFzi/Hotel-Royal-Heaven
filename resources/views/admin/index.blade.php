@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang di sistem manajemen hotel Royal Heaven')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card: Total Kamar (Warna Amber/Kuning) -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500 transition duration-300 hover:shadow-xl">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-amber-100 rounded-full">
                    <svg class="h-6 w-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-semibold text-gray-500 truncate">Total Kamar</dt>
                        <dd class="text-3xl font-extrabold text-gray-900">{{ $totalKamar ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Kamar Tersedia (Warna Hijau) -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transition duration-300 hover:shadow-xl">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-green-100 rounded-full">
                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-semibold text-gray-500 truncate">Kamar Tersedia</dt>
                        <dd class="text-3xl font-extrabold text-gray-900">{{ $kamarTersedia ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Total Pemesanan (Warna Biru) -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 transition duration-300 hover:shadow-xl">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-full">
                    <svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-semibold text-gray-500 truncate">Total Pemesanan</dt>
                        <dd class="text-3xl font-extrabold text-gray-900">{{ $totalPemesanan ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Total Member (Warna Ungu) -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transition duration-300 hover:shadow-xl">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-purple-100 rounded-full">
                    <svg class="h-6 w-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-5v5m5.5-5v5M3.5 11h13"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-semibold text-gray-500 truncate">Total Member</dt>
                        <dd class="text-3xl font-extrabold text-gray-900">{{ $totalMember ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bagian Pemesanan Terbaru (Menggunakan $recentBookings) -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Pemesanan Terbaru</h2>
        
        {{-- Logika untuk menampilkan data $recentBookings --}}
        @if(isset($recentBookings) && $recentBookings->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentBookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $booking->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $booking->kamar->nomor_kamar ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ \Carbon\Carbon::parse($booking->tgl_check_in)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $booking->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $booking->status == 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 italic">Belum ada pemesanan terbaru yang tercatat.</p>
        @endif

    </div>

@endsection