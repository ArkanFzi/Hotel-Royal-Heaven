@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-2xl mx-auto p-8 bg-white rounded-lg card-shadow">
        <h3 class="text-xl font-semibold mb-4">Reset Password</h3>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <input name="email" type="email" required placeholder="Email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3">
                @error('email')<div class="text-sm text-red-500">{{ $message }}</div>@enderror
            </div>

            <div>
                <input name="password" type="password" required placeholder="New password" class="w-full border rounded-lg px-4 py-3">
                @error('password')<div class="text-sm text-red-500">{{ $message }}</div>@enderror
            </div>

            <div>
                <input name="password_confirmation" type="password" required placeholder="Confirm password" class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-gray-600">Back to Login</a>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Reset Password</button>
            </div>
        </form>
    </div>
@endsection
