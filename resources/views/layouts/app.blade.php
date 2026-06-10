<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Component --}}
    @include('components.seo')

    {{-- Google Fonts: Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">

    {{-- AOS Animate on Scroll --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    {{-- App CSS: use compiled if exists, else inline --}}
    @if(file_exists(public_path('build/assets')) && count(glob(public_path('build/assets/*.css'))) > 0)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    {{-- Breadcrumb / Page Hero Background --}}
    @php $breadcrumbBg = \App\Models\Setting::get('breadcrumb_bg'); @endphp
    @if($breadcrumbBg)
    <style>
        .page-hero {
            background-image: url('{{ asset('storage/'.$breadcrumbBg) }}') !important;
            background-size: cover !important;
            background-position: center center !important;
            position: relative;
        }
        /* Dark overlay - kiri lebih gelap untuk keterbacaan teks */
        .page-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg,
                rgba(0,0,0,0.88) 0%,
                rgba(0,0,0,0.75) 50%,
                rgba(0,0,0,0.45) 100%);
            z-index: 0;
        }
        /* Bottom fade agar tidak ada garis cacat */
        .page-hero::after {
            content: "";
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, #0a0a0a);
            z-index: 1;
            pointer-events: none;
        }
        /* Semua child harus di atas overlay */
        .page-hero > div,
        .page-hero .sv-hero-inner,
        .page-hero .article-hero-inner {
            position: relative;
            z-index: 2;
        }
    </style>
    @endif

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Floating WA Button --}}
    @include('components.wa-button')

    {{-- Request Order Modal (global) --}}
    @include('components.order-modal')

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 80, easing: 'ease-out-cubic' });</script>



    @stack('scripts')
</body>
</html>
