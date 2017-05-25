<?php
if($_GET['mode']=='delete' && $_GET['extra_feature_id']!=''){
	$objProduct->setProperty("extra_feature_id", DecData($_GET['extra_feature_id']));
	$objProduct->actExtraFeature('D');
	$objCommon->setMessage('Feature content delete successfully.','Info');
	redirect('./?p=ext_f_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['extra_feature_id']!=''){
	$objProduct->setProperty("extra_feature_id", DecData($_GET['extra_feature_id']));
	$objProduct->setProperty("is_active", 2);
	$objProduct->actExtraFeature('U');
	$objCommon->setMessage('Feature InActive successfully.','Info');
	redirect('./?p=ext_f_mgmt');
}
if($_GET['mode']=='Active' && $_GET['extra_feature_id']!=''){
	$objProduct->setProperty("extra_feature_id", DecData($_GET['extra_feature_id']));
	$objProduct->setProperty("is_active", 1);
	$objProduct->actExtraFeature('U');
	$objCommon->setMessage('Feature Active successfully.','Info');
	redirect('./?p=ext_f_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Extra Feature Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=ext_f_form">Add New</a>
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
												<th><?php echo 'Price';?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objCategory = new Product;
								$objProduct->setProperty("ORDERBY", 'extra_feature_id DESC');
								$objProduct->lstExtraFeature();
								$sno=0;
								while($rows = $objProduct->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=ext_f_form&mode=view&extra_feature_id=<?php echo EncData($rows['extra_feature_id']);?>" title="<?php echo $rows['feature_name'];?>"><?php echo $rows['feature_name'];?></a></td>
                                    <td><?php echo $rows["feature_price"];?></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=ext_f_mgmt&mode=InActive&extra_feature_id=<?php echo EncData($rows['extra_feature_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=ext_f_mgmt&mode=Active&extra_feature_id=<?php echo EncData($rows['extra_feature_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=ext_f_form&mode=edit&extra_feature_id=<?php echo EncData($rows['extra_feature_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=ext_f_mgmt&mode=delete&extra_feature_id=<?php echo EncData($rows['extra_feature_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['category_name'];?>?');" title="Delete">
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