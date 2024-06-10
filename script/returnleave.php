<?php
include("../config.php");
ob_start();
if(isset($_REQUEST['submit']))
{
$join_date=$_POST['join_date'];
$comment=$_POST['comment'];
$userid=$_POST['userid'];
$querybord="insert into return_leave (join_date,comment,userid) 
values('$join_date','$comment','$userid')";
mysqli_query($link,$querybord);
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> Leave Return Application Successfully.</span></div></div>";
$errflag = true;
$_SESSION['return_leave_error'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
?>