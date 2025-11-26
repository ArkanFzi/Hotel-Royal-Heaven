@extends('layouts.admin')

@section('page_title', 'Manajemen Kamar')
@section('page_subtitle', 'Kelola semua kamar di hotel Royal Heaven')

@section('content')
    <section class="w-full max-w-7xl mx-auto py-12 px-6">
        <div class="flex flex-col gap-12">
            <!-- Card: Manajemen Kamar -->
            <div class="bg-white rounded-xl shadow-lg p-6 relative">
                <a href="{{ route('kamar.create') }}" class="absolute right-6 top-6 inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-md shadow transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path></svg>
                    Add DataKamar
                </a>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Manajemen Kamar</h2>
                <div class="min-h-[200px] bg-gray-50 rounded-md p-4">
                    @if($kamars->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($kamars as $kamar)
                                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <h3 class="font-semibold text-blue-900">Kamar {{ $kamar->nomor_kamar }}</h3>
                                            <div class="text-xs text-gray-500">{{ $kamar->tipe->nama_tipe ?? '-' }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-bold text-yellow-600">Rp{{ number_format($kamar->tipe->harga_dasar ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $kamar->deskripsi ?? '—' }}</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('kamar.edit', $kamar) }}" class="flex-1 text-center bg-blue-900 hover:bg-blue-800 text-white py-2 rounded font-semibold transition-colors">Edit</a>
                                        <form method="POST" action="{{ route('kamar.destroy', $kamar) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">{{ $kamars->links() }}</div>
                    @else
                        <div class="text-center text-gray-500 py-8">Belum ada data kamar.</div>
                    @endif
                </div>
            </div>

            <!-- Card: Manajemen Tipe Kamar -->
            <div class="bg-white rounded-xl shadow-lg p-6 relative">
                <a href="#" class="absolute right-6 top-6 inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-md shadow transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path></svg>
                    Add Tipe Kamar
                </a>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Manajemen Tipe Kamar</h2>
                <div class="min-h-[200px] bg-gray-50 rounded-md p-4">
                    @if($tipeKamars->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($tipeKamars as $tipe)
                                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
                                    <div>
                                        <h3 class="font-semibold text-blue-900">{{ $tipe->nama_tipe }}</h3>
                                        <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($tipe->deskripsi ?? '-', 80) }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-bold text-yellow-600">Rp{{ number_format($tipe->harga_dasar ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-gray-500 py-8">Belum ada tipe kamar.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection