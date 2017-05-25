<?php
if($_GET['mode']=='delete' && $_GET['category_id']!=''){
	$objProduct->setProperty("category_id", DecData($_GET['category_id']));
	$objProduct->actCategory('D');
	$objCommon->setMessage('Category content delete successfully.','Info');
	redirect('./?p=category_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['category_id']!=''){
	$objProduct->setProperty("category_id", DecData($_GET['category_id']));
	$objProduct->setProperty("category_status", 2);
	$objProduct->actCategory('U');
	$objCommon->setMessage('CMS InActive successfully.','Info');
	redirect('./?p=category_mgmt');
}
if($_GET['mode']=='Active' && $_GET['category_id']!=''){
	$objProduct->setProperty("category_id", DecData($_GET['category_id']));
	$objProduct->setProperty("category_status", 1);
	$objProduct->actCategory('U');
	$objCommon->setMessage('Category Active successfully.','Info');
	redirect('./?p=category_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Category Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=category_form">Add New</a>
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
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objProduct->setProperty("ORDERBY", "category_id DESC");
								$objProduct->lstCategory();
								$sno=0;
								while($rows = $objProduct->dbFetchArray(1)){
								$sno++;
								if($rows['category_name']==0){
									$Passvalue = 'Null';
								} else {
									$Passvalue = $rows['parent_cat'];
								}
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><?php echo $rows['category_name'];?></td>
                                    <td><?php if($rows['category_status']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['category_status']==1){?>
                                    <a href="./?p=category_mgmt&mode=InActive&category_id=<?php echo EncData($rows['category_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=category_mgmt&mode=Active&category_id=<?php echo EncData($rows['category_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=category_form&mode=edit&category_id=<?php echo EncData($rows['category_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=category_mgmt&mode=delete&category_id=<?php echo EncData($rows['category_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['category_name'];?>?');" title="Delete">
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