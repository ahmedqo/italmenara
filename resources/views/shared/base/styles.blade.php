<link rel="preconnect" href="{{ request()->getHost() }}" />
<link rel="preload" href="{{ asset('css/index.min.css') }}?v={{ env('APP_VERSION') }}" as="style" />
<link rel="preload" href="{{ asset('css/app.min.css') }}?v={{ env('APP_VERSION') }}" as="style" />
<link rel="preload" href="{{ asset('js/os.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />

<link rel="prefetch" href="{{ asset('css/index.min.css') }}?v={{ env('APP_VERSION') }}" as="style" />
<link rel="prefetch" href="{{ asset('css/app.min.css') }}?v={{ env('APP_VERSION') }}" as="style" />
<link rel="prefetch" href="{{ asset('js/os.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />

@if (isset($public))
    <link rel="prefetch" href="{{ asset('js/app.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />
    <link rel="preload" href="{{ asset('js/app.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />
@else
    <link rel="prefetch" href="{{ asset('js/index.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />
    <link rel="preload" href="{{ asset('js/index.min.js') }}?v={{ env('APP_VERSION') }}" as="script" />
@endif

<link rel="stylesheet" href="{{ asset('css/index.min.css') }}?v={{ env('APP_VERSION') }}" />
<link rel="stylesheet" href="{{ asset('css/app.min.css') }}?v={{ env('APP_VERSION') }}" />
