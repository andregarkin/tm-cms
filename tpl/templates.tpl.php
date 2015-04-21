<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Search page</h1>
      </div>
      <p class="lead">Search page, страница поиска по сайту. <br/>Для авторизованных - возможность поиска баннера по названию.</p>
      
      <?php if (!empty($msg_search_status)) : ?>
        <p class="text-center text-success">
          <?php print  $msg_search_status; ?>
        </p>
      <?php endif; ?>
      
      <form class="form-horizontal"  action="templates.php" method="GET">
      <div class="row mar-bot-50">
      
        <div class="col-lg-offset-3 col-lg-6">
          <div class="input-group">
            <span class="input-group-btn">
              <!--button class="btn btn-default" type="button">Go!</button-->
              <!--input type="submit" class="btn btn-primary" value="Submit" name='submit'-->
              <button class="btn btn-default" type="submit">Go!</button>
            </span>
            <input type="text" name="s" class="form-control" placeholder="Search for..."  
              value="<?php print !empty($searchName)?$searchName:false; ?>" autofocus>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        
      </div><!-- /.row -->
      </form>
      
      <p></p>
      <p></p>
      
      <?php if (LOGGED) { ?>
      <?php if (isset($arrBanners) && false !== $arrBanners) : ?>
      
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
      <?php endif; ?>
      
      <p>Now you are logged at site as <strong><?php print USERNAME ?></strong>. And you can:</p>
      <ul>
        <li>View <a href="<?php print SUBFOLDER_PATH ?>/banners/list.php">list of your banners</a>. 
          And naturally, create new banners, modify it, customize behavior and delete it, if you need.</li>
        <li>You may <a href="">logout</a> to return standard mode, and then login again in another registered user.</li>
      </ul>

      <?php } ?>
      
    </div>
<?php include('footer.tpl.php') ?>