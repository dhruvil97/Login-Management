<?php
include_once('dbconfig.php');
include_once('header.php');

session_start();
 if (isset($_SESSION['ur'])) {
   $url = $_SESSION['ur'];
 }
if(isset($_SESSION['login_user'])){
    
    header("location:index");
      die();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$myusername = mysqli_real_escape_string($conn,$_POST['user']);
	$password = md5($_POST['pwd']);


	$sql = "SELECT * FROM users WHERE user_name = '$myusername' AND user_pass = '$password' ";
	$result = $conn->query($sql);
  
	$row1 =mysqli_fetch_array($result);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$ses = $row1['Id'];
	$count = mysqli_num_rows($result);
	   if($count == 1){
      
		    $_SESSION['u_id'] = $ses;
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_role'] = $row1['user_role'];
        
        if(isset($_SESSION['ur'])){
          $url = $_SESSION['ur'];
          }
          else{
          $url = 'index';
          }
        header("location:".$url);
      }
      else{
          $error = "Your Login Name or Password is invalid";
          echo $error;
        }
}


 ?>
<div class="text-center jumbotron">
	<h2>Login</h2>
</div>

<div class="container jumbotron col-sm-3">
  <h3>Enter Credentials</h3>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="user">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        <i class="fa password_control fa-eye"></i>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
  <div class="col-sm-10 inline"><a href="registration">Register Here</a></div>
  <div class="col-sm-10 inline"><a href="forgot" class="frgt">Forgot Password</a></div>
  <p id="testr"></p>
</div>


<?php include_once('footer.php'); ?>