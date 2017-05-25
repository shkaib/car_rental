<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Payment Success</h2>
                </div>
                 
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="image-style1 style1 large-block">
                       <h1 class="title">Thank you</h1>
                       <p>Your payment has been successfully processed.</p>
                       <?php if($_GET['paymentid']!=''){
                            $paymentid = DecData($_GET['paymentid']);
                            //echo $paymentid ;exit;
                            $objOrder->orderSuccessList($paymentid);
                            $OrderList = $objOrder->dbFetchArray(1);
                            //echo '<pre>';print_r($OrderList);exit;
                            $objCustomer->setProperty("customer_id", $OrderList['customer_id']);
                            $customer_id = $OrderList['customer_id'];
                            $objCustomer->CustomerSuccessList($customer_id);
                            $CustomerDetail = $objCustomer->dbFetchArray(1);
			   // echo '<pre>';print_r($CustomerDetail);
                       // echo '<pre>';print_r($OrderList);exit;
                            
                        }?>   
                       
                    </div>
                    <div class="data-container" style="background-color: white;">
						
							<section>
                                <div class="tab-pane active" id="static">
                                    
                                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-striped table-bordered table-hover">
                                      <tbody><tr>
                                        <th>Order Number:</th>
                                        <td width="70%"><?php echo $OrderList['order_id'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Car:</th>
                                        <td width="70%"><?php echo $OrderList['product_name'];?></td>
                                      </tr>
                                    
                                      
                                      <tr>
                                        <th>Start Date / Time:</th>
                                        <td width="70%"><?php echo $OrderList['start_date'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>End Date / Time:</th>
                                        <td width="70%"><?php echo $OrderList['end_date'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Pickup Location:</th>
                                        <td width="70%"><?php echo $OrderList['pickup_location_name'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Drop Location:</th>
                                        <td width="70%"><?php echo $OrderList['drop_location_name'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Total Amount:</th>
                                        <td width="70%" style="color: red"><?php echo $OrderList['product_price'];?> BD</td>
                                      </tr>
                                      
                                      <tr>
                                        <td height="1" colspan="2"></td>
                                      </tr>
                                      
                                      <tr>
                                        <th colspan="2">Customer Information</th>
                                      </tr>
                                      <tr>
                                        <td height="1" colspan="2"></td>
                                      </tr>

                                      <tr>
                                        <th>Full Name:</th>
                                        <td width="70%"><?php echo $CustomerDetail['fullname'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Email Address:</th>
                                        <td width="70%"><?php echo $CustomerDetail['email'];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Phone #</th>
                                        <td width="70%"><?php echo $CustomerDetail['phone'];?></td>
                                      </tr>
                                      
                                    
                                      
                                      
                                     
                                    </tbody></table>
                                    
								</div>
							</section>
						</div>
                    
                </div> <!-- end main -->
            </div>
        </section>
<?php



require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'expressrcar@gmail.com';                 // SMTP username
$mail->Password = 'Expressrcar@123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('expressrcar@gmail.com', 'Express rent a car');
$mail->addAddress($CustomerDetail['email'], $CustomerDetail['fullname']);     // Add a recipient
$mail->addAddress('order@expressrcar.com');               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Order';
$mail->Body    = ' <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-striped table-bordered table-hover">
                                      <tbody>
                                        
                                      <tr>
                                        <th>Order Number:</th>
                                        <td width="50%">'.$OrderList['order_id'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Car:</th>
                                        <td width="50%">'.$OrderList['product_name'].'</td>
                                      </tr>
                                    
                                      
                                      <tr>
                                        <th>Start Date / Time:</th>
                                        <td width="50%">'.$OrderList['start_date'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>End Date / Time:</th>
                                        <td width="50%">'.$OrderList['end_date'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Pickup Location:</th>
                                        <td width="50%">'.$OrderList['pickup_location_name'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Drop Location:</th>
                                        <td width="50%">'.$OrderList['drop_location_name'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Total Amount:</th>
                                        <td width="50%" style="color: red">'.$OrderList['product_price'].' BD</td>
                                      </tr>
                                      
                                      <tr>
                                        <td height="1" colspan="2"></td>
                                      </tr>
                                      
                                      <tr>
                                        <th colspan="2">Customer Information</th>
                                      </tr>
                                      <tr>
                                        <td height="1" colspan="2"></td>
                                      </tr>

                                      <tr>
                                        <th>Full Name:</th>
                                        <td width="50%">'.$CustomerDetail['fullname'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Email Address:</th>
                                        <td width="50%">'.$CustomerDetail['email'].'</td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Phone:</th>
                                        <td width="50%">'.$CustomerDetail['phone'].'</td>
                                      </tr>
                                      
                                    
                                      
                                      
                                     
                                    </tbody></table>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//echo 'hai';exit;
if(!$mail->send()) {
    //echo 'Message could not be sent.';
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message has been sent';
}