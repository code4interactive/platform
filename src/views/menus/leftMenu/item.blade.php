<?php $menuItem = $menuItem[0]; ?>



    <li class="{{$menuItem->getClass()}}">

        @if ($menuItem->getLvl() == 0)
            <a href="{{ $menuItem->getUrl() }}">{{ $menuItem->getIcon() }} <span class="menu-item-parent">{{ $menuItem->getName() }}</span></a>
        @else
            <a href="{{ $menuItem->getUrl() }}">{{ $menuItem->getIcon() }} {{ $menuItem->getName() }}</a>
        @endif

        @if ($menuItem->hasChildren())
        <ul>
            {{$menuItem->getChildren()}}
        </ul>
        @endif;
    </li>


