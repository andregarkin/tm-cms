<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header text-center">Read a Banner</h2>
    <?php if (!empty($msg_read_status)) : ?>
      <p class="text-center<?php print $msg_class ?>">
        <?php print  $msg_read_status; ?>
      </p>
    <?php endif; ?>
    
    
    <div class="form-horizontal" >
      <div class="form-group">
        <div class="control-group">
          <label class="col-xs-4 control-label">#</label>
          <div class="col-xs-8 controls">
              <label class="checkbox">
                  <?php print $row['id'];?>
              </label>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="control-group">
          <label class="col-xs-4 control-label">Title</label>
          <div class="col-xs-8 controls">
              <label class="checkbox">
                  <?php print $row['title'];?>
              </label>
          </div>
        </div>
      </div>
        
      <div class="form-group">
        <div class="control-group">
          <label class="col-xs-4 control-label">Content</label>
          <div class="col-xs-8 controls">
              <label class="checkbox">
                  <code><?php print htmlentities($row['content'], ENT_QUOTES) ?></code>
              </label>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="control-group">
          <label class="col-xs-4 control-label">Active status</label>
          <div class="col-xs-8 controls">
              <label class="checkbox">
                  <?php print (1==$row['option_display'])?'ON':'OFF' ?>
              </label>
          </div>
        </div>
      </div>
      
       <br>
      <div class="form-group">
          <div class="col-xs-offset-4 col-xs-8">
            <a class="btn btn-default" href="list.php">Back</a>
            <a class="btn btn-primary"  href="update.php?id=<?php print $row['id'] ?>">Update</a>
            <a class="btn btn-danger"   href="delete.php?id=<?php print $row['id'] ?>">Delete</a></td>
          </div>
      </div>
    </div>
    
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>