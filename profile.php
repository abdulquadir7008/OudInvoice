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

$personal_info_sql = "select * from personal_info WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
$listinfo_row = mysqli_fetch_array( $personal_info_resu );

$emegency_contact_sql = "select * from emegency_contact WHERE profile_id=$customerchechlogin_id";
$emegency_contact_resu = mysqli_query($link, $emegency_contact_sql);
$listemegency_contact_row = mysqli_fetch_array( $emegency_contact_resu);

$bank_details_sql = "select * from bank_details WHERE profile_id=$customerchechlogin_id";
$bank_details_resu = mysqli_query($link, $bank_details_sql);
$listbank_details_row = mysqli_fetch_array( $bank_details_resu);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php");?>
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
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='12'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
            <ul class="breadcrumb">
				<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
			  <?php } ?>
             
              <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='12'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      
      <div class="card mb-0">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="profile-view">
                <div class="profile-img-wrap">
                  <div class="profile-img">
                    <?php if($customerchechlogin_row['image']!='') { ?>
                    <img class="inline-block" src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                    <?php } else{ ?>
                    <img class="inline-block" src="assets\img\user.jpg" alt="user">
                    <?php } ?>
                  </div>
                </div>
                <div class="profile-basic">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="profile-info-left">
                        <h3 class="user-name m-t-0 mb-0"><?php echo $customerchechlogin_row['fullname'];?></h3>
                        
						<?php if($customerchechlogin_row['emirateid']){?>  
                        <div class="staff-id"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='119'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : <?php echo $customerchechlogin_row['emirateid'];?></div>
						  <?php } ?>
                        <!--div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div-->
                      </div>
                    </div>
                    <div class="col-md-7">
                      <ul class="personal-info">
                        <li>
                          <div class="title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : <?php echo $customerchechlogin_row['emirateid'];?>:</div>
                          <div class="text"><a href=""><?php echo $customerchechlogin_row['phone'];?></a></div>
                        </li>
                        <li>
                          <div class="title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='17'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : <?php echo $customerchechlogin_row['emirateid'];?>:</div>
                          <div class="text"><a href=""><?php echo $customerchechlogin_row['email'];?></a></div>
                        </li>
                        <li>
                          <div class="title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='120'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : <?php echo $customerchechlogin_row['emirateid'];?>:</div>
                          <div class="text"><?php echo $customerchechlogin_row['dob'];?></div>
                        </li>
                        <li>
                          <div class="title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='29'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>:</div>
                          <div class="text"><?php echo $customerchechlogin_row['address'];?></div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card tab-box">
        <div class="row user-tabs">
          <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
              <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='12'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="tab-content"> 
        
        <!-- Profile Info Tab -->
        
        <!-- /Profile Info Tab --> 
        
        
        
      </div>
    </div>
    <!-- /Page Content --> 

    
   
    
  </div>
  <!-- /Page Wrapper --> 
  
</div>
<!-- /Main Wrapper --> 
<div id="profile_info" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='121'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form name="profileupdate" method="post" action="script/profileup.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="profile-img-wrap edit-img">
                    <?php if($customerchechlogin_row['image']!='') { ?>
                    <img class="inline-block" src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                    <?php } else{ ?>
                    <img class="inline-block" src="assets\img\user.jpg" alt="user">
                    <?php } ?>
                    <div class="fileupload btn"> <span class="btn-text"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='122'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
                      <input type="file" class="upload" name="image"/>
                      <input type="hidden" name="hiddenimage" value="<?php echo $customerchechlogin_row['image']; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='25'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                        <input type="text" name="fullname" class="form-control" 
														value="<?php echo $customerchechlogin_row['fullname'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='123'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                        <div class="cal-icon">
                          <input class="form-control datetimepicker" name="dob" type="text" 
															value="<?php echo $customerchechlogin_row['dob'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $customerchechlogin_row['phone'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='119'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                        <input type="text" name="emirateid" class="form-control" value="<?php echo $customerchechlogin_row['emirateid'];?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='29'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input type="text" name="address" class="form-control" value="<?php echo $customerchechlogin_row['address'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input type="text" class="form-control" name="country" value="<?php echo $customerchechlogin_row['country'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input type="text" name="city" class="form-control"
												 value="<?php echo $customerchechlogin_row['city'];?>">
                  </div>
                </div>
              </div>
              <div class="submit-section">
                <input type="hidden" name="cusid" value="<?php echo $customerchechlogin_row['id'];?>">
                <button class="btn btn-primary submit-btn" name="profup"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='124'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- jQuery --> 
<script src="assets\js\jquery-3.5.1.min.js"></script> 

<!-- Bootstrap Core JS --> 
<script src="assets\js\popper.min.js"></script> 
<script src="assets\js\bootstrap.min.js"></script> 

<!-- Slimscroll JS --> 
<script src="assets\js\jquery.slimscroll.min.js"></script> 

<!-- Select2 JS --> 
<script src="assets\js\select2.min.js"></script> 

<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 

<!-- Tagsinput JS --> 
<script src="assets\plugins\bootstrap-tagsinput\bootstrap-tagsinput.min.js"></script> 

<!-- Custom JS --> 
<script src="assets\js\app.js"></script>
</body>
</html>