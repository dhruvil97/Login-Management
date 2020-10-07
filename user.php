<?php 
include_once('header.php'); 
include_once('session.php');
include_once('dbconfig.php');

 ?>
 <br>
 <input type="hidden" value="<?php echo $_SESSION['u_id']; ?>" class="uid">

<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 jumbotron text-center">
<?php 
$sql = "SELECT * FROM users ORDER BY user_role";

$res = mysqli_query($conn,$sql);


if(mysqli_num_rows($res) > 0){
	echo "<table cellpadding='10'>";
	echo "<tr>";
	echo "<th>First Name</th>";
	echo "<th>Role</th>";
	echo "</tr>";

while($row = mysqli_fetch_array($res)){

echo "<tr>";
echo "<td>".$row['user_name']."</td>";
echo "<td>" .$row['user_role']. "</td>";
echo "<td><input type='button' class='rem btn-danger' name='delete' data-id='".$row['Id']."' d-name='".$_SESSION['login_role']."' value='Delete' n-name='".$row['user_name']."'></td>";
echo "</tr>";
}
echo "</table>";

mysqli_free_result($res);
}
else{
	echo "No User Registered";
}
 ?></div>
</div>

 <?php 
include_once('footer.php');

  ?>
