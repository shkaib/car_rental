<?php
if($_GET['mode']=='delete' && $_GET['product_id']!=''){

	$objProduct->setProperty("product_id", DecData($_GET['product_id']));
	$objProduct->actProduct('D');

	$objCommon->setMessage('Car content delete successfully.','Info');
	redirect('./?p=product_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['product_id']!=''){
	$objProduct->setProperty("product_id", DecData($_GET['product_id']));
	$objProduct->setProperty("is_active", 2);
	$objProduct->actProduct('U');
	$objCommon->setMessage('Car InActive successfully.','Info');
	redirect('./?p=product_mgmt');
}
if($_GET['mode']=='Active' && $_GET['product_id']!=''){
	$objProduct->setProperty("product_id", DecData($_GET['product_id']));
	$objProduct->setProperty("is_active", 1);
	$objProduct->actProduct('U');
	$objCommon->setMessage('Car Active successfully.','Info');
	redirect('./?p=product_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Car Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=product_form">Add New</a>
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
                                                <th><?php echo 'Name';?></th>
												<th><?php echo 'Rent';?></th>
                                                <th><?php echo 'Type';?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objCategory = new Product;
								$objProduct->setProperty("ORDERBY", 'product_id DESC');
								$objProduct->lstProducts();
								$sno=0;
								while($rows = $objProduct->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=product_form&mode=view&product_id=<?php echo EncData($rows['product_id']);?>" title="<?php echo $rows['product_name'];?>"><?php echo $rows['product_name'];?></a></td>
                                    <td><?php echo $rows["product_price"];?></td>
                                    <td><?php echo RentType($rows["product_type"]);?></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=product_mgmt&mode=InActive&product_id=<?php echo EncData($rows['product_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=product_mgmt&mode=Active&product_id=<?php echo EncData($rows['product_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=product_form&mode=edit&product_id=<?php echo EncData($rows['product_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=product_mgmt&mode=delete&product_id=<?php echo EncData($rows['product_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['category_name'];?>?');" title="Delete">
                                     <img src="../images/icons/action_delete.gif" border="0" title="Delete" alt="Delete" /></a>
                                    </td>
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