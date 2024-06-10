<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}
$company_name=$_POST['company_name'];
$location=$_POST['location'];
$job_position=$_POST['job_position'];
$period_form=$_POST['period_form'];
$period_to=$_POST['period_to'];


if(isset($_REQUEST['exp_update_button']))
{
$exp_id=$_POST['exp_id'];
$query="update experience_info SET company_name='$company_name',location='$location',job_position='$job_position',
period_form='$period_form',period_to='$period_to',status='0' WHERE exp_id=$exp_id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
else if(isset($_REQUEST['add_experience']))
{
	
$querybord="insert into experience_info (company_name,location,job_position,period_form,period_to,status,profile_id) 
values('$company_name','$location','$job_position','$period_form','$period_to','0','$customerchechlogin_id')";
mysqli_query($link,$querybord);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
	}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from experience_info WHERE exp_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Delete - </b>Data Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['salary_msg'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
	


?>