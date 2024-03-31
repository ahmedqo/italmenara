@extends('shared.core.base')
@section('title', __('Requests List'))

@section('content')
    <div class="flex flex-col gap-2">
        <os-data-visualizer print search filter download title="{{ __('Requests List') }}">
            @include('shared.page.print')
        </os-data-visualizer>
    </div>
@endsection

@section('scripts')
    <script>
        const dataVisualizer = document.querySelector("os-data-visualizer");

        TableVisualizer(dataVisualizer, 'requests', {
            Currency: "{{ Core::getSetting('currency') }}",
            Search: "{{ route('actions.requests.search') }}",
            Scene: "{{ route('views.requests.scene', 'XXX') }}",
            Clear: "{{ route('actions.requests.clear', 'XXX') }}",
            Csrf: "{{ csrf_token() }}",
        });
    </script>
@endsection
