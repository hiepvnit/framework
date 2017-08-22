<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mage2 Ecommerce') }}</title>


    <link href="{{ asset('vendor/mage2-admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-admin/css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-admin/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-admin/css/styles.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    @stack('styles')
</head>
<body>

<script src="{{ asset('/vendor/mage2-admin/js/jquery-3.2.1.slim.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>
<script src="{{ asset('/vendor/mage2-admin/js/popper.min.js') }}"></script>
<script src="{{ asset('/vendor/mage2-admin/js/bootstrap.min.js') }}"></script>

@include("mage2-framework::layouts.admin-nav")
<div class="container">

    <div class="col-12">
        @if(session()->has('notificationText'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                <strong>Success!</strong> {{ session()->get('notificationText') }}

            </div>
        @endif
    </div>


    @yield('content')
</div>
@include('mage2-framework::layouts.admin-footer')


<script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('/vendor/mage2-admin/js/select2.min.js') }}"></script>
@stack('scripts')


</body>
</html>
