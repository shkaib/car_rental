<?php
if($_GET['mode']=='delete' && $_GET['lease_id']!=''){
	$objProduct->setProperty("lease_id", DecData($_GET['lease_id']));
	$objProduct->actFaq('D');
	$objCommon->setMessage(CMS_MSG_SUCCESS_DEL,'Info');
	redirect('./?p=sitecms_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['lease_id']!=''){
	$objProduct->setProperty("lease_id", DecData($_GET['lease_id']));
	$objProduct->setProperty("is_active", 2);
	$objProduct->actFaq('U');
	$objCommon->setMessage(CMS_MSG_SUCCESS_INACTIVE,'Info');
	redirect('./?p=sitecms_mgmt');
}
if($_GET['mode']=='Active' && $_GET['lease_id']!=''){
	$objProduct->setProperty("lease_id", DecData($_GET['lease_id']));
	$objProduct->setProperty("is_active", 1);
	$objProduct->actFaq('U');
	$objCommon->setMessage(CMS_MSG_SUCCESS_ACTIVE,'Info');
	redirect('./?p=sitecms_mgmt');
}
$objProductParent = new Content;
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Limousine Management</h2>
                                <ul class="data-header-actions">
								</ul>
							</header>
							<section>
							
                                <div class="tab-pane" id="dynamic">
								<span>
                                <?php //echo $objCommon->displayMessage();?>
                                </span>
									
									<table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                                                <th><?php echo 'Name/Title';?></th>
                                                <th><?php echo 'Option';?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objProduct->setProperty("type_id", 2);
								$objProduct->setProperty("ORDERBY", 'lease_id DESC');
								$objProduct->lstCarLease();
								$sno=0;
								while($rows = $objProduct->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><a href="./?p=limousine_form&mode=view&lease_id=<?php echo EncData($rows['lease_id']);?>" title="<?php echo $rows['full_name'];?>"><?php echo $rows['full_name'];?></a></td>
                                    <td><?php echo LeaseType($rows['lease_type']);?></td>
                                    <td><?php if($rows['lease_ststus']==1){ echo 'New'; } else { echo 'Read';}?></td>
                                    <td><a href="./?p=limousine_mgmt&mode=delete&lease_id=<?php echo EncData($rows['lease_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['location_title'];?>?');" title="Delete">
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