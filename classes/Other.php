<?php
/**
*
* This is a class Other
* @version 0.01
* @author Numan Tahir  <numan@elanist.com>
* @Date 28 May, 2013
* @modified 28 May, 2013 by Numan Tahir
*
**/
class Other extends Database{
	/**
	* This is the constructor of the class Other
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This method is used to get the content of site cms
	* @author Numan Tahir
	* @Date 11 July, 2012
	* @modified 11 July, 2012 by Numan Tahir
	*/
	public function getSiteTutorial($sjst_code){
		$sql = "SELECT
					site_tutorial_id,
					tutorial_title,
					tutorial_description,
					tutorial_area_code,
					tutorial_code_name
				FROM
					rs_tbl_site_tutorial
				WHERE
					1=1
					AND tutorial_area_code='" . $sjst_code . "'";
		
		$this->dbQuery($sql);
		$rows = $this->dbFetchArray(1);
		return $rows;
	}
	
	/**
	* This method is used to get the Account Packages
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstAccountPackages(){
		$Sql = "SELECT
					package_id,
					package_name,
					package_detail,
					package_price,
					number_of_post,
					package_date,
					is_active
				FROM
					rs_tbl_account_packages
				WHERE
					1=1";
		if($this->isPropertySet("package_id", "V"))
			$Sql .= " AND package_id=" . $this->getProperty("package_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Capacity
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstCapacity(){
		$Sql = "SELECT
					capacity_id,
					capacity_name,
					is_active
				FROM
					rs_tbl_capacity
				WHERE
					1=1";
		if($this->isPropertySet("capacity_id", "V"))
			$Sql .= " AND capacity_id=" . $this->getProperty("capacity_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Certificates
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstCertificates(){
		$Sql = "SELECT
					certificate_id,
					posotion_id,
					certificate_name,
					is_active
				FROM
					rs_tbl_certificates
				WHERE
					1=1";
		if($this->isPropertySet("certificate_id", "V"))
			$Sql .= " AND certificate_id=" . $this->getProperty("certificate_id");
		
		if($this->isPropertySet("posotion_id", "V"))
			$Sql .= " AND posotion_id=" . $this->getProperty("posotion_id");
			
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
	
	/**
	* This method is used to get the Courses
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstCourses(){
		$Sql = "SELECT
					courses_id,
					posotion_id,
					courses_name,
					is_active
				FROM
					rs_tbl_courses
				WHERE
					1=1";
		if($this->isPropertySet("courses_id", "V"))
			$Sql .= " AND courses_id=" . $this->getProperty("courses_id");
		
		if($this->isPropertySet("posotion_id", "V"))
			$Sql .= " AND posotion_id=" . $this->getProperty("posotion_id");
			
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
	
	/**
	* This method is used to get the licenses
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstlicenses(){
		$Sql = "SELECT
					licenses_id,
					posotion_id,
					licenses_name,
					is_active
				FROM
					rs_tbl_licenses
				WHERE
					1=1";
		if($this->isPropertySet("licenses_id", "V"))
			$Sql .= " AND licenses_id=" . $this->getProperty("licenses_id");
		
		if($this->isPropertySet("posotion_id", "V"))
			$Sql .= " AND posotion_id=" . $this->getProperty("posotion_id");
			
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
	
	/**
	* This method is used to get the Industry
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstAcademicInformation(){
		$Sql = "SELECT
					academic_id,
					degree_level,
					is_active
				FROM
					rs_tbl_academic_information
				WHERE
					1=1";
		if($this->isPropertySet("academic_id", "V"))
			$Sql .= " AND academic_id=" . $this->getProperty("academic_id");
		
		if($this->isPropertySet("degree_level", "V"))
			$Sql .= " AND degree_level='" . $this->getProperty("degree_level") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Industry
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstIndustry(){
		$Sql = "SELECT
					industry_id,
					industry_name,
					is_active,
					order_by
				FROM
					rs_tbl_industry
				WHERE
					1=1";
		if($this->isPropertySet("industry_id", "V"))
			$Sql .= " AND industry_id=" . $this->getProperty("industry_id");
		
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
	
	/**
	* This method is used to get the Posotion
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstPosotion(){
		$Sql = "SELECT
					a.position_id,
					a.position_name,
					a.indestry_id,
					(SELECT industry_name FROM rs_tbl_industry WHERE industry_id=a.indestry_id) as industry_name,
					a.is_active
				FROM
					rs_tbl_posotion as a
				WHERE
					1=1";
		if($this->isPropertySet("position_id", "V"))
			$Sql .= " AND a.position_id=" . $this->getProperty("position_id");
		
		if($this->isPropertySet("indestry_id", "V"))
			$Sql .= " AND a.indestry_id=" . $this->getProperty("indestry_id");
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Residentials
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstResidentials(){
		$Sql = "SELECT
					residential_id,
					country_id,
					residential_area,
					is_active
				FROM
					rs_tbl_residentials
				WHERE
					1=1";
		if($this->isPropertySet("residential_id", "V"))
			$Sql .= " AND residential_id=" . $this->getProperty("residential_id");
		
		if($this->isPropertySet("country_id", "V"))
			$Sql .= " AND country_id=" . $this->getProperty("country_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Language
	* @author Numan Tahir
	* @Date 05 June, 2013
	* @modified 05 June, 2013 by Numan Tahir
	*/
	public function lstLanguage(){
		$Sql = "SELECT
					language_id,
					language_name,
					is_active
				FROM
					rs_tbl_language
				WHERE
					1=1";
		if($this->isPropertySet("language_id", "V"))
			$Sql .= " AND language_id=" . $this->getProperty("language_id");
		
		if($this->isPropertySet("search", "V"))
			$Sql .= " AND language_name LIKE '%%%" . $this->getProperty("search")."%%%'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Language
	* @author Numan Tahir
	* @Date 05 June, 2013
	* @modified 05 June, 2013 by Numan Tahir
	*/
	public function lstLanguageSearch(){
		$Sql = "SELECT
					language_id as id,
					language_name as name
				FROM
					rs_tbl_language
				WHERE
					1=1";
		if($this->isPropertySet("language_id", "V"))
			$Sql .= " AND language_id=" . $this->getProperty("language_id");
		
		if($this->isPropertySet("search", "V"))
			$Sql .= " AND language_name LIKE '%%%" . $this->getProperty("search")."%%%'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Working Period
	* @author Numan Tahir
	* @Date 12 June, 2013
	* @modified 12 June, 2013 by Numan Tahir
	*/
	public function lstWorkingPeriod(){
		$Sql = "SELECT
					working_period_id,
					working_period,
					is_active
				FROM
					rs_tbl_working_period
				WHERE
					1=1";
		if($this->isPropertySet("working_period_id", "V"))
			$Sql .= " AND working_period_id=" . $this->getProperty("working_period_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Skill
	* @author Numan Tahir
	* @Date 12 June, 2013
	* @modified 12 June, 2013 by Numan Tahir
	*/
	public function lstSkills(){
		$Sql = "SELECT
					a.skills_id,
					a.posotion_id,
					(SELECT position_name FROM rs_tbl_posotion WHERE position_id=a.posotion_id) AS position_name,
					a.skill_name,
					a.is_active
				FROM
					rs_tbl_skills as a
				WHERE
					1=1";
		if($this->isPropertySet("skills_id", "V"))
			$Sql .= " AND a.skills_id=" . $this->getProperty("skills_id");
		
		if($this->isPropertySet("posotion_id", "V"))
			$Sql .= " AND a.posotion_id=" . $this->getProperty("posotion_id");
			
		if($this->isPropertySet("skill_name", "V"))
			$Sql .= " AND a.skill_name='" . $this->getProperty("skill_name") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
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
	* This method is used to get the Industry
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstInstitute(){
		$Sql = "SELECT
					institute_id,
					institute_name,
					institute_type,
					is_active
				FROM
					rs_tbl_institute
				WHERE
					1=1";
		if($this->isPropertySet("institute_id", "V"))
			$Sql .= " AND institute_id=" . $this->getProperty("institute_id");
		
		if($this->isPropertySet("institute_type", "V"))
			$Sql .= " AND institute_type=" . $this->getProperty("institute_type");
		
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
	
	/**
	* This method is used to get the Study Area
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstStudyArea(){
		$Sql = "SELECT
					study_area_id,
					study_area_name,
					is_active
				FROM
					rs_tbl_study_area
				WHERE
					1=1";
		if($this->isPropertySet("study_area_id", "V"))
			$Sql .= " AND study_area_id=" . $this->getProperty("study_area_id");
		
		if($this->isPropertySet("study_area_name", "V"))
			$Sql .= " AND study_area_name='" . $this->getProperty("study_area_name") . "'";
		
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
	
	/**
	* This method is used to get the Location List
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstLocation(){
		$Sql = "SELECT
					location_id,
					location_name,
					location_date,
					is_active
				FROM
					rs_tbl_location
				WHERE
					1=1";
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("location_name", "V"))
			$Sql .= " AND location_name='" . $this->getProperty("location_name") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Program Type
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstProgramType(){
		$Sql = "SELECT
					program_type_id,
					program_type_name,
					type_id,
					study_area_id,
					program_date,
					is_active
				FROM
					rs_tbl_program_type
				WHERE
					1=1";
		if($this->isPropertySet("program_type_id", "V"))
			$Sql .= " AND program_type_id=" . $this->getProperty("program_type_id");
		
		if($this->isPropertySet("program_type_name", "V"))
			$Sql .= " AND program_type_name='" . $this->getProperty("program_type_name") . "'";
		
		if($this->isPropertySet("type_id", "V"))
			$Sql .= " AND type_id='" . $this->getProperty("type_id") . "'";
			
		if($this->isPropertySet("study_area_id", "V"))
			$Sql .= " AND study_area_id='" . $this->getProperty("study_area_id") . "'";
		
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
	
	/**
	* This method is used to get the Program List
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstProgramList(){
		$Sql = "SELECT
					program_list_id,
					program_type_id,
					program_name,
					is_active
				FROM
					rs_tbl_program_list
				WHERE
					1=1";
		if($this->isPropertySet("program_list_id", "V"))
			$Sql .= " AND program_list_id=" . $this->getProperty("program_list_id");
		
		if($this->isPropertySet("program_type_id", "V"))
			$Sql .= " AND program_type_id='" . $this->getProperty("program_type_id") . "'";
		
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " AND program_name='" . $this->getProperty("program_name") . "'";
			
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
	
	/**
	* This method is used to get the Majors
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstMajors(){
		$Sql = "SELECT
					major_id,
					major_title,
					program_list_id,
					study_area_id,
					university_id,
					is_active
				FROM
					rs_tbl_majors
				WHERE
					1=1";
		if($this->isPropertySet("major_id", "V"))
			$Sql .= " AND major_id=" . $this->getProperty("major_id");
		
		if($this->isPropertySet("major_title", "V"))
			$Sql .= " AND major_title='" . $this->getProperty("major_title") . "'";
		
		if($this->isPropertySet("program_list_id", "V"))
			$Sql .= " AND program_list_id='" . $this->getProperty("program_list_id") . "'";
			
		if($this->isPropertySet("study_area_id", "V"))
			$Sql .= " AND study_area_id='" . $this->getProperty("study_area_id") . "'";
		
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id='" . $this->getProperty("university_id") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Majors Courses
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstMajorsCourses(){
		$Sql = "SELECT
					major_course_id,
					course_name,
					course_code,
					course_units,
					major_id,
					is_active
				FROM
					rs_tbl_majors_courses
				WHERE
					1=1";
		if($this->isPropertySet("major_course_id", "V"))
			$Sql .= " AND major_course_id=" . $this->getProperty("major_course_id");
		
		if($this->isPropertySet("course_name", "V"))
			$Sql .= " AND course_name='" . $this->getProperty("course_name") . "'";
		
		if($this->isPropertySet("course_code", "V"))
			$Sql .= " AND course_code='" . $this->getProperty("course_code") . "'";
			
		if($this->isPropertySet("course_units", "V"))
			$Sql .= " AND course_units='" . $this->getProperty("course_units") . "'";
			
		if($this->isPropertySet("major_id", "V"))
			$Sql .= " AND major_id='" . $this->getProperty("major_id") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Site tutorial
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstSiteTutorial(){
		$Sql = "SELECT
					site_tutorial_id,
					tutorial_title,
					tutorial_description,
					tutorial_area_code,
					tutorial_code_name
				FROM
					rs_tbl_site_tutorial
				WHERE
					1=1";
		if($this->isPropertySet("site_tutorial_id", "V"))
			$Sql .= " AND site_tutorial_id=" . $this->getProperty("site_tutorial_id");
		
		if($this->isPropertySet("tutorial_title", "V"))
			$Sql .= " AND tutorial_title='" . $this->getProperty("tutorial_title") . "'";
		
		if($this->isPropertySet("tutorial_area_code", "V"))
			$Sql .= " AND tutorial_area_code='" . $this->getProperty("tutorial_area_code") . "'";
			
		if($this->isPropertySet("tutorial_code_name", "V"))
			$Sql .= " AND tutorial_code_name='" . $this->getProperty("tutorial_code_name") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Aus Institue List
	* @author Numan Tahir
	* @Date 18 Mar, 2014
	* @modified 18 Mar, 2014 by Numan Tahir
	*/
	public function lstAusInstitue(){
		$Sql = "SELECT
					aus_institute_id,
					institute_name,
					institute_logo
				FROM
					rs_tbl_aus_institute
				WHERE
					1=1";
		if($this->isPropertySet("aus_institute_id", "V"))
			$Sql .= " AND aus_institute_id=" . $this->getProperty("aus_institute_id");
		
		if($this->isPropertySet("institute_name", "V"))
			$Sql .= " AND institute_name='" . $this->getProperty("institute_name") . "'";
		
		if($this->isPropertySet("institute_logo", "V"))
			$Sql .= " AND institute_logo='" . $this->getProperty("institute_logo") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Suburb
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function lstSuburb(){
		$Sql = "SELECT
					suburb_id,
					suburb_title_postcode,
					suburb_title,
					suburb_postcode
				FROM
					rs_tbl_suburb
				WHERE
					1=1";
		if($this->isPropertySet("suburb_id", "V"))
			$Sql .= " AND suburb_id=" . $this->getProperty("suburb_id");
		
		if($this->isPropertySet("suburb_title_postcode", "V"))
			$Sql .= " AND suburb_title_postcode='" . $this->getProperty("suburb_title_postcode") . "'";
		
		if($this->isPropertySet("suburb_title_postcode_search", "V"))
			$Sql .= " AND suburb_title_postcode LIKE '%" . $this->getProperty("suburb_title_postcode_search") . "%'";
		
		if($this->isPropertySet("suburb_title", "V"))
			$Sql .= " AND suburb_title='" . $this->getProperty("suburb_title") . "'";
		
		if($this->isPropertySet("suburb_postcode", "V"))
			$Sql .= " AND suburb_postcode='" . $this->getProperty("suburb_postcode") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the Education Level
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function lstEducationLevel(){
		$Sql = "SELECT
					education_id,
					education_level,
					is_active
				FROM
					rs_tbl_education_level
				WHERE
					1=1";
		if($this->isPropertySet("education_id", "V"))
			$Sql .= " AND education_id=" . $this->getProperty("education_id");
		
		if($this->isPropertySet("education_level", "V"))
			$Sql .= " AND education_level='" . $this->getProperty("education_level") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/*****************************************************************/
	/*****************************************************************/
	/*****************************************************************/
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_account_packages the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actAccountPackages($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_account_packages(
							package_id,
							package_name,
							package_detail,
							package_price,
							number_of_post,
							package_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("package_id", "V") ? $this->getProperty("package_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_name", "V") ? "'" . $this->getProperty("package_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_detail", "V") ? "'" . $this->getProperty("package_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_price", "V") ? "'" . $this->getProperty("package_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("number_of_post", "V") ? "'" . $this->getProperty("number_of_post") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_date", "V") ? "'" . $this->getProperty("package_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_account_packages SET ";
				if($this->isPropertySet("package_name", "K")){
					$Sql .= "$cat package_name='" . $this->getProperty("package_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("package_detail", "K")){
					$Sql .= "$cat package_detail='" . $this->getProperty("package_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("package_price", "K")){
					$Sql .= "$cat package_price='" . $this->getProperty("package_price") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("number_of_post", "K")){
					$Sql .= "$cat number_of_post='" . $this->getProperty("number_of_post") . "'";
					$cat = ",";
				}				
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND package_id=" . $this->getProperty("package_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_account_packages 
						 WHERE 1=1";
				if($this->isPropertySet("package_id", "K")){
					$Sql .= " AND package_id=" . $this->getProperty("package_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_capacity the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actCapacity($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_capacity(
							capacity_id,
							capacity_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? $this->getProperty("capacity_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_name", "V") ? "'" . $this->getProperty("capacity_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_capacity SET ";
				
				if($this->isPropertySet("capacity_name", "K")){
					$Sql .= "$cat capacity_name='" . $this->getProperty("capacity_name") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND capacity_id=" . $this->getProperty("capacity_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_capacity 
						 WHERE 1=1";
				if($this->isPropertySet("capacity_id", "K")){
					$Sql .= " AND capacity_id=" . $this->getProperty("capacity_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_certificates the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actCertificates($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_certificates(
							certificate_id,
							posotion_id,
							certificate_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("certificate_id", "V") ? $this->getProperty("certificate_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posotion_id", "V") ? "'" . $this->getProperty("posotion_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("certificate_name", "V") ? "'" . $this->getProperty("certificate_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_certificates SET ";
				
				if($this->isPropertySet("certificate_name", "K")){
					$Sql .= "$cat certificate_name='" . $this->getProperty("certificate_name") . "'";
					$cat = ",";
				}	
				if($this->isPropertySet("posotion_id", "K")){
					$Sql .= "$cat posotion_id='" . $this->getProperty("posotion_id") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND certificate_id=" . $this->getProperty("certificate_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_certificates 
						 WHERE 1=1";
				if($this->isPropertySet("certificate_id", "K")){
					$Sql .= " AND certificate_id=" . $this->getProperty("certificate_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_courses the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actCourses($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_courses(
							courses_id,
							posotion_id,
							courses_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("courses_id", "V") ? $this->getProperty("courses_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posotion_id", "V") ? "'" . $this->getProperty("posotion_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("courses_name", "V") ? "'" . $this->getProperty("courses_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_courses SET ";
				
				if($this->isPropertySet("courses_name", "K")){
					$Sql .= "$cat courses_name='" . $this->getProperty("courses_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("posotion_id", "K")){
					$Sql .= "$cat posotion_id='" . $this->getProperty("posotion_id") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND courses_id=" . $this->getProperty("courses_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_courses 
						 WHERE 1=1";
				if($this->isPropertySet("courses_id", "K")){
					$Sql .= " AND courses_id=" . $this->getProperty("courses_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_licenses the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actlicenses($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_licenses(
							licenses_id,
							posotion_id,
							licenses_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("licenses_id", "V") ? $this->getProperty("licenses_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posotion_id", "V") ? "'" . $this->getProperty("posotion_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("licenses_name", "V") ? "'" . $this->getProperty("licenses_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_licenses SET ";
				
				if($this->isPropertySet("licenses_name", "K")){
					$Sql .= "$cat licenses_name='" . $this->getProperty("licenses_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("posotion_id", "K")){
					$Sql .= "$cat posotion_id='" . $this->getProperty("posotion_id") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND licenses_id=" . $this->getProperty("licenses_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_licenses 
						 WHERE 1=1";
				if($this->isPropertySet("licenses_id", "K")){
					$Sql .= " AND licenses_id=" . $this->getProperty("licenses_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_capacity the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actAcademicInformation($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_academic_information(
							academic_id,
							degree_level,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("academic_id", "V") ? $this->getProperty("academic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("degree_level", "V") ? "'" . $this->getProperty("degree_level") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_academic_information SET ";
				
				if($this->isPropertySet("degree_level", "K")){
					$Sql .= "$cat degree_level='" . $this->getProperty("degree_level") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND academic_id=" . $this->getProperty("academic_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_academic_information 
						 WHERE 1=1";
				if($this->isPropertySet("academic_id", "K")){
					$Sql .= " AND academic_id=" . $this->getProperty("academic_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_industry the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actIndustry($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_industry(
							industry_id,
							industry_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("industry_id", "V") ? $this->getProperty("industry_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_name", "V") ? "'" . $this->getProperty("industry_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_industry SET ";
				
				if($this->isPropertySet("industry_name", "K")){
					$Sql .= "$cat industry_name='" . $this->getProperty("industry_name") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND industry_id=" . $this->getProperty("industry_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_industry 
						 WHERE 1=1";
				if($this->isPropertySet("industry_id", "K")){
					$Sql .= " AND industry_id=" . $this->getProperty("industry_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_posotion the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actPosotion($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_posotion(
							position_id,
							position_name,
							indestry_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("position_id", "V") ? $this->getProperty("position_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("position_name", "V") ? "'" . $this->getProperty("position_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("indestry_id", "V") ? "'" . $this->getProperty("indestry_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_posotion SET ";
				
				if($this->isPropertySet("position_name", "K")){
					$Sql .= "$cat position_name='" . $this->getProperty("position_name") . "'";
					$cat = ",";
				}	
				if($this->isPropertySet("indestry_id", "K")){
					$Sql .= "$cat indestry_id='" . $this->getProperty("indestry_id") . "'";
					$cat = ",";
				}		
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND position_id=" . $this->getProperty("position_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_posotion 
						 WHERE 1=1";
				if($this->isPropertySet("position_id", "K")){
					$Sql .= " AND position_id=" . $this->getProperty("position_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_residentials the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actResidentials($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_residentials(
							residential_id,
							country_id,
							residential_area,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("residential_id", "V") ? $this->getProperty("residential_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("country_id", "V") ? "'" . $this->getProperty("country_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("residential_area", "V") ? "'" . $this->getProperty("residential_area") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_residentials SET ";
				
				if($this->isPropertySet("country_id", "K")){
					$Sql .= "$cat country_id='" . $this->getProperty("country_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("residential_area", "K")){
					$Sql .= "$cat residential_area='" . $this->getProperty("residential_area") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND residential_id=" . $this->getProperty("residential_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_residentials 
						 WHERE 1=1";
				if($this->isPropertySet("residential_id", "K")){
					$Sql .= " AND residential_id=" . $this->getProperty("residential_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_residentials the basis of property set
	* @author Numan Tahir
	* @Date 05 June, 2013
	* @modified 05 June, 2013 by Numan Tahir
	*/
	public function actLanguage($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_language(
							language_id,
							language_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("language_id", "V") ? $this->getProperty("language_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("language_name", "V") ? "'" . $this->getProperty("language_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_language SET ";
				
				if($this->isPropertySet("language_name", "K")){
					$Sql .= "$cat language_name='" . $this->getProperty("language_name") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND language_id=" . $this->getProperty("language_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_language 
						 WHERE 1=1";
				if($this->isPropertySet("language_id", "K")){
					$Sql .= " AND language_id=" . $this->getProperty("language_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_working_period the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actWorkingPeriod($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_working_period(
							working_period_id,
							working_period,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("working_period_id", "V") ? $this->getProperty("working_period_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("working_period", "V") ? "'" . $this->getProperty("working_period") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_working_period SET ";
				
				if($this->isPropertySet("working_period", "K")){
					$Sql .= "$cat working_period='" . $this->getProperty("working_period") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND working_period_id=" . $this->getProperty("working_period_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_working_period 
						 WHERE 1=1";
				if($this->isPropertySet("working_period_id", "K")){
					$Sql .= " AND working_period_id=" . $this->getProperty("working_period_id");
				}
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
	public function actSkills($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_skills(
							skills_id,
							posotion_id,
							skill_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("skills_id", "V") ? $this->getProperty("skills_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posotion_id", "V") ? "'" . $this->getProperty("posotion_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("skill_name", "V") ? "'" . $this->getProperty("skill_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_skills SET ";
				
				if($this->isPropertySet("skill_name", "K")){
					$Sql .= "$cat skill_name='" . $this->getProperty("skill_name") . "'";
					$cat = ",";
				}			
				if($this->isPropertySet("posotion_id", "K")){
					$Sql .= "$cat posotion_id='" . $this->getProperty("posotion_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND skills_id=" . $this->getProperty("skills_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_skills 
						 WHERE 1=1";
				if($this->isPropertySet("skills_id", "K")){
					$Sql .= " AND skills_id=" . $this->getProperty("skills_id");
				}
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
	* on the table rs_tbl_institute the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actInstitute($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_institute(
							institute_id,
							institute_name,
							institute_type,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("institute_id", "V") ? $this->getProperty("institute_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_name", "V") ? "'" . $this->getProperty("institute_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_type", "V") ? "'" . $this->getProperty("institute_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_institute SET ";
				
				if($this->isPropertySet("institute_name", "K")){
					$Sql .= "$cat institute_name='" . $this->getProperty("institute_name") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND institute_id=" . $this->getProperty("institute_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_institute 
						 WHERE 1=1";
				if($this->isPropertySet("institute_id", "K")){
					$Sql .= " AND institute_id=" . $this->getProperty("institute_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_study_area the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actStudyArea($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_study_area(
							study_area_id,
							study_area_name,
							study_area_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("study_area_id", "V") ? $this->getProperty("study_area_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_name", "V") ? "'" . $this->getProperty("study_area_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_date", "V") ? "'" . $this->getProperty("study_area_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_study_area SET ";
				
				if($this->isPropertySet("study_area_name", "K")){
					$Sql .= "$cat study_area_name='" . $this->getProperty("study_area_name") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND study_area_id=" . $this->getProperty("study_area_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_study_area 
						 WHERE 1=1";
				if($this->isPropertySet("study_area_id", "K")){
					$Sql .= " AND study_area_id=" . $this->getProperty("study_area_id");
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
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actLocation($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_location(
							location_id,
							location_name,
							location_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_name", "V") ? "'" . $this->getProperty("location_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_date", "V") ? "'" . $this->getProperty("location_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_location SET ";
				
				if($this->isPropertySet("location_name", "K")){
					$Sql .= "$cat location_name='" . $this->getProperty("location_name") . "'";
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
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_program_type the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actProgramType($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_program_type(
							program_type_id,
							program_type_name,
							type_id,
							study_area_id,
							program_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("program_type_id", "V") ? $this->getProperty("program_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_type_name", "V") ? "'" . $this->getProperty("program_type_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_id", "V") ? "'" . $this->getProperty("type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_id", "V") ? "'" . $this->getProperty("study_area_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_date", "V") ? "'" . $this->getProperty("program_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_program_type SET ";
				
				if($this->isPropertySet("program_type_name", "K")){
					$Sql .= "$cat program_type_name='" . $this->getProperty("program_type_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("type_id", "K")){
					$Sql .= "$cat type_id='" . $this->getProperty("type_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("study_area_id", "K")){
					$Sql .= "$cat study_area_id='" . $this->getProperty("study_area_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND program_type_id=" . $this->getProperty("program_type_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_program_type 
						 WHERE 1=1";
				if($this->isPropertySet("program_type_id", "K")){
					$Sql .= " AND program_type_id=" . $this->getProperty("program_type_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_program_list the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actProgramList($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_program_list(
							program_list_id,
							program_type_id,
							program_name,
							program_date,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("program_list_id", "V") ? $this->getProperty("program_list_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_type_id", "V") ? "'" . $this->getProperty("program_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_name", "V") ? "'" . $this->getProperty("program_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_date", "V") ? "'" . $this->getProperty("program_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_program_list SET ";
				
				if($this->isPropertySet("program_name", "K")){
					$Sql .= "$cat program_name='" . $this->getProperty("program_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND program_list_id=" . $this->getProperty("program_list_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_program_list 
						 WHERE 1=1";
				if($this->isPropertySet("program_list_id", "K")){
					$Sql .= " AND program_list_id=" . $this->getProperty("program_list_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_majors the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actMajors($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_majors(
							major_id,
							major_title,
							program_list_id,
							study_area_id,
							university_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("major_id", "V") ? $this->getProperty("major_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("major_title", "V") ? "'" . $this->getProperty("major_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_list_id", "V") ? "'" . $this->getProperty("program_list_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_id", "V") ? "'" . $this->getProperty("study_area_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("university_id", "V") ? "'" . $this->getProperty("university_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_majors SET ";
				
				if($this->isPropertySet("major_title", "K")){
					$Sql .= "$cat major_title='" . $this->getProperty("major_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND major_id=" . $this->getProperty("major_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_majors 
						 WHERE 1=1";
				if($this->isPropertySet("university_id", "K")){
					$Sql .= " AND university_id=" . $this->getProperty("university_id");
				}
				if($this->isPropertySet("major_id", "K")){
					$Sql .= " AND major_id=" . $this->getProperty("major_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_majors_courses the basis of property set
	* @author Numan Tahir
	* @Date 13 June, 2013
	* @modified 13 June, 2013 by Numan Tahir
	*/
	public function actMajorsCourses($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_majors_courses(
							major_course_id,
							course_name,
							course_code,
							course_units,
							major_id,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("major_course_id", "V") ? $this->getProperty("major_course_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_name", "V") ? "'" . $this->getProperty("course_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_code", "V") ? "'" . $this->getProperty("course_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_units", "V") ? "'" . $this->getProperty("course_units") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("major_id", "V") ? "'" . $this->getProperty("major_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_majors_courses SET ";
				
				if($this->isPropertySet("course_name", "K")){
					$Sql .= "$cat course_name='" . $this->getProperty("course_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND major_course_id=" . $this->getProperty("major_course_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_majors_courses 
						 WHERE 1=1";
				if($this->isPropertySet("major_id", "K")){
					$Sql .= " AND major_id=" . $this->getProperty("major_id");
				}
				if($this->isPropertySet("major_course_id", "K")){
					$Sql .= " AND major_course_id=" . $this->getProperty("major_course_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_site_tutorial the basis of property set
	* @author Numan Tahir
	* @Date 14 March, 2014
	* @modified 14 March, 2014 by Numan Tahir
	*/
	public function actSiteTutorial($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_site_tutorial(
							site_tutorial_id,
							tutorial_title,
							tutorial_description,
							tutorial_area_code,
							tutorial_code_name)
						VALUES(";
				$Sql .= $this->isPropertySet("site_tutorial_id", "V") ? $this->getProperty("site_tutorial_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_title", "V") ? "'" . $this->getProperty("tutorial_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_description", "V") ? "'" . $this->getProperty("tutorial_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_area_code", "V") ? "'" . $this->getProperty("tutorial_area_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tutorial_code_name", "V") ? "'" . $this->getProperty("tutorial_code_name") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_site_tutorial SET ";
				
				if($this->isPropertySet("tutorial_title", "K")){
					$Sql .= "$cat tutorial_title='" . $this->getProperty("tutorial_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tutorial_description", "K")){
					$Sql .= "$cat tutorial_description='" . $this->getProperty("tutorial_description") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("tutorial_area_code", "K")){
					$Sql .= "$cat tutorial_area_code='" . $this->getProperty("tutorial_area_code") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND site_tutorial_id=" . $this->getProperty("site_tutorial_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_site_tutorial 
						 WHERE 1=1";
				if($this->isPropertySet("site_tutorial_id", "K")){
					$Sql .= " AND site_tutorial_id=" . $this->getProperty("site_tutorial_id");
				}
				break;
			default:
				break;
		}
	//	echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_aus_institute the basis of property set
	* @author Numan Tahir
	* @Date 18 March, 2014
	* @modified 18 March, 2014 by Numan Tahir
	*/
	public function actAusInstitue($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aus_institute(
							aus_institute_id,
							institute_name,
							institute_logo)
						VALUES(";
				$Sql .= $this->isPropertySet("aus_institute_id", "V") ? $this->getProperty("aus_institute_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_name", "V") ? "'" . $this->getProperty("institute_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_logo", "V") ? "'" . $this->getProperty("institute_logo") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aus_institute SET ";
				
				if($this->isPropertySet("institute_name", "K")){
					$Sql .= "$cat institute_name='" . $this->getProperty("institute_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("institute_logo", "K")){
					$Sql .= "$cat institute_logo='" . $this->getProperty("institute_logo") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND aus_institute_id=" . $this->getProperty("aus_institute_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_aus_institute 
						 WHERE 1=1";
				if($this->isPropertySet("aus_institute_id", "K")){
					$Sql .= " AND aus_institute_id=" . $this->getProperty("aus_institute_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_suburb the basis of property set
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function actSuburb($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_suburb(
							suburb_id,
							suburb_title_postcode,
							suburb_title,
							suburb_postcode)
						VALUES(";
				$Sql .= $this->isPropertySet("suburb_id", "V") ? $this->getProperty("suburb_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("suburb_title_postcode", "V") ? "'" . $this->getProperty("suburb_title_postcode") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("suburb_title", "V") ? "'" . $this->getProperty("suburb_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("suburb_postcode", "V") ? "'" . $this->getProperty("suburb_postcode") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_suburb SET ";
				
				if($this->isPropertySet("suburb_title_postcode", "K")){
					$Sql .= "$cat suburb_title_postcode='" . $this->getProperty("suburb_title_postcode") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("suburb_title", "K")){
					$Sql .= "$cat suburb_title='" . $this->getProperty("suburb_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("suburb_postcode", "K")){
					$Sql .= "$cat suburb_postcode='" . $this->getProperty("suburb_postcode") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND suburb_id=" . $this->getProperty("suburb_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_suburb 
						 WHERE 1=1";
				if($this->isPropertySet("suburb_id", "K")){
					$Sql .= " AND suburb_id=" . $this->getProperty("suburb_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_education_level the basis of property set
	* @author Numan Tahir
	* @Date 07 April, 2014
	* @modified 07 April, 2014 by Numan Tahir
	*/
	public function actEducationLevel($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_education_level(
							education_id,
							education_level,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("education_id", "V") ? $this->getProperty("education_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("education_level", "V") ? "'" . $this->getProperty("education_level") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_education_level SET ";
				
				if($this->isPropertySet("education_level", "K")){
					$Sql .= "$cat education_level='" . $this->getProperty("education_level") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND education_id=" . $this->getProperty("education_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_education_level 
						 WHERE 1=1";
				if($this->isPropertySet("education_id", "K")){
					$Sql .= " AND education_id=" . $this->getProperty("education_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
}
?>