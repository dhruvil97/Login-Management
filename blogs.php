<?php 
include 'header.php';
include_once('dbconfig.php');

$sql = "SELECT * FROM blogs";
$result = mysqli_query($conn,$sql);?>
<div class="container">
 	<div class="row blogs">		
<?php
while($row = mysqli_fetch_array($result)){
				$bco = $row['blog_content'];
			echo	"<div class='card' style='width: 18rem; margin : 1rem;'><div class='card-body'><h5 class='card-title text-center'>".$row['blog_title']."</h5><p class='card-text'>".substr($bco,0,70).".....</p></div><span class='text-right auth'>- ".$row['author_name']."&nbsp;</span></div>";
}
 ?>

 </div>
 </div>
 <br>
 <script type="text/javascript">
 	$("nav li").removeClass("active");
 	$("nav li:nth-child(2)").addClass("active");
 </script>
 <?php 
include 'footer.php';
  ?>