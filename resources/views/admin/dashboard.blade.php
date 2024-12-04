<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang!") }}
                </div>
            </div>
        </div>
    </div> -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Only keeping necessary custom styles, using Tailwind classes for colors */
        :root {
            --header-height: 4rem;
            --sidebar-width: 240px;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
    </style>
</h>
<body class="bg-indigo-50 min-h-screen overflow-x-hidden">

    <div class="overlay fixed inset-0 bg-indigo-900/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>
    
    <!-- <header class="fixed w-full bg-white text-indigo-800 z-50 shadow-lg animate-slide-down">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between h-16">
            <button class="mobile-menu-button p-2 lg:hidden">
                <span class="material-icons-outlined text-2xl">menu</span>
            </button>
            <div class="text-xl font-bold text-blue-900">
                Admin<span class="text-indigo-800">Panel</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="material-icons-outlined p-2 text-2xl cursor-pointer hover:text-indigo-800 transition-transform duration-300 hover:scale-110 hidden md:block">search</span>
                <span class="material-icons-outlined p-2 text-2xl cursor-pointer hover:text-indigo-800 transition-transform duration-300 hover:scale-110 hidden md:block">notifications</span>
                <img class="w-10 h-10 rounded-full transition-transform duration-300 hover:scale-110 object-cover" 
                     src="https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg" 
                     alt="Profile">
            </div>
        </div>
    </header> -->

        <div class="pt-16 max-w-7xl mx-auto flex">
            <aside class="sidebar fixed lg:static w-[240px] bg-indigo-50 h-[calc(100vh-4rem)] lg:h-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-45 overflow-y-auto p-4">
                <div class="bg-white rounded-xl shadow-lg mb-6 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <!-- Home Link -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">dashboard</span>
                        Home
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                    <!-- Menu Admin Link -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">tune</span>
                        Profile Admin
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>

                    <!-- Lainnya Link -->
                    <a href="{{ url('/halamanutama') }}" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">file_copy</span>
                        Keluar
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                </div>

                <!-- <div class="bg-white rounded-xl shadow-lg p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <a href="#" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">face</span>
                        Profile
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                    <a href="#" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">settings</span>
                        Settings
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                    <a href="#" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">power_settings_new</span>
                        Log out
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                </div> -->
            </aside>
            
        <main class="flex-1 p-4">
            <div class="flex flex-col lg:flex-row gap-4 mb-6">
                <!-- Card 1 - Welcome -->
                <div class="flex-1 bg-indigo-100 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Selamat Datang <br><strong>{{ Auth::user()->name }}</strong>
                    </h2>
                </div>

                <!-- Card 2 - Tugas Tersisa -->
                <div class="flex-1 bg-blue-100 border border-blue-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Jumlah Pengguna<br><strong>{{ $userCount }}</strong>
                    </h2>
                    <a href="#" class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-blue-800 hover:bg-blue-900 transition-transform duration-300 hover:scale-105">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <!-- Menu CRUD -->
            <div class="bg-indigo-50 animate-fade-in duration-300 animate-slide-up">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">Manage Data</h3>
                        <ul>
                            <li>
                                <a href="{{ route('users.index') }}" 
                                class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                                    Manage Users
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');

        function toggleMobileMenu() {
            sidebar.classList.toggle('translate-x-0');
            overlay.classList.toggle('hidden');
            setTimeout(() => overlay.classList.toggle('opacity-0'), 0);
            document.body.style.overflow = sidebar.classList.contains('translate-x-0') ? 'hidden' : '';
        }

        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);

        // Close mobile menu on window resize if open
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && sidebar.classList.contains('translate-x-0')) {
                toggleMobileMenu();
            }
        });

        // Notification animation
        const notificationIcon = document.querySelector('.material-icons-outlined:nth-child(2)');
        setInterval(() => {
            notificationIcon.classList.add('scale-110');
            setTimeout(() => notificationIcon.classList.remove('scale-110'), 200);
        }, 5000);
    </script>
</body>
</html>
    
</x-app-layout>
