<?php
$mode	= "I";
$objRoute = new Route;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$feature_name 			= trim($_POST['feature_name']);
	$feature_detail			= trim($_POST['feature_detail']);
	$feature_price			= trim($_POST['feature_price']);
	$is_active				= trim($_POST['is_active']);
	
	$submit_date			= date('Y-m-d H:i:s');
	$is_active				= trim($_POST['is_active']);
	
	list($SubCategory, $MainCategory)=explode('-', $category_id);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("feature_name", 'Name is a required field.', "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$extra_feature_id = ($_POST['mode'] == "U") ? DecData($_POST['extra_feature_id']) : $objAdminUser->genCode("rs_tbl_extra_features", "extra_feature_id");
		$objProduct->setProperty("extra_feature_id", $extra_feature_id);
		$objProduct->setProperty("feature_name", $feature_name);
		$objProduct->setProperty("feature_detail", $feature_detail);
		$objProduct->setProperty("feature_price", $feature_price);
		$objProduct->setProperty("is_active", $is_active);
		
		if($objProduct->actExtraFeature($_POST['mode'])){
			
			if(is_uploaded_file($_FILES['feature_icon']['tmp_name'])){
			$feature_icon_name = $objProduct->getImagename($_FILES['feature_icon']['type'], $portfolio_id);
			if(move_uploaded_file($_FILES['feature_icon']['tmp_name'], SITE_PATH .'product_image/orig/'. $feature_icon_name)){
					
					$objProductImg = new Product;
					$objProductImg->setProperty("extra_feature_id", $extra_feature_id);
					$objProductImg->setProperty("feature_icon", $feature_icon_name);
					$objProductImg->actExtraFeature('U');
			
			}
			}
			
			
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Extra Feature content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Extra Feature content successfully added.','Info');
			}
			redirect('./?p=ext_f_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['extra_feature_id']) && !empty($_GET['extra_feature_id']))
		$extra_feature_id = $_GET['extra_feature_id'];
	else if(isset($_POST['extra_feature_id']) && !empty($_POST['extra_feature_id']))
		$extra_feature_id = $_POST['extra_feature_id'];
	if(isset($extra_feature_id) && !empty($extra_feature_id)){
		$objProduct->setProperty("extra_feature_id", DecData($extra_feature_id));
		$objProduct->lstExtraFeature();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
}
?>
<?php if($_GET['mode']!='view'){ ?>
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
                                        <?php if($vResult['feature_name']){ echo $vResult["feature_name"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" onSubmit="return frmValidate(this);" enctype="multipart/form-data">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="extra_feature_id" id="extra_feature_id" value="<?php echo EncData($extra_feature_id);?>" />
<fieldset>
		
<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Name';?> *</label>
    <div class="controls">
	<input id="feature_name" name="feature_name" value="<?php echo $feature_name;?>" class="input-xlarge" type="text" tabindex="1">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_DETAIL;?> :</label>
    <div class="controls">
    <textarea id="feature_detail" name="feature_detail" class="input-xlarge" rows="3" tabindex="2"><?php echo htmlentities(stripslashes($feature_detail));?></textarea>
    </div>
</div> 

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Price';?> </label>
    <div class="controls">
	<input id="feature_price" name="feature_price" value="<?php echo $feature_price;?>" class="input-xlarge" type="number" tabindex="3">
    </div>
    <span>Amount only in number format.</span>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Icon';?> *</label>
    <div class="controls">
	<input id="feature_icon" name="feature_icon" value="" class="input-xlarge" type="file" tabindex="4">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Status';?> *</label>
    <div class="controls">
        <select name="is_active" id="is_active" tabindex="5">
		<option value="1"<?php if($is_active==1){ echo ' selected="selected"'; } else { echo ''; }?>>Active</option>
        <option value="2"<?php if($is_active==2){ echo ' selected="selected"'; } else { echo ''; }?>>InActive</option>
        </select>
    </div>
</div>    
<div class="form-actions">
    <button class="btn btn-alt btn-large btn-primary" name="save_value" id="save_value" type="submit" tabindex="6">Save</button>
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
								<h2><?php echo $feature_name;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=ext_f_mgmt">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=ext_f_form&mode=edit&extra_feature_id=<?php echo $_GET['extra_feature_id'];?>">Edit</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
                                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                	<tr>
                                    <th>Price</tH>
                                    <td><?php echo $feature_price;?></td>
                                  </tr>
                                  <tr>
                                    <th>Description</tH>
                                    <td><?php echo $feature_detail;?></td>
                                  </tr>
                                  <tr>
                                    <th>Image</tH>
                                    <td><?php if($feature_icon!=''){?><img src="<?php echo SITE_URL .'product_image/orig/' . $feature_icon;?>" style="max-width:300px;" /><?php } ?></td>
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