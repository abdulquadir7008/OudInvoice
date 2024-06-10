<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
$langSession =$_SESSION['lang'];
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
if(isset($_REQUEST['gen'])){
	$invoicID = $_REQUEST['gen'];
}
$delivery='0';

 $sql_admin="select * from invoice_setting WHERE user_type='1'";
$result_admin=mysqli_query($link,$sql_admin);
$list_admin=mysqli_fetch_array($result_admin);

$sql_cms="select * from spl_invoice WHERE estimate_id=$invoicID"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
if( $row_cms['delivery_charge']){
	$delivery = $row_cms['delivery_charge'];
}

?>
<?php 

$SQLCompany="select * from company_details where user_type='1' limit 1";
$ResultCompany=mysqli_query($link,$SQLCompany);
$ListCompany=mysqli_fetch_array($ResultCompany);
?>
<?php
require('tcpdf/tcpdf.php');

// create new PDF document



class MYPDF extends TCPDF {
// set default header data
    public function Header() {

    }

    // Page footer
    public function Footer() {

    }
}
$pdf = new MYPDF('P', 'mm', 'A5', true, 'UTF-8', false);

$pdf->SetDefaultMonospacedFont('courier');

// $pdf->SetMargins(10	, 40, 10);

$pdf->SetAutoPageBreak(TRUE, 30);

$pdf->AddPage();

$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_language'] = 'ar'; // 'ar' for Arabic
$lg['w_page'] = 'page';
$pdf->setLanguageArray($lg);
$pdf->SetFont('dejavusans', '', 12);



// add invoice information
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(70, 7,   '#'.$list_admin['invocie_prifix'].'-000'.$row_cms['estimate_id'].' '.strtoupper(getTranslatedWord($link,54)), 0, 1);
$pdf->Image('images/oudlogo-invoice.jpg', 120,7,20);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 5, getTranslatedWord($link,84).' : '.$row_cms['estimate_date'], 0, 1);
$pdf->Cell(0, 5, getTranslatedWord($link,64).' : '.$row_cms['expire_date'], 0, 1);

$pdf->Cell(0, 10, '', 0, 1);

if($langSession!='en'){
	$pdf->setRTL(true);
}

$sql = "SELECT * FROM clients 
LEFT JOIN state_add ON clients.city=state_add.state_id
LEFT JOIN country ON clients.country_id=country.country_id
WHERE client_id= '".$row_cms['client']."'";
$result_cms2=mysqli_query($link,$sql); 
$row_cms2=mysqli_fetch_array($result_cms2);

// add customer information
$pdf->Cell(0, 5, getTranslatedWord($link,87).' :', 0, 1);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(0, 5, $row_cms2['fullname'], 0, 1);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 5, $row_cms2['address'].', '.$row_cms2['sname'], 0, 1);
$pdf->Cell(0, 5,  $row_cms2['cname'], 0, 1);
$pdf->Cell(0, 5, getTranslatedWord($link,17).' :'.$row_cms2['email'], 0, 1);
$pdf->Cell(0, 5, getTranslatedWord($link,18).' :'.$row_cms2['phone'], 0, 1);

// add table header



$pdf->Cell(0, 10, '', 0, 1);
$pdf->SetFillColor(247, 247, 247);

$pdf->Cell(5, 10, '#', TB, 0, 'C',1);
$pdf->Cell(40, 10, getTranslatedWord($link,78), TB, 0, 'C',1);
$pdf->Cell(40, 10, getTranslatedWord($link,50), TB, 0, 'C',1);
$pdf->Cell(15, 10, getTranslatedWord($link,79), TB, 0, 'C',1);
$pdf->Cell(15, 10, getTranslatedWord($link,80), TB, 0, 'C',1);
$pdf->Cell(15, 10, getTranslatedWord($link,81), TB, 1, 'C',1);

// add table rows
$k=1;

$sqlestitem = "SELECT invoice_item.unitcost, invoice_item.qty,invoice_item.amount, invoice_item.description AS item_description, project.project_name FROM invoice_item, project WHERE etimate_id = $invoicID AND invoice_item.itemes = project.id;";
$resultest = mysqli_query($link, $sqlestitem);


//$sqlestitem="select * from invoice_item,project WHERE etimate_id=$invoicID and invoice_item.itemes=project.id;";
//$resultest=mysqli_query($link,$sqlestitem);
$subTotal=0;
$fill=0;
while($listetitm=mysqli_fetch_array($resultest)){
	
	$pdf->Cell(5, 10, $k, B, 0, 'C',$fill);
	$pdf->Cell(40, 10, $listetitm['project_name'], B, 0,'C',$fill);
	$pdf->Cell(40, 10, $listetitm['item_description'], B, 0,'C',$fill);
	$pdf->Cell(15, 10, $listetitm['unitcost'], B, 0, 'C',$fill);
	$pdf->Cell(15, 10, $listetitm['qty'], B, 0, 'C',$fill);
	$pdf->Cell(15, 10, 'AED '.$listetitm['amount'], B, 1, 'C',$fill);
	$subTotal=$subTotal+$listetitm['amount'];
	$k++;
    $fill=!$fill;
}


$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(30, 10, getTranslatedWord($link,88).': ', B, 0, 'R');
$pdf->Cell(15, 10, 'AED '.$subTotal, B, 1, 'C');


$pdf->SetTextColor(0,0,107);

$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(30, 10, getTranslatedWord($link,129).': ', B, 0, 'R');
$pdf->Cell(15, 10, 'AED '.$delivery, B, 1, 'C');

$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(30, 10, getTranslatedWord($link,81).': ', B, 0, 'R');
$pdf->Cell(15, 10, 'AED '.($subTotal+$delivery), B, 1, 'C');


// output PDF
 $pdf->Output($list_admin['invocie_prifix'].'000'.$row_cms['estimate_id'].'.pdf', 'D');
//$pdf->Output();

?>