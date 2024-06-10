<?php $connect = new PDO("mysql:host=localhost;dbname=dat_invoice", "root", "");
$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
 SELECT * FROM clients 
 WHERE fullname REGEXP '".$search."' 
 OR email REGEXP '".$search."' 
 OR phone REGEXP '".$search."' 
 OR city REGEXP '".$search."' 
 OR address REGEXP '".$search."'
 ";
}
else
{
 $query = "
 SELECT * FROM clients ORDER BY client_id
 ";
}

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);

?>