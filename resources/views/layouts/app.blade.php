<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Hotel Royal Heaven')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .navbar {
            background-color: #ffb833;
        }
        .logo {
            font-weight: bold;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-link {
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: #1f2937;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Hero Logo & Navbar -->
    <div class="relative">
        <!-- Logo Card Floating -->
        <div class="absolute left-0 top-0 z-20" style="transform: translateY(-32px);">
            <div class="bg-white rounded-xl shadow-lg px-6 py-4 flex flex-col items-center" style="width:120px;">
                <img src="{{ asset('user/logo-royal-heaven.png') }}" alt="Royal Heaven Logo" class="w-12 mb-2">
                <div class="text-xs text-gray-700 font-semibold text-center">ROYAL HEAVEN<br><span class="font-normal">Hotel & Resort</span><br><span class="text-[10px]">Est. 1999</span></div>
            </div>
        </div>
        <!-- Diagonal Yellow Background -->
        <div class="absolute left-0 top-0 w-64 h-48 z-10" style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%); background: #ffb833;"></div>
        <!-- Navbar -->
        <nav class="relative z-30 flex justify-center pt-8">
            <div class="bg-white rounded-full shadow-lg flex px-2 py-2 gap-2 w-[900px] max-w-full">
                <a href="{{ route('landing') }}" class="relative px-6 py-2 font-semibold text-gray-900 transition-colors @if(request()->routeIs('landing')) text-yellow-600 @endif">
                    Home
                    @if(request()->routeIs('landing'))
                        <span class="absolute left-1/2 -bottom-1.5 -translate-x-1/2 w-20 h-1 bg-yellow-400 rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('home') }}" class="relative px-6 py-2 font-semibold text-gray-900 transition-colors @if(request()->routeIs('home')) text-yellow-600 @endif">
                    Daftar Kamar
                    @if(request()->routeIs('home'))
                        <span class="absolute left-1/2 -bottom-1.5 -translate-x-1/2 w-20 h-1 bg-yellow-400 rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('pemesanan.create') }}" class="relative px-6 py-2 font-semibold text-gray-900 transition-colors @if(request()->routeIs('pemesanan.create')) text-yellow-600 @endif">
                    Pesan Kamar
                    @if(request()->routeIs('pemesanan.create'))
                        <span class="absolute left-1/2 -bottom-1.5 -translate-x-1/2 w-20 h-1 bg-yellow-400 rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('pemesanan.my') }}" class="relative px-6 py-2 font-semibold text-gray-900 transition-colors @if(request()->routeIs('pemesanan.my')) text-yellow-600 @endif">
                    Riwayat
                    @if(request()->routeIs('pemesanan.my'))
                        <span class="absolute left-1/2 -bottom-1.5 -translate-x-1/2 w-20 h-1 bg-yellow-400 rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('about') }}" class="relative px-6 py-2 font-semibold text-gray-900 transition-colors @if(request()->routeIs('about')) text-yellow-600 @endif">
                    About Us
                    @if(request()->routeIs('about'))
                        <span class="absolute left-1/2 -bottom-1.5 -translate-x-1/2 w-20 h-1 bg-yellow-400 rounded-full"></span>
                    @endif
                </a>
                <!-- Tambahkan menu lain jika perlu -->
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-8">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">♛</div>
                        Royal Heaven Hotel
                    </h3>
                    <p class="text-gray-400">Sistem manajemen pemesanan kamar hotel terpercaya dengan layanan terbaik.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Daftar Kamar</a></li>
                        @if(auth()->check())
                            <li><a href="{{ route('pemesanan.my') }}" class="hover:text-white transition">Pemesanan Saya</a></li>
                        @endif
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Telepon: +62 821 xxxx xxxx</li>
                        <li>Email: info@royalheaven.com</li>
                        <li>Alamat: Jl. Garuda No. 1, Malang</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Royal Heaven Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
