<div slot="header" id="header-content">
    <div id="content">
        <img id="image" {{ isset($core) ? '' : 'class=center' }}
            src="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}" />
        @if (isset($core))
            <div>
                <table>
                    <tr>
                        <td>{{ __('Ref') }}</td>
                        <td> {{ $ref }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Date') }}</td>
                        <td>{{ $date }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Customer') }}</td>
                        <td> {{ $name }}</td>
                    </tr>
                </table>
            </div>
        @endif
    </div>
    <div id="divide-top">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
