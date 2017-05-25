<?php
$mode	= "I";
$objRoute = new Route;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$cms_title 				= trim($_POST['cms_title']);
	$cms_detail	 			= trim($_POST['cms_details']);
	$parent_id				= trim($_POST['parent_id']);
	$cms_type_id			= trim($_POST['cms_type_id']);
	$cms_date				= date('Y-m-d');
	$is_active				= trim($_POST['is_active']);
	if($_POST['mode'] == "I"){
	$url_key 		= $objRoute->getContentKey($_POST['cms_title'], $_POST['cms_id']);
	}
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("cms_title", 'Title is a required field.', "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$cms_id = ($_POST['mode'] == "U") ? DecData($_POST['cms_id']) : $objAdminUser->genCode("rs_tbl_content", "cms_id");
		$objContent->setProperty("cms_id", $cms_id);
		$objContent->setProperty("cms_title", $cms_title);
		$objContent->setProperty("cms_detail", $cms_detail);
		$objContent->setProperty("parent_id", $parent_id);
		$objContent->setProperty("cms_type_id", $cms_type_id);
		$objContent->setProperty("cms_file", $cms_file);
		$objContent->setProperty("is_active", $is_active);
		$objContent->setProperty("url_key", $url_key);
		
		if($objContent->actContent($_POST['mode'])){
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('CMS successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('CMS successfully added.','Info');
			}
			redirect('./?p=sitecms_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['cms_id']) && !empty($_GET['cms_id']))
		$cms_id = $_GET['cms_id'];
	else if(isset($_POST['cms_id']) && !empty($_POST['cms_id']))
		$cms_id = $_POST['cms_id'];
	if(isset($cms_id) && !empty($cms_id)){
		$objContent->setProperty("cms_id", DecData($cms_id));
		$objContent->lstContent();
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
                                        <?php if($vResult['cms_title']){ echo $vResult["cms_title"].'<br>';} ?>
                                        <?php if($vResult['cms_heading']){ echo $vResult["cms_heading"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" onSubmit="return frmValidate(this);">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="cms_id" id="cms_id" value="<?php echo EncData($cms_id);?>" />
<input type="hidden" name="cms_type_id" id="cms_type_id" value="1" />

<fieldset>

        <div class="control-group">
            <label class="control-label" for="input"><?php echo 'Main CMS';?></label>
            <div class="controls">
            <select name="parent_id" id="parent_id">
            <option value="0">Select Main CMS</option>
            <?php echo $objContent->CMSCombo($parent_id, $cms_id);?>
            </select>            
            </div>
        </div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_TITLE;?> *</label>
    <div class="controls">
	<input id="cms_title" name="cms_title" value="<?php echo $cms_title;?>" class="input-xlarge" type="text" tabindex="3">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_DETAIL;?> :</label>
    <div class="controls">
    <textarea id="cms_details" name="cms_details" class="input-xlarge" rows="3" tabindex="15"><?php echo htmlentities(stripslashes($cms_detail));?></textarea>
    <script type="text/javascript">
		//<![CDATA[
		//	CKEDITOR.replace( 'cms_details',{toolbar : toolBarSet});
		//]]>
	</script>
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
								<h2><?php echo $cms_title;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=sitecms_mgmt">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=sitecms_form&mode=edit&cms_id=<?php echo $_GET['cms_id'];?>">Edit</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
									<?php echo $cms_detail;?>
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
<script language="javascript" type="text/javascript">
function frmValidate(frm){
	var msg = "<?php echo _JS_FORM_ERROR;?>\r-----------------------------------------";
	var flag = true;
	if(frm.cms_title.value == ""){
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