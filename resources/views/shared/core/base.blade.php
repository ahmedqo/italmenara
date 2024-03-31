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
