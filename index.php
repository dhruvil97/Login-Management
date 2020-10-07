<?php
include_once('dbconfig.php');
include_once('session.php');
include_once('header.php');


?>


<div class="jumbotron text-center">
  <a href="blogs"><button class="btn btn-success" value="Add Blogs">View Blogs</button></a> 
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
    	<?php

    $b = time();
    $h = date("G", $b);

    $m    = date("A", $b);

    if($h >= 6 && $h < 12){
    $greet = "Good Morning";
   }
   elseif($h>=12 && $h <17){
    $greet = "Good Afternoon";
   }
   else{
    $greet = "Good Evening";
   }

    if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])){
    echo "<span><h4> Hey ".$_SESSION['login_user']. "!</h4> ".$greet."</span>"; 
}   
/*$inactive = 60;
if( !isset($_SESSION['timeout']) )
$_SESSION['timeout'] = time() + $inactive; 
//echo time();
echo "<br>";
//echo $_SESSION['timeout'];
$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  
  
  session_destroy(); session_unset();  echo "<script>alert('Your Session is expired'); window.location.href = '/alian';</script>";  }

$_SESSION['timeout']=time();     */

  ?>
  
    </div>
    <div class="col-sm-4">
   
</div>
    <div class="col-sm-4">  
    </div>
  </div>
</div>

<?php 
include_once('footer.php');
 ?>