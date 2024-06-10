<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}
if(isset($_REQUEST['add_personal']))
{
$ref_name=$_POST['ref_name'];
$ref_name2=$_POST['ref_name2'];
$relationship=$_POST['relationship'];
$relationship2=$_POST['relationship2'];
$phone=$_POST['phone'];
$phone2=$_POST['phone2'];
$altphone=$_POST['altphone'];
$altphone2=$_POST['altphone2'];
	
$personal_info_sql = "select * from emegency_contact WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
	
if(mysqli_num_rows($personal_info_resu) > 0){

$query="update emegency_contact SET ref_name='$ref_name',ref_name2='$ref_name2',relationship='$relationship',
relationship2='$relationship2',phone='$phone',phone2='$phone2',altphone='$altphone',altphone2='$altphone2',status='0' WHERE profile_id=$customerchechlogin_id";
mysqli_query($link,$query);

}
	else{
	
$querybord="insert into emegency_contact (ref_name,ref_name2,relationship,relationship2,phone,phone2,altphone,altphone2,profile_id,status) 
values('$ref_name','$ref_name2','$relationship','$relationship2','$phone','$phone2','$altphone','$altphone2','$customerchechlogin_id','0')";
mysqli_query($link,$querybord);
	}
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
?>