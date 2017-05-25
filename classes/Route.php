<?php
/**
*
* The class Route
* @version 0.01
* @author Numan Tahir  <numan_tahir1@yahoo.com>
* @Date 30 May, 2013
* @modified 30 May, 2013 by Numan Tahir
*
**/
class Route extends Database{
	/**
	* This is the constructor of the class Route
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 06 July 2009 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
	}

	/**
	* This function is used to prepare the url
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public static function _($url = ''){
		$ret = SITE_URL;
		if(MOD_REWRITE == 'false'){
			if(!empty($url)):
				$ret .= '?' . $url;
			endif;
		}
		else{
			$qs = split('&', $url);
			$total = count($qs);
			list($page, $show) = split('=', $qs[0]);
			unset($qs[0]);
			$qstring = $show;
			
			if($qs[1]){
				list($k, $v) = split('=', $qs[1]);
				if($show == 'news' && $k == 'news_id'){
					unset($qs[1]);
					$objContentNews = new Content;
					$objContentNews->setProperty('cms_id', $v);
					$objContentNews->setProperty('cms_type_id', 4);
					$objContentNews->lstContent();
					$row_prd = $objContentNews->dbFetchArray(1);
					$qstring .= '/' . $row_prd['url_key'];
				}
				else if($show == 'cms' && $k == 'cms_id'){
					unset($qs[1]);
					$objContents = new Content;
					$objContents->setProperty('url_key', $v);
					$objContents->setProperty('cms_type_id', 1);
					$objContents->lstContent();
					$row_prd = $objContents->dbFetchArray(1);
					$qstring .= '/' . $row_prd['url_key'];
				}
				else if($show == 'category' && $k == 'category_id'){
					unset($qs[1]);
					$objCategoryGet = new Product;
					$objCategoryGet->setProperty('category_id', $v);
					$objCategoryGet->lstCategory();
					$row_prd = $objCategoryGet->dbFetchArray(1);
					$qstring .= '/' . $row_prd['url_key'];
				}
				else if($show == 'help' && $k == 'help_id'){
					unset($qs[1]);
					$objContentHelp = new Content;
					$objContentHelp->setProperty('cms_id', $v);
					$objContentHelp->setProperty('cms_type_id', 2);
					$objContentHelp->lstContent();
					$row_prd = $objContentHelp->dbFetchArray(1);
					$qstring .= '/' . $row_prd['url_key'];
				}
				else if($show == 'studentguide' && $k == 'callpage'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
				else if($show == 'employeeguide' && $k == 'callpage'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
				else if($show == 'student' && $k == 'callpage'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
				else if($show == 'employee' && $k == 'callpage'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
				else if($show == 'university' && $k == 'callpage'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
				else if($show == 'validation' && $k == 'validate_id'){
					unset($qs[1]);
					$qstring .= '/' . $v;
				}
			}

			if(!empty($url))
				$qstring .= '/';
			
			if(isset($qs[1]))
				$start = 1;

			else if(isset($qs[2]))
				$start = 2;

			if($qs[$start]){
				$qstring .= '?';
				for($i = $start; $i < $total; $i++):
					list($k1, $v1) = split('=', $qs[$i]);
					$qstring .= $k1 . '=' . $v1 . '&';
				endfor;
			}

			$qstring = preg_replace('/\&$/', '', $qstring);
			$ret .= $qstring;
		}
		return $ret;
	}
	
	/**
	* This function is used to prepare the Content url key
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public function getProductKey($name, $product_id = 0){
		$find 		= array(' ', '_', '&', ':', '%', "'", '"', '(', ')', '[', ']', '.', ',', '/', '\\', '=', '+', '*', '#');
		$replace 	= '-';
		$key 		= str_replace($find, $replace, strtolower($name));
		$key		= str_replace('--', $replace, $key);
		$key		= str_replace('--', $replace, $key);
		$key		= preg_replace('/\-$/', '', $key);
		
		// check if already 
		$Sql = "SELECT url_key FROM rs_tbl_products WHERE url_key LIKE '" . $key . "%'";
		if(!empty($product_id)){
			$Sql .= " AND product_id!=" . $product_id;
		}
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1){
			$key = $key . '-' . $this->totalRecords();
		}
		return $key;
	}
		
	/**
	* This function is used to prepare the Content url key
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public function getContentKey($name, $cms_id = 0){
		$find 		= array(' ', '_', '&', ':', '%', "'", '"', '(', ')', '[', ']', '.', ',', '/', '\\', '=', '+', '*', '#');
		$replace 	= '-';
		$key 		= str_replace($find, $replace, strtolower($name));
		$key		= str_replace('--', $replace, $key);
		$key		= str_replace('--', $replace, $key);
		$key		= preg_replace('/\-$/', '', $key);
		
		// check if already 
		$Sql = "SELECT url_key FROM rs_tbl_content WHERE url_key LIKE '" . $key . "%'";
		if(!empty($cms_id)){
			$Sql .= " AND cms_id!=" . $cms_id;
		}
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1){
			$key = $key . '-' . $this->totalRecords();
		}
		return $key;
	}
	
	/**
	* This function is used to prepare the Content url key
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public function getCategoryKey($name, $gcat_id = 0){
		$find 		= array(' ', '_', '&', ':', '%', "'", '"', '(', ')', '[', ']', '.', ',', '/', '\\', '=', '+', '*', '#');
		$replace 	= '-';
		$key 		= str_replace($find, $replace, strtolower($name));
		$key		= str_replace('--', $replace, $key);
		$key		= str_replace('--', $replace, $key);
		$key		= preg_replace('/\-$/', '', $key);
		
		// check if already 
		$Sql = "SELECT url_key FROM rs_tbl_category WHERE url_key LIKE '" . $key . "%'";
		if(!empty($cms_cd)){
			$Sql .= " AND category_id!=" . $gcat_id;
		}
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1){
			$key = $key . '-' . $this->totalRecords();
		}
		return $key;
	}
	
	/**
	* This function is used to prepare the User url key
	* @author Numan Tahir
	* @Date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public function getCustomerKey($name, $customer_id = 0){
		$find 		= array(' ', '_', '&', ':', '%', "'", '"', '(', ')', '[', ']', '.', ',', '/', '\\', '=', '+', '*', '#');
		$replace 	= '-';
		$key 		= str_replace($find, $replace, strtolower($name));
		$key		= str_replace('--', $replace, $key);
		$key		= str_replace('--', $replace, $key);
		$key		= preg_replace('/\-$/', '', $key);

		// check if already 
		$Sql = "SELECT url_key FROM rs_tbl_customer WHERE url_key LIKE '" . $key . "%'";
		if(!empty($customer_id)){
			$Sql .= " AND customer_id!=" . $customer_id;
		}
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1){
			$key = $key . '-' . $this->totalRecords();
		}
		return $key;
	}
	
	/**
	* This function is used to prepare the University url key
	* @author Numan Tahir
	* @Date 04 November, 2013
	* @modified 04 November, 2013 by Numan Tahir
	*/
	public function getUniversityKey($name, $university_id = 0){
		$find 		= array(' ', '_', '&', ':', '%', "'", '"', '(', ')', '[', ']', '.', ',', '/', '\\', '=', '+', '*', '#');
		$replace 	= '-';
		$key 		= str_replace($find, $replace, strtolower($name));
		$key		= str_replace('--', $replace, $key);
		$key		= str_replace('--', $replace, $key);
		$key		= preg_replace('/\-$/', '', $key);
		
		// check if already 
		$Sql = "SELECT url_key FROM rs_tbl_university WHERE url_key LIKE '" . $key . "%'";
		if(!empty($cms_cd)){
			$Sql .= " AND university_id!=" . $university_id;
		}
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1){
			$key = $key . '-' . $this->totalRecords();
		}
		return $key;
	}
}