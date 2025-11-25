<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin / Pemesanan</title>
    
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
            color: #4b5563; /* text-gray-800 */
        }
        .nav-item:hover {
            background-color: rgba(247, 168, 23, 0.9); /* Sedikit lebih gelap dari warna sidebar */
        }
        /* Item 'Pemesanan' adalah yang aktif */
        .nav-item.active-pemesanan {
            background-color: #f7a817; 
            border-right: 5px solid #fff; 
         }
        /* Style tambahan untuk tombol logout */
        /* Update CSS di bagian <style> */

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

        /* Hapus .logout-link CSS yang lama */
    </style>
</head>
<body class="bg-gray-50 flex h-screen">

    <div class="sidebar w-64 flex-shrink-0 text-gray-800 shadow-xl flex flex-col justify-between">
        
        <div class="p-6">
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

                <a href="kamar" class="nav-item hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                    Manajemen Kamar
                </a>

                <a href="pemesanan" class="nav-item active-pemesanan">
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
            Admin / <span class="font-semibold text-gray-800">Pemesanan</span>
        </h1>

        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Daftar Pemesanan</h2>
            <input 
                type="text" 
                placeholder="Search" 
                class="w-64 py-3 px-4 border border-gray-200 rounded-lg shadow-sm bg-gray-200 text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-150"
            >
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pemesanan as $p)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $p->kode_pemesanan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->kamar->nomor_kamar ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($p->tgl_check_in)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($p->tgl_check_out)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @php
                                $status = strtolower($p->status_pemesanan);
                                $class = 'bg-gray-100 text-gray-800'; // Default
                                if (str_contains($status, 'pending')) {
                                    $class = 'bg-yellow-100 text-yellow-800';
                                } elseif (str_contains($status, 'sukses') || str_contains($status, 'selesai')) {
                                    $class = 'bg-green-100 text-green-800';
                                } elseif (str_contains($status, 'batal')) {
                                    $class = 'bg-red-100 text-red-800';
                                }
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                {{ $p->status_pemesanan }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{-- Pastikan kamu punya pagination jika $pemesanan adalah instance Paginator --}}
            {{ $pemesanan->links() }}
        </div>
        
    </div>

</body>
</html>