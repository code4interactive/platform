<?php $menuItem = $menuItem[0]; ?>

@if ($menuItem->getIcon())
    <i class="{{ $menuItem->getIcon() }}"></i>
@endif

@if (!$menuItem->isActive())
    <a href="{{$menuItem->getUrl()}}">
@endif

    {{ $menuItem->getName() }}

@if (!$menuItem->isActive())
    </a>
@endif

