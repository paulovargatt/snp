<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/vs.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
@stack('styles')
<body>
    <div id="app">
    @if (Auth::check())
        @include('menu')
    @endif

    @yield('content')
    <script src="global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="global/scripts/app.min.js" type="text/javascript"></script>
    <script src="layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
    <script src="global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
        <script src="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/pt-BR.js"></script>
        <script src="http://keenthemes.com/preview/metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/clipboardjs/clipboard.min.js" type="text/javascript"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    @stack('scripts')
   
</body>
</html>
