@extends('layouts.auth')

@section('content')
    <style>
        /* CSS Kustom untuk menampung Gambar Latar Belakang */
        .auth-bg-image {
            /* Menggunakan gambar yang kamu kirim sebagai latar belakang */
            /* Catatan: Ganti 'URL_GAMBAR_HOTEL' dengan path atau URL gambar yang benar di lingkungan Laravel-mu. */
            /* Jika menggunakan gambar yang diupload, kamu mungkin perlu menyimpan dan memanggilnya via asset() */
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('gambarhotel.jpg'); 
            background-size: cover;
            background-position: center;
        }
    </style>

    <div class="w-full max-w-6xl mx-auto rounded-lg overflow-hidden grid grid-cols-1 md:grid-cols-2 shadow-xl">
        
        <div class="hidden md:block auth-bg-image p-12 text-white">
            <div class="h-full flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full"></div> 
                        <h1 class="text-xl font-semibold">ROYAL HEAVEN</h1>
                    </div>
                    <h2 class="text-4xl font-extrabold mb-4">Where Luxury Meets Perfection</h2>
                    <p class="text-gray-200 max-w-md">Experience world-class hospitality with our premium services and unmatched comfort.</p>
                </div>

                <div class="flex gap-8 text-sm">
                    <div>
                        <div class="text-yellow-400 font-bold text-2xl">200+</div>
                        <div class="text-gray-100">Luxury Rooms</div>
                    </div>
                    <div>
                        <div class="text-yellow-400 font-bold text-2xl">25+</div>
                        <div class="text-gray-100">Locations</div>
                    </div>
                    <div>
                        <div class="text-yellow-400 font-bold text-2xl">24/7</div>
                        <div class="text-gray-100">Concierge</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-white">
            <div class="max-w-md mx-auto">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-yellow-400 flex items-center justify-center text-white text-2xl">♛</div>
                </div>

                <h3 class="text-center text-3xl font-bold mb-2 text-gray-800">Create Account</h3>
                <p class="text-center text-sm text-gray-500 mb-8">Register to book rooms and manage your bookings</p>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input name="username" id="username" type="text" required placeholder="Username" value="{{ old('username') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('username') border-red-500 @enderror">
                        @error('username')<span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                   

                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input name="email" id="email" type="email" required placeholder="Email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('email') border-red-500 @enderror">
                        @error('email')<span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input name="password" id="password" type="password" required placeholder="Password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('password') border-red-500 @enderror">
                        @error('password')<span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <input name="password_confirmation" id="password_confirmation" type="password" required placeholder="Confirm Password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-3 font-semibold transition-colors duration-200">Register</button>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <div class="text-sm text-gray-400">or</div>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <div class="text-center text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-yellow-500 font-medium hover:text-yellow-600">Login Here</a></div>
                </form>
            </div>
        </div>
    </div>
@endsection