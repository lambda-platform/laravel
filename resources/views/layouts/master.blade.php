<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Шинэ орон сууцны төвлөрсөн мэдээллийн сан">
    <meta name="author" content="Тэнхлэг Зууч">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>Барилга Хот Байгуулалтын Яам</title>
    <!-- vendor css -->
    <link href="/fonts/themify/themify-icons.css" rel="stylesheet">
    <link href="/lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/front/css/app.css">
    <link rel="stylesheet" href="/front/css/tz.css">
    @stack('style')
</head>
<body class="dashboard-5">
@include('layouts.header')
@yield('page')
@include("layouts.footer")


<div id="loginModal" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
            <div class="modal-body pd-0">
                <div class="signin-box signup">
                    <h2 class="slim-logo">
                        <img src="/img/mcud-logo.png" height="60" alt="">
                    </h2>
                    <h3 class="signin-title-primary">Сайтад нэвтрэх!</h3>
                    <h5 class="signin-title-secondary lh-4 tx-14">Та өөрийн бүртгэл болон сошиал хаягаар нэвтэрнэ
                        үү</h5>
                    <form action="/customer/login" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="login" name="login" class="form-control pd-y-12" placeholder="Нэвтрэх нэр">
                        </div>
                        <div class="form-group mg-b-20">
                            <input type="password" name="password" class="form-control pd-y-12" placeholder="Нууц үг">
                        </div>
                        <button type="submit" class="btn btn-primary pd-y-12 btn-block">Нэвтрэх</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/lib/jquery/js/jquery.js"></script>
<script src="/lib/popper.js/js/popper.js"></script>
<script src="/lib/bootstrap/js/bootstrap.js"></script>
{{--<script src="/lib/jquery.cookie/js/jquery.cookie.js"></script>--}}
<script src="/lib/d3/js/d3.js"></script>
<script src="/lib/rickshaw/js/rickshaw.min.js"></script>
<script src="/lib/chart.js/js/Chart.js"></script>

<script src="/front/js/slim.js"></script>
<script src="/front/js/ResizeSensor.js"></script>
@stack('script')
<script>
    $(function () {

                });
    </script>
</body>
</html>
