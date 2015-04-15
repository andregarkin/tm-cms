<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header text-center">Delete a Banner</h2>
    
    <?php if (!empty($msg_delete_status)) : ?>
      <p class="text-center<?php print $msg_class ?>">
        <?php print  $msg_delete_status; ?>
      </p>
      
      <div class="form-group">
        <div class="col-xs-offset-5 col-xs-3">
          <a class="btn btn-default" href="list.php" role="button">Back to the list</a>
        </div>
      </div>
    <?php else: ?>
      <form class="form-horizontal" action="delete.php" method="POST">
        
        <input type="hidden" name="id" value="<?php print !empty($id)?$id:'' ?>"/>
        <p class="alert alert-error text-center">Are you sure to delete?</p>
        
        <div class="form-group">
          <div class="col-xs-offset-5 col-xs-3">
            <button type="submit" class="btn btn-danger">Yes</button>
            <a class="btn btn-default" href="list.php" role="button"> No </a>
          </div>
        </div>
      </form>
    <?php endif; ?>
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>