@extends('shared.auth.base')
@section('title', __('Reset Password'))

@section('content')
    <div style="background-image: url({{ asset('img/bg-reset.webp') }}?v={{ env('APP_VERSION') }})"
        class="block bg-center bg-cover bg-no-repeat fixed w-full h-[100dvh] inset-0 z-[-1] lg:w-1/2 lg:relative">
        <div class="absolute inset-0 w-full h-full bg-x-black bg-opacity-30 backdrop-blur-sm"></div>
    </div>
    <div class="w-full flex justify-center items-center p-4 lg:w-1/2">
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            <a href="{{ route('views.login.index') }}" class="block w-48 mx-auto">
                <img src="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}" class="block w-full" />
            </a>
            <form action="{{ route('actions.reset.index', $token) }}" method="POST"
                class="w-full flex flex-col gap-4 lg:gap-6 p-4 lg:p-6 bg-x-white rounded-x-huge shadow-x-core">
                @csrf
                <os-password label="{{ __('New Password') }}" name="new_password"></os-password>
                <os-password label="{{ __('Confirm Password') }}" name="confirm_password"></os-password>
                <os-button
                    class="rounded-x-thin px-4 py-2 text-base lg:text-lg font-x-huge text-x-white bg-x-core bg-gradient-to-br rtl:bg-gradient-to-bl">
                    <span>{{ __('Reset') }}</span>
                </os-button>
            </form>
        </div>
    </div>
@endsection
