@extends('shared.core.base')
@section('title', __('Dashboard'))

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Statistics') }}
            </h1>
            <ul class="grid grid-rows-1 grid-cols-1 lg:flex gap-4">
                <li class="lg:flex-[1] bg-x-white rounded-x-huge shadow-x-core p-4 flex gap-2 flex-col items-center">
                    <svg class="block w-12 h-12 lg:w-16 lg:h-16 pointer-events-none" style="color: var(--color-5);"
                        fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M227-38q-58.917 0-97.958-39.75Q90-117.5 90-175v-100q0-19.65 13.312-32.825Q116.625-321 136-321h93v-546q0-8.5 6.5-11.25t12.794 3.544L277-846q5.455 7 16.227 6.5Q304-840 310-847l32-31q4.818-5 15.909-5Q369-883 374-878l30 31q4.818 7 15.955 7 11.136 0 17.045-7l32-31q4.273-5 15.409-5 11.136 0 17.591 5l30 31q5.727 7 16.864 7Q560-840 565-847l32-31q3.636-5 15.136-5T630-878l30 31q5.455 7 16.227 7Q687-840 693-847l31-31q4.545-5 16.045-5 11.5 0 16.955 5l31 31q4.818 7 15.955 7.5 11.136.5 17.045-6.5l30-29q5.118-6 12.559-3.042Q871-875.083 871-867v692q0 57.5-40.042 97.25Q790.917-38 734-38H227Zm505.5-92q18.5 0 31-12.885T776-174.6V-775H323v504h324q18.8 0 32.4 13.175Q693-244.65 693-225v50q0 19 10 32t29.5 13ZM405-674h162q11.8 0 20.4 8.456 8.6 8.456 8.6 20.316t-8.6 20.044Q578.8-617 567-617H405q-11.375 0-19.688-8.439-8.312-8.438-8.312-20 0-11.561 8.312-20.061Q393.625-674 405-674Zm0 132h162q11.8 0 20.4 8.375 8.6 8.376 8.6 20.116 0 11.741-8.6 20.125T567-485H405q-11.375 0-19.688-8.56-8.312-8.559-8.312-20.3 0-11.74 8.312-19.94Q393.625-542 405-542Zm284.421-75Q678-617 669.5-625.763t-8.5-19.5Q661-656 669.281-665q8.28-9 20-9 11.719 0 20.219 8.781 8.5 8.78 8.5 19.815 0 11.036-8.579 19.72t-20 8.684Zm0 127Q678-490 669.5-498.884t-8.5-19.8q0-10.916 8.281-19.616 8.28-8.7 20-8.7 11.719 0 20.219 8.7 8.5 8.7 8.5 19.616t-8.579 19.8q-8.579 8.884-20 8.884Z" />
                    </svg>
                    <div class="my-auto flex m-auto flex-col items-center">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">
                            {{ __('Requests') }}
                            <span class="text-base lg:text-lg text-center text-gray-800">
                                ({{ $requests }})
                            </span>
                        </h2>
                        <p class="text-base lg:text-lg text-center text-gray-800">
                            {{ Core::formatNumber($total[0]) }} {{ Core::getSetting('currency') }}
                        </p>
                    </div>
                </li>
                <li class="lg:flex-[1] bg-x-white rounded-x-huge shadow-x-core p-4 flex gap-2 flex-col items-center">
                    <svg class="block w-12 h-12 lg:w-16 lg:h-16 pointer-events-none" style="color: var(--color-6);"
                        fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M445-243v17q0 9.8 7.6 16.4 7.6 6.6 16.4 6.6h23.833q9.567 0 15.867-7.2 6.3-7.2 6.3-16.8v-16h55q16.275 0 25.638-9.075Q605-261.15 605-276.752V-412q0-15.425-9.362-25.212Q586.275-447 569.752-447H425v-65h146q14.45 0 24.225-9.967 9.775-9.966 9.775-24.7 0-14.308-9.775-24.32Q585.45-581 571-581h-56v-17q0-8.8-7-15.9t-16-7.1h-23.833q-9.367 0-16.267 7.1-6.9 7.1-6.9 15.9v17h-55q-16.275 0-25.638 9.5Q355-562 355-547v135.248q0 16.027 9.362 25.39Q373.725-377 390.248-377H535v65H389q-14.45 0-24.225 9.805-9.775 9.806-9.775 24.3 0 15.345 10.062 25.12Q375.125-243 390-243h55ZM229-59q-35.775 0-63.388-26.912Q138-112.825 138-150v-660q0-37.588 27.612-64.794Q193.225-902 229-902h347l247 246v506q0 37.175-27.906 64.088Q767.188-59 731-59H229Zm325-751v130q0 20.75 13.325 33.375T600-634h131L554-810Z" />
                    </svg>
                    <div class="my-auto flex m-auto flex-col items-center">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">
                            {{ __('Quotations') }}
                            <span class="text-base lg:text-lg text-center text-gray-800">
                                ({{ $quotations }})
                            </span>
                        </h2>
                        <p class="text-base lg:text-lg text-center text-gray-800">
                            {{ Core::formatNumber($total[1]) }} {{ Core::getSetting('currency') }}
                        </p>
                    </div>
                </li>
                <li class="lg:flex-[1] bg-x-white rounded-x-huge shadow-x-core p-4 flex gap-2 flex-col items-center">
                    <svg class="block w-12 h-12 lg:w-16 lg:h-16 pointer-events-none" style="color: var(--color-7);"
                        fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="m434-259 234-235-43-44-190 190-104-104-45 45 148 148ZM229-59q-36.05 0-63.525-26.975T138-150v-660q0-37.463 27.475-64.731Q192.95-902 229-902h364l230 228v524q0 37.05-27.769 64.025Q767.463-59 731-59H229Zm316-569h186L545-810v182Z" />
                    </svg>
                    <div class="my-auto flex m-auto flex-col items-center">
                        <h2 class="text-sm lg:text-base text-x-black font-x-thin">
                            {{ __('Invoices') }}
                            <span class="text-base lg:text-lg text-center text-gray-800">
                                ({{ $invoices }})
                            </span>
                        </h2>
                        <p class="text-base lg:text-lg text-center text-gray-800">
                            {{ Core::formatNumber($total[2]) }} {{ Core::getSetting('currency') }}
                        </p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
                <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                    {{ __('Income Visualization') }}
                </h1>
                <div class="w-max flex gap-2">
                    <button id="printer" title="{{ __('Print') }}"
                        class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                        </svg>
                    </button>
                    <a id="downloader" title="{{ __('Download') }}" download
                        class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M253-138q-95 0-163.5-67.5T21-370q0-82 51-148t132-79q23-90 89-150t154-72v372l-78-80-49 49 161 163 161-163-48-49-78 80v-372q103 13 174 91t77 187v24q75 8 123.5 60.5T939-327q0 79-55 134t-134 55H253Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="bg-x-white rounded-x-huge shadow-x-core p-4 overflow-hidden aspect-video relative">
                <canvas id="chart" class="w-full"></canvas>
                <div class="bg-x-white w-full h-full absolute inset-0 flex items-center justify-center">
                    <svg id="loader" stroke="currentColor" viewBox="0 0 24 24">
                        <g>
                            <circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3"></circle>
                        </g>
                    </svg>
                </div>
                <os-printable>
                    @include('shared.page.print')
                    <h1 id="chart-title">{{ __('Income Visualization') }}</h1>
                    <img id="chart-viewer">
                </os-printable>
            </div>
        </div>
        <os-data-visualizer print download filter id="sellers" title="{{ __('Best Sellers') }}">
            @include('shared.page.print')
        </os-data-visualizer>

        <os-data-visualizer print download filter id="visitors" title="{{ __('Popular Products') }}">
            @include('shared.page.print')
        </os-data-visualizer>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const visitorsVisualizer = document.querySelector("#visitors");
        const sellersVisualizer = document.querySelector("#sellers");
        const chartVisualizer = document.getElementById("chart");

        ChartVisualizer(chartVisualizer, {
            Link: "{{ route('actions.core.charts') }}",
            Currency: "{{ Core::getSetting('currency') }}"
        });

        TableVisualizer(visitorsVisualizer, 'visitors', {
            Currency: "{{ Core::getSetting('currency') }}",
            Search: "{{ route('actions.core.visitors') }}",
        });

        TableVisualizer(sellersVisualizer, 'sellers', {
            Currency: "{{ Core::getSetting('currency') }}",
            Search: "{{ route('actions.core.sellers') }}",
        });
    </script>
@endsection
