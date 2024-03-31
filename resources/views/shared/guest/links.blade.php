<ul class="flex flex-col gap-6">
    @if ($hide != 1)
        <li>
            <div class="p-4 rounded-x-huge bg-x-white flex flex-col gap-1">
                <a href="{{ route('views.guest.term') }}"
                    class="font-x-thin text-x-black text-base outline-none underline-offset-4 hover:underline focus:underline">
                    {{ __('Terms And Conditions') }}
                </a>
                <p class="text-base text-x-black text-opacity-80">
                    {{ __('Explore our guidelines for product/service usage, outlining responsibilities, rights, and limitations for a transparent relationship.') }}
                </p>
            </div>
        </li>
    @endif
    @if ($hide != 2)
        <li>
            <div class="p-4 rounded-x-huge bg-x-white flex flex-col gap-1">
                <a href="{{ route('views.guest.term') }}"
                    class="font-x-thin text-x-black text-base outline-none underline-offset-4 hover:underline focus:underline">
                    {{ __('Privacy Policy') }}
                </a>
                <p class="text-base text-x-black text-opacity-80">
                    {{ __('Discover how we safeguard your data and outline its usage, ensuring confidentiality and security.') }}
                </p>
            </div>
        </li>
    @endif
    @if ($hide != 3)
        <li>
            <div class="p-4 rounded-x-huge bg-x-white flex flex-col gap-1">
                <a href="{{ route('views.guest.return') }}"
                    class="font-x-thin text-x-black text-base outline-none underline-offset-4 hover:underline focus:underline">
                    {{ __('Return Policy') }}
                </a>
                <p class="text-base text-x-black text-opacity-80">
                    {{ __('Learn about our hassle-free return process, ensuring satisfaction with every purchase.') }}
                </p>
            </div>
        </li>
    @endif
    @if ($hide != 4)
        <li>
            <div class="p-4 rounded-x-huge bg-x-white flex flex-col gap-1">
                <a href="{{ route('views.guest.faq') }}"
                    class="font-x-thin text-x-black text-base outline-none underline-offset-4 hover:underline focus:underline">
                    {{ __('FAQs') }}
                </a>
                <p class="text-base text-x-black text-opacity-80">
                    {{ __('Find quick answers to common queries, ensuring a smooth experience.') }}
                </p>
            </div>
        </li>
    @endif
</ul>
