<?php include("../config.php");
ob_start();
$email = $_POST['email'];
$password = $_POST['password'];
$account_type = $_POST['account_type'];
$ip = $_SERVER['REMOTE_ADDR'];
$sess=session_id();	
if($email!='' || $password!='' || $account_type!='')
{	
$qry="SELECT * FROM users WHERE email='$email' AND password='".$password."' AND account_type='$account_type' AND status='1'";
$result=mysqli_query($link,$qry);
if(mysqli_num_rows($result) == 1) {
$member = mysqli_fetch_assoc($result);
$id=$_SESSION['id'] = $member['id'];

header("Location:../index.php");
}
else 
{
mysqli_query($link,"insert into login_check(ip,sess,create_date) values('$ip','$sess',now())");
$errmsg_arr[] = '<div class="massgerrpr">Error: Please enter your valid email and password.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

}
else 
{
mysqli_query($link,"insert into login_check(ip,sess,create_date) values('$ip','$sess',now())");	
$errmsg_arr[] = 'Error: This email/password combination is incorrect.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();

?>