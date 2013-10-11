<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<!--basic scripts-->



<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/bootstrap.min.js"></script>

<!--page specific plugin scripts-->
{{ basset_javascripts('forms') }}

<!--ace scripts-->

<script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/ace-elements.min.js"></script>
<script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/ace.min.js"></script>

<!--code4 scripts-->
<script src="{{ $platform['assetsPath'] }}/scripts/helpers.js"></script>
<script src="{{ $platform['assetsPath'] }}/scripts/notifications.js"></script>
<script src="{{ $platform['assetsPath'] }}/scripts/platform.js"></script>

<script src="{{ $platform['assetsPath'] }}/scripts/tempo.js"></script>
<script src="{{ $platform['assetsPath'] }}/scripts/data-grid.js"></script>
<script src="{{ $platform['assetsPath'] }}/scripts/jquery.simplemodal.1.4.4.min.js"></script>
<script src="{{ $platform['assetsPath'] }}/scripts/jquery.gritter.min.js"></script>


<!--inline scripts related to this page-->
