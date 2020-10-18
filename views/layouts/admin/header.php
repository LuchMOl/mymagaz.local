<?php

namespace app\views\layouts\admin;

use app\services\UserService;

$userService = new UserService();
$curentUser = $userService->getCurrentUser();
?>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRM</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Raleway:400,300,500,700,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" type="text/css">
        <!-- Theme Stylesheet -->
        <link rel="stylesheet" href="/css/adminStyle.css">
        <link rel="stylesheet" href="/css/adminResponsive.css">
    </head>
    <body>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <br><span style="color: white"><?= $curentUser->getGreeting(); ?></span>
                    </div>
                    <div class="col-md-6">
                        <div class="action pull-right">
                            <ul>
                                <li><a href="/user/signin/"><i class="fa fa-user"></i> Login</a></li>
                                <li><a href="/user/register/"><i class="fa fa-lock"></i> Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation">
            <nav class="navbar navbar-theme">
                <div class="container">
                    <div class="shop-category nav navbar-nav navbar-left">
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Products <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/product/catalog/">Catalog</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/product/createNew/">Create</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="shop-category nav navbar-nav navbar-left">
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/category/showAll/">Show All</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/category/createNew/">Create</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/category/showAll/?show=topMenu">Top Menu List</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-category nav navbar-nav navbar-left">
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Currency <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/currency/">Show All</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/currency/createNew/">Create</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--
                                        <div class="shop-category nav navbar-nav navbar-left">
                    <!-- Single button ->
                    <div class="btn-group">
                        <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            colors <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/color/showAll/">Show All</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/color/createNew/">Create</a></li>
                        </ul>
                    </div>
                </div>
                <div class="shop-category nav navbar-nav navbar-left">
                    <!-- Single button ->
                    <div class="btn-group">
                        <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sizes <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/size/showAll/">Show All</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/size/createNew/">Create</a></li>
                        </ul>
                    </div>
                </div>-->
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="/tasks/">Tasks</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>