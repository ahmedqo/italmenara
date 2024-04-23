@extends('shared.guest.base')
@section('title', __('Categories'))

@section('seo')
    <meta name="description"
        content="{{ Core::subString(__('Unveil ITALMENARA\'s varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.')) }}">
    <meta name="keywords"
        content="ITALMENARA, Italian craftsmanship, contemporary elegance, haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, online shopping">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="ITALMENARA Categories Page">
    <meta property="og:description"
        content="{{ Core::subString(__('Unveil ITALMENARA\'s varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.')) }}">
    <meta property="og:image" content="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ Core::secure(url()->full()) }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Categories Page">
        <meta name="twitter:description"
            content="{{ Core::subString(__('Unveil ITALMENARA\'s varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.')) }}">
        <meta name="twitter:image" content="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "ItemList",
            "name": "Product Categories at ITALMENARA",
            "url": "{{ Core::secure(url()->full()) }}",
            "description": "{{ Core::subString(__('Unveil ITALMENARA\'s varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.')) }}",
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
            },
            "itemListElement": [
                @foreach ($data as $category)
                {
                    "@type": "ListItem",
                    "position": {{ $loop->index + 1 }},
                    "item": {
                        "@type": "ListItem",
                        "name": "{{ $category->name }}",
                        "url": "{{ route('views.guest.product', ['category' => $category->slug,]) }}",
                        "image": "{{ $category->Image->Link }}",
                        "description": "{{ Core::subString($category->description ?? __('Discover a world of sophistication and style with ITALMENARA\'s product page. Explore meticulously crafted fashion pieces and refined accessories that redefine luxury and elegance, all available for online purchase.')) }}"
                    }
                }{{ $loop->last ? '' : ',' }}
                @endforeach
            ]
        }
    </script>
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Categories'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => [[__('Home'), route('views.guest.home')], [__('Categories'), route('views.guest.category')]],
    ])
    <section class="w-full container mx-auto p-4 grid grid-rows-1 grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
        @forelse ($data as $category)
            @include('shared.guest.card', [
                'typ' => 'ProductCollection',
                'txt' => $category->name,
                'src' => $category->Image->Link,
                'alt' => $category->name . ' image',
                'url' => route('views.guest.product', [
                    'category' => $category->slug,
                ]),
            ])
        @empty
            <h3 class="uppercase col-span-2 lg:col-span-4 text-center font-x-huge text-x-black text-2xl lg:text-4xl">
                {{ __('No Data Found') }}
            </h3>
        @endforelse
    </section>
    {{ $data->appends(request()->input())->links('shared.page.table') }}
@endsection
