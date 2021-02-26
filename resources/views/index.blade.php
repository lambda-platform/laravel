<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>Example Laravel App</title>
    <link rel="stylesheet" href="{{ mix('assets/example/css/app.css') }}">
</head>
<body>

<div id="app"></div>

<script src="{{ mix('assets/example/js/manifest.js') }}"></script>
<script src="{{ mix('assets/example/js/vendor.js') }}"></script>
<script src="{{ mix('assets/example/js/app.js') }}"></script>
</body>
</html>
