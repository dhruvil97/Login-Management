<?php 
include_once('dbconfig.php');


if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
    $query = "SELECT * FROM blogs WHERE author_name LIKE '%$search_query%' OR blog_content LIKE '%$search_query%' OR blog_title LIKE '%$search_query%' LIMIT 8";
    $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
  
  	$i = 1;
   while ($row = mysqli_fetch_array($result)) {
    
     $username =  "<tr><td>".$i."</td><td>".$row['blog_title']."</td><td class='text-left'>" .$row['blog_content']. "</td><td>".$row['author_name']."</td></tr>";
$i++;
	$return[] = array(
		"use" => $username
	);
    
  }
 

  
}
 else {
  $username =  "<tr><td></td><td></td><td class='text-center font-weight-bold'>No Data Found</td><td></td></tr>";
  $return[] = array(
		"use" => $username
	);
}
echo json_encode($return);
}


?>
