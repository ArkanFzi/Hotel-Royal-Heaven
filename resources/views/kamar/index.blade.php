<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin / Manajemen Kamar</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* CSS Sidebar */
        .sidebar {
            background-color: #ffb833; /* Warna kuning oranye */
        }
        .nav-item {
            padding: 1rem 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding-left: 2rem;
            transition: background-color 0.2s;
            text-decoration: none; /* Pastikan link tidak bergaris bawah */
            color: inherit;
        }
        /* Item 'Manajemen Kamar' adalah yang aktif */
        .nav-item.active-manajemen {
            background-color: #f7a817; 
            border-right: 5px solid #fff; 
        }
        .nav-item:hover {
            background-color: rgba(247, 168, 23, 0.9); /* Sedikit lebih gelap dari warna sidebar */
        }
        .logout-link {
            padding: 1rem 0;
            cursor: pointer;
            display: block;
            padding-left: 2rem;
            color: #b91c1c; /* Warna merah */
            font-weight: 600;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: auto; /* Dorong ke bawah */
        }
        .logout-link:hover {
            background-color: #f7a817; 
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-50 flex h-screen">

    <div class="sidebar w-64 flex-shrink-0 text-gray-800 shadow-xl flex flex-col">
        <div class="p-6 flex-grow">
            <div class="flex flex-col items-center mb-10">
                <div class="w-24 h-24 rounded-full bg-white border-4 border-gray-100 overflow-hidden shadow-lg mb-3">
                    <img src="profilhotel.png" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <div class="text-lg font-semibold text-gray-800">Someone</div>
            </div>

            <nav>
                <a href="admin" class="nav-item hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Dashboard
                </a>

                <a href="kamar" class="nav-item active-manajemen">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                    Manajemen Kamar
                </a>

                <a href="pemesanan" class="nav-item hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path></svg>
                    Pemesanan
                </a>

                <a href="#" class="nav-item hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.586 2.586a1 1 0 001.414-1.414L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    Riwayat Pemesanan
                </a>
            </nav>
        </div>
        
        <a href="#" class="logout-link" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h5a1 1 0 000-2H4V4h4a1 1 0 100-2H3zm13 9a1 1 0 00.293-.707l-3-3a1 1 0 00-1.414 1.414L13.586 11H9a1 1 0 100 2h4.586l-1.293 1.293a1 1 0 001.414 1.414l3-3A1 1 0 0016 12z" clip-rule="evenodd"></path></svg>
            Logout
        </a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    
    <div class="flex-grow p-8 overflow-y-auto">

        <h1 class="text-xl font-light text-gray-600 mb-8 pb-4 border-b">
            Admin / <span class="font-semibold text-gray-800">Manajemen Kamar</span>
        </h1>

        <div class="mb-12">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Daftar Kamar</h2>
                <a href="#" class="flex items-center bg-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:bg-gray-400 transition-colors">
                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add Data Kamar
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kamars as $k)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $k->nomor_kamar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $k->tipe->nama_tipe ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp{{ number_format($k->tipe->harga_dasar ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($k->status_ketersediaan == 'Tersedia')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                @elseif($k->status_ketersediaan == 'Dipakai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dipakai</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $k->status_ketersediaan }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('kamar.edit', $k->id_kamar) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form method="POST" action="{{ route('kamar.destroy', $k->id_kamar) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    @else
                                        <a href="{{ route('pemesanan.create') }}" class="text-blue-600 hover:text-blue-900">Pesan</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">Login to book</a>
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Pastikan kamu punya pagination jika $kamars adalah instance Paginator --}}
                {{ $kamars->links() }} 
            </div>
        </div>

        <hr class="border-gray-300 my-8">
        
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Daftar Tipe Kamar</h2>
                <a href="#" class="flex items-center bg-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:bg-gray-400 transition-colors">
                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add Tipe Kamar
                </a>
            </div>
            
            <div class="bg-gray-200 p-6 h-56 rounded-lg shadow-md flex items-center justify-center text-gray-500">
                Placeholder Tabel Tipe Kamar (di sini kamu akan menambahkan tabel Tipe Kamar)
            </div>
        </div>

    </div>

</body>
</html>