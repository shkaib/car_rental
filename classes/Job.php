<?php
/**
*
* This is a class Job
* @version 0.01
* @author Numan Tahir  <numan@elanist.com>
* @Date 29 May, 2013
* @modified 29 May, 2013 by Numan Tahir
*
**/
class Job extends Database{
	/**
	* This is the constructor of the class Ads
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This function is used to list the Jobs
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJob(){
		$Sql = "SELECT 
					job_id,
					customer_id,
					job_title,
					job_description,
					job_industry_id,
					position_id,
					job_post_code,
					job_hours_number,
					job_working_period,
					residential_status_id,
					job_gender,
					job_age,
					job_datetime,
					is_active
				FROM
					rs_tbl_job
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
			
		if($this->isPropertySet("job_search", "V"))
			$Sql .= " AND (LOWER(job_title) LIKE '%" . $this->getProperty("job_search") . "%')";
			
		if($this->isPropertySet("job_industry_id", "V"))
			$Sql .= " AND job_industry_id='" . $this->getProperty("job_industry_id") . "'";
		
		if($this->isPropertySet("position_id", "V"))
			$Sql .= " AND position_id='" . $this->getProperty("position_id") . "'";
		
		if($this->getProperty("job_post_code")!='')
			$Sql .= " AND job_post_code='" . $this->getProperty("job_post_code") ."'";
		
		if($this->getProperty("job_hours_number")!='')
			$Sql .= " AND job_hours_number='" . $this->getProperty("job_hours_number") ."'";
		
		if($this->getProperty("job_working_period")!='')
			$Sql .= " AND job_working_period='" . $this->getProperty("job_working_period") ."'";
		
		if($this->getProperty("residential_status_id")!='')
			$Sql .= " AND residential_status_id='" . $this->getProperty("residential_status_id") ."'";

		if($this->getProperty("job_gender")!='')
			$Sql .= " AND job_gender='" . $this->getProperty("job_gender") ."'";
		
		if($this->getProperty("job_age")!='')
			$Sql .= " AND job_age='" . $this->getProperty("job_age") ."'";
			
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Capacity
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobCapacity(){
		$Sql = "SELECT 
					job_cap_id,
					job_id,
					capacity_id,
					is_active
				FROM
					rs_tbl_job_capacity
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_cap_id", "V"))
			$Sql .= " AND job_cap_id=" . $this->getProperty("job_cap_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("capacity_id", "V"))
			$Sql .= " AND capacity_id='" . $this->getProperty("capacity_id") . "'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Courses
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobCourses(){
		$Sql = "SELECT 
					job_cour_id,
					job_id,
					course_id,
					(SELECT courses_name FROM rs_tbl_courses WHERE courses_id=course_id) AS courses_name,
					is_active
				FROM
					rs_tbl_job_courses
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_cour_id", "V"))
			$Sql .= " AND job_cour_id=" . $this->getProperty("job_cour_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("course_id", "V"))
			$Sql .= " AND course_id='" . $this->getProperty("course_id") . "'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Educations
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobEducations(){
		$Sql = "SELECT 
					job_edu_id,
					job_id,
					edu_name,
					edu_year,
					edu_mask,
					edu_date,
					is_active
				FROM
					rs_tbl_job_educations
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_edu_id", "V"))
			$Sql .= " AND job_edu_id=" . $this->getProperty("job_edu_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("edu_name", "V"))
			$Sql .= " AND edu_name='" . $this->getProperty("edu_name") . "'";
		
		if($this->isPropertySet("edu_year", "V"))
			$Sql .= " AND edu_year='" . $this->getProperty("edu_year") . "'";
		
		if($this->isPropertySet("edu_mask", "V"))
			$Sql .= " AND edu_mask='" . $this->getProperty("edu_mask") . "'";
			
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Hire
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobHire(){
		$Sql = "SELECT 
					job_hire_id,
					job_id,
					employee_id,
					business_id,
					current_status,
					joining_date,
					add_date,
					is_active
				FROM
					rs_tbl_job_hire
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_hire_id", "V"))
			$Sql .= " AND job_hire_id=" . $this->getProperty("job_hire_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id='" . $this->getProperty("employee_id") . "'";
		
		if($this->getProperty("business_id")!='')
			$Sql .= " AND business_id='" . $this->getProperty("business_id") ."'";
		
		if($this->getProperty("current_status")!='')
			$Sql .= " AND current_status='" . $this->getProperty("current_status") ."'";
		
		if($this->getProperty("joining_date")!='')
			$Sql .= " AND joining_date='" . $this->getProperty("joining_date") ."'";
		
		if($this->getProperty("add_date")!='')
			$Sql .= " AND add_date='" . $this->getProperty("add_date") ."'";
			
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";	
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Hours
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobHours(){
		$Sql = "SELECT 
					job_time_id,
					job_id,
					job_day_id,
					job_start_time,
					job_end_time,
					is_active
				FROM
					rs_tbl_job_hours
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_time_id", "V"))
			$Sql .= " AND job_time_id=" . $this->getProperty("job_time_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("job_day_id", "V"))
			$Sql .= " AND job_day_id='" . $this->getProperty("job_day_id") . "'";
		
		if($this->getProperty("job_start_time")!='')
			$Sql .= " AND job_start_time='" . $this->getProperty("job_start_time") ."'";
		
		if($this->getProperty("job_end_time")!='')
			$Sql .= " AND job_end_time='" . $this->getProperty("job_end_time") ."'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Language
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobLanguage(){
		$Sql = "SELECT 
					a.job_lang_id,
					a.job_id,
					a.language_id,
					(SELECT language_name FROM rs_tbl_language WHERE language_id=a.language_id) AS language_name,
					a.lang_status,
					a.is_active
				FROM
					rs_tbl_job_language as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_lang_id", "V"))
			$Sql .= " AND a.job_lang_id=" . $this->getProperty("job_lang_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND a.job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("language_id", "V"))
			$Sql .= " AND a.language_id='" . $this->getProperty("language_id") . "'";
		
		if($this->getProperty("lang_status")!='')
			$Sql .= " AND a.lang_status='" . $this->getProperty("lang_status") ."'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND a.is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Positions
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobPositions(){
		$Sql = "SELECT 
					job_position_id,
					job_id,
					position_id,
					is_active
				FROM
					rs_tbl_job_positions
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_position_id", "V"))
			$Sql .= " AND job_position_id=" . $this->getProperty("job_position_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("position_id", "V"))
			$Sql .= " AND position_id='" . $this->getProperty("position_id") . "'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Job Skills
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function lstJobSkills(){
		$Sql = "SELECT 
					job_skill_id,
					job_id,
					skill_id,
					is_active
				FROM
					rs_tbl_job_skills
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_skill_id", "V"))
			$Sql .= " AND job_skill_id=" . $this->getProperty("job_skill_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
			
		if($this->isPropertySet("skill_id", "V"))
			$Sql .= " AND skill_id='" . $this->getProperty("skill_id") . "'";
		
		if($this->getProperty("is_active")!='')
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/*************************************************************************************/
	/*************************************************************************************/
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJob($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job(
						job_id,
						customer_id,
						job_title,
						job_description,
						job_industry_id,
						position_id,
						job_post_code,
						job_hours_number,
						job_working_period,
						residential_status_id,
						job_gender,
						job_age,
						job_datetime,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_id", "V") ? $this->getProperty("job_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title", "V") ? "'" . $this->getProperty("job_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_description", "V") ? "'" . $this->getProperty("job_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_industry_id", "V") ? "'" . $this->getProperty("job_industry_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("position_id", "V") ? "'" . $this->getProperty("position_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_post_code", "V") ? "'" . $this->getProperty("job_post_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_hours_number", "V") ? "'" . $this->getProperty("job_hours_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_working_period", "V") ? "'" . $this->getProperty("job_working_period") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("residential_status_id", "V") ? "'" . $this->getProperty("residential_status_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_gender", "V") ? "'" . $this->getProperty("job_gender") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_age", "V") ? "'" . $this->getProperty("job_age") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_datetime", "V") ? "'" . $this->getProperty("job_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job SET ";
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_description", "K")){
					$Sql .= "$con job_description='" . $this->getProperty("job_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_industry_id", "K")){
					$Sql .= "$con job_industry_id='" . $this->getProperty("job_industry_id") . "'";
				$con = ",";
				}
				if($this->isPropertySet("position_id", "K")){
					$Sql .= "$con position_id='" . $this->getProperty("position_id") . "'";
				$con = ",";
				}
				if($this->isPropertySet("job_post_code", "K")){
					$Sql .= "$con job_post_code='" . $this->getProperty("job_post_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_hours_number", "K")){
					$Sql .= "$con job_hours_number='" . $this->getProperty("job_hours_number") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("job_hours_number", "K")){
					$Sql .= "$con job_hours_number='" . $this->getProperty("job_hours_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_working_period", "K")){
					$Sql .= "$con job_working_period='" . $this->getProperty("job_working_period") . "'";
					$con = ",";
				}
				if($this->isPropertySet("residential_status_id", "K")){
					$Sql .= "$con residential_status_id='" . $this->getProperty("residential_status_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_gender", "K")){
					$Sql .= "$con job_gender='" . $this->getProperty("job_gender") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_age", "K")){
					$Sql .= "$con job_age='" . $this->getProperty("job_age") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_datetime", "K")){
					$Sql .= "$con job_datetime='" . $this->getProperty("job_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_id=" . $this->getProperty("job_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job WHERE job_id=" . $this->getProperty("job_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_capacity the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobCapacity($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_capacity(
						job_cap_id,
						job_id,
						capacity_id,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_cap_id", "V") ? $this->getProperty("job_cap_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? "'" . $this->getProperty("capacity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_capacity SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("capacity_id", "K")){
					$Sql .= "$con capacity_id='" . $this->getProperty("capacity_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_cap_id=" . $this->getProperty("job_cap_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_capacity WHERE job_cap_id=" . $this->getProperty("job_cap_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_courses the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobCourses($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_courses(
						job_cour_id,
						job_id,
						course_id,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_cour_id", "V") ? $this->getProperty("job_cour_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_id", "V") ? "'" . $this->getProperty("course_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_courses SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("course_id", "K")){
					$Sql .= "$con course_id='" . $this->getProperty("course_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_cour_id=" . $this->getProperty("job_cour_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_courses WHERE job_cour_id=" . $this->getProperty("job_cour_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_educations the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobEducations($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_educations(
						job_edu_id,
						job_id,
						edu_name,
						edu_year,
						edu_mask,
						edu_date,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_edu_id", "V") ? $this->getProperty("job_edu_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_name", "V") ? "'" . $this->getProperty("edu_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_year", "V") ? "'" . $this->getProperty("edu_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_mask", "V") ? "'" . $this->getProperty("edu_mask") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_date", "V") ? "'" . $this->getProperty("edu_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_educations SET ";
				if($this->isPropertySet("edu_name", "K")){
					$Sql .= "$con edu_name='" . $this->getProperty("edu_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("edu_year", "K")){
					$Sql .= "$con edu_year='" . $this->getProperty("edu_year") . "'";
					$con = ",";
				}
				if($this->isPropertySet("edu_mask", "K")){
					$Sql .= "$con edu_mask='" . $this->getProperty("edu_mask") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("job_edu_id", "K")){
					$Sql .= " AND job_edu_id='" . $this->getProperty("job_edu_id") . "'";
				}
				if($this->isPropertySet("job_id", "K")){
					$Sql .= " AND job_id='" . $this->getProperty("job_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_educations WHERE 1=1";
				if($this->isPropertySet("job_edu_id", "K")){
					$Sql .= " AND job_edu_id='" . $this->getProperty("job_edu_id") . "'";
				}
				if($this->isPropertySet("job_id", "K")){
					$Sql .= " AND job_id='" . $this->getProperty("job_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_hire the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobHire($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_hire(
						job_hire_id,
						job_id,
						employee_id,
						business_id,
						current_status,
						joining_date,
						add_date,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_hire_id", "V") ? $this->getProperty("job_hire_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? "'" . $this->getProperty("employee_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("business_id", "V") ? "'" . $this->getProperty("business_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_status", "V") ? "'" . $this->getProperty("current_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joining_date", "V") ? "'" . $this->getProperty("joining_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("add_date", "V") ? "'" . $this->getProperty("add_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_hire SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("employee_id", "K")){
					$Sql .= "$con employee_id='" . $this->getProperty("employee_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("business_id", "K")){
					$Sql .= "$con business_id='" . $this->getProperty("business_id") . "'";
				$con = ",";
				}
				if($this->isPropertySet("current_status", "K")){
					$Sql .= "$con current_status='" . $this->getProperty("current_status") . "'";
				$con = ",";
				}
				if($this->isPropertySet("joining_date", "K")){
					$Sql .= "$con joining_date='" . $this->getProperty("joining_date") . "'";
				$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_hire_id=" . $this->getProperty("job_hire_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_hire WHERE job_hire_id=" . $this->getProperty("job_hire_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_hours the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobHours($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_hours(
						job_time_id,
						job_id,
						job_day_id,
						job_start_time,
						job_end_time,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_time_id", "V") ? $this->getProperty("job_time_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_day_id", "V") ? "'" . $this->getProperty("job_day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_start_time", "V") ? "'" . $this->getProperty("job_start_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_end_time", "V") ? "'" . $this->getProperty("job_end_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_hours SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_day_id", "K")){
					$Sql .= "$con job_day_id='" . $this->getProperty("job_day_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_start_time", "K")){
					$Sql .= "$con job_start_time='" . $this->getProperty("job_start_time") . "'";
				$con = ",";
				}
				if($this->isPropertySet("job_end_time", "K")){
					$Sql .= "$con job_end_time='" . $this->getProperty("job_end_time") . "'";
				$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_time_id=" . $this->getProperty("job_time_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_hours WHERE 1=1";
				if($this->isPropertySet("job_time_id", "K")){
					$Sql .= " AND job_time_id='" . $this->getProperty("job_time_id") . "'";
				$con = ",";
				}
				if($this->isPropertySet("job_id", "K")){
					$Sql .= " AND job_id='" . $this->getProperty("job_id") . "'";
				$con = ",";
				}
				if($this->isPropertySet("job_day_id", "K")){
					$Sql .= " AND job_day_id='" . $this->getProperty("job_day_id") . "'";
				$con = ",";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_language the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobLanguage($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_language(
						job_lang_id,
						job_id,
						language_id,
						lang_status,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_lang_id", "V") ? $this->getProperty("job_lang_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("language_id", "V") ? "'" . $this->getProperty("language_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lang_status", "V") ? "'" . $this->getProperty("lang_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_language SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("language_id", "K")){
					$Sql .= "$con language_id='" . $this->getProperty("language_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("lang_status", "K")){
					$Sql .= "$con lang_status='" . $this->getProperty("lang_status") . "'";
				$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_lang_id=" . $this->getProperty("job_lang_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_language WHERE 1=1";
				
				if($this->isPropertySet("job_lang_id", "K")){
					$Sql .= " AND job_lang_id='" . $this->getProperty("job_lang_id") . "'";
				}
				if($this->isPropertySet("job_id", "K")){
					$Sql .= " AND job_id='" . $this->getProperty("job_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_positions the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobPositions($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_positions(
						job_position_id,
						job_id,
						position_id,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_position_id", "V") ? $this->getProperty("job_position_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("position_id", "V") ? "'" . $this->getProperty("position_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_positions SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("position_id", "K")){
					$Sql .= "$con position_id='" . $this->getProperty("position_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_position_id=" . $this->getProperty("job_position_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_positions WHERE job_position_id=" . $this->getProperty("job_position_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_job_skills the basis of property set
	* @author Numan Tahir
	* @Date 29 May, 2013
	* @modified 29 May, 2013 by Numan Tahir
	*/
	public function actJobSkills($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_skills(
						job_skill_id,
						job_id,
						skill_id,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("job_skill_id", "V") ? $this->getProperty("job_skill_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("skill_id", "V") ? "'" . $this->getProperty("skill_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_skills SET ";
				
				if($this->isPropertySet("job_id", "K")){
					$Sql .= "$con job_id='" . $this->getProperty("job_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("skill_id", "K")){
					$Sql .= "$con skill_id='" . $this->getProperty("skill_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
				$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND job_skill_id=" . $this->getProperty("job_skill_id");
				break;
				
			case "D":
				$Sql = "DELETE FROM rs_tbl_job_skills 
						WHERE 1=1";
				if($this->isPropertySet("job_skill_id", "K")){
					$Sql .= " AND job_skill_id='" . $this->getProperty("job_skill_id") . "'";
				}
				if($this->isPropertySet("job_id", "K")){
					$Sql .= " AND job_id='" . $this->getProperty("job_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
}
?>