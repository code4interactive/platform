@include('platform::templates/ace/_header')

<div class="navbar navbar-inverse">
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

            <div class="pull-right easy-pie-chart percentage code4-time" data-color="#fff" data-size="35" data-percent="0">
                <span class="time">{{ date("H:i") }}</span>
            </div>

            <div class="pull-right code4-date">
                {{ date("l") }}<br/>
                {{ date("d M Y")}}
            </div>

        </div><!--/.container-fluid-->
    </div><!--/.navbar-inner-->
</div>

<div class="container-fluid" id="main-container">
<a id="menu-toggler" href="#">
    <span></span>
</a>

<div id="sidebar">
    <div id="sidebar-shortcuts">
        <div id="sidebar-shortcuts-large">
            <button class="btn btn-small btn-success">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-small btn-info">
                <i class="icon-pencil"></i>
            </button>

            <button class="btn btn-small btn-warning">
                <i class="icon-group"></i>
            </button>

            <button class="btn btn-small btn-danger">
                <i class="icon-cogs"></i>
            </button>
        </div>

        <div id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!--#sidebar-shortcuts-->

    <ul class="nav nav-list">
        {{Menu::leftMenu()}}
    </ul>

    <div id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>

<div id="main-content" class="clearfix">
<div id="breadcrumbs">

    {{--Platform::getView()->getBreadcrumbs()--}}
    {{Menu::breadcrumbs()}}
    <div id="nav-search">
        <form class="form-search">
			<span class="input-icon">
				<input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
				<i class="icon-search" id="nav-search-icon"></i>
			</span>
        </form>
    </div><!--#nav-search-->
</div>

<div id="page-content" class="clearfix">
<div class="page-header position-relative">
    <h1>
        Dashboard
        <small>
            <i class="icon-double-angle-right"></i>
            overview &amp; stats
        </small>
    </h1>
</div><!--/.page-header-->

<div class="row-fluid">
<!--PAGE CONTENT BEGINS HERE-->

@yeld('content')

<!--PAGE CONTENT ENDS HERE-->
</div><!--/row-->
</div><!--/#page-content-->


</div><!--/#main-content-->
</div><!--/.fluid-container#main-container-->

<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
@include('platform::templates/ace/_footer')