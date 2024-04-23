<div slot="footer" id="footer-content">
    <div id="divide-bottom">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="content">
        <h3>
            {{ Core::secure(request()->getHost()) }}
        </h3>
        @if (Core::getSetting('print_email'))
            <h3>
                {{ Core::getSetting('print_email') }}
            </h3>
        @endif
        @if (Core::getSetting('print_phone'))
            <h3>
                {{ Core::getSetting('print_phone') }}
            </h3>
        @endif
    </div>
</div>
