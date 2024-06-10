<?php include('config.php');?>
<?php
$city_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($city_id <> "") {
    $sql = "SELECT * FROM clients 
	LEFT JOIN state_add ON clients.city=state_add.state_id
	LEFT JOIN country ON clients.country_id=country.country_id
	WHERE client_id= '$city_id'";
    $result_cms2=mysqli_query($link,$sql); 

    if (count($result_cms2) > 0) {
		$row_cms2=mysqli_fetch_array($result_cms2);
	echo $ecorat  = "<div class='col-md-7'><h4>".$row_cms2['fullname']."</h4><p>".$row_cms2['address'].", ".$row_cms2['sname']."<br> ".$row_cms2['cname']."</p><p>Email : ".$row_cms2['email']."<br>Phone : ".$row_cms2['phone']."</p></div>";
        ?>
	<input type="hidden" name="billing_address" value="<?php echo $ecorat;?>">
    <input type="hidden" name="email" value="<?php echo $row_cms2['email'];?>">     
           
        <?php
    }
}
?>

