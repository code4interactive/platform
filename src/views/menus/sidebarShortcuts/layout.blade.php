<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
@foreach ($menuCollection[0]->all() as $menuItem)

{{$menuItem}}

@endforeach
</div>
<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
    @foreach ($menuCollection[0]->all() as $menuItem)

    <span class="btn {{$menuItem->getClass()}}"></span>

    @endforeach
</div>



