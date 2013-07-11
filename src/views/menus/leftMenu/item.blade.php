<?php $menuItem = $menuItem[0]; ?>


<li class="{{$menuItem->getClass()}} {{$menuItem->getOpen()?'open active':''}}">
@if ($menuItem->hasChildren())

    <a class="dropdown-toggle" href="{{ $menuItem->getUrl() }}">

@else

    <a href="{{ $menuItem->getUrl() }}">

@endif

        @if ($menuItem->getIcon())
            <i class="{{ $menuItem->getIcon() }}"></i>
        @elseif ($menuItem->getLvl() == 1)
            <i class="icon-double-angle-right"></i>
        @elseif ($menuItem->getLvl() > 1)
            <i class="icon-angle-right"></i>
        @endif


        @if ($menuItem->getLvl() == 0)
            <span class="menu-text">
        @endif

            {{ $menuItem->getName() }}

        @if ($menuItem->getLvl() == 0)
            </span>
        @endif


        @if ($menuItem->hasChildren())
            <b class="arrow icon-angle-down"></b>
        @endif

    </a>

        @if ($menuItem->hasChildren())

        <ul class="submenu {{ $menuItem->getChildrenClass() }}">

            {{$menuItem->getChildren()}}

        </ul>

        @endif


</li>

