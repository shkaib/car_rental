			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Order Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<!--<a class="btn btn-alt btn-inverse" href="./?p=sitecms_form">Add New</a>-->
									</li>
								</ul>
							</header>
							<section>
							
                                <div class="tab-pane" id="dynamic">
								<span>
                                <?php //echo $objCommon->displayMessage();?>
                                </span>
									
									<table class="datatable table table-striped table-bordered table-hover" id="example-2">
										<thead>
											<tr>
												<th><?php echo CMS_FLD_SN;?></th>
                                                <th><?php echo 'Order #';?></th>
												<th><?php echo 'Car Option';?></th>
												<th><?php echo 'Customer Name';?></th>
                                                <th><?php echo 'Order Type';?></th>
                                                <th><?php echo 'Date';?></th>
                                                <th><?php echo 'Amount';?></th>
                                                <th><?php echo 'Status';?></th>
											</tr>
										</thead>
										<tbody>
								
                                
                                
			<?php
			$objOrder->setProperty("ORDERBY", 'order_id DESC');
			$objOrder->lstOrder();
			$OSR=0;
			while($OrderList = $objOrder->dbFetchArray(1)){
				$OSR++;
			$objCustomer->setProperty("customer_id", $OrderList['customer_id']);
			$objCustomer->lstCustomer();
			$CustomerDetail = $objCustomer->dbFetchArray(1);
			
			if($OrderList['order_status']==1){
			$OrderStatus = 'Pending';
			} elseif($OrderList['order_status']==2){
			$OrderStatus = 'Paid';	
			}
			list($OrderDate,$OrderTime)= explode(' ', $OrderList['order_date']);
			?>           
                <tr class="odd gradeX">
                    <td><?php echo $OSR;?></td>
                    <td><a href="./?p=order_view&ordid=<?php echo EncData($OrderList["order_id"]);?>"><?php echo $OrderList['order_id'];?></a></td>
                    <td><?php echo $OrderList['product_name'];?></td>
                    <td><?php echo $CustomerDetail['fullname'];?></td>
                    <td><?php echo RentType($OrderList['order_type']);?></td>
                    <td><?php echo $objCommon->printDate($OrderDate);?></td>
                    <td>$<?php echo $OrderList['grand_total'];?></td>
                    <td><?php echo $OrderStatus;?></td>
                </tr>
			<?php } ?>                        
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
					
										</tbody>
									</table>
								</div>
                      
							</section>
						</div>
					</article>
					<!-- /Data block -->

				</div>
                
				
			</div>
			<!-- /Right (content) side -->