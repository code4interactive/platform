<div id="sidebar-shortcuts-large">
@foreach ($menuCollection[0]->all() as $menuItem)

{{$menuItem}}

@endforeach
</div>
<div id="sidebar-shortcuts-mini">
    @foreach ($menuCollection[0]->all() as $menuItem)

    <span class="btn btn-success"></span>
    {{$menuItem->getClass()}}

    @endforeach
</div>



