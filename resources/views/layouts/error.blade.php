<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
        <link rel="stylesheet" href="{{ asset('wncms/plugins/global/plugins.bundle.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('wncms/plugins/global/plugins-wncms.bundle.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('wncms/css/style.bundle.css') }}" type="text/css">
        @yield('styles')
    </head>

    <body id="wncms_body" class="bg-body" data-kt-name="wncms">


        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    {{-- Login Form --}}
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">
                            @yield('content')
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="d-flex flex-center flex-wrap px-5">
                        <div class="d-flex fw-semibold text-primary fs-base">
                            <a href="https://3dayseo.com" target="_blank" class="px-5">@lang('word.wn_official_website')</a>
                            <a href="https://wncms.cc" target="_blank" class="px-5">@lang('word.wn_official_website')</a>
                            <a href="https://wntheme.com" target="_blank" class="px-5">@lang('word.wntheme_official_website')</a>
                            <a href="https://t.me/secretwebmaster" target="_blank" class="px-5">@lang('word.live_support')</a>
                            <a href="https://t.me/secretwebmaster" target="_blank" class="px-5">@lang('word.contact_to_purchase')</a>
                        </div>
                    </div>

                </div>

                {{-- Side Image --}}
                {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ 'misc/auth-bg.png' }})">
                    <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                        <a href="/" class="mb-12">
                            <img alt="Logo" src="{{ $website->site_logo }}" class="h-75px">
                        </a>
                        <img class="mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ 'misc/auth-screens.png' }}" alt="">
                        <h1 class="text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                        <div class="text-white fs-base text-center">In this kind of post,
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
                            <br>and provides some background information about
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                            <br>work following this is a transcript of the interview.
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>

        {{-- JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('wncms/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('wncms/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('wncms/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('wncms/js/custom/authentication/sign-in/general.js?v=')  . wncms_get_version('js') }}"></script>
        {{-- <script src="{{ asset('wncms/js/custom.js') }}"></script> --}}

        @yield('scripts')

    </body>

</html>