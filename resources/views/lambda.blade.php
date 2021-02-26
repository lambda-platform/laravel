@extends('template::paper', ['title' => 'Lambda Admin'])

@push('styles')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="/assets/lambda/fonts/flaticons/flaticons.css">
    <link rel="stylesheet" href="/assets/lambda/fonts/themify/themify-icons.css">

    <link rel="stylesheet" href="{{ asset('assets/lambda/css/dataform.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lambda/css/datagrid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lambda/css/agent.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lambda/css/krud.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/admin/css/app.css') }}">
@endpush

@section('app')
    <div id="app" class="app-wrapper"></div>
@endsection

@push('scripts')
    <script>
        window.logo = '{{config('lambda.logo')}}';
        window.init = {
            user: {!! json_encode(Auth::user()) !!},
            permissions: {!! json_encode($permissions) !!},
            cruds: {!! json_encode($cruds) !!},
            menu: {!! $menu !!},
            dbSchema: {!! json_encode($dbSchema) !!},
            gridList: {!! json_encode($gridList) !!},
            data_form_custom_elements: {!! json_encode(isset(config('lambda')['data_form_custom_elements']) ? config('lambda')['data_form_custom_elements'] : []) !!}
        }
    </script>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDJZAnIp-j3EH7HxB8wnBhszawu_yqtSsc&language=en"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>
    <script type="text/javascript" src="/vendor/echart/echarts-en.js"></script>
    <script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
    <script src="/vendor/echart/theme/macarons.js"></script>

    <script src="{{ asset('assets/lambda/js/dataform.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/datagrid-vendor.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/datagrid.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/krud.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/agent.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/page.js') }}"></script>
    <script src="{{ asset('assets/lambda/js/page-nav.js') }}"></script>
    <script src="{{ mix('assets/admin/js/app.js') }}"></script>
@endpush
