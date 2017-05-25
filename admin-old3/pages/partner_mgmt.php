<?php
if($_GET['mode']=='delete' && $_GET['partner_id']!=''){
	$objContent->setProperty("partner_id", DecData($_GET['partner_id']));
	$objContent->actPartner('D');
	$objCommon->setMessage('Partner content delete successfully.','Info');
	redirect('./?p=partner_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['partner_id']!=''){
	$objContent->setProperty("partner_id", DecData($_GET['partner_id']));
	$objContent->setProperty("is_active", 2);
	$objContent->actPartner('U');
	$objCommon->setMessage('Partner content InActive successfully.','Info');
	redirect('./?p=partner_mgmt');
}
if($_GET['mode']=='Active' && $_GET['partner_id']!=''){
	$objContent->setProperty("partner_id", DecData($_GET['partner_id']));
	$objContent->setProperty("is_active", 1);
	$objContent->actPartner('U');
	$objCommon->setMessage('Partner content Active successfully.','Info');
	redirect('./?p=partner_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Our Patner Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
                                        <a class="btn btn-alt btn-inverse" href="./?p=partner_form">Add New</a>
									</li>
								</ul>
							</header>
							<section>
							
                                <div class="tab-pane" id="dynamic">
									<table class="datatable table table-striped table-bordered table-hover" id="example-2">
										<thead>
											<tr>
												<th><?php echo CMS_FLD_SN;?></th>
                                                <th><?php echo CMS_FLD_TITLE;?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objContent->setProperty("ORDERBY", 'partner_id DESC');
								$objContent->lstPartner();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=partner_form&mode=view&partner_id=<?php echo EncData($rows['partner_id']);?>" title="<?php echo $rows['partner_name'];?>"><?php echo $rows['partner_name'];?></a></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=partner_mgmt&mode=InActive&partner_id=<?php echo EncData($rows['partner_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=partner_mgmt&mode=Active&partner_id=<?php echo EncData($rows['partner_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=partner_form&mode=edit&partner_id=<?php echo EncData($rows['partner_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=partner_mgmt&mode=delete&partner_id=<?php echo EncData($rows['partner_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['partner_name'];?>?');" title="Delete">
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