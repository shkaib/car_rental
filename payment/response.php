<?php
//echo '<pre>';print_r($_POST);exit;
$hostname_onlinebooking = "localhost:3306";
$database_onlinebooking = "expressr_express";
$username_onlinebooking = "expressr_ex";
$password_onlinebooking = "uB,^l8+u%,tl";
$ob_conn = mysql_pconnect($hostname_onlinebooking, $username_onlinebooking, $password_onlinebooking) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_onlinebooking, $ob_conn);
$PaymentId=$_POST["paymentid"];
$Result=$_POST["result"];  //important
$Auth_Code=$_POST["auth"];
$Refrence_Id=$_POST["ref"];
$Transaction_Id=$_POST["tranid"];
$Post_Date=$_POST["postdate"];
$Track_Id=$_POST["trackid"];
$Udf1=$_POST["udf1"];
$Udf2=$_POST["udf2"];
$Udf3=$_POST["udf3"];
$Udf4=$_POST["udf4"];
$Udf5=$_POST["udf5"];
$Transaction_Response=$_POST["responsecode"];  // important
$ErrorMsg=$_POST["ErrorText"];
// You can save the data which you got from the PG in your database, for your records, such as the below line:
$query = "INSERT INTO transaction_details (`paymentid`,`result`,`auth`,`ref`,`tranid`,`postdate`,`trackid`,`udf1`,`udf2`,`udf3`,`responsecode`,`errortext`) VALUES ('$PaymentId','$Result','$Auth_Code','$Refrence_Id','$Transaction_Id','$Post_Date','$Track_Id','$Udf1','$Udf2','$Udf3','$Transaction_Response','$ErrorMsg')";            
$paymentdetails = mysql_query($query, $ob_conn) or die(mysql_error());

// According to the Result value “CAPTURED” or “NOT CAPTURED”, you’ll redirect the customer to the receipt page or the error page:
// And the below lines are the only values that can be printed in the response page without considering it as an error: 

if ($Result == "CAPTURED")              
{
     $query = "UPDATE rs_tbl_order SET order_status='2' WHERE paymentid='$PaymentId'";
       mysql_query($query, $ob_conn) or die(mysql_error());
echo("Redirect= https://www.expressrcar.com/success?paymentid=".$PaymentId."&result=".$Result);  
} 
else if ($Result == "NOT CAPTURED") 
{           
// IF the transaction was declined then the customer will be redirected to the page which shows that the payment is declined.
	$query = "UPDATE rs_tbl_order SET order_status='3' WHERE paymentid='$PaymentId'";
       mysql_query($query, $ob_conn) or die(mysql_error());
	echo("Redirect= https://www.expressrcar.com/failed?paymentid=".$PaymentId."&result=".$Result."&responsecode=".$Transaction_Response);
/*
When the field "result" has the value "NOT CAPTURED", then the payment process has NOT been done successfully and the field "responsecode" can contain various values as described below:

result=NOT CAPTURED | responsecode=05 : There is an issue with the card's bank; the customer should contact the bank to resolve the issue.
result=NOT CAPTURED | responsecode=33 : The customer card is expired.
result=NOT CAPTURED | responsecode=51 : Insufficient funds.
result=NOT CAPTURED | responsecode=54 : The customer card is expired.
result=NOT CAPTURED | responsecode=55 : Incorrect pin number.
result=NOT CAPTURED | responsecode=61 : The card exceeds withdrawal amount limit.
result=NOT CAPTURED | responsecode=91 : The bank is disconnected at the moment.
result=NOT CAPTURED | responsecode=92 : The card number is not yet mapped to the related bank.

*/
}
else 
{ 
// Any Other Error 
	$query = "UPDATE rs_tbl_order SET order_status='3' WHERE paymentid='$PaymentId'";
        mysql_query($query, $ob_conn) or die(mysql_error());
	echo("Redirect= https://www.expressrcar.com/error?paymentid=".$PaymentId."&result=".$Result."&responsecode=".$Transaction_Response);
}

?>
