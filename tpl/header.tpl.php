<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php print SUBFOLDER_PATH ?>/favicon.ico">

    <title><?php print !empty($curr_page_title)?$curr_page_title:'' ?> | TM Course</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php print SUBFOLDER_PATH ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php print SUBFOLDER_PATH ?>/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="<?php print SUBFOLDER_PATH ?>/css/signin.css" rel="stylesheet">
    <link href="<?php print SUBFOLDER_PATH ?>/css/custom-tmcms.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php #print SUBFOLDER_PATH ?>/js/assets/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="<?php #print SUBFOLDER_PATH ?>/js/assets/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <script>
    /* ==============================================
        Do Not Output Banner Iframe for admin part: '/banners', '/admin'
    =============================================== */
    var pathname = window.location.pathname; // '/tm-cms/' | '/tm-cms/index.php' |  '/tm-cms/banners/list.php'
    
    html = '<iframe id="banner" src="<?php print SUBFOLDER_PATH ?>/banners/banner.php" '
      + 'frameborder="1"  width="100%" height="100px" scrolling="yes" '
      + '>Your browser does not support iframes!</iframe>';
      
    if (pathname.indexOf('/banners') == -1 && pathname.indexOf('/admin') == -1) {
      document.write(html);
    }
    </script>
    
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default"><!--rc navbar-fixed-top-->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php print SUBFOLDER_PATH ?>/">TM Course</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php print SUBFOLDER_PATH ?>/">Home</a></li>
            
            <li><a href="<?php print SUBFOLDER_PATH ?>/products.php">Products</a></li>
            <li><a href="<?php print SUBFOLDER_PATH ?>/templates.php">Search</a></li>
            <li><a href="<?php print SUBFOLDER_PATH ?>/category/">Categories</a></li>
            <li><a href="<?php print SUBFOLDER_PATH ?>/contact_us.php">Contact Us</a></li>
            
            <?php if (LOGGED) { ?>
            <li><a href="<?php print SUBFOLDER_PATH ?>/banners/list.php">Banners</a></li>
            <?php } ?>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php print SUBFOLDER_PATH ?>/other/about.php">About</a></li>
                <li><a href="<?php print SUBFOLDER_PATH ?>/other/twitter-bootstrap.php">TB Page</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Other</li>
                <li><a href="#">Test link</a></li>
                <li><a href="#">Test link</a></li>
                <li><a href="<?php print SUBFOLDER_PATH ?>/other/description/">Description files</a></li>
              </ul>
            </li>
            
            <?php if (false == LOGGED) { ?>
            <li><a href="<?php print SUBFOLDER_PATH ?>/admin/login.php">Login</a></li>
            <?php } ?>
            
            <?php if (LOGGED) { ?>
            <li><a href="<?php print SUBFOLDER_PATH ?>/admin/logout.php">Logout</a></li>
            <?php } ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>