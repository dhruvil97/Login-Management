<?php 
  
 //include_once('session.php');
include_once('dbconfig.php');
?>
<?php 

function highlightWords($text, $word){
    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $text);
    return $text;
}



if (!(isset($_POST['page'])) && !(isset($_POST['sorting'])) && empty($_POST['query'])) { 
  $page = 1; 
  $column_name = "id";
  $order = "ASC";
  $search_query = "";
  $per_page = 6;
}
elseif(isset($_POST['page']) && isset($_POST['ord'])){
    $page = $_POST['page'];
    $column_name = $_POST['sort'];
    $order = $_POST['ord'];
    $search_query = $_POST['qu'];
    $per_page = 6;
}

elseif(isset($_POST['sorting']) && isset($_POST['sortt'])){
    $page = 1;
    $column_name = $_POST['sorting'];
    $order = $_POST['sortt'];
    $search_query = $_POST['qu'];
    $per_page = 6; 
}
elseif(isset($_POST['query'])){ 
    $search_query = $_POST['query'];
    $page = $_POST['pgi']; 
    $column_name = "id";
    $order = "ASC";
    $per_page = 6;
}
        $cur_page = $page;
        $page -= 1;
        // Set the number of results to display
        
        $previous_btn = true;
        $next_btn = true;
        $start = $page * $per_page;

$sql = "SELECT * FROM blogs WHERE author_name LIKE '%$search_query%' OR blog_content LIKE '%$search_query%' OR blog_title LIKE '%$search_query%' ORDER BY $column_name $order LIMIT $start,$per_page";

$res = mysqli_query($conn,$sql);
$reslt = mysqli_query($conn,"SELECT * FROM blogs WHERE author_name LIKE '%$search_query%' OR blog_content LIKE '%$search_query%' OR blog_title LIKE '%$search_query%' ORDER BY $column_name $order");
$count = mysqli_num_rows($reslt);

if(mysqli_num_rows($res) > 0){
    $i = 1;

while($row = mysqli_fetch_array($res)){
    $b_t= !empty($search_query)?highlightWords($row['blog_title'], $search_query):$row['blog_title'];
    $b_c= !empty($search_query)?highlightWords($row['blog_content'], $search_query):$row['blog_content'];
    $b_a= !empty($search_query)?highlightWords($row['author_name'], $search_query):$row['author_name'];
    $username =  "<tr><td>".$i."</td><td>".$b_t."</td><td class='text-left'>" .$b_c. "</td><td>".$b_a."</td></tr>";
    
        $i++;
        $return_arr[] = array(
                    "username" => $username,
                );
            }
        }
            else
            {
                $username =  "<tr><td></td><td></td><td class='text-center font-weight-bold'>No Data Found</td><td></td></tr>";
  $return_arr[] = array(
        "username" => $username
    );
            }


$no_of_paginations = ceil($count / $per_page);
        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }

        // Pagination Buttons logic
        $pag_container = "";     
        $pag_container .= "<div class='cvf-universal-pagination'><ul>";


        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $pag_container .= "<li p='$pre' class='active'>Previous</li>";
        } else if ($previous_btn) {
            $pag_container .= "<li class='inactive'>Previous</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $pag_container .= "<li p='$i' class = 'selected' >{$i}</li>";
            else
                $pag_container .= "<li p='$i' class='active'>{$i}</li>";
        }

        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $pag_container .= "<li p='$nex' class='active'>Next</li>";
        } else if ($next_btn) {
            $pag_container .= "<li class='inactive'>Next</li>";
        }



        $pag_container = $pag_container . "
            </ul>
        </div>";
      $pag_contai = '<div class = "cvf-pagination-nav">' . $pag_container . '</div>';

    $return_arr[] = array(
    "uname" => $pag_contai,
    );

echo $var = json_encode($return_arr);

 ?>