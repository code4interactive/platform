<div class="row" style="position: relative">
    <div class="b-r"><i class="fa fa-{{$icon}} fa-2x"></i></div>
    <div style="padding:5px 20px 0 75px;">
       <ul class="unstyled" style="padding: 0">
            @foreach($itemResults as $itemResult)
                <li>{{$itemResult}}</li>
                <li class="divider"></li>
            @endforeach
            </ul>
        </div>
    </div>
<hr class="hr-line-dashed">