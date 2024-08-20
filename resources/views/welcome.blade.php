<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="font-sans antialiased flex flex-col gap-20">
    @if (Route::has('login'))
        <div class="navbar sm:px-6 lg:px-96 py-4 flex justify-end items-center">
            <div class="flex-1">
                <a class="text-xl font-bold" href="/">MARKET_BEKAS </a>
            </div>
            <div class="flex-2 px-4">
                <ul class="flex gap-6">
                    <li><a href="#hero">Beranda</a></li>
                    <li><a href="#produk">Produk</a></li>
                </ul>
            </div>
            @auth
                @if (auth()->user()->hasRole('administrator'))
                    <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black">
                        Dashboard
                    </a>
                @endif
                <div class="flex-none gap-2">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="rounded-full flex justify-center items-center">
                                <i data-feather="user"></i>
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                            <li><a>{{ auth()->user()->name }}</a></li>
                            <li><a class="font-bold">({{ auth()->user()->getRoleNames()->implode(', ') }})</a></li>
                            <br>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    @endif

    {{-- Hero Section --}}
    <div id="hero" class="hero" data-aos="fade-left" data-aos-duration="1000">
        <div class="hero-content flex-col lg:flex-row-reverse justify-end ">
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('img/hero.jpg') }}" alt="Market Bekas Hero Image">
            </div>
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <p class="text-xl font-medium text-gray-600 mb-4">Mau beli barang bekas, tapi takut?</p>
                <h1 class="text-5xl font-bold mb-6">Cobain Market Bekas aja!</h1>
                <p class="text-lg text-gray-500 mb-6">Temukan berbagai barang bekas berkualitas dengan harga terjangkau.
                    Aman, mudah, dan terpercaya!</p>
                <a href="#produk" class="btn btn-neutral">Lihat Produk</a>
            </div>
        </div>
    </div>

    {{-- Produk Section --}}
    <div id="produk" class="hero min-h-screen py-10" data-aos="fade-right" data-aos-duration="1000">
        <div class="hero-content flex-col text-center">
            <h5 class="text-3xl font-bold mb-8">List Produk Tersedia</h5>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($products as $product)
                    <div
                        class="card bg-white shadow-lg rounded-lg overflow-hidden transform transition-transform hover:scale-105">
                        <div class="relative">
                            <img src="{{ asset('gambar_produk/' . $product->gambar_produk) }}"
                                alt="{{ $product->nama }}" class="w-full h-56 object-cover">
                            @if ($product->isNew)
                                <span
                                    class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">New</span>
                            @elseif($product->isOnSale)
                                <span
                                    class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">Sale</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $product->nama }}</h3>
                            <p class="text-lg text-gray-700 mb-4">Rp. {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                            <div class="flex gap-2">
                                <button onclick="coming_soon.showModal()" class="btn flex-shrink-0"><i
                                        data-feather="shopping-cart"></i></button>
                                <button onclick="coming_soon.showModal()" class="btn btn-neutral flex-grow">Beli
                                    Sekarang</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="footer footer-center text-base-content p-4">
        <aside>
            <p>Copyright © 2024 - by <a href="https://www.linkedin.com/in/gilang-raka-ramadhan/" target="_blank">Gilang
                    Raka
                    Ramadhan</a></p>
        </aside>
    </footer>


    <dialog id="coming_soon" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Coming Soon!</h3>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>


    <script>
        feather.replace();
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
