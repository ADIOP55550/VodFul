<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'VodFul')</title>

    @section('head')
    @show
    @push('scripts')
        <meta name="test1" />
    @endpush

    @push('styles')
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/css/uikit.min.css" />

        <link rel="stylesheet" href="/css/app.css">
    @endpush

    @push('scripts')
        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/js/uikit-icons.min.js"></script>

        <script src="/js/app.js"></script>
    @endpush


    @stack('scripts')
    @stack('styles')

    @push('scripts')
        <meta name="test" />
    @endpush


</head>

<body>
    <div class="uk-position-relative">
        @include('components.login-modal')
        {{-- <x-components.login-modal></x-components.login-modal> --}}
        <div class="uk-position-top">
            @include('components.header')
        </div>

        {{-- <div class="splash-bg uk-width-1-1 uk-height-viewport-4"></div> --}}

        <main id="main-container"
            class="uk-position-top uk-section uk-light uk-padding-remove uk-margin-large-bottom splash-bg uk-height-viewport">
            @section('main')
                <h1>No content</h1>
            @show
        </main>


    </div>
</body>

</html>
