<!DOCTYPE html>
<!--
01000010 01001001 01010100 01010011 01101111 01100110 01110100
          ____ _____ _______ _____        __ _
         |  _ \_   _|__   __/ ____|      / _| |
         | |_) || |    | | | (___   ___ | |_| |_
         |  _ < | |    | |  \___ \ / _ \|  _| __|
         | |_) || |_   | |  ____) | (_) | | | |_
         |____/_____|  |_| |_____/ \___/|_|  \__|

01000010 01001001 01010100 01010011 01101111 01100110 01110100
-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Барилга Хот Байгуулалтын Яам</title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="/assets/mcud/images/logo.png"></link>
    <!-- External CSS libraries -->
    <link href="/assets/mcud/fonts/themify/themify-icons.css" rel="stylesheet">
    <link href="/assets/mcud/lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="/assets/mcud/lib/select2/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/mcud/lib/element-ui/theme-chalk/index.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ mix('assets/mcud/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/iview@3.5.4/dist/styles/iview.css">
    <link rel="stylesheet" href="{{ mix('assets/lambda/css/datagrid.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/mcud/css/app.css')}}">

</head>
<body class="dashboard-5">
<div id="app"></div>
<script>
    window.init = {
        user: {!! json_encode($user) !!},
        menu: {!! json_encode($menu) !!},
        data: {!! json_encode($data) !!},
        durem: {!! json_encode($durem) !!},
        medee: {!! json_encode($medee) !!},
        properties: {!! json_encode($properties) !!},
    }
    {{--localStorage.setItem('user', JSON.stringify({!! $user==null?false:$user !!}));--}}
</script>
<!-- External JS libraries -->
<script src="/assets/mcud/js/jquery.js"></script>
<script src="/assets/mcud/js/popper.js"></script>
<script src="/assets/mcud/js/bootstrap.js"></script>
<script src="/assets/mcud/js/jquery.cookie.js"></script>
<script src="/assets/mcud/lib/d3/js/d3.js"></script>
<script src="/assets/mcud/lib/rickshaw/js/rickshaw.min.js"></script>
<script src="/assets/mcud/js/Chart.js"></script>

<script src="/assets/mcud/js/slim.js"></script>
<script src="/assets/mcud/js/ResizeSensor.js"></script>
{{----}}
<script src="/assets/mcud/lib/select2/js/select2.full.min.js"></script>
<script src="/assets/mcud/js/jquery.chained.min.js"></script>
{{----}}
<script type="text/javascript" src="/vendor/echart/echarts-en.js"></script>
<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
<script src="/vendor/echart/theme/macarons.js"></script>

<script src="{{ mix('assets/mcud/js/manifest.js') }}"></script>
<script src="{{ mix('assets/mcud/js/vendor.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/view-design/dist/iview.min.js"></script>
<script src="{{ mix('assets/mcud/js/app.js') }}"></script>
<script src="{{ mix('assets/lambda/js/datagrid-vendor.js') }}"></script>
<script src="{{ mix('assets/lambda/js/datagrid.js') }}"></script>
</body>
</html>
