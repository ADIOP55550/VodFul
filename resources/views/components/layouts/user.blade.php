<x-layouts.main>

    @push('styles')
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="/css/app.css">
    <style>
        html {
            background-color: #02304f;
        }
    </style>
    @endpush

    @push('scripts')
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/js/uikit-icons.min.js"></script>

    <script src="/js/app.js"></script>
    @endpush


    <div class="uk-position-relative">
        <x-login-modal :openLogin="$openLogin ?? false" :openRegister="$openRegister ?? false" />
        <div class="uk-position-top">
            <x-navbar />
        </div>
        <main id="main-container"
            class="uk-position-top uk-section uk-padding-remove uk-margin-large-bottom splash-bg uk-height-viewport">

            {{ $slot }}
        </main>
    </div>

</x-layouts.main>
