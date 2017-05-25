<?php
$mode	= "I";
$objRoute = new Route;
$objResumeFile = new Content;
$objResumeTemplate = new Content;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$project_name			= trim($_POST['project_name']);
	$project_description	= trim($_POST['project_description']);
	$client_name			= trim($_POST['client_name']);
	$project_tags			= trim($_POST['project_tags']);
	$is_active				= trim($_POST['is_active']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("project_name", 'Name is a required field.', "S");
	
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$portfolio_id = ($_POST['mode'] == "U") ? DecData($_POST['portfolio_id']) : $objAdminUser->genCode("rs_tbl_project", "portfolio_id");
		
		if(is_uploaded_file($_FILES['project_file_1']['tmp_name'])){
		$project_file_1_name = $objResumeFile->getImagename($_FILES['project_file_1']['type'], $portfolio_id);
		if(move_uploaded_file($_FILES['project_file_1']['tmp_name'], SITE_PATH .'project_img/'. $project_file_1_name)){
			$objContent->setProperty("project_file_1", $project_file_1_name);
		}
		}
		
		if(is_uploaded_file($_FILES['project_file_2']['tmp_name'])){
		$project_file_2_name = $objResumeFile->getImagename($_FILES['project_file_2']['type'], $portfolio_id);
		if(move_uploaded_file($_FILES['project_file_2']['tmp_name'], SITE_PATH .'project_img/'. $project_file_2_name)){
			$objContent->setProperty("project_file_2", $project_file_2_name);
		}
		}
		
		
		$objContent->setProperty("portfolio_id", $portfolio_id);
		$objContent->setProperty("project_name", $project_name);
		$objContent->setProperty("project_description", $project_description);
		$objContent->setProperty("client_name", $client_name);
		$objContent->setProperty("project_tags", $project_tags);
		$objContent->setProperty("is_active", $is_active);
		if($objContent->actPortfolio($_POST['mode'])){
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Project Content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Project Content successfully added.','Info');
			}
			redirect('./?p=portfolio_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['portfolio_id']) && !empty($_GET['portfolio_id']))
		$portfolio_id = $_GET['portfolio_id'];
	else if(isset($_POST['portfolio_id']) && !empty($_POST['portfolio_id']))
		$portfolio_id = $_POST['portfolio_id'];
	if(isset($portfolio_id) && !empty($portfolio_id)){
		$objContent->setProperty("portfolio_id", DecData($portfolio_id));
		$objContent->lstProject();
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
								<h2><?php if($mode=='I'){ echo 'Add New'; } else { echo 'Edit '. $cms_title;}?></h2>
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
                                        <?php if($vResult['project_name']){ echo $vResult["project_name"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" enctype="multipart/form-data" onSubmit="return frmValidate(this);">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="portfolio_id" id="portfolio_id" value="<?php echo EncData($portfolio_id);?>" />
<fieldset>
<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_TITLE;?> *</label>
    <div class="controls">
	<input id="project_name" name="project_name" value="<?php echo $project_name;?>" class="input-xlarge" type="text" tabindex="3">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_DETAIL;?> :</label>
    <div class="controls">
    <textarea id="project_description" name="project_description" class="input-xlarge" rows="3" tabindex="15"><?php echo htmlentities(stripslashes($project_description));?></textarea>
    </div>
</div> 

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Client Name';?></label>
    <div class="controls">
	<input id="client_name" name="client_name" value="<?php echo $client_name;?>" class="input-xlarge" type="text" tabindex="4">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Project Tags';?></label>
    <div class="controls">
	<input id="project_tags" name="project_tags" value="<?php echo $project_tags;?>" class="input-xlarge" type="text" tabindex="4">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Small Image';?> *</label>
    <div class="controls">
	<input id="project_file_1" name="project_file_1" value="" class="input-xlarge" type="file" tabindex="3">
    </div>
    <span style="font-size:11px;">Image size (350 X 280). Please upload only (.JPG & .PNG) file formate.</span>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Large Image';?> *</label>
    <div class="controls">
	<input id="project_file_2" name="project_file_2" value="" class="input-xlarge" type="file" tabindex="3">
    </div>
    <span style="font-size:11px;">Image size (970 X 496). Please upload only (.JPG & .PNG) file formate.</span>
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
    <button class="btn btn-alt btn-large btn-primary" name="save_value" id="save_value" type="submit" tabindex="16">Save</button>
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
			<div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2><?php echo $project_name;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=team_mgmt">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=guide_resume_form&mode=edit&portfolio_id=<?php echo $_GET['portfolio_id'];?>">Edit</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
									<?php echo $member_des;?>
								</div>
                                <div class="tab-pane active" id="static">
								<?php if($project_file_1!=''){
                                echo '<img src="'.GUIDE_RESUME_URL.$project_file_1.'" />';
                                } ?>
                                
								</div>
							</section>
						</div>
					</article>
					<!-- /Data block -->
				</div>				
			</div>
			<!-- /Right (content) side -->
<?php } ?>
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		

		//Mad File Manager
		
		relative_urls : false,
		file_browser_callback : MadFileBrowser
	});
	
	function MadFileBrowser(field_name, url, type, win) {
	  tinyMCE.activeEditor.windowManager.open({
	      file : "../mfm/mfm.php?field=" + field_name + "&url=" + url + "",
	      title : 'File Manager',
	      width : 750,
	      height : 450,
	      resizable : "no",
	      inline : "yes",
	      close_previous : "no"
	  }, {
	      window : win,
	      input : field_name
	  });
	  return false;
	}
</script>