<?php include('header.tpl.php') ?>
    <!-- Begin page content -->
    <div class="container">
    
    
    <h2 class="sub-header">Banners List</h2>
    <div class='zero-size'>
      <p class="h2-left-offset-200">
        <a href="create.php" class="btn btn-success">Create</a>
      </p>
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
        foreach ($arrBanners as $row) {
          echo '<tr>';
          echo '<td>'. $row['id'] . '</td>';
          echo '<td>'. $row['title'] . '</td>';
          echo '<td><code>'. substr(htmlentities($row['content'], ENT_QUOTES), 0, 45) . ' ... </code></td>';
          ?>
          <td><a class="btn" href="read.php?id=<?php print $row['id'] ?>">Read</a> / <a class="btn" href="#">Update</a> / <a class="btn" href="#">Delete</a></td>
          <?php
          if ($row['option_display']) {
            $op_display = 'On';
            $op_class = 'bg-info';
          } else {
            $op_display = 'Off';
            $op_class = 'bg-danger';
          }
          
          echo '<td><span class="' . $op_class . '">'. $op_display . '</span></td>';
          echo '</tr>';
        }
        ?>
        <tr>
          <td>1</td>
          <td>Banner 111</td>
          <td><code>&lt;div&gt;Lorem ipsum dolor ...</code></td>
          <td><a href="#">Edit</a> / <a href="#">Remove</a></td>
          <td><span class="bg-info highlight">On</span></td>
        </tr>
        <tr>
          <td>1</td>
          <td>Banner 111</td>
          <td><code>&lt;div&gt;Lorem ipsum dolor ...</code></td>
          <td><a href="#">Edit</a> / <a href="#">Remove</a></td>
          <td><span class="bg-danger">Off</span></td>
        </tr>
      </tbody>
    </table>
    </div>
    
    
    </div>  <!-- /container -->
<?php include('footer.tpl.php') ?>