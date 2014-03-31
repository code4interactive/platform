<?php $menuItem = $menuItem[0]; ?>

@if($menuItem->getIcon()) 
	<i class="fa {{ $menuItem->getIcon() }}"></i>
@else
{{ $menuItem->getName() }}
@endif