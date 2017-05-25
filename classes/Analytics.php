<?php

class Analytics extends Database{

	public function __construct(){

		parent::__construct();
	}
	
	// This function is listing Product Analytics	
	public function lstProductAnalytics(){

		$Sql = "SELECT 

					a.analytics_id,
					a.product_id,
					a.customer_id,
					a.visitor_type,
					a.visitor_id,
					a.visitor_ip,
					a.visitor_date,
					(SELECT product_name FROM rs_tbl_products WHERE product_id=a.product_id) as product_name
				FROM
					rs_tbl_product_analytics a
				WHERE 
					1=1";

		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND a.product_id='" . $this->getProperty("product_id") . "'";

		if($this->isPropertySet("analytics_id", "V"))
			$Sql .= " AND a.analytics_id='" . $this->getProperty("analytics_id") . "'";

		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("visitor_type", "V"))
			$Sql .= " AND a.visitor_type='" . $this->getProperty("visitor_type") . "'";		
		
		if($this->isPropertySet("visitor_id", "V"))
			$Sql .= " AND a.visitor_id='" . $this->getProperty("visitor_id") . "'";
		
		if($this->isPropertySet("visitor_ip", "V"))
			$Sql .= " AND a.visitor_ip='" . $this->getProperty("visitor_ip") . "'";

		if($this->isPropertySet("visitor_date", "V"))
			$Sql .= " AND a.visitor_date='" . $this->getProperty("visitor_date") . "'";	
		
		$Sql .= " ORDER BY visitor_id DESC ";
		return $this->dbQuery($Sql);
	}

	// This function is listing Profile Analytics	
	public function lstProfileAnalytics(){
	
		$Sql = "SELECT 
					a.analytics_id,
					a.profile_id,
					a.customer_id,
					a.visitor_type,
					a.visitor_id,
					a.visitor_ip,
					a.visitor_date,
					(SELECT CONCAT(first_name,' ',last_name) AS fullname, FROM rs_tbl_customer WHERE customer_id=a.profile_id) as profile_name
				FROM
					rs_tbl_profile_analytics a
				WHERE 
					1=1";

		if($this->isPropertySet("profile_id", "V"))
			$Sql .= " AND a.profile_id='" . $this->getProperty("profile_id") . "'";
	
		if($this->isPropertySet("analytics_id", "V"))
			$Sql .= " AND a.analytics_id='" . $this->getProperty("analytics_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("visitor_type", "V"))
			$Sql .= " AND a.visitor_type='" . $this->getProperty("visitor_type") . "'";		
		
		if($this->isPropertySet("visitor_id", "V"))
			$Sql .= " AND a.visitor_id='" . $this->getProperty("visitor_id") . "'";
		
		if($this->isPropertySet("visitor_ip", "V"))
			$Sql .= " AND a.visitor_ip='" . $this->getProperty("visitor_ip") . "'";

		if($this->isPropertySet("visitor_date", "V"))
			$Sql .= " AND a.visitor_date='" . $this->getProperty("visitor_date") . "'";	
		
		$Sql .= " ORDER BY visitor_id DESC ";
		return $this->dbQuery($Sql);
	}
	
	// This function is listing Website Analytics
	public function lstWebsiteAnalytics(){

		$Sql = "SELECT 

					a.analytics_id,
					a.page_id,
					a.visitor_type,
					a.visitor_id,
					a.visitor_ip,
					a.visitor_date,
					a.url,
					a.cron_check,
					(SELECT page_name FROM rs_tbl_page_list WHERE page_id=a.page_id) as page_name
				FROM
					rs_tbl_website_analytics a
				WHERE 
					1=1";

		if($this->isPropertySet("analytics_id", "V"))
			$Sql .= " AND a.analytics_id='" . $this->getProperty("analytics_id") . "'";

		if($this->isPropertySet("page_id", "V"))
			$Sql .= " AND a.page_id='" . $this->getProperty("page_id") . "'";		

		if($this->isPropertySet("visitor_type", "V"))
			$Sql .= " AND a.visitor_type='" . $this->getProperty("visitor_type") . "'";		
		
		if($this->isPropertySet("visitor_id", "V"))
			$Sql .= " AND a.visitor_id='" . $this->getProperty("visitor_id") . "'";
		
		if($this->isPropertySet("visitor_ip", "V"))
			$Sql .= " AND a.visitor_ip='" . $this->getProperty("visitor_ip") . "'";

		if($this->isPropertySet("visitor_date", "V"))
			$Sql .= " AND a.visitor_date='" . $this->getProperty("visitor_date") . "'";	
			
		if($this->isPropertySet("url", "V"))
			$Sql .= " AND a.url='" . $this->getProperty("url") . "'";	

		if($this->isPropertySet("cron_check", "V"))
			$Sql .= " AND a.cron_check='" . $this->getProperty("cron_check") . "'";			
		
		$Sql .= " ORDER BY visitor_id DESC ";
		return $this->dbQuery($Sql);
	}
	
	// This function is listing page List
	public function lstPageList(){

		$Sql = "SELECT 
					a.page_id,
					a.page_name
				FROM
					rs_tbl_page_list a
				WHERE 
					1=1";

		if($this->isPropertySet("page_id", "V"))
			$Sql .= " AND a.page_id='" . $this->getProperty("page_id") . "'";

		if($this->isPropertySet("page_name", "V"))
			$Sql .= " AND a.page_name='" . $this->getProperty("page_name") . "'";		
		
		$Sql .= " ORDER BY page_id DESC";	
		return $this->dbQuery($Sql);
	}
		
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of product analytics
	public function actProductAnalytics($mode){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_product_analytics(
					analytics_id,
					product_id,
					customer_id,
					visitor_type,
					visitor_id,
					visitor_ip,
					visitor_date) 
					VALUES(";

				$Sql .= $this->isPropertySet("analytics_id", "V") ? $this->getProperty("analytics_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_type", "V") ? "'" . $this->getProperty("visitor_type") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_id", "V") ? $this->getProperty("visitor_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_ip", "V") ? "'" . $this->getProperty("visitor_ip") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_date", "V") ? "'" . $this->getProperty("visitor_date") . "'" : "''";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_product_analytics SET ";
				if($this->isPropertySet("visitor_type", "K")){

					$Sql .= "$pro visitor_type='" . $this->getProperty("visitor_type") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("visitor_ip", "K")){

					$Sql .= "$pro visitor_ip='" . $this->getProperty("visitor_ip") . "'";
					$pro = ",";
				}

				if($this->isPropertySet("visitor_date", "K")){

					$Sql .= "$pro visitor_date='" . $this->getProperty("visitor_date") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND product_id=" . $this->getProperty("product_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_product_analytics WHERE 1=1 ";
				$Sql .= " AND product_id=" . $this->getProperty("product_id");
				break;

			default:
				break;

		}
		return $this->dbQuery($Sql);

	}

	// This function is used to perform DML(Delete/Update/Add)
	// on the table of profile analytics	
	public function actProfileAnalytics($mode){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_profile_analytics(
					analytics_id,
					profile_id,
					customer_id,
					visitor_type,
					visitor_id,
					visitor_ip,
					visitor_date) 
					VALUES(";
					
				$Sql .= $this->isPropertySet("analytics_id", "V") ? $this->getProperty("analytics_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("profile_id", "V") ? $this->getProperty("profile_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_type", "V") ? "'" . $this->getProperty("visitor_type") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_id", "V") ? $this->getProperty("visitor_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_ip", "V") ? "'" . $this->getProperty("visitor_ip") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_date", "V") ? "'" . $this->getProperty("visitor_date") . "'" : "''";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_profile_analytics SET ";
				if($this->isPropertySet("visitor_type", "K")){

					$Sql .= "$pro visitor_type='" . $this->getProperty("visitor_type") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("visitor_ip", "K")){

					$Sql .= "$pro visitor_ip='" . $this->getProperty("visitor_ip") . "'";
					$pro = ",";
				}

				if($this->isPropertySet("visitor_date", "K")){

					$Sql .= "$pro visitor_date='" . $this->getProperty("visitor_date") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND profile_id=" . $this->getProperty("profile_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_product_analytics WHERE 1=1 ";
				$Sql .= " AND profile_id=" . $this->getProperty("profile_id");
				break;

			default:
				break;

		}
		return $this->dbQuery($Sql);
	}
	
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of web analytics
	public function actWebAnalytics($mode){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_website_analytics(
					analytics_id,
					page_id,
					visitor_type,
					visitor_id,
					visitor_ip,
					visitor_date,
					url,
					cron_check) 
					VALUES(";

				$Sql .= $this->isPropertySet("analytics_id", "V") ? $this->getProperty("analytics_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("page_id", "V") ? $this->getProperty("page_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_type", "V") ? "'" . $this->getProperty("visitor_type") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_id", "V") ? $this->getProperty("visitor_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_ip", "V") ? "'" . $this->getProperty("visitor_ip") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_date", "V") ? "'" . $this->getProperty("visitor_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url", "V") ? "'" . $this->getProperty("url") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cron_check", "V") ? "'" . $this->getProperty("cron_check") . "'" : "''";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_website_analytics SET ";
				if($this->isPropertySet("visitor_type", "K")){

					$Sql .= "$pro visitor_type='" . $this->getProperty("visitor_type") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("visitor_ip", "K")){

					$Sql .= "$pro visitor_ip='" . $this->getProperty("visitor_ip") . "'";
					$pro = ",";
				}

				if($this->isPropertySet("visitor_date", "K")){

					$Sql .= "$pro visitor_date='" . $this->getProperty("visitor_date") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("url", "K")){

					$Sql .= "$pro url='" . $this->getProperty("url") . "'";
					$pro = ",";
				}
				
				if($this->isPropertySet("cron_check", "K")){

					$Sql .= "$pro cron_check='" . $this->getProperty("cron_check") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND analytics_id=" . $this->getProperty("analytics_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_website_analytics WHERE 1=1 ";
				$Sql .= " AND analytics_id=" . $this->getProperty("analytics_id");
				break;

			default:
				break;

		}
		return $this->dbQuery($Sql);
	}
	
	// This function is used to perform DML(Delete/Update/Add)
	// on the table of page list
	public function actPageList($mode){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_page_list(
					page_id,
					page_name) 
					VALUES(";

				$Sql .= $this->isPropertySet("page_id", "V") ? $this->getProperty("page_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("page_name", "V") ? "'" . $this->getProperty("page_name") . "'" : "''";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_page_list SET ";
				if($this->isPropertySet("page_name", "K")){

					$Sql .= "$pro page_name='" . $this->getProperty("page_name") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND page_id=" . $this->getProperty("page_id");
				break;

			case "D":

				$Sql .= "DELETE FROM rs_tbl_page_list WHERE 1=1 ";
				$Sql .= " AND page_id=" . $this->getProperty("page_id");
				break;

			default:
				break;

		}
		return $this->dbQuery($Sql);
	}
	