<?php
include( "config.php" );
error_reporting(0);
ob_start();
$btnsrst = '';
$btncompany = '';
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
  $fullname = $_REQUEST[ 'fullname' ];
  $email = $_REQUEST[ 'email' ];
  $phone = $_REQUEST[ 'phone' ];
  $client_id = $_REQUEST[ 'client_id' ];
  $comment = $_REQUEST[ 'comment' ];
  $city = $_REQUEST[ 'city' ];
  $country_id = $_REQUEST[ 'country_id' ];
  $address = $_REQUEST[ 'address' ];
  $instaid = $_REQUEST['instaid'];

//  if ( $_FILES[ "image" ][ "name" ] != '' ) {
//    if ( ( $_FILES[ "image" ][ "type" ] == "image/gif" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/jpeg" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/pjpeg" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/X-PNG" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/PNG" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/png" ) ||
//      ( $_FILES[ "image" ][ "type" ] == "image/x-png" ) ) {
//      $image = "$path0" . $rand1 . $_FILES[ "image" ][ "name" ];
//      $image0 = $rand1 . $_FILES[ "image" ][ "name" ];
//      move_uploaded_file( $_FILES[ "image" ][ "tmp_name" ], $image );
//    } else {
//      $image0 = '';
//    }
//  } else {
//    $image0 = $_REQUEST[ 'hiddenimage' ];
//  }


}


if ( isset( $_POST[ 'add' ] ) ) {


  $querybord = "insert into clients (fullname,email,phone,comment,city,create_date,status,address,country_id,instaid) values('$fullname','$email','$phone','$comment','$city',now(),'1','$address','$country_id','$instaid')";
  mysqli_query( $link, $querybord );

  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>User Add Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
} else if ( isset( $_POST[ 'update' ] ) ) {
  $query = "update clients SET fullname='$fullname',email='$email',phone='$phone',comment='$comment',city='$city',address='$address',country_id='$country_id',instaid='$instaid' WHERE client_id=$client_id";
  mysqli_query( $link, $query );


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>User Update Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
} else if ( isset( $_REQUEST[ 'del' ] ) ) {
  $del = $_REQUEST[ 'del' ];
	$query = "update clients SET status='2' WHERE client_id=$del";

  mysqli_query( $link, $query );


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>User Delete Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}
if ( isset( $_REQUEST[ 'reset' ] ) ) {
  $btncompany = '';
  $btnsrst = '';
}
?>
<!DOCTYPE html>
<html lang="ar">
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
			
function showCity(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$(".output2").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "fetch_area.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('.output2').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$(".output2").html( html );
				
			}
		});
	} 
}
	function showCityedtit(sel) {
	var city_ider = sel.options[sel.selectedIndex].value;  
	$(".outputkor").html( "" );
	 if (city_ider.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "fetch_area2.php",
			data: "city_ider="+city_ider,
			cache: false,
			beforeSend: function () { 
				$('.outputkor').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$(".outputkor").html( html );
				
			}
		});
	} 
}
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
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </a></li>
            <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto"> <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='15'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
      </div>
    </div>
    <!-- /Page Header -->
    <div class="row" style="margin: 20px 0; margin-left: -15px;">
      <div class="col-md-6 col-lg-3">
        <input type="text" id="search_text" placeholder="Search here ..." class="form-control srchcal"/>
		  <span class="fa fa-search  searchicon"></span>
      </div>
    <!--  <div class="col-md-2">
        <button type="button" name="search" class="btn btn-primary" id="search">Search</button>
		   <a href="users.php?date=reset" class="btn btn-white btn-block">RESET</a>
      </div>  -->
		
    </div>
    <span id="total_records"></span> 
    
  
    
    <!-- Search Filter -->
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table datatable" id="table-data">
            <thead>
              <tr>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='16'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='128'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='19'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
              </tr>
            </thead>
            <tbody>
           
            <div class="row staff-grid-row">
            
            <?php

            $SQDepart = "select * from clients WHERE status='1' order by client_id DESC";
            $ResultDepart = mysqli_query( $link, $SQDepart );
            while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
              ?>
            <tr>
              <td><h2 class="table-avatar"> <a href=""><?php echo $ListDepart['fullname'];?></a> </h2></td>
              <td><?php echo $ListDepart['instaid'];?></td>
              <td><?php echo $ListDepart['phone'];?></td>
              <td><?php echo substr($ListDepart['address'], 0, 70);?></td>
              <td><?php
              $city2_id = $ListDepart[ 'city' ];
              $sql_city = "SELECT * FROM state_add WHERE state_id= '$city2_id'";
              $result_cms2 = mysqli_query( $link, $sql_city );
              $rowcity_col = mysqli_fetch_array( $result_cms2 );
              echo $rowcity_col[ 'sname' ];
              ?></td>
              <td><?php
              $country_id123 = $ListDepart[ 'country_id' ];
              $sql_country = "SELECT * FROM country WHERE country_id= '$country_id123'";
              $rescountry = mysqli_query( $link, $sql_country );
              $rowcountry = mysqli_fetch_array( $rescountry );
              echo $rowcountry[ 'cname' ];
              ?></td>
              <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-pencil m-r-5"></i> 
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-trash-o m-r-5"></i>
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>  
					  </a> <a href="invoice_form.php?user=<?php echo $ListDepart['client_id'];?>" class="dropdown-item"><i class="fa fa-file-o m-r-5"></i><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='23'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div></td>
            </tr>
            <div id="edit_client<?php echo $ListDepart['client_id'];?>" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='24'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="users.php" enctype="multipart/form-data">
                      
                      <div class="row" dir="rtl">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-form-label">
								<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='25'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control" maxlength="30" name="fullname" value="<?php echo $ListDepart['fullname'];?>" type="text" required>
                          </div>
                        </div>
						  
						  <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='128'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?><span class="text-danger">*</span></label>
                    <input class="form-control floating" name="instaid" type="text" value="<?php echo $ListDepart['instaid'];?>">
                  </div>
                </div>
						  
                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </label>
                            <input class="form-control" maxlength="15" name="phone" type="text" value="<?php echo $ListDepart['phone'];?>">
                          </div>
                        </div>
                  
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label">
								<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								 <span class="text-danger">*</span></label>
                            <br>
                            <select class="select form-control" onChange="showCityedtit(this);" data-show-subtext="true" data-live-search="true" name="country_id">
                              <option> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='27'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                              <?php
                              $leave_tbl2_sql = "select * from country";
                              $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                              while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                                ?>
                              <option value="<?php echo $leave_tbl2_row['country_id'];?>" <?php if($leave_tbl2_row['country_id']==$country_id123){?>selected<?php } ?>><?php echo $leave_tbl2_row['cname'];?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <select class="select form-control outputkor" name="city">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='28'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                              <?php
                              $sql = "SELECT * FROM state_add WHERE country_id= '$country_id123' ORDER BY sname ASC";
                              $result_cms2 = mysqli_query( $link, $sql );
                              while ( $row_cms2 = mysqli_fetch_array( $result_cms2 ) ) {
                                ?>
                              <option value="<?php echo $row_cms2["state_id"]; ?>" <?php if($row_cms2["state_id"]==$ListDepart['city']){?>selected<?php } ?> ><?php echo $row_cms2["sname"]; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='29'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" maxlength="100" name="address"><?php echo $ListDepart['address'];?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='30'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" maxlength="200" name="comment"><?php echo $ListDepart['comment'];?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="submit-section">
                        <input type="hidden" name="client_id" value="<?php echo $ListDepart['client_id'];?>">
                        <button type="submit" name="update" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='31'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['client_id'];?>" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form-header">
                      <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='41'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                      <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='101'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
                    </div>
                    <div class="modal-btn delete-action">
                      <div class="row">
                        <div class="col-6"> <a href="users.php?del=<?php echo $ListDepart['client_id'];?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
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
    <!-- /Page Content --> 
    
    <!-- Add Client Modal -->
    <div id="add_client" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='15'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form method="post" action="users.php" enctype="multipart/form-data">
              <div class="row" dir="rtl">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='25'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                    <input class="form-control" name="fullname" maxlength="30" type="text" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='128'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?><span class="text-danger">*</span></label>
                    <input class="form-control floating" name="instaid" type="text" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                    <input class="form-control" maxlength="15" name="phone" type="text" required>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                    <select class="select selectpicker" onChange="showCity(this);" data-show-subtext="true" data-live-search="true" name="country_id" required>
                      <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='27'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                      <?php
                      $leave_tbl2_sql = "select * from country";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
						  
                        ?>
                      
						<option value="<?php echo $leave_tbl2_row['country_id'];?>"><?php echo $leave_tbl2_row['cname'];?></option>
                      <?php }  ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                    <select class="select form-control output2"  name="city" required>
                      <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='28'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
						<?php
                              $sql = "SELECT * FROM state_add ORDER BY sname ASC";
                              $result_cms2 = mysqli_query( $link, $sql );
                              while ( $row_cms2 = mysqli_fetch_array( $result_cms2 ) ) {
                                ?>
                              <option value="<?php echo $row_cms2["state_id"]; ?>"><?php echo $row_cms2["sname"]; ?></option>
                              <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='29'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <textarea class="form-control" maxlength="150" name="address"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='30'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <textarea class="form-control" maxlength="200" name="comment"></textarea>
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
    <!-- /Add Client Modal --> 
    
    <!-- Edit Client Modal --> 
    
    <!-- /Edit Client Modal --> 
    
    <!-- Delete Client Modal --> 
    
    <!-- /Delete Client Modal --> 
    
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
<script src="assets\js\jquery.dataTables.min.js"></script>
<script src="assets\js\dataTables.bootstrap4.min.js"></script>
<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 

<!-- Custom JS --> 
<script src="assets\js\app.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>  
<script>	
$(document).ready(function(){
$("#search_text").keyup(function(){
var search = $(this).val();
$.ajax({
url : 'action.php',
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