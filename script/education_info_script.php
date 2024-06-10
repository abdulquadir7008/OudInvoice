<?php
include("../config.php");
ob_start();
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
}
$institution=$_POST['institution'];
$subject=$_POST['subject'];
$starting_date=$_POST['starting_date'];
$complate_date=$_POST['complate_date'];
$degree=$_POST['degree'];
$grade=$_POST['grade'];


if(isset($_REQUEST['educ_update_button']))
{
$edu_id=$_POST['edu_id'];
$query="update education_details SET institution='$institution',subject='$subject',starting_date='$starting_date',
complate_date='$complate_date',degree='$degree',grade='$grade',status='0' WHERE edu_id=$edu_id";
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
else if(isset($_REQUEST['educ_ad_button']))
{
	
$querybord="insert into education_details (institution,subject,starting_date,complate_date,degree,grade,status,profile_id) 
values('$institution','$subject','$starting_date','$complate_date','$degree','$grade','0','$customerchechlogin_id')";
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
$query="delete from education_details WHERE edu_id=$del";
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