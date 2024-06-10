<?php include("config.php");
$taxadd='0';
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
if(isset($_REQUEST['gen'])){
	$invoicID = $_REQUEST['gen'];
}
$delivery='0';
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
 $sql_admin="select * from invoice_setting WHERE user_type='1'";
$result_admin=mysqli_query($link,$sql_admin);
$list_admin=mysqli_fetch_array($result_admin);
if (isset($_REQUEST['edit'])){$id=$_REQUEST['edit'];}else{$id=0;}
$sql_cms="select * from spl_invoice WHERE estimate_id=$invoicID"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
if( $row_cms['delivery_charge']){
						$delivery = $row_cms['delivery_charge'];
					}

?>
      <?php if(isset($_REQUEST['edit'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 }
if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from invoice_item WHERE estimate_item_id=$del";
mysqli_query($link,$query);
	header("Location:invoice_form.php?edit=".$id);
}
$SQLCompany="select * from company_details where user_type='1' limit 1";
	$ResultCompany=mysqli_query($link,$SQLCompany);
	$ListCompany=mysqli_fetch_array($ResultCompany);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
		
	
	?>
    </head>
    <body style="background: #fff;">
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
			
			<div class="content container-fluid" style="background: #fff;">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li class="breadcrumb-item active"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<div class="btn-group btn-group-sm">
									
									<a class="btn btn-white" href="invoice_save.php?gen=<?php echo $invoicID; ?>">PDF</a>
									<button class="btn btn-white" onclick="printDiv('<?php echo $invoicID; ?>')"><i class="fa fa-print fa-lg"></i> Print</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div id="element-to-print">
					<div class="row" id="<?php echo $invoicID;?>" style="background: #fff;">
						<div class="col-md-12">
							<div class="card" style="border: none; box-shadow: 0 0 0 0; height: 1450px;">
								<div class="card-body">
									<div class="kadrata">فاتورة</div>
									<div class="row">
										<div class="col-md-12 setchip2"><img src="images/oudlogo-invoice.png" width="160"></div>
										
										<div class="col-md-4 setchip">
											<div class="codejump">
										<h4 class="text-uppercase"> #<?php echo $list_admin['invocie_prifix'];?>-000<?php echo $row_cms['estimate_id'];?> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='54'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h4></div>
										<h5>
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='87'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>:</h5>
				 							<ul class="list-unstyled2 rodcope">
												
												
												<?php
											$estimate_id =$row_cms['client'];
											if($row_cms['estimate_id']){
											$sql = "SELECT * FROM clients 
	LEFT JOIN state_add ON clients.city=state_add.state_id
	LEFT JOIN country ON clients.country_id=country.country_id
	WHERE client_id= '$estimate_id'";
    $result_cms2=mysqli_query($link,$sql); 
											$row_cms2=mysqli_fetch_array($result_cms2);
	echo $ecorat  = "<div class=''><h4>".$row_cms2['fullname']."</h4><p>".$row_cms2['address'].", ".$row_cms2['sname']."<br> ".$row_cms2['cname']."</p><p>".$row_cms2['email']." : بريد الالكتروني<br>".$row_cms2['phone']." : هاتف</p></div>";
											}
											?>
												
											</ul>
										</div>
										
										<div class="col-md-8 setchip4">
										<span><?php echo $row_cms['estimate_date'];?></span> : <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='84'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> 
										</div>
										
										
									</div>
									
									
									<div <?php if($lang_cat !='en'){?>dir="rtl"<?php } ?> >
										<div class="kadir_rect">
											<div class="row">
												<div class="col-md-2">#</div>
												<div class="col-md-2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='78'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
												<div class="col-md-2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
												<div class="col-md-2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='79'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
												<div class="col-md-2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='80'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
												<div class="col-md-2"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
											</div>
										</div>
										
										<?php
												$k=1;
												$sqlestitem="select * from invoice_item WHERE etimate_id='$invoicID'";
													$resultest=mysqli_query($link,$sqlestitem);
														while($listetitm=mysqli_fetch_array($resultest)){
												?>
												<div class="kadir_rect2">
													<div class="row">
													<div class="col-md-2"><?php echo $k;?></div>
													<div class="col-md-2">
														<?php 
															$prodId = $listetitm['itemes'];
												$sqlproject="select * from project WHERE id='$prodId'";
													$resultproject=mysqli_query($link,$sqlproject);
														$listproject=mysqli_fetch_array($resultproject);
															echo $listproject['project_name'];
												?>
														</div>
													<div class="col-md-2"><?php echo $listetitm['description'];?></div>
													<div class="col-md-2"><?php echo $listetitm['unitcost'];?></div>
													<div class="col-md-2"><?php echo $listetitm['qty'];?></div>
													<div class="col-md-2" <?php if($lang_cat =='en'){?>style="text-align: right;"<?php } ?> >AED <?php echo $listetitm['amount'];?></div>
														</div>
												</div>
												<?php $subtotal = ($subtotal + $listetitm['amount']); $k++;} ?>
										
										
									</div>
									<div <?php if($lang_cat =='en'){?>dir="rtl"<?php } ?> >
										<?php if($lang_cat =='en'){?>
										<div class="totalpm">
											<div class="row">
												<div class="col-md-6">AED <?php echo number_format($subtotal ,2, '.', ',');?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='88'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
											</div>
											
											<div class="row">
												<div class="col-md-6">AED <?php echo $delivery;?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='129'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
											</div>
											
											<div class="row">
												<div class="col-md-6">AED <?php echo number_format($subtotal + $taxadd +$delivery,2, '.', ',');?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </div>
											</div>
											
										</div>
										
										<?php } else { ?>
										<div class="totalpm">
											<div class="row">
												<div class="col-md-6">AED <?php echo number_format($subtotal ,2, '.', ',');?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='88'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
											</div>
											
											<div class="row">
												<div class="col-md-6">AED <?php echo $delivery;?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='129'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></div>
											</div>
											
											<div class="row">
												<div class="col-md-6">AED <?php echo number_format($subtotal + $taxadd +$delivery,2, '.', ',');?></div>
												<div class="col-md-6"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='81'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </div>
											</div>
											
										</div>
										<?php } ?>
										<div class="invoice-info" <?php if($lang_cat !='en'){?>style="text-align: right;"<?php } ?> >
											<?php if($row_cms['othet_information']){?>
											<h5><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='83'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
											<p class="text-muted"><?php echo $row_cms['othet_information'];?></p>
											<?php } ?>
										</div>
									</div>
									
									
									<div class="col-md-12 setchip31">
										
											<ul>
												<li> الإمارات العربية المتحدة</li>
												<li>عجمان / الجرف</li>
												<li><span class="fa fa-phone"></span> 050-4445431</li>
												<li><span class="fa fa-instagram"></span> oud_alfaisall</li>
											</ul>
										</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
                </div>	
				
				<!-- Page Content -->
                
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
<script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
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
function printDiv(divName) {	
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

</script>
		
		<script>
         function createPDF() {
            var element = document.getElementById('element-to-print');
            html2pdf(element, {
                margin:1,
                padding:0,
                filename: 'oud_<?php echo $list_admin['invocie_prifix'];?>-000.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2,  logging: true },
                jsPDF: { unit: 'in', format: 'A2', orientation: 'P' },
                class: createPDF
            });
        };
        // function exportHTML(){
        //     var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        //             "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        //             "xmlns='http://www.w3.org/TR/REC-html40'>"+
        //             "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
        //     var footer = "</body></html>";
        //     var sourceHTML = header+document.getElementById("element-to-print").innerHTML+footer;
            
        //     var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        //     var fileDownload = document.createElement("a");
        //     document.body.appendChild(fileDownload);
        //     fileDownload.href = source;
        //     fileDownload.download = 'document.doc';
        //     fileDownload.click();
        //     document.body.removeChild(fileDownload);
        // }
        
    </script>
		
    </body>
</html>