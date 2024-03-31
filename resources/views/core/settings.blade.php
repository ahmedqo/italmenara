@extends('shared.core.base')
@section('title', __('Edit Settings'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Settings') }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.core.settings') }}" method="POST" class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text label="{{ __('Currency') }}" name="currency"
                        value="{{ Core::getSetting('currency') ?? old('currency') }}"></os-text>
                    <os-select label="{{ __('Period') }}" name="period">
                        @foreach (Core::periodList() as $period)
                            <os-option value="{{ $period }}"
                                {{ $period == (Core::getSetting('period') ?? old('period')) ? 'selected' : '' }}>
                                {{ __(ucwords(__($period))) }}
                            </os-option>
                        @endforeach
                    </os-select>
                    <os-text class="lg:col-span-2" type="email" label="{{ __('Contact Email') }}" name="contact_email"
                        value="{{ Core::getSetting('contact_email') ?? old('contact_email') }}"></os-text>
                    <os-switch name="auto_quotation" value="true"
                        {{ Core::getSetting('auto_quotation') ?? old('auto_quotation') ? 'checked' : '' }}>
                        {{ __('Auto Mail Quotation') }}
                    </os-switch>
                    <os-switch name="auto_invoice" value="true"
                        {{ Core::getSetting('auto_invoice') ?? old('auto_invoice') ? 'checked' : '' }}>
                        {{ __('Auto Mail Invoice') }}
                    </os-switch>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text type="email" label="{{ __('Print Email') }}" name="print_email"
                        value="{{ Core::getSetting('print_email') ?? old('print_email') }}"></os-text>
                    <os-text type="tel" label="{{ __('Print Phone') }}" name="print_phone"
                        value="{{ Core::getSetting('print_phone') ?? old('print_phone') }}"></os-text>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text type="url" label="{{ __('Instagram') }}" name="instagram"
                        value="{{ Core::getSetting('instagram') ?? old('instagram') }}"></os-text>
                    <os-text type="url" label="{{ __('Telegram') }}" name="telegram"
                        value="{{ Core::getSetting('telegram') ?? old('telegram') }}"></os-text>
                    <os-text type="url" label="{{ __('Facebook') }}" name="facebook"
                        value="{{ Core::getSetting('facebook') ?? old('facebook') }}"></os-text>
                    <os-text type="url" label="{{ __('Youtube') }}" name="youtube"
                        value="{{ Core::getSetting('youtube') ?? old('youtube') }}"></os-text>
                    <os-text type="url" label="{{ __('Tiktok') }}" name="tiktok"
                        value="{{ Core::getSetting('tiktok') ?? old('tiktok') }}"></os-text>
                    <os-text type="url" label="{{ __('X') }}" name="x"
                        value="{{ Core::getSetting('x') ?? old('x') }}"></os-text>
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
