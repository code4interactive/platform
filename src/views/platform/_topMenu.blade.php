@foreach ($menu['topmenu']['root'] as $lp=>$root)

<li class="{{ $root['style'] }}">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        @if ($root['icon'])
            <i class="{{ $root['icon'] }}"></i>
        @endif
        {{ $root['name'] }}
    </a>


    @if (key_exists($root['id'], $menu['topmenu']))

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer {{ isset($root['sub-style'])?($root['sub-style']):'' }}">

        @foreach ($menu['topmenu'][$root['id']] as $lp=>$sub)

        @if (key_exists('type', $sub) && $sub['type'] == 'sub-header')
        <li class="nav-header">
            @if ($sub['icon'])
                <i class="{{ $sub['icon'] }}"></i>
            @endif
            {{ $sub['name'] }}
        </li>

        @else

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">
                        @if ($sub['icon'])
                            <i class="btn btn-mini no-hover {{ $sub['icon'] }}"></i>
                        @endif

                        {{ $sub['name'] }}
                    </span>
                </div>
            </a>
        </li>

        @endif

        @endforeach

    </ul>

    @endif



</li>

@endforeach





@if (false)

<li class="grey">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-cog"></i>
        Administracja
    </a>

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
        <li class="nav-header">
            <i class="icon-ok"></i>
            4 Tasks to complete
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Software Update</span>
                    <span class="pull-right">65%</span>
                </div>

                <div class="progress progress-mini ">
                    <div style="width:65%" class="bar"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Hardware Upgrade</span>
                    <span class="pull-right">35%</span>
                </div>

                <div class="progress progress-mini progress-danger">
                    <div style="width:35%" class="bar"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Unit Testing</span>
                    <span class="pull-right">15%</span>
                </div>

                <div class="progress progress-mini progress-warning">
                    <div style="width:15%" class="bar"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Bug Fixes</span>
                    <span class="pull-right">90%</span>
                </div>

                <div class="progress progress-mini progress-success progress-striped active">
                    <div style="width:90%" class="bar"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                See tasks with details
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

<li class="purple">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-bell-alt icon-only icon-animated-bell"></i>
        <span class="badge badge-important">8</span>
    </a>

    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer">
        <li class="nav-header">
            <i class="icon-warning-sign"></i>
            8 Notifications
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-mini no-hover btn-pink icon-comment"></i>
                                                        New Comments
                                                    </span>
                    <span class="pull-right badge badge-info">+12</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="btn btn-mini btn-primary icon-user"></i>
                Bob just signed up as an editor ...
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-mini no-hover btn-success icon-shopping-cart"></i>
                                                        New Orders
                                                    </span>
                    <span class="pull-right badge badge-success">+8</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-mini no-hover btn-info icon-twitter"></i>
                                                        Followers
                                                    </span>
                    <span class="pull-right badge badge-info">+11</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                See all notifications
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

<li class="green">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-envelope-alt icon-only icon-animated-vertical"></i>
        <span class="badge badge-success">5</span>
    </a>

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
        <li class="nav-header">
            <i class="icon-envelope"></i>
            5 Messages
        </li>

        <li>
            <a href="#">
                <img src="{{ $platform['assetsPath'] }}/assets/ace/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Alex:</span>
                                                        Ciao sociis natoque penatibus et auctor ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="icon-time"></i>
                                                        <span>a moment ago</span>
                                                    </span>
                                                </span>
            </a>
        </li>

        <li>
            <a href="#">
                <img src="{{ $platform['assetsPath'] }}/assets/ace/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Susan:</span>
                                                        Vestibulum id ligula porta felis euismod ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="icon-time"></i>
                                                        <span>20 minutes ago</span>
                                                    </span>
                                                </span>
            </a>
        </li>

        <li>
            <a href="#">
                <img src="{{ $platform['assetsPath'] }}/assets/ace/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Bob:</span>
                                                        Nullam quis risus eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="icon-time"></i>
                                                        <span>3:15 pm</span>
                                                    </span>
                                                </span>
            </a>
        </li>


        <li>
            <a href="#">
                See all messages
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

@endif