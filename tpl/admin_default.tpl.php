<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
      <!--div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div-->
      <!--p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p-->

    <?php if (LOGGED) { ?>
      
      <p>Hallo, <?php print USERNAME ?>! Вы авторизованы. <p>
      <p>Т.е. мы проверили сессию и можем открыть доступ к определенным данным.</p>
      <p><a href="<?php print SUBFOLDER_PATH ?>/admin/logout.php">Logout</a></p>
      
    <?php } ?>
    
    <?php if (!LOGGED) { ?>
      
      <p style="color:red;">You may see this string, because you are not authorized in the system. 
      Login here: <a href="<?php print SUBFOLDER_PATH ?>/admin/login.php">Login</a></p>
      
      <p>Also you may <a href="<?php print SUBFOLDER_PATH ?>/admin/register.php">register</a> in the sistem.</p>
      
    <?php } ?>

    </div>
<?php include('footer.tpl.php') ?>