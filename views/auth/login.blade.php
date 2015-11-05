<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link rel="stylesheet" href="{{ Assets::getUrl('styles/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/animate.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/plugins.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/theme.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/main.css') }}"/>

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen">
    <div>
        <div>
            <h1 class="logo-name">ERP</h1>
        </div>
        <h3>P.P.H.U. PEGAS</h3>
        <p>Jeżeli nie masz loginu i hasła skontaktuj się z administratorem!</p>
        @if($errors->any())

            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>

        @endif
        <form class="m-t" role="form" action="/login" method="post">
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
        </form>
        <p class="m-t"> <small>CODE4 Interactive &copy; 2015</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ Assets::getUrl('scripts/jquery.js') }}"></script>
<script src="{{ Assets::getUrl('scripts/bootstrap.js') }}"></script>

</body>

</html>
