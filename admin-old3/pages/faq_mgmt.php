<?php
if($_GET['mode']=='delete' && $_GET['faq_id']!=''){
	$objContent->setProperty("faq_id", DecData($_GET['faq_id']));
	$objContent->actFaq('D');
	$objCommon->setMessage("FAQ content delete successfully.",'Info');
	redirect('./?p=faq_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['faq_id']!=''){
	$objContent->setProperty("faq_id", DecData($_GET['faq_id']));
	$objContent->setProperty("is_active", 2);
	$objContent->actFaq('U');
	$objCommon->setMessage("FAQ content InActive successfully.",'Info');
	redirect('./?p=faq_mgmt');
}
if($_GET['mode']=='Active' && $_GET['faq_id']!=''){
	$objContent->setProperty("faq_id", DecData($_GET['faq_id']));
	$objContent->setProperty("is_active", 1);
	$objContent->actFaq('U');
	$objCommon->setMessage("FAQ content Active successfully.",'Info');
	redirect('./?p=faq_mgmt');
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
								<h2>FAQ Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=faq_form">Add New</a>
									</li>
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
												<th><?php echo CMS_FLD_SN;?></th>
                                                <th><?php echo CMS_FLD_TITLE;?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objContent->setProperty("ORDERBY", 'faq_title');
								$objContent->lstFaq();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=faq_form&mode=view&faq_id=<?php echo EncData($rows['faq_id']);?>" title="<?php echo $rows['faq_title'];?>"><?php echo $rows['faq_title'];?></a></td>
                                    <td><?php if($rows['faq_status']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>                                     
                                     


<?php if($rows['faq_status']==1){?>
<a href="./?p=faq_mgmt&mode=InActive&faq_id=<?php echo EncData($rows['faq_id']);?>" title="InActive" class="on-default edit-row"><img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
<?php } else { ?>
<a href="./?p=faq_mgmt&mode=Active&faq_id=<?php echo EncData($rows['faq_id']);?>" title="Active" class="on-default edit-row"><img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
<?php } ?>
&nbsp;&nbsp; &nbsp;
<a href="./?p=faq_form&mode=edit&faq_id=<?php echo EncData($rows['faq_id']);?>" title="Edit" class="on-default edit-row"><img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
&nbsp; &nbsp;

<a href="./?p=faq_mgmt&mode=delete&faq_id=<?php echo EncData($rows['faq_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['location_title'];?>?');" title="Delete">
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