<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 
 <?php 
 session_start();

 include __DIR__.'/../../config/app.php';
 include __DIR__.'/../../config/connection.php';
 include_once __DIR__.'/../../classes/User.php';
 $user = new User;
 if(!$user->isAdmin()){
    die('You are not allowed to access this pages : login with admin user to access this page');
 }
 ?>
 
 <!DOCTYPE html>

<html lang="en" >

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php  echo $config['admin_assets'] ?>img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php  echo $config['admin_assets'] ?>img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mega store</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="http://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="<?php  echo $config['admin_assets'] ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php  echo $config['admin_assets'] ?>css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php  echo $config['admin_assets'] ?>css/demo.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>

</head>
<body>

  
<div class="wrapper">
    <div class="sidebar"  data-image="<?php  echo $config['admin_assets'] ?>img/sidebar-5.jpg" data-color="blue">
                <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="main-panel ">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> <?php echo $title?> </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="<?php echo $icon?>"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                            
                            
                        </ul>
                        
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $config['app_url'] ?>">
                                    <span class="no-icon">Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="no-icon"><?php echo $_SESSION['user_name'] ?></span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $config['app_url'].'logout.php'?>">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                            <?php if($title == 'Users'): ?>
                                <li class="nav-item">
                                <a class="nav-link" href="create.php">
                                    <span class="no-icon">crate account</span>
                                </a>
                                </li>
                            <?php endif ?>    
                            <?php if($title == 'Products'): ?>
                                <li class="nav-item">
                                <a class="nav-link" href="create.php">
                                    <span class="no-icon">Crate product</span>
                                </a>
                                </li>
                            <?php endif ?>    
                            <?php if($title == 'Services'): ?>
                                <li class="nav-item">
                                <a class="nav-link" href="create.php">
                                    <span class="no-icon">Crate Service</span>
                                </a>
                                </li>
                            <?php endif ?>    

                        </ul>
                    </div>
                </div>
            </nav>
