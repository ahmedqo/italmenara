<os-topbar transparent class="relative z-10">
    <div class="w-full flex flex-col gap-4">
        <ul class="w-full flex items-center gap-4">
            <li class="flex-1 flex gap-2 items-center justify-start">
                <os-dropdown label="{{ __('Menu') }}" position="{{ Core::lang('ar') ? 'end' : 'start' }}"
                    class="lg:hidden pointer-events-auto">
                    <button slot="trigger" name="menu-trigger"
                        class="block p-2 rounded-x-thin text-x-black lg:text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M129-215q-20.75 0-33.375-12.675Q83-240.351 83-261.175 83-280 95.625-293T129-306h458q19.75 0 32.375 13.175 12.625 13.176 12.625 32Q632-240 619.375-227.5 606.75-215 587-215H129Zm0-221q-20.75 0-33.375-13.175Q83-462.351 83-482.175 83-502 95.625-514.5 108.25-527 129-527h339q18.75 0 31.875 12.675Q513-501.649 513-481.825 513-462 499.875-449 486.75-436 468-436H129Zm0-218q-20.75 0-33.375-13.175Q83-680.351 83-700.175 83-720 95.625-733 108.25-746 129-746h458q19.75 0 32.375 13.175 12.625 13.176 12.625 33Q632-680 619.375-667 606.75-654 587-654H129Zm605 173 114 113q13 14 12.5 33T847-304q-15 14-33.5 14T782-304L637-450q-14-13-14-31t14-32l145-146q13-13 31.5-13t33.5 13q13 14 12.5 33T847-594L734-481Z" />
                        </svg>
                    </button>
                    <nav>
                        <ul class="flex flex-col">
                            <li>
                                <a href="{{ route('views.guest.home') }}" aria-label="home page"
                                    class="flex-wrap w-full p-2 flex gap-2 items-center font-x-thin text-start outline-none text-x-black !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ request()->routeIs('views.guest.home') ? '!bg-x-black' : '' }}">
                                    <svg class="block w-5 h-5 pointer-events-none text-[var(--color-0)]"
                                        fill="currentcolor" viewBox="0 -960 960 960">
                                        <path
                                            d="M441-153H238q-19.35 0-32.675-13.325Q192-179.65 192-199v-273h-73q-16 0-21.5-14.5T103-513l348-311q12.186-10 29.093-10T510-824l161 141v-80q0-9.2 7.2-15.6T695-785h49.818q8.982 0 16.082 6.4 7.1 6.4 7.1 15.6v170l89 80q11 12 5.708 26.5Q857.417-472 842-472h-74v273q0 19.35-13.312 32.675Q741.375-153 723-153H519v-231h-78v231Zm-170-79h91v-232h236v232h91v-324L480-745 271-556.073V-232Zm91-232h236-236Zm28-87h180q0-37-26.514-61-26.515-24-63.2-24-36.686 0-63.486 23.842Q390-588.315 390-551Z">
                                        </path>
                                    </svg>
                                    <span>{{ __('Home') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('views.guest.brand') }}" aria-label="brands page"
                                    class="flex-wrap w-full p-2 flex gap-2 items-center font-x-thin text-start outline-none text-x-black !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ request()->routeIs('views.guest.brand') ? '!bg-x-black' : '' }}">
                                    <svg class="block w-5 h-5 pointer-events-none text-[var(--color-2)]"
                                        fill="currentcolor" viewBox="0 -960 960 960">
                                        <path
                                            d="m437-439-69-73q-10.25-12-25.125-11.5T317-514q-12 12.511-12 27.256Q305-472 317-461l88 86q12.364 15 32.182 15T470-375l174-172q10-9 10-24.5T643-598q-11-8-25-8t-23 10L437-439ZM316-68l-60-103-119-25q-19-3-29.5-17.125T100-245l14-115.704L38-451q-10-12.39-10-29.195T38-510l76-88.297L100-714q-3-17.75 7.5-31.875T137-764l119.31-24.197L316-892q8.88-14.562 25.92-20.281Q358.96-918 376-911l104 49 105-49q16-5 33.056-.818Q635.111-907.636 644-893l60.69 104.803L823-764q19 4 29.5 18.125T860-714l-14 115.703L922-510q10 13.39 10 30.195T922-451l-76 90.296L860-245q3 17.75-7.5 31.875T823-196l-118 25-61 104q-8.889 14.636-25.944 18.818Q601-44 585-49L480-98 376-49q-17 5-34.056.318Q324.889-53.364 316-68Zm60.736-83 103.121-43.564L586-151l65-96 112-29-11-116.191 77-87.894L752-570l11-116-112-27-66.659-96-104.159 43.458L374-809l-64.718 96.241L198-686.448 208-570l-77 90 77 88-10 118.462 111.099 26.307L376.736-151ZM480-480Z">
                                        </path>
                                    </svg>
                                    <span>{{ __('Brands') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('views.guest.category') }}" aria-label="categories page"
                                    class="flex-wrap w-full p-2 flex gap-2 items-center font-x-thin text-start outline-none text-x-black !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ request()->routeIs('views.guest.category') ? '!bg-x-black' : '' }}">
                                    <svg class="block w-5 h-5 pointer-events-none text-[var(--color-3)]"
                                        fill="currentcolor" viewBox="0 -960 960 960">
                                        <path
                                            d="m264-572 178-288q5.818-10.053 16.493-15.526Q469.167-881 480.584-881q11.416 0 21.916 5.263T520-860l179 288q6 10.375 5.5 23.607t-5.125 23.841q-5.47 10.349-16.615 16.45Q671.614-502 659-502H302q-12.786 0-24.125-5.902-11.339-5.901-15.25-16.65-5.625-10.545-6.125-23.621Q256-561.25 264-572ZM725.882-39q-81.235 0-138.559-57.23Q530-153.461 530-235.647 530-317 587.206-375q57.206-58 138.735-58 82.363 0 139.211 57.882Q922-317.235 922-235.088q0 82.147-57.025 139.117Q807.951-39 725.882-39ZM65-111v-257q0-18.25 12.625-32.125T112-414h257q19.775 0 32.388 13.875Q414-386.25 414-368v257q0 21.75-12.612 34.375Q388.775-64 369-64H112q-21.75 0-34.375-12.625T65-111Zm661.31-20q44.69 0 74.19-29.88 29.5-29.881 29.5-74.5 0-44.62-29.584-75.12-29.585-30.5-74.275-30.5-44.69 0-74.916 30.552Q621-279.896 621-235.028q0 44.448 30.31 74.238t75 29.79ZM157-156h166v-166H157v166Zm227-438h192l-95-156-97 156Zm97 0ZM323-322Zm403 87Z">
                                        </path>
                                    </svg>
                                    <span>{{ __('Categories') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('views.guest.product') }}" aria-label="products page"
                                    class="flex-wrap w-full p-2 flex gap-2 items-center font-x-thin text-start outline-none text-x-black !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ request()->routeIs('views.guest.product') ? '!bg-x-black' : '' }}">
                                    <svg class="block w-5 h-5 pointer-events-none text-[var(--color-4)]"
                                        fill="currentcolor" viewBox="0 -960 960 960">
                                        <path
                                            d="M190-641v451h580v-451H653v266q0 27-22 39.5t-44 2.5l-107-54-107 54q-22 10-43-2.5T309-375v-266H190Zm1 542q-37.75 0-64.875-27.1T99-192v-490q0-14.632 5-29.434 5-14.801 15.186-27.524L192-833q11.298-15.448 28.981-22.224T259-862h443q18.712 0 35.864 6.69Q755.016-848.621 767-834l75.814 95.042Q851-725.722 856.5-710.677 862-695.632 862-681v489q0 38.8-27.419 65.9Q807.163-99 769-99H191Zm33-626h512l-36.409-46H258.449L224-725Zm169 84v204l87-43 89 43v-204H393Zm-203 0h580-580Z">
                                        </path>
                                    </svg>
                                    <span>{{ __('Products') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('views.guest.request') }}" aria-label="requests page"
                                    class="flex-wrap w-full p-2 flex gap-2 items-center font-x-thin text-start outline-none text-x-black !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ request()->routeIs('views.guest.request') ? '!bg-x-black' : '' }}">
                                    <svg class="block w-5 h-5 pointer-events-none text-[var(--color-5)]"
                                        fill="currentcolor" viewBox="0 -960 960 960">
                                        <path
                                            d="M227-38q-58.917 0-97.958-39.75Q90-117.5 90-175v-100q0-19.65 13.312-32.825Q116.625-321 136-321h93v-546q0-8.5 6.5-11.25t12.794 3.544L277-846q5.455 7 16.227 6.5Q304-840 310-847l32-31q4.818-5 15.909-5Q369-883 374-878l30 31q4.818 7 15.955 7 11.136 0 17.045-7l32-31q4.273-5 15.409-5 11.136 0 17.591 5l30 31q5.727 7 16.864 7Q560-840 565-847l32-31q3.636-5 15.136-5T630-878l30 31q5.455 7 16.227 7Q687-840 693-847l31-31q4.545-5 16.045-5 11.5 0 16.955 5l31 31q4.818 7 15.955 7.5 11.136.5 17.045-6.5l30-29q5.118-6 12.559-3.042Q871-875.083 871-867v692q0 57.5-40.042 97.25Q790.917-38 734-38H227Zm505.5-92q18.5 0 31-12.885T776-174.6V-775H323v504h324q18.8 0 32.4 13.175Q693-244.65 693-225v50q0 19 10 32t29.5 13ZM405-674h162q11.8 0 20.4 8.456 8.6 8.456 8.6 20.316t-8.6 20.044Q578.8-617 567-617H405q-11.375 0-19.688-8.439-8.312-8.438-8.312-20 0-11.561 8.312-20.061Q393.625-674 405-674Zm0 132h162q11.8 0 20.4 8.375 8.6 8.376 8.6 20.116 0 11.741-8.6 20.125T567-485H405q-11.375 0-19.688-8.56-8.312-8.559-8.312-20.3 0-11.74 8.312-19.94Q393.625-542 405-542Zm284.421-75Q678-617 669.5-625.763t-8.5-19.5Q661-656 669.281-665q8.28-9 20-9 11.719 0 20.219 8.781 8.5 8.78 8.5 19.815 0 11.036-8.579 19.72t-20 8.684Zm0 127Q678-490 669.5-498.884t-8.5-19.8q0-10.916 8.281-19.616 8.28-8.7 20-8.7 11.719 0 20.219 8.7 8.5 8.7 8.5 19.616t-8.579 19.8q-8.579 8.884-20 8.884Z" />
                                    </svg>
                                    <span>{{ __('Requests') }}</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </os-dropdown>
                <button id="search-trigger" name="search-trigger"
                    class="hidden lg:block p-2 rounded-x-thin text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M794-96 525.787-364Q496-341.077 457.541-328.038 419.082-315 373.438-315q-115.311 0-193.875-78.703Q101-472.406 101-585.203T179.703-776.5q78.703-78.5 191.5-78.5T562.5-776.356Q641-697.712 641-584.85q0 45.85-13 83.35-13 37.5-38 71.5l270 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083 550-584.588q0-75.505-51.346-127.459Q447.309-764 371.529-764q-76.612 0-128.071 51.953Q192-660.093 192-584.588t51.311 127.046Q294.623-406 371.441-406Z" />
                    </svg>
                </button>
            </li>
            <li class="flex-1 flex gap-2 items-center justify-center">
                <a href="{{ route('views.guest.home') }}" aria-label="{{ env('APP_NAME') }} home page"
                    class="block lg:w-48 mx-auto">
                    <img src="{{ asset('img/svg/logo.svg') }}?v={{ env('APP_VERSION') }}"
                        alt="{{ env('APP_NAME') }} logo image" loading="lazy" class="block w-full" width="100%"
                        height="auto" />
                </a>
            </li>
            <li class="flex-1 flex gap-2 items-center justify-end">
                <button id="search-mobile-trigger" name="search-mobile-trigger"
                    class="block lg:hidden p-2 rounded-x-thin text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M794-96 525.787-364Q496-341.077 457.541-328.038 419.082-315 373.438-315q-115.311 0-193.875-78.703Q101-472.406 101-585.203T179.703-776.5q78.703-78.5 191.5-78.5T562.5-776.356Q641-697.712 641-584.85q0 45.85-13 83.35-13 37.5-38 71.5l270 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083 550-584.588q0-75.505-51.346-127.459Q447.309-764 371.529-764q-76.612 0-128.071 51.953Q192-660.093 192-584.588t51.311 127.046Q294.623-406 371.441-406Z" />
                    </svg>
                </button>
                <os-dropdown label="{{ __('Languages') }}" position="{{ Core::lang('ar') ? 'start' : 'end' }}"
                    class="pointer-events-auto">
                    <button slot="trigger" name="languages-trigger"
                        class="block p-2 rounded-x-thin text-x-black lg:text-x-black outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M610-196 568.513-90.019Q566-78 555.452-71q-10.548 7-23.606 7Q510-64 499.5-80.963 489-97.927 497-118.094L654.571-537.15Q658-549 668-556.5q10-7.5 22-7.5h31.552q11.821 0 21.672 7T758-538l164 419q6 20.462-5.6 37.73Q904.799-64 884.273-64q-14.692 0-26.733-7.76t-15.536-22.576L808.585-196H610Zm22-72h148l-73.054-202H705l-73 202ZM355.135-397l-179.34 178.842Q162.86-206 146.206-206.5q-16.654-.5-27.93-11Q107-229 108-246.689q1-17.69 11.654-28.321L303-458q-39.6-45.818-70.8-92.409Q201-597 179-646h90q16 34 38.329 64.567 22.328 30.566 48.274 63.433Q403-567 434.628-619.861 466.256-672.721 489-730H63.857q-17.753 0-29.305-12.289Q23-754.579 23-771.982q0-17.404 12.35-29.318 12.35-11.914 29.895-11.914h248.731v-41.893q0-17.529 11.748-29.211Q337.471-896 355.098-896t29.637 11.682q12.011 11.682 12.011 29.211v41.893h249.548q17.685 0 29.696 11.768Q688-789.679 688-771.895q0 17.509-12.282 29.702Q663.436-730 645.759-730h-74.975Q548-656 510-587.5T416-457l102 103-29.389 83.933L355.135-397Z" />
                        </svg>
                    </button>
                    <ul class="w-full flex flex-col">
                        <li class="w-full">
                            <a href="{{ route('actions.language.index', 'en') }}"
                                aria-label="{{ env('APP_NAME') }} english language"
                                class="w-full flex flex-wrap gap-2 px-2 py-1 text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::lang('en') ? '!bg-x-black' : '' }}">
                                <img src="{{ asset('lang/en.png') }}?v={{ env('APP_VERSION') }}"
                                    alt="{{ env('APP_NAME') }} english lang logo" loading="lazy"
                                    class="block w-6 h-4 object-contain" width="1.5rem" height="1rem" />
                                <span class="block flex-1 text-base text-start">{{ __('English') }}</span>
                            </a>
                        </li>
                        <li class="w-full">
                            <a href="{{ route('actions.language.index', 'it') }}"
                                aria-label="{{ env('APP_NAME') }} italian language"
                                class="w-full flex flex-wrap gap-2 px-2 py-1 text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::lang('it') ? '!bg-x-black' : '' }}">
                                <img src="{{ asset('lang/it.png') }}?v={{ env('APP_VERSION') }}"
                                    alt="{{ env('APP_NAME') }} italian lang logo" loading="lazy"
                                    class="block w-6 h-4 object-contain" width="1.5rem" height="1rem" />
                                <span class="block flex-1 text-base text-start">{{ __('Italian') }}</span>
                            </a>
                        </li>
                        <li class="w-full">
                            <a href="{{ route('actions.language.index', 'fr') }}"
                                aria-label="{{ env('APP_NAME') }} french language"
                                class="w-full flex flex-wrap gap-2 px-2 py-1 text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::lang('fr') ? '!bg-x-black' : '' }}">
                                <img src="{{ asset('lang/fr.png') }}?v={{ env('APP_VERSION') }}"
                                    alt="{{ env('APP_NAME') }} french lang logo" loading="lazy"
                                    class="block w-6 h-4 object-contain" width="1.5rem" height="1rem" />
                                <span class="block flex-1 text-base text-start">{{ __('French') }}</span>
                            </a>
                        </li>
                        <li class="w-full">
                            <a href="{{ route('actions.language.index', 'ar') }}"
                                aria-label="{{ env('APP_NAME') }} arabic language"
                                class="w-full flex flex-wrap gap-2 px-2 py-1 text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::lang('ar') ? '!bg-x-black' : '' }}">
                                <img src="{{ asset('lang/ar.png') }}?v={{ env('APP_VERSION') }}"
                                    alt="{{ env('APP_NAME') }} arabic lang logo" loading="lazy"
                                    class="block w-6 h-4 object-contain" width="1.5rem" height="1rem" />
                                <span class="block flex-1 text-base text-start">{{ __('Arabic') }}</span>
                            </a>
                        </li>
                    </ul>
                </os-dropdown>
            </li>
        </ul>
        <nav class="w-full flex items-center justify-center">
            <ul class="hidden lg:flex w-max gap-4">
                <li>
                    <a href="{{ route('views.guest.home') }}" aria-label="home page"
                        class="w-max font-x-thin text-sm uppercase outline-none text-x-black pb-1 border-b-x-prime hover:border-b-[3px] focus:border-b-[3px] hover:text-x-prime focus:text-x-prime {{ request()->routeIs('views.guest.home') ? 'border-b-[3px] text-x-prime' : '' }}">
                        <span>{{ __('Home') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('views.guest.brand') }}" aria-label="brands page"
                        class="w-max font-x-thin text-sm uppercase outline-none text-x-black pb-1 border-b-x-prime hover:border-b-[3px] focus:border-b-[3px] hover:text-x-prime focus:text-x-prime {{ request()->routeIs('views.guest.brand') ? 'border-b-[3px] text-x-prime' : '' }}">
                        <span>{{ __('Brands') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('views.guest.category') }}" aria-label="categories page"
                        class="w-max font-x-thin text-sm uppercase outline-none text-x-black pb-1 border-b-x-prime hover:border-b-[3px] focus:border-b-[3px] hover:text-x-prime focus:text-x-prime {{ request()->routeIs('views.guest.category') ? 'border-b-[3px] text-x-prime' : '' }}">
                        <span>{{ __('Categories') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('views.guest.product') }}" aria-label="products page"
                        class="w-max font-x-thin text-sm uppercase outline-none text-x-black pb-1 border-b-x-prime hover:border-b-[3px] focus:border-b-[3px] hover:text-x-prime focus:text-x-prime {{ request()->routeIs('views.guest.product') ? 'border-b-[3px] text-x-prime' : '' }}">
                        <span>{{ __('Products') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('views.guest.request') }}" aria-label="requests page"
                        class="w-max font-x-thin text-sm uppercase outline-none text-x-black pb-1 border-b-x-prime hover:border-b-[3px] focus:border-b-[3px] hover:text-x-prime focus:text-x-prime {{ request()->routeIs('views.guest.request') ? 'border-b-[3px] text-x-prime' : '' }}">
                        <span>{{ __('Requests') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</os-topbar>
