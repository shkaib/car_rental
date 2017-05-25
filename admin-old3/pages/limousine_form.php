<?php
if(isset($_GET['lease_id']) && !empty($_GET['lease_id']))
		$lease_id = $_GET['lease_id'];
	else if(isset($_POST['lease_id']) && !empty($_POST['lease_id']))
		$lease_id = $_POST['lease_id'];
	if(isset($lease_id) && !empty($lease_id)){
		$objProduct->setProperty("lease_id", DecData($lease_id));
		$objProduct->lstCarLease();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
?>
<?php if($_GET['mode']!='view'){} elseif($_GET['mode']=='view'){ ?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2><?php echo $faq_title;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=limousine_mgmt">Back</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
									<table class="table table-striped table-bordered">
                                      <tr>
                                        <th>Full Name</th>
                                        <td><?php echo $full_name;?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Type</th>
                                        <td><?php echo LimousineType($lease_type);?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Email Address</th>
                                        <td><a href="mailto:<?php echo $email_address;?>"><?php echo $email_address;?></a></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Phone #</th>
                                        <td><?php echo $phone_number;?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Mobile #</th>
                                        <td><?php echo $mobile_number;?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Location</th>
                                        <td><?php echo $address;?></td>
                                      </tr>
                                      
                                      <tr>
                                        <th>Detail</th>
                                        <td><?php echo $lease_detail;?></td>
                                      </tr>
                                    </table>

								</div>
							</section>
						</div>
					</article>
					<!-- /Data block -->
				</div>				
			</div>
			<!-- /Right (content) side -->
<?php } ?>