<?php include("config.php");
if(isset($_POST['addstate'])){

$country_id = $_REQUEST['country_id'];
$sname = $_REQUEST['sname'];
$querybord="insert into state_add (sname,country_id) values('$sname','$country_id')";
mysqli_query($link,$querybord);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>User Add Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form action="country_state.php" method="post">
  <select class="select" name="country_id">
    <option>Select Country</option>
    <?php
    $leave_tbl2_sql = "select * from country";
    $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
    while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
      ?>
    <option value="<?php echo $leave_tbl2_row['country_id'];?>"><?php echo $leave_tbl2_row['cname'];?></option>
    <?php } ?>
  </select>
	<input type="text" name="sname">
  <button type="submit" name="addstate">Submit</button>
</form>
</body>
</html>