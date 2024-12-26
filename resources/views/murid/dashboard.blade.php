<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Siswa') }}
            </h2>
            <div class="relative mr-4">
                <!-- Tombol Notifikasi -->
                <button id="notification-button" class="relative inline-flex items-center p-2 text-sm font-medium text-gray-500 bg-gray-200 rounded-full hover:bg-gray-300 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full">
                        {{ $notifications->count() }}
                    </span>
                </button>

                <!-- Dropdown Notifikasi -->
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="p-4 bg-gray-100 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Notifikasi Tugas Baru</h3>
                    </div>
                    <ul class="max-h-64 overflow-y-auto divide-y divide-gray-200" id="notification-list">
                        @forelse ($notifications as $notification)
                            <li class="p-4 hover:bg-gray-50" id="notification-{{ $notification->id }}">
                                <div class="flex justify-between">
                                    <strong class="text-sm text-indigo-600">{{ $notification->data['subject'] ?? 'Subject tidak tersedia' }}</strong>
                                    <button class="text-sm text-red-500 hover:underline" onclick="deleteNotification('{{ $notification->id }}')">Hapus</button>
                                </div>
                                <p class="text-sm text-gray-700">
                                    <strong>Guru:</strong> {{ $notification->data['teacher'] ?? 'Guru tidak tersedia' }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    <strong>Judul:</strong> {{ $notification->data['title'] ?? 'Judul tidak tersedia' }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    <strong>Deskripsi:</strong> {{ $notification->data['description'] ?? 'Deskripsi tidak tersedia' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    <em>Jatuh tempo: {{ $notification->data['due_date'] ?? 'Tanggal tidak tersedia' }}</em>
                                </p>
                            </li>
                        @empty
                            <img src="{{ asset('img/undraw_warning_qn4r.png') }}" alt="No Assignments" class="w-1/2 my-6 mx-auto">
                            <p class="p-4 text-sm text-gray-500 text-center">Tidak ada notifikasi.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const button = document.getElementById('notification-button');
                const dropdown = document.getElementById('notification-dropdown');

                button.addEventListener('click', () => {
                    dropdown.classList.toggle('hidden');
                });

                // Close the dropdown if clicked outside
                document.addEventListener('click', (event) => {
                    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });

            function deleteNotification(notificationId) {
                fetch(`/notifications/${notificationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        const notificationItem = document.getElementById(`notification-${notificationId}`);
                        if (notificationItem) {
                            notificationItem.remove();
                        }
                    } else {
                        console.error('Gagal menghapus notifikasi.');
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
            }
        </script>
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
                    <a href="{{ route('murid.dashboard') }}" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">dashboard</span>
                        Home
                        <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                    </a>
                    <!-- Menu Admin Link -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <span class="material-icons-outlined mr-2">tune</span>
                        Profile Murid
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
                <div class="flex-1 bg-indigo-100 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Selamat Datang <br><strong>{{ Auth::user()->name }}</strong>
                    </h2>
                    <h4 class="text-4xl md:text-5xl text-blue-900">
                        kelas <strong>{{ Auth::user()->class->name }}</strong>
                    </h4>
                    <!-- <span class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-indigo-800">
                        01:51
                    </span> -->
                </div>

                <div class="flex-1 bg-blue-100 border border-blue-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Tugas Belum Dikerjakan : <strong>{{ $pendingAssignmentsCount }}</strong>
                    </h2>
                    <a href="{{ route('submissions.index') }}" class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-blue-800 hover:bg-blue-900 transition-transform duration-300 hover:scale-105">
                        Lihat Semua Tugas
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($subjects as $subject)
                    <div class="bg-gradient-to-b from-indigo-100 to-indigo-800 rounded-xl shadow-lg p-6 h-64 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-slide-up" style="animation-delay: 0.1s">
                        <a href="{{ route('subjects.show', $subject->id) }}" class="text-xl font-bold text-indigo-800 hover:text-white hover:border-solid bg-gray-200 hover:bg-indigo-800 px-3 py-2 rounded-lg">{{ $subject->name }}</a>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

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
