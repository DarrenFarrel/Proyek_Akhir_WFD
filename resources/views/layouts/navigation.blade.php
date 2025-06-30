<nav class="bg-[#EBE3DB] shadow-lg" x-data="{ mobileMenuOpen: false, profileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route(auth()->user() && auth()->user()->isAdmin() ? 'admin.dashboard' : 'home') }}" class="flex items-center">
                        <span class="text-xl font-serif font-bold text-[#3A2D28]">WESTIN JAKARTA</span>
                    </a>
                </div>
                @if(!(auth()->user() && auth()->user()->isAdmin()))
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'border-[#A48374] text-[#3A2D28]' : 'border-transparent text-[#A48374] hover:border-[#D1C7BD] hover:text-[#3A2D28]' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'border-[#A48374] text-[#3A2D28]' : 'border-transparent text-[#A48374] hover:border-[#D1C7BD] hover:text-[#3A2D28]' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        About
                    </a>
                    @auth
                    <a href="{{ route('booking.my-bookings') }}" class="{{ request()->is('booking/my-bookings') ? 'border-[#A48374] text-[#3A2D28]' : 'border-transparent text-[#A48374] hover:border-[#D1C7BD] hover:text-[#3A2D28]' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        My Bookings
                    </a>
                    @endauth
                </div>
                @endif
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <div class="flex items-center">
                        <div class="mr-3 text-right hidden md:block">
                            <p class="text-sm font-medium text-[#3A2D28]">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-[#A48374]">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="ml-3 relative">
                            <div>
                                <button @click="profileMenuOpen = !profileMenuOpen" 
                                        @click.away="profileMenuOpen = false"
                                        type="button" 
                                        class="bg-[#EBE3DB] rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#CBAD8D] transition-all duration-300" 
                                        id="user-menu-button" 
                                        aria-expanded="false" 
                                        aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gradient-to-r from-[#A48374] to-[#CBAD8D] text-[#3A2D28] transform hover:scale-110 transition-transform duration-300">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                </button>
                            </div>

                            <div x-show="profileMenuOpen" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-[#EBE3DB] ring-1 ring-[#3A2D28] ring-opacity-5 focus:outline-none z-50" 
                                 role="menu" 
                                 aria-orientation="vertical" 
                                 aria-labelledby="user-menu-button"
                                 x-cloak>
                                <div class="px-4 py-2 border-b border-[#D1C7BD]">
                                    <p class="text-sm font-medium text-[#3A2D28] truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-[#A48374] truncate">{{ auth()->user()->email }}</p>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" 
                                    class="block px-4 py-2 text-sm text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-200" 
                                    role="menuitem"
                                    @click="profileMenuOpen = false">
                                        Admin Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('booking.my-bookings') }}" 
                                    class="block px-4 py-2 text-sm text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-200" 
                                    role="menuitem"
                                    @click="profileMenuOpen = false">
                                        My Bookings
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" role="none">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-200" 
                                            role="menuitem">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[#A48374] hover:text-[#3A2D28] px-3 py-2 text-sm font-medium transition-colors duration-300">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-[#3A2D28] bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#CBAD8D] transition-all duration-300 transform hover:scale-105">
                        Register
                    </a>
                @endauth
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#CBAD8D] transition-colors duration-300" 
                        aria-controls="mobile-menu">
                    <span class="sr-only">Open main menu</span>
                    <i x-show="!mobileMenuOpen" class="fas fa-bars"></i>
                    <i x-show="mobileMenuOpen" class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="sm:hidden" 
         id="mobile-menu"
         x-cloak>
        @if(!(auth()->user() && auth()->user()->isAdmin()))
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="bg-[#D1C7BD] border-[#A48374] text-[#3A2D28] block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                Home
            </a>
            <a href="{{ route('about') }}" class="border-transparent text-[#A48374] hover:bg-[#D1C7BD] hover:border-[#D1C7BD] hover:text-[#3A2D28] block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                About
            </a>
            @auth
            <a href="{{ route('booking.my-bookings') }}" class="border-transparent text-[#A48374] hover:bg-[#D1C7BD] hover:border-[#D1C7BD] hover:text-[#3A2D28] block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                My Bookings
            </a>
            @endauth
        </div>
        @endif
        <div class="pt-4 pb-3 border-t border-[#D1C7BD]">
            @auth
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-[#A48374] to-[#CBAD8D] text-[#3A2D28]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-[#3A2D28]">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-[#A48374]">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-300">
                            Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('booking.my-bookings') }}" class="block px-4 py-2 text-base font-medium text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-300">
                            My Bookings
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-300">
                            Sign out
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-300">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-[#A48374] hover:text-[#3A2D28] hover:bg-[#D1C7BD] transition-colors duration-300">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('nav', () => ({
            mobileMenuOpen: false,
            profileMenuOpen: false
        }));
    });
</script>