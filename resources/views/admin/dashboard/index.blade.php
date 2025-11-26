@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang di dashboard admin hotel Royal Heaven')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card: Total Kamar -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Kamar</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalKamar ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Kamar Tersedia -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Kamar Tersedia</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $kamarTersedia ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Total Pemesanan -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Pemesanan</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalPemesanan ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card: Total Member -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"></path></svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Member</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalMember ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Statistik Pengunjung Bulanan</h2>
        
        <div class="flex items-end h-72">
            <div class="w-8 flex flex-col justify-between h-full pr-2 text-xs text-gray-400 border-r border-gray-200">
                <span>250</span>
                <span>150</span>
                <span>50</span>
                <span>0</span>
            </div>
            
            <div class="flex flex-grow justify-around items-end h-full pl-4">
                @php
                    $data = [
                        'JAN' => 120, 'FEB' => 155, 'MAR' => 145, 'APR' => 185,
                        'MAY' => 200, 'JUN' => 170, 'JUL' => 210
                    ];
                    $max = 250;
                @endphp

                @foreach ($data as $month => $value)
                    @php
                        $height = ($value / $max) * 90;
                    @endphp
                    <div class="flex flex-col items-center w-1/7">
                        <div 
                            class="w-10 bg-gradient-to-t from-yellow-500 to-yellow-300 hover:from-yellow-600 hover:to-yellow-400 transition-all duration-300 rounded-t-sm" 
                            style="height: {{ $height }}%;" 
                            title="{{ $value }} Pengunjung"
                        ></div>
                        <div class="mt-2 text-xs text-gray-600 font-medium">{{ $month }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    
        
        @if($recentBookings && count($recentBookings) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pemesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->kode_pemesanan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->user->nama_lengkap ?? $booking->user->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->kamar->nomor_kamar ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($booking->tgl_check_in)
                                        {{ \Carbon\Carbon::parse($booking->tgl_check_in)->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $status = strtolower($booking->status_pemesanan);
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                        if (strpos($status, 'pending') !== false) {
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                        } elseif (strpos($status, 'confirmed') !== false || strpos($status, 'completed') !== false) {
                                            $statusClass = 'bg-green-100 text-green-800';
                                        } elseif (strpos($status, 'cancelled') !== false) {
                                            $statusClass = 'bg-red-100 text-red-800';
                                        }
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($booking->status_pemesanan) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            
        @endif
    </div>

@endsection
