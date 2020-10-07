<?php 
include_once('dbconfig.php');
include_once('header.php');
?>
<?php 
if(isset($_POST['frg_user']) && !empty($_POST['frg_user'])){
	$username = $_POST['frg_user'];


$query = "SELECT user_pass FROM users WHERE user_email = '$username'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if(mysqli_num_rows($result) >= 1){ ?>
		<script type="text/javascript">$(document).ready(function(){
      		$('#testr').html('Enter E-mail & new password in text-box').css('color','green').addClass('col-sm-8');
  			})
		</script>
	<?php 
	if(isset($_POST['frg_pwd']) && !empty($_POST['frg_pwd'])){
		$passwd = md5($_POST['frg_pwd']);
		
		$querypass = "UPDATE users SET user_pass = '$passwd' WHERE user_email = '$username'";
		$result = mysqli_query($conn,$querypass);

			}
		}	
	else{ ?>
		<script type="text/javascript">$(document).ready(function(){
      		$('#testr').html('No User Found').css('color','red').addClass('col-sm-4');
  			})
			</script>
	<?php }
}
?>
<div class="text-center jumbotron">
	<h2>Login</h2>
</div>
<div class="container jumbotron col-sm-3">
  
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2">Email:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="frg_user" placeholder="Enter your email" name="frg_user">
      </div>
    </div>
    <div><p id="testr"></p></div>
    <?php if(isset($_POST['frg_user']) && !empty($_POST['frg_user']) && mysqli_num_rows($result) >= 1){ ?>
    	<div class="form-group">
      <label class="control-label col-sm-8">Reset Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="frg_pwd" placeholder="Enter new Password" name="frg_pwd">
      </div>
    <?php } ?>    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success float-right">Submit</button>
      </div>
    </div>
  </form>
</div>

<?php 
include_once('footer.php');
?>