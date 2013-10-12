<?php $menuItem = $menuItem[0]; ?>
<a class="btn btn-small {{ $menuItem->getClass() }} code4-btn-icon-only"
   data-rel="tooltip"
   data-placement="bottom"
   title=""
   data-original-title="{{ $menuItem->getName() }}"
   href="{{ $menuItem->getUrl() }}">
    <i class="{{ $menuItem->getIcon() }}"></i>
</a>
