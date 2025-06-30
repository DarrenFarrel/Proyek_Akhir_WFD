@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#F1EDE6]">
    <div class="max-w-md w-full p-8 bg-[#EBE3DB] rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#3A2D28] font-serif mb-2">Create Account</h1>
        </div>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-[#CBAD8D]/10 text-[#3A2D28] rounded-lg border-l-4 border-[#CBAD8D]">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-[#3A2D28] mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200 @error('name') border-[#A48374] @enderror"
                       placeholder="John Doe">
                @error('name')
                    <span class="text-[#A48374] text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-[#3A2D28] mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200 @error('email') border-[#A48374] @enderror"
                       placeholder="your@email.com">
                @error('email')
                    <span class="text-[#A48374] text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-[#3A2D28] mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200 @error('password') border-[#A48374] @enderror"
                       placeholder="••••••••">
                @error('password')
                    <span class="text-[#A48374] text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-[#3A2D28] mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200"
                       placeholder="••••••••">
            </div>

            <div>
                <button type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md">
                    Register
                </button>
            </div>

            <div class="text-center text-sm text-[#A48374]">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#A48374] hover:text-[#3A2D28] font-medium transition-colors duration-200">
                    Sign in here
                </a>
            </div>
        </form>
    </div>
</div>
@endsection