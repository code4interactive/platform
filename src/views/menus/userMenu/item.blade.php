
<?php $menuItem = $menuItem[0]; ?>

    <li class="">
        <a href="{{ $menuItem->getUrl() }}">  
        	@if($menuItem->getIcon())
        		<i class="fa {{ $menuItem->getIcon() }}"></i> 
        	@endif
        	{{ $menuItem->getName() }} </a>
    </li>