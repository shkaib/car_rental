<?php
if($_GET['mode']=='delete' && $_GET['feedback_id']!=''){
	$objContent->setProperty("feedback_id", DecData($_GET['feedback_id']));
	$objContent->actFeedback('D');
	$objContent->setMessage('Feedback delete successfully.','Info');
	redirect('./?p=feedback_mgmt');
}
$objContentParent = new Content;
?>
<!-- Right (content) side -->
<?php if($_GET['mode']!='view'){?>	
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2>Feedback Management</h2>
                                <ul class="data-header-actions">
									<li style="margin-right:5px;">
										<!--<a class="btn btn-alt btn-inverse" href="./?p=sitecms_form">Add New</a>-->
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
			
                                            <th>SN</th>
												<th><?php echo 'Name';?></th>
                                                <th><?php echo 'Email';?></th>
                                                <th><?php echo 'Subject';?></th>
                                                <th><?php echo 'Message Type'; ?></th>
												
                                                <th><?php echo _ACTION;?></th>
											</tr>
										</thead>
										<tbody>
								<?php
								
								$objContent->lstFeedback();
								$sno=0;
								while($rows = $objContent->dbFetchArray(1)){
								$sno++;

                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $sno;?></td>
                                    <td>
                                    <a href="./?p=feedback_mgmt&mode=view&feedback_id=<?php echo EncData($rows['feedback_id']);?>" 
                                    title="<?php echo $rows['fdb_name'];?>"><?php echo $rows['fdb_name'];?></a>
                                    </td>
                                    <td><?php echo $rows['fdb_email'];?></td>
                                    <td><?php echo $rows['fdb_subject'];?></td>
                                    <td><?php  if($rows['fdb_message_type']==1){echo 'Comment';}
									elseif($rows['fdb_message_type']==2){echo 'Suggestion';}
									elseif($rows['fdb_message_type']==3){echo 'Complaint';}
									elseif($rows['fdb_message_type']==4){echo 'Request';}
									;?></td>
                                    
                                    
                                    <td>                                     
                                     <a href="./?p=feedback_mgmt&mode=delete&feedback_id=<?php echo EncData($rows['feedback_id']);?>" title="Delete" class="on-default remove-row"><img src="../images/icons/action_delete.gif" border="0" title="Delete" alt="Delete" /></a>
                                     
                                     
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
            <?php } else {
				
				$objRoute = new Route;
	if(isset($_GET['feedback_id']) && !empty($_GET['feedback_id']))
		$feedback_id = $_GET['feedback_id'];
	else if(isset($_POST['feedback_id']) && !empty($_POST['feedback_id']))
		$feedback_id = $_POST['feedback_id'];
	if(isset($feedback_id) && !empty($feedback_id)){
		$objContent->setProperty("feedback_id", DecData($feedback_id));
		$objContent->lstFeedback();
		$data = $objContent->dbFetchArray(1);
		extract($data);
	}
				?>
    <div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2><?php echo 'View Feedback';?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=feedback_mgmt">Back</a>
                                </li>
                                
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
									<div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Name :</label>
            <div class="controls">
            <?php echo $fdb_name; ?>            
            </div>
        </div>
       <div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Email :</label>
            <div class="controls">
            <?php echo $fdb_email; ?>            
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Subject :</label>
            <div class="controls">
            <?php echo $fdb_subject; ?>            
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Message Type :</label>
            <div class="controls">
           <?php  if($fdb_message_type==1){echo 'Comment';}
									elseif($fdb_message_type==2){echo 'Suggestion';}
									elseif($fdb_message_type==3){echo 'Complaint';}
									elseif($fdb_message_type==4){echo 'Request';}
									;?>            
            </div>
        </div>
         <div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Message :</label>
            <div class="controls">
            <?php echo $fdb_message_box; ?>            
            </div>
        </div>
         <div class="control-group">
            <label class="control-label" for="input" style="float: left;width: 130px;">Message Date :</label>
            <div class="controls">
            <?php echo $fdb_date; ?>            
            </div>
        </div>
								</div>
							</section>
						</div>
					</article>
					<!-- /Data block -->
				</div>				
			</div>
    <?php } ?>