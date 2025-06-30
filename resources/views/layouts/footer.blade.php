@unless(auth()->check() && auth()->user()->isAdmin())
<footer class="bg-gradient-to-b from-[#3A2D28] to-[#A48374] text-[#F1EDE6] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-serif font-bold mb-4">WESTIN JAKARTA</h3>
                <p class="text-[#D1C7BD] text-lg">Luxury Redefined in the heart of Jakarta's golden triangle.</p>
            </div>
            <div>
                <h4 class="text-base font-semibold uppercase tracking-wider mb-4">Quick Links</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-[#D1C7BD] hover:text-[#F1EDE6] text-lg transition-all duration-300 hover:pl-2 block">
                            <i class="fas fa-home mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-[#D1C7BD] hover:text-[#F1EDE6] text-lg transition-all duration-300 hover:pl-2 block">
                            <i class="fas fa-info-circle mr-2"></i> About
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-base font-semibold uppercase tracking-wider mb-4">Contact</h4>
                <address class="text-[#D1C7BD] not-italic text-lg space-y-2">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-2 w-4"></i>
                        <div>
                            <p>Jalan HR Rasuna Said Kav C-22</p>
                            <p>Jakarta 12940, Indonesia</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-2 w-4"></i>
                        <p>+62 21 2788 7788</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-2 w-4"></i>
                        <p>reservation@westinjakarta.com</p>
                    </div>
                </address>
            </div>
            <div class="flex flex-col items-center md:items-start">
                <h4 class="text-base font-semibold uppercase tracking-wider mb-4">Connect With Us</h4>
                <div class="flex space-x-4 mt-2">
                    <a href="https://www.facebook.com/thewestinjakarta/?locale=id_ID" target="_blank" class="text-[#D1C7BD] hover:text-[#F1EDE6] text-2xl transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/Westin" target="_blank" class="text-[#D1C7BD] hover:text-[#F1EDE6] text-2xl transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/thewestinjakarta/?hl=en" target="_blank" class="text-[#D1C7BD] hover:text-[#F1EDE6] text-2xl transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-[#CBAD8D] text-center text-[#D1C7BD] text-base">
            <p>&copy; {{ date('Y') }} The Westin Jakarta. All rights reserved.</p>
        </div>
    </div>
</footer>
@endunless