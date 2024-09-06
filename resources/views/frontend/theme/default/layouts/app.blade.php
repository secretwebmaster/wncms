<!DOCTYPE html>
<html lang="zh-CN">

    <head>
        <title>{{ $page_title ?? $website->site_name }}</title>

        {{-- Meta --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="{{ $website->site_seo_keywords }}">
        <meta name="description" content="{{ $website->site_seo_description }}">
        {!! $website->meta_verification !!}

        {{-- CSS --}}
        <link rel="shortcut icon" type="images/x-icon" href="{{ $website->site_favicon ?: asset('wncms/images/logos/favicon.png') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="{{ asset("theme/default/css/style.css?v=") . wncms_get_version() }}" />
        <style>
            table {
                border-collapse: collapse;
            }
    
            th,
            td {
                border: 1px solid black;
                padding: 3px;
                text-align: left;
                font-size: 12px;
            }
    
            th {
                background-color: #f2f2f2;
                /* Optional: Add a background color to the header cells */
            }
            .pagination{
                display: flex;
                padding-left: 0;
            }
            .page-item{
                list-style: none;
                margin: 5px;
            }

            .tabs {
                display: flex;
            }

            .tabs button {
                border: none;
                outline: none;
                padding: 3px;
                cursor: pointer;
                transition: 0.3s;
            }

            .tabs button.active {
                background-color: #ccc;
            }

            .tab-content {
                display: none;
                margin-top: 5px;
            }

            .tab-content.active {
                display: block;
            }
        </style>

        @stack('head_css')
        <style>{!! gto('head_css') !!}</style>
        
        {{-- JS --}}
        @stack('head_js')
        <script src="{{ asset('wncms/js/cookie.js?v=') . wncms_get_version() }}"></script>
        {!! $website->head_code !!}
    </head>

    <body>
        {{-- Header --}}
        @include('frontend.theme.default.parts.header')

        {{-- Page content --}}
        @yield('content')

        {{-- Footer --}}
        @include('frontend.theme.default.parts.footer')

        {{-- JS --}}
        @stack('foot_js')
        <script src="{{ asset('wncms/js/jquery.min.js?v=' . wncms_get_version()) }}"></script>
        <script src="{{ asset('wncms/js/lazysizes.min.js?v=' . wncms_get_version()) }}"></script>
        {!! $website->body_code !!}
        {!! $website->analytics !!}
        
        {{-- CSS --}}
        @stack('foot_css')
        <style>{!! gto('custom_css') !!}</style>
    </body>

</html>