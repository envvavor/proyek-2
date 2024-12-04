<?php
use Illuminate\Support\Facades\Route;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 2 Indramayu</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    /* Keyframes for slide-up animation */
    @keyframes slideUp {
        0% {
            transform: translateY(50px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Apply the slide-up animation to the section's content */
    .animate-slide-up {
        animation: slideUp 1s ease-out forwards;
    }

    /* Apply the delay for subsequent elements */
    .animate-slide-up-delay {
        animation: slideUp 1s ease-out forwards;
    }
</style>

<body>
    <header>
        <nav class="bg-white border-gray-200 dark:bg-sky-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
                <a class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('img/logotkj.png') }}" class="h-8" alt="Logo" />
                    <span class="self-center text-1xl font-semibold whitespace-nowrap dark:text-white">TKJ SMKN 2 Indramayu</span>
                </a>
                <div class="flex items-center space-x-6 rtl:space-x-reverse">
                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2 text-center me-2 mb-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2 text-center me-2 mb-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Log in
                            </a>
                        @endauth
                    @endif
                </div>
                <!-- Toggle button -->
                <button 
                    id="menu-toggle" 
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <nav class="bg-gray-50 dark:bg-sky-700">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div 
                    id="menu" 
                    class="max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out lg:max-h-none lg:flex lg:flex-row lg:items-center lg:justify-center"
                >
                    <ul 
                        class="flex flex-col lg:flex-row lg:space-x-8 text-sm font-medium mt-4 lg:mt-0 p-4 lg:p-0 bg-sky-800 lg:bg-transparent shadow-lg lg:shadow-none rounded-lg lg:rounded-none"
                    >
                        <li class="relative group">
                            <a href="{{ url('/halamanutama') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
                                Beranda
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ url('/halamanprofile') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
                                Profil
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ url('/halamansarana') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
                                Sarana & Prasarana
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ url('/halamanhubungan') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
                                Hubungan Industri
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ url('/halamangaleri') }}" class="block px-4 py-2 text-gray-900 dark:text-white bg-blue-400 hover:text-white rounded-lg">
                                Galeri
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ url('/halamankontak') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- JavaScript to toggle the menu on mobile -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        
        menuToggle.addEventListener('click', () => {
            if (menu.classList.contains('max-h-0')) {
                menu.classList.remove('max-h-0');
                menu.classList.add('max-h-screen');
            } else {
                menu.classList.add('max-h-0');
                menu.classList.remove('max-h-screen');
            }
        });
    </script>
    
    <section 
        class="bg-center bg-cover bg-no-repeat bg-gray-200 bg-blend-multiply h-screen w-full rounded-b-xl" 
        style="background-image: url('{{ asset('img/bg-awal.png') }}');">
        <div class="flex flex-col items-center justify-center px-4 mx-auto max-w-screen-xl text-center h-full animate-slide-up">
            <img src="{{ asset('img/logotkj.png') }}" class="h-24 mx-auto mb-6 animate-slide-up-delay" alt="Logo" />
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl animate-slide-up-delay">
                Teknik Komputer & Jaringan
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48 animate-slide-up-delay">
                SMK Negeri 2 Indramayu
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 animate-slide-up-delay"> 
                <!-- Tombol atau elemen lainnya -->
            </div>
        </div>
    </section>

    <section>
        <div class="pt-10 sm:pt-20 pb-5 sm:pb-0">
            <div class="flex flex-row items-center justify-between px-4 mx-auto max-w-screen-xl text-center h-20 bg-[#475569] w-full rounded-lg">
                <img src="{{ asset('img/logotkj.png') }}" class="h-24 sm:h-40" alt="Logo" />
                <p class="mb-4 text-1xl font-bold tracking-tight leading-none text-white md:text-2xl lg:text-4xl">
                    Galeri Jurusan TKJ
                </p>
            </div>
        </div>
    </section> 

    <section>
        <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 160" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(71, 85, 105, 1)" offset="0%"></stop><stop stop-color="rgba(71, 85, 105, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,32L26.7,40C53.3,48,107,64,160,77.3C213.3,91,267,101,320,106.7C373.3,112,427,112,480,112C533.3,112,587,112,640,101.3C693.3,91,747,69,800,58.7C853.3,48,907,48,960,56C1013.3,64,1067,80,1120,85.3C1173.3,91,1227,85,1280,80C1333.3,75,1387,69,1440,80C1493.3,91,1547,117,1600,120C1653.3,123,1707,101,1760,77.3C1813.3,53,1867,27,1920,34.7C1973.3,43,2027,85,2080,101.3C2133.3,117,2187,107,2240,104C2293.3,101,2347,107,2400,106.7C2453.3,107,2507,101,2560,82.7C2613.3,64,2667,32,2720,16C2773.3,0,2827,0,2880,10.7C2933.3,21,2987,43,3040,61.3C3093.3,80,3147,96,3200,109.3C3253.3,123,3307,133,3360,133.3C3413.3,133,3467,123,3520,104C3573.3,85,3627,59,3680,40C3733.3,21,3787,11,3813,5.3L3840,0L3840,160L3813.3,160C3786.7,160,3733,160,3680,160C3626.7,160,3573,160,3520,160C3466.7,160,3413,160,3360,160C3306.7,160,3253,160,3200,160C3146.7,160,3093,160,3040,160C2986.7,160,2933,160,2880,160C2826.7,160,2773,160,2720,160C2666.7,160,2613,160,2560,160C2506.7,160,2453,160,2400,160C2346.7,160,2293,160,2240,160C2186.7,160,2133,160,2080,160C2026.7,160,1973,160,1920,160C1866.7,160,1813,160,1760,160C1706.7,160,1653,160,1600,160C1546.7,160,1493,160,1440,160C1386.7,160,1333,160,1280,160C1226.7,160,1173,160,1120,160C1066.7,160,1013,160,960,160C906.7,160,853,160,800,160C746.7,160,693,160,640,160C586.7,160,533,160,480,160C426.7,160,373,160,320,160C266.7,160,213,160,160,160C106.7,160,53,160,27,160L0,160Z"></path></svg>
    </section>

    <section class="relative bg-[#475569] py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-items-center">
            <!-- Card 1 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 1"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 2"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 3"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 4"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 5"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 6"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 7"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="max-w-xs bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}" alt="Image 8"/>
                </a>
                <div class="p-4">
                    <a href="#">
                        <h5 class="text-xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section>
        <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 160" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(71, 85, 105, 1)" offset="0%"></stop><stop stop-color="rgba(71, 85, 105, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,32L26.7,40C53.3,48,107,64,160,77.3C213.3,91,267,101,320,106.7C373.3,112,427,112,480,112C533.3,112,587,112,640,101.3C693.3,91,747,69,800,58.7C853.3,48,907,48,960,56C1013.3,64,1067,80,1120,85.3C1173.3,91,1227,85,1280,80C1333.3,75,1387,69,1440,80C1493.3,91,1547,117,1600,120C1653.3,123,1707,101,1760,77.3C1813.3,53,1867,27,1920,34.7C1973.3,43,2027,85,2080,101.3C2133.3,117,2187,107,2240,104C2293.3,101,2347,107,2400,106.7C2453.3,107,2507,101,2560,82.7C2613.3,64,2667,32,2720,16C2773.3,0,2827,0,2880,10.7C2933.3,21,2987,43,3040,61.3C3093.3,80,3147,96,3200,109.3C3253.3,123,3307,133,3360,133.3C3413.3,133,3467,123,3520,104C3573.3,85,3627,59,3680,40C3733.3,21,3787,11,3813,5.3L3840,0L3840,160L3813.3,160C3786.7,160,3733,160,3680,160C3626.7,160,3573,160,3520,160C3466.7,160,3413,160,3360,160C3306.7,160,3253,160,3200,160C3146.7,160,3093,160,3040,160C2986.7,160,2933,160,2880,160C2826.7,160,2773,160,2720,160C2666.7,160,2613,160,2560,160C2506.7,160,2453,160,2400,160C2346.7,160,2293,160,2240,160C2186.7,160,2133,160,2080,160C2026.7,160,1973,160,1920,160C1866.7,160,1813,160,1760,160C1706.7,160,1653,160,1600,160C1546.7,160,1493,160,1440,160C1386.7,160,1333,160,1280,160C1226.7,160,1173,160,1120,160C1066.7,160,1013,160,960,160C906.7,160,853,160,800,160C746.7,160,693,160,640,160C586.7,160,533,160,480,160C426.7,160,373,160,320,160C266.7,160,213,160,160,160C106.7,160,53,160,27,160L0,160Z"></path></svg>
    </section>

</body>



<footer class="bg-[#475569] rounded-lg shadow m-4">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-200">Smkn 2 Indramayu
    </span>
    <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-200 sm:mt-0">
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">About</a>
        </li>
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
        </li>
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
        </li>
        <li>
            <a href="#" class="hover:underline">Contact</a>
        </li>
    </ul>
    </div>
</footer>

</html>