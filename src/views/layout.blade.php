@include('platform::templates/ace/_header')

<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-cogs"></i>
                    {{\Config::get('platform::config.platformVersion')}} - {{\Config::get('platform::config.appName')}}
                </small>
            </a><!--/.brand-->
        </div>
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                {{Menu::topMenu()}}

                <!--@include('platform::platform._notifications')-->

                {{-- $userProfile --}}

                <li class="light-blue user-profile">

                    @include('platform::platform._usernav')

                </li>

            </ul><!--/.ace-nav-->
        </div>

        <div class="pull-right code4-time" data-color="#fff" data-size="35" data-percent="0">
            <span class="time">{{ date("H:i") }}</span>
        </div>

        <div class="pull-right code4-date">
            {{ date("l") }}<br/>
            {{ date("d M Y")}}
        </div>

        <!--/.container-fluid-->
    </div><!--/.navbar-inner-->
</div>

<div class="main-container container-fluid">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">

        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                {{Menu::sidebarShortcuts()}}
            </div><!--#sidebar-shortcuts-->

            <ul class="nav nav-list">
                {{Menu::leftMenu()}}
            </ul>

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                {{Menu::breadcrumbs()}}

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="icon-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- #nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header position-relative">
                    <h1>
                        @section('header')
                        {{--Dashboard
                        <small>
                            <i class="icon-double-angle-right"></i>
                            overview &amp; stats
                        </small>--}}
                        @show
                    </h1>
                </div><!--/.page-header-->

                <div class="row">
                    <div class="col-xs-12">
                    <!--PAGE CONTENT BEGINS HERE-->

                    @yield('content')

                    <!--PAGE CONTENT ENDS HERE-->
                    </div>
                </div><!--/row-->
            </div><!--/#page-content-->


    </div><!--/#main-content-->

    </div>
</div><!--/.fluid-container#main-container-->

@include('platform::templates/ace/_footer')

@section('footer-scripts')

@show

</body>
</html>
