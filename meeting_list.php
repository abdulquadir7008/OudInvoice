<?php
include( "config.php" );
ob_start();
$pagesetting = basename( $_SERVER[ 'PHP_SELF' ] );
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
} else {
  $customerchechlogin_id = "0";
  header( "Location:login.php" );
  ob_end_flush();
}
$customerchechlogin_sql = "select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu = mysqli_query( $link, $customerchechlogin_sql );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );
if ( isset( $_REQUEST[ 'del' ] ) ) {
  $del = $_REQUEST[ 'del' ];
  $query = "delete from meeting_list WHERE id=$del";
  mysqli_query( $link, $query );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Data Delete Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'estimaterore' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include( "include/head.php" );


?>
</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper"> 
  
  <!-- Header -->
  <?php include("include/header.php");?>
  <!-- /Header --> 
  
  <!-- Sidebar -->
  <?php include("include/sidebar.php");?>
  <!-- /Sidebar --> 
  
  <!-- Page Wrapper -->
  <div class="page-wrapper"> 
    
    <!-- Page Content -->
    <div class="content container-fluid"> 
      
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="page-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='116'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
              <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='116'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
            </ul>
          </div>
          <div class="col-auto float-right ml-auto"> <a href="meeting_list_form.php" class="btn add-btn"><i class="fa fa-plus"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='115'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
        </div>
      </div>
      <!-- /Page Header --> 
      
      <!-- Search Filter -->
      
      <div class="row filter-row">
       
        <!--div class="col-sm-6 col-md-2">
          <input type="text" id="search_text" placeholder="Search here ..." class="form-control srchcal"/>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 buttonlefotc">
          <button type="submit" class="btnsearch" id="search"  name="search"><i class="fa fa-search"></i></button>
          <button type="button" class="reseter" id="reset"  name="reset"><i class="fa fa-refresh"></i></button>
        </div-->
      </div>
      <p>&nbsp;</p>
      <!-- /Search Filter -->
      
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table mb-0" id="table-data">
              <thead>
                <tr>
                  
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='111'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='112'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='113'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='114'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $k = 1;
                $SQLestimate = "select * from meeting_list order by id DESC";
                $Resultestimate = mysqli_query( $link, $SQLestimate );
                while ( $listestimate = mysqli_fetch_array( $Resultestimate ) ) {
                  $estimate_id = $listestimate['id'];


                  ?>
                <tr>
                  
                  <td><?php echo $listestimate['email_id'];?></td>
                  <td><?php echo $listestimate['meeting_propsal'];?></td>
                  <td><?php echo $listestimate['location'];?></td>
                  <td><?php echo $listestimate['start_time'];?></td>
                  <td><?php echo $listestimate['end_time'];?></td>
                  <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					  
					 
					  
                      <div class="dropdown-menu dropdown-menu-right"> 
						   
						   
						  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_estimate<?php echo $estimate_id;?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
					  
					  </div>
                    </div></td>
                </tr>
              <div class="modal custom-modal fade" id="delete_estimate<?php echo $estimate_id;?>" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="form-header">
                        <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                        <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='101'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
                      </div>
                      <div class="modal-btn delete-action">
                        <div class="row">
                          <div class="col-6"> <a href="meeting_list.php?del=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                          <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='35'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $k++; } ?>
              </tbody>
              
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /Page Content --> 
    
    <!-- Delete Estimate Modal --> 
    
    <!-- /Delete Estimate Modal --> 
    
  </div>
  <!-- /Page Wrapper --> 
  
</div>
<!-- /Main Wrapper --> 

<!-- jQuery --> 

<script src="assets\js\jquery-3.5.1.min.js"></script> 

<!-- Bootstrap Core JS --> 
<script src="assets\js\popper.min.js"></script> 
<script src="assets\js\bootstrap.min.js"></script> 

<!-- Slimscroll JS --> 
<script src="assets\js\jquery.slimscroll.min.js"></script> 

<!-- Select2 JS --> 
<script src="assets\js\select2.min.js"></script> 

<!-- Datatable JS --> 
<script src="assets\js\jquery.dataTables.min.js"></script> 
<script src="assets\js\dataTables.bootstrap4.min.js"></script> 

<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>  
<!-- Custom JS --> 
<script src="assets\js\app.js"></script> 
<script>
	
	
$(document).ready(function(){
$("#search").click(function(){
var query = $("#status").val();
var from_search = $("#from_search").val();
var to_search = $("#to_search").val();
var customer = $("#customer").val();
var phone_user = $("#phone_user").val();
var myval = $("input[name=nameid]:checked").val();
	
$.ajax({
url : 'fetch.php',
method:'post',
data:{query:query,from_search:from_search,to_search:to_search,customer:customer,phone_user:phone_user,nameid:myval},
success:function(response){
$("#table-data").html(response);
}
});
});
	
	
$("#reset").click(function(){
var reset = $("#reset").val();
$.ajax({
url : 'invoice_reset.php',
method:'post',
data:{reset:reset},
success:function(response){
$("#table-data").html(response);
}
});
});		
});
function show1(){
  document.getElementById('div1').style.display ='none';
	document.getElementById('div2').style.display = 'block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
	document.getElementById('div2').style.display = 'none';
}
</script>



</body>
</html>