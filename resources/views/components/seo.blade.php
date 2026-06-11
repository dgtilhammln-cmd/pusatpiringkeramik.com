{{--
    SEO Component — CV. Karya Perdana Teknik
    Variables (semua optional): $seo[], $schema, $breadcrumbs[]
--}}
@php
    $seoData        = $seo        ?? [];
    $schemaData     = $schema     ?? null;
    $breadcrumbData = $breadcrumbs ?? [];
    $appUrl         = rtrim(config('app.url'), '/');

    // Canonical — always use app.url, never localhost
    $rawCanonical   = $seoData['canonical'] ?? url()->current();
    $canonical      = preg_replace('#^https?://[^/]+#', $appUrl, $rawCanonical);

    // OG Image — make absolute using app.url
    $defaultOg      = \App\Models\Setting::get('logo') ? $appUrl . '/storage/' . ltrim(\App\Models\Setting::get('logo'), '/') : $appUrl . '/favicon.ico';
    $rawOg          = $seoData['og_image'] ?? $defaultOg;
    $ogImage        = preg_match('#^https?://#', $rawOg)
                        ? preg_replace('#^https?://[^/]+#', $appUrl, $rawOg)
                        : $appUrl . '/' . ltrim($rawOg, '/');
@endphp
<title>{{ $seoData['title'] ?? 'Hoist Crane Lift Specialist | CV. Karya Perdana Teknik Gresik' }}</title>
<meta name="description" content="{{ $seoData['description'] ?? 'CV. Karya Perdana Teknik - Spesialis Overhead Crane, Chain Hoist, Wire Rope Hoist & Cargo Lift. Melayani seluruh Indonesia.' }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'hoist crane surabaya, overhead crane gresik, jual crane jawa timur, cargo lift sidoarjo, maintenance crane indonesia, chain hoist, wire rope hoist, jib crane fabrikasi, lift barang industri, spesialis crane angkat angkut' }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph --}}
<meta property="og:type"         content="{{ $seoData['og_type'] ?? 'website' }}">
<meta property="og:title"        content="{{ $seoData['title'] ?? 'CV. Karya Perdana Teknik' }}">
<meta property="og:description"  content="{{ $seoData['description'] ?? 'Spesialis Hoist, Crane & Cargo Lift Indonesia' }}">
<meta property="og:image"        content="{{ $ogImage }}">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt"    content="{{ $seoData['title'] ?? 'CV. Karya Perdana Teknik' }}">
<meta property="og:url"          content="{{ $canonical }}">
<meta property="og:site_name"    content="CV. Karya Perdana Teknik">
<meta property="og:locale"       content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ $seoData['title'] ?? 'CV. Karya Perdana Teknik' }}">
<meta name="twitter:description" content="{{ $seoData['description'] ?? '' }}">
<meta name="twitter:image"       content="{{ $ogImage }}">

{{-- Article-specific meta tags --}}
@if(!empty($seoData['article_published']))
<meta property="article:published_time" content="{{ $seoData['article_published'] }}">
<meta property="article:modified_time"  content="{{ $seoData['article_modified'] ?? $seoData['article_published'] }}">
<meta property="article:author"         content="{{ $seoData['article_author'] ?? 'CV. Karya Perdana Teknik' }}">
<meta property="article:section"        content="{{ $seoData['article_section'] ?? 'Artikel' }}">
@endif

{{-- Geo (local SEO) --}}
<meta name="geo.region"    content="ID-JI">
<meta name="geo.placename" content="Gresik, Jawa Timur, Indonesia">
<meta name="geo.position"  content="-7.1583;112.6515">
<meta name="ICBM"          content="-7.1583, 112.6515">

{{-- Font preload --}}
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- JSON-LD LocalBusiness — SINGLE instance only here --}}
@php
$lbSchema = json_encode([
    '@context'      => 'https://schema.org',
    '@type'         => 'LocalBusiness',
    '@id'           => $appUrl . '/#organization',
    'name'          => 'CV. Karya Perdana Teknik',
    'alternateName' => 'KPT Crane',
    'description'   => 'Spesialis Hoist, Crane System & Cargo Lift. Melayani pengadaan, instalasi, fabrikasi & maintenance di seluruh Indonesia.',
    'url'           => $appUrl,
    'telephone'     => '+62-81331148731',
    'email'         => 'karyaperdanateknik@gmail.com',
    'image'         => $ogImage,
    'priceRange'    => '$$',
    'openingHours'  => 'Mo-Sa 08:00-17:00',
    'areaServed'    => 'Indonesia',
    'address'       => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Pergudangan Legundi Business Park Blok D-11',
        'addressLocality' => 'Gresik',
        'addressRegion'   => 'Jawa Timur',
        'postalCode'      => '61177',
        'addressCountry'  => 'ID',
    ],
    'geo'           => ['@type'=>'GeoCoordinates','latitude'=>'-7.1583','longitude'=>'112.6515'],
    'contactPoint'  => [
        '@type'             => 'ContactPoint',
        'telephone'         => '+62-81331148731',
        'contactType'       => 'sales',
        'areaServed'        => 'ID',
        'availableLanguage' => 'Indonesian',
    ],
    'sameAs' => [$appUrl],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
@endphp
<script type="application/ld+json">{!! $lbSchema !!}</script>

{{-- Additional schema (Article, FAQ, ImageObject, etc.) — NOT LocalBusiness --}}
@if(!empty($schemaData))
<script type="application/ld+json">{!! $schemaData !!}</script>
@endif

{{-- BreadcrumbList --}}
@if(!empty($breadcrumbData))
@php
    $bcItems = [];
    foreach ($breadcrumbData as $idx => $crumb) {
        $bcItems[] = [
            '@type'    => 'ListItem',
            'position' => $idx + 1,
            'name'     => $crumb['name'] ?? '',
            'item'     => preg_replace('#^https?://[^/]+#', $appUrl, $crumb['url'] ?? ''),
        ];
    }
    $bcJson = json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $bcItems,
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
@endphp
<script type="application/ld+json">{!! $bcJson !!}</script>
@endif
