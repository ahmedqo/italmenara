@extends('shared.guest.base')
@section('title', $data->name)

@section('seo')
    <meta name="description"
        content="{{ Core::subString($data->details ?? __('Indulge in luxury with ITALMENARA\'s exquisite product. Delve into the intricate details of each meticulously crafted item, from haute couture fashion to refined accessories, embodying Italian craftsmanship and contemporary elegance.')) }}">
    <meta name="keywords"
        content="ITALMENARA, single product, luxury fashion, Italian craftsmanship, contemporary elegance, haute couture, refined accessories, designer wear, online shopping, men's fashion, women's fashion">
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="{{ $data->name . '|' . env('APP_NAME') }}">
    <meta property="product:name" content="{{ $data->name }}" />
    <meta property="product:brand" content="{{ $data->Brand->name }}" />
    <meta property="product:category" content="{{ $data->Category->name }}" />
    <meta property="product:availability" content="in stock" />
    <meta property="og:description"
        content="{{ Core::subString($data->details ?? __('Indulge in luxury with ITALMENARA\'s exquisite product. Delve into the intricate details of each meticulously crafted item, from haute couture fashion to refined accessories, embodying Italian craftsmanship and contemporary elegance.')) }}">
    <meta property="og:image" content="{{ $data->Images[0]->Link }}">
    <meta property="og:url" content="{{ Core::secure(url()->full()) }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="{{ $data->name . '|' . env('APP_NAME') }}">
        <meta name="twitter:description"
            content="{{ Core::subString($data->details ?? __('Indulge in luxury with ITALMENARA\'s exquisite product. Delve into the intricate details of each meticulously crafted item, from haute couture fashion to refined accessories, embodying Italian craftsmanship and contemporary elegance.')) }}">
        <meta name="twitter:image" content="{{ $data->Images[0]->Link }}">
    @endif
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Product",
            "name": "{{ $data->name }}",
            "brand": "{{ $data->Brand->name }}",
            "category": "{{ $data->Category->name }}",
            "image": "{{ $data->Images[0]->Link }}",
            "description": "{{ Core::subString($data->details ?? __('Indulge in luxury with ITALMENARA\'s exquisite product. Delve into the intricate details of each meticulously crafted item, from haute couture fashion to refined accessories, embodying Italian craftsmanship and contemporary elegance.')) }}",
            "offers": {
                "@type": "Offer",
                "availability": "http://schema.org/InStock",
                "url": "{{ Core::secure(url()->full()) }}",
                "priceValidUntil": "{{ now()->format('Y-m-d') }}",
                "priceCurrency": "EUR",
                "price": "{{ $data->price }}"
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.5",
                "reviewCount": "10"
            },
            "review": {
                "@type": "Review",
                "author": {
                    "@type": "Organization",
                    "name": "{{ env('APP_NAME') }}"
                },
                "datePublished": "{{ now()->format('Y-m-d') }}",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "4.5"
                },
                "description": "This product is amazing!"
            },
            "hasMerchantReturnPolicy": {
                "@type": "MerchantReturnPolicy",
                "name": "Return Policy",
                "url": "{{ route('views.guest.return') }}"
            },
            "shippingDetails": {
                "@type": "OfferShippingDetails",
                "shippingRate": {
                    "@type": "MonetaryAmount",
                    "value": {
                        "@type": "QuantitativeValue",
                        "value": "1000",
                        "unitText": "EUR"
                    }
                }
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "{{ route('views.guest.product') }}?search={search_term_string}"
                },
                "query-input": {
                    "@type": "PropertyValueSpecification",
                    "valueRequired": true,
                    "valueName": "search_term_string"
                }
            }
        }
    </script>
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Product Details'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => [
            [__('Home'), route('views.guest.home')],
            [__('Products'), route('views.guest.product')],
            [$data->name, route('views.guest.show', $data->slug)],
        ],
    ])
    <section itemscope itemtype="https://schema.org/Product"
        class="hproduct w-full container mx-auto p-4 grid grid-rows-1 grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-8">
        <div
            class="bg-x-white lg:sticky top-4 shadow-x-core w-full aspect-video rounded-x-huge overflow-hidden lg:col-span-3">
            <div class="w-full h-full relative">
                <div id="slide" class="w-full h-full">
                    <ul class="w-full h-full">
                        @foreach ($data->Images as $image)
                            <li class="w-full h-full flex items-center justify-center">
                                <img src="{{ $image->Link }}" itemprop="image"
                                    alt="{{ env('APP_NAME') }} {{ $data->name }} product image {{ $loop->index + 1 }}"
                                    width="100%" height="100%"
                                    class="photo block w-full h-full object-contain object-center" />
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div dir="ltr"
                    class="flex w-full p-2 justify-between items-center absolute top-1/2 -translate-y-1/2 left-0 right-0 pointer-events-none">
                    <button id="prev" name="prev-button"
                        class="shadow-x-core pointer-events-auto flex rounded-full w-8 h-8 items-center justify-center bg-x-prime text-x-white hover:text-x-black focus:text-x-black hover:bg-x-acent focus:bg-x-acent outline-none">
                        <svg class="pointer-events-none w-6 h-6" fill="currentColor" viewBox="0 96 960 960">
                            <path
                                d="M528 805 331 607q-7-6-10.5-14t-3.5-18q0-9 3.5-17.5T331 543l198-199q13-12 32-12t33 12q13 13 12.5 33T593 410L428 575l166 166q13 13 13 32t-13 32q-14 13-33.5 13T528 805Z" />
                        </svg>
                    </button>
                    <button id="next" name="next-button"
                        class="shadow-x-core pointer-events-auto flex rounded-full w-8 h-8 items-center justify-center bg-x-prime text-x-white hover:text-x-black focus:text-x-black hover:bg-x-acent focus:bg-x-acent outline-none">
                        <svg class="pointer-events-none w-6 h-6" fill="currentColor" viewBox="0 96 960 960">
                            <path
                                d="M344 805q-14-15-14-33.5t14-31.5l164-165-165-166q-14-12-13.5-32t14.5-33q13-14 31.5-13.5T407 344l199 199q6 6 10 14.5t4 17.5q0 10-4 18t-10 14L408 805q-13 13-32 12.5T344 805Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="w-full lg:col-span-2 flex flex-col gap-6 lg:gap-8">
            <div class="w-full flex flex-col">
                <h1 itemprop="name" class="fn w-full text-x-black font-x-huge text-xl lg:text-3xl">
                    {{ $data->name }}
                </h1>
                <h3 class="w-full text-x-black text-opacity-50 font-x-thin text-sm lg:text-base">
                    <span>{{ __('Sku') }}:</span> {{ $data->sku }}
                </h3>
            </div>
            @if ($data->details)
                <div itemprop="description" class="description flex flex-col gap-2 -mt-2 lg:-mt-4">
                    @foreach (Core::getArray($data->details) as $detail)
                        <p class="text-base font-medium text-x-black text-justify">
                            {{ $detail }}
                        </p>
                    @endforeach
                </div>
            @endif
            <div class="flex flex-wrap gap-4">
                <div class="flex flex-col gap-1">
                    <h3 class="w-full text-x-black font-x-thin text-sm lg:text-base">
                        {{ __('Category') }}
                    </h3>
                    <a aria-label="category {{ $data->Category->name }}"
                        href="{{ route('views.guest.product', [
                            'category' => $data->Category->slug,
                        ]) }}">
                        <img src="{{ $data->Category->Image->Link }}"
                            alt="{{ env('APP_NAME') }} {{ $data->Category->name }} category image" width="6rem"
                            height="auto"
                            class="block w-24 aspect-video object-cover bg-x-white object-center rounded-x-thin overflow-hidden" />
                    </a>
                </div>
                <div class="flex flex-col gap-1">
                    <h3 class="w-full text-x-black font-x-thin text-sm lg:text-base">
                        {{ __('Brand') }}
                    </h3>
                    <a aria-label="brand {{ $data->Brand->name }}"
                        href="{{ route('views.guest.product', [
                            'brand' => $data->Brand->slug,
                        ]) }}">
                        <img src="{{ $data->Brand->Image->Link }}"
                            alt="{{ env('APP_NAME') }} {{ $data->Brand->name }} brand image" width="6rem" height="auto"
                            class="block w-24 aspect-video object-contain bg-x-white object-center rounded-x-thin overflow-hidden" />
                    </a>
                </div>
            </div>
            <form id="item" class="flex flex-col gap-4 mt-auto">
                <input type="hidden" name="product" value="{{ $data->id }}">
                <os-counter class="w-32 counter" name="quantity" value="{{ old('quantity') ?? '1' }}"
                    min="1"></os-counter>
                <os-button
                    class="w-full rounded-x-huge px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-gradient-to-br rtl:bg-gradient-to-bl bg-x-core focus-within:outline-none">
                    {{ __('Request Quotation') }}
                </os-button>
            </form>
        </div>
        <div class="hidden">
            <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <meta class="availability" itemprop="availability" content="http://schema.org/InStock">
                <meta itemprop="priceValidUntil" content="{{ now()->format('Y-m-d') }}">
                <meta class="currency" itemprop="priceCurrency" content="EUR">
                <meta class="price" itemprop="price" content="{{ $data->price }}">
            </div>
            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="4.5">
                <meta itemprop="reviewCount" content="10">
            </div>
            <div itemprop="review" itemscope itemtype="https://schema.org/Review">
                <div itemprop="author" itemscope itemtype="https://schema.org/Organization">
                    <meta itemprop="name" content="{{ env('APP_NAME') }}">
                </div>
                <meta itemprop="datePublished" content="{{ now()->format('Y-m-d') }}">
                <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                    <meta itemprop="ratingValue" content="4.5">
                </div>
                <span itemprop="description">This product is amazing!</span>
            </div>
            <div itemprop="hasMerchantReturnPolicy" itemscope itemtype="https://schema.org/ReturnPolicy">
                <span itemprop="name">{{ route('views.guest.return') }}</span>
            </div>
            <div itemprop="shippingDetails" itemscope itemtype="https://schema.org/OfferShippingDetails">
                <div itemprop="shippingRate" itemscope itemtype="https://schema.org/MonetaryAmount">
                    <span itemprop="currency">EUR</span>
                    <span itemprop="value">{{ $data->price }}</span>
                </div>
            </div>
        </div>
    </section>
    @if ($data->description)
        <section class="w-full container mx-auto p-4 flex flex-col gap-4">
            <h3 class="w-full text-x-black font-x-huge text-xl lg:text-2xl">{{ __('Description') }}</h3>
            <div class="w-full revert">
                {!! $data->description !!}
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script defer>
        ShowCase()
    </script>
@endsection
