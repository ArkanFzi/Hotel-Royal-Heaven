@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Profil Member</h1>
                        <p class="text-blue-100">Kelola informasi akun Anda</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Profile Photo and Activities -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Profile Photo Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Profil</h3>
                            <div class="flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden mb-4">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                            <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('member.profile.edit') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Ubah Foto
                                </a>
                            </div>
                        </div>

                        <!-- Current Activities -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Saat Ini</h3>
                            @if($currentActivities->count() > 0)
                                <div class="space-y-3">
                                    @foreach($currentActivities as $activity)
                                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">{{ $activity->kamar->nama_kamar ?? 'Kamar' }}</p>
                                                <p class="text-xs text-gray-600">{{ $activity->check_in->format('d M Y') }} - {{ $activity->check_out->format('d M Y') }}</p>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @if($activity->status_pemesanan == 'confirmed') bg-green-100 text-green-800
                                                    @elseif($activity->status_pemesanan == 'checked_in') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($activity->status_pemesanan) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">Tidak ada aktivitas saat ini</p>
                            @endif
                        </div>

                        <!-- Activity History -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Aktivitas</h3>
                            @if($activityHistory->count() > 0)
                                <div class="space-y-3 max-h-64 overflow-y-auto">
                                    @foreach($activityHistory as $activity)
                                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                            <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">{{ $activity->kamar->nama_kamar ?? 'Kamar' }}</p>
                                                <p class="text-xs text-gray-600">{{ $activity->check_in->format('d M Y') }} - {{ $activity->check_out->format('d M Y') }}</p>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @if($activity->status_pemesanan == 'completed') bg-green-100 text-green-800
                                                    @elseif($activity->status_pemesanan == 'cancelled') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($activity->status_pemesanan) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">Belum ada riwayat aktivitas</p>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column: Member Information -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Personal Information Card -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Informasi Pribadi</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Email</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">No. HP</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->nohp ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">NIK</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->nik ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Card -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Informasi Akun</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Status Akun</label>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3"/>
                                                </svg>
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Role</label>
                                        <p class="text-sm text-gray-900 mt-1">Member</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Tanggal Daftar</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Total Pemesanan</label>
                                        <p class="text-sm text-gray-900 mt-1">{{ $user->pemesanan->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6">
                            <a href="{{ route('member.profile.edit') }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('landing') }}"
                               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
