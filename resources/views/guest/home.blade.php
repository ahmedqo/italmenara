@extends('shared.guest.base')
@section('title', __('Home'))

@section('seo')
    <meta name="description"
        content="{{ Core::subString($principal->content ?? __('Explore luxury fashion and accessories at ITALMENARA. Discover exquisite designer wear embodying Italian craftsmanship and contemporary elegance.')) }}">
    <meta name="keywords"
        content="ITALMENARA, Italian craftsmanship, contemporary style, luxury fashion, haute couture, refined accessories, curated collections, online shopping, men's fashion, women's fashion, designer wear, lifestyle, elegance, sophistication">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="ITALMENARA Home Page">
    <meta property="og:description"
        content="{{ Core::subString($principal->content ?? __('Explore luxury fashion and accessories at ITALMENARA. Discover exquisite designer wear embodying Italian craftsmanship and contemporary elegance.')) }}">
    <meta property="og:image" content="{{ $principal->Images[0]->Link }}">
    <meta property="og:url" content="{{ Core::secure(url()->full()) }}">
    @if (Core::getSetting('x'))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Core::getSetting('x') }}">
        <meta name="twitter:title" content="ITALMENARA Home Page">
        <meta name="twitter:description"
            content="{{ Core::subString($principal->content ?? __('Explore luxury fashion and accessories at ITALMENARA. Discover exquisite designer wear embodying Italian craftsmanship and contemporary elegance.')) }}">
        <meta name="twitter:image" content="{{ $principal->Images[0]->Link }}">
    @endif
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "name": "{{ env('APP_NAME') }}",
            "url": "{{ Core::secure(url()->full()) }}",
            "description": "{{ Core::subString($principal->content ?? __('Explore luxury fashion and accessories at ITALMENARA. Discover exquisite designer wear embodying Italian craftsmanship and contemporary elegance.')) }}",
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('header')
    <div class="w-full container gap-4 mx-auto p-4 flex flex-col lg:flex-row lg:flex-wrap relative">
        <h1 data-aos="zoom-out-up" class="uppercase lg:hidden font-x-huge text-x-black text-3xl text-center !leading-[1]">
            {{ __('Italian Elegance For Africa') }}
        </h1>
        <div data-aos="fade-{{ Core::lang('ar') ? 'right' : 'left' }}" data-aos-delay="100"
            class="bg-x-acent w-full lg:w-[70%] aspect-video overflow-hidden rounded-x-huge lg:ms-auto">
            <div id="slide" class="w-full h-full">
                <ul class="w-full h-full">
                    @foreach ($principal->Images as $image)
                        <li class="w-full h-full flex items-center justify-center">
                            <img src="{{ $image->Link }}" alt="{{ env('APP_NAME') }} slide image {{ $loop->index + 1 }}"
                                loading="lazy" width="100%" height="100%" class="block w-full h-full object-cover" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div
            class="lg:px-0 px-2 -mt-16 md:-mt-10 lg:mt-0 lg:order-[-1] lg:w-[42%] lg:absolute lg:left-4 rtl:lg:left-auto rtl:lg:right-4 lg:top-1/2 lg:-translate-y-1/2">
            <div data-aos="zoom-out-up" data-aos-delay="150" class="flex flex-col gap-4">
                <h3
                    class="uppercase hidden lg:block font-x-huge text-x-black text-[2.6rem] xl:text-[3.18rem] !leading-[1] drop-shadow-[0_0_4px_rgb(var(--white))]">
                    {{ __('Italian Elegance For Africa') }}
                </h3>
                <div
                    class="w-full p-6 lg:p-8 rounded-x-huge shadow-x-core flex flex-col gap-2 relative z-[1] after:content-[''] after:absolute after:inset-0 after:w-full after:h-full after:bg-x-black after:rounded-x-huge after:bg-x-radial after:z-[-1] before:content-[''] before:absolute before:inset-0 before:w-full before:h-full before:bg-x-white before:rounded-x-huge before:z-[-1]">
                    @foreach (Core::getArray($principal->content) as $content)
                        <p class="text-base font-medium text-x-black text-justify">
                            {{ $content }}
                        </p>
                    @endforeach
                    <a href="{{ route('views.guest.product') }}" aria-label="products page"
                        class="block w-max bg-x-white px-4 lg:px-6 py-2 text-lg font-x-thin rounded-x-thin text-x-black hover:bg-x-acent focus-within:bg-x-acent mt-2 lg:mt-4">
                        {{ __('Explore') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if ($products->count())
        <section class="w-full relative container mx-auto p-4 flex flex-col gap-4 lg:gap-8 my-4 lg:my-10">
            <img src="{{ asset('img/svg/map.svg') }}?v={{ env('APP_VERSION') }}" alt="{{ env('APP_NAME') }} map image"
                loading="lazy" width="100%" height="auto"
                class="hidden lg:block w-full absolute left-4 right-4 top-1/2 -translate-y-1/3 z-[-1] opacity-10 pointer-events-none">
            <div class="w-full flex flex-col items-center">
                <h2 class="uppercase text-base lg:text-lg text-x-prime font-x-thin">{{ ucwords(__('Quick Pick')) }}
                </h2>
                <h3 class="uppercase font-x-huge text-x-black text-3xl lg:text-4xl">{{ ucwords(__('Latest Goods')) }}
                </h3>
            </div>
            <div id="products" class="w-full">
                <ul class="w-full h-full pb-6">
                    @foreach ($products as $product)
                        <li data-aos="slide-up" data-aos-delay="{{ $loop->index * 300 }}">
                            @include('shared.guest.card', [
                                'typ' => 'Product',
                                'txt' => $product->name,
                                'src' => $product->Images[0]->Link,
                                'alt' => $product->name . ' image',
                                'url' => route('views.guest.show', $product->slug),
                            ])
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif
    @if ($business)
        <section class="w-full container mx-auto p-4 flex flex-col lg:flex-row gap-6 lg:gap-8 my-4 lg:my-10">
            <div data-aos="fade-{{ Core::lang('ar') ? 'left' : 'right' }}"
                class="w-full lg:flex-[1] min-h-40 lg:min-h-52 relative">
                <div style="background-image: url({{ $business->Images[0]->Link }})"
                    class="block w-[calc(100%-.5rem)] sm:w-[calc(100%-.75rem)] lg:w-full h-full aspect-[16/10] me-auto lg:aspect-auto rounded-x-huge bg-no-repeat bg-cover bg-center bg-x-acent">
                    <img src="{{ $business->Images[0]->Link }}" alt="{{ env('APP_NAME') }} about us image" loading="lazy"
                        width="100%" height="100%" class="opacity-0 absolute inset-0 h-full w-full object-contain" />
                </div>
                <div data-aos="zoom-down" data-aos-delay="200"
                    class="absolute rounded-x-thin sm:rounded-x-huge shadow-x-core h-2/5 w-4 sm:w-6 lg:w-8 top-6 right-0 rtl:right-auto rtl:left-0 lg:-right-4 lg:rtl:right-auto lg:rtl:-left-4 z-[1] after:content-[''] after:absolute after:inset-0 after:w-full after:h-full after:bg-x-black after:rounded-x-huge after:bg-x-radial after:z-[-1] before:content-[''] before:absolute before:inset-0 before:w-full before:h-full before:bg-x-white before:rounded-x-huge before:z-[-1]">
                </div>
            </div>
            <div class="w-full lg:flex-[1] flex flex-col gap-5 lg:py-6">
                <h3 data-aos="fade-{{ Core::lang('ar') ? 'right' : 'left' }}" data-aos-delay="250"
                    class="uppercase font-x-huge text-x-black w-max text-3xl lg:text-4xl after:content-[''] after:block after:w-1/2 after:mt-1 after:h-1 after:rounded-full after:bg-x-prime">
                    {{ __('How Are We') }}
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (Core::getArray($business->content) as $content)
                        <p data-aos="fade-{{ Core::lang('ar') ? 'right' : 'left' }}"
                            data-aos-delay="{{ 300 + 200 * $loop->index }}"
                            class="text-base font-medium text-x-black text-justify">
                            {{ $content }}
                        </p>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if ($categories->count())
        <section class="w-full cards overflow-auto container mx-auto p-4 my-4 lg:my-10">
            <div class="w-max lg:w-full flex flex-wrap gap-4 lg:grid lg:gap-8 grid-x-{{ $categories->count() }}">
                @foreach ($categories as $category)
                    @include('shared.guest.card', [
                        'typ' => 'ProductCollection',
                        'att' =>
                            'data-aos=flip-' .
                            (Core::lang('ar') ? 'left' : 'right') .
                            ' data-aos-delay=' .
                            ($loop->index * 300 + 100),
                        'set' => 'show',
                        'txt' => $category->name,
                        'src' => $category->Image->Link,
                        'alt' => $category->name . ' image',
                        'url' => route('views.guest.product', [
                            'category' => $category->slug,
                        ]),
                    ])
                @endforeach
            </div>
        </section>
    @endif
    @if ($shipping)
        <section class="w-full relative container mx-auto p-4 flex flex-col lg:flex-row gap-6 lg:gap-8 my-4 lg:my-10">
            <img src="{{ asset('img/svg/line.svg') }}?v={{ env('APP_VERSION') }}" alt="{{ env('APP_NAME') }} line image"
                loading="lazy" width="100%" height="auto"
                class="hidden lg:block w-full absolute left-4 right-4 top-1/2 -translate-y-1/2 z-[-1] opacity-10 pointer-events-none rtl:-scale-x-100">
            <div class="w-full lg:flex-[1] flex flex-col gap-5 lg:py-6">
                <h3 data-aos="fade-{{ Core::lang('ar') ? 'left' : 'right' }}" data-aos-delay="250"
                    class="uppercase font-x-huge text-x-black text-3xl w-max lg:text-4xl after:content-[''] after:block after:w-1/2 after:mt-1 after:h-1 after:rounded-full after:bg-x-prime">
                    {{ __('Shipping') }}
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (Core::getArray($shipping->content) as $content)
                        <p data-aos="fade-{{ Core::lang('ar') ? 'left' : 'right' }}"
                            data-aos-delay="{{ 300 + 200 * $loop->index }}"
                            class="text-base font-medium text-x-black text-justify">
                            {{ $content }}
                        </p>
                    @endforeach
                </div>
                <ul class="sm:flex grid grid-rows-1 grid-cols-3 flex-wrap w-full sm:w-max gap-4 items-start mt-4">
                    <li data-aos="zoom-out-down" data-aos-delay="500"
                        class="flex flex-col gap-2 w-full sm:w-max items-center">
                        <svg class="w-8 md:w-12 h-8 md:h-12 text-x-prime pointer-events-none" fill="currentColor"
                            viewBox="0 -960 960 960">
                            <path
                                d="M620.132-154q-138.038 0-232.585-95.1T293-480.057Q293-616 387.421-711.5T619.89-807q134.201 0 229.655 95.512Q945-615.975 945-480.247q0 136.153-95.338 231.2T620.132-154Zm-.485-84q100.912 0 171.132-70.471Q861-378.941 861-480t-70.265-172.029Q720.471-723 619.706-723t-171.735 70.659Q377-581.681 377-480.353q0 100.912 70.659 171.632Q518.319-238 619.647-238ZM662-498.612 661-596q0-17.6-11.963-30.3Q637.075-639 619.5-639q-18.275 0-29.888 12.825Q578-613.35 578-596v114q0 7.565 3 16.783Q584-456 591-451l88 88q11.4 13 28.095 13 16.694 0 29.8-12.947Q750-375.895 750-392.614T737-422l-75-76.612ZM97.773-599q-19.523 0-31.148-12.446Q55-623.891 55-640.246 55-656.6 66.625-669.8T97.773-683H212q16.25 0 28.625 12.94T253-640.035q0 16.66-12.375 28.847Q228.25-599 212-599H97.773ZM57.631-439q-19.381 0-31.006-12.446Q15-463.891 15-480.246 15-496.6 26.625-509.8T57.631-523h154.49q16.529 0 28.704 12.94T253-480.035q0 16.66-12.375 28.847Q228.25-439 212.143-439H57.631Zm40.142 160q-19.523 0-31.148-12.446Q55-303.891 55-320.246 55-336.6 66.625-349.8T97.773-363H212q16.25 0 28.625 12.94T253-320.035q0 16.66-12.375 28.847Q228.25-279 212-279H97.773ZM620-480Z" />
                        </svg>
                        <h4 class="text-x-black font-x-huge text-xs md:text-base text-center">
                            {{ __('Fast Delivery') }}
                        </h4>
                    </li>
                    <li data-aos="zoom-out-down" data-aos-delay="600"
                        class="flex flex-col gap-2 w-full sm:w-max items-center">
                        <svg class="w-8 md:w-12 h-8 md:h-12 text-x-prime pointer-events-none" fill="currentColor"
                            viewBox="0 -960 960 960">
                            <path
                                d="M479.945-59q-87.053 0-164.146-32.604-77.094-32.603-134.343-89.852-57.249-57.249-89.852-134.41Q59-393.028 59-480.362q0-87.228 32.662-163.934 32.663-76.706 90.042-134.279 57.378-57.574 134.252-90.499Q392.829-902 479.836-902q87.369 0 164.498 32.848 77.129 32.849 134.41 90.303 57.281 57.454 90.269 134.523Q902-567.257 902-479.724q0 87.468-32.926 164.044-32.925 76.575-90.499 133.781-57.573 57.205-134.447 90.052Q567.255-59 479.945-59Zm.055-91q125.375 0 216.688-81.5Q788-313 805-433q0 1.818.5 3.659.5 1.841.5 1.341-12 16-28.892 24T739-396h-73q-37.188 0-62.594-25.504T578-484.333V-528H402v-79.584q0-37.254 25.504-62.835Q453.008-696 489.333-696h45.513v-22q0-20.155 15.077-47.578Q565-793 585-794q-23.992-6.818-49.875-11.409Q509.243-810 480.36-810q-136.873 0-233.616 96.556Q150-616.888 150-480q0 3 .5 5.5t.5 6.5h111q73.05 0 124.025 50.975Q437-366.05 437-293.943V-250H306v57q39 19 82.45 31T480-150Z" />
                        </svg>
                        <h4 class="text-x-black font-x-huge text-xs md:text-base text-center">
                            {{ __('Wide Coverage') }}
                        </h4>
                    </li>
                    <li data-aos="zoom-out-down" data-aos-delay="700"
                        class="flex flex-col gap-2 w-full sm:w-max items-center">
                        <svg class="w-8 md:w-12 h-8 md:h-12 text-x-prime pointer-events-none" fill="currentColor"
                            viewBox="0 -960 960 960">
                            <path
                                d="M480.159-493q-72.621 0-122.39-50.269Q308-593.537 308-666t49.609-121.731Q407.219-837 479.841-837t122.89 49.156Q653-738.688 653-665.5q0 71.963-50.109 122.231Q552.781-493 480.159-493ZM138-221v-24.987q0-41.078 22.172-74.962T220-372q62.201-27.903 127.779-44.952Q413.356-434 479.994-434q67.006 0 131.784 17.048Q676.556-399.903 739-372q37.906 15.245 60.953 50.3Q823-286.645 823-245.848V-221q0 38.15-26.894 64.575Q769.213-130 731-130H229q-37.8 0-64.4-26.425Q138-182.85 138-221Zm342-363q33 0 57-24t24-57q0-33-23.796-57.5-23.797-24.5-57-24.5Q447-747 423-722.319T399-665.5q0 33.5 24 57.5t57 24Zm166 272v91h85v-21.512q0-15.419-9-28.954Q713-285 698-293q-12-7-25-11t-27-8Zm-252-23.322V-281h176v-53q-24-5.143-46-6.571Q502-342 480-342t-43 1.525q-21 1.525-43 5.153ZM229-221h88v-96q-13.587 6.111-28.405 11.46Q273.778-300.19 262-293q-16 8-24.5 21.534-8.5 13.535-8.5 28.954V-221Zm417 0H317h329ZM480-665Z" />
                        </svg>
                        <h4 class="text-x-black font-x-huge text-xs md:text-base text-center">
                            {!! __('150+ Couriers') !!}
                        </h4>
                    </li>
                </ul>
            </div>
            <div data-aos="fade-{{ Core::lang('ar') ? 'right' : 'left' }}"
                class="w-full lg:flex-[1] relative min-h-40 lg:min-h-52 order-[-1] lg:order-[0]">
                <div style="background-image: url({{ $shipping->Images[0]->Link }})"
                    class="block w-[calc(100%-.5rem)] sm:w-[calc(100%-.75rem)] lg:w-full h-full aspect-[16/10] ms-auto lg:aspect-auto rounded-x-huge bg-no-repeat bg-cover bg-center bg-x-acent">
                    <img src="{{ $shipping->Images[0]->Link }}" alt="{{ env('APP_NAME') }} shipping image"
                        width="100%" height="100%" loading="lazy"
                        class="opacity-0 absolute inset-0 h-full w-full object-contain" />
                </div>
                <div data-aos="zoom-down" data-aos-delay="200"
                    class="absolute rounded-x-thin sm:rounded-x-huge shadow-x-core h-2/5 w-4 sm:w-6 lg:w-8 bottom-6 left-0 rtl:left-auto rtl:right-0 lg:-left-4 lg:rtl:left-auto lg:rtl:-right-4 z-[1] after:content-[''] after:absolute after:inset-0 after:w-full after:h-full after:bg-x-black after:rounded-x-huge after:bg-x-radial after:z-[-1] before:content-[''] before:absolute before:inset-0 before:w-full before:h-full before:bg-x-white before:rounded-x-huge before:z-[-1]">
                </div>
            </div>
        </section>
    @endif
    <section class="w-full container mx-auto p-4 flex flex-col lg:flex-row lg:flex-wrap relative my-4">
        <div
            class="flex flex-col gap-4 px-2 lg:px-0 -mb-16 lg:mb-0 lg:w-[42%] lg:absolute lg:right-4 rtl:lg:right-auto rtl:lg:left-4 lg:top-1/2 lg:-translate-y-1/2 z-[1]">
            <form data-aos="zoom-out-up" data-aos-delay="50" action="{{ route('actions.guest.contact') }}"
                method="POST" class="flex flex-col bg-x-white gap-4 lg:gap-6 p-6 lg:p-8 rounded-x-huge shadow-x-core">
                <h3 class="uppercase font-x-huge text-x-black text-3xl lg:text-4xl">
                    {{ __('Contact Us') }}
                </h3>
                @csrf
                <os-text label="{{ __('Name') }}" name="name" value="{{ old('name') }}"></os-text>
                <os-text type="email" label="{{ __('Email') }}" name="email"
                    value="{{ old('email') }}"></os-text>
                <os-text type="tel" label="{{ __('Phone') }}" name="phone"
                    value="{{ old('phone') }}"></os-text>
                <os-area rows="2" label="{{ __('Message') }}" name="message"
                    value="{{ old('message') }}"></os-area>
                <os-button
                    class="w-full rounded-x-huge px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-gradient-to-br rtl:bg-gradient-to-bl bg-x-core focus-within:outline-none">
                    {{ __('Send Message') }}
                </os-button>
            </form>
        </div>
        <div data-aos="fade-{{ Core::lang('ar') ? 'left' : 'right' }}"
            class="bg-x-acent w-full lg:w-[70%] aspect-[12/9] md:aspect-[16/13] lg:aspect-[16/11] overflow-hidden rounded-x-huge lg:me-auto relative">
            <iframe title="italmenara-address-map"
                class="w-[150%] h-[150%] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                src="https://www.google.com/maps/embed/v1/place?q={{ env('MAP_ADDRESS_LINK') }}&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                loading="lazy"></iframe>
        </div>
    </section>
@endsection


@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 0,
        });
        HomeInitializer({
            ImageCount: {{ $principal->Images->count() }},
            ProductCount: {{ $products->count() }},
        })
    </script>
@endsection
