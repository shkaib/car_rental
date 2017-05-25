<?php
/**
*
* This is a class Content
* @version 0.01
* @author Numan Tahir  <numan_tahir1@live.com>
* @Date 11 July, 2012
* @modified 11 July, 2012 by Numan Tahir
*
**/
class Content extends Database{
	/**
	* This is the constructor of the class Content
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
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
 	* Product::getDocumentname()	
	* This method is used to get image name
	* @author Numan Tahir
	* @Date : 30 Dec, 2007
	* @modified : 30 Dec, 2007 by Numan Tahir
	* @return : bool
	*/

	public function getDocumentname($type, $product_cd = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($product_cd != ''){
			$filename = $filename . '-' . $product_cd . "." . $this->getExtention($type);
		}
		else{
			$filename = $filename . ".";
		}
		return $filename;
	}
	
	/**
	* This method is used to populate the CMS combo
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function CMSCombo($sel = "", $MainId){
		$opt = "";
		$Sql = "SELECT 
					cms_id,
					cms_title
				FROM
					rs_tbl_content
				WHERE
					1=1 
					AND parent_id=0";
				
		if($MainId!=''){
			$Sql .= " AND cms_id!=" . $MainId;
		}
			
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['cms_id'] == $sel)
				$opt .= "<option value=\"" . $rows['cms_id'] . "\" selected>" . $rows['cms_title'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['cms_id'] . "\">" . $rows['cms_title'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to populate the Guide Category combo
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function GuideCategoryCombo($sel = "", $MainId){
		$opt = "";
		$Sql = "SELECT 
					gcat_id,
					gcat_name
				FROM
					rs_tbl_guid_category
				WHERE
					1=1 
					AND parent_id=0";
				
		if($MainId!=''){
			$Sql .= " AND gcat_id!=" . $MainId;
		}
			
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['gcat_id'] == $sel)
				$opt .= "<option value=\"" . $rows['gcat_id'] . "\" selected>" . $rows['gcat_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['gcat_id'] . "\">" . $rows['gcat_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to populate the Guide Category combo
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function GCategoryCombo($sel){
		$opt = "";
		$Sql = "SELECT 
					gcat_id,
					gcat_name
				FROM
					rs_tbl_guid_category
				WHERE
					1=1";
			
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['gcat_id'] == $sel)
				$opt .= "<option value=\"" . $rows['gcat_id'] . "\" selected>" . $rows['gcat_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['gcat_id'] . "\">" . $rows['gcat_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to get the content of site cms
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function getContent($url_key){
		$sql = "SELECT
					cms_id,
					cms_title,
					cms_detail,
					parent_id,
					cms_category_id,
					cms_type_id,
					cms_file,
					cms_date,
					is_active,
					url_key,
					ans_yes,
					ans_no
				FROM
					rs_tbl_content
				WHERE
					1=1
					AND url_key='" . $url_key . "'";
		
		$this->dbQuery($sql);
		$rows = $this->dbFetchArray(1);
		return $rows;
	}
	
	/**
	* This method is used to get the Business Job Posting Help
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function getBusJobHelp($bus_code){
		$sql = "SELECT
					bus_job_help_id,
					bus_job_help_code,
					bus_job_help_title,
					bus_job_help_text
				FROM
					rs_tbl_guide_business_job_help
				WHERE
					1=1
					AND bus_job_help_code='" . $bus_code . "'";
		
		$this->dbQuery($sql);
		$rows = $this->dbFetchArray(1);
		return $rows['bus_job_help_text'];
	}
	
	
	/**
	* This method is used to get the Business Job Posting Help
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function getLocationName($location_id){
		$sql = "SELECT
					location_id,
					location_title
				FROM
					rs_tbl_location
				WHERE
					1=1
					AND location_id='" . $location_id . "'";
		
		$this->dbQuery($sql);
		$rows = $this->dbFetchArray(1);
		return $rows['location_title'];
	}

	/**
	* This method is used to get the content of site cms
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function lstContent(){
		$Sql = "SELECT
					cms_id,
					cms_title,
					cms_detail,
					parent_id,
					cms_category_id,
					cms_type_id,
					other_type,
					cms_file,
					cms_date,
					is_active,
					url_key,
					ans_yes,
					ans_no
				FROM
					rs_tbl_content
				WHERE
					1=1";
		if($this->isPropertySet("cms_id", "V"))
			$Sql .= " AND cms_id=" . $this->getProperty("cms_id");
		
		if($this->isPropertySet("parent_id", "V"))
			$Sql .= " AND parent_id=" . $this->getProperty("parent_id");
		
		if($this->isPropertySet("cms_category_id", "V"))
			$Sql .= " AND cms_category_id='" . $this->getProperty("cms_category_id") . "'";
		
		if($this->isPropertySet("cms_type_id", "V"))
			$Sql .= " AND cms_type_id='" . $this->getProperty("cms_type_id") . "'";
		
		if($this->isPropertySet("other_type", "V"))
			$Sql .= " AND other_type='" . $this->getProperty("other_type") . "'";
		
		if($this->isPropertySet("cms_file", "V"))
			$Sql .= " AND cms_file=" . $this->getProperty("cms_file");
		
		if($this->isPropertySet("cms_date", "V"))
			$Sql .= " AND cms_date=" . $this->getProperty("cms_date");
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key")."'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the content of site cms
	* @author Numan Tahir
	*/
	public function lstPartner(){
		$Sql = "SELECT
					partner_id,
					partner_name,
					partner_detail,
					partner_logo,
					partner_url,
					is_active
				FROM
					rs_tbl_partner
				WHERE
					1=1";
		if($this->isPropertySet("partner_id", "V"))
			$Sql .= " AND partner_id=" . $this->getProperty("partner_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the content of site cms
	* @author Numan Tahir
	*/
	public function lstProject(){
		$Sql = "SELECT
					portfolio_id,
					project_name,
					project_description,
					client_name,
					project_c_date,
					project_tags,
					project_file_1,
					project_file_2,
					is_active
				FROM
					rs_tbl_project
				WHERE
					1=1";
		if($this->isPropertySet("portfolio_id", "V"))
			$Sql .= " AND portfolio_id=" . $this->getProperty("portfolio_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This method is used to get the Help of site
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function lstContact(){
		$Sql = "SELECT
					contact_id,
					contact_email,
					contact_name,
					contact_category_name,
					contact_date,
					contact_detail,
					is_active
				FROM
					rs_tbl_contact
				WHERE
					1=1";
		if($this->isPropertySet("contact_id", "V"))
			$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Help of site
	* @author Numan Tahir
	*/
	public function lstQuestions(){
		$Sql = "SELECT
					question_id,
					q_name,
					q_email,
					q_business_name,
					q_phone,
					q_website,
					q_about_company,
					q_identify_goal,
					q_purpose_of_site,
					q_time_frame,
					q_willing__spend,
					q_visitor_yur_site,
					q_color_option,
					q_logo_option,
					q_add_features,
					q_links_cop_1,
					q_links_cop_2,
					q_links_cop_3,
					q_links_comm_1,
					q_links_comm_2,
					q_links_comm_3,
					posted_date,
					read_status
				FROM
					rs_tbl_questions
				WHERE
					1=1";
		if($this->isPropertySet("question_id", "V"))
			$Sql .= " AND question_id=" . $this->getProperty("question_id");
		
		if($this->isPropertySet("read_status", "V"))
			$Sql .= " AND read_status=" . $this->getProperty("read_status");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the FeedBack
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstFeedback(){
		$Sql = "SELECT
					feedback_id,
					customer_id,
					fdb_name,
					fdb_email,
					fdb_subject,
					fdb_message_type,
					fdb_message_box,
					fdb_date,
					fdb_status
				FROM
					rs_tbl_feedback
				WHERE
					1=1";
		if($this->isPropertySet("feedback_id", "V"))
			$Sql .= " AND feedback_id=" . $this->getProperty("feedback_id");
		
		if($this->isPropertySet("fdb_message_type", "V"))
			$Sql .= " AND fdb_message_type=" . $this->getProperty("fdb_message_type");
		
		if($this->isPropertySet("fdb_status", "V"))
			$Sql .= " AND fdb_status=" . $this->getProperty("fdb_status");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This method is used to get the FAQ
	* @author Numan Tahir
	* @modified by Numan Tahir
	*/
	public function lstFaq(){
		$Sql = "SELECT
					faq_id,
					faq_title,
					faq_answer,
					faq_date,
					faq_status
				FROM
					rs_tbl_faq
				WHERE
					1=1";
		if($this->isPropertySet("faq_id", "V"))
			$Sql .= " AND faq_id=" . $this->getProperty("faq_id");
		
		if($this->isPropertySet("faq_status", "V"))
			$Sql .= " AND faq_status=" . $this->getProperty("faq_status");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Location
	* @author Numan Tahir
	* @modified by Numan Tahir
	*/
	public function lstLocation(){
		$Sql = "SELECT
					location_id,
					location_title,
					location_price,
					is_active
				FROM
					rs_tbl_location
				WHERE
					1=1";
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_partner the basis of property set
	* @author Numan Tahir
	*/
	public function actPartner($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_partner(
							partner_id,
							partner_name,
							partner_detail,
							partner_logo,
							partner_url,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("partner_id", "V") ? $this->getProperty("partner_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("partner_name", "V") ? "'" . $this->getProperty("partner_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("partner_detail", "V") ? "'" . $this->getProperty("partner_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("partner_logo", "V") ? "'" . $this->getProperty("partner_logo") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("partner_url", "V") ? "'" . $this->getProperty("partner_url") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_partner SET ";
				
				if($this->isPropertySet("partner_name", "K")){
					$Sql .= "$cat partner_name='" . $this->getProperty("partner_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("partner_detail", "K")){
					$Sql .= "$cat partner_detail='" . $this->getProperty("partner_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("partner_logo", "K")){
					$Sql .= "$cat partner_logo='" . $this->getProperty("partner_logo") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("partner_url", "K")){
					$Sql .= "$cat partner_url='" . $this->getProperty("partner_url") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND partner_id=" . $this->getProperty("partner_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_partner 
						 WHERE 1=1";
				if($this->isPropertySet("partner_id", "K")){
					$Sql .= " AND partner_id=" . $this->getProperty("partner_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_project the basis of property set
	* @author Numan Tahir
	*/
	public function actPortfolio($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_project(
							portfolio_id,
							project_name,
							project_description,
							client_name,
							project_c_date,
							project_tags,
							project_file_1,
							project_file_2,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("portfolio_id", "V") ? $this->getProperty("portfolio_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_name", "V") ? "'" . $this->getProperty("project_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_description", "V") ? "'" . $this->getProperty("project_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("client_name", "V") ? "'" . $this->getProperty("client_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_c_date", "V") ? "'" . $this->getProperty("project_c_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_tags", "V") ? "'" . $this->getProperty("project_tags") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_file_1", "V") ? "'" . $this->getProperty("project_file_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_file_2", "V") ? "'" . $this->getProperty("project_file_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_project SET ";
				
				if($this->isPropertySet("project_name", "K")){
					$Sql .= "$cat project_name='" . $this->getProperty("project_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("project_description", "K")){
					$Sql .= "$cat project_description='" . $this->getProperty("project_description") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("client_name", "K")){
					$Sql .= "$cat client_name='" . $this->getProperty("client_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("project_c_date", "K")){
					$Sql .= "$cat project_c_date='" . $this->getProperty("project_c_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("project_tags", "K")){
					$Sql .= "$cat project_tags='" . $this->getProperty("project_tags") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("project_file_1", "K")){
					$Sql .= "$cat project_file_1='" . $this->getProperty("project_file_1") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("project_file_2", "K")){
					$Sql .= "$cat project_file_2='" . $this->getProperty("project_file_2") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				$Sql .= " AND portfolio_id=" . $this->getProperty("portfolio_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_project 
						 WHERE 1=1";
				if($this->isPropertySet("portfolio_id", "K")){
					$Sql .= " AND portfolio_id=" . $this->getProperty("portfolio_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actContent($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_content(
							cms_id,
							cms_title,
							cms_detail,
							parent_id,
							cms_category_id,
							cms_type_id,
							other_type,
							cms_file,
							cms_date,
							is_active,
							url_key,
							ans_yes,
							ans_no)
						VALUES(";
				$Sql .= $this->isPropertySet("cms_id", "V") ? $this->getProperty("cms_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_title", "V") ? "'" . $this->getProperty("cms_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_detail", "V") ? "'" . $this->getProperty("cms_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("parent_id", "V") ? $this->getProperty("parent_id") : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_category_id", "V") ? "'" . $this->getProperty("cms_category_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_type_id", "V") ? "'" . $this->getProperty("cms_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_type", "V") ? "'" . $this->getProperty("other_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_file", "V") ? "'" . $this->getProperty("cms_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cms_date", "V") ? "'" . $this->getProperty("cms_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ans_yes", "V") ? "'" . $this->getProperty("ans_yes") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ans_no", "V") ? "'" . $this->getProperty("ans_no") . "'" : "0";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_content SET ";
				
				if($this->isPropertySet("parent_id", "K")){
					$Sql .= "$cat parent_id='" . $this->getProperty("parent_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_title", "K")){
					$Sql .= "$cat cms_title='" . $this->getProperty("cms_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_detail", "K")){
					$Sql .= "$cat cms_detail='" . $this->getProperty("cms_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_meta_keyword", "K")){
					$Sql .= "$cat cms_meta_keyword='" . $this->getProperty("cms_meta_keyword") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_category_id", "K")){
					$Sql .= "$cat cms_category_id='" . $this->getProperty("cms_category_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_type_id", "K")){
					$Sql .= "$cat cms_type_id='" . $this->getProperty("cms_type_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("other_type", "K")){
					$Sql .= "$cat other_type='" . $this->getProperty("other_type") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("cms_file", "K")){
					$Sql .= "$cat cms_file='" . $this->getProperty("cms_file") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("ans_yes", "K")){
					$Sql .= "$cat ans_yes='" . $this->getProperty("ans_yes") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("ans_no", "K")){
					$Sql .= "$cat ans_no='" . $this->getProperty("ans_no") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				$Sql .= " AND cms_id=" . $this->getProperty("cms_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_content 
						 WHERE 1=1";
				if($this->isPropertySet("cms_id", "K")){
					$Sql .= " AND cms_id=" . $this->getProperty("cms_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideVideoPageList($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_video_page_list(
							guide_video_page_id,
							page_name,
							category_name,
							youtube_video_id)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_video_page_id", "V") ? $this->getProperty("guide_video_page_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("page_name", "V") ? "'" . $this->getProperty("page_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_name", "V") ? "'" . $this->getProperty("category_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("youtube_video_id", "V") ? "'" . $this->getProperty("youtube_video_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_video_page_list SET ";
				
				if($this->isPropertySet("page_name", "K")){
					$Sql .= "$cat page_name='" . $this->getProperty("page_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("category_name", "K")){
					$Sql .= "$cat category_name='" . $this->getProperty("category_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("youtube_video_id", "K")){
					$Sql .= "$cat youtube_video_id='" . $this->getProperty("youtube_video_id") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_video_page_id=" . $this->getProperty("guide_video_page_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_video_page_list 
						 WHERE 1=1";
				if($this->isPropertySet("guide_video_page_id", "K")){
					$Sql .= " AND guide_video_page_id=" . $this->getProperty("guide_video_page_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideTutorial($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_tutorial(
							guide_tutorial_id,
							tutorial_title,
							tutorial_detail,
							tutorial_video_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_tutorial_id", "V") ? $this->getProperty("guide_tutorial_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_title", "V") ? "'" . $this->getProperty("tutorial_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_detail", "V") ? "'" . $this->getProperty("tutorial_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_video_id", "V") ? "'" . $this->getProperty("tutorial_video_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_tutorial SET ";
				
				if($this->isPropertySet("tutorial_title", "K")){
					$Sql .= "$cat tutorial_title='" . $this->getProperty("tutorial_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tutorial_detail", "K")){
					$Sql .= "$cat tutorial_detail='" . $this->getProperty("tutorial_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tutorial_video_id", "K")){
					$Sql .= "$cat tutorial_video_id='" . $this->getProperty("tutorial_video_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_tutorial_id=" . $this->getProperty("guide_tutorial_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_tutorial 
						 WHERE 1=1";
				if($this->isPropertySet("guide_tutorial_id", "K")){
					$Sql .= " AND guide_tutorial_id=" . $this->getProperty("guide_tutorial_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideResume($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_resume(
							guide_resume_id,
							resume_title,
							resume_detail,
							resume_file,
							resume_date,
							resume_template,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_resume_id", "V") ? $this->getProperty("guide_resume_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_title", "V") ? "'" . $this->getProperty("resume_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_detail", "V") ? "'" . $this->getProperty("resume_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_file", "V") ? "'" . $this->getProperty("resume_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_date", "V") ? "'" . $this->getProperty("resume_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_template", "V") ? "'" . $this->getProperty("resume_template") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_resume SET ";
				
				if($this->isPropertySet("resume_title", "K")){
					$Sql .= "$cat resume_title='" . $this->getProperty("resume_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("resume_detail", "K")){
					$Sql .= "$cat resume_detail='" . $this->getProperty("resume_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("resume_file", "K")){
					$Sql .= "$cat resume_file='" . $this->getProperty("resume_file") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("resume_template", "K")){
					$Sql .= "$cat resume_template='" . $this->getProperty("resume_template") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_resume_id=" . $this->getProperty("guide_resume_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_resume 
						 WHERE 1=1";
				if($this->isPropertySet("guide_resume_id", "K")){
					$Sql .= " AND guide_resume_id=" . $this->getProperty("guide_resume_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideResumeComments($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_resume_comments(
							resume_comment_id,
							guide_resume_id,
							resume_comments_title,
							resume_comments,
							resume_comments_date,
							comment_by,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("resume_comment_id", "V") ? $this->getProperty("resume_comment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("guide_resume_id", "V") ? "'" . $this->getProperty("guide_resume_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_comments_title", "V") ? "'" . $this->getProperty("resume_comments_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_comments", "V") ? "'" . $this->getProperty("resume_comments") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_comments_date", "V") ? "'" . $this->getProperty("resume_comments_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("comment_by", "V") ? "'" . $this->getProperty("comment_by") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_resume_comments SET ";
				
				if($this->isPropertySet("resume_comments_title", "K")){
					$Sql .= "$cat resume_comments_title='" . $this->getProperty("resume_comments_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("resume_comments", "K")){
					$Sql .= "$cat resume_comments='" . $this->getProperty("resume_comments") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("comment_by", "K")){
					$Sql .= "$cat comment_by='" . $this->getProperty("comment_by") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND resume_comment_id=" . $this->getProperty("resume_comment_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_resume_comments 
						 WHERE 1=1";
				if($this->isPropertySet("resume_comment_id", "K")){
					$Sql .= " AND resume_comment_id=" . $this->getProperty("resume_comment_id");
				}
				if($this->isPropertySet("guide_resume_id", "K")){
					$Sql .= " AND guide_resume_id=" . $this->getProperty("guide_resume_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideResumeTips($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_resume_tips(
							guide_resume_tips_id,
							tips_detail,
							tips_date,
							resume_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_resume_tips_id", "V") ? $this->getProperty("guide_resume_tips_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tips_detail", "V") ? "'" . $this->getProperty("tips_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tips_date", "V") ? "'" . $this->getProperty("tips_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_id", "V") ? "'" . $this->getProperty("resume_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_resume_tips SET ";
				
				if($this->isPropertySet("tips_detail", "K")){
					$Sql .= "$cat tips_detail='" . $this->getProperty("tips_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("resume_id", "K")){
					$Sql .= "$cat resume_id='" . $this->getProperty("resume_id") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_resume_tips_id=" . $this->getProperty("guide_resume_tips_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_resume_tips 
						 WHERE 1=1";
				if($this->isPropertySet("guide_resume_tips_id", "K")){
					$Sql .= " AND guide_resume_tips_id=" . $this->getProperty("guide_resume_tips_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideInterview($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_interview(
							guide_interview_id,
							interview_title,
							interview_detail,
							interview_video_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_interview_id", "V") ? $this->getProperty("guide_interview_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("interview_title", "V") ? "'" . $this->getProperty("interview_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("interview_detail", "V") ? "'" . $this->getProperty("interview_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("interview_video_id", "V") ? "'" . $this->getProperty("interview_video_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_interview SET ";
				
				if($this->isPropertySet("interview_title", "K")){
					$Sql .= "$cat interview_title='" . $this->getProperty("interview_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("interview_detail", "K")){
					$Sql .= "$cat interview_detail='" . $this->getProperty("interview_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("interview_video_id", "K")){
					$Sql .= "$cat interview_video_id='" . $this->getProperty("interview_video_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_interview_id=" . $this->getProperty("guide_interview_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_interview 
						 WHERE 1=1";
				if($this->isPropertySet("guide_interview_id", "K")){
					$Sql .= " AND guide_interview_id=" . $this->getProperty("guide_interview_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideTour($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_tour(
							guide_tour_id,
							tour_title,
							tour_detail,
							tour_video_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_tour_id", "V") ? $this->getProperty("guide_tour_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tour_title", "V") ? "'" . $this->getProperty("tour_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tour_detail", "V") ? "'" . $this->getProperty("tour_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tour_video_id", "V") ? "'" . $this->getProperty("tour_video_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_tour SET ";
				
				if($this->isPropertySet("tour_title", "K")){
					$Sql .= "$cat tour_title='" . $this->getProperty("tour_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tour_detail", "K")){
					$Sql .= "$cat tour_detail='" . $this->getProperty("tour_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tour_video_id", "K")){
					$Sql .= "$cat tour_video_id='" . $this->getProperty("tour_video_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_tour_id=" . $this->getProperty("guide_tour_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_tour 
						 WHERE 1=1";
				if($this->isPropertySet("guide_tour_id", "K")){
					$Sql .= " AND guide_tour_id=" . $this->getProperty("guide_tour_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rr_tbl_contents the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideInterviewTips($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_interview_tips(
							guide_interview_tips_id,
							tips_detail,
							tips_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("guide_interview_tips_id", "V") ? $this->getProperty("guide_interview_tips_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tips_detail", "V") ? "'" . $this->getProperty("tips_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tips_date", "V") ? "'" . $this->getProperty("tips_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_interview_tips SET ";
				
				if($this->isPropertySet("tips_detail", "K")){
					$Sql .= "$cat tips_detail='" . $this->getProperty("tips_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND guide_interview_tips_id=" . $this->getProperty("guide_interview_tips_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_interview_tips 
						 WHERE 1=1";
				if($this->isPropertySet("guide_interview_tips_id", "K")){
					$Sql .= " AND guide_interview_tips_id=" . $this->getProperty("guide_interview_tips_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Contact (Delete/Update/Add)
	* on the table rs_tbl_contact the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actSiteContact($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_contact(
							contact_id,
							contact_email,
							contact_name,
							contact_category_name,
							contact_date,
							contact_detail,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("contact_id", "V") ? $this->getProperty("contact_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_email", "V") ? "'" . $this->getProperty("contact_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_name", "V") ? "'" . $this->getProperty("contact_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_category_name", "V") ? "'" . $this->getProperty("contact_category_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_date", "V") ? "'" . $this->getProperty("contact_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_detail", "V") ? "'" . $this->getProperty("contact_detail") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_contact SET ";
				if($this->isPropertySet("contact_email", "K")){
					$Sql .= "$cat contact_email='" . $this->getProperty("contact_email") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("contact_name", "K")){
					$Sql .= "$cat contact_name='" . $this->getProperty("contact_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("contact_category_name", "K")){
					$Sql .= "$cat contact_category_name='" . $this->getProperty("contact_category_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("contact_detail", "K")){
					$Sql .= "$cat contact_detail='" . $this->getProperty("contact_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_contact 
						 WHERE 1=1";
					$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Help (Delete/Update/Add)
	* on the table rs_tbl_help the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuidCategory($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guid_category(
							gcat_id,
							gcat_name,
							parent_id,
							gcate_date,
							is_active,
							gcat_order,
							url_key)
						VALUES(";
				$Sql .= $this->isPropertySet("gcat_id", "V") ? $this->getProperty("gcat_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gcat_name", "V") ? "'" . $this->getProperty("gcat_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("parent_id", "V") ? "'" . $this->getProperty("parent_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gcate_date", "V") ? "'" . $this->getProperty("gcate_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gcat_order", "V") ? "'" . $this->getProperty("gcat_order") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "''";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guid_category SET ";
				if($this->isPropertySet("gcat_name", "K")){
					$Sql .= "$cat gcat_name='" . $this->getProperty("gcat_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("parent_id", "K")){
					$Sql .= "$cat parent_id='" . $this->getProperty("parent_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("gcat_order", "K")){
					$Sql .= "$cat gcat_order='" . $this->getProperty("gcat_order") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				$Sql .= " AND gcat_id=" . $this->getProperty("gcat_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guid_category 
						 WHERE 1=1";
					$Sql .= " AND gcat_id=" . $this->getProperty("gcat_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Guide Subscriber (Delete/Update/Add)
	* on the table rs_tbl_guid_subscriber the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actGuideSubscriber($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guid_subscriber(
							subscriber_id,
							customer_id,
							subscriber_email,
							subscriber_name,
							subscriber_confirm_id,
							subscriber_date,
							subscriber_status)
							VALUES(";
				$Sql .= $this->isPropertySet("subscriber_id", "V") ? $this->getProperty("subscriber_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subscriber_email", "V") ? "'" . $this->getProperty("subscriber_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subscriber_name", "V") ? "'" . $this->getProperty("subscriber_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subscriber_confirm_id", "V") ? "'" . $this->getProperty("subscriber_confirm_id") . "'" : "NULL";				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subscriber_date", "V") ? "'" . $this->getProperty("subscriber_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subscriber_status", "V") ? "'" . $this->getProperty("subscriber_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guid_subscriber SET ";
				
				if($this->isPropertySet("subscriber_email", "K")){
					$Sql .= "$cat subscriber_email='" . $this->getProperty("subscriber_email") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("subscriber_name", "K")){
					$Sql .= "$cat subscriber_name='" . $this->getProperty("subscriber_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("subscriber_confirm_id", "K")){
					$Sql .= "$cat subscriber_confirm_id='" . $this->getProperty("subscriber_confirm_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("subscriber_status", "K")){
					$Sql .= "$cat subscriber_status='" . $this->getProperty("subscriber_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND subscriber_id=" . $this->getProperty("subscriber_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guid_subscriber 
						 WHERE 1=1";
					$Sql .= " AND subscriber_id=" . $this->getProperty("subscriber_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Videos (Delete/Update/Add)
	* on the table rs_tbl_videos the basis of property set
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function actVideos($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_videos(
							video_id,
							video_title,
							video_detail,
							video_link,
							video_file,
							video_type,
							video_date,
							is_active)
							VALUES(";
				$Sql .= $this->isPropertySet("video_id", "V") ? $this->getProperty("video_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("video_title", "V") ? "'" . $this->getProperty("video_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("video_detail", "V") ? "'" . $this->getProperty("video_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("video_link", "V") ? "'" . $this->getProperty("video_link") . "'" : "NULL";				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("video_file", "V") ? "'" . $this->getProperty("video_file") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("video_type", "V") ? "'" . $this->getProperty("video_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("video_date", "V") ? "'" . $this->getProperty("video_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_videos SET ";
				
				if($this->isPropertySet("video_title", "K")){
					$Sql .= "$cat video_title='" . $this->getProperty("video_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("video_detail", "K")){
					$Sql .= "$cat video_detail='" . $this->getProperty("video_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("video_link", "K")){
					$Sql .= "$cat video_link='" . $this->getProperty("video_link") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("video_file", "K")){
					$Sql .= "$cat video_file='" . $this->getProperty("video_file") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("video_type", "K")){
					$Sql .= "$cat video_type='" . $this->getProperty("video_type") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND video_id=" . $this->getProperty("video_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_videos 
						 WHERE 1=1";
					$Sql .= " AND video_id=" . $this->getProperty("video_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Business Guide Help (Delete/Update/Add)
	* on the table rs_tbl_guide_business_job_help the basis of property set
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function actBusinessJobHelp($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_guide_business_job_help(
							bus_job_help_id,
							bus_job_help_code,
							bus_job_help_title,
							bus_job_help_text)
							VALUES(";
				$Sql .= $this->isPropertySet("bus_job_help_id", "V") ? $this->getProperty("bus_job_help_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_job_help_code", "V") ? "'" . $this->getProperty("bus_job_help_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_job_help_title", "V") ? "'" . $this->getProperty("bus_job_help_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_job_help_text", "V") ? "'" . $this->getProperty("bus_job_help_text") . "'" : "NULL";				
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_guide_business_job_help SET ";
				
				if($this->isPropertySet("bus_job_help_code", "K")){
					$Sql .= "$cat bus_job_help_code='" . $this->getProperty("bus_job_help_code") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("bus_job_help_title", "K")){
					$Sql .= "$cat bus_job_help_title='" . $this->getProperty("bus_job_help_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("bus_job_help_text", "K")){
					$Sql .= "$cat bus_job_help_text='" . $this->getProperty("bus_job_help_text") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND bus_job_help_id=" . $this->getProperty("bus_job_help_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_guide_business_job_help 
						 WHERE 1=1";
					$Sql .= " AND bus_job_help_id=" . $this->getProperty("bus_job_help_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform Business Guide Help (Delete/Update/Add)
	* on the table rs_tbl_questions the basis of property set
	* @author Numan Tahir
	*/
	public function actQuestions($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_questions(
							question_id,
							q_name,
							q_email,
							q_business_name,
							q_phone,
							q_website,
							q_about_company,
							q_identify_goal,
							q_purpose_of_site,
							q_time_frame,
							q_willing__spend,
							q_visitor_yur_site,
							q_color_option,
							q_logo_option,
							q_add_features,
							q_links_cop_1,
							q_links_cop_2,
							q_links_cop_3,
							q_links_comm_1,
							q_links_comm_2,
							q_links_comm_3,
							posted_date,
							read_status)
							VALUES(";
				$Sql .= $this->isPropertySet("question_id", "V") ? $this->getProperty("question_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_name", "V") ? "'" . $this->getProperty("q_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_email", "V") ? "'" . $this->getProperty("q_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_business_name", "V") ? "'" . $this->getProperty("q_business_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_phone", "V") ? "'" . $this->getProperty("q_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_website", "V") ? "'" . $this->getProperty("q_website") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_about_company", "V") ? "'" . $this->getProperty("q_about_company") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_identify_goal", "V") ? "'" . $this->getProperty("q_identify_goal") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_purpose_of_site", "V") ? "'" . $this->getProperty("q_purpose_of_site") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_time_frame", "V") ? "'" . $this->getProperty("q_time_frame") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_willing__spend", "V") ? "'" . $this->getProperty("q_willing__spend") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_visitor_yur_site", "V") ? "'" . $this->getProperty("q_visitor_yur_site") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_color_option", "V") ? "'" . $this->getProperty("q_color_option") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_logo_option", "V") ? "'" . $this->getProperty("q_logo_option") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_add_features", "V") ? "'" . $this->getProperty("q_add_features") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_cop_1", "V") ? "'" . $this->getProperty("q_links_cop_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_cop_2", "V") ? "'" . $this->getProperty("q_links_cop_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_cop_3", "V") ? "'" . $this->getProperty("q_links_cop_3") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_comm_1", "V") ? "'" . $this->getProperty("q_links_comm_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_comm_2", "V") ? "'" . $this->getProperty("q_links_comm_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("q_links_comm_3", "V") ? "'" . $this->getProperty("q_links_comm_3") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posted_date", "V") ? "'" . $this->getProperty("posted_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("read_status", "V") ? "'" . $this->getProperty("read_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_questions SET ";
				
				if($this->isPropertySet("read_status", "K")){
					$Sql .= "$cat read_status='" . $this->getProperty("read_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND question_id=" . $this->getProperty("question_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_questions 
						 WHERE 1=1";
					$Sql .= " AND question_id=" . $this->getProperty("question_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_skills the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actFeedback($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_feedback(
							feedback_id,
							customer_id,
							fdb_name,
							fdb_email,
							fdb_subject,
							fdb_message_type,
							fdb_message_box,
							fdb_date,
							fdb_status)
						VALUES(";
				$Sql .= $this->isPropertySet("feedback_id", "V") ? $this->getProperty("feedback_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_name", "V") ? "'" . $this->getProperty("fdb_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_email", "V") ? "'" . $this->getProperty("fdb_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_subject", "V") ? "'" . $this->getProperty("fdb_subject") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_message_type", "V") ? "'" . $this->getProperty("fdb_message_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_message_box", "V") ? "'" . $this->getProperty("fdb_message_box") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_date", "V") ? "'" . $this->getProperty("fdb_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fdb_status", "V") ? "'" . $this->getProperty("fdb_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_feedback SET ";
				
				if($this->isPropertySet("fdb_status", "K")){
					$Sql .= "$cat fdb_status='" . $this->getProperty("fdb_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND feedback_id=" . $this->getProperty("feedback_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_feedback 
						 WHERE 1=1";
				if($this->isPropertySet("feedback_id", "K")){
					$Sql .= " AND feedback_id=" . $this->getProperty("feedback_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_faq the basis of property set
	* @author Numan Tahir
	* @modified by Numan Tahir
	*/
	public function actFaq($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_faq(
							faq_id,
							faq_title,
							faq_answer,
							faq_date,
							faq_status)
						VALUES(";
				$Sql .= $this->isPropertySet("faq_id", "V") ? $this->getProperty("faq_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("faq_title", "V") ? "'" . $this->getProperty("faq_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("faq_answer", "V") ? "'" . $this->getProperty("faq_answer") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("faq_date", "V") ? "'" . $this->getProperty("faq_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("faq_status", "V") ? "'" . $this->getProperty("faq_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_faq SET ";
				
				if($this->isPropertySet("faq_title", "K")){
					$Sql .= "$cat faq_title='" . $this->getProperty("faq_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("faq_answer", "K")){
					$Sql .= "$cat faq_answer='" . $this->getProperty("faq_answer") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("faq_status", "K")){
					$Sql .= "$cat faq_status='" . $this->getProperty("faq_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND faq_id=" . $this->getProperty("faq_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_faq 
						 WHERE 1=1";
				if($this->isPropertySet("faq_id", "K")){
					$Sql .= " AND faq_id=" . $this->getProperty("faq_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_location the basis of property set
	* @author Numan Tahir
	* @modified by Numan Tahir
	*/
	public function actLocation($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_location(
							location_id,
							location_title,
							location_price,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_title", "V") ? "'" . $this->getProperty("location_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_price", "V") ? "'" . $this->getProperty("location_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_location SET ";
				
				if($this->isPropertySet("location_title", "K")){
					$Sql .= "$cat location_title='" . $this->getProperty("location_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("location_price", "K")){
					$Sql .= "$cat location_price='" . $this->getProperty("location_price") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND location_id=" . $this->getProperty("location_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_location 
						 WHERE 1=1";
				if($this->isPropertySet("location_id", "K")){
					$Sql .= " AND location_id=" . $this->getProperty("location_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}

}
?>