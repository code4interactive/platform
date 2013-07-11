@include('platform::templates/ace/_header')

<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="#" class="brand">
                <small>
                    <i class="icon-cogs"></i>
                    CODE4 Platform
                </small>
            </a><!--/.brand-->


            <ul class="nav ace-nav pull-right">

                {{Menu::topMenu()}}

                @include('platform::platform._notifications')

                {{-- $userProfile --}}

                <li class="light-blue user-profile">

                    @include('platform::platform._usernav')

                </li>

            </ul><!--/.ace-nav-->

            <div class="pull-right code4-time" data-color="#fff" data-size="35" data-percent="0">
                <span class="time">{{ date("H:i") }}</span>
            </div>

            <div class="pull-right code4-date">
                {{ date("l") }}<br/>
                {{ date("d M Y")}}
            </div>

        </div><!--/.container-fluid-->
    </div><!--/.navbar-inner-->
</div>

<div class="main-container container-fluid">
    <a id="menu-toggler" href="#">
        <span class="menu-text"></span>
    </a>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            {{Menu::sidebarShortcuts()}}
        </div><!--#sidebar-shortcuts-->

        <ul class="nav nav-list">
            {{Menu::leftMenu()}}
        </ul>

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">

            {{Menu::breadcrumbs()}}

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
                        <i class="icon-search" id="nav-search-icon"></i>
                    </span>
                </form>
            </div><!--#nav-search-->
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

            <div class="row-fluid">
                <div class="span12">
                <!--PAGE CONTENT BEGINS HERE-->

                @yield('content')

                <!--PAGE CONTENT ENDS HERE-->
                </div>
            </div><!--/row-->
        </div><!--/#page-content-->


    </div><!--/#main-content-->
</div><!--/.fluid-container#main-container-->

<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
@include('platform::templates/ace/_footer')

@section('footer-scripts')

@show

</body>
</html>
