<li class="purple">
    <a data-toggle="dropdown" class="dropdown-toggle notifications-toggle" href="#">
        <i class="icon-bell-alt icon-only icon-animated-bell"></i>

        <span class="badge badge-important all-notifications">{{ Notification::all()->count() }}</span>
    </a>

    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer notifications-dropdown">
        <li class="nav-header all-notifications-header">
            <span class="pull-left">
                <i class="icon-warning-sign"></i>
                <span class="count">{{ Notification::all()->count() }}</span> Powiadomień
            </span>
            <span>&nbsp;</span>
            <span class="pull-right notification-close">
                <a href="#" class="" data-toggle="dropdown"> zamknij <i class="icon-remove-circle"></i> </a>
            </span>
        </li>


        @foreach (Notification::all() as $note)
        <?php
            $type = $note->getType();

            switch( $type ){
                case "error":
                    $btnColor = "btn-danger";
                    $txtColor = "text-error";
                    $icon = "icon-remove-sign";
                    break;
                case "success":
                    $btnColor = "btn-success";
                    $txtColor = "text-success";
                    $icon = "icon-ok-sign";
                    break;
                case "warning":
                    $btnColor = "btn-warning";
                    $txtColor = "text-warning";
                    $icon = "icon-warning-sign";
                    break;
                case "info":
                    $btnColor = "btn-info";
                    $txtColor = "text-info";
                    $icon = "icon-info-sign";
                    break;
                default:
                    $btnColor = "btn-info";
                    $txtColor = "text-info";
                    $icon = "icon-info-sign";

            }
        ?>
        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left {{ $txtColor }}">
                        <i class="btn btn-mini no-hover {{ $btnColor }} {{ $icon }}"></i>
                        {{ $note->getMessage() }}
                    </span>
                </div>
            </a>
        </li>

        @endforeach

        @if (false)
        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">
                        <i class="btn btn-mini no-hover btn-pink icon-comment"></i>
                        {{ Notification::all() }}
                    </span>
                    <span class="pull-right badge badge-info">0</span>
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


        @endif
        <li>
            <a href="#">
                See all notifications
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>