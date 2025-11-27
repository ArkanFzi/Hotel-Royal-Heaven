@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    @include('components.hero-about')

    {{-- Section Story --}}
    <section id="story" class="bg-[#F7F7F7] py-16 px-6 sm:px-10 lg:px-20">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

            {{-- Kolom Kiri --}}
            <div class="bg-white p-8 rounded-2xl shadow flex flex-col">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Our Story</h3>
                <h4 class="text-2xl font-bold mb-4">Journey to Excellence</h4>

                <p class="text-gray-600 leading-relaxed mb-6">
                    Royal Heaven Hotel has become a symbol of unparalleled luxury and hospitality. Starting with a simple
                    vision to create a place where every guest feels special, we have grown to become one of Indonesia's
                    leading hotels.<br><br>

                    With a combination of magnificent classic architecture and the latest modern amenities, we continually
                    innovate to provide the perfect stay experience. Every detail is meticulously designed to ensure
                    maximum comfort and satisfaction.
                </p>

                <div class="grid sm:grid-cols-2 gap-4 mt-auto">
                    <div class="border p-4 rounded-xl">
                        <h5 class="font-semibold text-gray-700">Our Vision</h5>
                        <p class="text-gray-600 text-sm">
                            To be the preferred hotel offering a world-class accommodation experience.
                        </p>
                    </div>
                    <div class="border p-4 rounded-xl">
                        <h5 class="font-semibold text-gray-700">Our Mission</h5>
                        <p class="text-gray-600 text-sm">
                            To provide the best service, prioritizing guest satisfaction and comfort.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan (Gambar) --}}
            <div class="rounded-2xl overflow-hidden shadow hidden lg:block">
                <img src="{{ asset('user/royalheaven.png') }}" alt="Royal Heaven Hotel" class="w-full h-full object-cover">
            </div>

        </div>
    </section>

    {{-- Section Values --}}
    <section class="py-20 text-center">
        <h5 class="text-sm text-gray-500 mb-1">Our Values</h5>
        <h2 class="text-3xl font-bold mb-4">Our Commitment to Excellence</h2>
        <p class="text-gray-600 max-w-lg mx-auto mb-10">
            Fundamental values that underpin every service and interaction we provide with our guests.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto px-6">
            @foreach ([['🧡','Sincere Hospitality'],['✨','Premium Quality'],['👤','Professional Team'],['🏆','Service Excellence']] as $item)
                <div class="border p-6 rounded-2xl text-left hover:shadow-md transition">
                    <div class="text-3xl mb-3">{{ $item[0] }}</div>
                    <h3 class="font-semibold mb-1">{{ $item[1] }}</h3>
                    <p class="text-sm text-gray-600">
                        {{ $loop->index == 0 ? 'We serve with our hearts, ensuring every guest feels welcomed and valued like family.' : '' }}
                        {{ $loop->index == 1 ? 'The highest standards in facilities, services, and experiences for maximum satisfaction.' : '' }}
                        {{ $loop->index == 2 ? 'Experienced and trained staff ready to provide the best service 24/7.' : '' }}
                        {{ $loop->index == 3 ? 'Commitment to exceeding expectations and creating unforgettable moments.' : '' }}
                    </p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-[#C3922E] py-14 text-center text-white">
        <h3 class="text-xl mb-2">Ready for a special stay?</h3>
        <p class="text-sm mb-8 opacity-90">
            Join thousands of guests who have trusted us to create unforgettable moments.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('daftarkamar') }}" class="px-6 py-3 bg-white text-[#C3922E] rounded-lg hover:opacity-90 transition">
                View Available Rooms
            </a>
            <a href="#contact" class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-[#C3922E] transition">
                Contact Us
            </a>
        </div>
    </section>

@endsection
