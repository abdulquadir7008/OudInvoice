<?php include("config.php");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
$estimate_id='';
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
 
if (isset($_REQUEST['edit'])){$id=$_REQUEST['edit'];}else{$id=0;}
$sql_cms="select * from spl_invoice WHERE estimate_id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
?>
      <?php if(isset($_REQUEST['edit'])) { 
$sub="update";
$sub2="تحديث";
 } 
 else { 
 $sub="add";
 $sub2="يحفظ";
 }
if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from invoice_item WHERE estimate_item_id=$del";
mysqli_query($link,$query);
	header("Location:invoice_form.php?edit=".$id);
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
            <div class="page-wrapper invoice-set">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='55'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='55'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<form method="post" action="invoice.php">
								<div class="row">
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
											<select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="client" onChange="showCat(this);" required>
												<option value=""><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='73'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
												<?php 
												$sqlclient="select * from clients WHERE status='1' order by instaid ASC ";
													$resultclient=mysqli_query($link,$sqlclient);
														while($listclient=mysqli_fetch_array($resultclient)){
												?>
												<option value="<?php echo $listclient['client_id'];?>" <?php if($row_cms['client'] == $listclient['client_id']){?>selected<?php } ?> ><?php echo $listclient['instaid'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									
									
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='74'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
											<select class="form-control taxen" name="tax">
												<option value="0"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='75'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
												<?php 
												$sqltaxs="select * from taxes WHERE status='1'";
													$resultaxs=mysqli_query($link,$sqltaxs);
														while($listtaxs=mysqli_fetch_array($resultaxs)){
												?>
												<option value="<?php echo $listtaxs['tax_perctange'];?>" <?php if($row_cms['tax'] == $listtaxs['tax_perctange']){?>selected<?php } ?> ><?php echo $listtaxs['taxe_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6 col-md-3 col-6">
										<div class="form-group">
											<label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='76'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" value="<?php echo $row_cms['estimate_date'];?>" name="estimate_date" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3 col-6">
										<div class="form-group">
											<label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='77'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </label>
											<div class="cal-icon">
												<input class="form-control datetimepicker" value="<?php echo $row_cms['expire_date'];?>" name="expire_date" type="text">
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div id="output11" class="billdetatil row">
											
										<?php
											$estimate_id =$row_cms['client'];
											if($row_cms['estimate_id']){
											$sql = "SELECT * FROM clients 
	LEFT JOIN state_add ON clients.city=state_add.state_id
	LEFT JOIN country ON clients.country_id=country.country_id
	WHERE client_id= '$estimate_id'";
    $result_cms2=mysqli_query($link,$sql); 
											$row_cms2=mysqli_fetch_array($result_cms2);
	echo $ecorat  = "<div class='col-md-7'><h4>".$row_cms2['fullname']."</h4><p>".$row_cms2['address'].", ".$row_cms2['sname']."<br> ".$row_cms2['cname']."</p><p>Email : ".$row_cms2['email']."<br>Phone : ".$row_cms2['phone']."</p></div>";
											?>
										<input type="hidden" name="billing_address" value="<?php echo $row_cms['billing_address'];?>">
											<input type="hidden" name="email" value="<?php echo $row_cms['email'];?>">
											<?php } ?>
											
										</div>
										
									</div>
									
									
									
									
									
								</div>
								
								
								
								<div class="row invoice-body" id="myTable">
									<div class="col-md-12 col-sm-12">
										<div class="table-responsive" style="overflow: visible;">
											<table class="table table-hover table-white">
												<thead>
													<?php if($lang_cat !='en'){?>
													<tr>
														<th class="col-sm-2" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='65'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-1" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='80'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-1" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='79'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-md-4"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-3"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='78'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-md-1">#</th>
														
														
														
														
														
														<th> </th>
													</tr>
													<?php } else { ?>
													<tr>
														<th class="col-md-1">#</th>
														<th class="col-sm-3"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='78'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-md-4"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-1" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='79'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-1" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='80'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th class="col-sm-2" style="padding-left: 2%;"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='65'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
														<th> </th>
													</tr>
													<?php } ?>
												</thead>
											
												
											</table>
											<?php 
												$sqlestitem="select * from invoice_item WHERE etimate_id='$id'";
													$resultest=mysqli_query($link,$sqlestitem);
														while($listetitm=mysqli_fetch_array($resultest)){
															$isetId = $listetitm['estimate_item_id'];
															if($listetitm['itemes']==0){
											$query="delete from invoice_item WHERE estimate_item_id=$isetId";
mysqli_query($link,$query);
																
															}
															
												?>
											
											<div class="row single-row catrowup" style="margin-bottom: 15px;">
												
												<input type="hidden" name="itemid[]" value="<?php echo $listetitm['estimate_item_id'];?>">
												<div class="col-md-1">
															<h4 class="autoinc"></h4>
												</div>
															<div class="col-md-3">
																
														<select class="form-control" name="itemes[]">
												<option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='73'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
												<?php 
												$sqlproject="select * from project WHERE sts='1' order by project_name ASC";
													$resultproject=mysqli_query($link,$sqlproject);
														while($listproject=mysqli_fetch_array($resultproject)){
												?>
												<option value="<?php echo $listproject['id'];?>" <?php if($listetitm['itemes'] == $listproject['id']){?>selected<?php } ?>>
													<?php echo $listproject['project_name'];?></option>
												<?php } ?>
											</select>
																
														
														</div>
													<div class="col-md-4">
														<input class="form-control" type="text" value="<?php echo $listetitm['description'];?>" maxlength="70" name="description[]">
														</div>
														<div class="col-md-1">
															<input class="form-control price" value="<?php echo $listetitm['unitcost'];?>" type="text" onkeyup="update_amounts()" maxlength="10" name="unitcost[]">
														</div>
														<div class="col-md-1">
															<input class="form-control qty" value="<?php echo $listetitm['qty'];?>" maxlength="4" type="text" onkeyup="update_amounts()" name="qty[]">
														</div>
														<div class="col-md-2">
															<input class="form-control amount" value="<?php echo $listetitm['amount'];?>" maxlength="10" type="text" onkeyup="update_amounts()"  id="" name="amount[]">
														</div>
														<a href="invoice_form.php?del=<?php echo $listetitm['estimate_item_id'];?>&&edit=<?php echo $row_cms['estimate_id'];?>" class="btn-remove-customer "><i class="fa fa-minus-circle"></i></a>
														</div>
											<?php } ?>
											<div class="customer_records">
												<div class="row single-row">
													
													
												<div class="col-md-1">
													<h4 class="autoinc"></h4>
													
															<input class="form-control" type="hidden" name="itemid[]">
												</div>
															<div class="col-md-3">
																<select class="form-control" name="itemes[]">
												<option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='73'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
												<?php 
												$sqlproject="select * from project WHERE sts='1' order by project_name ASC";
													$resultproject=mysqli_query($link,$sqlproject);
														while($listproject=mysqli_fetch_array($resultproject)){
												?>
												<option value="<?php echo $listproject['id'];?>"><?php echo $listproject['project_name'];?></option>
												<?php } ?>
											</select>
														
														</div>
													<div class="col-md-4">
														<input class="form-control" maxlength="70" type="text" name="description[]" placeholder="<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>">
														</div>
														<div class="col-md-1 col-4">
															<input class="form-control price" type="text" onkeyup="update_amounts()" maxlength="10" name="unitcost[]" placeholder="<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='79'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>">
														</div>
														<div class="col-md-1 col-3">
															<input class="form-control qty" type="text" onkeyup="update_amounts()" maxlength="4" name="qty[]" placeholder="<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='80'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>">
														</div>
														<div class="col-md-2 col-5">
															<input class="form-control amount" type="text" onkeyup="update_amounts()" maxlength="10"  id="" name="amount[]" placeholder="<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='65'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>">
														</div>
														
														</div>	
														</div>
														
												<div class="customer_records_dynamic estimate_cord"></div>
											
										</div>
										<a href="javascript:void(0)" class="text-success font-18 extra-fields-customer estim_increm" title="Add"><i class="fa fa-plus"></i></a>
										<div class="table-responsive">
											<table class="table table-hover table-white">
												<tbody>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></td>
														<td style="text-align: right; padding-right: 30px;width: 230px" >
														<span class="total">0</span>
														</td>
													</tr>
													<tr>
														<td colspan="5" class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='74'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></td>
														<td style="text-align: right; padding-right: 30px;width: 230px">
															<input class="form-control text-right" id="tax" value="10" readonly="" type="text">
															
														</td>
													</tr>
													<tr>
														<td colspan="5" class="text-right">
															Delivery charges
														</td>
														<td style="text-align: right; padding-right: 30px;width: 230px">
												<input name="delivery_charge" value="<?php echo $row_cms['delivery_charge'];?>" class="form-control text-right delchr" type="text">
														</td>
													</tr>
													<tr>
														<td colspan="5" style="text-align: right; font-weight: bold">
															<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='82'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
														</td>
														<td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
															<span class="subtotal"></span>
															
														</td>
													</tr>
												</tbody>
											</table>                               
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='83'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
													<textarea class="form-control" rows="4" name="othet_information" placeholder="<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='83'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>"><?php echo $row_cms['othet_information'];?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="submit-section">
									<input type="hidden" name="estimate_id" value="<?php echo $row_cms['estimate_id'];?>">
									<!--button class="btn btn-primary submit-btn m-r-10">Save & Send</button-->
									<button class="btn btn-primary submit-btn" type="submit" name="<?php echo $sub;?>"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='118'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
</button>
								</div>
							</form>
						</div>
					</div>
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
		var value2 = parseFloat($('.delchr').val()) || 0;
	$('.subtotal').text(sum + tax +value2);
	$('.subtotal').val(sum + tax + value2);	
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
		
		<script>	
$(document).ready(function(){
$("#user_search").keyup(function(){
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