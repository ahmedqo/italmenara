@extends('shared.core.base')
@section('title', __('Update Password'))

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Update Password') }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.password.patch') }}" method="POST" class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-password label="{{ __('Old Password') }}" name="old_password"
                        value="{{ old('old_password') }}"></os-password>
                    <os-password label="{{ __('New Password') }}" name="new_password"
                        value="{{ old('new_password') }}"></os-password>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-password label="{{ __('Confirm Password') }}" name="confirm_password"
                        value="{{ old('confirm_password') }}" class="lg:col-span-2"></os-password>
                </div>
                <div class="w-full flex lg:col-span-4">
                    <os-button
                        class="w-full lg:w-max lg:px-20 lg:ms-auto rounded-x-thin px-4 py-2 text-base lg:text-lg font-x-huge text-x-white">
                        <span>{{ __('Save') }}</span>
                    </os-button>
                </div>
            </form>
        </div>
    </div>
@endsection
