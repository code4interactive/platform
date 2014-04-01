<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> {{$platform['platformVersion']}} - {{$platform['appName']}} </title>
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Use the correct meta names below for your web application
			 Ref: http://davidbcalhoun.com/2010/viewport-metatag 
			 
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['assetsPath']  }}/css/fonts.css">
		<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['templatePath']}}/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['templatePath']}}/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['templatePath']}}/css/smartadmin-production.css">
		<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['templatePath']}}/css/smartadmin-skins.css">

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{ $platform['assetsPath'] }}/css/platform.css" />


		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<!--<link rel="stylesheet" type="text/css" media="screen" href="{{$platform['templatePath']}}/css/demo.css">-->

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{{$platform['templatePath']}}/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="{{$platform['templatePath']}}/img/favicon/favicon.ico" type="image/x-icon">


		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="{{$platform['templatePath']}}/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="{{$platform['templatePath']}}/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

	</head>
	<body class="">
		<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

		<!-- HEADER -->
		<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<span id="logo"> <img src="{{ $platform['assetsPath'] }}/images/logo.png" alt="SmartAdmin"> </span>
				<!-- END LOGO PLACEHOLDER -->

				<!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <!--<b class="badge"> 21 </b>--> </span>

				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/notifications.html">
							notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (4) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">

						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>

						<i class="fa fa-lock fa-4x fa-border"></i>

					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>

			<!-- projects dropdown -->
			<div id="project-context">

				<span class="label">Zalogowany użytkownik:</span>
				<span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">
					@if(Sentry::check())
					{{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}
					@else
					Gość (Niezalogowany)
					@endif
				 <i class="fa fa-angle-down"></i></span>

				<!-- Suggestion: populate this list with fetch and push technique -->
				<ul class="dropdown-menu">
	                	{{Menu::userMenu()}}
					<li class="divider"></li>
					<li>
						<a href="/logout"><i class="fa fa-power-off"></i> Wyloguj</a>
					</li>
				</ul>
				<!-- end dropdown-menu-->

			</div>
			<!-- end projects dropdown -->

			<!-- pulled right: nav area -->
			<div class="pull-right">

				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->

				<!-- logout button -->
				<!--<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="/logout" title="Wyloguj"><i class="fa fa-sign-out"></i></a> </span>
				</div>-->
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->

				<!-- input: search field -->
				<form action="#search.html" class="header-search pull-right">
					<input type="text" placeholder="Find reports and more" id="search-fld">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				<!-- end input: search field -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">

				<i class="fa fa-lg fa-fw fa-windows"></i>

				<h3>Menu</h3>

			</div>


			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->
				<ul>
                	{{Menu::leftMenu()}}
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<!-- breadcrumb -->
				{{Menu::breadcrumbs()}}
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content" class="widget-grid">

				@section('header')
					This is the master header.
				@show
                @yield('content')

			</div>
			<!-- END MAIN CONTENT -->
			
			<a href="javascript:void(0);" id="code4-loading" class="btn bg-color-purple txt-color-white font-md">
				<i class="fa fa-refresh fa-spin"></i>  Ładowanie
			</a>

		</div>
		<!-- END MAIN PANEL -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				{{Menu::shortcuts()}}
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->


		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		<script src="{{$platform['templatePath']}}/js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="{{$platform['templatePath']}}/js/notification/SmartNotification.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="{{$platform['templatePath']}}/js/smartwidgets/jarvis.widget.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="{{$platform['templatePath']}}/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="{{$platform['templatePath']}}/js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="{{$platform['templatePath']}}/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="{{$platform['templatePath']}}/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="{{$platform['templatePath']}}/js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{$platform['templatePath']}}/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="{{$platform['templatePath']}}/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="{{$platform['templatePath']}}/js/plugin/fastclick/fastclick.js"></script>

		<!--[if IE 7]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!--code4 scripts-->
		<script src="{{ $platform['assetsPath'] }}/scripts/helpers.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/jquery.cookie.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/jquery.form.min.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/notifications.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/form.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/platform.js"></script>

		<script src="{{ $platform['assetsPath'] }}/scripts/tempo.js"></script>
		<script src="{{ $platform['assetsPath'] }}/scripts/data-grid.js"></script>

		<!-- Demo purpose only -->
		<!--<script src="{{$platform['templatePath']}}/js/demo.js"></script>-->

		<!-- MAIN APP JS FILE -->
		<script src="{{$platform['templatePath']}}/js/app.js"></script>

		<script src="{{$app['packagePath']}}/scripts/translations.js"></script>
		
		<!-- PAGE RELATED PLUGIN(S) -->
		
		<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
		<script src="{{$platform['templatePath']}}/js/plugin/flot/jquery.flot.cust.js"></script>
		<script src="{{$platform['templatePath']}}/js/plugin/flot/jquery.flot.resize.js"></script>
		<script src="{{$platform['templatePath']}}/js/plugin/flot/jquery.flot.tooltip.js"></script>
		
		<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
		<script src="{{$platform['templatePath']}}/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="{{$platform['templatePath']}}/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
		
		<!-- Full Calendar -->
		<script src="{{$platform['templatePath']}}/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

		<script>
			$(document).ready(function() {
				// DO NOT REMOVE : GLOBAL FUNCTIONS!
				pageSetUp();
			});
		</script>

	</body>

</html>
