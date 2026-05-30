<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-lg font-semibold text-white">
                @if(isset($siteSettings) && $siteSettings->logo)
                    <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="QuizVerse" class="h-8 w-auto object-contain mb-2">
                @else
                    QuizVerse
                @endif
            </h3>
            <p class="mt-2 text-sm text-gray-400">Your trusted platform for practice exams and learning.</p>
            @if(isset($siteSettings))
                <ul class="mt-4 space-y-2 text-sm">
                    @if($siteSettings->address)
                        <li class="flex items-start text-gray-400">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-blue-500"></i>
                            <span>{{ $siteSettings->address }}</span>
                        </li>
                    @endif
                    @if($siteSettings->email)
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>
                            <a href="mailto:{{ $siteSettings->email }}" class="hover:text-white transition-colors duration-200">{{ $siteSettings->email }}</a>
                        </li>
                    @endif
                    @if($siteSettings->contact_number)
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone-alt mr-2 text-blue-500"></i>
                            <a href="tel:{{ $siteSettings->contact_number }}" class="hover:text-white transition-colors duration-200">{{ $siteSettings->contact_number }}</a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
        <div>
            <h3 class="text-lg font-semibold text-white">Quick Links</h3>
            <ul class="mt-2 space-y-2 text-sm">
                <li><a href="/exams" class="hover:text-white">Exams</a></li>
                <li><a href="/about" class="hover:text-white">About</a></li>
                <li><a href="/contact" class="hover:text-white">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-white">Follow Us</h3>
            <div class="mt-2 flex space-x-4">
                <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-700 text-center py-4 text-sm">
        © {{ date('Y') }} QuizVerse. All rights reserved.
    </div>
</footer>
