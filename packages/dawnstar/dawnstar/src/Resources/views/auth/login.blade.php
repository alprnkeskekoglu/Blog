<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Dawnstar</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="{{asset('vendor/dawnstar/assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('vendor/mediapress/assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendor/mediapress/assets/media/favicons/apple-touch-icon-180x180.png')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{asset('vendor/dawnstar/assets/css/dashmix.min.css')}}">
</head>
<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('{{asset('vendor/dawnstar/assets/media/photos/photo19@2x.jpg')}}');">
            <div class="row no-gutters justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <div class="mb-2 text-center">
                                <a class="link-fx font-w700 font-size-h1" href="index.html">
                                    <span class="text-dark">Dawns</span><span class="text-primary">star</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                            </div>
                            @if(count($errors->all()) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <ul>
                                            <li>{!! $error !!}</li>
                                        </ul>
                                    @endforeach
                                </div>
                            @endif
                            <form class="js-validation-signin" action="{!! route('panel.login') !!}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="login-email" name="email" placeholder="E-mail">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{asset('vendor/dawnstar/assets/js/dashmix.core.min.js')}}"></script>
<script src="{{asset('vendor/dawnstar/assets/js/dashmix.app.min.js')}}"></script>
<script src="{{asset('vendor/dawnstar/assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendor/dawnstar/assets/js/pages/op_auth_signin.min.js')}}"></script>
</body>
</html>
