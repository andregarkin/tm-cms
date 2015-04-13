<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header text-center">
        <h1>Sign Up (Register new user)</h1>
      </div>
      <!--p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p-->

    <?php if (LOGGED) { ?>
      
      <p>Hallo, <strong><?php print USERNAME ?></strong>! Вы авторизованы. <p>
      <p>Т.е. мы проверили сессию и можем открыть доступ к определенным данным.</p>
      <p><a href="<?php print SUBFOLDER_PATH ?>/admin/logout.php">Logout</a></p>
      
    <?php } ?>
    
    <?php if (false == LOGGED) { ?>
          
      <?php if (isset($msg_register_status)) { ?>
      <p class="lead text-center <?php print $msg_class ?>"><?php print $msg_register_status ?></p>
      <?php } ?>
      
      <!--form method="POST">
        Логин <input name="login" type="text"><br>
        Пароль <input name="password" type="password"><br>
        Email <input name="email" type="email"><br>
        <input name="submit" type="submit" value="Зарегистрироваться">
      </form-->
      
    <form class="form-horizontal" method="POST">
    
        <div class="form-group">
            <label class="control-label col-xs-5" for="login">Login:</label>
            <div class="col-xs-3">
                <input type="text" class="form-control"  name="login" id="login" placeholder="Last Name" required autofocus>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-5" for="password">Password:</label>
            <div class="col-xs-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-5" for="email">Email:</label>
            <div class="col-xs-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
        </div>
        
        <br>
        <div class="form-group">
            <div class="col-xs-offset-5 col-xs-3">
                <input type="submit" class="btn btn-primary" value="Submit" name='submit'>
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </div>
    </form>
      
    <?php } ?>

    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>