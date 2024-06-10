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
  $project_name = $_REQUEST[ 'project_name' ];
  $client = $_REQUEST[ 'client' ];
  $description = $_REQUEST[ 'description' ];
  $id = $_REQUEST[ 'id' ];
	$product_weight = $_REQUEST[ 'product_weight' ];
	$product_code = $_REQUEST[ 'product_code' ];
	$price = $_REQUEST[ 'price' ];
 
  if ( $_FILES[ "image" ][ "name" ] != '' ) {
    if ( ( $_FILES[ "image" ][ "type" ] == "application/docx" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/jpeg" ) ||
      ( $_FILES[ "image" ][ "type" ] == "application/pdf" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/X-PNG" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/PNG" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/png" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/x-png" ) ) {
      $image = "$path0" . $rand1 . $_FILES[ "image" ][ "name" ];
      $image0 = $rand1 . $_FILES[ "image" ][ "name" ];
      move_uploaded_file( $_FILES[ "image" ][ "tmp_name" ], $image );
    } else {
      $image0 = '';
    }
  } else {
    $image0 = $_REQUEST[ 'hiddenimage' ];
  }


}


if ( isset( $_POST[ 'add' ] ) ) {


  $querybord = "insert into project (project_name,client,start_date,image,sts,description,product_code,product_weight,price) values('$project_name','$client',now(),'$image0','1','$description','$product_code','$product_weight','$price')";
  mysqli_query( $link, $querybord );

  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Product Add Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'clients_expensive' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
} else if ( isset( $_POST[ 'update' ] ) ) {
  $query = "update project SET project_name='$project_name',client='$client',end_date=now(),image='$image0',description='$description',product_code='$product_code',product_weight='$product_weight',price='$price' WHERE id=$id";
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
	$query = "update project SET sts='2' WHERE id=$del";
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
if($list_lang['lang_id']=='43'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
              <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='43'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
            </ul>
          </div>
          <div class="col-auto float-right ml-auto"> <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='44'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
        </div>
      </div>
      <div class="row" style="margin: 20px 0; margin-left: -15px;">
        <div class="col-md-3">
          <input type="text" id="search_text" placeholder="Search here ..." class="form-control srchcal"/>
          <span class="fa fa-search  searchicon"></span> </div>
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
if($list_lang['lang_id']=='45'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='38'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='47'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='48'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
             
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='49'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
				 <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th> 
                <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
              </tr>
            </thead>
            <tbody>
           
            <div class="row staff-grid-row">
            
            <?php

            $SQDepart = "select * from project LEFT JOIN ac_category ON project.client=ac_category.ac_cat_id WHERE sts='1' order by id DESC";
            $ResultDepart = mysqli_query( $link, $SQDepart );
            while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
              ?>
            <tr>
              <td> <a href="">
                  <?php if($ListDepart['image']!='') { ?>
                  <img src="uploads/<?php echo $ListDepart['image'];?>" alt="" width="70">
                  <?php } else{ ?>
                  <img class="inline-block" src="assets\img\user.jpg" alt="user" width="70">
                  <?php } ?>
                  </a></td>
              <td><?php echo $ListDepart['project_name'];?></td>
              <td><?php echo $ListDepart['catname'];?></td>
              <td><?php if($ListDepart['price']){echo number_format($ListDepart['price'],2, '.', ',');}?></td>
              <td><?php echo $ListDepart['product_code'];?></td>
              <td><?php echo $ListDepart['product_weight'];?></td>
				<td><?php echo substr($ListDepart['description'], 0, 70);?></td>
              <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['id'];?>"><i class="fa fa-pencil m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['id'];?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div></td>
            </tr>
            <div id="edit_client<?php echo $ListDepart['id'];?>" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='51'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body armoel_label" dir="rtl">
                    <form method="post" action="products.php" enctype="multipart/form-data">
                      <?php if($ListDepart['image']!='') { ?>
                      <div class="profile-img-wrap edit-img"> <img class="inline-block" src="uploads/<?php echo $ListDepart['image'];?>" width="100" /> </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control" name="project_name" value="<?php echo $ListDepart['project_name'];?>" maxlength="20" type="text" required>
                          </div>
                        </div>
						  <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='38'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <br>
                            <select class="form-control" onChange="showCityedtit(this);" data-show-subtext="true" data-live-search="true" name="client">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </option>
                              <?php
                      $leave_tbl2_sql = "select * from ac_category WHERE status='1'";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                        ?>
                      <option value="<?php echo $leave_tbl2_row['ac_cat_id'];?>" <?php if($leave_tbl2_row['ac_cat_id']==$ListDepart['client']){?>selected<?php } ?> ><?php echo $leave_tbl2_row['catname'];?></option>
                      <?php } ?>
                            </select>
                          </div>
							  
                        </div>
						</div>
						
						<div class="row">
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='47'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="8" name="price" type="text" value="<?php echo $ListDepart['price'];?>">
                  </div>
                </div>
				<div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='48'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="product_code" type="text" value="<?php echo $ListDepart['product_code'];?>">
                  </div>
                </div>
				  
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='49'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="product_weight" type="text" value="<?php echo $ListDepart['product_weight'];?>">
                  </div>
                </div>
				</div>
                        <div class="row">
							<div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" maxlength="200" name="description"><?php echo $ListDepart['description'];?></textarea>
                          </div>

                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='45'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <input class="form-control" name="image" type="file">
                            <input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
                          </div>
                        </div>
                        
                        
                        
                        
                      </div>
                      <div class="submit-section">
                        <input type="hidden" name="id" value="<?php echo $ListDepart['id'];?>">
                        <button type="submit" name="update" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='31'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['id'];?>" role="dialog">
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
                        <div class="col-6"> <a href="products.php?del=<?php echo $ListDepart['id'];?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
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
            <form method="post" action="products.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="project_name" type="text">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="client">
                      <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                      <?php
                      $leave_tbl2_sql = "select * from ac_category WHERE status='1'";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                        ?>
                      <option value="<?php echo $leave_tbl2_row['ac_cat_id'];?>"><?php echo $leave_tbl2_row['catname'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='47'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="8" name="price" type="text">
                  </div>
                </div>
				<div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='48'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="product_code" type="text">
                  </div>
                </div>
				  
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='49'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" maxlength="20" name="product_weight" type="text">
                  </div>
                </div>
				</div>
              <div class="form-group">
                <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                <textarea name="description" maxlength="200" rows="4" class="form-control summernote" placeholder="Enter your message here"></textarea>
              </div>
              <div class="form-group">
                <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='45'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                <input class="form-control" name="image" type="file">
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