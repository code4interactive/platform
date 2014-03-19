
<?php $menuItem = $menuItem[0]; ?>



    <li class="">

        <a href="{{ $menuItem->getUrl() }}" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> {{ $menuItem->getIcon() }} <span>{{ $menuItem->getName() }} <span class="label pull-right bg-color-darken {{$menuItem->getClass()}}">14</span></span> </span> </a>


    </li>
