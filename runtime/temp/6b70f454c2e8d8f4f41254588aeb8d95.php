<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"E:\wamp64\www\Ordersys\public/../application/index\view\user\header.html";i:1516086756;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/static/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Material Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="/static/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/static/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'/> -->

    <link href="/static/css/material-icons.css" rel="stylesheet" />
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="/static/img/sidebar-1.jpg">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Creative Tim
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="dashboard.html">

                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="user.html">

                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="table.html">

                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="typography.html">

                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">

                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">

                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">

                        <p>Notifications</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="showmessage.html">
                        <img src="/static/img/order.png"/>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Profile</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/static/img/logout.png"/>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/static/img/message.png"/>
                                <p class="hidden-lg hidden-md"></p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Mike John responded to your email</a></li>
                                <li><a href="#">You have 5 new tasks</a></li>
                                <li><a href="#">You're now friend with Andrew</a></li>
                                <li><a href="#">Another Notification</a></li>
                                <li><a href="#">Another One</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/static/img/person.png"/>
                                <p class="hidden-lg hidden-md"></p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>