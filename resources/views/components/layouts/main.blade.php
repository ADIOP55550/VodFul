<!doctype html>
<html lang="en">

<head>
    <x-head />


</head>

<body>

    @if (session('status.success'))
    <script>
        UIkit.notification({
                message: '{!! session("status.success") !!}',
                status: 'success',
                pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
                timeout: 6000
            });
    </script>
    @endif
    @if (session('status') && gettype(session('status')) == 'string')
    <script>
        UIkit.notification({
                message: '{!! session("status") !!}',
                status: 'primary',
                pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
                timeout: 6000
            });
    </script>
    @endif
    @if (session('status.info'))
    <script>
        UIkit.notification({
                message: '{!! session("status.info") !!}',
                status: 'primary',
                pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
                timeout: 6000
            });
    </script>
    @endif
    @if (session('status.warning'))
    <script>
        UIkit.notification({
                message: '{!! session("status.warning") !!}',
                status: 'warning',
                pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
                timeout: 6000
            });
    </script>
    @endif
    @if (session('status.error'))
    <script>
        UIkit.notification({
                message: '{!! session("status.error") !!}',
                status: 'danger',
                pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
                timeout: 6000
            });
    </script>
    @endif

    {{$slot}}
</body>

</html>
