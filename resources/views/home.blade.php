@extends('layouts.app')

@section('page_title', 'Home')

@section('content')
</head>
<body class="bg-white font-sans">

    {{-- Header dipisah ke komponen --}}
    @include('components.Navbar')
    @include('components.hero-section')
        
        <hr class="max-w-7xl mx-auto">
        

      <!-- START: A Little About Us Section (Further Reduced Size) -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        
        <!-- Kiri: Teks dan Deskripsi -->
        <div class="pr- lg:pr-6">
            <h2 class="text-3xl font-extrabold mb-3 text-gray-900">
                A <span class="text-amber-600">little</span> about us
            </h2>
            <p class="text-sm text-gray-600 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed ut perspiciatis unde omnis iste 
                natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
            </p>
            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                Kami adalah Royal Heaven, destinasi terbaik untuk pengalaman menginap mewah dan tak terlupakan.
                Setiap detail kami rancang untuk kenyamanan Anda.
            </p>
        </div>

        <!-- Kanan: Grid Gambar Placeholder -->
        <div class="grid grid-cols-2 grid-rows-2 gap-2 min-h-[300px]">
            
            <!-- Placeholder Atas Kiri -->
            <div class="rounded-lg shadow-md relative overflow-hidden group">
                {{-- WAJIB: Ganti placeholder ini dengan tag <img> dan URL gambar kamu --}}
                <img src="user/ruangkanan.jpg" alt="Kamar Deluxe" class="absolute inset-0 w-full h-full object-cover">

                
                {{-- Overlay Link untuk Upload Gambar 1 --}}
                <a href="user/ruangkanan.jpg" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center text-white text-xs font-bold p-2 z-20">
                </a>
            </div>

            <!-- Placeholder Atas Kanan -->
            <div class="rounded-lg shadow-md relative overflow-hidden group">
                {{-- WAJIB: Ganti placeholder ini dengan tag <img> dan URL gambar kamu --}}
                <img src="user/ruangkiri.jpg" alt="Kolam Renang" class="absolute inset-0 w-full h-full object-cover">
                
               
                {{-- Overlay Link untuk Upload Gambar 2 --}}
                <a href="user/ruangkiri.jpg" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center text-white text-xs font-bold p-2 z-20">
                    
                </a>
            </div>
            
            <!-- Placeholder Besar Bawah (Col Span 2) -->
            <div class="col-span-2 rounded-lg shadow-md relative overflow-hidden group">
                {{-- WAJIB: Ganti placeholder ini dengan tag <img> dan URL gambar kamu --}}
                <img src="user/fotoblokbawah.avif" alt="Lobi Hotel Utama" class="absolute inset-0 w-full h-full object-cover">

                {{-- Overlay Link untuk Upload Gambar 3 --}}
                <a href="user/fotoblokbawah.avif" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center text-white text-xs font-bold p-2 z-20">
                    
                </a>
            </div>
        </div>

    </div>
</section>
<!-- END: A Little About Us Section -->
        <!-- Popular Rooms Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-12">Our Most Popular Rooms</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-200 h-48 w-full"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Headline</h3>
                        <p class="mt-2 text-sm text-gray-500 line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                        <div class="mt-4 flex justify-end">
                            <a href="#" class="text-sm font-medium text-orange-500 hover:text-orange-600 border border-orange-500 px-3 py-1 rounded-full transition duration-150 ease-in-out">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </section>
        

    </main>

    </body>
</html>