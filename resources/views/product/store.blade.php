@extends('shared.core.base')
@section('title', __('New Product'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('New Product') }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.products.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-6">
                @csrf
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text label="{{ __('Name') }} (en)" name="name_en" value="{{ old('name_en') }}"></os-text>
                    <os-text label="{{ __('Name') }} (it)" name="name_it" value="{{ old('name_it') }}"></os-text>
                    <os-text label="{{ __('Name') }} (fr)" name="name_fr" value="{{ old('name_fr') }}"></os-text>
                    <os-text label="{{ __('Name') }} (ar)" name="name_ar" value="{{ old('name_ar') }}"></os-text>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                    <os-area rows="2" label="{{ __('Details') }} (en)" name="details_en"
                        value="{{ old('details_en') }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (it)" name="details_it"
                        value="{{ old('details_it') }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (fr)" name="details_fr"
                        value="{{ old('details_fr') }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (ar)" name="details_ar"
                        value="{{ old('details_ar') }}"></os-area>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-fillable set-query="{{ 'name_' . Core::lang() }}" set-value="id" label="{{ __('Brand') }}"
                        name="brand" value="{{ old('brand') }}" query="{{ old('brand_name') }}"></os-fillable>
                    <os-fillable set-query="{{ 'name_' . Core::lang() }}" set-value="id" label="{{ __('Category') }}"
                        name="category" value="{{ old('category') }}" query="{{ old('category_name') }}"></os-fillable>
                    <os-text label="{{ __('Sku') }}" name="sku" value="{{ old('sku') }}"></os-text>
                    <os-text type="number" label="{{ __('Price') }}" name="price"
                        value="{{ old('price') }}"></os-text>
                    <os-select search label="{{ __('Unit') }}" name="unit">
                        @foreach (Core::unitList() as $unit)
                            <os-option value="{{ $unit }}" {{ $unit == old('unit') ? 'selected' : '' }}>
                                {{ __(ucwords($unit)) }}
                            </os-option>
                        @endforeach
                    </os-select>
                    <os-select label="{{ __('Status') }}" name="status">
                        @foreach (Core::statusList() as $status)
                            <os-option value="{{ $status }}" {{ $status == old('status') ? 'selected' : '' }}>
                                {{ __(ucwords($status)) }}
                            </os-option>
                        @endforeach
                    </os-select>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-image-transfer multiple name="images[]" class="lg:col-span-2"></os-image-transfer>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <textarea id="description_en" name="description_en" placeholder="{{ __('Description') }} (en)" rows="3">{{ old('description_en') }}</textarea>
                    <textarea id="description_it" name="description_it" placeholder="{{ __('Description') }} (it)" rows="3">{{ old('description_it') }}</textarea>
                    <textarea id="description_fr" name="description_fr" placeholder="{{ __('Description') }} (fr)" rows="3">{{ old('description_fr') }}</textarea>
                    <textarea id="description_ar" name="description_ar" placeholder="{{ __('Description') }} (ar)" rows="3">{{ old('description_ar') }}</textarea>
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
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script>
        ProductInitializer([{
            Fillable: document.querySelector("os-fillable[name=brand]"),
            Link: "{{ route('actions.brands.search') }}"
        }, {
            Fillable: document.querySelector("os-fillable[name=category]"),
            Link: "{{ route('actions.categories.search') }}"
        }]);
    </script>
@endsection
