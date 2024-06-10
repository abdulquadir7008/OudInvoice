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
if(isset($_POST['add']) || isset($_POST['update'])){
	$client = $_REQUEST['client'];
	$project = $_REQUEST['project'];
	$email = $_REQUEST['email'];
	$tax = $_REQUEST['tax'];
	$client_address = $_REQUEST['client_address'];
	$billing_address = $_REQUEST['billing_address'];
	$estimate_date = $_REQUEST['estimate_date'];
	$expire_date = $_REQUEST['expire_date'];
	$othet_information = $_REQUEST['othet_information'];
}
if(isset($_POST['add'])){
$querybord="insert into estimate (client,project,email,tax,client_address,billing_address,estimate_date,expire_date,status,othet_information) values('$client','$project','$email','$tax','$client_address','$billing_address','$estimate_date','$expire_date','1','$othet_information')";
mysqli_query($link,$querybord);
$last_id = mysqli_insert_id($link);
foreach($_POST['item'] as $index => $item) {
		$description =$_POST['description'][$index];
		$unitcost =$_POST['unitcost'][$index];
		$qty =$_POST['qty'][$index];
		$amount =$_POST['amount'][$index];
  	$query1001 = "INSERT INTO estimate_item(item,description,unitcost,qty,amount,etimate_id) values ('$item','$description','$unitcost','$qty','$amount','$last_id')";
  mysqli_query($link,$query1001);
}
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Add Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
//header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$estimate_id = $_REQUEST['estimate_id'];
$query="update estimate SET client='$client',project='$project',email='$email',tax='$tax',client_address='$client_address',billing_address='$billing_address',estimate_date='$estimate_date',expire_date='$expire_date',othet_information='$othet_information' WHERE estimate_id=$estimate_id";
mysqli_query($link,$query);

foreach($_POST['item'] as $index2 => $revnue2) {
		$description =$_POST['description'][$index2];
		$ider =$_POST['itemid'][$index2];
		$item =$_POST['item'][$index2];
		$unitcost =$_POST['unitcost'][$index2];
		$qty =$_POST['qty'][$index2];
		$amount =$_POST['amount'][$index2];
		
	if($ider){
  	$query100="update estimate_item SET item='$item',description='$description',unitcost='$unitcost',qty='$qty',amount='$amount' WHERE estimate_item_id=$ider";
 mysqli_query($link,$query100);
		}
		else if(empty($item)){
  	$query="delete from estimate_item WHERE estimate_item_id=$ider";
mysqli_query($link,$query);
	}
		else
		{
			
		$query1001 = "INSERT INTO estimate_item(item,description,unitcost,qty,amount,etimate_id) values ('$item','$description','$unitcost','$qty','$amount','$estimate_id')";
  mysqli_query($link,$query1001);
			
		}
	
	
}	
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Update Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
//header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from estimate WHERE estimate_id=$del";
mysqli_query($link,$query);
$query12="delete from estimate_item WHERE etimate_id=$del";
mysqli_query($link,$query12);	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Estimate Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['estimaterore'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$sql_admin="select * from invoice_setting WHERE user_type='1'";
$result_admin=mysqli_query($link,$sql_admin);
$list_admin=mysqli_fetch_array($result_admin);
if(isset($_REQUEST['search_crm'])){
		echo $search_employe = $_REQUEST['search_employe'];
	
	if(isset($_REQUEST['from_search']) && isset($_REQUEST['to_search']) ){
		
			if($_REQUEST['from_search']!='' && $_REQUEST['to_search']!=''){
			echo $from_search = $_REQUEST['from_search'];
			echo $to_search =$_REQUEST['to_search'];
			
		$bwch = "AND estimate_date between '".$from_search."' AND '".$to_search."'";
	}
		else
		{$bwch = '';}
	}
}
else if(isset($_REQUEST['reset'])){
		$from_search='';
		$to_search = '';
		$bwch = '';
		$search_employe='';
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
		
	
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
								<h3 class="page-title">Estimates</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Estimates</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="estimate_form.php" class="btn add-btn"><i class="fa fa-plus"></i> Create Estimate</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<form method="post" action="estimates.php">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" name="from_search" type="text">
								</div>
								<label class="focus-label">From</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" name="to_search" type="text">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="search_employe"> 
									<option>Select Status</option>
									<?php 
												$sqlclient="select * from clients WHERE status='1'";
													$resultclient=mysqli_query($link,$sqlclient);
														while($listclient=mysqli_fetch_array($resultclient)){
												?>
												<option value="<?php echo $listclient['client_id'];?>" <?php if($_REQUEST['search_employe'] == $listclient['client_id']){?>selected<?php } ?> ><?php echo $listclient['company_name'];?></option>
												<?php } ?>
								</select>
								<label class="focus-label">Status</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
						   <button type="submit" class="btn btn-success btn-block" name="search_crm">Search</button>

					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <a href="estimates.php?date=reset" class="btn btn-white btn-block">RESET</a>  
					   </div>      
                    </div>
					</form>
					<!-- /Search Filter -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>Estimate Number</th>
											<th>Client</th>
											<th>Estimate Date</th>
											<th>Expiry Date</th>
											<th>Amount</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
										$k= 1;
										$SQLestimate="select * from estimate WHERE status='1' AND client LIKE '%$search_employe%' $bwch order by estimate_id DESC";
										$Resultestimate=mysqli_query($link,$SQLestimate);
										while($listestimate=mysqli_fetch_array($Resultestimate)){
										$clientid = $listestimate['client'];
										$myOriginalDate = str_replace('/', '-', $listestimate['expire_date']);
					$curdate_holiday = strtotime(date("d-m-Y"));
					$holiday = strtotime($myOriginalDate);	
											$estimate_id = $listestimate['estimate_id'];
										$sqlclients="select * from clients WHERE client_id='$clientid'";
										$resultclients=mysqli_query($link,$sqlclients);
										$listclients=mysqli_fetch_array($resultclients);
										
											
										?>
										<tr>
											<td><a href="estimate_form.php?edit=<?php echo $estimate_id;?>"><?php echo $list_admin['invocie_prifix'];?>-000<?php echo $estimate_id;?></a></td>
											<td><?php echo $listclients['company_name'];?></td>
											<td><?php echo $listestimate['estimate_date'];?></td>
											<td><?php echo $listestimate['expire_date'];?></td>
											<td>
												
												<?php 
											$totalSum = '0';
											$sqlitem="select * from estimate_item WHERE etimate_id='$estimate_id'";
										$resultitemprice=mysqli_query($link,$sqlitem);
										while ($listitem=mysqli_fetch_array($resultitemprice)){
											$itemtotal  =$listitem['qty'] * $listitem['unitcost'];
											$totalSum += $itemtotal;
											
										} echo ($totalSum * $listestimate['tax'] / 100) + $totalSum;?>
											</td>
											<td>
												<?php if($curdate_holiday > $holiday){?>
												<span class="badge bg-inverse-warning">Expired</span>
												<?php }else{?>
												<span class="badge bg-inverse-success">Accepted</span>
												<?php } ?>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="estimate_form.php?edit=<?php echo $estimate_id;?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_estimate<?php echo $estimate_id;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										
										<div class="modal custom-modal fade" id="delete_estimate<?php echo $estimate_id;?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Estimate</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="estimates.php?del=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
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

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
		<script>
			
	$(document).ready(function() {

  update_amounts();
  $('.qty').change(function() {
    update_amounts();
  });
});


function update_amounts() {
  var sum = 0.0;
  $('#myTable .single-row').each(function() {
    var qty = $(this).find('.qty').val();
    var price = $(this).find('.price').val();
	 
    var amount = parseFloat(qty) * parseFloat(price);
    amount = isNaN(amount) ? 0 : amount;
    sum += amount;
    $(this).find('.amount').text('' + amount);
    $(this).find('.amount').val('' + amount);
	
  });
  //just update the total to sum  
  $('.total').text(sum);
  $('.total').val(sum);
	
	
	$('.taxen').change(function () {
var select=$(this).find(':selected').val();        
var tax = $('#tax').val(sum * select / 100);
		var tax = (sum * select / 100);
	$('.subtotal').text(sum + tax);
	$('.subtotal').val(sum + tax);	
}).change();
  	
}

			
function showCat(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$("#output11").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "client_filter_script.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('#output11').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#output11").html( html );
			}
		});
	} 
}
			
$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-fieldkar btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic > .single').attr("class", "AlLRevenues remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-fieldkar', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});


</script>
		
		
		
    </body>
</html>