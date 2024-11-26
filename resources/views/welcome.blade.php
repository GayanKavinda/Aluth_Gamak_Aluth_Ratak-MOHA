<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluth Gamak Aluth Ratak</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        .bg-hero {
            background-image: url('{{ asset('img/performance agreement illustration_1.jpeg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased bg-gray-100">
    <!-- Responsive Navigation Bar -->
    <nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('img/gov-logo.png') }}" alt="Logo" class="w-8 h-10 mr-3">
                    <span class="font-bold text-xl text-green-800">Performance Agreement</span>
                </div>
                
                <!-- Navigation Links -->
                <div class="flex space-x-4 items-center">
                    <!-- Login and Register Buttons -->
                    <a href="{{ route('login') }}" class="
                        px-4 py-2 
                        text-green-600 
                        hover:bg-green-50 
                        rounded-md 
                        transition duration-300 
                        hover:text-green-800">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="
                        px-4 py-2 
                        bg-green-600 
                        text-white 
                        rounded-md 
                        hover:bg-green-700 
                        transition duration-300 
                        shadow-md hover:shadow-lg">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden pt-16">
        <!-- Hero Background with 16:9 Image Placeholder -->
        <div class="absolute inset-0 bg-hero opacity-30 blur-sm"></div>
        
        <!-- Main Content Container -->
        <div class="relative z-10 text-center px-6 py-12 max-w-4xl mx-auto">
            <!-- Title with Staggered Animation -->
            <div class="mb-8 animate-fade-in-up">
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 
                    animate-fade-in-up" style="animation-delay: 0.2s;">
                    Aluth Gamak
                </h1>
                <h2 class="text-3xl md:text-5xl font-bold text-green-700 
                    animate-fade-in-up" style="animation-delay: 0.4s;">
                    Aluth Ratak
                </h2>
            </div>
            
            <!-- Description with Delayed Animation -->
            <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto 
                animate-fade-in-up" style="animation-delay: 0.6s;">
                Empowering progress, transforming communities, building a brighter future together.
            </p>
            
            <!-- Call to Action Buttons with Hover Effects -->
            <div class="flex justify-center space-x-4 
                animate-fade-in-up" style="animation-delay: 0.8s;">
                <a href="#" class="
                    px-6 py-3 
                    bg-green-600 text-white 
                    rounded-lg 
                    hover:bg-green-700 
                    transition-all duration-300 
                    transform hover:scale-105 
                    shadow-md hover:shadow-xl">
                    Learn More
                </a>
                <a href="{{ route('register') }}" class="
                    px-6 py-3 
                    border-2 border-green-600 text-green-600 
                    rounded-lg 
                    hover:bg-green-600 hover:text-white 
                    transition-all duration-300 
                    transform hover:scale-105 
                    shadow-md hover:shadow-xl">
                    Join Now
                </a>
            </div>
        </div>
        
        <!-- Footer with Subtle Branding -->
        <footer class="absolute bottom-0 w-full text-center py-4 bg-black bg-opacity-10">
            <p class="text-sm text-gray-600">
                © 2024 Aluth Gamak Aluth Ratak. All Rights Reserved.
            </p>
        </footer>
    </div>
</body>
</html>