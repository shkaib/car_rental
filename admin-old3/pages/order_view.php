<?php
$mode	= "I";
$objRoute = new Route;
/*if(DecData($_GET['mode'])=='approved' && $_GET['ordid']!='' && $_GET['cid']!='' && $_GET['cwi']!=''){
		$objOrderAction = new Order;
		$objOrderAction->setProperty("order_status", 1);
		$objOrderAction->setProperty("order_id", DecData($_GET['ordid']));
		$objOrderAction->setProperty("customer_id", DecData($_GET['cid']));
		$objOrderAction->setProperty("customer_work_id", DecData($_GET['cwi']));
		if($objOrderAction->actOrder('U')){
			
				$objOrder->setProperty("order_id", DecData($_GET['ordid']));
				$objOrder->lstOrder();
				$OrderPackageID = $objOrder->dbFetchArray(1);
					
					$objPackageDetail = new Other;
					$objPackageDetail->setProperty("package_id", $OrderPackageID['package_id']);
					$objPackageDetail->lstAccountPackages();
					$OrderPackageID = $objPackageDetail->dbFetchArray(1);
			
				$objCustomerOrder = new Customer;
				$objCustomerOrder->setProperty("is_active", 1);
				$objCustomerOrder->setProperty("total_resume", $OrderPackageID['number_of_post']);
				$objCustomerOrder->setProperty("remaining_resume", 0);
				$objCustomerOrder->setProperty("customer_id", DecData($_GET['cid']));
				$objCustomerOrder->setProperty("customer_work_id", DecData($_GET['cwi']));
				$objCustomerOrder->actCustomerWorkPackages('U');
				
			$objCommon->setMessage('Order status successfully changed.','Info');
			redirect('./?p=order_mgmt');
		}
}*/

$Order_id = DecData($_GET['ordid']);
$objOrder->setProperty("order_id", $Order_id);
$objOrder->lstOrder();
$OrderList = $objOrder->dbFetchArray(1);

$objCustomer->setProperty("customer_id", $OrderList['customer_id']);
$objCustomer->lstCustomer();
$CustomerDetail = $objCustomer->dbFetchArray(1);
			
if($OrderList['payment_method']==''){
$PrintPaymentMethord = 'PayPal';
} else {	
$PrintPaymentMethord = $rows['payment_method'];
}

if($OrderList['order_status']==1){
$OrderStatus = 'Active';
} elseif($OrderList['order_status']==2){
$OrderStatus = 'Payment Pending';	
} elseif($OrderList['order_status']==3){
$OrderStatus = 'Cancel';
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Order # <?php echo $OrderList['order_id'];?> </h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=order_mgmt">Back</a>
                                </li>
                               <?php if($OrderList['order_status']==2){ ?> 
                                <li>
<a class="btn btn-alt btn-inverse" 
href="./?p=order_view&mode=<?php echo EncData('approved');?>&ordid=<?php echo EncData($OrderList['order_id']);?>&cid=<?php echo EncData($OrderList['customer_id']);?>&cwi=<?php echo EncData($OrderList['customer_work_id']);?>">
Approved</a>
                                </li>
                            	<?php } ?>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
                                    
                                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-striped table-bordered table-hover">
                                      <tr>
                                        <th>Order Number:</th>
                                        <td width="70%"><?php echo $OrderList['order_id']; ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Car:</th>
                                        <td width="70%"><?php echo $OrderList['product_name']; ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Rent Type:</th>
                                        <td width="70%"><?php echo RentType($OrderList['order_type']); ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Start Date / Time:</th>
                                        <td width="70%"><?php echo $OrderList['start_date']; ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>End Date / Time:</th>
                                        <td width="70%"><?php echo $OrderList['end_date']; ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Pickup Location:</th>
                                        <td width="70%"><?php 
										$ObjLocationA = new Content;
										echo $ObjLocationA->getLocationName($OrderList['pickup_location_id']); ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Drop Location:</th>
                                        <td width="70%"><?php 
										$ObjLocationB = new Content;
										echo $ObjLocationB->getLocationName($OrderList['drop_location_id']); ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Total Amount:</th>
                                        <td width="70%">BD<?php echo $OrderList['grand_total']; ?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td height="1" colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <th colspan="2">Extra Feature's</th>
                                      </tr>
									<?php
                                    $Order_id = DecData($_GET['ordid']);
                                    $objOrderDetail = new Order;
									$objOrderDetail->setProperty("order_id", $Order_id);
                                    $objOrderDetail->lstOrderDetail();
									if($objOrderDetail->totalRecords() > 0){
                                    while($OrderExtra = $objOrderDetail->dbFetchArray(1)){
										
										$objProduct->setProperty("extra_feature_id", $OrderExtra['extra_feature_id']);
										$objProduct->lstExtraFeature();
										$ExtraFeature = $objProduct->dbFetchArray(1);
                                    ?> 
                                      <tr>
                                        <th><?php echo $ExtraFeature["feature_name"];?>:</th>
                                        <td width="70%"><strong>Required</strong></td>
                                      </tr>
                                    <?php } } else { ?>
                                    <tr>
                                        <td colspan="2">No Extra Feature Required.</td>
                                      </tr>
                                    <?php } ?>
                                    
                                    
                                    
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
                                        <td width="70%"><?php echo $CustomerDetail["fullname"];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Email Address:</th>
                                        <td width="70%"><?php echo $CustomerDetail["email"];?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Phone #</th>
                                        <td width="70%"><?php echo $CustomerDetail["phone"];?></td>
                                      </tr>
                                      
                                    
                                      
                                      
                                     
                                    </table>
                                    
								</div>
							</section>
						</div>
					</article>
					<!-- /Data block -->
				</div>				
			</div>
			<!-- /Right (content) side -->