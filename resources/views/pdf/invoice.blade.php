@extends('shared.guest.base')
@section('title', __('Invoice'))

@section('content')
    <div class="w-full relative">
        <section class="container mx-auto p-4 w-full flex flex-col gap-2 my-4 lg:my-10">
            <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
                <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                    {{ __('Invoice') }}
                </h1>
                <div class="w-max flex gap-2">
                    <button id="printer" title="{{ __('Print') }}"
                        class="block p-2 rounded-x-thin text-x-black lg:text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
                <div class="flex flex-col gap-6">
                    <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                        <os-text label="{{ __('Reference') }}" value="{{ $data->reference }}" disabled></os-text>
                        <os-text label="{{ __('Customer') }}" value="{{ ucwords($data->name) }}" disabled></os-text>
                        <os-text label="{{ __('Type') }}" value="{{ __(ucwords($data->type)) }}" disabled></os-text>
                        <os-text label="{{ __('Date') }}" value="{{ $data->created_at->format('Y-m-d') }}"
                            disabled></os-text>
                    </div>
                    <div class="w-full border border-x-black rounded-x-thin x-scroll">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        {{ __('No') }}
                                    </td>
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        {{ __('Sku') }}
                                    </td>
                                    <td class="text-x-black text-sm font-bold px-4 py-2 first:ps-8 last:pe-8">
                                        {{ __('Name') }}
                                    </td>
                                    <td class="text-x-black text-sm font-bold px-4 py-2 first:ps-8 last:pe-8">
                                        {{ __('Unit') }}
                                    </td>
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        {{ __('Quantity') }}
                                    </td>
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        {{ __('Unit Price') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        {{ __('Lot Price') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->Items as $Item)
                                    <tr class="border-t border-x-black">
                                        <td
                                            class="text-x-black text-base font-medium px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                            #{{ $loop->index + 1 }}
                                        </td>
                                        <td
                                            class="text-x-black text-base px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                            {{ $Item->Product->sku }}
                                        </td>
                                        <td class="text-x-black text-base px-4 py-2 first:ps-8 last:pe-8">
                                            {{ ucwords($Item->Product->name) }}
                                        </td>
                                        <td class="text-x-black text-base px-4 py-2 first:ps-8 last:pe-8">
                                            {{ __(ucwords($Item->Product->unit)) }}
                                        </td>
                                        <td
                                            class="text-x-black text-base font-medium px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                            {{ $Item->quantity }}
                                        </td>
                                        <td
                                            class="text-x-black text-base font-medium px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                            {{ Core::formatNumber($Item->price) }}
                                        </td>
                                        <td
                                            class="text-x-black text-base font-medium  px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                            {{ Core::formatNumber($Item->total) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody>
                                <tr class="border-t border-x-black">
                                    <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                        {{ __('Sub Total') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="subtotal"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                        {{ Core::formatNumber($data->total) }}
                                    </td>
                                </tr>
                                <tr class="border-t border-x-black">
                                    <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                        {{ __('Charges') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="charges"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                        {{ Core::formatNumber($data->total * ($data->charges / 100)) }}
                                    </td>
                                </tr>
                                <tr class="border-t border-x-black">
                                    <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                        {{ __('Total') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="total"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                        {{ Core::formatNumber($data->total + $data->total * ($data->charges / 100)) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if ($data->note)
                        <os-area label="{{ __('Note') }}" value="{{ $data->note }}" disabled></os-area>
                    @endif
                </div>
            </div>
        </section>
        <os-printable>
            <style slot="styles" scoped>
                @import url({{ asset('css/index.min.css') }}?v={{ env('APP_VERSION') }});
                @import url({{ asset('css/app.min.css') }}?v={{ env('APP_VERSION') }});
                @import url({{ asset('css/print.min.css') }}?v={{ env('APP_VERSION') }});
            </style>
            <img id="image-bg" src="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}" />
            @include('shared.page.head', [
                'core' => true,
                'ref' => $data->reference,
                'name' => ucwords($data->name),
                'date' => $data->created_at->format('Y-m-d'),
            ])
            <div class="flex flex-col gap-4">
                <h1 class="text-center text-2xl text-x-black font-x-thin mb-4">
                    {{ __('Invoice') }} ({{ __(ucwords(__($data->type))) }})
                </h1>
                <div class="w-full border border-x-black rounded-x-thin">
                    <table id="table" class="w-full">
                        <thead>
                            <tr>
                                <td
                                    class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                    {{ __('No') }}
                                </td>
                                <td
                                    class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                    {{ __('Sku') }}
                                </td>
                                <td class="text-x-black text-sm font-bold px-4 py-2 first:ps-8 last:pe-8">
                                    {{ __('Name') }}
                                </td>
                                <td class="text-x-black text-sm font-bold px-4 py-2 first:ps-8 last:pe-8">
                                    {{ __('Unit') }}
                                </td>
                                <td
                                    class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                    {{ __('Quantity') }}
                                </td>
                                <td
                                    class="text-x-black text-sm font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                    {{ __('Unit Price') }} ({{ Core::getSetting('currency') }})
                                </td>
                                <td
                                    class="text-x-black text-sm font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                    {{ __('Lot Price') }} ({{ Core::getSetting('currency') }})
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->Items as $Item)
                                <tr class="border-t border-x-black">
                                    <td
                                        class="text-x-black text-base font-medium px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        #{{ $loop->index + 1 }}
                                    </td>
                                    <td class="text-x-black text-base px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        {{ $Item->Product->sku }}
                                    </td>
                                    <td class="text-x-black text-base px-4 py-2 first:ps-8 last:pe-8">
                                        {{ ucwords($Item->Product->name) }}
                                    </td>
                                    <td class="text-x-black text-base px-4 py-2 first:ps-8 last:pe-8">
                                        {{ __(ucwords($Item->Product->unit)) }}
                                    </td>
                                    <td
                                        class="text-x-black text-base font-medium px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                        {{ $Item->quantity }}
                                    </td>
                                    <td
                                        class="text-x-black text-base font-medium px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        {{ Core::formatNumber($Item->price) }}
                                    </td>
                                    <td
                                        class="text-x-black text-base font-medium  px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        {{ Core::formatNumber($Item->total) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                            <tr class="border-t border-x-black">
                                <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                    {{ __('Sub Total') }} ({{ Core::getSetting('currency') }})
                                </td>
                                <td data-for="subtotal"
                                    class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                    {{ Core::formatNumber($data->total) }}
                                </td>
                            </tr>
                            <tr class="border-t border-x-black">
                                <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                    {{ __('Charges') }} ({{ Core::getSetting('currency') }})
                                </td>
                                <td data-for="charges"
                                    class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                    {{ Core::formatNumber($data->total * ($data->charges / 100)) }}
                                </td>
                            </tr>
                            <tr class="border-t border-x-black">
                                <td colspan="6" class="text-x-black text-sm font-bold px-4 py-2 text-center">
                                    {{ __('Total') }} ({{ Core::getSetting('currency') }})
                                </td>
                                <td data-for="total"
                                    class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                    {{ Core::formatNumber($data->total + $data->total * ($data->charges / 100)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($data->note)
                    <div>
                        <h6 class="text-x-black text-sm font-bold">{{ __('Note') }}:</h6>
                        <p class="text-base text-x-black">{{ $data->note }}</p>
                    </div>
                @endif
            </div>
            @include('shared.page.foot')
        </os-printable>
    </div>
@endsection

@section('scripts')
    <script>
        const Printable = document.querySelector("os-printable"),
            Printer = document.querySelector("#printer");

        Printer.addEventListener("click", e => {
            Printable.print();
        });
    </script>
@endsection
