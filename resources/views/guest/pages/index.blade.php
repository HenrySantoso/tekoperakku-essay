@extends('guest.layouts.main')

@section('title', 'Index')

@section('content')

    {{-- ===== MAIN BANNER ===== --}}
    <div class="main-banner" id="top">
        <div class="banner-background">
            <img src="{{ asset('assets/images/malioboro2.jpg') }}" alt="Keraton Yogyakarta"
                style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;z-index:-1;">
        </div>

        <div class="banner-content">
            <h1>Perak Asli Kotagede – Warisan Seni dari Jogja</h1>
            <p>
                Karya seni perak dari Kotagede, Yogyakarta yang menggabungkan tradisi,
                ketelitian, dan keanggunan. Dibuat oleh pengrajin lokal dengan teknik
                turun-temurun.
            </p>
            <a href="#" class="btn btn-danger btn-lg mt-3 scroll-to-produk">
                Beli Sekarang
            </a>
        </div>
    </div>

    {{-- ===== KATEGORI PRODUK ===== --}}
    <section class="categories">
        <div class="container">
            <div class="section-heading text-center mb-4">
                <h2>Kategori Produk</h2>
                <p class="text-muted">Temukan berbagai koleksi produk perak terbaik kami</p>
            </div>

            <div id="categoryCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @php
                        $chunks = array_chunk($kategoris->toArray(), 3);
                    @endphp

                    @foreach ($chunks as $key => $chunk)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($chunk as $kategori)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card category-card h-100">
                                            <a href="{{ route('guest-katalog', ['kategori' => $kategori['slug']]) }}">
                                                <img src="{{ asset('assets/images/' . $kategori['slug'] . '.jpg') }}"
                                                    alt="{{ $kategori['nama_kategori_produk'] }}"
                                                    class="card-img-top category-img"
                                                    onerror="this.src='{{ asset('assets/images/kategori-default.jpg') }}'">
                                            </a>

                                            <div class="card-body text-center">
                                                <h5 class="card-title">
                                                    {{ $kategori['nama_kategori_produk'] }}
                                                </h5>
                                                <p class="text-muted">Pesona Perak</p>
                                                <a href="{{ route('guest-katalog', ['kategori' => $kategori['slug']]) }}"
                                                    class="btn btn-outline-dark btn-sm">
                                                    Lihat Produk
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Controls --}}
                <a class="carousel-control-prev" href="#categoryCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#categoryCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== PRODUK TERBARU ===== --}}
    <section class="products">
        <div class="container">
            <div class="section-heading text-center mb-4">
                <h2>Produk Terbaru Kami!</h2>
                <span>Temukan Produk Terfavoritmu!</span>
            </div>

            <div class="row">
                @foreach ($randomProduks as $produk)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="product-item h-100">
                            <a href="{{ route('guest-singleProduct', $produk->slug) }}">
                                <div class="thumb">
                                    <img src="{{ asset('storage/' . optional($produk->fotoProduk->first())->file_foto_produk) }}"
                                        alt="{{ $produk->nama_produk }}"
                                        onerror="this.src='{{ asset('images/produk-default.jpg') }}'">
                                </div>

                                <div class="down-content text-center">
                                    <h4>{{ $produk->nama_produk }}</h4>
                                    <span class="product-price">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>

                                    <ul class="stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <li><i class="fa fa-star"></i></li>
                                        @endfor
                                    </ul>

                                    <p class="product-reviews">20 Reviews</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('guest-katalog') }}" class="btn btn-dark">
                    Lihat Semua
                </a>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT ===== --}}
    <section class="about-us">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 mb-4">
                    <img src="{{ asset('assets/images/kerajinan-perak-kota-ged.png') }}"
                        alt="Sentra Kerajinan Perak Kotagede" class="img-fluid">
                </div>

                <div class="col-lg-5">
                    <h3>TekoPerakku</h3>
                    <p>
                        TekoPerakku menghadirkan kerajinan perak asli Kotagede dengan kualitas terbaik,
                        diproses secara teliti oleh pengrajin berpengalaman.
                    </p>
                    <a href="{{ route('guest-about') }}" class="btn btn-primary">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('.scroll-to-produk');
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector('.products');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    </script>
@endpush
