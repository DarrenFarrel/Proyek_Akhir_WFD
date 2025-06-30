<div class="w-64 bg-gradient-to-b from-[#3A2D28] to-[#A48374] text-[#F1EDE6] min-h-screen shadow-xl transition-all duration-300">
    <div class="p-6 border-b border-[#CBAD8D] flex items-center space-x-3">
        <div class="w-10 h-10 rounded-full bg-[#CBAD8D] flex items-center justify-center text-[#3A2D28] font-bold">
            <span>A</span>
        </div>
        <div>
            <h2 class="text-xl font-bold">Admin Dashboard</h2>
        </div>
    </div>
    
    <nav class="p-4">
        <div class="mb-8">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#D1C7BD] mb-4">Navigation</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#CBAD8D] shadow-md text-[#3A2D28]' : 'hover:bg-[#A48374] hover:shadow-md' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="mb-8">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#D1C7BD] mb-4">Management</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.rooms.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.rooms.*') ? 'bg-[#CBAD8D] shadow-md text-[#3A2D28]' : 'hover:bg-[#A48374] hover:shadow-md' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Room Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-[#CBAD8D] shadow-md text-[#3A2D28]' : 'hover:bg-[#A48374] hover:shadow-md' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Booking Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-[#CBAD8D] shadow-md text-[#3A2D28]' : 'hover:bg-[#A48374] hover:shadow-md' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Reviews
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="mb-8">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[#D1C7BD] mb-4">Settings</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.hotel-info') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.hotel-info*') ? 'bg-[#CBAD8D] shadow-md text-[#3A2D28]' : 'hover:bg-[#A48374] hover:shadow-md' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Hotel Information
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>