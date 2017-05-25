<?php
if($_GET['mode']=='delete' && $_GET['question_id']!=''){
	$objContent->setProperty("question_id", DecData($_GET['question_id']));
	$objContent->actContent('D');
	$objCommon->setMessage('Selective Questionnaire Delete Successfully.','Info');
	redirect('./?p=qust_mgmt');
}
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Questionnaire Management</h2>
                                <!--<ul class="data-header-actions">
									<li style="margin-right:5px;">
										<a class="btn btn-alt btn-inverse" href="./?p=qust_form">Add New</a>
									</li>
								</ul>-->
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
												<th><?php echo 'For';?></th>
												<th><?php echo 'Date';?></th>
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								$objContent->setProperty("ORDERBY", 'question_id DESC');
								$objContent->lstQuestions();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;
								if($rows["read_status"]==1){
									$AddStyle = ' style="font-weight:bold;"';
								} else {
									$AddStyle = '';
								}
                                ?>
                                <tr class="odd gradeX">
                                    <td<?php echo $AddStyle;?>><?php echo $sno;?></td>
                                    <td<?php echo $AddStyle;?>><a href="./?p=qust_form&mode=view&question_id=<?php echo EncData($rows['question_id']);?>" title="<?php echo $rows['q_name'];?>"><?php echo $rows['q_name'];?></a></td>
                                    <td<?php echo $AddStyle;?>><?php echo $rows['q_name'];?></td>
                                    <td<?php echo $AddStyle;?>><?php echo dateFormate_7($rows['posted_date']);?></td>
                                    <td>
                                     <a href="./?p=qust_mgmt&mode=delete&question_id=<?php echo EncData($rows['question_id']);?>" onClick="return doConfirm('Are you sure you want to delete the <?php echo $rows['cms_title'];?>?');" title="Delete">
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