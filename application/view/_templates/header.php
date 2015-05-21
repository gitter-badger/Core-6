<!DOCTYPE html>
<html>

<meta charset="utf-8" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo Config::get('SITE_NAME') ?></title>

<link href="<?php echo URL; ?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo URL; ?>css/styles.css" rel="stylesheet">
<link href="<?php echo URL; ?>css/jquery.bootgrid.css" rel="stylesheet"/>
<link href="<?php echo URL; ?>font-awesome/css/font-awesome.css" rel="stylesheet">


<!--[if lt IE 9]>
<script src="<?php echo URL; ?>js/html5shiv.js"></script>
<script src="<?php echo URL; ?>js/respond.min.js"></script>
<![endif]-->
<?php if (Config::get('CASTLE_ENABLED')) { ?>
    <script type="text/javascript">
        (function (e, t, n, r) {
            function i(e, n) {
                e = t.createElement("script");
                e.async = 1;
                e.src = r;
                n = t.getElementsByTagName("script")[0];
                n.parentNode.insertBefore(e, n)
            }

            e[n] = e[n] || function () {
                (e[n].q = e[n].q || []).push(arguments)
            };
            e.attachEvent ? e.attachEvent("onload", i) : e.addEventListener("load", i, false)
        })(window, document, "_castle", "//d2t77mnxyo7adj.cloudfront.net/v1/c.js");
        _castle('setAccount', '<?php echo Config::get('CASTLE_ID'); ?>');
        <?php if(Session::get('user_logged_in')) { ?>
        _castle('setUser', {
            id: <?php echo Session::get('user_id'); ?>, // required
            name: '<?php echo Session::get('user_name'); ?>', // optional
            email: '<?php echo Session::get('user_email')?>' // optional
        });
        <?php } ?>
        _castle('trackPageview');
    </script>
<?php } ?>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>"><span>Inventory </span>Tracker</a>
            <ul class="user-menu">
                <li class="dropdown pull-right"><!--
					    <?php if (Session::userIsLoggedIn()) : ?>
					    		
					    		Hello <?php echo Session::get('user_name'); ?>!
				                </div>
				                <div class="avatar">
				                    <?php if (Config::get('USE_GRAVATAR')) { ?>
				                        <img src='<?php echo Session::get('user_gravatar_image_url'); ?>'
				                             style='width:<?php echo Config::get('AVATAR_SIZE'); ?>px; height:<?php echo Config::get('AVATAR_SIZE'); ?>px;' />
				                    <?php } else { ?>
				                        <img src='<?php echo Session::get('user_avatar_file'); ?>'
				                             style='width:<?php echo Config::get('AVATAR_SIZE'); ?>px; height:<?php echo Config::get('AVATAR_SIZE'); ?>px;' />
				                    <?php } ?>
				                </div>-->
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">Hello, <?php echo Session::get('user_name'); ?>! <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo URL; ?>login/showprofile/<?php echo Session::get('user_name'); ?> "><span
                                    class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="<?php echo URL; ?>lock/"><span class="glyphicon glyphicon-lock"></span> Lock sessie</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>login/logout">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>

    </div>
    <!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li <?php if (View::checkForActiveController($filename, "dashboard")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo URL; ?>dashboard"><span class="glyphicon glyphicon-dashboard"></span>Dashboard</a>
        </li>
        <li <?php if (View::checkForActiveController($filename, "overview")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo URL; ?>overview"><span class="glyphicon glyphicon-list"></span>Overview</a>
        </li>
        <li <?php if (View::checkForActiveControllerAndAction($filename, "utilization/status")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo URL; ?>utilization/status"><span class="glyphicon glyphicon-copy"></span>Status</a>
        </li>
        <li <?php if (View::checkForActiveControllerAndAction($filename, "utilization/index")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo URL; ?>utilization"><span class="glyphicon glyphicon-copy"></span>Usage</a>
        </li>
        <li <?php if (View::checkForActiveControllerAndAction($filename, "utilization/count")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo URL; ?>utilization/count"><span class="glyphicon glyphicon-copy"></span>Count</a>
        </li>
        <?php if (Session::get('user_account_type') >= 2) { ?>
            <li <?php if (View::checkForActiveController($filename, "log")) {
                echo ' class="active" ';
            } ?> >
                <a href="<?php echo URL; ?>log"><span class="glyphicon glyphicon-copy"></span>Log</a>
            </li>
        <?php } ?>

        <li role="presentation" class="divider"> Administrative Sectie</li>
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-list"></span> User Settings <span data-toggle="collapse"
                                                                                   href="#sub-item-1"
                                                                                   class="icon pull-right"><em
                        class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="#">
                        <span class="glyphicon glyphicon-share-alt"></span> Change Email
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <span class="glyphicon glyphicon-share-alt"></span> User profile
                    </a>
                </li>
            </ul>
        </li>
        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/register")) {
            echo ' class="active" ';
        } ?>>
            <a href="<?php echo URL; ?>login/register"><span class="glyphicon glyphicon-copy"></span>Registreer</a>
        </li>
    </ul>
    <div class="attribution">
        <ul style="list-style-type: none;">
            <li>&copy; <?php echo Config::get('SITE_NAME') ?></li>
            <li><br></li>
            <li>Versie: (Official)<br>
                <img src="https://img.shields.io/github/release/TrackingTeam/Inventory-Track.svg?style=flat-square">
            </li>
            <li>Website score:<br>
                <img src="https://img.shields.io/scrutinizer/g/TrackingTeam/Inventory-Track.svg?style=flat-square">
            </li>
            <li>Compile Status: <br>
                <img
                    src="https://img.shields.io/scrutinizer/build/g/TrackingTeam/Inventory-Track.svg?style=flat-square">
            </li>
            <li>Openstaande problemen:<br>
                <img src="https://img.shields.io/github/issues/TrackingTeam/Inventory-Track.svg?style=flat-square">
            </li>
        </ul>
    </div>
</div>
<!--/.sidebar-->