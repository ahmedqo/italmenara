@extends('shared.core.base')
@section('title', __('Request') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Request') . ' #' . $data->id }}
            </h1>
            <div class="w-max flex gap-2">
                <a title="{{ __('Create Quotation') }}" href="{{ route('views.quotations.store', ['request' => $data->id]) }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M445-243v17q0 9.8 7.6 16.4 7.6 6.6 16.4 6.6h23.833q9.567 0 15.867-7.2 6.3-7.2 6.3-16.8v-16h55q16.275 0 25.638-9.075Q605-261.15 605-276.752V-412q0-15.425-9.362-25.212Q586.275-447 569.752-447H425v-65h146q14.45 0 24.225-9.967 9.775-9.966 9.775-24.7 0-14.308-9.775-24.32Q585.45-581 571-581h-56v-17q0-8.8-7-15.9t-16-7.1h-23.833q-9.367 0-16.267 7.1-6.9 7.1-6.9 15.9v17h-55q-16.275 0-25.638 9.5Q355-562 355-547v135.248q0 16.027 9.362 25.39Q373.725-377 390.248-377H535v65H389q-14.45 0-24.225 9.805-9.775 9.806-9.775 24.3 0 15.345 10.062 25.12Q375.125-243 390-243h55ZM229-59q-35.775 0-63.388-26.912Q138-112.825 138-150v-660q0-37.588 27.612-64.794Q193.225-902 229-902h347l247 246v506q0 37.175-27.906 64.088Q767.188-59 731-59H229Zm325-751v130q0 20.75 13.325 33.375T600-634h131L554-810Z" />
                    </svg>
                </a>
                <a title="{{ __('Create Invoice') }}" href="{{ route('views.invoices.store', ['request' => $data->id]) }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="m434-259 234-235-43-44-190 190-104-104-45 45 148 148ZM229-59q-36.05 0-63.525-26.975T138-150v-660q0-37.463 27.475-64.731Q192.95-902 229-902h364l230 228v524q0 37.05-27.769 64.025Q767.463-59 731-59H229Zm316-569h186L545-810v182Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <div class="flex flex-col gap-6">
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <os-text label="{{ __('Customer') }}" value="{{ ucwords($data->name) }}" disabled></os-text>
                    <os-text label="{{ __('Email') }}" value="{{ $data->email }}" disabled></os-text>
                    <os-text label="{{ __('Phone') }}" value="{{ $data->phone }}" disabled></os-text>
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
                                    {{ __('Total') }} ({{ Core::getSetting('currency') }})
                                </td>
                                <td data-for="subtotal"
                                    class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] last:pe-8">
                                    {{ Core::formatNumber($data->total) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($data->message)
                    <os-area label="{{ __('Message') }}" value="{{ $data->message }}" disabled></os-area>
                @endif
            </div>
        </div>
    </div>
@endsection
