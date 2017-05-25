<?php
$mode	= "I";
$objRoute = new Route;
$objResumeFile = new Content;
$objResumeTemplate = new Content;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$partner_name			= trim($_POST['partner_name']);
	$partner_detail			= trim($_POST['partner_detail']);	
	$partner_url			= trim($_POST['partner_url']);
	$member_email			= trim($_POST['member_email']);
	$is_active				= trim($_POST['is_active']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("partner_name", 'Name is a required field.', "S");
	
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$partner_id = ($_POST['mode'] == "U") ? DecData($_POST['partner_id']) : $objAdminUser->genCode("rs_tbl_partner", "partner_id");
		if(is_uploaded_file($_FILES['partner_logo']['tmp_name'])){
		$partner_logo_name = $objResumeFile->getImagename($_FILES['partner_logo']['type'], $partner_id);
		if(move_uploaded_file($_FILES['partner_logo']['tmp_name'], SITE_PATH .'profile_img/'. $partner_logo_name)){
			$objContent->setProperty("partner_logo", $partner_logo_name);
		}
		}
		
		
		$objContent->setProperty("partner_id", $partner_id);
		$objContent->setProperty("partner_name", $partner_name);
		$objContent->setProperty("partner_detail", $partner_detail);
		$objContent->setProperty("partner_url", $partner_url);
		$objContent->setProperty("is_active", $is_active);
		if($objContent->actPartner($_POST['mode'])){
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Partner content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Partner content successfully added.','Info');
			}
			redirect('./?p=partner_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['partner_id']) && !empty($_GET['partner_id']))
		$partner_id = $_GET['partner_id'];
	else if(isset($_POST['partner_id']) && !empty($_POST['partner_id']))
		$partner_id = $_POST['partner_id'];
	if(isset($partner_id) && !empty($partner_id)){
		$objContent->setProperty("partner_id", DecData($partner_id));
		$objContent->lstPartner();
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
                                        <?php if($vResult['partner_name']){ echo $vResult["partner_name"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" enctype="multipart/form-data" onSubmit="return frmValidate(this);">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="partner_id" id="partner_id" value="<?php echo EncData($partner_id);?>" />
<fieldset>
<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_TITLE;?> *</label>
    <div class="controls">
	<input id="partner_name" name="partner_name" value="<?php echo $partner_name;?>" class="input-xlarge" type="text" tabindex="3">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_DETAIL;?> :</label>
    <div class="controls">
    <textarea id="partner_detail" name="partner_detail" class="input-xlarge" rows="3" tabindex="15"><?php echo htmlentities(stripslashes($partner_detail));?></textarea>
    </div>
</div> 

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'URL';?> *</label>
    <div class="controls">
	<input id="partner_url" name="partner_url" value="<?php echo $partner_url;?>" class="input-xlarge" type="text" tabindex="5">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Image';?> *</label>
    <div class="controls">
	<input id="partner_logo" name="partner_logo" value="" class="input-xlarge" type="file" tabindex="3">
    </div>
    <span style="font-size:11px;">Image size (263 X 287). Please upload only (.JPG & .PNG) file formate.</span>
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
								<h2><?php echo $partner_name;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=partner_mgmt">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=partner_form&mode=edit&partner_id=<?php echo $_GET['partner_id'];?>">Edit</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
									<?php echo $partner_detail;?>
								</div>
                                <div class="tab-pane active" id="static">
								<?php if($partner_logo!=''){
                                echo '<img src="'.SITE_URL .'profile_img/'.$partner_logo.'" />';
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