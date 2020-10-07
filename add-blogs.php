<?php 
include_once('header.php');
include_once('dbconfig.php');
include_once('session.php');
 ?>

 <form class="form-horizontal jumbotron" id="new_blog" method="post">
    <div class="form-group">
      <label class="control-label col-sm-4">Blog Title:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="b_title" placeholder="Enter Name" name="b_title" title="Please Enter Title!">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4">Blog Content:</label>
      <div class="col-sm-6">
        <textarea type="textarea" class="form-control" id="b_content" placeholder="Enter Content" name="b_content"></textarea>
      </div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-4">
        <button type="submit" class="btn btn-success new-blog" name="submit">Submit</button>
      </div>
    </div>
  </form>

<?php include_once('footer.php') ?>