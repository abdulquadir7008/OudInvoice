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
if ( isset( $_POST[ 'update' ] ) || isset( $_POST[ 'add' ] ) ) {
  $sname = $_REQUEST[ 'sname' ];
  $country_id = $_REQUEST[ 'country_id' ];
	$state_id = $_REQUEST['state_id'];
}
if ( isset( $_POST[ 'add' ] ) ) {

  $querybord = "insert into state_add (sname,country_id) values('$sname','$country_id')";
  mysqli_query( $link, $querybord );

  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Product Add Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
} else if ( isset( $_POST[ 'update' ] ) ) {
  $query = "update state_add SET sname='$sname',country_id='$country_id' WHERE state_id=$state_id";
  mysqli_query( $link, $query );


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Product Update Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
} else if ( isset( $_REQUEST[ 'del' ] ) ) {
  $del = $_REQUEST[ 'del' ];
	$query = "delete from state_add WHERE state_id=$del";
  mysqli_query( $link, $query );


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Product Delete Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}
if ( isset( $_REQUEST[ 'search_crm' ] ) ) {
  if ( $_REQUEST[ 'projectsearch' ] != '' ) {
    echo $sername = $_REQUEST[ 'projectsearch' ];
    $btnsrst = "AND project_name LIKE '%$sername%'";
  } else {
    $btnsrst = '';
  }
  if ( $_REQUEST[ 'leadsearch' ] != '' ) {
    echo $leadsearch = $_REQUEST[ 'leadsearch' ];
    $btncompany = "AND lead='$leadsearch'";
  } else {
    $btncompany = '';
  }
} else if ( isset( $_REQUEST[ 'reset' ] ) ) {
  $btncompany = '';
  $btnsrst = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php");?>
<script src="assets\js\jquery-3.5.1.min.js"></script> 
<script>
		$(document).ready(function(){

    $("#sel_depart").change(function(){
        var deptid = $(this).val();

        $.ajax({
            url: 'getUsers.php',
            type: 'post',
            data: {depart:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#sel_user").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

});
		</script>
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
      <?php
      if ( isset( $_SESSION[ 'clients_expensive' ] ) && is_array( $_SESSION[ 'clients_expensive' ] ) && count( $_SESSION[ 'clients_expensive' ] ) > 0 ) {
        foreach ( $_SESSION[ 'clients_expensive' ] as $msg ) {
          echo $msg;
        }
        unset( $_SESSION[ 'clients_expensive' ] );
      }
      ?>
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="page-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
              <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
            </ul>
          </div>
          <div class="col-auto float-right ml-auto"> <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='133'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
        </div>
      </div>
      <div class="row" style="margin: 20px 0; margin-left: -15px;">
<!--
        <div class="col-md-3">
          <input type="text" id="search_text" placeholder="Search here ..." class="form-control srchcal"/>
          <span class="fa fa-search  searchicon"></span> </div>
-->
        <!--  <div class="col-md-2">
        <button type="button" name="search" class="btn btn-primary" id="search">Search</button>
		   <a href="users.php?date=reset" class="btn btn-white btn-block">RESET</a>
      </div>  --> 
        
      </div>
		
		<div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table datatable" id="table-data">
            <thead>
              <tr>
				
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='134'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='132'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                
                <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
              </tr>
            </thead>
            <tbody>
           
            <div class="row staff-grid-row">
            
            <?php

            $SQDepart = "select * from state_add LEFT JOIN country ON state_add.country_id=country.country_id order by state_id DESC";
            $ResultDepart = mysqli_query( $link, $SQDepart );
            while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
              ?>
            <tr>
             
              <td><?php echo $ListDepart['sname'];?></td>
              <td><?php echo $ListDepart['cname'];?></td>
              
              <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['state_id'];?>"><i class="fa fa-pencil m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['state_id'];?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div></td>
            </tr>
            <div id="edit_client<?php echo $ListDepart['state_id'];?>" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='135'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body armoel_label" dir="rtl">
                    <form method="post" action="add_city.php" enctype="multipart/form-data">
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='134'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control" name="sname" value="<?php echo $ListDepart['sname'];?>" maxlength="20" type="text" required>
                          </div>
                        </div>
						  <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <br>
                            <select class="form-control" onChange="showCityedtit(this);" data-show-subtext="true" data-live-search="true" name="country_id">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </option>
                              <?php
                      $leave_tbl2_sql = "select * from country order by cname ASC";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                        ?>
                      <option value="<?php echo $leave_tbl2_row['country_id'];?>" <?php if($leave_tbl2_row['country_id']==$ListDepart['country_id']){?>selected<?php } ?> ><?php echo $leave_tbl2_row['cname'];?></option>
                      <?php } ?>
                            </select>
                          </div>
							  
                        </div>
						</div>
						
						
                        
                      <div class="submit-section">
                        <input type="hidden" name="state_id" value="<?php echo $ListDepart['state_id'];?>">
                        <button type="submit" name="update" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='31'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['state_id'];?>" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form-header">
                      <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='53'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                      <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='101'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
                    </div>
                    <div class="modal-btn delete-action">
                      <div class="row">
                        <div class="col-6"> <a href="add_city.php?del=<?php echo $ListDepart['state_id'];?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                        <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='35'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php  }?>
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
		
      
    </div>
    <!-- /Page Content --> 
    
    <!-- Create Project Modal -->
    <div id="create_project" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='44'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body armoel_label"  dir="rtl">
            <form method="post" action="add_city.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="sname" type="text">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="country_id">
                      <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                      <?php
                      $leave_tbl2_sql = "select * from country order by cname ASC";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                        ?>
                      <option value="<?php echo $leave_tbl2_row['country_id'];?>"><?php echo $leave_tbl2_row['cname'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              
              
              
              <div class="submit-section">
                <button type="submit" name="add" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='36'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Create Project Modal --> 
    
    <!-- Edit Project Modal --> 
    
    <!-- /Edit Project Modal --> 
    
    <!-- Delete Project Modal --> 
    
    <!-- /Delete Project Modal --> 
    
  </div>
  <!-- /Page Wrapper --> 
  
</div>
<!-- /Main Wrapper --> 

<!-- jQuery --> 

<!-- Bootstrap Core JS --> 
<script src="assets\js\popper.min.js"></script> 
<script src="assets\js\bootstrap.min.js"></script> 

<!-- Slimscroll JS --> 
<script src="assets\js\jquery.slimscroll.min.js"></script> 

<!-- Select2 JS --> 
<script src="assets\js\select2.min.js"></script> 
<script src="assets\js\jquery.dataTables.min.js"></script>
<script src="assets\js\dataTables.bootstrap4.min.js"></script>
<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 

<!-- Custom JS --> 
<script src="assets\js\app.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
<script>	
$(document).ready(function(){
$("#search_text").keyup(function(){
var search = $(this).val();
$.ajax({
url : 'prod_acction.php',
method:'post',
data:{query:search},
success:function(response){
$("#table-data").html(response);
}
});
});
});		
</script>
</body>
</html>