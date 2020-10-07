<?php
include_once('dbconfig.php');
include_once('header.php');


if(isset($_POST['nes']) && !empty($_POST['nes'])){
  
    $uname = $_POST['newus'];
  $email = $_POST['newmail'];
  $pass =  md5($_POST['passwd']);
  $role =  $_POST['role'];
  $pasm = $_POST['passwd'];

    $sql="INSERT INTO users (user_name, user_email, user_pass, user_role) VALUES ('".$uname."','".$email."', '".$pass."', '".$role."')";
    if(!$result = $conn->query($sql)){
    die('There was an error running the query [' . $conn->error . ']');
    }
    else{
         mail($email,"Hola! ".$uname.". You Have Registered successfully","Your Credentials are \r\n Username :".$uname."\r\n Password :".$pasm."\r\n Role     :".$role."\r\n\r\nYou are most welcome to our community. \r\n\r\n This is system generated mail");
      }
    }

 ?>
<div class="jumbotron text-center">
  <h1>User registration Form</h1>
  
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      
    </div>
    <div class="col-sm-4">
    <div class="jumbotron"> 
  <h3>Enter Credentials</h3>
  <form class="form-horizontal"  method="post" id="myform">
    <div class="form-group">
      <label class="control-label col-sm-4">Name:</label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="u_name" placeholder="Enter Name" name="u_name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4">E-mail:</label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="u_mail" placeholder="Enter Name" name="u_mail"> 
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="pwd">Password:</label>
      <div class="col-sm-12">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="u_pass">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-8" for="pwd">Confirm Password:</label>
      <div class="col-sm-12">          
        <input type="password" class="form-control" id="pwd2" placeholder="Confirm password" name="u_pass2">
      </div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-8">Select User Role:</label>
  <div class="col-sm-12">
  <select class="form-control"  name="user_role" id="role" title="Please select User Role!">
    <option value="">Select</option>
    <option value="admin">Admin</option>
    <option value="author">Author</option>
  </select></div>
</div>
    <div class="form-group">        
      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-user-new" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>
</div>

    <div class="col-sm-4">
      
    </div>
  </div>
</div>
<?php 

include_once('footer.php');

 ?>