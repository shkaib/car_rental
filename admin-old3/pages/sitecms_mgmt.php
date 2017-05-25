<?php
if($_GET['mode']=='delete' && $_GET['cms_id']!=''){
	$objContent->setProperty("cms_id", DecData($_GET['cms_id']));
	$objContent->actContent('D');
	$objCommon->setMessage(CMS_MSG_SUCCESS_DEL,'Info');
	redirect('./?p=sitecms_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['cms_id']!=''){
	$objContent->setProperty("cms_id", DecData($_GET['cms_id']));
	$objContent->setProperty("is_active", 2);
	$objContent->actContent('U');
	$objCommon->setMessage(CMS_MSG_SUCCESS_INACTIVE,'Info');
	redirect('./?p=sitecms_mgmt');
}
if($_GET['mode']=='Active' && $_GET['cms_id']!=''){
	$objContent->setProperty("cms_id", DecData($_GET['cms_id']));
	$objContent->setProperty("is_active", 1);
	$objContent->actContent('U');
	$objCommon->setMessage(CMS_MSG_SUCCESS_ACTIVE,'Info');
	redirect('./?p=sitecms_mgmt');
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
								<h2>Content Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=sitecms_form">Add New</a>
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
												<th><?php echo 'Parent';?></th>
												<th><?php echo 'Status';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objContent->setProperty("cms_type_id", 1);
								$objContent->lstContent();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
								if($rows['is_active']==2){
								$bgcolor = ($bgcolor == "#FFDBCC");
								}
                                if($rows['parent_id']!=0){
                                $objContentParent->setProperty("cms_id", $rows['parent_id']);
                                $objContentParent->lstContent();
                                $Parentname = $objContentParent->dbFetchArray(1);
                                $MainParentName = $Parentname["cms_title"];
                                } else {
                                $MainParentName = 'NoN';
                                }
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=sitecms_form&mode=view&cms_id=<?php echo EncData($rows['cms_id']);?>" title="<?php echo $rows['cms_title'];?>"><?php echo $rows['cms_title'];?></a></td>
                                    <td><?php echo $MainParentName;?></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=sitecms_mgmt&mode=InActive&cms_id=<?php echo EncData($rows['cms_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=sitecms_mgmt&mode=Active&cms_id=<?php echo EncData($rows['cms_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=sitecms_form&mode=edit&cms_id=<?php echo EncData($rows['cms_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=sitecms_mgmt&mode=delete&cms_id=<?php echo EncData($rows['cms_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['cms_title'];?>?');" title="Delete">
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