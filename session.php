
<?php
   $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



  include('dbconfig.php');
    session_start();
    $_SESSION['ur'] = $url;

  if(isset($_SESSION['login_user'])){ 	
   $user_check = $_SESSION['login_user'];
  }

     
   
   
   if(!isset($_SESSION['login_user'])){
   	
     header("location:login.php");
      die();
   }
   else{
   	echo "<style>.logout{ display: block !important;} </style>";
   }

?>
