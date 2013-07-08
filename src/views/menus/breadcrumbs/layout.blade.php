
<ul class="breadcrumb">

@foreach ($menuCollection[0]->all() as $menuItem)

    @if ($menuItem->isActive())
    <li class="active">
        @else
    <li>
        @endif

{{$menuItem}}



@if (!$menuCollection[0]->isLast($menuItem))
    <span class="divider">
        <i class="icon-angle-right"></i>
    </span>
@endif

    </li>

@endforeach

</ul><!--.breadcrumb-->