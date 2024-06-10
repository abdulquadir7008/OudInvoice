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

if(isset($_POST['add'])){
$english = $_REQUEST['english'];
$arabic = $_REQUEST['arabic'];
$querybord="insert into invoice_language (english,arabic,status) values('$english','$arabic','1')";
mysqli_query($link,$querybord);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Translate set Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$english = $_REQUEST['english'];
$arabic = $_REQUEST['arabic'];
$lang_id = $_REQUEST['lang_id'];
$query="update invoice_language SET english='$english',arabic='$arabic' WHERE lang_id=$lang_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Translate Update Successfully.</span></div>";
$errflag = true;
$_SESSION['language_ac'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from invoice_language WHERE lang_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Translate Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['language_ac'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
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
				<?php
if( isset($_SESSION['language_ac']) && is_array($_SESSION['language_ac']) && count($_SESSION['language_ac']) >0 ) {
foreach($_SESSION['language_ac'] as $msg) {
echo $msg;  
}
unset($_SESSION['language_ac']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">يترجم</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">لوحة القيادة</a></li>
									<li class="breadcrumb-item active">يترجم</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i>تعيين الترجمة</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row" style="margin: 20px 0; margin-left: -15px;">
      <div class="col-md-3">
        <input type="text" id="search_text" placeholder="Search here ..." class="form-control srchcal"/>
		  <span class="fa fa-search  searchicon"></span>
      </div>
    <!--  <div class="col-md-2">
        <button type="button" name="search" class="btn btn-primary" id="search">Search</button>
		   <a href="users.php?date=reset" class="btn btn-white btn-block">RESET</a>
      </div>  -->
		
    </div>
					<div class="row">
						
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table mb-0 datatable" id="table-data">
									<thead>
										<tr>
											<th style="width: 30px;">#</th>
											<th>Arabic</th>
											<th>English</th>
											<th class="text-right">عمل</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$k = 1;
										$SQDepart="select * from invoice_language WHERE status='1' order by lang_id DESC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
										?>
										<tr>
											<td><?php echo $k;?></td>
											<td><?php echo $ListDepart['arabic'];?></td>
											<th><?php echo $ListDepart['english'];?></th>
											<td class="text-right">
                                            <div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_department<?php echo $ListDepart['lang_id'];?>"><i class="fa fa-pencil m-r-5"></i> تعديل</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department<?php echo $ListDepart['lang_id'];?>"><i class="fa fa-trash-o m-r-5"></i> حذف</a>
                                                </div>
												</div>
											</td>
										</tr>
										
										
										<!-- Delete Department Modal -->
				<div class="modal custom-modal fade" id="delete_department<?php echo $ListDepart['lang_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>حذف القسم</h3>
									<p>هل أنت متأكد من أنك تريد الحذف؟</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="language_setting.php?del=<?php echo $ListDepart['lang_id'];?>" class="btn btn-primary continue-btn">حذف</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">يلغي</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Department Modal -->
										
										<!-- Edit Department Modal -->
				<div id="edit_department<?php echo $ListDepart['lang_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">تحرير الفئات</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="language_setting.php">
									<div class="form-group" dir="rtl">
										<label style="float: right;">عربى <span class="text-danger">*</span></label>
										<input class="form-control" maxlength="40" name="arabic" type="text" value="<?php echo $ListDepart['arabic'];?>">
									</div>
									<div class="form-group">
										<label>English <span class="text-danger">*</span></label>
										<input class="form-control" maxlength="40" name="english" type="text" value="<?php echo $ListDepart['english'];?>">
									</div>
									<div class="submit-section">
										<input type="hidden" name="lang_id" value="<?php echo $ListDepart['lang_id'];?>">
										<button class="btn btn-primary submit-btn" name="update" type="submit">تحديث</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Department Modal -->
										
										<?php $k++; }?>
										
										
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Department Modal -->
				<div id="add_department" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">لغة مجموعة</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="language_setting.php">
									
									
									<div class="form-group" dir="rtl">
										<label style="float: right;">عربى <span class="text-danger">*</span></label>
										<input class="form-control" maxlength="40" name="arabic" type="text">
									</div>
									<div class="form-group">
										<label>English <span class="text-danger">*</span></label>
										<input class="form-control" maxlength="40" name="english" type="text">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" name="add" type="submit">إرسال</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Department Modal -->
				
				

				
				
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
$(document).ready(function(){
$("#search_text").keyup(function(){
var search = $(this).val();
$.ajax({
url : 'lang_action.php',
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