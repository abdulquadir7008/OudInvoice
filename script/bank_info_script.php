<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}
if(isset($_REQUEST['bank_details']))
{
$bank_name=$_POST['bank_name'];
$bank_no=$_POST['bank_no'];
$ifsc_code=$_POST['ifsc_code'];
$pan_no=$_POST['pan_no'];
$old_bank_details=$_POST['old_bank_details'];
	
$personal_info_sql = "select * from bank_details WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
	
if(mysqli_num_rows($personal_info_resu) > 0){

$query="update bank_details SET bank_name='$bank_name',bank_no='$bank_no',ifsc_code='$ifsc_code',
pan_no='$pan_no',status='0',old_bank_details='$old_bank_details' WHERE profile_id=$customerchechlogin_id";
mysqli_query($link,$query);

}
	else{
	
$querybord="insert into bank_details (bank_name,bank_no,ifsc_code,pan_no,status,profile_id,old_bank_details) 
values('$bank_name','$bank_no','$ifsc_code','$pan_no','0','$customerchechlogin_id','$old_bank_details')";
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