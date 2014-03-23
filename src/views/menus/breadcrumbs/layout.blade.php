<?php if (false) { ?>
<ul class="breadcrumb">

@foreach ($menuCollection[0]->all() as $menuItem)

    @if ($menuItem->isActive())
        <li class="active">
    @else
        <li>
    @endif

    @if ($menuItem->getIcon())
        <i class="{{ $menuItem->getIcon() }}"></i>
    @endif

    @if (!$menuItem->isActive())
        <a href="{{$menuItem->getUrl()}}">
    @endif

    {{$menuItem}}

    @if (!$menuCollection[0]->isLast($menuItem))
        <span class="divider">
            <i class="icon-angle-right"></i>
        </span>
    @endif


    @if (!$menuItem->isActive())
        </a>
    @endif

    </li>

@endforeach

</ul><!--.breadcrumb-->
<?php } ?>

<ol class="breadcrumb">
    @foreach ($menuCollection[0]->all() as $menuItem)
    <li>{{$menuItem}}</li>
    @endforeach
</ol>