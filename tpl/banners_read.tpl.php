<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header text-center">Read a Banner</h2>
    <?php if (!empty($msg_read_status)) : ?>
      <p class="text-center<?php print $msg_class ?>">
        <?php print  $msg_read_status; ?>
      </p>
    <?php endif; ?>
    
    
    <div class="form-horizontal custom" >
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
      
      <div class="form-group">
          <label class="col-xs-4 control-label">Displayed on these pages:</label>
          <div class="col-xs-8">
            <?php foreach ($pages as $page) : ?>
            <?php 
            // Skip same Page Title.
            if (isset($previous_page) && ($page['id'] == $previous_page)) {
              continue;
            }
            // Skip Page with Title 'Banners List'.
            if ($page['id'] == 6) {
              continue;
            }
            // Make tab for item (if nested Page).
            $tab_class = ''; // css class for item
            if ($page['id'] > 52000) {
              $tab_class = ' tab-item';
            }
            $previous_page = $page['id']; // temp var
            ?>
              <label class="checkbox-inline<?php print $tab_class ?>">
                  <input type="checkbox" name="option_display_pages[<?php print $page['id'] ?>]" 
                  <?php if (in_array($needle = $page['id'], $haystack = $pagesIDs)): ?>
                    checked 
                  <?php endif; ?>
                  disabled ><?php print $page['title'] ?>
              </label>

            <?php endforeach; ?>  
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