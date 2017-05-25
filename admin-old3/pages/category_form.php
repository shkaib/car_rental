<?php
$mode	= "I";
$objRoute = new Route;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 					= true;
	$category_name 			= trim($_POST['category_name']);
	$parent_id				= trim($_POST['parent_id']);
	$cms_date				= date('Y-m-d');
	$category_status		= trim($_POST['category_status']);
	$cat_lang				= trim($_POST["cat_lang"]);
	$url_key 				= $objRoute->getCategoryKey($_POST['category_name'], $_POST['category_id']);

	$objValidate->setArray($_POST);
	$objValidate->setCheckField("category_name", 'Title is a required field.', "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$category_id = ($_POST['mode'] == "U") ? DecData($_POST['category_id']) : $objAdminUser->genCode("rs_tbl_category", "category_id");
		$objProduct->setProperty("category_id", $category_id);
		$objProduct->setProperty("category_name", $category_name);
		//$objProduct->setProperty("parent_id", $parent_id);
		$objProduct->setProperty("url_key", $url_key);
		$objProduct->setProperty("category_status", $category_status);
		//$objProduct->setProperty("cat_lang", $cat_lang);
		//$objProduct->setProperty("admin_id", $objAdminUser->admin_id);
		
		if($objProduct->actCategory($_POST['mode'])){
			if($_POST['mode'] == "U"){
				$objCommon->setMessage('Category Content successfully updated.','Info');
			}
			else{
				$objCommon->setMessage('Category Content successfully added.','Info');
			}
			redirect('./?p=category_mgmt');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['category_id']) && !empty($_GET['category_id']))
		$category_id = $_GET['category_id'];
	else if(isset($_POST['category_id']) && !empty($_POST['category_id']))
		$category_id = $_POST['category_id'];
	if(isset($category_id) && !empty($category_id)){
		$objProduct->setProperty("category_id", DecData($category_id));
		$objProduct->lstCategory();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
}
?>
<div class="content-block" role="main">
  <div class="row"> 
    <article class="span6 data-block">
      <div class="data-container">
        <header>
          <h2>
            <?php if($mode=='I'){ echo 'Add New'; } else { echo 'Edit '. $category_name;}?>
          </h2>
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
                      <div class="span8"> <span style="color:#900;">
                        <?php if($vResult['category_name']){ echo $vResult["category_name"].'<br>';} ?>
                        <?php if($vResult['cms_heading']){ echo $vResult["cms_heading"].'<br>';} ?>
                        </span>
                        <form name="frmContent" id="frmContent" action="" method="post" onSubmit="return frmValidate(this);">
                          <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
                          <input type="hidden" name="category_id" id="category_id" value="<?php echo EncData($category_id);?>" />
                          <input type="hidden" name="cms_type_id" id="cms_type_id" value="1" />
                          <fieldset>
                            
                            <div class="control-group">
                              <label class="control-label" for="input"><?php echo CMS_FLD_TITLE;?> *</label>
                              <div class="controls">
                                <input id="category_name" name="category_name" value="<?php echo $category_name;?>" class="input-xlarge" type="text" tabindex="3">
                              </div>
                            </div>
                            
                            <div class="control-group">
                              <label class="control-label" for="input"><?php echo 'Status';?> *</label>
                              <div class="controls">
                                <select name="category_status" id="category_status">
                                  <option value="1"<?php if($category_status==1){ echo ' selected="selected"'; } else { echo ''; }?>>Active</option>
                                  <option value="2"<?php if($category_status==2){ echo ' selected="selected"'; } else { echo ''; }?>>InActive</option>
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
