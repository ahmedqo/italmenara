@extends('shared.core.base')
@section('title', __('New Quotation'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Quotation') }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.quotations.store') }}" method="POST" class="w-full flex flex-col gap-6">
                @csrf
                <div class="w-full flex flex-col gap-4">
                    <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                        <os-text label="{{ __('Name') }}" name="name"
                            value="{{ $data ? $data->name : old('name') }}"></os-text>
                        <os-text type="email" label="{{ __('Email') }}" name="email"
                            value="{{ $data ? $data->email : old('email') }}"></os-text>
                        <os-text type="tel" label="{{ __('Phone') }}" name="phone"
                            value="{{ $data ? $data->phone : old('phone') }}"></os-text>
                    </div>
                    <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                        <os-text label="{{ __('Reference') }}" name="reference" value="{{ old('reference') }}"></os-text>
                        <os-text type="number" label="{{ __('Charges') }}" name="charges"
                            value="{{ old('charges') }}"></os-text>
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
                        value="{{ old('note_en') }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (it)" name="note_it"
                        value="{{ old('note_it') }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (fr)" name="note_fr"
                        value="{{ old('note_fr') }}"></os-area>
                    <os-area rows="2" label="{{ __('Note') }} (ar)" name="note_ar"
                        value="{{ old('note_ar') }}"></os-area>
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
            $data
                ? $data->Items->map(function ($Item) {
                    return [
                        'id' => $Item->id,
                        'name' => $Item->Product->name,
                        'quantity' => $Item->quantity,
                        'sku' => $Item->Product->sku,
                        'product' => $Item->product,
                        'price' => $Item->price,
                        'type' => 'default',
                    ];
                })
                : [],
        ) !!});
    </script>
@endsection
