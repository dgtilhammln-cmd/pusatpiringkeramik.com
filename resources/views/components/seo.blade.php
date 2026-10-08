{{--
    SEO, AEO, & GEO Schema Component
    Renders Meta Tags, OpenGraph, Twitter Cards, and Linked @graph JSON-LD Schema
--}}
@php
    $seoData        = $seo        ?? [];
    $schemaData     = $schema     ?? null;
    $breadcrumbData = $breadcrumbs ?? [];
    $appUrl         = rtrim(config('app.url'), '/');

    // Helper closure to decode HTML entities (&amp; -> &) and trim string content
    $cleanText = function($text) {
        if ($text === null || $text === '') return '';
        return trim(html_entity_decode((string) $text, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    };

    // Global Fallbacks from general settings & WaSetting
    $primaryWaModel = \App\Models\WaSetting::primary() ?? \App\Models\WaSetting::where('is_active', true)->first();
    $rawWaPhone     = $primaryWaModel?->nomor_wa ?? \App\Models\Setting::get('phone', \App\Models\Setting::get('whatsapp', '087832505656'));
    $cleanWa        = preg_replace('/[^0-9]/', '', $rawWaPhone);
    if (str_starts_with($cleanWa, '0')) {
        $cleanWa = '62' . substr($cleanWa, 1);
    }
    $defaultPhoneIntl = '+' . ltrim($cleanWa, '+');

    $globalStreet   = \App\Models\Setting::get('address_full', \App\Models\Setting::get('address_street', 'Jl. Semarang No. 88'));
    $globalCity     = \App\Models\Setting::get('address_city', 'Semarang');
    $globalProv     = \App\Models\Setting::get('address_province', 'Jawa Tengah');
    $globalPostal   = \App\Models\Setting::get('address_postal', '50123');

    // Dynamic settings from DB with intelligent fallbacks
    $companyName    = $cleanText(\App\Models\Setting::get('company_name', config('app.name')));
    if (empty($companyName)) {
        $companyName = 'Pusat Piring Keramik';
    }

    $companyTagline = $cleanText(\App\Models\Setting::get('company_tagline', 'Distributor & Supplier Piring Keramik Indonesia'));
    if (empty($companyTagline)) {
        $companyTagline = 'Distributor & Supplier Piring Keramik Terpercaya';
    }
    
    // Address & City/Province Fixes (handling text vs numeric BPS codes & empty overrides)
    $seoCity        = \App\Models\Setting::get('address_city_name');
    $rawCity        = !empty(trim($seoCity)) ? $seoCity : $globalCity;
    $addressCity    = $cleanText((is_numeric($rawCity) || preg_match('/^[0-9]+$/', trim($rawCity))) ? 'Semarang' : $rawCity);
    if (empty($addressCity)) $addressCity = 'Semarang';
    
    $seoProv        = \App\Models\Setting::get('address_province_name');
    $rawProvince    = !empty(trim($seoProv)) ? $seoProv : $globalProv;
    $addressProvince= $cleanText((is_numeric($rawProvince) || preg_match('/^[0-9]+$/', trim($rawProvince))) ? 'Jawa Tengah' : $rawProvince);
    if (empty($addressProvince)) $addressProvince = 'Jawa Tengah';
    
    $seoStreet      = \App\Models\Setting::get('address_street_full');
    $addressStreet  = $cleanText(!empty(trim($seoStreet)) ? $seoStreet : $globalStreet);
    if (empty($addressStreet)) $addressStreet = 'Jl. Semarang No. 88';
    
    $seoPostal      = \App\Models\Setting::get('address_postal_code');
    $addressPostal  = $cleanText(!empty(trim($seoPostal)) ? $seoPostal : $globalPostal);
    if (empty($addressPostal)) $addressPostal = '50123';
    
    // Phone International Format Fix
    $seoPhoneIntl   = \App\Models\Setting::get('phone_international');
    $phoneIntl      = $cleanText(!empty(trim($seoPhoneIntl)) ? $seoPhoneIntl : $defaultPhoneIntl);
    if (empty($phoneIntl)) $phoneIntl = '+6287832505656';
    
    $companyEmail   = $cleanText(\App\Models\Setting::get('email', 'info@pusatpiringkeramik.com'));
    
    // Geo Coordinates Fix (Ensure float lat/lng are ALWAYS provided)
    $rawLat         = trim(\App\Models\Setting::get('geo_latitude', ''));
    $rawLng         = trim(\App\Models\Setting::get('geo_longitude', ''));
    if (is_numeric($rawLat) && is_numeric($rawLng) && (float)$rawLat != 0) {
        $geoLat = (float) $rawLat;
        $geoLng = (float) $rawLng;
    } else {
        $geoLat = -6.9932;
        $geoLng = 110.4203;
    }
    
    $hasMapUrl      = $cleanText(\App\Models\Setting::get('google_maps_url', 'https://maps.google.com'));
    if (empty($hasMapUrl)) $hasMapUrl = 'https://maps.google.com';
    
    // SEO & GEO Attributes
    $businessTypes  = \App\Models\Setting::get('seo_business_type', '["LocalBusiness", "Store", "HomeGoodsStore"]');
    $parsedTypes    = is_string($businessTypes) ? json_decode($businessTypes, true) : $businessTypes;
    if (!is_array($parsedTypes) || count($parsedTypes) === 0) {
        $parsedTypes = ["LocalBusiness", "Store", "HomeGoodsStore"];
    }

    $priceRange     = $cleanText(\App\Models\Setting::get('seo_price_range', 'Rp5.000 - Rp500.000'));
    $seoSlogan      = $cleanText(\App\Models\Setting::get('seo_slogan', 'Distributor & Supplier Piring Keramik Terpercaya'));
    $foundingDate   = $cleanText(\App\Models\Setting::get('seo_founding_date', '2015'));
    $founderName    = $cleanText(\App\Models\Setting::get('seo_founder_name', 'UD. Sukses Makmur'));
    
    // KnowsAbout Array (Decoded & Filtered)
    $knowsAboutRaw  = \App\Models\Setting::get('seo_knows_about', 'Piring Keramik, Mangkok Keramik, Perabotan Restoran & Hotel, Tableware, Dinnerware, Keramik Custom Logo');
    $knowsAboutArr  = array_values(array_filter(array_map($cleanText, explode(',', $knowsAboutRaw))));
    
    // AreaServed Entities with Typed Area Schema (Country, AdministrativeArea, City)
    $areaServedRaw  = \App\Models\Setting::get('seo_area_served', 'Semarang, Jawa Tengah, Indonesia');
    $areaServedItems= array_values(array_filter(array_map($cleanText, explode(',', $areaServedRaw))));
    
    $areaServedEntities = [];
    foreach ($areaServedItems as $areaItem) {
        $lowerArea = strtolower($areaItem);
        if (in_array($lowerArea, ['indonesia', 'id', 'republik indonesia'])) {
            $areaServedEntities[] = [
                '@type' => 'Country',
                'name'  => 'Indonesia'
            ];
        } elseif (
            str_contains($lowerArea, 'jawa') || 
            str_contains($lowerArea, 'sumatera') || 
            str_contains($lowerArea, 'kalimantan') || 
            str_contains($lowerArea, 'sulawesi') || 
            str_contains($lowerArea, 'papua') || 
            str_contains($lowerArea, 'nusa tenggara') || 
            str_contains($lowerArea, 'banten') || 
            str_contains($lowerArea, 'dki') || 
            str_contains($lowerArea, 'yogyakarta') || 
            str_contains($lowerArea, 'bali') || 
            str_contains($lowerArea, 'provinsi') ||
            str_contains($lowerArea, 'province') ||
            str_contains($lowerArea, 'region')
        ) {
            $areaServedEntities[] = [
                '@type' => 'AdministrativeArea',
                'name'  => $areaItem
            ];
        } else {
            $areaServedEntities[] = [
                '@type' => 'City',
                'name'  => $areaItem
            ];
        }
    }

    // SameAs Array
    $sameAsRaw      = \App\Models\Setting::get('seo_same_as_urls', '');
    $sameAsArr      = [$appUrl];
    if (!empty($sameAsRaw)) {
        $lines = explode("\n", $sameAsRaw);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && filter_var($line, FILTER_VALIDATE_URL) && !in_array($line, $sameAsArr)) {
                $sameAsArr[] = $line;
            }
        }
    }

    // Opening Hours Specification
    $openDaysRaw    = \App\Models\Setting::get('seo_opening_days', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday');
    $openDaysArr    = array_values(array_filter(array_map($cleanText, explode(',', $openDaysRaw))));
    $openTime       = $cleanText(\App\Models\Setting::get('seo_opening_time', '08:00'));
    $closeTime      = $cleanText(\App\Models\Setting::get('seo_closing_time', '17:00'));

    // Title & Description Fix (Strictly non-empty fallback strings)
    $rawTitle       = $cleanText($seoData['title'] ?? '');
    if (empty($rawTitle)) {
        $rawTitle = $companyName . ($companyTagline ? ' | ' . $companyTagline : '');
    }
    if (empty($rawTitle)) {
        $rawTitle = 'Pusat Piring Keramik - Distributor & Supplier Piring Keramik';
    }
    $siteTitle      = $rawTitle;

    $rawDesc        = $cleanText($seoData['description'] ?? '');
    if (empty($rawDesc)) {
        $rawDesc = $companyName . ' - ' . $companyTagline . '. Distributor piring keramik grosir dan eceran berkualitas tinggi.';
    }
    if (empty($rawDesc)) {
        $rawDesc = 'Distributor & supplier piring keramik grosir dan eceran terpercaya di Indonesia.';
    }
    $siteDescription= $rawDesc;
    
    $rawCanonical   = $seoData['canonical'] ?? url()->current();
    $canonical      = preg_replace('#^https?://[^/]+#', $appUrl, $rawCanonical);

    $logoPath       = \App\Models\Setting::get('logo');
    $logoUrl        = $logoPath ? $appUrl . '/storage/' . ltrim($logoPath, '/') : $appUrl . '/favicon.ico';
    
    $rawOg          = $seoData['og_image'] ?? $logoUrl;
    $ogImage        = preg_match('#^https?://#', $rawOg)
                        ? preg_replace('#^https?://[^/]+#', $appUrl, $rawOg)
                        : $appUrl . '/' . ltrim($rawOg, '/');

    // FAQ Page Schema Data (Strict Normalized acceptedAnswer Structure)
    $faqRaw = \App\Models\Setting::get('seo_faq_json');
    $faqItems = [];
    if (!empty($faqRaw)) {
        $faqItems = is_string($faqRaw) ? json_decode($faqRaw, true) : $faqRaw;
    }
    if (!is_array($faqItems) || count($faqItems) === 0) {
        $faqItems = [
            [
                'question' => 'Apakah menjual piring keramik secara grosir?',
                'answer'   => 'Ya, kami adalah distributor utama piring keramik yang melayani pembelian grosir dan eceran dengan harga pabrik langsung.',
                'show'     => '1'
            ],
            [
                'question' => 'Apakah pengiriman piring keramik aman sampai luar kota/luar pulau?',
                'answer'   => 'Sangat aman. Setiap piring keramik dipack berlapis menggunakan bubble wrap tebal dan peti kayu standar ekspor dengan garansi pecah diganti baru.',
                'show'     => '1'
            ],
            [
                'question' => 'Apakah bisa custom logo resto atau hotel di piring keramik?',
                'answer'   => 'Bisa. Kami menerima pemesanan piring keramik custom cetak logo untuk restoran, café, hotel, dan souvenir pernikahan.',
                'show'     => '1'
            ],
            [
                'question' => 'Bagaimana cara melakukan pemesanan dan konsultasi produk?',
                'answer'   => 'Anda dapat menghubungi tim customer service kami melalui WhatsApp di ' . $phoneIntl . ' atau menekan tombol Konsultasi di website kami.',
                'show'     => '1'
            ]
        ];
    }
@endphp

<title>{{ $siteTitle }}</title>
<meta name="description" content="{{ $siteDescription }}">
@php
    $robotsDirective = $seoData['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
@endphp
<meta name="robots" content="{{ $robotsDirective }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? implode(', ', $knowsAboutArr) }}">
<link rel="canonical" href="{{ $canonical }}">

@if(\App\Models\Setting::get('google_search_console'))
    {!! \App\Models\Setting::get('google_search_console') !!}
@endif

{{-- Open Graph --}}
<meta property="og:type"         content="{{ $seoData['og_type'] ?? 'website' }}">
<meta property="og:title"        content="{{ $siteTitle }}">
<meta property="og:description"  content="{{ $siteDescription }}">
<meta property="og:image"        content="{{ $ogImage }}">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt"    content="{{ $companyName }}">
<meta property="og:url"          content="{{ $canonical }}">
<meta property="og:site_name"    content="{{ $companyName }}">
<meta property="og:locale"       content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ $siteTitle }}">
<meta name="twitter:description" content="{{ $siteDescription }}">
<meta name="twitter:image"       content="{{ $ogImage }}">

{{-- Geo Meta Tags (Local SEO) --}}
<meta name="geo.region"    content="ID-JT">
<meta name="geo.placename" content="{{ $addressCity }}, {{ $addressProvince }}, Indonesia">
<meta name="geo.position"  content="{{ $geoLat }};{{ $geoLng }}">
<meta name="ICBM"          content="{{ $geoLat }}, {{ $geoLng }}">

{{-- Font Preload --}}
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- ═════════════════════════════════════════════════════════════════════════════
     CONNECTED @GRAPH SCHEMA.ORG (SEO, AEO & GEO ENTITY GRAPH)
═════════════════════════════════════════════════════════════════════════════ --}}
@php
$graph = [];

// 1. WebSite Entity
$graph[] = [
    '@type'           => 'WebSite',
    '@id'             => $appUrl . '/#website',
    'url'             => $appUrl,
    'name'            => $companyName,
    'description'     => $companyTagline,
    'publisher'       => ['@id' => $appUrl . '/#organization'],
    'potentialAction' => [
        '@type'       => 'SearchAction',
        'target'      => $appUrl . '/produk?q={search_term_string}',
        'query-input' => 'required name=search_term_string'
    ]
];

// 2. WebPage Entity
$graph[] = [
    '@type'       => 'WebPage',
    '@id'         => $canonical . '/#webpage',
    'url'         => $canonical,
    'name'        => $siteTitle,
    'isPartOf'    => ['@id' => $appUrl . '/#website'],
    'about'       => ['@id' => $appUrl . '/#organization'],
    'description' => $siteDescription,
    'inLanguage'  => 'id-ID'
];

// 3. Organization / LocalBusiness Entity
$localBusinessEntity = [
    '@type'         => $parsedTypes,
    '@id'           => $appUrl . '/#organization',
    'name'          => $companyName,
    'alternateName' => $companyName,
    'description'   => $companyTagline,
    'url'           => $appUrl,
    'logo'          => [
        '@type' => 'ImageObject',
        '@id'   => $appUrl . '/#logo',
        'url'   => $logoUrl
    ],
    'image'         => [
        '@type' => 'ImageObject',
        'url'   => $ogImage
    ],
    'telephone'     => $phoneIntl,
    'email'         => $companyEmail,
    'priceRange'    => $priceRange,
    'slogan'        => $seoSlogan,
    'foundingDate'  => $foundingDate,
    'knowsAbout'    => $knowsAboutArr,
    'areaServed'    => $areaServedEntities,
    'sameAs'        => $sameAsArr,
    'hasMap'        => $hasMapUrl,
    'address'       => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $addressStreet,
        'addressLocality' => $addressCity,
        'addressRegion'   => $addressProvince,
        'postalCode'      => $addressPostal,
        'addressCountry'  => 'ID'
    ],
    'geo'           => [
        '@type'     => 'GeoCoordinates',
        'latitude'  => (float) $geoLat,
        'longitude' => (float) $geoLng
    ],
    'openingHoursSpecification' => [
        [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => $openDaysArr,
            'opens'     => $openTime,
            'closes'    => $closeTime
        ]
    ],
    'contactPoint'  => [
        [
            '@type'             => 'ContactPoint',
            'contactType'       => 'customer service',
            'telephone'         => $phoneIntl,
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ]
];

if (!empty($founderName)) {
    $localBusinessEntity['founder'] = [
        '@type' => 'Person',
        'name'  => $founderName
    ];
}

$ratingVal   = \App\Models\Setting::get('seo_rating_value');
$ratingCount = \App\Models\Setting::get('seo_rating_count');
if (!empty($ratingVal) && !empty($ratingCount) && is_numeric($ratingVal) && is_numeric($ratingCount)) {
    $localBusinessEntity['aggregateRating'] = [
        '@type'       => 'AggregateRating',
        'ratingValue' => (float) $ratingVal,
        'reviewCount' => (int) $ratingCount
    ];
}

$graph[] = $localBusinessEntity;

// 4. FAQPage Entity (AEO Optimization)
$faqEntities = [];
foreach ($faqItems as $item) {
    if (!is_array($item)) continue;
    $shouldShow = ($item['show'] ?? '1');
    if ($shouldShow == '1' || $shouldShow === 'on' || $shouldShow === true) {
        $qText = '';
        $aText = '';
        
        // Extract Question
        if (!empty($item['question'])) {
            $qText = is_string($item['question']) ? $item['question'] : ($item['question']['name'] ?? '');
        } elseif (!empty($item['q'])) {
            $qText = is_string($item['q']) ? $item['q'] : '';
        } elseif (!empty($item['name'])) {
            $qText = is_string($item['name']) ? $item['name'] : '';
        }

        // Extract Answer
        if (!empty($item['answer'])) {
            if (is_string($item['answer'])) {
                $aText = $item['answer'];
            } elseif (is_array($item['answer'])) {
                $aText = $item['answer']['text'] ?? $item['answer']['answer'] ?? '';
            }
        } elseif (!empty($item['acceptedAnswer'])) {
            if (is_string($item['acceptedAnswer'])) {
                $aText = $item['acceptedAnswer'];
            } elseif (is_array($item['acceptedAnswer'])) {
                $aText = $item['acceptedAnswer']['text'] ?? '';
            }
        } elseif (!empty($item['a'])) {
            $aText = is_string($item['a']) ? $item['a'] : '';
        }

        $qClean = $cleanText($qText);
        $aClean = $cleanText($aText);

        if (!empty($qClean) && !empty($aClean)) {
            $faqEntities[] = [
                '@type'          => 'Question',
                'name'           => $qClean,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $aClean
                ]
            ];
        }
    }
}

if (count($faqEntities) > 0) {
    $graph[] = [
        '@type'      => 'FAQPage',
        '@id'        => $appUrl . '/#faq',
        'mainEntity' => $faqEntities
    ];
}

$fullGraphJson = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => $graph
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
@endphp

<script type="application/ld+json">
{!! $fullGraphJson !!}
</script>

{{-- Additional custom schema string if provided --}}
@if(!empty($schemaData))
<script type="application/ld+json">{!! $schemaData !!}</script>
@endif

{{-- BreadcrumbList --}}
@if(!empty($breadcrumbData))
@php
    $bcItems = [];
    foreach ($breadcrumbData as $idx => $crumb) {
        $cName = $cleanText($crumb['name'] ?? '');
        $cUrl  = preg_replace('#^https?://[^/]+#', $appUrl, $crumb['url'] ?? '');
        if (!empty($cName) && !empty($cUrl)) {
            $bcItems[] = [
                '@type'    => 'ListItem',
                'position' => $idx + 1,
                'name'     => $cName,
                'item'     => $cUrl,
            ];
        }
    }
    if (count($bcItems) > 0) {
        $bcJson = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $bcItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    } else {
        $bcJson = null;
    }
@endphp
@if($bcJson)
<script type="application/ld+json">{!! $bcJson !!}</script>
@endif
@endif

