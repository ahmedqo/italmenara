<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Core::lang('ar') ? 'rtl' : 'ltr' }}"
    class="relative scroll-smooth overflow-x-hidden" style="overflow-x: hidden">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="your-verification-code">
    <meta name="referrer" content="no-referrer">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#2196f3">
    @yield('seo')
    <link rel="canonical" href="{{ route('views.guest.home') }}">
    @include('shared.base.styles', ['public' => true])
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
</head>

<body close class="overflow-x-clip">
    <os-wrapper class="bg-x-black bg-opacity-[.08]">
        <header>
            @include('shared.guest.header')
            @yield('header')
        </header>
        <main>
            @yield('content')
            <section class="hidden lg:block absolute inset-0 top-auto pointer-events-none z-[-1]">
                <div class="w-full container mx-auto px-4">
                    <img src="{{ asset('img/svg/name.svg') }}?v={{ env('APP_VERSION') }}" alt="ItalMenara name image"
                        class="block w-full opacity-5" />
                </div>
            </section>
        </main>
        @include('shared.guest.footer')
        <os-toaster horisontal="center" vertical="end"></os-toaster>
    </os-wrapper>
    @include('shared.base.scripts', ['public' => true])
    @yield('scripts')
</body>

</html>
