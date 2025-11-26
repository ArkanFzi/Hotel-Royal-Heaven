@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang di sistem manajemen hotel Royal Heaven')

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
                    <svg class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path></svg>
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
                    <svg class="h-6 w-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-5v5m5.5-5v5M3.5 11h13"></path></svg>
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
    </div>
@endsection
