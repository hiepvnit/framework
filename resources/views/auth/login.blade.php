<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mage2 Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/mage2-admin/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-8" style="max-width: 650px">
        <div class="card card-default">
            <div class="card-header"><span>Mage2 Admin Login</span></div>
            <div class="card-body" >
                <form method="POST" action="{{ route('admin.login.post') }}">
                    {{ csrf_field(  ) }}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">{{ __('mage2-user-auth::lang.email-address') }}</label>
                        <input id="email" type="email" name="email" class="form-control"
                               value="{{ old('email') }}" autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">{{ __('mage2-user-auth::lang.password') }}</label>
                        <input id="password" class="form-control" type="password" name="password"/>

                        @if ($errors->has('password'))
                            <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="checkbox">
                        <label>
                            <input id="rememberme" type="checkbox"
                                   name="remember"/> {{ __('mage2-user-auth::lang.remember-me') }}
                        </label>
                    </div>

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">
                            {{ __('mage2-user-auth::lang.login') }}
                        </button>

                        <a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                            {{ __('mage2-user-auth::lang.forgot-your-password') }}
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Scripts -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('vendor/mage2-admin/bootstrap4/js/jquery-3.2.1.slim.min.js') }}"></script>
</body>
</html>
