<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php print_r(\Config::get('platform::platform'));?></title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--basic styles-->

    <link href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/font-awesome.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!--page specific plugin styles-->

    <!--fonts-->

    {{--<link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-fonts.css" />--}}
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/css/fonts.min.css" />

    <!--ace styles-->

    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace.min.css" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-responsive.min.css" />
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-skins.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ $platform['assetsPath'] }}/{{ $platform['templatePath'] }}/css/ace-ie.min.css" />
    <![endif]-->

    <!--inline styles related to this page-->
</head>

<body>