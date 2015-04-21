<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header">Banners List</h2>
    <div class='zero-size'>
    
      <p class="h2-left-offset-200">
        <a href="create.php" class="btn btn-success">Create</a>
      </p>
      
      <form class="form-horizontal h2-left-offset-300"  action="../templates.php" method="GET">
      <div class="row">
        <div class="col-lg-6 col-xs-6 pull-right">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Go!</button>
            </span>
            <input type="text" name="s" class="form-control" placeholder="Search banner by title..." >
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      </form>
      
    </div>
    
    
    
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Excerpt</th>
          <th>Actions</th>
          <th>Display status</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($arrBanners as $row) { ?>
          <tr>
          <td><?php print $row['id'] ?></td>
          <td><?php print $row['title'] ?></td>
          <td><code><?php print substr(htmlentities($row['content'], ENT_QUOTES), 0, 45) ?> ... </code></td>

          <td><a class="btn btn-info" href="read.php?id=<?php print $row['id'] ?>">Read</a>
          <a class="btn btn-primary"  href="update.php?id=<?php print $row['id'] ?>">Update</a>
          <a class="btn btn-danger"   href="delete.php?id=<?php print $row['id'] ?>">Delete</a></td>
          <?php
          if ($row['option_display']) {
            $op_display = 'On';
            $op_class = 'bg-info';
          } else {
            $op_display = 'Off';
            $op_class = 'bg-danger';
          } ?>
          
          <td><span class="<?php print $op_class ?>"><?php print $op_display ?></span></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>
    
    <p class="">
      <a href="create.php" class="btn btn-success">Create new Banner</a>
    </p>
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>