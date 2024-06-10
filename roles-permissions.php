<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
echo $customerchechlogin_id=$_SESSION['id'];
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
<html lang="en">
    <head>
	<?php include("include/head.php");
	if(isset($_REQUEST['counterdel']))
	{
	$id_counterdel=$_REQUEST['counterdel'];
	$query="delete from counter WHERE id=$id_counterdel";
	mysqli_query($link,$query);
	}
	else if(isset($_REQUEST['counter']))
{
$name=$_POST['countr'];
		$primary_role=$_POST['primary_role'];
		
$counter_sql="insert into counter (countr,primary_role) values('$name','$primary_role')";
mysqli_query($link,$counter_sql);
}
	?>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<?php include("include/header.php");?>
			<!-- /Header -->
			
			<!-- Sidebar -->
           
			<?php include("include/sidebar2.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Roles & Permissions</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
							<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
							<div class="roles-menu">
								<ul>
<?php
$counter_sql="select * from counter order by countr ASC";
$counter_result=mysqli_query($link,$counter_sql);
while($counter_row=mysqli_fetch_array($counter_result)){
?>
									<li>
										<a href="javascript:void(0);"><?php echo $counter_row['countr'];?>
											<span class="role-action">
												
												<span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role<?php echo $counter_row['id'];?>">
													<i class="material-icons">delete</i>
												</span>
											</span>
										</a>
									</li>

				<div class="modal custom-modal fade" id="delete_role<?php echo $counter_row['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Role</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="roles-permissions.php?counterdel=<?php echo $counter_row['id'];?>" class="btn btn-primary continue-btn">Delete</a>
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


<?php } ?>

									
								</ul>
							</div>
						</div>
						
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Role Modal -->
				<div id="add_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="roles-permissions.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Role Name <span class="text-danger">*</span></label>
										<input class="form-control" name="countr" type="text">
									</div>
									<div class="submit-section">
										<label>If Role <strong>HR</strong> Please check here <input type="radio" name="primary_role" value="hr"> or <strong>Accountant</strong> check here <input type="radio" name="primary_role" value="accountant"></label>
										<button name="counter" type="submit" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
				<!-- /Add Role Modal -->
				
				<!-- Edit Role Modal -->
				<div id="edit_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h5 class="modal-title">Edit Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-group">
										<label>Role Name <span class="text-danger">*</span></label>
										<input class="form-control" value="Team Leader" type="text">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Role Modal -->

				<!-- Delete Role Modal -->
				
				<!-- /Delete Role Modal -->
				
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

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>