<?php 
	include_once('dbconfig.php');
	include_once('header.php');
	include_once('session.php');
	
 ?>
 	<?php
 	

 		$sql = "SELECT * FROM users WHERE Id = '".$_SESSION['u_id']."'";
 		$result = $conn->query($sql);
 		$row = mysqli_fetch_array($result);

    
 	 ?> 	
 
 <br>
<div class="container">
	<div class="row jumbotron">
		<div class="col-sm-4 text-center">
      <div class="text-center profile">
      <img id="usimg" src="<?php echo $row['user_img']; ?>" height="150px" width="150px;" style="border-radius: 75px;">
      <span class="prof" style="cursor: pointer;">Edit Profile Picture</span></img>
        </div>
        <br>

			<h4>Your Currrent Credentials</h4>
			<label class="control-label">Name : </label> <?php echo $row['user_name']; ?><br>
			<label class="control-label">Current Mail : </label> <?php echo $row['user_email']; ?>
		</div>
		<div class="col-sm-4">
			<h5>Update your Credentials</h5>
 <form method="post">
 	<div class="form-group">
      <label class="control-label col-sm">New E-mail:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="upd_mail" placeholder="Enter Name" name="update_mail">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm" for="pwd">New Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="upd_pwd" placeholder="Enter password" name="update_pass">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn_user" name="submit">Submit</button>
      </div>
    </div>
 </form>
 </div>
 <div class="col-sm-4">
 	<form id="form" class="profileform" action="functions.php" method="post" enctype="multipart/form-data" style="display: none;">
  
  <h6>Upload Profile Picture :</h6>
  <div class="form-group">
  <input type="file" name="user_img" onchange="document.getElementById('usimg').src = window.URL.createObjectURL(this.files[0]);" onclick="$('.bne').css('display','block');">
</div>
<div class="form-group">
  <input type="submit" value="Update"></div>
  <div class="form-group">
  <button class="bne" type="button" onclick="location.reload()" style="display: none;">Cancel</button>
</div>
</form>

 </div> 
 </div>
</div>
	
<div class="container">
	<h5>Your Blogs</h5>
	<div class="row">
  		
  			
				<?php
					$blg = "SELECT * FROM blogs WHERE blog_author = '".$_SESSION['u_id']."'";

 					$res = mysqli_query($conn,$blg);
 					
 					if(mysqli_num_rows($res) > 0){
					while($blgs = mysqli_fetch_array($res)){ 
				echo "<div class='card' style='width: 22rem; margin : 10px;'><div class='card-body'><h5 class='card-title'>".$blgs['blog_title']."</h5><p class='card-text'>".$blgs['blog_content']."</p><input type='button' class='btn btn-danger rem-post' name='delete' data-id='".$blgs['ID']."' value='Delete'><input type='button' class='btn btn-info up-post' style='margin-left :5px;' name='update' data-id='".$blgs['ID']."' value='Edit' data-toggle='modal' data-target='#myModal'></div></div>";
					}
				}
	 			?>
	 			</div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">Update your blog</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">

       <form method="post">
 	<div class="form-group">
      <label class="control-label col-sm">Title:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="u_t" placeholder="Enter Title" name="update_title">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm" for="content">New Content:</label>
      <div class="col-sm-10">          
        
        <textarea class="form-control rounded-0" id="u_c" rows="4" name="update_content"></textarea>
        <input type="hidden" name="upd_id"  class="hid-n">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-4">
        <button type="submit" class="btn btn-success upda" name="submit">Submit</button>
      </div>
    </div>
 </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include_once('footer.php'); ?>
