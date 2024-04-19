@extends('shared.guest.base')
@section('title', __('Products'))

@section('seo')
    <meta name="description"
        content="{{ Core::subString($seo ?? 'Discover a world of sophistication and style with ITALMENARA\'s product page. Explore meticulously crafted fashion pieces and refined accessories that redefine luxury and elegance, all available for online purchase.') }}">
    <meta name="keywords"
        content="ITALMENARA, fashion, luxury, Italian craftsmanship, contemporary style, haute couture, accessories, designer wear, online shopping, men's fashion, women's fashion, curated collections">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="ITALMENARA Products Page">
    <meta property="og:description"
        content="{{ Core::subString($seo ?? 'Discover a world of sophistication and style with ITALMENARA\'s product page. Explore meticulously crafted fashion pieces and refined accessories that redefine luxury and elegance, all available for online purchase.') }}">
    <meta property="og:image"
        content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Products Page">
        <meta name="twitter:description"
            content="{{ Core::subString($seo ?? 'Discover a world of sophistication and style with ITALMENARA\'s product page. Explore meticulously crafted fashion pieces and refined accessories that redefine luxury and elegance, all available for online purchase.') }}">
        <meta name="twitter:image"
            content="{{ request()->getHost() }}{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}">
    @endif
@endsection

@section('header')
    @include('shared.guest.show', [
        'txt' => __('Products'),
        'src' => asset('img/bg-hero.webp'),
    ])
@endsection

@section('content')
    @include('shared.guest.nav', [
        'items' => $items,
    ])
    <section class="w-full container mx-auto p-4 grid grid-rows-1 grid-cols-1 lg:grid-cols-4 gap-4 lg:gap-8">
        <div class="w-full flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <h2 class="font-x-huge text-x-black text-lg lg:text-2xl">{{ __('Categories') }}</h2>
                <button id="trigger" name="categories-trigger"
                    class="block lg:hidden p-2 rounded-x-thin text-x-black lg:text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <title>category menu icon</title>
                        <path
                            d="M725.225-111q-68.745 0-114.985-47.112Q564-205.224 564-273.162q0-67.938 46.298-114.888T724.528-435q67.932 0 115.702 47Q888-341 888-273.662q0 68.438-47.485 115.55Q793.031-111 725.225-111ZM68-227v-92h415v92H68Zm167.887-298q-67.663 0-114.775-47.112Q74-619.224 74-687.162q0-67.938 47.182-114.888Q168.365-849 235.732-849q67.368 0 114.818 47T398-687.662q0 68.438-47.225 115.55Q303.551-525 235.887-525ZM478-641v-92h415v92H478Z" />
                    </svg>
                </button>
            </div>
            <nav class="hidden lg:block w-full rounded-x-huge border-4 border-x-shade border-dashed p-2">
                <ul class="flex flex-col">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('views.guest.product', [
                                'category' => $category->slug,
                            ]) }}"
                                aria-label="category {{ $category->name }} products list"
                                class="block px-2 py-1 text-x-black font-medium text-lg rounded-x-thin outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                                {{ ucwords($category->name) }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('views.guest.category') }}" aria-label="categories page"
                            class="block px-2 py-1 text-x-prime font-medium text-sm underline">
                            {{ __('View All') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <os-sidebar fixed class="lg:hidden">
            <div class="w-full flex flex-col gap-2 my-4">
                <h2 class="font-x-huge text-x-black text-xl lg:text-2xl px-4">{{ __('Categories') }}</h2>
                <nav class="block w-full">
                    <ul class="flex flex-col">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('views.guest.product', [
                                    'category' => $category->slug,
                                ]) }}"
                                    aria-label="category {{ $category->name }} products page"
                                    class="block px-4 py-1 text-x-black font-medium text-lg rounded-x-thin outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                                    {{ ucwords($category->name) }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('views.guest.category') }}" aria-label="categories page"
                                class="block px-4 py-1 text-x-prime font-medium text-sm underline">
                                {{ __('View All') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </os-sidebar>
        <div class="lg:col-span-3 grid grid-cols-2 grid-rows-1 lg:grid-cols-3 gap-4 lg:gap-8">
            @forelse ($data as $product)
                @include('shared.guest.card', [
                    'typ' => 'Offers',
                    'txt' => $product->name,
                    'src' => $product->Images[0]->Link,
                    'alt' => $product->name . ' image',
                    'url' => route('views.guest.show', $product->slug),
                ])
            @empty
                <h3 class="uppercase col-span-2 lg:col-span-4 text-center font-x-huge text-x-black text-2xl lg:text-4xl">
                    {{ __('No Data Found') }}
                </h3>
            @endforelse
        </div>
    </section>
@endsection
