@extends('shared.core.base')
@section('title', __('Edit User') . ' #' . $data->id)

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-center lg:text-start text-xl lg:text-2xl text-x-black font-x-thin">
            {{ __('Edit User') . ' #' . $data->id }}
        </h1>
        <div class="bg-x-white rounded-x-huge shadow-x-core p-6">
            <form action="{{ route('actions.users.patch', $data->id) }}" method="POST" class="w-full flex flex-col gap-6">
                @csrf
                @method('patch')
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text label="{{ __('First Name') }}" name="first_name" value="{{ $data->first_name }}"></os-text>
                    <os-text label="{{ __('Last Name') }}" name="last_name" value="{{ $data->last_name }}"></os-text>
                    <os-select label="{{ __('Gender') }}" name="gender">
                        @foreach (Core::genderList() as $gender)
                            <os-option value="{{ $gender }}" {{ $gender == $data->gender ? 'selected' : '' }}>
                                {{ ucwords(__($gender)) }}
                            </os-option>
                        @endforeach
                    </os-select>
                    <os-date {{ !Core::lang('ar') ? 'full-day=3' : '' }} label="{{ __('Birth Date') }}" name="birth_date"
                        format="dddd dd mmmm yyyy" value="{{ $data->birth_date }}"></os-date>
                </div>
                <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <os-text type="email" label="{{ __('Email') }}" name="email"
                        value="{{ $data->email }}"></os-text>
                    <os-text type="tel" label="{{ __('Phone') }}" name="phone"
                        value="{{ $data->phone }}"></os-text>
                    <os-area label="{{ __('Address') }}" name="address" value="{{ $data->address }}"
                        class="lg:col-span-2"></os-area>
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
