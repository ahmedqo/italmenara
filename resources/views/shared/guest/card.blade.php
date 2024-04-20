@php
    $set = $set ?? 'box';
@endphp

@if ($set === 'box')
    <div itemscope itemtype="https://schema.org/{{ $typ }}"
        class="w-full flex flex-col {{ $typ === 'Product' ? 'hproduct' : 'hproductcollection' }}">
        <a itemprop="url" href="{{ $url }}" aria-label="{{ $alt }}"
            class="url relative group overflow-hidden aspect-[12/9] rounded-x-huge flex items-center justify-center outline-none">
            <img itemprop="image" src="{{ $src }}" alt="{{ $alt }}" loading="lazy" width="100%"
                height="100%"
                class="photo bg-x-acent block w-full h-full {{ isset($fit) ? 'object-contain' : 'object-cover' }} transition-transform group-hover:scale-150 group-focus:scale-150" />
            <div
                class="bg-x-black bg-opacity-25 text-x-white opacity-0 group-hover:opacity-100 group-focus:opacity-100 pointer-events-none transition-opacity w-full h-full absolute inset-0 flex items-center justify-center backdrop-blur-sm">
                <svg fill="currentcolor" viewBox="0 -960 960 960"
                    class="block w-12 h-12 lg:w-20 lg:h-20 pointer-events-none">
                    <title>view icon</title>
                    <path
                        d="M480.294-333Q550-333 598.5-381.794t48.5-118.5Q647-570 598.206-618.5t-118.5-48.5Q410-667 361.5-618.206t-48.5 118.5Q313-430 361.794-381.5t118.5 48.5Zm-.412-71q-39.465 0-67.674-28.326Q384-460.652 384-500.118q0-39.465 28.326-67.674Q440.652-596 480.118-596q39.465 0 67.674 28.326Q576-539.348 576-499.882q0 39.465-28.326 67.674Q519.348-404 479.882-404ZM480-180q-143.61 0-260.805-79T37.145-467.077q-3.945-5.987-6.045-14.901-2.1-8.915-2.1-17.824 0-8.909 2.1-18.178 2.1-9.27 6.045-16.943 64.834-126.779 182.04-205.928Q336.39-820 480-820t260.815 79.149q117.206 79.149 182.04 205.928 3.945 7.673 6.045 16.588 2.1 8.914 2.1 17.823t-2.1 18.179q-2.1 9.269-6.045 15.256Q858-338 740.805-259 623.61-180 480-180Z">
                    </path>
                </svg>
            </div>
        </a>
        <div class="px-2 lg:px-4 -mt-6 z-[1]">
            <div class="shadow-x-core p-4 rounded-x-huge bg-x-white">
                <h3 itemprop="name"
                    class="fn text-x-black text-sm lg:text-base font-x-huge text-center truncate-x-core">
                    {{ ucwords($txt) }}
                </h3>
            </div>
        </div>
        @if ($typ === 'Product')
            <div class="hidden">
                <span itemprop="description" class="description">Discover a world of sophistication and style with
                    ITALMENARA's
                    product.</span>
                <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <meta class="availability" itemprop="availability" content="http://schema.org/InStock">
                    <meta itemprop="priceValidUntil" content="{{ now()->format('Y-m-d') }}">
                    <meta class="currency" itemprop="priceCurrency" content="EUR">
                    <meta class="price" itemprop="price" content="1000">
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
                        <span itemprop="value">1000</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif

@if ($set === 'show')
    <a itemscope itemtype="https://schema.org/{{ $typ }}" itemprop="url" href="{{ $url }}"
        aria-label="{{ $alt }}" {{ isset($att) ? $att : '' }}
        class="hcategory url relative h-40 aspect-[16/12] lg:w-full lg:h-full group overflow-hidden rounded-x-huge flex items-center justify-center outline-none">
        <img itemprop="image" src="{{ $src }}" alt="{{ $alt }}" loading="lazy" width="100%"
            height="100%"
            class="photo bg-x-acent block w-full h-full object-cover transition-transform group-hover:scale-150 group-focus:scale-150" />
        <div
            class="from-x-black to-transparent bg-gradient-to-t lg:bg-x-black lg:from-transparent lg:bg-opacity-25 text-x-white lg:opacity-0 lg:group-hover:opacity-100 lg:group-focus:opacity-100 pointer-events-none lg:transition-opacity w-full h-full absolute inset-0 flex items-end lg:items-center justify-center p-4 lg:backdrop-blur-sm">
            <h2 itemprop="name" class="category text-lg lg:text-2xl font-x-huge text-center">
                {{ ucwords($txt) }}
            </h2>
        </div>
    </a>
@endif
