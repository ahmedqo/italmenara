@extends('shared.guest.base')
@section('title', __('Categories'))

@section('seo')
    <meta name="description"
        content="Unveil ITALMENARA's varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.">
    <meta name="keywords"
        content="ITALMENARA, Italian craftsmanship, contemporary elegance, haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, online shopping">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="ITALMENARA Categories Page">
    <meta property="og:description"
        content="Unveil ITALMENARA's varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.">
    <meta property="og:image"
        content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Categories Page">
        <meta name="twitter:description"
            content="Unveil ITALMENARA's varied categories, merging Italian craftsmanship with contemporary elegance effortlessly. Explore haute couture fashion, exquisite accessories, luxury lifestyle, Italian design, curated collections, and more, meticulously crafted to redefine style and luxury online.">
        <meta name="twitter:image"
            content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
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
