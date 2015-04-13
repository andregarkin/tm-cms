<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
      <!--div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div-->
      <!--p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p-->

    <?php if (LOGGED) { ?>
      
      <p>Hallo, <strong><?php print USERNAME ?></strong>! Вы авторизованы. <p>
      <p>Т.е. мы проверили сессию и можем открыть доступ к определенным данным.</p>
      <p><a href="<?php print SUBFOLDER_PATH ?>/admin/logout.php">Logout</a></p>
      
    <?php } ?>
    
    <?php if (false == LOGGED) { ?>
          
      <?php if (isset($errMessage)) { ?>
      <p class="lead text-center" style="color:red;"><?php print $errMessage ?></p>
      <?php } ?>
      
      <!--p style="color:red;">Вы видите эту строку, потому что не авторизованы. Вход здесь: </p>
      <form action="login.php" method="POST">
        Логин <input name="login" type="text" value = <?php #print $objSession->cookLogin ?>><br>
        Пароль <input name="password" type="password"><br>
        <input name="submit" type="submit" value="Войти">
      </form-->
      
      <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        
        <!--label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required/-->
        
        <label for="inputLogin" class="sr-only">Login</label>
        <input name="login" type="text" id="inputLogin" class="form-control" 
          value="<?php print $objSession->cookLogin ?>" 
          placeholder="Your login" required autofocus/>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required/>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"/> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      
    <?php } ?>

    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>