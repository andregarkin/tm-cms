<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header">Create a Banner</h2>
    <div class='zero-size'>
    <?php if (!empty($msg_create_status)) : ?>
      <p class="h2-left-offset-250 text-success"><?php print  $msg_create_status; ?>
        <!--span class="text-success"></span-->
      </p>
    <?php endif; ?>
    </div>
    
    <form class="form-horizontal" action="create.php" method="post">
      <div class="control-group <?php echo !empty($nameError)?'error text-danger':'';?>">
        <label class="control-label">Name</label>
        <div class="controls">
            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
            <?php if (!empty($nameError)): ?>
                <span class="help-inline text-info"><?php echo $nameError;?></span>
            <?php endif; ?>
        </div>
      </div>
      <div class="control-group <?php echo !empty($emailError)?'error text-danger':'';?>">
        <label class="control-label">Email Address</label>
        <div class="controls">
            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
            <?php if (!empty($emailError)): ?>
                <span class="help-inline text-info"><?php echo $emailError;?></span>
            <?php endif;?>
        </div>
      </div>
      <div class="control-group <?php echo !empty($mobileError)?'error text-danger':'';?>">
        <label class="control-label">Mobile Number</label>
        <div class="controls">
            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
            <?php if (!empty($mobileError)): ?>
                <span class="help-inline text-info"><?php echo $mobileError;?></span>
            <?php endif;?>
        </div>
      </div>
      <div class="form-actions">
          <button type="submit" class="btn btn-success">Create</button>
          <a class="btn" href="list.php">Back</a>
        </div>
    </form>
    
    <div class="bs-example">
        <form>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>