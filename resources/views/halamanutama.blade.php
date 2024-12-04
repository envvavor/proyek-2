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
    /* Custom Scrollbar */
    .scrollbar-custom::-webkit-scrollbar {
        width: 18px; /* Lebar scrollbar */
        height: 18px; /* Tinggi scrollbar untuk horizontal (jika ada) */
    }

    .scrollbar-custom::-webkit-scrollbar-track {
        background: transparent; /* Hilangkan warna track */
    }

    .scrollbar-custom::-webkit-scrollbar-thumb {
        background-color: white; /* Warna scrollbar */
        border-radius: 8px; /* Buat sudut membulat */
        border: 4px solid transparent; /* Tambahkan ruang antara scrollbar dan track */
        background-clip: content-box; /* Hanya warna scrollbar yang terlihat */
    }

    .scrollbar-custom::-webkit-scrollbar-thumb:hover {
        background-color: #374151; /* Warna scrollbar saat di-hover */
    }

    .map-container {
        display: flex;
        justify-content: center;  /* Center horizontally */
        align-items: center;      /* Center vertically */
        width: 100%;
        height: 100vh; /* You can adjust the height as needed */
        position: relative;
        overflow: hidden;
    }

    iframe {
        width: 80%;  /* Adjust the width as needed */
        height: 60%; /* Adjust the height as needed */
        border: none;
    }

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
                            <a href="{{ url('/halamanutama') }}" class="block px-4 py-2 text-gray-900 dark:text-white bg-blue-400 hover:text-white rounded-lg">
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
                            <a href="{{ url('/halamangaleri') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-blue-400 hover:text-white rounded-lg">
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


    <style>
        /* CSS untuk memastikan tombol toggle dan menu responsif dengan benar */
        @media (max-width: 1024px) {
            .flex-wrap {
                flex-wrap: wrap;
            }
        }
    </style>


    
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

    <section class="relative bg-white">
        <!-- Konten -->
        <div class="max-w-5xl mx-auto text-center py-24">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Pendaftar -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center border-8 border-black">
                        <span class="text-black text-lg font-bold">3147+</span>
                    </div>
                    <p class="mt-2 font-semibold">Pendaftar</p>
                </div>
                <!-- Siswa & Siswi -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center border-8 border-black">
                        <span class="text-black text-lg font-bold">635+</span>
                    </div>
                    <p class="mt-2 font-semibold">Siswa & Siswi</p>
                </div>
                <!-- Guru & Staff -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center border-8 border-black">
                        <span class="text-black text-lg font-bold">20+</span>
                    </div>
                    <p class="mt-2 font-semibold">Guru & Staff</p>
                </div>
            </div>
        </div>

        <!-- Gelombang SVG -->
        <div class="relative pb-24">
            <div class="absolute bottom-0 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#7C93C3" fill-opacity="1" d="M0,160L80,186.7C160,213,320,267,480,277.3C640,288,800,256,960,218.7C1120,181,1280,139,1360,117.3L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
                </svg>
            </div>
        </div>
    </section>

    <section class="scrollbar-custom relative bg-gradient-to-b from-[#7C93C3] to-[#475569] py-16">
        <div class="scrollbar-custom w-full overflow-auto">
            <div class="flex space-x-6 p-6"> <!-- Spasi antar card lebih besar -->
                <!-- Card 1 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 1" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 1</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 1.</p>
                </div>

                <!-- Card 2 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 2" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 2</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 2.</p>
                </div>

                <!-- Card 3 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 3" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 3</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 3.</p>
                </div>

                <!-- Card 4 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 1" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 4</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 1.</p>
                </div>

                <!-- Card 5 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 2" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 5</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 2.</p>
                </div>

                <!-- Card 6 -->
                <div class="min-w-[300px] bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <img src="{{ asset('img/bg-awal.png') }}" alt="Card 3" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Card 6</h3>
                    <p class="text-md text-gray-600 dark:text-gray-400">Description of card 3.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative bg-[#475569] py-12">
        <div class="flex flex-wrap justify-center gap-6">
            <!-- Card 1 -->
            <div class="max-w-sm bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}"/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam fugiat, amet voluptatibus non debitis aliquam soluta suscipit atque beatae maxime similique. Quisquam maxime pariatur repellat, quasi asperiores reiciendis exercitationem nihil.</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="max-w-sm bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}"/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam fugiat, amet voluptatibus non debitis aliquam soluta suscipit atque beatae maxime similique. Quisquam maxime pariatur repellat, quasi asperiores reiciendis exercitationem nihil.</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="max-w-sm bg-white border border-gray-800 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/bg-awal.png') }}"/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Judul Kartu</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam fugiat, amet voluptatibus non debitis aliquam soluta suscipit atque beatae maxime similique. Quisquam maxime pariatur repellat, quasi asperiores reiciendis exercitationem nihil.</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative bg-[#475569] py-0">
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.588926507901!2d108.32465537475147!3d-6.317603593671792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ebbf7496793cf%3A0x55e25f3b4d1692ad!2sSMK%20Negeri%202%20Indramayu!5e0!3m2!1sen!2sid!4v1732613955160!5m2!1sen!2sid" frameborder="0" class="rounded-xl" allowfullscreen></iframe>
        </div>
    </section>


    <section class="relative bg-[#475569] py-0">
        <div class="absolute left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#475569" fill-opacity="1" d="M0,192L48,213.3C96,235,192,277,288,261.3C384,245,480,171,576,160C672,149,768,203,864,213.3C960,224,1056,181,1152,181.3C1248,181,1344,235,1392,256L1440,277.3L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
    </section>
</body>



<footer class="bg-[#475569] rounded-lg shadow m-4 mt-40 sm:mt-80">
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