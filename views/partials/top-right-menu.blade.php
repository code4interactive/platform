<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown profile-menu-badge ">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <strong class="font-bold">{!! \Auth::getUser()->getFirstAndLastName() !!}</strong> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu m-t-xs">
            <?php \Menu::get('profile')->render('menu::dropdown'); ?>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i>  <span class="label label-warning">1</span>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <div class="dropdown-messages-box">
                    <a href="profile.html" class="pull-left">
                        {!! \ViewHelper::userAvatar(\Auth::getUser(), 'medium') !!}
                    </a>
                    <div class="media-body">
                        <small class="pull-right">46h ago</small>
                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                    </div>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <div class="text-center link-block">
                    <a href="mailbox.html">
                        <i class="fa fa-envelope"></i> <strong>Przeczytaj wszystkie wiadomości</strong>
                    </a>
                </div>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>  <span class="label label-primary">1</span>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-gear fa-fw"></i> Produkcja P/121231/12/2015 ukończona.
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <div class="text-center link-block">
                    <a href="notifications.html">
                        <strong>Zobacz wszystkie powiadomienia</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </li>
        </ul>
    </li>


    <li>
        <a href="/logout">
            <i class="fa fa-sign-out"></i> Wyloguj
        </a>
    </li>
</ul>