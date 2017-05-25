<?php
if($_GET['mode']=='delete' && $_GET['portfolio_id']!=''){
	$objContent->setProperty("portfolio_id", DecData($_GET['portfolio_id']));
	$objContent->actPortfolio('D');
	$objCommon->setMessage('Project Content delete successfully.','Info');
	redirect('./?p=portfolio_mgmt');
}
if($_GET['mode']=='InActive' && $_GET['portfolio_id']!=''){
	$objContent->setProperty("portfolio_id", DecData($_GET['portfolio_id']));
	$objContent->setProperty("is_active", 2);
	$objContent->actPortfolio('U');
	$objCommon->setMessage('Project Content InActive successfully.','Info');
	redirect('./?p=portfolio_mgmt');
}
if($_GET['mode']=='Active' && $_GET['portfolio_id']!=''){
	$objContent->setProperty("portfolio_id", DecData($_GET['portfolio_id']));
	$objContent->setProperty("is_active", 1);
	$objContent->actPortfolio('U');
	$objCommon->setMessage('Project Content Active successfully.','Info');
	redirect('./?p=portfolio_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Our Portfolio Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
                                        <a class="btn btn-alt btn-inverse" href="./?p=portfolio_form">Add New</a>
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
								$objContent->setProperty("ORDERBY", 'portfolio_id DESC');
								$objContent->lstProject();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="./?p=portfolio_form&mode=view&portfolio_id=<?php echo EncData($rows['portfolio_id']);?>" title="<?php echo $rows['project_name'];?>"><?php echo $rows['project_name'];?></a></td>
                                    <td><?php if($rows['is_active']==1){ echo 'Active'; } else { echo 'InActive';}?></td>
                                    <td>
									<?php if($rows['is_active']==1){?>
                                    <a href="./?p=portfolio_mgmt&mode=InActive&portfolio_id=<?php echo EncData($rows['portfolio_id']);?>" title="InActive">
                                    <img src="../images/icons/action_remove.gif" border="0" title="InActive" alt="InActive" /></a>
                                    <?php } else { ?>
                                    <a href="./?p=portfolio_mgmt&mode=Active&portfolio_id=<?php echo EncData($rows['portfolio_id']);?>" title="Active">
                                    <img src="../images/icons/action_check.gif" border="0" title="Active" alt="Active" /></a>
                                    <?php } ?>
                                     &nbsp; 
                                    <a href="./?p=portfolio_form&mode=edit&portfolio_id=<?php echo EncData($rows['portfolio_id']);?>" title="Edit">
                                    <img src="../images/icons/edit.gif" border="0" title="Edit" alt="Edit" /></a>
                                     &nbsp; 
                                     <a href="./?p=portfolio_mgmt&mode=delete&portfolio_id=<?php echo EncData($rows['portfolio_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['project_name'];?>?');" title="Delete">
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