<?php
include("../config.php");
ob_start();
if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from cancel_leave_tbl WHERE leave_id=$id";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset($_REQUEST['aprove']))
{
$aprove=$_REQUEST['aprove'];
$query="update cancel_leave_tbl SET lb_status='1' WHERE leave_id=$aprove";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['decline']))
{
$decline=$_REQUEST['decline'];
$query="update cancel_leave_tbl SET lb_status='0' WHERE leave_id=$decline";
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset($_REQUEST['upd_leave']) || isset($_REQUEST['add_leave'])){ 

$leave_id=$_POST['leave_id'];
$user_employee=$_POST['user_employee'];
$leave_type=$_POST['leave_type'];
$date_from=$_POST['date_from'];
$date_to=$_POST['date_to'];
$leave_reason=$_POST['leave_reason'];
$lb_status=$_POST['lb_status'];
}

if(isset($_REQUEST['upd_leave']))
{

$query="update cancel_leave_tbl SET user_employee='$user_employee',leave_type='$leave_type',date_from='$date_from',
date_to='$date_to',leave_reason='$leave_reason' WHERE leave_id=$leave_id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
else if(isset($_REQUEST['add_leave']))
{
$querybord="insert into cancel_leave_tbl (user_employee,leave_type,date_from,date_to,leave_reason,lb_status) 
values('$user_employee','$leave_type','$date_from','$date_to','$leave_reason','2')";
mysqli_query($link,$querybord);

$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Acount Successfully.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
else
{
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Warning - </b> Filled the form Correctly.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();
}
?>