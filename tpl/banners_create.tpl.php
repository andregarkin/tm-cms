<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header text-center">Create a Banner</h2>
    
    <?php if (!empty($msg_create_status)) : ?>
      <p class="text-center text-success">
        <?php print  $msg_create_status; ?>
      </p>
    <?php endif; ?>
    
    
    <form class="form-horizontal custom" method="POST">
    
      <div class="form-group<?php print !empty($titleError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3" for="title">Title:</label>
          <div class="col-xs-9">
              <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="<?php print !empty($title)?$title:'' ?>" autofocus>
              <?php if (!empty($titleError)): ?>
                <span class="help-inline text-info"><?php print $titleError ?></span>
              <?php endif; ?>
          </div>
      </div>
      
      <div class="form-group<?php print !empty($contentError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3" for="bannerContent">Content:</label>
          <div class="col-xs-9">
              <textarea name="content" rows="3" class="form-control" id="bannerContent" placeholder="Content HTML"
                ><?php print !empty($content)?$content:'' ?></textarea>
              <?php if (!empty($contentError)): ?>
                <span class="help-inline text-info"><?php print $contentError ?></span>
              <?php endif; ?>
          </div>
      </div>
      
      <div class="form-group<?php print !empty($option_displayError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3">Active status:</label>
          <div class="col-xs-2">
              <label class="radio-inline">
                  <input type="radio" name="option_display" value="1" 
                    <?php print (isset($option_display) && '1'==$option_display)?'checked':'' ?>>On</label>
          </div>
          <div class="col-xs-7">
              <label class="radio-inline">
                  <input type="radio" name="option_display" value="0" 
                    <?php print (isset($option_display) && '0'==$option_display)?'checked':'' ?>>Off (Don't show on any page)</label>
          </div>
          <?php if (!empty($option_displayError)): ?>
            <span class="help-inline text-info"><?php print $option_displayError ?></span>
          <?php endif; ?>
      </div>
      
          
      <div class="form-group">
          <label class="control-label col-xs-3">Displayed on these pages:</label>
          <div class="col-xs-9">
          
              <?php foreach ($pages as $page) : ?>
              <?php 
              if (isset($previous_page) && ($page['id'] == $previous_page)) {
                continue;
              }
              $tab_class = ''; // css class for item
              if ($page['id'] > 52000) {
                $tab_class = ' tab-item';
              }
              $previous_page = $page['id']; // temp var
              ?>
              <label class="checkbox-inline<?php print $tab_class ?>">
                  <input type="checkbox" name="option_display_pages[<?php print $page['id'] ?>]" value="<?php print $page['title'] ?>" 
                  <?php if ( isset($option_display_pages) && array_key_exists($key = $page['id'], $array = $option_display_pages) ) : ?>
                    checked
                  <?php endif; ?>
                  ><?php print $page['title'] ?>
              </label>
              <?php endforeach; ?>
              
          </div>
      </div>
      
      <!--div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <label class="checkbox-inline">
                  <input type="checkbox" value="news" checked> Send me latest news and updates.
              </label>
          </div>
      </div>
      
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <label class="checkbox-inline">
                  <input type="checkbox" value="agree">  I agree to the <a href="#">Terms and Conditions</a>.
              </label>
          </div>
      </div-->
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