@extends('shared.guest.base')
@section('title', __('Terms And Conditions'))

@section('seo')
    <meta name="description"
        content="{{ Core::subString(__('Review the terms and conditions governing your interaction with ITALMENARA. Ensure transparency and clarity regarding usage rights, privacy policies, refund procedures, and more, before engaging in any transactions or interactions on our platform.')) }}">
    <meta name="keywords"
        content="Terms and conditions, ITALMENARA, usage rights, privacy policies, refund procedures, terms of service, online transactions">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="ITALMENARA Terms And Conditions Page">
    <meta property="og:description"
        content="{{ Core::subString(__('Review the terms and conditions governing your interaction with ITALMENARA. Ensure transparency and clarity regarding usage rights, privacy policies, refund procedures, and more, before engaging in any transactions or interactions on our platform.')) }}">
    <meta property="og:image" content="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ Core::secure(url()->full()) }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Terms And Conditions Page">
        <meta name="twitter:description"
            content="{{ Core::subString(__('Review the terms and conditions governing your interaction with ITALMENARA. Ensure transparency and clarity regarding usage rights, privacy policies, refund procedures, and more, before engaging in any transactions or interactions on our platform.')) }}">
        <meta name="twitter:image" content="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Article",
            "headline": "Terms And Conditions",
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
            "breadcrumb": {
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem", 
                    "position": 1, 
                    "item": {
                        "@id": "{{ route('views.guest.home') }}",
                        "name": "{{ __('Home') }}"
                    }
                }, {
                    "@type": "ListItem", 
                    "position": 2, 
                    "item": {
                        "@id": "{{ route('views.guest.term') }}",
                        "name": "{{ __('Terms And Conditions') }}"
                    }
                }]
            },
            "author": {
                "@type": "Organization",
                "name": "{{ env('APP_NAME') }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "{{ env('APP_NAME') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}"
                }
            },
            "datePublished": "2024-01-01",
            "dateModified": "2024-01-01",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ route('views.guest.term') }}"
            },
            "articleBody": "{{ Core::subString(__('Review the terms and conditions governing your interaction with ITALMENARA. Ensure transparency and clarity regarding usage rights, privacy policies, refund procedures, and more, before engaging in any transactions or interactions on our platform.')) }}"
        }
    </script>
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Terms And Conditions'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => [
            [__('Home'), route('views.guest.home')],
            [__('Terms And Conditions'), route('views.guest.term')],
        ],
    ])
    <section class="w-full container mx-auto p-4 grid grid-rows-1 grid-cols-1 lg:grid-cols-6 gap-8">
        <div class="flex flex-col gap-6 lg:col-span-4">
            <os-filterable label="{{ __('Find What You Looking For') }}" target="[tabs] li"></os-filterable>
            <ul tabs class="flex flex-col gap-6">
                @foreach ($list as $item)
                    <li>
                        @include('shared.guest.tab', $item)
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex flex-col gap-4 lg:col-span-2">
            <h2 class="uppercase font-x-huge text-x-black text-xl lg:text-2xl lg:my-3">
                {{ ucwords(__('Quick Links')) }}
            </h2>
            @include('shared.guest.links', ['hide' => 1])
        </div>
    </section>
@endsection
