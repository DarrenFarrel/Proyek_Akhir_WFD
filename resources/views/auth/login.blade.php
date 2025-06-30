@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#F1EDE6]">
    <div class="max-w-md w-full p-8 bg-[#EBE3DB] rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#3A2D28] font-serif mb-2">Welcome Back</h1>
            <p class="text-[#A48374]">Sign in to your account</p>
        </div>
        
        @if($errors->any())
            <div class="mb-4 p-4 bg-[#A48374]/10 text-[#A48374] rounded-lg border-l-4 border-[#A48374]">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-[#3A2D28] mb-1">Email Address</label>
                <input type="email" name="email" id="email" required 
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200"
                       value="{{ old('email') }}"
                       placeholder="your@email.com">
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-[#3A2D28] mb-1">Password</label>
                <input type="password" name="password" id="password" required 
                       class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200"
                       placeholder="••••••••">
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-[#A48374] focus:ring-[#CBAD8D] border-[#A48374] rounded">
                    <label for="remember" class="ml-2 block text-sm text-[#3A2D28]">Remember me</label>
                </div>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#A48374] hover:text-[#3A2D28] transition-colors duration-200">
                        Forgot password?
                    </a>
                @endif
            </div>
            
            <div>
                <button type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md">
                    Sign In
                </button>
            </div>
            
            <div class="text-center text-sm text-[#A48374]">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-[#A48374] hover:text-[#3A2D28] font-medium transition-colors duration-200">
                    Register here
                </a>
            </div>
        </form>
    </div>
</div>
@endsection