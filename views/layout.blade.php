<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{!! \Platform::settings('general.appName', 'CODE4 Platform '.env('APP_VER', '3.0')) !!} | Dashboard</title>

    <link rel="stylesheet" href="{{ Assets::getUrl('styles/bootstrap.css') }}"/>

    <!-- Toastr style -->
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/toastr.css') }}"/>

    <!-- Gritter -->
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/jquery.gritter.css') }}"/>

    <link rel="stylesheet" href="{{ Assets::getUrl('styles/animate.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/plugins.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/theme.css') }}"/>
    <link rel="stylesheet" href="{{ Assets::getUrl('styles/main.css') }}"/>
    @section('styles')
    @show
</head>
<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        {!! \ViewHelper::userAvatar(\Auth::getUser(), 'large') !!}
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{!! \Auth::getUser()->getFirstAndLastName() !!}</strong>
                             </span> <span class="text-muted text-xs block">{!! \Auth::getUser()->job_title !!} <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        ERP
                    </div>
                </li>

                <?php \Menu::get('main')->render(); ?>

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">

            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Wyszukaj ..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                    <ul class="search-dropdown" style="display: none;">
                    </ul>
                </div>

                @include('platform::partials.top-right-menu')
            </nav>
        </div>

        @yield("page-heading")

        @yield("content")

        <?php

            //\Platform::user();
            //\Auth::getUser()

        ?>

        <?php if (false) { ?><div class="modal inmodal fade" id="qrCodeModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Skanowanie kodu</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>




        <div class="processingIndicator" style="display: none;">
            <div class="sk-spinner sk-spinner-cube-grid">
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
            </div>
        </div>
        <div class="redirectOverlay" style="display: none;">
            <div class="sk-spinner sk-spinner-cube-grid">
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
                <div class="sk-cube"></div>
            </div>
        </div>

        <div class="row">
            <div class="footer">
                <div class="pull-right">
                    @yield("footer")

                    Urządzenie - iMac - Artur Bartczak
                </div>
                <div>
                    <strong>Copyrights</strong> &copy; CODE4 Interactive 2014 - {{date("Y")}}
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Scripts variables -->
<script>
    {!! 'var currentUserId = ' . \Auth::currentUserId() !!}
</script>

<!-- Mainly scripts -->
<script src="{{ Assets::getUrl('scripts/jquery.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ Assets::getUrl('scripts/jqueryui.js') }}"></script>
<script>
    /*** Handle jQuery plugin naming conflict between jQuery UI and Bootstrap ***/
    $.widget.bridge('uibutton', $.ui.button);
    $.widget.bridge('uitooltip', $.ui.tooltip);
</script>
<script src="{{ Assets::getUrl('scripts/bootstrap.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ Assets::getUrl('scripts/theme.js') }}"></script>
<script src="{{ Assets::getUrl('scripts/plugins.js') }}"></script>
<script src="{{ Assets::getUrl('scripts/main.js') }}"></script>

<!-- QRCodeReader -->
<script src="{{ Assets::getUrl('scripts/qrreader.js') }}"></script>


@yield("scripts")

</body>
</html>
