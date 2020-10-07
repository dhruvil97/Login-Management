<?php 
 include_once('header.php'); 
 include_once('session.php');
include_once('dbconfig.php');
?>
 
<!--<input type="hidden" value="<?php //echo $_SESSION['u_id']; ?>" class="uid">-->
<input type="hidden" name="ord" id="ord" value="ASC" data-id="id" >
<input type="hidden" name="pagi" id="pag_r" value="1" data-id="">
<div class="container" style="margin-top: 20px;">
  <div class="row">
	 <div class="col-sm-2">    
    </div>
	 <div class="col-sm-12 jumbotron text-center pagi">
   <input type="text" placeholder="Search Here....." name="search" class="ad-srch">
		  <table id="userTable" border="1" >
        <thead>
          <tr>
            <th width="1%" class="sort-heading" id="id-ASC">S.no <i class="fa fa-caret-up" aria-hidden="true"></i></th>
            <th width="2%" class="sort-heading" id="blog_title-ASC" >Blog Title <i class="fa fa-caret-up" aria-hidden="true"></th>
            <th width="20%" class="sort-heading" id="blog_content-ASC" >Blog Content <i class="fa fa-caret-up" aria-hidden="true"></th>
            <th width="3%" class="sort-heading" id="author_name-ASC" >Blog Author <i class="fa fa-caret-up" aria-hidden="true"></th>
          </tr>
        </thead>
        <tbody>
      </tbody>
      </table>
    <div class="pag text-center">
    </div>  	  
    </div>
  </div>
  </div>
</div>
   

 <?php 
include_once('footer.php');

  ?>
