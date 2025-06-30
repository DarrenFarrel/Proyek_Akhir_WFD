@extends('layouts.app')

@section('title', 'Hotel Information')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Hotel Information</h1>
                <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
            </div>
            
            <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                <form action="{{ route('admin.hotel-info.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Hotel Name</label>
                            <input type="text" name="name" value="{{ old('name', $hotelInfo->name ?? '') }}" required
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $hotelInfo->email ?? '') }}" required
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $hotelInfo->phone ?? '') }}" required
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Address</label>
                            <textarea name="address" rows="2" required
                                      class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">{{ old('address', $hotelInfo->address ?? '') }}</textarea>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Description</label>
                            <textarea name="description" rows="4" required
                                      class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">{{ old('description', $hotelInfo->description ?? '') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection