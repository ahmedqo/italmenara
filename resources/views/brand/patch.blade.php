@extends('shared.core.base')
@section('title', __('Edit Brand') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Brand') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.brands.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="lg:col-span-2">
                        <os-image-transfer name="image" class="lg:w-1/4 lg:mx-auto"></os-image-transfer>
                    </div>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text label="{{ __('Name') }} (en)" name="name_en" value="{{ $data->name_en }}"></os-text>
                    <os-text label="{{ __('Name') }} (it)" name="name_it" value="{{ $data->name_it }}"></os-text>
                    <os-text label="{{ __('Name') }} (fr)" name="name_fr" value="{{ $data->name_fr }}"></os-text>
                    <os-text label="{{ __('Name') }} (ar)" name="name_ar" value="{{ $data->name_ar }}"></os-text>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                    <os-area rows="2" label="{{ __('Description') }} (en)" name="description_en"
                        value="{{ $data->description_en }}"></os-area>
                    <os-area rows="2" label="{{ __('Description') }} (it)" name="description_it"
                        value="{{ $data->description_it }}"></os-area>
                    <os-area rows="2" label="{{ __('Description') }} (fr)" name="description_fr"
                        value="{{ $data->description_fr }}"></os-area>
                    <os-area rows="2" label="{{ __('Description') }} (ar)" name="description_ar"
                        value="{{ $data->description_ar }}"></os-area>
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
        imageTransfer.default = {
            src: "{{ $data->Image->link }}"
        }
    </script>
@endsection
