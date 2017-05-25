<?php
$mode	= "I";
$objRoute = new Route;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$location_title 		= trim($_POST['location_title']);
	$location_price	 		= trim($_POST['location_price']);
	$cms_date				= date('Y-m-d');
	$is_active				= trim($_POST['is_active']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("location_title", 'Location Name is a required field.', "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$location_id = ($_POST['mode'] == "U") ? DecData($_POST['location_id']) : $objAdminUser->genCode("rs_tbl_location", "location_id");
		$objContent->setProperty("location_id", $location_id);
		$objContent->setProperty("location_title", $location_title);
		$objContent->setProperty("location_price", $location_price);
		$objContent->setProperty("is_active", $is_active);
		
		if($objContent->actLocation($_POST['mode'])){
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Location content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Location content successfully added.','Info');
			}
			redirect('./?p=location_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['location_id']) && !empty($_GET['location_id']))
		$location_id = $_GET['location_id'];
	else if(isset($_POST['location_id']) && !empty($_POST['location_id']))
		$location_id = $_POST['location_id'];
	if(isset($location_id) && !empty($location_id)){
		$objContent->setProperty("location_id", DecData($location_id));
		$objContent->lstLocation();
		$data = $objContent->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
}
?>
<?php if($_GET['mode']!='view'){?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
			
				<div class="row">
					
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2><?php if($mode=='I'){ echo 'Add New'; } else { echo 'Edit '. $location_title;}?></h2>
							</header>
							<section>
                            <!-- Grid row -->
				<div class="row">
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<section class="tab-content">
								<!-- Tab #basic -->
								<div class="tab-pane active" id="basic">
									<div class="row-fluid">
										<div class="span8">
                                        <span style="color:#900;">
                                        <?php if($vResult['location_title']){ echo $vResult["location_title"].'<br>';} ?>
                                        <?php if($vResult['cms_heading']){ echo $vResult["cms_heading"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" onSubmit="return frmValidate(this);">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="location_id" id="location_id" value="<?php echo EncData($location_id);?>" />

<fieldset>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_TITLE;?> *</label>
    <div class="controls">
	<input id="location_title" name="location_title" value="<?php echo $location_title;?>" class="input-xlarge" type="text" tabindex="3">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Price';?> *</label>
    <div class="controls">
	<input id="location_price" name="location_price" value="<?php echo $location_price;?>" class="input-xlarge" type="number" tabindex="4">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Status';?> *</label>
    <div class="controls">
        <select name="is_active" id="is_active">
		<option value="1"<?php if($is_active==1){ echo ' selected="selected"'; } else { echo ''; }?>>Active</option>
        <option value="2"<?php if($is_active==2){ echo ' selected="selected"'; } else { echo ''; }?>>InActive</option>
        </select>
    </div>
</div>    
<div class="form-actions">
    <button class="btn btn-alt btn-large btn-primary" name="save_value" id="save_value" type="submit" tabindex="5">Save</button>
</div>
</fieldset>
</form>
</div>
                            </div>
                        </div>
                        <!-- /Tab #basic -->
                    </section>
                </div>
            </article>
            <!-- /Data block -->
        </div>
        <!-- /Grid row -->                
                </section>
            </div>
        </article>
        <!-- /Data block -->
    </div>
</div>
<!-- /Right (content) side -->
<?php } elseif($_GET['mode']=='view'){ ?>
<!-- Right (content) side -->
			
			<!-- /Right (content) side -->
<?php } ?>
<script language="javascript" type="text/javascript">
function frmValidate(frm){
	var msg = "<?php echo _JS_FORM_ERROR;?>\r-----------------------------------------";
	var flag = true;
	if(frm.location_title.value == ""){
		msg = msg + "\r<?php echo 'Title is a required field.';?>";
		flag = false;
	}
	if(frm.cms_heading.value == ""){
		msg = msg + "\r<?php echo 'Heading is a required field.';?>";
		flag = false;
	}
	
	if(flag == false){
		alert(msg);
		return false;
	}
}
</script>