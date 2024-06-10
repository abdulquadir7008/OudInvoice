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
if ( isset( $_POST[ 'add' ] ) || isset( $_POST[ 'update' ] ) ) {
  $client = $_REQUEST[ 'client' ];

  $email = $_REQUEST[ 'email' ];
  $tax = $_REQUEST[ 'tax' ];
  $client_address = $_REQUEST[ 'client_address' ];
  $billing_address = $_REQUEST[ 'billing_address' ];
  $estimate_date = $_REQUEST[ 'estimate_date' ];
  $expire_date = $_REQUEST[ 'expire_date' ];
  $othet_information = $_REQUEST[ 'othet_information' ];
  $delivery_charge = $_REQUEST['delivery_charge'];
}
if ( isset( $_POST[ 'add' ] ) ) {
  $querybord = "insert into spl_invoice (client,email,tax,estimate_date,expire_date,status,othet_information,delivery_charge) values('$client','$email','$tax','$estimate_date','$expire_date','1','$othet_information','$delivery_charge')";
  mysqli_query( $link, $querybord );
  $last_id = mysqli_insert_id( $link );
  foreach ( $_POST[ 'itemes' ] as $index => $itemes ) {
    $description = $_POST[ 'description' ][ $index ];
    $unitcost = $_POST[ 'unitcost' ][ $index ];
    $qty = $_POST[ 'qty' ][ $index ];
    $amount = $_POST[ 'amount' ][ $index ];
    $query1001 = "INSERT INTO invoice_item(itemes,description,unitcost,qty,amount,etimate_id) values ('$itemes','$description','$unitcost','$qty','$amount','$last_id')";
    mysqli_query( $link, $query1001 );
  }

  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Add Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'estimaterore' ] = $errmsg_arr;
  session_write_close();
  //header('Location: ' . $_SERVER['HTTP_REFERER']);
} else if ( isset( $_POST[ 'update' ] ) ) {
  $estimate_id = $_REQUEST[ 'estimate_id' ];
  $query = "update spl_invoice SET client='$client',project='$project',email='$email',tax='$tax',billing_address='$billing_address',estimate_date='$estimate_date',expire_date='$expire_date',othet_information='$othet_information',delivery_charge='$delivery_charge' WHERE estimate_id=$estimate_id";
  mysqli_query( $link, $query );

  foreach ( $_POST[ 'itemes' ] as $index2 => $revnue2 ) {
    $description = $_POST[ 'description' ][ $index2 ];
    $ider = $_POST[ 'itemid' ][ $index2 ];
    $itemes = $_POST[ 'itemes' ][ $index2 ];
    $unitcost = $_POST[ 'unitcost' ][ $index2 ];
    $qty = $_POST[ 'qty' ][ $index2 ];
    $amount = $_POST[ 'amount' ][ $index2 ];

    if ( $ider ) {
      $query100 = "update invoice_item SET itemes='$itemes',description='$description',unitcost='$unitcost',qty='$qty',amount='$amount' WHERE estimate_item_id=$ider";
      mysqli_query( $link, $query100 );
    } else if ( empty( $itemes ) ) {
      $query = "delete from invoice_item WHERE estimate_item_id=$ider";
      mysqli_query( $link, $query );
    } else {

      $query1001 = "INSERT INTO invoice_item(itemes,description,unitcost,qty,amount,etimate_id) values ('$itemes','$description','$unitcost','$qty','$amount','$estimate_id')";
      mysqli_query( $link, $query1001 );

    }


  }


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>invoice item Update Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'estimaterore' ] = $errmsg_arr;
  session_write_close();
  //header('Location: ' . $_SERVER['HTTP_REFERER']);
} else if ( isset( $_REQUEST[ 'del' ] ) ) {
  $del = $_REQUEST[ 'del' ];
  $query = "delete from spl_invoice WHERE estimate_id=$del";
  mysqli_query( $link, $query );
  $query12 = "delete from invoice_item WHERE etimate_id=$del";
  mysqli_query( $link, $query12 );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Delete Successfully.</span></div>";
  $errflag = true;
  $_SESSION[ 'estimaterore' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}
$sql_admin = "select * from invoice_setting WHERE user_type='1'";
$result_admin = mysqli_query( $link, $sql_admin );
$list_admin = mysqli_fetch_array( $result_admin );


if ( isset( $_REQUEST[ 'aprove' ] ) ) {
  $aprove = $_REQUEST[ 'aprove' ];
  $query = "update spl_invoice SET status='2' WHERE estimate_id=$aprove";
  mysqli_query( $link, $query );
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
}
if ( isset( $_REQUEST[ 'decline' ] ) ) {
  $decline = $_REQUEST[ 'decline' ];
  $query = "update spl_invoice SET status='1' WHERE estimate_id=$decline";
  mysqli_query( $link, $query );
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
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
              <li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
            </ul>
          </div>
          <div class="col-auto float-right ml-auto"> <a href="invoice_form.php" class="btn add-btn"><i class="fa fa-plus"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='55'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
        </div>
      </div>
      <!-- /Page Header --> 
      
      <!-- Search Filter -->
      
      <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
          <div class="form-group form-focus select-focus2" id="div2">
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="customer" id="customer">
              <option value=""><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='56'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
              <?php
              $sqlclient = "select * from clients WHERE status='1' order by fullname ASC";
              $resultclient = mysqli_query( $link, $sqlclient );
              while ( $listclient = mysqli_fetch_array( $resultclient ) ) {
                ?>
              <option value="<?php echo $listclient['client_id'];?>" ><?php echo $listclient['fullname'];?></option>
              <?php } ?>
            </select>
          </div>
			
			<div id="div1" class="hide">
  <div class="form-group form-focus select-focus2">
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="phone_user" id="phone_user">
              <option value=""><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='57'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
              <?php
              $sqlclient = "select * from clients WHERE status='1'";
              $resultclient = mysqli_query( $link, $sqlclient );
              while ( $listclient = mysqli_fetch_array( $resultclient ) ) {
                ?>
              <option value="<?php echo $listclient['phone'];?>" ><?php echo $listclient['phone'];?></option>
              <?php } ?>
            </select>
          </div>
</div>
<div style="position: relative; top: -17px; left: 3px" class="cockchgr">
<input type="radio" name="nameid" id="nameid" value="nameid" onclick="show1();" checked /> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='58'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
&nbsp;&nbsp;&nbsp;<input type="radio" name="nameid" id="nameid" value="valueid" onclick="show2();" /> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
			</div>			
        </div>
        <div class="col-sm-6 col-md-2 col-6">
          <div class="form-group form-focus">
            <div class="cal-icon">
              <input class="form-control floating datetimepicker" name="from_search" id="from_search" type="text">
            </div>
            <label class="focus-label">From</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-2  col-6">
          <div class="form-group form-focus">
            <div class="cal-icon">
              <input class="form-control floating datetimepicker" name="to_search" id="to_search" type="text">
            </div>
            <label class="focus-label">To</label>
          </div>
        </div>
        <div class="col-sm-6 col-md-2 col-7">
          <div class="form-group form-focus select-focus">
            <select class=" form-control" name="status" id="status">
              <option value=""><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='59'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
              <option value="1"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='60'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
              <option value="2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
            </select>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 buttonlefotc col-5">
          <button type="submit" class="btnsearch" id="search"  name="search"><i class="fa fa-search"></i></button>
          <button type="button" class="reseter" id="reset"  name="reset"><i class="fa fa-refresh"></i></button>
        </div>
      </div>
      
      <!-- /Search Filter -->
      
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table mb-0" id="table-data">
              <thead>
                <tr>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='62'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='63'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='64'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='65'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='102'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $k = 1;
                $SQLestimate = "select * from spl_invoice WHERE status LIKE '%$search_employe%' order by estimate_id DESC";
                $Resultestimate = mysqli_query( $link, $SQLestimate );
                while ( $listestimate = mysqli_fetch_array( $Resultestimate ) ) {
                  $clientid = $listestimate[ 'client' ];
                  $myOriginalDate = str_replace( '/', '-', $listestimate[ 'expire_date' ] );
                  $curdate_holiday = strtotime( date( "d-m-Y" ) );
                  $holiday = strtotime( $myOriginalDate );
                  $estimate_id = $listestimate[ 'estimate_id' ];
                  $sqlclients = "select * from clients WHERE client_id='$clientid'";
                  $resultclients = mysqli_query( $link, $sqlclients );
                  $listclients = mysqli_fetch_array( $resultclients );


                  ?>
                <tr>
                  <td><a href="invoice_form.php?edit=<?php echo $estimate_id;?>"><?php echo $list_admin['invocie_prifix'];?>-000<?php echo $estimate_id;?></a></td>
                  <td><?php echo $listclients['fullname'];?></td>
                  <td><?php echo $listestimate['estimate_date'];?></td>
                  <td><?php echo $listestimate['expire_date'];?>
                    <?php if($curdate_holiday > $holiday){?>
                    <span class="badge bg-inverse-warning">
						<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='67'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
                    <?php }?></td>
                  <td><?php
                  $totalSum = '0';
                  $itemtotal = '';
					$delivery= '0';	
                  $sqlitem = "select * from invoice_item WHERE etimate_id='$estimate_id'";
                  $resultitemprice = mysqli_query( $link, $sqlitem );
                  while ( $listitem = mysqli_fetch_array( $resultitemprice ) ) {
                    $itemtotal = $listitem[ 'qty' ] * $listitem[ 'unitcost' ];
                    $totalSum += $itemtotal;
					  	$isetId = $listitem['estimate_item_id'];
					  	if($listitem['itemes']==0){
							$query="delete from invoice_item WHERE estimate_item_id=$isetId";
							mysqli_query($link,$query);
																
															}
                  }
					if( $listestimate['delivery_charge']){
						$delivery = $listestimate['delivery_charge'];
					}
					echo number_format(( $totalSum * $listestimate[ 'tax' ] / 100 ) + $totalSum + $delivery,2, '.', ',');
               
                  ?></td>
                  <td><div class="dropdown action-label"> <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                      <?php if($listestimate['status'] == '2'){?>
                      <i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } else {?>
                      <i class="fa fa-dot-circle-o text-danger"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } ?>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-info"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      </a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                    </div>
                    <div class="modal custom-modal fade" id="approve_leave<?php echo $estimate_id;?>" role="dialog">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="form-header">
                              <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='69'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                              <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='33'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                              <div class="row">
                                <div class="col-6"> <a href="invoice.php?aprove=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='70'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                                <div class="col-6"> <a href="invoice.php?decline=<?php echo $estimate_id;?>" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='71'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div></td>
                  <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					  
					 
					  
                      <div class="dropdown-menu dropdown-menu-right"> 
						  <a class="dropdown-item" href="invoice_form.php?edit=<?php echo $estimate_id;?>"><i class="fa fa-pencil m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> 
						   <a class="dropdown-item" href="invoice_view.php?gen=<?php echo $estimate_id;?>" target="_blank"><i class="fa fa-eye m-r-5"></i><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='72'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
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
                          <div class="col-6"> <a href="invoice.php?del=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
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