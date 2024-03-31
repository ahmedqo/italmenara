@extends('shared.guest.base')
@section('title', __('Brands'))

@section('seo')
    <meta name="description"
        content="Discover ITALMENARA Brands Collection, the epitome of Italian craftsmanship fused with contemporary style. Browse through meticulously crafted pieces that redefine luxury, encompassing fashion-forward apparel and refined accessories, all available online.">
    <meta name="keywords"
        content="Italian craftsmanship, contemporary style, luxury fashion, fashion-forward apparel, refined accessories, online shopping, ITALMENARA Brands Collection">
    <meta property="og:title" content="ITALMENARA Brands Page">
    <meta property="og:description"
        content="Discover ITALMENARA Brands Collection, the epitome of Italian craftsmanship fused with contemporary style. Browse through meticulously crafted pieces that redefine luxury, encompassing fashion-forward apparel and refined accessories, all available online.">
    <meta property="og:image" content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Brands Page">
        <meta name="twitter:description"
            content="Discover ITALMENARA Brands Collection, the epitome of Italian craftsmanship fused with contemporary style. Browse through meticulously crafted pieces that redefine luxury, encompassing fashion-forward apparel and refined accessories, all available online.">
        <meta name="twitter:image"
            content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Brands'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => [[__('Home'), route('views.guest.home')], [__('Brands'), route('views.guest.brand')]],
    ])
    <section class="w-full container mx-auto p-4 grid grid-rows-1 grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
        @forelse ($data as $brand)
            @include('shared.guest.card', [
                'fit' => true,
                'txt' => $brand->name,
                'src' => $brand->Image->Link,
                'alt' => $brand->name . ' image',
                'url' => route('views.guest.product', [
                    'brand' => $brand->slug,
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
