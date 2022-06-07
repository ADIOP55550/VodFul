<!doctype html>
<html lang="en">

<head>
    <x-head />


</head>

<body>

    <div class="uk-position-z-index uk-position-a">

        @if (session('status.success'))
        <script>
            UIkit.notification({
                message: '{!! session("status.success") !!}',
                status: 'success',
                pos: 'top-right',
                timeout: 6000
            });
        </script>
        @endif
        @if (session('status.info'))
        <script>
            UIkit.notification({
                message: '{!! session("status.info") !!}',
                status: 'primary',
                pos: 'top-right',
                timeout: 6000
            });
        </script>
        @endif
        @if (session('status.warning'))
        <script>
            UIkit.notification({
                message: '{!! session("status.warning") !!}',
                status: 'warning',
                pos: 'top-right',
                timeout: 6000
            });
        </script>
        @endif
        @if (session('status.error'))
        <script>
            UIkit.notification({
                message: '{!! session("status.error") !!}',
                status: 'danger',
                pos: 'top-right',
                timeout: 6000
            });
        </script>
        @endif
    </div>

    {{$slot}}
</body>

</html>
