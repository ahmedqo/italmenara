<div tab class="flex flex-col">
    <button
        class="flex flex-wrap items-start w-full gap-2 outline-none underline-offset-4 hover:underline focus:underline">
        <svg class="pointer-events-none w-6 h-6 text-x-prime block" fill="currentColor" viewBox="0 96 960 960">
            <title>arrow icon</title>
            @if (Core::lang('ar'))
                <path
                    d="M528 805 331 607q-7-6-10.5-14t-3.5-18q0-9 3.5-17.5T331 543l198-199q13-12 32-12t33 12q13 13 12.5 33T593 410L428 575l166 166q13 13 13 32t-13 32q-14 13-33.5 13T528 805Z" />
            @else
                <path
                    d="M344 805q-14-15-14-33.5t14-31.5l164-165-165-166q-14-12-13.5-32t14.5-33q13-14 31.5-13.5T407 344l199 199q6 6 10 14.5t4 17.5q0 10-4 18t-10 14L408 805q-13 13-32 12.5T344 805Z" />
            @endif
        </svg>
        <h3 class="text-start flex-1 font-x-thin text-x-black text-base">
            {{ $ttl }}
        </h3>
    </button>
    <div>
        <div class="text-base p-4 ps-8 text-x-black text-opacity-80 flex flex-col gap-2">
            @if (is_array($txt))
                @foreach ($txt as $itm)
                    <p>
                        {!! $itm !!}
                    </p>
                @endforeach
            @else
                <p>
                    {!! $txt !!}
                </p>
            @endif
        </div>
    </div>
</div>
