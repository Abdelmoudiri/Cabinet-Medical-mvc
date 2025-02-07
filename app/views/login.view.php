<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translatey(0px); }
            50% { transform: translatey(-20px); }
            100% { transform: translatey(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-400 via-pink-500 to-red-500 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4" x-data="{ tab: 'signup' }">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">
            <div class="text-center py-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                <h1 class="text-3xl font-bold">Welcome</h1>
                <p class="mt-2">Join our amazing community</p>
            </div>
            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <button @click="tab = 'signup'" :class="{ 'bg-blue-500 text-white': tab === 'signup', 'bg-gray-200 text-gray-700': tab !== 'signup' }" class="px-4 py-2 rounded-l-md focus:outline-none transition-colors duration-300">Sign Up</button>
                    <button @click="tab = 'login'" :class="{ 'bg-blue-500 text-white': tab === 'login', 'bg-gray-200 text-gray-700': tab !== 'login' }" class="px-4 py-2 rounded-r-md focus:outline-none transition-colors duration-300">Login</button>
                </div>
                <form x-show="tab === 'signup'" class="space-y-4">
                    <div class="relative">
                        <input type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" placeholder="Full Name">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="relative">
                        <input type="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" placeholder="Email">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="relative">
                        <input type="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" placeholder="Password">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">Sign Up</button>
                </form>
                <form x-show="tab === 'login'" class="space-y-4">
                    <div class="relative">
                        <input type="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" placeholder="Email">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="relative">
                        <input type="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" placeholder="Password">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">Login</button>
                </form>
                <div class="mt-6">
                    <p class="text-center text-gray-600 mb-4">Or continue with</p>
                    <div class="flex justify-center space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300">
                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                        </button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
                            <i class="fab fa-google mr-2"></i> Google
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>