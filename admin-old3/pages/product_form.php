<?php
$mode	= "I";
$objRoute = new Route;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$product_name 			= trim($_POST['product_name']);
	$product_description	= trim($_POST['product_description']);
	$product_price			= trim($_POST['product_price']);
	$product_type			= trim($_POST['product_type']);
	$model_number			= trim($_POST['model_number']);
	$number_of_seats		= trim($_POST['number_of_seats']);
	$number_of_luggage		= trim($_POST['number_of_luggage']);
	$number_of_doors		= trim($_POST['number_of_doors']);
	$category_id			= trim($_POST['category_id']);
	
	$l_engine				= trim($_POST['l_engine']);
	$ac_option				= trim($_POST['ac_option']);
	$gar_type				= trim($_POST['gar_type']);
	$set_special_offer		= trim($_POST['set_special_offer']);
	$other_f_1				= trim($_POST['other_f_1']);
	$other_f_2				= trim($_POST['other_f_2']);
	$other_f_3				= trim($_POST['other_f_3']);
	$other_f_4				= trim($_POST['other_f_4']);
	$other_f_5				= trim($_POST['other_f_5']);
	$other_f_6				= trim($_POST['other_f_6']);
	$other_f_7				= trim($_POST['other_f_7']);
	$other_f_8				= trim($_POST['other_f_8']);
	$other_f_9				= trim($_POST['other_f_9']);
	$is_active				= trim($_POST['is_active']);
	
	$price_weekly			= trim($_POST['price_weekly']);
	$price_monthly			= trim($_POST['price_monthly']);
	
	$submit_date			= date('Y-m-d H:i:s');
	$is_active				= trim($_POST['is_active']);
	
	$url_key 		= $objRoute->getProductKey($_POST['product_name'], DecData($_POST['product_id']));
	
	list($SubCategory, $MainCategory)=explode('-', $category_id);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("product_name", 'Name is a required field.', "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$product_id = ($_POST['mode'] == "U") ? DecData($_POST['product_id']) : $objAdminUser->genCode("rs_tbl_products", "product_id");
		$objProduct->setProperty("product_id", $product_id);
		$objProduct->setProperty("category_id", $category_id);
		$objProduct->setProperty("product_name", $product_name);
		$objProduct->setProperty("product_description", $product_description);
		$objProduct->setProperty("product_price", $product_price);
		$objProduct->setProperty("product_type", $product_type);
		$objProduct->setProperty("model_number", $model_number);
		$objProduct->setProperty("number_of_seats", $number_of_seats);
		$objProduct->setProperty("number_of_luggage", $number_of_luggage);
		$objProduct->setProperty("number_of_doors", $number_of_doors);
		$objProduct->setProperty("l_engine", $l_engine);
		$objProduct->setProperty("ac_option", $ac_option);
		$objProduct->setProperty("gar_type", $gar_type);
		$objProduct->setProperty("set_special_offer", $set_special_offer);
		$objProduct->setProperty("other_f_1", $other_f_1);
		$objProduct->setProperty("other_f_2", $other_f_2);
		$objProduct->setProperty("other_f_3", $other_f_3);
		$objProduct->setProperty("other_f_4", $other_f_4);
		$objProduct->setProperty("other_f_5", $other_f_5);
		$objProduct->setProperty("other_f_6", $other_f_6);
		$objProduct->setProperty("other_f_7", $other_f_7);
		$objProduct->setProperty("other_f_8", $other_f_8);
		$objProduct->setProperty("other_f_9", $other_f_9);
		$objProduct->setProperty("is_active", $is_active);
		$objProduct->setProperty("url_key", $url_key);
		
		$objProduct->setProperty("price_weekly", $price_weekly);
		$objProduct->setProperty("price_monthly", $price_monthly);
		
		$objProduct->setProperty("submit_date", $submit_date);
		
		if($objProduct->actProduct($_POST['mode'])){
			
			if(is_uploaded_file($_FILES['product_image']['tmp_name'])){
			$product_image_name = $objProduct->getImagename($_FILES['product_image']['type'], $portfolio_id);
			if(move_uploaded_file($_FILES['product_image']['tmp_name'], SITE_PATH .'product_image/orig/'. $product_image_name)){
					
					$objProductImg = new Product;
					$objProductImg->setProperty("product_id", $product_id);
					$objProductImg->setProperty("product_image", $product_image_name);
					$objProductImg->actProduct('U');
			
			}
			}
			
			
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Car content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Car content successfully added.','Info');
			}
			redirect('./?p=product_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['product_id']) && !empty($_GET['product_id']))
		$product_id = $_GET['product_id'];
	else if(isset($_POST['product_id']) && !empty($_POST['product_id']))
		$product_id = $_POST['product_id'];
	if(isset($product_id) && !empty($product_id)){
		$objProduct->setProperty("product_id", DecData($product_id));
		$objProduct->lstProducts();
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
                                        <?php if($vResult['product_name']){ echo $vResult["product_name"].'<br>';} ?>
                                        </span>

<form name="frmContent" id="frmContent" action="" method="post" onSubmit="return frmValidate(this);" enctype="multipart/form-data">
<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
<input type="hidden" name="product_id" id="product_id" value="<?php echo EncData($product_id);?>" />
<fieldset>
		
         <div class="control-group">
                              <label class="control-label" for="input"><?php echo 'Rent Type:';?></label>
                              <div class="controls">
                                <select name="product_type" id="product_type" tabindex="1">
                                  <option value="1"<?php if($product_type==1){ echo ' selected="selected"'; } else { echo ''; }?>>Daily</option>
                                  <option value="2"<?php if($product_type==2){ echo ' selected="selected"'; } else { echo ''; }?>>Monthly</option>
                                </select>
                              </div>
                            </div>
                            

            <div class="control-group">
            <label class="control-label" for="input"><?php echo 'Car Category:';?></label>
            <div class="controls">
            <select name="category_id" id="category_id" class="rr_select" style="width:200px;">
            <?php
            #echo $objProduct->mainCatCombo($category_id);
            $objProductM = new Product;
            $Sql = "SELECT 
            a.category_id,
            a.category_name
            FROM
            rs_tbl_category a
            WHERE 
            1=1 
            AND parent_id=0 
            ORDER BY 
            a.category_name ASC";
            $objProductM->dbQuery($Sql);
            if($objProductM->totalRecords() >= 1){
            while($rows = $objProductM->dbFetchArray(1)){
            $sele = ($category_id == $rows['category_id']) ? " selected" : "";
            echo "<option value=\"" . $rows['category_id'] . "\" " . $sele . ">" . $rows['category_name'] . "</option>\n";
            }
            }
            ?>
            </select>
            
            </div>
            </div>



<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Name';?> *</label>
    <div class="controls">
	<input id="product_name" name="product_name" value="<?php echo $product_name;?>" class="input-xlarge" type="text" tabindex="2">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo CMS_FLD_DETAIL;?> :</label>
    <div class="controls">
    <textarea id="product_description" name="product_description" class="input-xlarge" rows="3" tabindex="3"><?php echo htmlentities(stripslashes($product_description));?></textarea>
    </div>
</div> 

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Rent (Per Day)';?> </label>
    <div class="controls">
	<input id="product_price" name="product_price" value="<?php echo $product_price;?>" class="input-xlarge" type="number" tabindex="4">
    </div>
    <span>Rent amount only in number format.</span>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Rent (Per Week)';?> </label>
    <div class="controls">
	<input id="price_weekly" name="price_weekly" value="<?php echo $price_weekly;?>" class="input-xlarge" type="number" tabindex="5">
    </div>
    <span>Rent amount only in number format.</span>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Rent (Monthly Bases)';?> </label>
    <div class="controls">
	<input id="price_monthly" name="price_monthly" value="<?php echo $price_monthly;?>" class="input-xlarge" type="number" tabindex="6">
    </div>
    <span>Rent amount only in number format.</span>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Model Number';?> </label>
    <div class="controls">
	<input id="model_number" name="model_number" value="<?php echo $model_number;?>" class="input-xlarge" type="text" tabindex="7">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Number of Seats';?> </label>
    <div class="controls">
	<input id="number_of_seats" name="number_of_seats" value="<?php echo $number_of_seats;?>" class="input-xlarge" type="text" tabindex="8">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Number of Luggage';?> </label>
    <div class="controls">
	<input id="number_of_luggage" name="number_of_luggage" value="<?php echo $number_of_luggage;?>" class="input-xlarge" type="text" tabindex="9">
    </div>
</div>






<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Number of Doors';?> </label>
    <div class="controls">
	<input id="number_of_doors" name="number_of_doors" value="<?php echo $number_of_doors;?>" class="input-xlarge" type="text" tabindex="10">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="input"><?php echo 'L Engine';?> </label>
    <div class="controls">
	<input id="l_engine" name="l_engine" value="<?php echo $l_engine;?>" class="input-xlarge" type="text" tabindex="11">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'AC Option';?> *</label>
    <div class="controls">
        <select name="ac_option" id="ac_option" tabindex="12">
		<option value="1"<?php if($ac_option==1){ echo ' selected="selected"'; } else { echo ''; }?>>Yes</option>
        <option value="2"<?php if($ac_option==2){ echo ' selected="selected"'; } else { echo ''; }?>>No</option>
        </select>
    </div>
</div> 
<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Gear Type';?> *</label>
    <div class="controls">
        <select name="gar_type" id="gar_type" tabindex="13">
		<option value="1"<?php if($gar_type==1){ echo ' selected="selected"'; } else { echo ''; }?>>Auto</option>
        <option value="2"<?php if($gar_type==2){ echo ' selected="selected"'; } else { echo ''; }?>>Manual</option>
        </select>
    </div>
</div> 


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 1';?> </label>
    <div class="controls">
	<input id="other_f_1" name="other_f_1" value="<?php echo $other_f_1;?>" class="input-xlarge" type="text" tabindex="14">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 2';?> </label>
    <div class="controls">
	<input id="other_f_2" name="other_f_2" value="<?php echo $other_f_2;?>" class="input-xlarge" type="text" tabindex="15">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 3';?> </label>
    <div class="controls">
	<input id="other_f_3" name="other_f_3" value="<?php echo $other_f_3;?>" class="input-xlarge" type="text" tabindex="16">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 4';?> </label>
    <div class="controls">
	<input id="other_f_4" name="other_f_4" value="<?php echo $other_f_4;?>" class="input-xlarge" type="text" tabindex="17">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 5';?> </label>
    <div class="controls">
	<input id="other_f_5" name="other_f_5" value="<?php echo $other_f_5;?>" class="input-xlarge" type="text" tabindex="18">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 6';?> </label>
    <div class="controls">
	<input id="other_f_6" name="other_f_6" value="<?php echo $other_f_6;?>" class="input-xlarge" type="text" tabindex="19">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 7';?> </label>
    <div class="controls">
	<input id="other_f_7" name="other_f_7" value="<?php echo $other_f_7;?>" class="input-xlarge" type="text" tabindex="20">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 8';?> </label>
    <div class="controls">
	<input id="other_f_8" name="other_f_8" value="<?php echo $other_f_8;?>" class="input-xlarge" type="text" tabindex="21">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Other Feature - 9';?> </label>
    <div class="controls">
	<input id="other_f_9" name="other_f_9" value="<?php echo $other_f_9;?>" class="input-xlarge" type="text" tabindex="22">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Special Offer';?> *</label>
    <div class="controls">
        <select name="set_special_offer" id="set_special_offer" tabindex="23">
		<option value="1"<?php if($set_special_offer==1){ echo ' selected="selected"'; } else { echo ''; }?>>Yes</option>
        <option value="2"<?php if($set_special_offer==2){ echo ' selected="selected"'; } else { echo ''; }?>>No</option>
        </select>
    </div>
</div> 




<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Product Image';?> *</label>
    <div class="controls">
	<input id="product_image" name="product_image" value="" class="input-xlarge" type="file" tabindex="24">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="input"><?php echo 'Status';?> *</label>
    <div class="controls">
        <select name="is_active" id="is_active" tabindex="25">
		<option value="1"<?php if($is_active==1){ echo ' selected="selected"'; } else { echo ''; }?>>Active</option>
        <option value="2"<?php if($is_active==2){ echo ' selected="selected"'; } else { echo ''; }?>>InActive</option>
        </select>
    </div>
</div>    
<div class="form-actions">
    <button class="btn btn-alt btn-large btn-primary" name="save_value" id="save_value" type="submit" tabindex="26">Save</button>
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
<?php } elseif($_GET['mode']=='view'){ 
$objCategory = new Product;
$objCategory->setProperty("category_id", $rows["category_id"]);
$objCategory->lstCategory();
$category = $objCategory->dbFetchArray(1);

$objGallery = new Product;
$objGallery->setProperty("product_id", $product_id);
$objGallery->lstProductGallery();
$Gallery = $objGallery->dbFetchArray(1);
?>
<!-- Right (content) side -->
			<div class="content-block" role="main">
				<div class="row">
					<!-- Data block -->
					<article class="span6 data-block">
						<div class="data-container">
							<header>
								<h2><?php echo $product_name;?></h2>
                            <ul class="data-header-actions">
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=product_mgmt">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-alt btn-inverse" href="./?p=product_form&mode=edit&product_id=<?php echo $_GET['product_id'];?>">Edit</a>
                                </li>
                            </ul>
							</header>
							<section>
                                <div class="tab-pane active" id="static">
                                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                	<tr>
                                    <th>Language</tH>
                                    <td><?php echo $pro_lang;?></td>
                                  </tr>
                                  <tr>
                                    <th>Category</tH>
                                    <td><?php echo $category["category_name"];?></td>
                                  </tr>
                                  <!--<tr>
                                    <th>Sub-Category</tH>
                                    <td><?php echo $category["category_name"];?></td>
                                  </tr>-->
                                  <tr>
                                    <th>Description</tH>
                                    <td><?php echo $product_description;?></td>
                                  </tr>
                                  <tr>
                                    <th>Unit</tH>
                                    <td><?php echo $unit_type;?></td>
                                  </tr>
                                  <tr>
                                    <th>Weight-1</tH>
                                    <td><?php echo $weight_1;?></td>
                                  </tr>
                                  <tr>
                                    <th>Weight-2</tH>
                                    <td><?php echo $weight_2;?></td>
                                  </tr>
                                  <tr>
                                    <th>Weight-3</tH>
                                    <td><?php echo $weight_3;?></td>
                                  </tr>
                                  <tr>
                                    <th>Packaging Detail</tH>
                                    <td><?php echo $packaging_details;?></td>
                                  </tr>
                                  <tr>
                                    <th>Image</tH>
                                    <td><?php if($Gallery["file_name"]!=''){?><img src="<?php echo SITE_URL .'product_image/orig/' . $Gallery["file_name"];?>" width="300" /><?php } ?></td>
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