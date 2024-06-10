<?php

session_start();



$dbhost = 'localhost';

//$dbuser = 'ct360_llaha';

//$dbpass = 'rasul786';



$dbuser = 'testUser';

$dbpass = 'test23';

$dbname = 'testDB';



$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

//$dbname = 'ct360_bismillaha';

//mysql_select_db($dbname);



$path="uploads/";

$path0="uploads/";

$rand1=rand(1, 100);

$domain_url="https://oudalfaisall.com/invoice/";

function casechange($str1) {

return strtoupper($str1);

}

date_default_timezone_set('Asia/Kolkata');

//ini_set('date.timezone', 'Australia/Sydney');

$currentFile=@basename($_SERVER['PHP_SELF'], ".php");



function getIndianCurrency(float $number)

{

    $decimal = round($number - ($no = floor($number)), 2) * 100;

    $hundred = null;

    $digits_length = strlen($no);

    $i = 0;

    $str = array();

    $words = array(0 => '', 1 => 'One', 2 => 'Two',

        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',

        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',

        10 => 'Ten', 11 => 'Lleven', 12 => 'Twelve',

        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',

        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',

        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',

        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',

        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');

    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');

    while( $i < $digits_length ) {

        $divider = ($i == 2) ? 10 : 100;

        $number = floor($no % $divider);

        $no = floor($no / $divider);

        $i += $divider == 10 ? 1 : 2;

        if ($number) {

            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;

        } else $str[] = null;

    }

    $Rupees = implode('', array_reverse($str));

    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';

    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;

}

function getTranslatedWord($link,$wid){
    $res='';
    $langSession =$_SESSION['lang'];
    $getTra_sql="select * from invoice_language WHERE lang_id=$wid and status='1'";
    $result_lang=mysqli_query($link,$getTra_sql);
    $list_lang=mysqli_fetch_array($result_lang);
    if($langSession =='en'){
        $res= $list_lang['english'];
    }else{
        $res= $list_lang['arabic'];
    } 
    return $res;
}

$invoice_language_sql="select * from invoice_language WHERE status='1'";







?>