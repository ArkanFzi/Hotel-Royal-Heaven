<div class="sidebar w-64 flex-shrink-0 text-gray-800 shadow-xl flex flex-col">
    <div class="p-6 flex-grow overflow-y-auto">
        <div class="flex flex-col items-center mb-10">
            <div class="w-24 h-24 rounded-full bg-white border-4 border-gray-100 overflow-hidden shadow-lg mb-3">
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-yellow-400 to-yellow-600 text-white text-2xl font-bold">
                    ♛
                </div>
            </div>
            <div class="text-lg font-semibold text-gray-800">{{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</div>
            <div class="text-xs text-gray-600 mt-1">{{ Auth::user()->level === 'admin' ? 'Administrator' : 'Member' }}</div>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-item @if(request()->routeIs('admin.index')) active @endif">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('kamar.index') }}" class="nav-item @if(request()->routeIs('kamar.*')) active @endif">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 14V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2zM6 8h8v6H6V8z"></path></svg>
                Manajemen Kamar
            </a>

            <a href="{{ route('admin.pemesanan.index') }}" class="nav-item @if(request()->routeIs('admin.pemesanan.*')) active @endif">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path></svg>
                Pemesanan
            </a>

            <a href="{{ route('admin.members.index') }}" class="nav-item @if(request()->routeIs('admin.members.*')) active @endif">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 012-2h8a2 2 0 012 2v2h-2V3H6v2H4V3zM4 7h12v9a2 2 0 01-2 2H6a2 2 0 01-2-2V7z"></path></svg>
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
