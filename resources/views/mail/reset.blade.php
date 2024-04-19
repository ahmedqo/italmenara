<table style="width: 100%;">
    <tr>
        <td style="padding: 16px;">
            <div
                style="width: 500px; max-width: 100%; margin: auto;padding: 16px;border-radius: 10px; box-sizing: border-box;background: rgb(252 252 252);">
                <a href="{{ route('views.guest.home') }}"
                    style="width: 200px; max-width: 100%; display: block; text-decoration: unset; margin: auto;">
                    <img src="{{ asset('img/logo.png') }}?v={{ env('APP_VERSION') }}"
                        style="width: 100%; display: block;" />
                </a>
                <p style="color: #1d1d1d; text-align: center; font-size: 16px; margin: 20px 0 30px 0;">
                    {{ __('Did you forget your password?') }}<br />
                    {{ __('No need to worry, we\'ve got you covered! Let us provide you with a new password') }}
                </p>
                <div
                    style="max-width: 100%;text-align: center;color: #fcfcfc;font-weight: 600;font-size: 14px;border-radius: 6px;width: max-content;padding: 12px 32px;margin: auto;background: #0396f3;">
                    <a
                        href="{{ route('views.reset.index', $data['token']) }}"style="text-decoration: unset;display: block;width: 100%;">
                        {{ __('Reset Password') }}
                    </a>
                </div>
            </div>
        </td>
    </tr>
</table>
