<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);

?>
<!DOCTYPE html>
<html>
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
							
							
							<?php 
	$totalinvoice = '0';
	$subtotalinvoice = '0';
	$sqltaskcount="select * from spl_invoice WHERE status='1'"; $resultaskcount=mysqli_query($link,$sqltaskcount);
	while($invoice_total=mysqli_fetch_array($resultaskcount)){
	$tax_pen= $invoice_total['tax'];
	$estimate_id = $invoice_total[ 'estimate_id' ];
	$totalSum = '0';
		$start = strtotime($invoice_total[ 'estimate_date' ]);
		if(date("Y",$start)){
	
                  $itemtotal = '';
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
		}
	$totalinvoice = ( $totalSum * $tax_pen / 100 ) + $totalSum;
	$subtotalinvoice += $totalinvoice;
}

											?>
							
							
							<div class="col-sm-12">
								<h3 class="page-title">
<?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='1'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
									<div class="dash-widget-info">
										<h3><?php $SQDepart="select * from project WHERE sts='1'"; $ResultDepart=mysqli_query($link,$SQDepart); echo mysqli_num_rows($ResultDepart); ?></h3>
										<span><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='43'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
									<div class="dash-widget-info">
										<h3><?php $sqlclientcount="select * from clients WHERE status='1'"; $resultclientcount=mysqli_query($link,$sqlclientcount); echo mysqli_num_rows($resultclientcount); ?></h3>
										<span><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-files-o"></i></span>
									<div class="dash-widget-info">
<h3>
<span style="font-weight: normal; font-size: 15px; float: left;">
	<?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : 
<?php 
	$totalinvoice = '0';
	$subtotalinvoice = '0';
	$sqltaskcount="select * from spl_invoice WHERE status='1'"; $resultaskcount=mysqli_query($link,$sqltaskcount);
	while($invoice_total=mysqli_fetch_array($resultaskcount)){
	$tax_pen= $invoice_total['tax'];
	$estimate_id = $invoice_total[ 'estimate_id' ];
	$totalSum = '0';
	
                  $itemtotal = '';
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
	$totalinvoice = ( $totalSum * $tax_pen / 100 ) + $totalSum;
	$subtotalinvoice += $totalinvoice;
}
echo number_format($subtotalinvoice,2, '.', ',');
											?>
										</span>	
	<?php 
	 echo mysqli_num_rows($resultaskcount); ?></h3>

										<span><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='103'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-address-book"></i></span>
									<div class="dash-widget-info">
										<h3><span style="font-weight: normal; font-size: 15px; float: left;">
	<?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> : 
<?php 
	$totalinvoice = '0';
	$subtotalinvoice = '0';
	$sqltaskcount="select * from spl_invoice WHERE status='2'"; $resultaskcount=mysqli_query($link,$sqltaskcount);
	while($invoice_total=mysqli_fetch_array($resultaskcount)){
	$tax_pen= $invoice_total['tax'];
	$estimate_id = $invoice_total[ 'estimate_id' ];
	$totalSum = '0';
	
                  $itemtotal = '';
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
	$totalinvoice = ( $totalSum * $tax_pen / 100 ) + $totalSum;
	$subtotalinvoice += $totalinvoice;
}
echo number_format($subtotalinvoice,2, '.', ',');
											?>
										</span>	
	<?php 
	 echo mysqli_num_rows($resultaskcount); ?></h3>
										<span><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='104'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6 text-center">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">
												<?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='105'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
											<div id="bar-charts"></div>
										</div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='106'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
											<div id="line-charts"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				<!--	<div class="row">
						<div class="col-md-12">
							<div class="card-group m-b-30">
								<div class="card">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
											<div>
												<span class="d-block">New Employees</span>
											</div>
											<div>
												<span class="text-success">+10%</span>
											</div>
										</div>
										<h3 class="mb-3">10</h3>
										<div class="progress mb-2" style="height: 5px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<p class="mb-0">Overall Employees 218</p>
									</div>
								</div>
							
								<div class="card">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
											<div>
												<span class="d-block">Earnings</span>
											</div>
											<div>
												<span class="text-success">+12.5%</span>
											</div>
										</div>
										<h3 class="mb-3">$1,42,300</h3>
										<div class="progress mb-2" style="height: 5px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
									</div>
								</div>
							
								<div class="card">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
											<div>
												<span class="d-block">Expenses</span>
											</div>
											<div>
												<span class="text-danger">-2.8%</span>
											</div>
										</div>
										<h3 class="mb-3">$8,500</h3>
										<div class="progress mb-2" style="height: 5px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
									</div>
								</div>
							
								<div class="card">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
											<div>
												<span class="d-block">Profit</span>
											</div>
											<div>
												<span class="text-danger">-75%</span>
											</div>
										</div>
										<h3 class="mb-3">$1,12,000</h3>
										<div class="progress mb-2" style="height: 5px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
									</div>
								</div>
							</div>
						</div>	
					</div>-->
					
					<!-- Statistics Widget
					<div class="row">
						<div class="col-md-12 col-lg-12 col-xl-4 d-flex">
							<div class="card flex-fill dash-statistics">
								<div class="card-body">
									<h5 class="card-title">Statistics</h5>
									<div class="stats-list">
										<div class="stats-info">
											<p>Today Leave <strong>4 <small>/ 65</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<h4 class="card-title">Task Statistics</h4>
									<div class="statistics">
										<div class="row">
											<div class="col-md-6 col-6 text-center">
												<div class="stats-box mb-4">
													<p>Total Tasks</p>
													<h3>385</h3>
												</div>
											</div>
											<div class="col-md-6 col-6 text-center">
												<div class="stats-box mb-4">
													<p>Overdue Tasks</p>
													<h3>19</h3>
												</div>
											</div>
										</div>
									</div>
									<div class="progress mb-4">
										<div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
										<div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
										<div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
										<div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
										<div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
									</div>
									<div>
										<p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="float-right">166</span></p>
										<p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks <span class="float-right">115</span></p>
										<p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span class="float-right">31</span></p>
										<p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span class="float-right">47</span></p>
										<p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span class="float-right">5</span></p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ml-2">5</span></h4>
									<div class="leave-info-box">
										<div class="media align-items-center">
											<a href="profile.html" class="avatar"><img alt="" src="assets\img\user.jpg"></a>
											<div class="media-body">
												<div class="text-sm my-0">Martin Lewis</div>
											</div>
										</div>
										<div class="row align-items-center mt-3">
											<div class="col-6">
												<h6 class="mb-0">4 Sep 2019</h6>
												<span class="text-sm text-muted">Leave Date</span>
											</div>
											<div class="col-6 text-right">
												<span class="badge bg-inverse-danger">Pending</span>
											</div>
										</div>
									</div>
									<div class="leave-info-box">
										<div class="media align-items-center">
											<a href="profile.html" class="avatar"><img alt="" src="assets\img\user.jpg"></a>
											<div class="media-body">
												<div class="text-sm my-0">Martin Lewis</div>
											</div>
										</div>
										<div class="row align-items-center mt-3">
											<div class="col-6">
												<h6 class="mb-0">4 Sep 2019</h6>
												<span class="text-sm text-muted">Leave Date</span>
											</div>
											<div class="col-6 text-right">
												<span class="badge bg-inverse-success">Approved</span>
											</div>
										</div>
									</div>
									<div class="load-more text-center">
										<a class="text-dark" href="javascript:void(0);">Load More</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Statistics Widget -->
					
					<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-nowrap custom-table mb-0">
											<thead>
												<tr>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='107'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='64'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='66'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
												</tr>
											</thead>
											<tbody>
												
												<?php
												$sql_admin = "select * from invoice_setting WHERE user_type='1'";
$result_admin = mysqli_query( $link, $sql_admin );
$list_admin = mysqli_fetch_array( $result_admin );

                $k = 1;
                $SQLestimate = "select * from spl_invoice WHERE status='1' order by estimate_id DESC";
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
													<td>
														<h2><?php echo $listclients['fullname'];?></h2>
													</td>
													<td><?php echo $listestimate['estimate_date'];?></td>
													<td><?php
                  $totalSum = '0';
                  $itemtotal = '';
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
					echo number_format(( $totalSum * $listestimate[ 'tax' ] / 100 ) + $totalSum,2, '.', ',');
               
                  ?></td>
													<td>
														<span class="badge bg-inverse-warning"><?php if($listestimate['status'] == '2'){?>
                      <i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } else {?>
                      <i class="fa fa-dot-circle-o text-danger"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } ?></span>
													</td>
												</tr>
												<?php } ?>
												
												
												
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="invoice.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='108'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='9'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<tr>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='107'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='64'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
													<th><?php $result_lang=mysqli_query($link,$invoice_language_sql); while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='66'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
												</tr>
												</tr>
											</thead>
											<tbody>
												
												
												<?php
												$sql_admin = "select * from invoice_setting WHERE user_type='1'";
$result_admin = mysqli_query( $link, $sql_admin );
$list_admin = mysqli_fetch_array( $result_admin );

                $k = 1;
                $SQLestimate = "select * from spl_invoice WHERE status='2' order by estimate_id DESC";
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
													<td>
														<h2><?php echo $listclients['fullname'];?></h2>
													</td>
													<td><?php echo $listestimate['estimate_date'];?></td>
													<td><?php
                  $totalSum = '0';
                  $itemtotal = '';
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
					echo number_format(( $totalSum * $listestimate[ 'tax' ] / 100 ) + $totalSum,2, '.', ',');
               
                  ?></td>
													<td>
														<span class="badge bg-inverse-info"><?php if($listestimate['status'] == '2'){?>
                      <i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } else {?>
                      <i class="fa fa-dot-circle-o text-danger"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
                      <?php } ?></span>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="payments.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='109'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
								</div>
							</div>
						</div>
					</div>
					
					<!--<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Clients</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="#" class="avatar"><img alt="" src="assets\img\profiles\avatar-19.jpg"></a>
															<a href="client-profile.html">Barry Cuda <span>CEO</span></a>
														</h2>
													</td>
													<td>barrycuda@example.com</td>
													<td>
														<div class="dropdown action-label">
															<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-dot-circle-o text-success"></i> Active
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
															</div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="#" class="avatar"><img alt="" src="assets\img\profiles\avatar-19.jpg"></a>
															<a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
														</h2>
													</td>
													<td>tressawexler@example.com</td>
													<td>
														<div class="dropdown action-label">
															<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-dot-circle-o text-danger"></i> Inactive
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
															</div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="client-profile.html" class="avatar"><img alt="" src="assets\img\profiles\avatar-07.jpg"></a>
															<a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
														</h2>
													</td>
													<td>rubybartlett@example.com</td>
													<td>
														<div class="dropdown action-label">
															<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-dot-circle-o text-danger"></i> Inactive
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
															</div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="client-profile.html" class="avatar"><img alt="" src="assets\img\profiles\avatar-06.jpg"></a>
															<a href="client-profile.html"> Misty Tison <span>CEO</span></a>
														</h2>
													</td>
													<td>mistytison@example.com</td>
													<td>
														<div class="dropdown action-label">
															<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-dot-circle-o text-success"></i> Active
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
															</div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="client-profile.html" class="avatar"><img alt="" src="assets\img\profiles\avatar-14.jpg"></a>
															<a href="client-profile.html"> Daniel Deacon <span>CEO</span></a>
														</h2>
													</td>
													<td>danieldeacon@example.com</td>
													<td>
														<div class="dropdown action-label">
															<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-dot-circle-o text-danger"></i> Inactive
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
																<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
															</div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="clients.html">View all clients</a>
								</div>
							</div>
						</div>
						<div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Recent Projects</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
												<tr>
													<th>Project Name </th>
													<th>Progress</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<h2><a href="project-view.html">Office Management</a></h2>
														<small class="block text-ellipsis">
															<span>1</span> <span class="text-muted">open tasks, </span>
															<span>9</span> <span class="text-muted">tasks completed</span>
														</small>
													</td>
													<td>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2><a href="project-view.html">Project Management</a></h2>
														<small class="block text-ellipsis">
															<span>2</span> <span class="text-muted">open tasks, </span>
															<span>5</span> <span class="text-muted">tasks completed</span>
														</small>
													</td>
													<td>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="15%" style="width: 15%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2><a href="project-view.html">Video Calling App</a></h2>
														<small class="block text-ellipsis">
															<span>3</span> <span class="text-muted">open tasks, </span>
															<span>3</span> <span class="text-muted">tasks completed</span>
														</small>
													</td>
													<td>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="49%" style="width: 49%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2><a href="project-view.html">Hospital Administration</a></h2>
														<small class="block text-ellipsis">
															<span>12</span> <span class="text-muted">open tasks, </span>
															<span>4</span> <span class="text-muted">tasks completed</span>
														</small>
													</td>
													<td>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="88%" style="width: 88%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<h2><a href="project-view.html">Digital Marketplace</a></h2>
														<small class="block text-ellipsis">
															<span>7</span> <span class="text-muted">open tasks, </span>
															<span>14</span> <span class="text-muted">tasks completed</span>
														</small>
													</td>
													<td>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="100%" style="width: 100%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="projects.html">View all projects</a>
								</div>
							</div>
						</div>
					</div> -->
				
				</div>
				<!-- /Page Content -->

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
		
		<!-- Chart JS -->
		<script src="assets\plugins\morris\morris.min.js"></script>
		<script src="assets\plugins\raphael\raphael.min.js"></script>
		<script src="assets\js\chart.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>