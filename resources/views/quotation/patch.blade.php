@extends('shared.core.base')
@section('title', __('Edit Quotation') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <div class="flex flex-col items-center lg:flex-row lg:justify-between gap-2">
            <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
                {{ __('Edit Quotation') . ' #' . $data->id }}
            </h1>
            <div class="w-max flex gap-2">
                <a title="{{ __('Create Invoice') }}" href="{{ route('views.invoices.store', ['quotation' => $data->id]) }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="m434-259 234-235-43-44-190 190-104-104-45 45 148 148ZM229-59q-36.05 0-63.525-26.975T138-150v-660q0-37.463 27.475-64.731Q192.95-902 229-902h364l230 228v524q0 37.05-27.769 64.025Q767.463-59 731-59H229Zm316-569h186L545-810v182Z" />
                    </svg>
                </a>
                <a title="{{ __('Print Quotation') }}"
                    href="{{ route('views.quotations.scene', ['id' => $data->id, 'print' => 'true']) }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                    </svg>
                </a>
                <a title="{{ __('Mail Quotation') }}"
                    href="{{ route('actions.core.mail', ['type' => 'quotation', 'id' => $data->id]) }}"
                    class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path d="M100-139v-246l333-95-333-97v-245l807 342-807 341Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.quotations.patch', $data->id) }}" method="POST"
                class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full flex flex-col gap-4">
                    <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                        <os-text label="{{ __('Name') }}" name="name" value="{{ $data->name }}"></os-text>
                        <os-text type="email" label="{{ __('Email') }}" name="email"
                            value="{{ $data->email }}"></os-text>
                        <os-text type="tel" label="{{ __('Phone') }}" name="phone"
                            value="{{ $data->phone }}"></os-text>
                    </div>
                    <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                        <os-text label="{{ __('Reference') }}" name="reference" value="{{ $data->reference }}"></os-text>
                        <os-text type="number" label="{{ __('Charges') }}" name="charges"
                            value="{{ $data->charges }}"></os-text>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-4">
                    <os-fillable set-query="{{ 'name_' . Core::lang() }}" label="{{ __('Product') }}"></os-fillable>
                    <div class="w-full x-scroll border border-x-black rounded-x-thin">
                        <table class="min-w-full">
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
                                    <td
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="showcase"></tbody>
                            <tbody id="finances">
                                <tr class="border-t border-x-black">
                                    <td colspan="5"
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center first:ps-8 last:pe-8">
                                        {{ __('Sub Total') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="subtotal"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        0
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="border-t border-x-black">
                                    <td colspan="5"
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center first:ps-8 last:pe-8">
                                        {{ __('Charges') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="charges"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        0
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="border-t border-x-black">
                                    <td colspan="5"
                                        class="text-x-black text-sm font-bold px-4 py-2 text-center first:ps-8 last:pe-8">
                                        {{ __('Total') }} ({{ Core::getSetting('currency') }})
                                    </td>
                                    <td data-for="total"
                                        class="text-x-black text-base font-bold px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                                        0
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                    <os-area rows="2" label="{{ __('Note') }} (en)" name="note_en"
                        value="{{ $data->note_en }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (it)" name="note_it"
                        value="{{ $data->note_it }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (fr)" name="note_fr"
                        value="{{ $data->note_fr }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (ar)" name="note_ar"
                        value="{{ $data->note_ar }}"></os-area>
                </div>
                <div class="w-full flex lg:col-span-2">
                    <os-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto rounded-x-thin px-4 py-2 text-base lg:text-lg font-x-huge text-x-white">
                        <span>{{ __('Save') }}</span>
                    </os-button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        FinanceInitializer({
            showcase: document.querySelector("#showcase"),
            finances: document.querySelector("#finances"),
            charges: document.querySelector("[name=charges]"),
            fillable: {
                Fillable: document.querySelector("os-fillable"),
                Link: "{{ route('actions.products.search') }}"
            }
        }, {!! json_encode(
            $data->Items->map(function ($Item) {
                return [
                    'id' => $Item->id,
                    'name' => $Item->Product->name,
                    'quantity' => $Item->quantity,
                    'sku' => $Item->Product->sku,
                    'product' => $Item->product,
                    'price' => $Item->price,
                    'type' => 'default',
                ];
            }),
        ) !!});
    </script>
@endsection
