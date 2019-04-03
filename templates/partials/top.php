<!DOCTYPE html>
<?php if(isset($app)):?>
<html lang="en" ng-app="<?php echo $app;?>">
<?php else:?>
<html lang="en">
<?php endif;?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CHANNEL ONE</title>

    <link href="<?php echo BASE_URL;?>assets/css/framework-<?php echo $version;?>.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>assets/css/c1-<?php echo $version;?>.min.css" rel="stylesheet">

</head>
<body>
<input type="hidden" id="base_url" value="<?php echo BASE_URL;?>">
<?php if(!$hide_top_nav):?>
    <nav class="navbar navbar-static-top navbar-inverse" ng-controller="TopController as topCntrl">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo BASE_URL;?>" id="c1-home-btn">Channel One</a></li>
            </ul>
            <div class="navbar-right navbar-form">
                    <label class="text-warning">View As:</label>
                    <select ng-change="topCntrl.switchViewUser()" class="form-control" ng-model="topCntrl.viewUser"
                            ng-options="user as user.name.last+', '+user.name.first for user in topCntrl.users">
                        <option value=""> -- </option>
                    </select>
            </div>

            <div class="navbar-right">
                <ul class="nav navbar-nav" id="main-nav">
                    <li data-link="dashboard"><a href="<?php echo BASE_URL;?>#/" data-target="dashboard">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a></li>
                    <li data-link="search"><a href="<?php echo BASE_URL;?>#/search" data-target="search">
                            <i class="fa fa-search"></i> Search
                        </a></li>
                    <li data-link="leads"><a href="<?php echo BASE_URL;?>#/leads" data-target="leads">
                            <i class="fa fa-tags"></i> Leads
                        </a></li>
                    <li data-link="pipeline"><a href="<?php echo BASE_URL;?>#/pipeline" data-target="pipeline">
                            <i class="fa fa-rocket"></i> Pipeline
                        </a></li>
                    <li data-link="admin"
                        ng-if="topCntrl.seeAdmin">
                        <a data-target="#admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-star"></i> Admin <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li ng-if="topCntrl.seeAllUsers"><a class="pointer" href="<?php echo BASE_URL;?>#/admin/dashboard">Dashboard</a></li>
                            <li><a class="pointer" href="<?php echo BASE_URL;?>#/admin/leads">Lead Management</a></li>
                            <li ng-if="topCntrl.seeAllUsers"><a class="pointer" href="<?php echo BASE_URL;?>#/admin/users">User Management</a></li>
                            <li ng-if="topCntrl.seeAllUsers"><a class="pointer" href="<?php echo BASE_URL;?>#/admin/teams">Team Management</a></li>
                        </ul>
                    </li>
                    <li>
                        <a data-target="#profile" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user"></i> {{topCntrl.currUser.name.first}} {{topCntrl.currUser.name.last}} <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="pointer" href="<?php echo BASE_URL;?>logout">Sign Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
<?php endif;?>
<?php if(isset($controller)):?>
<div id="c-wrapper" ng-controller="<?php echo $controller;?> as cntrl">
    <?php else:?>
    <div id="c-wrapper">
<?php endif;?>