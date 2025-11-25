<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin / Dashboard</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* CSS Tambahan untuk gradasi warna sidebar dan highlight */
        .sidebar {
            background-color: #ffb833; /* Warna kuning oranye dari gambar */
        }
        .nav-item {
            padding: 1rem 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding-left: 2rem;
            transition: background-color 0.2s;
        }
        .nav-item.active {
            background-color: #f7a817; /* Warna sedikit lebih gelap dari sidebar */
            border-right: 5px solid #fff; /* Garis putih penanda aktif */
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
    </style>
</head>
<body class="bg-gray-50 flex h-screen">

    <div class="sidebar w-64 flex-shrink-0 text-white shadow-xl flex flex-col justify-between">
        <div class="p-6">
            <div class="flex flex-col items-center mb-10">
                <div class="w-24 h-24 rounded-full bg-white border-4 border-gray-100 overflow-hidden shadow-lg mb-3">
                    <img src="profilhotel.png" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <div class="text-lg font-semibold text-gray-800">Someone</div>
            </div>

            <nav>
                <a href="admin" class="nav-item active text-gray-800 hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Dashboard
                </a>

                <a href="kamar" class="nav-item text-gray-800 hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                    Manajemen Kamar
                </a>

                <a href="#" class="nav-item text-gray-800 hover:bg-opacity-90">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path></svg>
                    Pemesanan
                </a>

                <a href="#" class="nav-item text-gray-800 hover:bg-opacity-90">
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
            Admin / <span class="font-semibold text-gray-800">Dashboard</span>
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-sm font-normal text-gray-500 mb-6">Total Pengunjung</h2>
            
            <div class="flex items-end h-72">
                @php
                    $data = [
                        'JAN' => 250, 'FEB' => 155, 'MAR' => 120, 'APR' => 85,
                        'MAY' => 190, 'JUN' => 130, 'JUL' => 160
                    ];
                    $max = 250; // Nilai maksimum untuk skala
                @endphp

                <div class="w-8 flex flex-col justify-between h-full pr-2 text-xs text-gray-400 border-r border-gray-200">
                    <span>250</span>
                    <span>150</span>
                    <span>50</span>
                    <span>0</span>
                </div>
                
                <div class="flex flex-grow justify-around items-end h-full pl-4">
                    @foreach ($data as $month => $value)
                        @php
                            // Hitung tinggi batang relatif terhadap nilai maksimum (max = 250)
                            $height = ($value / $max) * 90; 
                        @endphp
                        <div class="flex flex-col items-center w-1/7">
                            <div 
                                class="w-10 bg-yellow-400 hover:bg-yellow-500 transition-all duration-300 rounded-t-sm" 
                                style="height: {{ $height }}%;" 
                                title="{{ $value }} Pengunjung"
                            ></div>
                            <div class="mt-2 text-xs text-gray-600">{{ $month }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md max-w-xs">
                <h3 class="text-sm font-semibold text-gray-600 mb-2 p-2 bg-gray-200 rounded-sm">Total Pemesanan</h3>
                <p class="text-5xl font-light text-gray-700 p-2">2780</p>
            </div>
            
        </div>

    </div>

</body>
</html>