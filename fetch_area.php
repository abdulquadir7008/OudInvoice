<?php include('config.php')?>
<?php
$city_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($city_id <> "") {
    $sql = "SELECT * FROM state_add WHERE country_id= '$city_id' ORDER BY sname ASC";
    $result_cms2=mysqli_query($link,$sql); 

    if (count($result_cms2) > 0) {
        ?>
        
           
            <option value="">Select City</option>
                <?php while($row_cms2=mysqli_fetch_array($result_cms2)) { ?>
                    <option value="<?php echo $row_cms2["state_id"]; ?>"><?php echo $row_cms2["sname"]; ?></option>
                <?php } ?>
        
       
        <?php
    }
}
?>
