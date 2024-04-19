<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Core::lang('ar') ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('shared.base.styles')
    <title>@yield('title')</title>
</head>

<body close>
    <div id="overlay" class="fixed inset-0 w-full h-[100dvh] flex items-center justify-center bg-x-white z-[100]">
        <div class="flex flex-col gap-4">
            <img src="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}" class="block w-48" />
            <svg id="loader" stroke="currentColor" viewBox="0 0 24 24">
                <g>
                    <circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3"></circle>
                </g>
            </svg>
        </div>
    </div>
    <os-wrapper class="bg-x-black bg-opacity-[.08] flex flex-wrap">
        @include('shared.core.sidebar')
        <main class="w-full lg:w-0 lg:flex-1">
            @include('shared.core.topbar')
            <div class="p-4 container mx-auto">
                @yield('content')
            </div>
        </main>
        <os-toaster horisontal="end" vertical="start"></os-toaster>
    </os-wrapper>
    @include('shared.base.scripts')
    @yield('scripts')
</body>

</html>
