@forelse($services as $i => $service)
    <a href="{{ route('products.show', $service->slug) }}"
       class="sv-card"
       data-aos="fade-up"
       data-aos-delay="{{ ($i % 3) * 100 }}">

        <div class="sv-card-img">
            <img src="{{ $service->image_url }}"
                 alt="{{ $service->alt_text }}"
                 loading="lazy"
                 style="width:100%;height:100%;object-fit:cover;">

            @if(($service->rating && $service->rating > 0) || !empty($service->sold_count) || ($service->price && $service->price > 0))
                <div class="sv-card-badge-top">
                    @if(($service->rating && $service->rating > 0) || !empty($service->sold_count))
                        <div class="sv-card-rating-badge">
                            @if($service->rating && $service->rating > 0)
                                <span class="sv-rating-star">★</span>
                                <span class="sv-rating-val">{{ number_format($service->rating, 1) }}</span>
                            @endif
                            @if(($service->rating && $service->rating > 0) && !empty($service->sold_count))
                                <span class="sv-rating-sep">•</span>
                            @endif
                            @if(!empty($service->sold_count))
                                <span class="sv-sold-val">{{ $service->sold_count }} terjual</span>
                            @endif
                        </div>
                    @endif

                    @if($service->price && $service->price > 0)
                        <div class="sv-card-price-badge">
                            {{ $service->formatted_price }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="sv-card-body">
            <div class="sv-card-cat">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M5.5 7A1.5 1.5 0 014 5.5 1.5 1.5 0 015.5 4 1.5 1.5 0 017 5.5 1.5 1.5 0 015.5 7m15.91 4.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.11 0-2 .89-2 2v7c0 .55.22 1.05.59 1.41l9 9c.36.37.86.59 1.41.59.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41.01-.56-.22-1.06-.59-1.42z"/>
                </svg>
                {{ $service->category?->name ?? 'Produk Unggulan' }}
            </div>
            <h2 class="sv-card-name">{{ $service->name }}</h2>
            <p class="sv-card-desc">{{ Str::limit($service->short_desc, 90) }}</p>
            <span class="sv-card-link">
                Lihat Detail
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </span>
        </div>
    </a>
@empty
    <div class="sv-empty">
        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <h3>Produk tidak ditemukan</h3>
        <p>Tidak ada produk yang cocok dengan pencarian atau filter yang Anda pilih.</p>
    </div>
@endforelse

