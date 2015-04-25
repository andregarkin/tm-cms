<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header text-center">Update a Banner</h2>
    <?php if (!empty($msg_update_status)) : ?>
      <p class="text-center text-success">
        <?php print  $msg_update_status; ?>
      </p>
    <?php endif; ?>
    
    <form class="form-horizontal custom"  action="update.php?id=<?php print $id?>" method="POST">
    
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
              // Skip same Page Title.
              if (isset($previous_page) && ($page['id'] == $previous_page)) {
                continue;
              }
              // Skip Page with Title 'Banners List'.
              if ($page['id'] == 6) { // ok, it is magic number
                continue;
              }
              // Make tab for item (if nested Page).
              $tab_class = ''; // css class for item
              if ($page['id'] > 52000) { // ok, it is magic number
                $tab_class = ' tab-item';
              }
              $previous_page = $page['id']; // temp var
              ?>
              <label class="checkbox-inline<?php print $tab_class ?>">
                  <input type="checkbox" name="option_display_pages[<?php print $page['id'] ?>]" value="<?php print $page['title'] ?>" 
                  <?php if ( isset($option_display_pages) && array_key_exists($key = $page['id'], $array = $option_display_pages) ) : ?>
                    checked 
                  <?php endif; ?>
                  <?php if (in_array($needle = $page['id'], $haystack = $pagesIDs)): ?>
                    checked 
                  <?php endif; ?>
                  ><?php print $page['title'] ?>
                  
              </label>
              <?php endforeach; ?>
              
          </div>
      </div>
      
      <div class="form-group<?php print !empty($option_startviewError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3" for="option_startview">Start to show after such quantity of page views:</label>
          <div class="col-xs-2">
              <input name="option_startview" type="text" class="form-control" id="option_startview" 
                placeholder="Quantity of page views" value="<?php print !empty($option_startview)?$option_startview:0 ?>" >
              <?php if (!empty($option_startviewError)): ?>
                <span class="help-inline text-info"><?php print $option_startviewError ?></span>
              <?php endif; ?>
          </div>
      </div>
      
      <div class="form-group<?php print !empty($option_timestartError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3" for="option_timestart">Start to show after time:</label>
          <div class="col-xs-2">
              <input name="option_timestart" type="text" class="form-control" id="option_timestart" 
                placeholder="YYYY-MM-DD" value="<?php print !empty($option_timestart)?$option_timestart:'' ?>" >
              <?php if (!empty($option_timestartError)): ?>
                <span class="help-inline text-info"><?php print $option_timestartError ?></span>
              <?php endif; ?>
          </div>
          
          <label class="control-label col-xs-1 hidden" for="hours">Hours:</label>
          <div class="col-xs-1">
            <select name="option_timestart_hours" id="hours" class="form-control">
              <?php for ($h=0; $h <= 23; $h++): ?>
                <option value="<?php printf("%'02d", $h) ?>" <?php print ($option_timestart_hours == sprintf("%'02d", $h))?' selected':'' ?>>
                  <?php printf("%'02d", $h) ?>
                </option>
              <?php endfor; ?>
            </select> 
          </div>
          
          <label class="control-label col-xs-1 hidden" for="minutes">Minutes:</label>
          <div class="col-xs-1">
            <select name="option_timestart_minutes" id="minutes" class="form-control">
              <?php for ($m=0; $m <= 59; $m++): ?>
                <option value="<?php printf("%'02d", $m) ?>" <?php print ($option_timestart_minutes == sprintf("%'02d", $m))?' selected':'' ?>>
                  <?php printf("%'02d", $m) ?>
                </option>
              <?php endfor; ?>
            </select> 
          </div>
      </div>
      
      <div class="form-group<?php print !empty($option_timeendError)?' text-danger error':'' ?>">
          <label class="control-label col-xs-3" for="option_timeend">Show before this time:</label>
          <div class="col-xs-2">
              <input name="option_timeend" type="text" class="form-control" id="option_timeend" 
                placeholder="YYYY-MM-DD" value="<?php print !empty($option_timeend)?$option_timeend:'' ?>" >
              <?php if (!empty($option_timeendError)): ?>
                <span class="help-inline text-info"><?php print $option_timeendError ?></span>
              <?php endif; ?>
          </div>
          
          <label class="control-label col-xs-1 hidden" for="hours">Hours:</label>
          <div class="col-xs-1">
            <select name="option_timeend_hours" id="hours" class="form-control">
              <?php for ($h=0; $h <= 23; $h++): ?>
                <option value="<?php printf("%'02d", $h) ?>" <?php print ($option_timeend_hours == sprintf("%'02d", $h))?' selected':'' ?>>
                  <?php printf("%'02d", $h) ?>
                </option>
              <?php endfor; ?>
            </select> 
          </div>
          
          <label class="control-label col-xs-1 hidden" for="minutes">Minutes:</label>
          <div class="col-xs-1">
            <select name="option_timeend_minutes" id="minutes" class="form-control">
              <?php for ($m=0; $m <= 59; $m++): ?>
                <option value="<?php printf("%'02d", $m) ?>" <?php print ($option_timeend_minutes == sprintf("%'02d", $m))?' selected':'' ?>>
                  <?php printf("%'02d", $m) ?>
                </option>
              <?php endfor; ?>
            </select> 
          </div>
      </div>
      


      
      <br>
      <div class="form-group">
          <div class="col-xs-offset-3 col-xs-9">
              <!--input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset"-->
              
              <button type="submit" class="btn btn-success">Update</button>
              <button type="reset" class="btn btn-default">Reset</button>
              <a href="list.php" class="btn btn-info" role="button">Back</a>

          </div>
      </div>
      
    </form>
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>