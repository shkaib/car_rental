<?php
class Product extends Database{

	private $_totalSql;

	public function __construct(){

		parent::__construct();

	}
	
	/**
	* Product::printPrice()
	* This function is used to print the price
	* @author Numan Tahir
	* @Date 16 July, 2012
 	* @param float $peice	
	* @modified 16 July, 2012 by Numan Tahir
	* @return string
	*/
	public function printPrice($price, $flag = true){
		if($flag)
			return CURRENCY_SYMBOL . " " . number_format($price, 2, '.', '');
		else
			return number_format($price, 2, '.', '');
	}
	
	/**
	* This method is used to get image extension
	* @author Numan Tahir
	* @Date : 30 Dec, 2007
	* @modified : 30 Dec, 2007 by Numan Tahir
	* @return : bool
	*/
	function getExtention($type){
		if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg")
			return "jpg";
		elseif($type == "image/png")
			return "png";
		elseif($type == "image/gif")
			return "gif";
	}
	
	/**
 	* Product::getImagename()	
	* This method is used to get image name
	* @author Numan Tahir
	* @Date : 30 Dec, 2007
	* @modified : 30 Dec, 2007 by Numan Tahir
	* @return : bool
	*/

	public function getImagename($type, $product_cd = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($product_cd != ''){
			$filename = $filename . '-' . $product_cd . "." . $this->getExtention($type);
		}
		else{
			$filename = $filename . "." . $this->getExtention($type);
		}
		return $filename;
	}
	
	public function getExtentionValidate($type){

		if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg" || $type=="image/png" || $type=="image/gif")
			
			return 1;
		
		else
			return 0;
	}
	
	/**
	* Product::getCurrency()
	* This function is used to get the currency symbole
	* @author Numan Tahir
	* @Date 16 July, 2012
 	* @param boolean $flag	
	* @modified 16 July, 2012 by Numan Tahir
	* @return string
	*/
	public function getCurrency($flag = false){
		if($flag){
			return CURRENCY_SYMBOL . " [" . SITE_CURRENCY . "]";
		}
		else{
			return CURRENCY_SYMBOL;
		}
	}
	
	/**
	* This method is used to populate the Category combo
	* @author Numan Tahir
	*/
	public function CategorySubCombo($sel){
		$opt = "";
		$Sql = "SELECT 
					a.category_id,
					a.parent_id,
					a.category_name,
					(SELECT category_name FROM rs_tbl_category WHERE category_id=a.parent_id) as parent_cat
				FROM
					rs_tbl_category as a
				WHERE
					1=1 
					AND a.parent_id!=0";
			
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['category_id'] == $sel)
				$opt .= "<option value=\"" . $rows['category_id'] .'-'. $rows['parent_id'] . "\" selected>" .$rows['category_name'] .' - ['.$rows['parent_cat'].']'. "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['category_id'] .'-'. $rows['parent_id'] . "\">" .$rows['category_name'] .' - ['.$rows['parent_cat'].']'. "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to populate the Category combo
	* @author Numan Tahir
	*/
	public function CategoryCombo($sel){
		$opt = "";
		$Sql = "SELECT 
					category_id,
					category_name
				FROM
					rs_tbl_category
				WHERE
					1=1 
					AND parent_id=0";
			
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['category_id'] == $sel)
				$opt .= "<option value=\"" . $rows['category_id'] . "\" selected>" . $rows['category_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['category_id'] . "\">" . $rows['category_name'] . "</option>\n";
		}
		return $opt;
	}
	
	// This function is used to list all categories	
	public function lstCategory(){

		$Sql = "SELECT 
					a.category_id,
					a.parent_id,
					a.category_name,
					a.category_status, 
					a.url_key,
					a.category_counter,
					a.category_image,
					(SELECT category_name FROM rs_tbl_category WHERE category_id=a.parent_id) as parent_cat,
					cat_lang,
					admin_id
				FROM
					rs_tbl_category a
				WHERE 
					1=1";

		if($this->isPropertySet("category_id", "V"))
			$Sql .= " AND a.category_id='" . $this->getProperty("category_id") . "'";

		if($this->isPropertySet("parent_id", "V"))
			$Sql .= " AND a.parent_id='" . $this->getProperty("parent_id") . "'";
		
		if($this->isPropertySet("parent_zero", "V"))
			$Sql .= " AND a.parent_id='0'";
		
		if($this->isPropertySet("category_name", "V"))
			$Sql .= " AND a.category_name='" . $this->getProperty("category_name") . "'";

		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND a.url_key='" . $this->getProperty("url_key") . "'";
		
		if($this->isPropertySet("cat_lang", "V"))
			$Sql .= " AND a.cat_lang='" . $this->getProperty("cat_lang") . "'";
		
		if($this->isPropertySet("admin_id", "V"))
			$Sql .= " AND a.admin_id='" . $this->getProperty("admin_id") . "'";
				
		if($this->isPropertySet("category_status", "V"))
			$Sql .= " AND a.category_status='" . $this->getProperty("category_status") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY ".$this->getProperty("ORDERBY");
	
		return $this->dbQuery($Sql);
	}
	
	// This function is listing all the products
	public function lstProducts(){

		$Sql = "SELECT 
					product_id,
					category_id,
					subcat_id,
					product_name,
					product_keyword,
					product_description,
					product_price,
					price_weekly,
					price_monthly,
					discount_price,
					product_type,
					product_image,
					model_number,
					number_of_seats,
					number_of_luggage,
					number_of_doors,
					l_engine,
					ac_option,
					gar_type,
					set_special_offer,
					other_f_1,
					other_f_2,
					other_f_3,
					other_f_4,
					other_f_5,
					other_f_6,
					other_f_7,
					other_f_8,
					other_f_9,
					is_active,
					url_key,
					submit_date
				FROM
					rs_tbl_products
				WHERE 
					1=1";

		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id='" . $this->getProperty("product_id") . "'";
		
		if($this->isPropertySet("product_id_not", "V"))
			$Sql .= " AND product_id!='" . $this->getProperty("product_id_not") . "'";
			
		if($this->isPropertySet("search", "V"))
			$Sql .= " AND product_name LIKE '%" . $this->getProperty("search") . "%'";
		
		if($this->isPropertySet("product_type", "V"))
			$Sql .= " AND product_type='" . $this->getProperty("product_type") . "'";
			
		if($this->isPropertySet("category_id", "V"))
			$Sql .= " AND category_id='" . $this->getProperty("category_id") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
			
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";

		if($this->isPropertySet("is_active_not", "V"))
			$Sql .= " AND is_active!='" . $this->getProperty("is_active_not") . "'";

		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	// This function is listing all the Car Lease
	public function lstCarLease(){

		$Sql = "SELECT 
					lease_id,
					lease_type,
					full_name,
					email_address,
					phone_number,
					mobile_number,
					address,
					lease_detail,
					lease_ststus,
					lease_date,
					type_id
				FROM
					rs_tbl_car_lease
				WHERE 
					1=1";

		if($this->isPropertySet("lease_id", "V"))
			$Sql .= " AND lease_id='" . $this->getProperty("lease_id") . "'";
		
		if($this->isPropertySet("lease_id_not", "V"))
			$Sql .= " AND lease_id!='" . $this->getProperty("lease_id_not") . "'";
			
		if($this->isPropertySet("search", "V"))
			$Sql .= " AND full_name LIKE '%" . $this->getProperty("search") . "%'";
		
		if($this->isPropertySet("lease_type", "V"))
			$Sql .= " AND lease_type='" . $this->getProperty("lease_type") . "'";
			
		if($this->isPropertySet("lease_ststus", "V"))
			$Sql .= " AND lease_ststus='" . $this->getProperty("lease_ststus") . "'";
		
		if($this->isPropertySet("type_id", "V"))
			$Sql .= " AND type_id='" . $this->getProperty("type_id") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	// This function is listing all the product Extra Feature's
	public function lstExtraFeature(){

		$Sql = "SELECT 
					extra_feature_id,
					feature_name,
					feature_detail,
					feature_icon,
					feature_price,
					is_active
				FROM
					rs_tbl_extra_features
				WHERE 
					1=1";

		if($this->isPropertySet("extra_feature_id", "V"))
			$Sql .= " AND extra_feature_id='" . $this->getProperty("extra_feature_id") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("feature_price", "V"))
			$Sql .= " AND feature_price='" . $this->getProperty("feature_price") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
/*****************************************************************************************************/
/*****************************************************************************************************/
/*****************************************************************************************************/

	//This function is used to perform DML (Delete/Update/Add)
	// on the table category
	public function actCategory($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_category(
					category_id,
					parent_id,
					category_name,
					category_status, 
					url_key,
					category_counter,
					category_image,
					cat_lang,
					admin_id) 
					VALUES(";
					
				$Sql .= $this->isPropertySet("category_id", "V") ? $this->getProperty("category_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("parent_id", "V") ? $this->getProperty("parent_id") : 0;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_name", "V") ? "'" . $this->getProperty("category_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_status", "V") ? "'" . $this->getProperty("category_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_counter", "V") ? "'" . $this->getProperty("category_counter") . "'" : "'0'";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_image", "V") ? "'" . $this->getProperty("category_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cat_lang", "V") ? "'" . $this->getProperty("cat_lang") . "'" : "'EN'";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("admin_id", "V") ? "'" . $this->getProperty("admin_id") . "'" : "'EN'";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_category SET ";
				if($this->isPropertySet("category_name", "K")){
					$Sql .= "$cat category_name='" . $this->getProperty("category_name") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("url_key", "K")){
					$Sql .= "$cat url_key='" . $this->getProperty("url_key") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("parent_id", "K")){
					$Sql .= "$cat parent_id='" . $this->getProperty("parent_id") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("category_status", "K")){
					$Sql .= "$cat category_status='" . $this->getProperty("category_status") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("category_image", "K")){
					$Sql .= "$cat category_image='" . $this->getProperty("category_image") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("category_counter", "K")){
					$Sql .= "$cat category_counter='" . $this->getProperty("category_counter") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("admin_id", "K")){
					$Sql .= "$cat admin_id='" . $this->getProperty("admin_id") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("cat_lang", "K")){
					$Sql .= "$cat cat_lang='" . $this->getProperty("cat_lang") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				$Sql .= " AND category_id=" . $this->getProperty("category_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_category WHERE 1=1 ";
				$Sql .= " AND category_id=" . $this->getProperty("category_id");
				break;

			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of products  
	public function actProduct($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_products(
							product_id,
							category_id,
							subcat_id,
							product_name,
							product_keyword,
							product_description,
							product_price,
							price_weekly,
							price_monthly,
							discount_price,
							product_type,
							product_image,
							model_number,
							number_of_seats,
							number_of_luggage,
							number_of_doors,
							l_engine,
							ac_option,
							gar_type,
							set_special_offer,
							other_f_1,
							other_f_2,
							other_f_3,
							other_f_4,
							other_f_5,
							other_f_6,
							other_f_7,
							other_f_8,
							other_f_9,
							is_active,
							url_key,
							submit_date) 
							VALUES(";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_id", "V") ? $this->getProperty("category_id") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subcat_id", "V") ? "'" . $this->getProperty("subcat_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_name", "V") ? "'" . $this->getProperty("product_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_keyword", "V") ? "'" . $this->getProperty("product_keyword") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_description", "V") ? "'" . $this->getProperty("product_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price", "V") ? "'" . $this->getProperty("product_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("price_weekly", "V") ? "'" . $this->getProperty("price_weekly") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("price_monthly", "V") ? "'" . $this->getProperty("price_monthly") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_price", "V") ? "'" . $this->getProperty("discount_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_type", "V") ? "'" . $this->getProperty("product_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_image", "V") ? "'" . $this->getProperty("product_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("model_number", "V") ? "'" . $this->getProperty("model_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("number_of_seats", "V") ? "'" . $this->getProperty("number_of_seats") . "'" : "4";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("number_of_luggage", "V") ? "'" . $this->getProperty("number_of_luggage") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("number_of_doors", "V") ? "'" . $this->getProperty("number_of_doors") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("l_engine", "V") ? "'" . $this->getProperty("l_engine") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ac_option", "V") ? "'" . $this->getProperty("ac_option") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gar_type", "V") ? "'" . $this->getProperty("gar_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("set_special_offer", "V") ? "'" . $this->getProperty("set_special_offer") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_1", "V") ? "'" . $this->getProperty("other_f_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_2", "V") ? "'" . $this->getProperty("other_f_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_3", "V") ? "'" . $this->getProperty("other_f_3") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_4", "V") ? "'" . $this->getProperty("other_f_4") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_5", "V") ? "'" . $this->getProperty("other_f_5") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_6", "V") ? "'" . $this->getProperty("other_f_6") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_7", "V") ? "'" . $this->getProperty("other_f_7") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_8", "V") ? "'" . $this->getProperty("other_f_8") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_f_9", "V") ? "'" . $this->getProperty("other_f_9") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("submit_date", "V") ? "'" . $this->getProperty("submit_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_products SET ";
				if($this->isPropertySet("category_id", "K")){
					$Sql .= "$pro category_id='" . $this->getProperty("category_id") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("subcat_id", "K")){
					$Sql .= "$pro subcat_id='" . $this->getProperty("subcat_id") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_name", "K")){
					$Sql .= "$pro product_name='" . $this->getProperty("product_name") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_keyword", "K")){
					$Sql .= "$pro product_keyword='" . $this->getProperty("product_keyword") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_description", "K")){
					$Sql .= "$pro product_description='" . $this->getProperty("product_description") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_price", "K")){
					$Sql .= "$pro product_price='" . $this->getProperty("product_price") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("price_monthly", "K")){
					$Sql .= "$pro price_monthly='" . $this->getProperty("price_monthly") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("price_weekly", "K")){
					$Sql .= "$pro price_weekly='" . $this->getProperty("price_weekly") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("discount_price", "K")){
					$Sql .= "$pro discount_price='" . $this->getProperty("discount_price") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_type", "K")){
					$Sql .= "$pro product_type='" . $this->getProperty("product_type") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("product_image", "K")){
					$Sql .= "$pro product_image='" . $this->getProperty("product_image") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("model_number", "K")){
					$Sql .= "$pro model_number='" . $this->getProperty("model_number") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("number_of_seats", "K")){
					$Sql .= "$pro number_of_seats='" . $this->getProperty("number_of_seats") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("number_of_luggage", "K")){
					$Sql .= "$pro number_of_luggage='" . $this->getProperty("number_of_luggage") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("number_of_doors", "K")){
					$Sql .= "$pro number_of_doors='" . $this->getProperty("number_of_doors") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("l_engine", "K")){
					$Sql .= "$pro l_engine='" . $this->getProperty("l_engine") . "'";
					$pro = ",";
				}
				
				
				if($this->isPropertySet("ac_option", "K")){
					$Sql .= "$pro ac_option='" . $this->getProperty("ac_option") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("gar_type", "K")){
					$Sql .= "$pro gar_type='" . $this->getProperty("gar_type") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("set_special_offer", "K")){
					$Sql .= "$pro set_special_offer='" . $this->getProperty("set_special_offer") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_1", "K")){
					$Sql .= "$pro other_f_1='" . $this->getProperty("other_f_1") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_2", "K")){
					$Sql .= "$pro other_f_2='" . $this->getProperty("other_f_2") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_3", "K")){
					$Sql .= "$pro other_f_3='" . $this->getProperty("other_f_3") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_4", "K")){
					$Sql .= "$pro other_f_4='" . $this->getProperty("other_f_4") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_5", "K")){
					$Sql .= "$pro other_f_5='" . $this->getProperty("other_f_5") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_6", "K")){
					$Sql .= "$pro other_f_6='" . $this->getProperty("other_f_6") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_7", "K")){
					$Sql .= "$pro other_f_7='" . $this->getProperty("other_f_7") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_8", "K")){
					$Sql .= "$pro other_f_8='" . $this->getProperty("other_f_8") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("other_f_9", "K")){
					$Sql .= "$pro other_f_9='" . $this->getProperty("other_f_9") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$pro is_active='" . $this->getProperty("is_active") . "'";
					$pro = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("product_id", "K")){
					$Sql .= " AND product_id='" . $this->getProperty("product_id") . "'";
				}
				break;
			case "D":
				$Sql .= "DELETE FROM rs_tbl_products WHERE 1=1 ";
				$Sql .= " AND product_id=" . $this->getProperty("product_id");
				break;

			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of Car Lease  
	public function actCarLease($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_car_lease(
							lease_id,
							lease_type,
							full_name,
							email_address,
							phone_number,
							mobile_number,
							address,
							lease_detail,
							lease_ststus,
							lease_date,
							type_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("lease_id", "V") ? $this->getProperty("lease_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lease_type", "V") ? $this->getProperty("lease_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("full_name", "V") ? "'" . $this->getProperty("full_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("email_address", "V") ? "'" . $this->getProperty("email_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("phone_number", "V") ? "'" . $this->getProperty("phone_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mobile_number", "V") ? "'" . $this->getProperty("mobile_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("address", "V") ? "'" . $this->getProperty("address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lease_detail", "V") ? "'" . $this->getProperty("lease_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lease_ststus", "V") ? "'" . $this->getProperty("lease_ststus") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lease_date", "V") ? "'" . $this->getProperty("lease_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_id", "V") ? "'" . $this->getProperty("type_id") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_car_lease SET ";
				if($this->isPropertySet("lease_ststus", "K")){
					$Sql .= "$pro lease_ststus='" . $this->getProperty("lease_ststus") . "'";
					$pro = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("lease_id", "K")){
					$Sql .= " AND lease_id='" . $this->getProperty("lease_id") . "'";
				}
				break;
			case "D":
				$Sql .= "DELETE FROM rs_tbl_car_lease WHERE 1=1 ";
				$Sql .= " AND lease_id=" . $this->getProperty("lease_id");
				break;

			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of product Extra Feature
	public function actExtraFeature($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_extra_features(
							extra_feature_id,
							feature_name,
							feature_detail,
							feature_icon,
							feature_price,
							is_active)
					VALUES(";
				$Sql .= $this->isPropertySet("extra_feature_id", "V") ? $this->getProperty("extra_feature_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("feature_name", "V") ? "'" . $this->getProperty("feature_name") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("feature_detail", "V") ? "'" . $this->getProperty("feature_detail") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("feature_icon", "V") ? "'" . $this->getProperty("feature_icon") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("feature_price", "V") ? "'" . $this->getProperty("feature_price") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "''";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_extra_features SET ";
				if($this->isPropertySet("feature_name", "K")){
					$Sql .= "$pro feature_name='" . $this->getProperty("feature_name") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("feature_detail", "K")){
					$Sql .= "$pro feature_detail='" . $this->getProperty("feature_detail") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("feature_icon", "K")){
					$Sql .= "$pro feature_icon='" . $this->getProperty("feature_icon") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("feature_price", "K")){
					$Sql .= "$pro feature_price='" . $this->getProperty("feature_price") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$pro is_active='" . $this->getProperty("is_active") . "'";
					$pro = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND extra_feature_id=" . $this->getProperty("extra_feature_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_extra_features WHERE 1=1 ";
				$Sql .= " AND extra_feature_id=" . $this->getProperty("extra_feature_id");
				break;

			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
}