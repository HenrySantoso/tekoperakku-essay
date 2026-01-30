<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'TekoPerakku')</title>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-hexashop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index-css.css') }}">

    @stack('styles')
</head>

<body>

    {{-- PRELOADER --}}
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    {{-- HEADER --}}
    <header class="shadow-sm fixed-top">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container d-flex align-items-center">

                <a class="navbar-brand fw-bold fs-4 me-3" href="{{ route('guest-index') }}">
                    TekoPerakku
                </a>

                <form action="{{ route('guest-katalog') }}" method="GET" class="d-flex flex-grow-1">
                    <input class="form-control" type="search" name="search" placeholder="Cari produk atau kategori..."
                        value="{{ request('search') }}">
                </form>

                <div class="dropdown ms-3">
                    @auth
                        <a class="text-dark d-flex align-items-center dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown">
                            <i class="fa fa-user me-2"></i>
                            {{ Auth::user()->username }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('loginForm') }}" class="text-dark">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="bg-white">
            <div class="container">
                <ul class="nav justify-content-center py-2">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('guest-index') ? 'active' : '' }}"
                            href="{{ route('guest-index') }}">BERANDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('guest-katalog') ? 'active' : '' }}"
                            href="{{ route('guest-katalog') }}">KATALOG</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            KATEGORI
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($kategoris as $kategori)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('guest-katalog', ['kategori' => $kategori->slug]) }}">
                                        {{ $kategori->nama_kategori_produk }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('guest-about') ? 'active' : '' }}"
                            href="{{ route('guest-about') }}">TENTANG KAMI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('guest-contact') ? 'active' : '' }}"
                            href="{{ route('guest-contact') }}">KONTAK</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="content" style="margin-top: 10px;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-logo">TekoPerakku</h3>
                    <ul class="footer-list">
                        <li>Kotagede, Yogyakarta</li>
                        <li>kotagedhe@gmail.com</li>
                        <li>088-098-202</li>
                    </ul>
                </div>

                <div class="col-lg-3 mb-4">
                    <h5>Informasi</h5>
                    <ul class="footer-list">
                        <li><a href="{{ route('guest-index') }}">Beranda</a></li>
                        <li><a href="{{ route('guest-about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('guest-contact') }}">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 mb-4">
                    <h5>Sosial Media</h5>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </div>
            </div>

            <div class="text-center mt-4">
                <p>© 2025 TekoPerakku. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    {{-- JS (URUTAN WAJIB) --}}
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}">
        < /endregion <
        script src = "{{ asset('assets/js/jquery.counterup.min.js') }}" >
    </script>
    <script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

</body>

</html>
