<?php include("config.php");
$client_email_list ='';
if(isset($_REQUEST['call_submit']))
{

	$meeting_propsal = $_REQUEST['meeting_propsal'];
	$location = $_REQUEST['location'];
	$description =$_REQUEST['description'];
	$date = str_replace('/', '-', $_REQUEST['update']);
	
$from_name = "OUD";
$from_address = "info@taddigital.com";
$to_name = "Abdul Quadir";

$startTime = date('m/d/y',strtotime($date))." ".$_REQUEST['start_time'].":00";
$endTime = date('m/d/y',strtotime($date))." ".$_REQUEST['end_time'].":00";;
$domain = 'www.taddigital.com';	
$client=implode(',',$_REQUEST['client']);
$splittedstring=explode(",",$client);
foreach ($splittedstring as  $value) {
	$value;
	$SQLSubcat="select * from clients where client_id='$value'";	
	$MySQLssubcat = mysqli_query($link,$SQLSubcat); 
	$Listsubcat=mysqli_fetch_array($MySQLssubcat);
	$client_email_list .= $Listsubcat['email'].",";
	$to_address = $Listsubcat['email'];
	$client_name = $Listsubcat['fullname'];
	$subject = "Invitation : ".$Listsubcat['fullname']." - ".date("D M y, h:i:A", strtotime($startTime))." - ".date("D M y, h:i:A", strtotime($endTime))."- ".$meeting_propsal." (".$to_address.")";
	$subj = $Listsubcat['fullname']."(".$from_name.") : ".$meeting_propsal;
//Create Email Headers
$mime_boundary = $meeting_propsal.MD5(TIME());

$headers = "From: ".$from_name." <".$from_address.">\n";
$headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
$headers .= "Content-class: urn:content-classes:calendarmessage\n";

//Create Email Body (HTML)
$message = "--$mime_boundary\r\n";
$message .= "Content-Type: text/html; charset=UTF-8\n";
$message .= "Content-Transfer-Encoding: 8bit\n\n";
$message .= "<html>\n";
$message .= "<body>\n";

$message .= $description;

$message .= "</body>\n";
$message .= "</html>\n";
$message .= "--$mime_boundary\r\n";

//Event setting
$ical = 'BEGIN:VCALENDAR' . "\r\n" .
'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
'VERSION:2.0' . "\r\n" .
'METHOD:REQUEST' . "\r\n" .
'BEGIN:VTIMEZONE' . "\r\n" .
'TZID:Asia/Calcutta' . "\r\n" .
'BEGIN:STANDARD' . "\r\n" .
'DTSTART:20150501T080000' . "\r\n" .
'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
'TZOFFSETFROM:+0530' . "\r\n" .
'TZOFFSETTO:+0530' . "\r\n" .
'TZNAME:IST' . "\r\n" .
'END:STANDARD' . "\r\n" .
'BEGIN:DAYLIGHT' . "\r\n" .
'DTSTART:20150501T080000' . "\r\n" .
'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
'TZOFFSETFROM:+0530' . "\r\n" .
'TZOFFSETTO:+0530' . "\r\n" .
'TZNAME:EDST' . "\r\n" .
'END:DAYLIGHT' . "\r\n" .
'END:VTIMEZONE' . "\r\n" .
'BEGIN:VEVENT' . "\r\n" .
'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
'DTSTART;TZID=Asia/Kolkata:'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
'DTEND;TZID=Asia/Kolkata:'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
'TRANSP:OPAQUE'. "\r\n" .
'SEQUENCE:1'. "\r\n" .
'SUMMARY:' . $subj . "\r\n" .
'LOCATION:' . $location . "\r\n" .
'CLASS:PUBLIC'. "\r\n" .
'PRIORITY:5'. "\r\n" .
'BEGIN:VALARM' . "\r\n" .
'TRIGGER:-PT15M' . "\r\n" .
'ACTION:DISPLAY' . "\r\n" .
'DESCRIPTION:' .$description. "\r\n" .
'END:VALARM' . "\r\n" .
'END:VEVENT'. "\r\n" .
'END:VCALENDAR'. "\r\n";
$message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
$message .= "Content-Transfer-Encoding: 8bit\n\n";
$message .= $ical;
mail($to_address, $subject, $message, $headers);
}
$query="insert into meeting_list(email_id,start_time,end_time,subject,description,location,meeting_propsal) values('$client_email_list','$startTime','$endTime','$subject','$description','$location','$meeting_propsal')";
mysqli_query($link,$query);
$errmsg_arr[] = 'Success: Meeting Invitation send Successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location:meeting_list.php');
}
	
?>