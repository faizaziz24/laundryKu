<!DOCTYPE html>
<html lang="en">
    <!-- Template Head-->
    <head>
      <base href="./">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
      <meta name="author" content="Łukasz Holeczek">
      <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
      <title><?php echo $pageTitle; ?></title>
      <!-- Icons-->
      <link href="<?php echo base_url(); ?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
      <script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
      <!-- Main styles for this application-->
      <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
      <!-- Global site tag (gtag.js) - Google Analytics-->
      <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
      <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
      </script>
      <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
          dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
      </script>
    </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>dashboard">
        <img class="navbar-brand-full" src="<?php echo base_url(); ?>assets/img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="<?php echo base_url(); ?>assets/img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-bell"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Last Login : <?= empty($last_login) ? "First Time Login" : $last_login; ?></strong>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="<?php echo base_url(); ?>profile">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>logout">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
        <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
                <i class="nav-icon icon-speedometer"></i> Dashboard
              </a>
            </li>
            <?php
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
            {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>userlist">
                <i class="nav-icon icon-user"></i> Data User</a>
            </li>
            <li class="nav-title">Inquires</li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>finishedorderlist">
                <i class="nav-icon icon-layers"></i>Finished Order</a>
            </li> 
            <?php
            }
            if($role == ROLE_EMPLOYEE)
            {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>customerlist">
                <i class="nav-icon icon-people"></i> Data Customer</a>
            </li>
            <li class="nav-title">Transanction</li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>addorder">
                <i class="nav-icon icon-basket"></i> Transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>orderlist">
                <i class="nav-icon icon-basket-loaded"></i> Order List</a>
            </li>        
            <?php
            }
            if($role == ROLE_ADMIN)
            {
            ?>            
            <li class="nav-title">Inquires</li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>finishedorderlist">
                <i class="nav-icon icon-layers"></i>Finished Order</a>
            </li>    
            <li class="nav-title">Maintance</li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>servicelist">
                <i class="nav-icon icon-puzzle"></i> Service</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>stagelist">
                <i class="nav-icon icon-tag"></i> Stage</a>
            </li>
            <?php
            }
            ?>
          </ul>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>