@extends('shared.guest.base')
@section('title', __('Something Went Wrong'))

@section('content')
    <section class="w-full relative container mx-auto p-4 flex flex-col gap-4 lg:gap-8 my-4 lg:my-10">
        <div class="w-full flex flex-col items-center gap-6 md:gap-10">
            <img src="{{ asset('img/svg/500.svg') }}?v={{ env('APP_VERSION') }}" alt="ItalMenara not found image"
                loading="lazy" width="100%" height="auto"
                class="block w-8/12 sm:w-7/12 lg:w-1/3 mx-auto pointer-events-none">
            <h1 class="uppercase font-x-huge text-x-black text-3xl lg:text-4xl text-center">
                {{ ucwords(__('Something Went Wrong')) }}
            </h1>
        </div>
    </section>
@endsection
