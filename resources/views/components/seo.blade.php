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

    // Detect Page Context
    $isHomePage       = request()->is('/');
    $isContactPage    = request()->is('kontak') || request()->is('contact');
    $isArticleDetail  = isset($article) || ($seoData['og_type'] ?? '') === 'article';

    // Global Phone & Location Fallbacks
    $primaryWaModel   = \App\Models\WaSetting::primary() ?? \App\Models\WaSetting::where('is_active', true)->first();
    $rawWaPhone       = $primaryWaModel?->nomor_wa ?? \App\Models\Setting::get('company_whatsapp', \App\Models\Setting::get('phone', '081805890181'));
    $cleanWa          = preg_replace('/[^0-9]/', '', $rawWaPhone);
    if (str_starts_with($cleanWa, '0')) {
        $cleanWa = '62' . substr($cleanWa, 1);
    }
    $defaultPhoneIntl = '+' . ltrim($cleanWa, '+');

    $globalStreet     = \App\Models\Setting::get('address_full', \App\Models\Setting::get('address_street', 'Jl. Semarang No. 88'));
    $globalCity       = \App\Models\Setting::get('address_city', 'Semarang');
    $globalProv       = \App\Models\Setting::get('address_province', 'Jawa Tengah');
    $globalPostal     = \App\Models\Setting::get('address_postal', '50123');

    // Dynamic settings from DB
    $companyName      = $cleanText(\App\Models\Setting::get('company_name', 'Pusat Piring Keramik'));
    if (empty($companyName)) $companyName = 'Pusat Piring Keramik';

    $companyLegalName = $cleanText(\App\Models\Setting::get('company_legal_name', 'UD. Sukses Makmur'));
    if (empty($companyLegalName)) $companyLegalName = 'UD. Sukses Makmur';

    $companyTagline   = $cleanText(\App\Models\Setting::get('company_tagline', 'Distributor & Supplier Piring Keramik Indonesia'));
    if (empty($companyTagline)) $companyTagline = 'Distributor & Supplier Piring Keramik Terpercaya';

    // Address & City/Province
    $seoCity          = \App\Models\Setting::get('address_city_name');
    $rawCity          = !empty(trim($seoCity)) ? $seoCity : $globalCity;
    $addressCity      = $cleanText((is_numeric($rawCity) || preg_match('/^[0-9]+$/', trim($rawCity))) ? 'Semarang' : $rawCity);
    if (empty($addressCity)) $addressCity = 'Semarang';

    $seoProv          = \App\Models\Setting::get('address_province_name');
    $rawProvince      = !empty(trim($seoProv)) ? $seoProv : $globalProv;
    $addressProvince  = $cleanText((is_numeric($rawProvince) || preg_match('/^[0-9]+$/', trim($rawProvince))) ? 'Jawa Tengah' : $rawProvince);
    if (empty($addressProvince)) $addressProvince = 'Jawa Tengah';

    $seoStreet        = \App\Models\Setting::get('address_street_full');
    $addressStreet    = $cleanText(!empty(trim($seoStreet)) ? $seoStreet : $globalStreet);
    if (empty($addressStreet)) $addressStreet = 'Jl. Semarang No. 88';

    $seoPostal        = \App\Models\Setting::get('address_postal_code');
    $addressPostal    = $cleanText(!empty(trim($seoPostal)) ? $seoPostal : $globalPostal);
    if (empty($addressPostal)) $addressPostal = '50123';

    // Phone International Format
    $seoPhoneIntl     = \App\Models\Setting::get('phone_international');
    $phoneIntl        = $cleanText(!empty(trim($seoPhoneIntl)) ? $seoPhoneIntl : $defaultPhoneIntl);
    if (empty($phoneIntl)) $phoneIntl = '+628562682888';

    $companyEmail     = $cleanText(\App\Models\Setting::get('email', 'info@pusatpiringkeramik.com'));

    // Geo Coordinates Fix (Only output if numeric & valid!)
    $rawLat           = trim(\App\Models\Setting::get('geo_latitude', ''));
    $rawLng           = trim(\App\Models\Setting::get('geo_longitude', ''));
    $hasValidGeo      = is_numeric($rawLat) && is_numeric($rawLng) && (float)$rawLat != 0;
    $geoLat           = $hasValidGeo ? (float)$rawLat : -6.9932;
    $geoLng           = $hasValidGeo ? (float)$rawLng : 110.4203;

    // Google Maps URL (hasMap) Fix
    $hasMapUrl        = $cleanText(\App\Models\Setting::get('google_maps_url', 'https://maps.app.goo.gl/nwSPbvpqsipMNvpm8'));
    if (empty($hasMapUrl) || str_contains($hasMapUrl, 'maps.google.com/?cid=')) {
        $hasMapUrl    = 'https://maps.app.goo.gl/nwSPbvpqsipMNvpm8';
    }

    // SEO Attributes
    $priceRange       = $cleanText(\App\Models\Setting::get('seo_price_range', 'Rp5.000 - Rp500.000'));
    $seoSlogan        = $cleanText(\App\Models\Setting::get('seo_slogan', 'Distributor & Supplier Piring Keramik Terpercaya'));
    $foundingDate     = $cleanText(\App\Models\Setting::get('seo_founding_date', '2015'));
    $founderName      = $cleanText(\App\Models\Setting::get('seo_founder_name', 'UD. Sukses Makmur'));

    $knowsAboutRaw    = \App\Models\Setting::get('seo_knows_about', 'Piring Keramik, Mangkok Keramik, Perabotan Restoran & Hotel, Tableware, Dinnerware, Keramik Custom Logo');
    $knowsAboutArr    = array_values(array_filter(array_map($cleanText, explode(',', $knowsAboutRaw))));

    $areaServedRaw    = \App\Models\Setting::get('seo_area_served', 'Semarang, Jawa Tengah, Indonesia');
    $areaServedItems  = array_values(array_filter(array_map($cleanText, explode(',', $areaServedRaw))));

    $areaServedEntities = [];
    foreach ($areaServedItems as $areaItem) {
        $lowerArea = strtolower($areaItem);
        if (in_array($lowerArea, ['indonesia', 'id', 'republik indonesia'])) {
            $areaServedEntities[] = ['@type' => 'Country', 'name' => 'Indonesia'];
        } elseif (str_contains($lowerArea, 'jawa') || str_contains($lowerArea, 'provinsi') || str_contains($lowerArea, 'region')) {
            $areaServedEntities[] = ['@type' => 'AdministrativeArea', 'name' => $areaItem];
        } else {
            $areaServedEntities[] = ['@type' => 'City', 'name' => $areaItem];
        }
    }

    // SameAs Array Fix (Exclude own website URL & Google Maps shortlinks)
    $sameAsRaw        = \App\Models\Setting::get('seo_same_as_urls', '');
    $sameAsArr        = [];
    if (!empty($sameAsRaw)) {
        $lines = explode("\n", $sameAsRaw);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && filter_var($line, FILTER_VALIDATE_URL)) {
                if ($line !== $appUrl && $line !== $appUrl . '/' && !str_contains($line, 'maps.app.goo.gl') && !in_array($line, $sameAsArr)) {
                    $sameAsArr[] = $line;
                }
            }
        }
    }

    // Title & Description Fix
    $rawTitle         = $cleanText($seoData['title'] ?? '');
    if (empty($rawTitle)) {
        $rawTitle = $companyName . ($companyTagline ? ' | ' . $companyTagline : '');
    }
    $siteTitle        = $rawTitle;

    $rawDesc          = $cleanText($seoData['description'] ?? '');
    if (empty($rawDesc)) {
        $rawDesc = $companyName . ' - ' . $companyTagline . '. Distributor piring keramik grosir dan eceran berkualitas tinggi.';
    }
    $siteDescription  = $rawDesc;

    $rawCanonical     = $seoData['canonical'] ?? url()->current();
    $canonical        = preg_replace('#^https?://[^/]+#', $appUrl, $rawCanonical);

    $logoPath         = \App\Models\Setting::get('logo');
    $logoUrl          = $logoPath ? $appUrl . '/storage/' . ltrim($logoPath, '/') : $appUrl . '/favicon.ico';

    $rawOg            = $seoData['og_image'] ?? $logoUrl;
    $ogImage          = preg_match('#^https?://#', $rawOg)
                          ? preg_replace('#^https?://[^/]+#', $appUrl, $rawOg)
                          : $appUrl . '/' . ltrim($rawOg, '/');

    // Store FAQs (Only shown on Homepage & Contact page)
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
                'answer'   => 'Sangat aman. Setiap piring keramik dipack berlapis menggunakan bubble wrap tebal dan packing kayu terstandar dengan garansi pengiriman aman.',
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
$webPageEntity = [
    '@type'       => 'WebPage',
    '@id'         => $canonical . '/#webpage',
    'url'         => $canonical,
    'name'        => $siteTitle,
    'isPartOf'    => ['@id' => $appUrl . '/#website'],
    'about'       => ['@id' => $appUrl . '/#organization'],
    'description' => $siteDescription,
    'inLanguage'  => 'id-ID'
];

if ($isArticleDetail && isset($article)) {
    $webPageEntity['mainEntity'] = ['@id' => $canonical . '/#article'];
}

$graph[] = $webPageEntity;

// 3. Organization / LocalBusiness & BlogPosting Entities
if ($isArticleDetail && isset($article)) {
    // Concise Organization publisher reference for articles
    $graph[] = [
        '@type'     => 'Organization',
        '@id'       => $appUrl . '/#organization',
        'name'      => $companyName,
        'legalName' => $companyLegalName,
        'url'       => $appUrl,
        'logo'      => [
            '@type' => 'ImageObject',
            '@id'   => $appUrl . '/#logo',
            'url'   => $logoUrl
        ],
        'telephone' => $phoneIntl,
        'email'     => $companyEmail,
        'sameAs'    => $sameAsArr
    ];

    // BlogPosting Schema for Article Detail
    $artImgUrl = !empty($article->image) ? $appUrl . '/storage/' . ltrim($article->image, '/') : $ogImage;
    $pubDate   = $article->published_at ? \Carbon\Carbon::parse($article->published_at)->toIso8601String() : \Carbon\Carbon::parse($article->created_at)->toIso8601String();
    $modDate   = \Carbon\Carbon::parse($article->updated_at)->toIso8601String();

    $blogPostingEntity = [
        '@type'            => 'BlogPosting',
        '@id'              => $canonical . '/#article',
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $canonical . '/#webpage'],
        'headline'         => $cleanText($article->title),
        'description'      => $cleanText($article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content ?? ''), 160)),
        'articleBody'      => $cleanText(strip_tags($article->content ?? '')),
        'inLanguage'       => 'id-ID',
        'datePublished'    => $pubDate,
        'dateModified'     => $modDate,
        'wordCount'        => str_word_count(strip_tags($article->content ?? '')),
        'image'            => [
            '@type'  => 'ImageObject',
            'url'    => $artImgUrl,
            'width'  => 1200,
            'height' => 675
        ],
        'author'           => [
            '@type' => 'Organization',
            'name'  => $cleanText($article->author ?? $companyName),
            'url'   => $appUrl
        ],
        'publisher'        => [
            '@type' => 'Organization',
            '@id'   => $appUrl . '/#organization',
            'name'  => $companyName,
            'url'   => $appUrl,
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => $logoUrl
            ]
        ]
    ];

    if (!empty($article->category)) {
        $blogPostingEntity['articleSection'] = $cleanText($article->category);
    }

    $graph[] = $blogPostingEntity;

    // Optional Article Specific FAQs (ONLY if specifically present on the article)
    $articleFaqs = $article->faqs ?? [];
    $validArticleFaqs = array_filter($articleFaqs, fn($f) => !empty($f['q']) && !empty($f['a']));
    if (!empty($validArticleFaqs)) {
        $faqEntities = [];
        foreach ($validArticleFaqs as $f) {
            $faqEntities[] = [
                '@type'          => 'Question',
                'name'           => $cleanText($f['q']),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $cleanText($f['a'])
                ]
            ];
        }
        if (count($faqEntities) > 0) {
            $graph[] = [
                '@type'      => 'FAQPage',
                '@id'        => $canonical . '/#faq',
                'mainEntity' => $faqEntities
            ];
        }
    }

} else {
    // On Homepage, Contact, and General Pages: Output Full LocalBusiness / HomeGoodsStore Entity
    $localBusinessEntity = [
        '@type'         => 'HomeGoodsStore',
        '@id'           => $appUrl . '/#organization',
        'name'          => $companyName,
        'legalName'     => $companyLegalName,
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
        ]
    ];

    if ($hasValidGeo) {
        $localBusinessEntity['geo'] = [
            '@type'     => 'GeoCoordinates',
            'latitude'  => (float) $geoLat,
            'longitude' => (float) $geoLng
        ];
    }

    $localBusinessEntity['openingHoursSpecification'] = [
        [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens'     => '08:00',
            'closes'    => '17:00'
        ]
    ];

    $localBusinessEntity['contactPoint'] = [
        [
            '@type'             => 'ContactPoint',
            'contactType'       => 'customer service',
            'telephone'         => $phoneIntl,
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ];

    if (!empty($founderName)) {
        $localBusinessEntity['founder'] = [
            '@type' => 'Person',
            'name'  => $founderName
        ];
    }

    // AggregateRating ONLY on Homepage IF valid numeric values exist
    if ($isHomePage) {
        $ratingVal   = \App\Models\Setting::get('seo_rating_value');
        $ratingCount = \App\Models\Setting::get('seo_rating_count');
        if (!empty($ratingVal) && !empty($ratingCount) && is_numeric($ratingVal) && is_numeric($ratingCount) && (float)$ratingVal > 0 && (int)$ratingCount > 0) {
            $localBusinessEntity['aggregateRating'] = [
                '@type'       => 'AggregateRating',
                'ratingValue' => (float) $ratingVal,
                'reviewCount' => (int) $ratingCount
            ];
        }
    }

    $graph[] = $localBusinessEntity;

    // FAQPage schema on Homepage & Contact page
    if ($isHomePage || $isContactPage) {
        $faqEntities = [];
        foreach ($faqItems as $item) {
            if (!is_array($item)) continue;
            $shouldShow = ($item['show'] ?? '1');
            if ($shouldShow == '1' || $shouldShow === 'on' || $shouldShow === true) {
                $qText = $cleanText($item['question'] ?? ($item['q'] ?? ($item['name'] ?? '')));
                $aText = $cleanText($item['answer'] ?? ($item['a'] ?? ($item['acceptedAnswer'] ?? '')));
                if (!empty($qText) && !empty($aText)) {
                    $faqEntities[] = [
                        '@type'          => 'Question',
                        'name'           => $qText,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text'  => $aText
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
    }
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
