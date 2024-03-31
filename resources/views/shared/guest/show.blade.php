<div class="w-full p-4 container mx-auto">
    <div class="bg-x-radial w-full rounded-x-huge overflow-hidden">
        <div style="text-shadow: 0px 3px 12px #1d1d1d50, #1d1d1d25 0px 25px 20px; background-image: url({{ asset($src) }}?v={{ env('APP_VERSION') }})"
            class="w-full min-h-[8rem] aspect-[4/1] flex items-center justify-center text-x-white font-x-huge text-2xl lg:text-6xl p-4 bg-cover bg-no-repeat relative z-[0] bg-center isolate before:content-[''] before:absolute before:inset-0 before:w-full before:h-full before:bg-x-black before:bg-opacity-25 overflow-hidden before:z-[-1]">
            <h1>{{ ucwords($txt) }}</h1>
        </div>
    </div>
</div>
