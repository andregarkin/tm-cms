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
      <div class="form-group <?php echo !empty($nameError)?'error text-danger':'';?>">
        <label class="control-label">Name</label>
        <div class="controls">
            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
            <?php if (!empty($nameError)): ?>
                <span class="help-inline text-info"><?php echo $nameError;?></span>
            <?php endif; ?>
        </div>
      </div>
      <div class="form-group <?php echo !empty($emailError)?'error text-danger':'';?>">
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
    
    <form class="form-horizontal" method="POST">
    
      <div class="form-group <?php echo !empty($nameError)?'error text-danger':'';?>">
        <label class="control-label col-xs-3">Name: </label>
        <div class=" col-xs-4">
            <input name="name" type="text"  class="form-control" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
            <?php if (!empty($nameError)): ?>
                <span class="help-inline text-info"><?php echo $nameError;?></span>
            <?php endif; ?>
        </div>
      </div>
    
      <div class="form-group">
          <label class="control-label col-xs-3" for="title">Title:</label>
          <div class="col-xs-9">
              <input type="text" class="form-control" id="title" placeholder="Title">
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-xs-3" for="bannerContent">Content:</label>
          <div class="col-xs-9">
              <textarea rows="3" class="form-control" id="bannerContent" placeholder="Content HTML"></textarea>
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-xs-3">Active status:</label>
          <div class="col-xs-2">
              <label class="radio-inline">
                  <input type="radio" name="activeRadios" value="1"> On
              </label>
          </div>
          <div class="col-xs-4">
              <label class="radio-inline">
                  <input type="radio" name="activeRadios" value="0"> Off (Don't show on any page)
              </label>
          </div>
      </div>
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <label class="checkbox-inline">
                  <input type="checkbox" value="news"> Send me latest news and updates.
              </label>
          </div>
      </div>
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <label class="checkbox-inline">
                  <input type="checkbox" value="agree">  I agree to the <a href="#">Terms and Conditions</a>.
              </label>
          </div>
      </div>
      <br>
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <!--input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset"-->
              
              <button type="submit" class="btn btn-success">Create</button>
              <button type="reset" class="btn btn-default">Reset</button>
              <a href="list.php" class="btn btn-info" role="button">Back</a>

          </div>
      </div>
    </form>
    
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>