<script src="{{ asset('js/os.min.js') }}?v={{ env('APP_VERSION') }}" {{ isset($public) ? 'defer' : '' }}></script>
@if (isset($public))
    <script src="{{ asset('js/app.min.js') }}?v={{ env('APP_VERSION') }}" defer></script>
@else
    <script src="{{ asset('js/index.min.js') }}?v={{ env('APP_VERSION') }}"></script>
@endif
@if (Session::has('message'))
    @php
        $messages = is_array(Session::get('message')) ? Session::get('message') : [Session::get('message')];
    @endphp
    <script>
        OS.$Load(function() {
            @foreach ($messages as $message)
                OS.$Toaster.Toast("{{ $message }}", "{{ Session::get('type') }}");
            @endforeach
        });
    </script>
@endif
