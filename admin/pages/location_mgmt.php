<?php
if($_GET['mode']=='delete' && $_GET['location_id']!=''){
	$objContent->setProperty("location_id", DecData($_GET['location_id']));
	$objContent->actLocation('D');
	$objCommon->setMessage('Location content delete successfully.','Info');
	redirect('./?p=location_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['location_id']!=''){
	$objContent->setProperty("location_id", DecData($_GET['location_id']));
	$objContent->setProperty("is_active", 2);
	$objContent->actLocation('U');
	$objCommon->setMessage('Location content InActive successfully.','Info');
	redirect('./?p=location_mgmt');
}
if($_GET['mode']=='Active' && $_GET['location_id']!=''){
	$objContent->setProperty("location_id", DecData($_GET['location_id']));
	$objContent->setProperty("is_active", 1);
	$objContent->actLocation('U');
	$objCommon->setMessage('Location content Active successfully.','Info');
	redirect('./?p=location_mgmt');
}
$objContentParent = new Content;
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Location Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=location_form">Add New</a>
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
                                                <th><?php echo CMS_FLD_TITLE;?></th>
												<th><?php echo 'Price';?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objContent->setProperty("ORDERBY", 'location_id DESC');
								$objContent->lstLocation();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
								if($rows['is_active']==2){
								$bgcolor = ($bgcolor == "#FFDBCC");
								}
                               
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><?php echo $rows['location_title'];?></td>
                                    <td><?php echo $rows['location_price'];?></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=location_mgmt&mode=InActive&location_id=<?php echo EncData($rows['location_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=location_mgmt&mode=Active&location_id=<?php echo EncData($rows['location_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=location_form&mode=edit&location_id=<?php echo EncData($rows['location_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=location_mgmt&mode=delete&location_id=<?php echo EncData($rows['location_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['location_title'];?>?');" title="Delete">
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