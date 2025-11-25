@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-2xl mx-auto p-8 bg-white rounded-lg card-shadow">
        <h3 class="text-xl font-semibold mb-4">Forgot your password?</h3>
        <p class="text-sm text-gray-500 mb-6">Enter your email address and we'll send you a link to reset your password.</p>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <input name="email" type="email" required placeholder="Email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3">
                @error('email')<div class="text-sm text-red-500">{{ $message }}</div>@enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-gray-600">Back to Login</a>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Send Reset Link</button>
            </div>
        </form>
    </div>
@endsection
