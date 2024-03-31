<style slot="styles" scoped>
    @import url({{ asset('css/print.min.css') }}?v={{ env('APP_VERSION') }});
</style>
<img slot="top" id="image-bg" src="{{ asset('img/svg/pattern.svg') }}?v={{ env('APP_VERSION') }}" />
@include('shared.page.head')
@include('shared.page.foot')
