<?php 
include_once('dbconfig.php');

include_once('session.php');



$create_blog_table = "CREATE TABLE IF NOT EXISTS blogs (
  ID int(11) NOT NULL AUTO_INCREMENT,
  blog_author varchar(55),
  author_name varchar(55),
  blog_title varchar(55),
  blog_content varchar(55),
  post_date varchar(55),
  PRIMARY KEY  (ID)
)";

$create_user_table = "CREATE TABLE IF NOT EXISTS users (
  Id int(11) NOT NULL AUTO_INCREMENT,
  user_name varchar(55),
  user_email varchar(55),
  user_pass varchar(55),
  user_role varchar(55),
  user_img varchar(255),
  PRIMARY KEY  (Id)
)";

$blog_table = $conn->query($create_blog_table);
$user_table = $conn->query($create_user_table);

if(isset($_POST['save']) && !empty($_POST['save'])){
	$blogtitle = mysqli_real_escape_string($conn,$_POST['name']);
	$blogcont = mysqli_real_escape_string($conn,$_POST['comment']);
	$blogauthor = $_SESSION['u_id'];
  $authorname = $_SESSION['login_user'];
  date_default_timezone_set("Asia/Calcutta");
  $today = date("Y-m-d h:i:s");
		$sql = "INSERT INTO blogs (blog_author,author_name,blog_title,blog_content,post_date) VALUES ('$blogauthor','$authorname','$blogtitle','$blogcont','$today')";
		if(!$result = mysqli_query($conn,$sql)){
		die('There was an error running the query {'.mysqli_error($conn).'}');
		}
		else{
			echo "<script> alert('Your blog successfully posted');
			location='index.php';
			</script>";
		}

}



if(isset($_POST['action']) && !empty($_POST['action']) == 'deleteEntry'){
 			$bid = isset($_POST['post']) ? intval($_POST['post']) : 0;
 			if ($bid > 0) {
 		   $sqld = "DELETE FROM blogs WHERE id=".$bid." LIMIT 1";
 		   mysqli_query($conn,$sqld);
 		}		
 		}

if (isset($_POST['action']) && !empty($_POST['action']) == 'deleteEntry') {
    $id = isset($_POST['uid']) ? intval($_POST['uid']) : 0;
    echo "<script type='text/javascript'> alert('success'); </script>";
    if ($id > 0) {
        $query = "DELETE FROM users WHERE u_id=".$id." LIMIT 1";
        $result = mysqli_query($conn, $query);
        echo 'ok';
    } else {
        echo 'err';
    }
    exit; 
}


 
if(isset($_FILES['image']) && !empty($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
             
      $file_cat = $_POST['cat'];
      $file_type = $_POST['met'];

      $extensions= array("jpeg","jpg","png");

      //print_r($_FILES['image']['error']);
      foreach ($_FILES["image"]["error"] as $key => $error) {
         $name = $_FILES["image"]["name"][$key];
         $file_ext = pathinfo($name, PATHINFO_EXTENSION);
         if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
         }
         }

      $uploads_dir = 'src';
      foreach ($_FILES["image"]["error"] as $key => $error) {
         if(empty($errors)==true){
          $file_tmp = $_FILES["image"]["tmp_name"][$key];
          $name = $_FILES["image"]["name"][$key];
         
         move_uploaded_file($file_tmp,"$uploads_dir/$name");
         }
         else{
         print_r($errors);
         }
      }
   
   foreach ($_FILES["image"]["error"] as $key => $error) {
      $name = $_FILES["image"]["name"][$key];
      $url = "src/".$name;
    $sql = "INSERT INTO products (p_id,product_name,product_cat,product_met,product_link) VALUES ('1','$name','$file_cat','$file_type','$url')";
   mysqli_query($conn,$sql);
   }
   echo "<script> alert('Uploded Sucessfully'); 
   location = 'products.php'; 
   </script>";
}

if(isset($_POST['user']) && !empty($_POST['user'])){
	$email = $_POST['u_mail'];
	$password = md5($_POST['u_pwd']);
	$id = $_SESSION['u_id'];

	$sql = "UPDATE users SET user_email = '$email', user_pass = '$password' WHERE u_id = '$id'";
		if(!$result = $conn->query($sql)){
			die('There was an error running the query [' . $conn->error . ']');
			}
			else{
				echo "Your data is updated";
				}
}


if(isset($_POST['up']) && !empty($_POST['up'])){
	$postid = $_POST['u_id'];
	$blgtitle = $_POST['u_title'];
	$blgcontent = $_POST['u_content'];
	

	$update = "UPDATE blogs SET blog_title ='$blgtitle', blog_content = '$blgcontent' WHERE id = '$postid'";
	if(!$result = $conn->query($update)){
		die('There was an error running the query [' . $conn->error . ']');
	}
	else{
	
	}
}

if(isset($_FILES['user_img']) && !empty($_FILES['user_img'])){
	
      $file_name = $_FILES['user_img']['name'];
      $file_size =$_FILES['user_img']['size'];
      $file_tmp =$_FILES['user_img']['tmp_name'];
      $file_type=$_FILES['user_img']['type'];
      $name = basename($_FILES["user_img"]["name"]);
      $uploads_dir = 'src';      
      move_uploaded_file($file_tmp, "$uploads_dir/$name");
      $url = "src/".$file_name;
      $uid = $_SESSION['u_id'];
      $update = "UPDATE users SET user_img ='$url' WHERE Id = '$uid'";
      $res = $conn->query($update);
      header("Location:update_user.php");

}





 ?>

