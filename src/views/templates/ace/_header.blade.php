<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{\Config::get('platform::config.platformVersion')}} - {{\Config::get('platform::config.appName')}}</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--basic styles-->

    <link href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/bootstrap-responsive.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/font-awesome.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!--page specific plugin styles-->
    {{ basset_stylesheets('forms') }}

    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/css/plugins.min.css" />

    <!--fonts-->

    {{--<link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-fonts.css" />--}}
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/css/fonts.min.css" />

    <!--ace styles-->

    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace.min.css" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-skins.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-ie.min.css" />
    <![endif]-->

    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/chosen.min.css" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/css/platform.min.css" />

    <!--inline styles related to this page-->
    {{ basset_stylesheets('application') }}

    <!-- ace settings handler -->

    <script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/html5shiv.js"></script>
    <script src="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/respond.min.js"></script>
    <![endif]-->

    <!--[if !IE]>-->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>
    <!--<![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->

    <script src="{{ $platform['assetsPath'] }}/scripts/jquery-ui-1.10.3.custom.min.js"></script>

</head>

<body>