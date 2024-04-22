@extends('shared.guest.base')
@section('title', __('Request Details'))

@section('seo')
    <meta name="description"
        content="{{ Core::subString(__('Discover the ITALMENARA Request Collection, where Italian craftsmanship converges with contemporary style online. Explore meticulously crafted pieces that redefine luxury, spanning fashion-forward apparel to refined accessories, all available for exploration and purchase.')) }}">
    <meta name="keywords"
        content="ITALMENARA, Request Collection, Italian craftsmanship, contemporary style, luxury fashion, fashion-forward apparel, refined accessories, online shopping, curated collections">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="ITALMENARA Request Page">
    <meta property="og:description"
        content="{{ Core::subString(__('Discover the ITALMENARA Request Collection, where Italian craftsmanship converges with contemporary style online. Explore meticulously crafted pieces that redefine luxury, spanning fashion-forward apparel to refined accessories, all available for exploration and purchase.')) }}">
    <meta property="og:image"
        content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ url()->full() }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Request Page">
        <meta name="twitter:description"
            content="{{ Core::subString(__('Discover the ITALMENARA Request Collection, where Italian craftsmanship converges with contemporary style online. Explore meticulously crafted pieces that redefine luxury, spanning fashion-forward apparel to refined accessories, all available for exploration and purchase.')) }}">
        <meta name="twitter:image"
            content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Request Details'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => [
            [__('Home'), route('views.guest.home')],
            [__('Request Details'), route('views.guest.request')],
        ],
    ])
    <section id="main" class="w-full container mx-auto p-4">
        <form action="{{ route('actions.guest.request') }}" method="POST"
            class="grid grid-rows-1 grid-cols-1 lg:grid-cols-5 gap-8">
            @csrf
            <ul id="items" class="flex flex-col gap-4 lg:col-span-3">
                <li class="my-10">
                    <svg id="loader" stroke="currentColor" viewBox="0 0 24 24">
                        <title>loading icon</title>
                        <g>
                            <circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3"></circle>
                        </g>
                    </svg>
                </li>
            </ul>
            <div
                class="w-full lg:col-span-2 flex flex-col bg-x-white gap-4 lg:gap-6 p-6 lg:p-8 rounded-x-huge shadow-x-core">
                <os-text label="{{ __('Name') }}" name="name" value="{{ old('name') }}"></os-text>
                <os-text type="email" label="{{ __('Email') }}" name="email" value="{{ old('email') }}"></os-text>
                <os-text type="tel" label="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}"></os-text>
                <os-area rows="2" label="{{ __('Message') }}" name="message" value="{{ old('message') }}"></os-area>
                <os-button
                    class="w-full rounded-x-huge px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-gradient-to-br rtl:bg-gradient-to-bl bg-x-core focus-within:outline-none">
                    {{ __('Send Request') }}
                </os-button>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        RequestInitializer({
            Search: "{{ route('views.guest.search') }}",
            Target: document.querySelector("#items"),
            Main: document.querySelector("#main"),
            Clear: {{ Session::get('clear') ? 'true' : 'false' }}
        })
    </script>
@endsection
