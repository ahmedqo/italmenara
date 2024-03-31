@extends('shared.core.base')
@section('title', __('Edit Shipping'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Shipping') }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.sections.shipping') }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="lg:col-span-2">
                        <os-image-transfer name="image" class="lg:w-1/4 lg:mx-auto"></os-image-transfer>
                    </div>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                    <os-area rows="2" label="{{ __('Content') }} (en)" name="content_en"
                        value="{{ $data->content_en ?? old('content_en') }}"></os-area>
                    <os-area rows="2" label="{{ __('Content') }} (it)" name="content_it"
                        value="{{ $data->content_it ?? old('content_it') }}"></os-area>
                    <os-area rows="2" label="{{ __('Content') }} (fr)" name="content_fr"
                        value="{{ $data->content_fr ?? old('content_fr') }}"></os-area>
                    <os-area rows="2" label="{{ __('Content') }} (ar)" name="content_ar"
                        value="{{ $data->content_ar ?? old('content_ar') }}"></os-area>
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
        const imageTransfer = document.querySelector("os-image-transfer");
        @if ($data->Images->count())
            imageTransfer.default = {
                src: "{{ $data->Images[0]->link }}"
            }
        @endif
    </script>
@endsection
