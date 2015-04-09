<?php include('header.tpl.php') ?>

    <!-- Begin page content -->
    <div class="container">
      <!--div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div-->
      <!--p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p-->
      
      <p>Here you can:</p>
      <ul>
        <li>View such Dunny Pages as: Search,  Categories,   Contact Us</li>
        <li>View static list of products and link each of them</li>
        <li>View random banner on each page, naturally if that banner or banners exist for that page and has active status to display</li>
      </ul>
      
      <?php if (false == LOGGED) { ?>
      <p>Also you may <a href="<?php print SUBFOLDER_PATH ?>/admin/default.php">login</a> or 
        <a href="<?php print SUBFOLDER_PATH ?>/admin/register.php">register</a> to get some additional possibilities<p>
      <?php } ?>
      
      <?php if (LOGGED) { ?>
      <p>Now you are logged at site as <?php print USERNAME ?>. And you can:</p>
      <ul>
        <li>View <a href="<?php print SUBFOLDER_PATH ?>/banners/list.php">list of your banners</a>. 
          And naturally, create new banners, modify it, customize behavior and delete it, if you need.</li>
        <li>You may <a href="">logout</a> to return standard mode, and then login again in another registered user.</li>
      </ul>
      <?php } ?>
      
    </div>

<?php include('footer.tpl.php') ?>