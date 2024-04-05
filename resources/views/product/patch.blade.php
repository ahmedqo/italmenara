@extends('shared.core.base')
@section('title', __('Edit Product') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit Product') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.products.patch', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text label="{{ __('Name') }} (en)" name="name_en" value="{{ $data->name_en }}"></os-text>
                    <os-text label="{{ __('Name') }} (it)" name="name_it" value="{{ $data->name_it }}"></os-text>
                    <os-text label="{{ __('Name') }} (fr)" name="name_fr" value="{{ $data->name_fr }}"></os-text>
                    <os-text label="{{ __('Name') }} (ar)" name="name_ar" value="{{ $data->name_ar }}"></os-text>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                    <os-area rows="2" label="{{ __('Details') }} (en)" name="details_en"
                        value="{{ $data->details_en }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (it)" name="details_it"
                        value="{{ $data->details_it }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (fr)" name="details_fr"
                        value="{{ $data->details_fr }}"></os-area>
                    <os-area rows="2" label="{{ __('Details') }} (ar)" name="details_ar"
                        value="{{ $data->details_ar }}"></os-area>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-fillable set-query="{{ 'name_' . Core::lang() }}" set-value="id" label="{{ __('Brand') }}"
                        name="brand" value="{{ $data->brand }}"
                        query="{{ $data->Brand->{'name_' . Core::lang()} }}"></os-fillable>
                    <os-fillable set-query="{{ 'name_' . Core::lang() }}" set-value="id" label="{{ __('Category') }}"
                        name="category" value="{{ $data->category }}"
                        query="{{ $data->Category->{'name_' . Core::lang()} }}"></os-fillable>
                    <os-text label="{{ __('Sku') }}" name="sku" value="{{ $data->sku }}"></os-text>
                    <os-text type="number" label="{{ __('Price') }}" name="price"
                        value="{{ $data->price }}"></os-text>
                    <os-select search label="{{ __('Unit') }}" name="unit">
                        @foreach (Core::unitList() as $unit)
                            <os-option value="{{ $unit }}" {{ $unit == $data->unit ? 'selected' : '' }}>
                                {{ __(ucwords($unit)) }}
                            </os-option>
                        @endforeach
                    </os-select>
                    <os-select label="{{ __('Status') }}" name="status">
                        @foreach (Core::statusList() as $status)
                            <os-option value="{{ $status }}" {{ $status == $data->status ? 'selected' : '' }}>
                                {{ __(ucwords($status)) }}
                            </os-option>
                        @endforeach
                    </os-select>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 gap-4">
                    <os-image-transfer multiple name="images[]" class="lg:col-span-2"></os-image-transfer>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <textarea id="description_en" name="description_en" placeholder="{{ __('Description') }} (en)" rows="3">{{ $data->description_en }}</textarea>
                    <textarea id="description_it" name="description_it" placeholder="{{ __('Description') }} (it)" rows="3">{{ $data->description_it }}</textarea>
                    <textarea id="description_fr" name="description_fr" placeholder="{{ __('Description') }} (fr)" rows="3">{{ $data->description_fr }}</textarea>
                    <textarea id="description_ar" name="description_ar" placeholder="{{ __('Description') }} (ar)" rows="3">{{ $data->description_ar }}</textarea>
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
    <link rel="stylesheet" href="{{ asset('js/editor/theme.min.css') }}?v={{ env('APP_VERSION') }}" />
    <script type="text/javascript" src="{{ asset('js/editor/rte.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor/plugins/all_plugins.js') }}?v={{ env('APP_VERSION') }}">
    </script>
    <script src="{{ asset('js/editor/lang/rte-lang-' . app()->getLocale() . '.js') }}?v={{ env('APP_VERSION') }}">
    </script>
    <script>
        const imageTransfer = document.querySelector("os-image-transfer");
        imageTransfer.default = {!! $data->Images->map(function ($Image) {
            return ['id' => $Image->id, 'src' => $Image->Link];
        }) !!};

        ProductInitializer([{
            Fillable: document.querySelector("os-fillable[name=brand]"),
            Link: "{{ route('actions.brands.search') }}"
        }, {
            Fillable: document.querySelector("os-fillable[name=category]"),
            Link: "{{ route('actions.categories.search') }}"
        }], imageTransfer);
    </script>
@endsection
