<?php
/**
*
* This is a class University
* @version 0.01
* @author Numan Tahir  <numan_tahir1@live.com>
* @Date 22 October, 2013
* @modified 22 October, 2013 by Numan Tahir
*
**/
class University extends Database{
	/**
	* This is the constructor of the class University
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
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

	public function getImagename($type, $uni_cms_id = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($uni_cms_id != ''){
			$filename = $uni_cms_id.'-'.$filename . '-' . $uni_cms_id . "." . $this->getExtention($type);
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
	* This method is used to get the Quick University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function getUniversity($url_key){
		$sql = "SELECT
					university_id,
					uni_name,
					study_area_id,
					program_type_id,
					program_list_id
					duration,
					commencing,
					units,
					program_code,
					faculty,
					location_id,
					delivery_mode,
					uni_rank,
					prerequisites,
					fees_amount,
					fees_detail,
					how_to_apply,
					enquiries,
					industry_id,
					capacity_id,
					uni_date,
					is_active,
					uni_url_key
				FROM
					rs_tbl_university
				WHERE
					1=1
					AND url_key='" . $url_key . "'";
		
		$this->dbQuery($sql);
		$rows = $this->dbFetchArray(1);
		return $rows;
	}

	/**
	* This method is used to get the University Campus
	* @author Numan Tahir
	* @Date 01 June, 2014
	* @modified 01 June, 2014 by Numan Tahir
	*/
	public function lstUniversityCampus(){
		$Sql = "SELECT
					campus_id,
					university_name,
					campus_name
				FROM
					rs_tbl_university_campus
				WHERE
					1=1";
		if($this->isPropertySet("campus_id", "V"))
			$Sql .= " AND campus_id=" . $this->getProperty("campus_id");
		
		if($this->isPropertySet("university_name", "V"))
			$Sql .= " AND university_name='" . $this->getProperty("university_name") . "'";
		
		if($this->isPropertySet("campus_name", "V"))
			$Sql .= " AND campus_name='" . $this->getProperty("campus_name") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		if($this->isPropertySet("LimitSet", "V"))
			$Sql .= $this->appendLimitSet($this->getProperty("LimitSet"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the About University
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityCMS(){
		$Sql = "SELECT
					uni_cms_id,
					uni_cms_title,
					uni_cms_detail,
					uni_parent_id,
					uni_cms_type_id,
					uni_cms_file,
					uni_cms_date,
					is_active,
					url_key
				FROM
					rs_tbl_university_content
				WHERE
					1=1";
		if($this->isPropertySet("uni_cms_id", "V"))
			$Sql .= " AND uni_cms_id=" . $this->getProperty("uni_cms_id");
		
		if($this->isPropertySet("uni_cms_id_not", "V"))
			$Sql .= " AND uni_cms_id!=" . $this->getProperty("uni_cms_id_not");
		
		if($this->isPropertySet("uni_parent_id", "V"))
			$Sql .= " AND uni_parent_id=" . $this->getProperty("uni_parent_id");
		
		if($this->isPropertySet("uni_cms_type_id", "V"))
			$Sql .= " AND uni_cms_type_id='" . $this->getProperty("uni_cms_type_id") . "'";
		
		if($this->isPropertySet("uni_cms_file", "V"))
			$Sql .= " AND uni_cms_file='" . $this->getProperty("uni_cms_file") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
			
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		if($this->isPropertySet("LimitSet", "V"))
			$Sql .= $this->appendLimitSet($this->getProperty("LimitSet"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversity(){
		$Sql = "SELECT
					university_id,
					uni_name,
					program_name,
					study_area_id,
					duration,
					commencing,
					units,
					program_code,
					program_level,
					faculty,
					location_id,
					delivery_mode,
					entry_requirements,
					uni_rank,
					prerequisites,
					fees_amount,
					fees_detail,
					how_to_apply,
					closing_date,
					enquiries,
					industry_id
					capacity_id,
					uni_type_id,
					uni_date,
					url_key,
					spotlight_status,
					uni_logo,
					is_active,
					why_study,
					op,
					rank,
					on_campus,
					subjects_list,
					uni_url_key,
					campus_id
				FROM
					rs_tbl_university
				WHERE
					1=1";
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id=" . $this->getProperty("university_id");
		
		if($this->isPropertySet("university_id_array", "V"))
			$Sql .= " AND university_id IN (" . $this->getProperty("university_id_array") . ")";
		
		if($this->isPropertySet("uni_name", "V"))
			$Sql .= " AND uni_name='" . $this->getProperty("uni_name") . "'";
		
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " AND program_name='" . $this->getProperty("program_name") . "'";
					
		if($this->isPropertySet("study_area_id", "V"))
			$Sql .= " AND study_area_id='" . $this->getProperty("study_area_id") . "'";
		
		if($this->isPropertySet("duration", "V"))
			$Sql .= " AND duration='" . $this->getProperty("duration") . "'";
			
		if($this->isPropertySet("commencing", "V"))
			$Sql .= " AND commencing='" . $this->getProperty("commencing") . "'";
		
		if($this->isPropertySet("units", "V"))
			$Sql .= " AND units='" . $this->getProperty("units") . "'";
			
		if($this->isPropertySet("program_code", "V"))
			$Sql .= " AND program_code='" . $this->getProperty("program_code") . "'";
			
		if($this->isPropertySet("program_level", "V"))
			$Sql .= " AND program_level='" . $this->getProperty("program_level") . "'";
			
		if($this->isPropertySet("faculty", "V"))
			$Sql .= " AND faculty='" . $this->getProperty("faculty") . "'";
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id='" . $this->getProperty("location_id") . "'";
		
		if($this->isPropertySet("location_id_search", "V"))
			$Sql .= " AND location_id LIKE '%%%" . $this->getProperty("location_id_search") . "%%%'";
		
		if($this->isPropertySet("delivery_mode", "V"))
			$Sql .= " AND delivery_mode='" . $this->getProperty("delivery_mode") . "'";
		
		if($this->isPropertySet("entry_requirements", "V"))
			$Sql .= " AND entry_requirements='" . $this->getProperty("entry_requirements") . "'";
			
		if($this->isPropertySet("uni_rank", "V"))
			$Sql .= " AND uni_rank='" . $this->getProperty("uni_rank") . "'";
			
		if($this->isPropertySet("prerequisites", "V"))
			$Sql .= " AND prerequisites='" . $this->getProperty("prerequisites") . "'";
		
		if($this->isPropertySet("fees_amount", "V"))
			$Sql .= " AND fees_amount='" . $this->getProperty("fees_amount") . "'";
		
		if($this->isPropertySet("fees_detail", "V"))
			$Sql .= " AND fees_detail='" . $this->getProperty("fees_detail") . "'";
		
		if($this->isPropertySet("how_to_apply", "V"))
			$Sql .= " AND how_to_apply='" . $this->getProperty("how_to_apply") . "'";
		
		if($this->isPropertySet("closing_date", "V"))
			$Sql .= " AND closing_date='" . $this->getProperty("closing_date") . "'";
		
		if($this->isPropertySet("enquiries", "V"))
			$Sql .= " AND enquiries='" . $this->getProperty("enquiries") . "'";
			
		if($this->isPropertySet("industry_id", "V"))
			$Sql .= " AND industry_id='" . $this->getProperty("industry_id") . "'";	
		
		if($this->isPropertySet("capacity_id", "V"))
			$Sql .= " AND capacity_id='" . $this->getProperty("capacity_id") . "'";
		
		if($this->isPropertySet("uni_type_id", "V"))
			$Sql .= " AND uni_type_id='" . $this->getProperty("uni_type_id") . "'";	
		
		if($this->isPropertySet("uni_date", "V"))
			$Sql .= " AND uni_date='" . $this->getProperty("uni_date") . "'";	
		
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";	
		
		if($this->isPropertySet("spotlight_status", "V"))
			$Sql .= " AND spotlight_status='" . $this->getProperty("spotlight_status") . "'";	
		
		if($this->isPropertySet("uni_logo", "V"))
			$Sql .= " AND uni_logo='" . $this->getProperty("uni_logo") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";	
		
		if($this->isPropertySet("why_study", "V"))
			$Sql .= " AND why_study='" . $this->getProperty("why_study") . "'";	
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " AND on_campus='" . $this->getProperty("on_campus") . "'";	
			
		if($this->isPropertySet("op", "V"))
			$Sql .= " AND op='" . $this->getProperty("op") . "'";
		
		if($this->isPropertySet("op_start", "V"))
			$Sql .= " OR op>='" . $this->getProperty("op_start") . "'";
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= " OR op<='" . $this->getProperty("op_end") . "'";
		
		if($this->isPropertySet("rank", "V"))
			$Sql .= " OR rank='" . $this->getProperty("rank") . "'";	
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= " OR rank>='" . $this->getProperty("rank_start") . "'";	
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= " OR rank<='" . $this->getProperty("rank_end") . "'";	
		
		/*if($this->isPropertySet("campus_search", "V"))
			$Sql .= " AND (CONVERT(`why_study` USING utf8) LIKE '%". $this->getProperty("campus_search") ."%')";*/
		
		if($this->isPropertySet("location_search", "V"))
			$Sql .= " AND location_id LIKE '%" . $this->getProperty("location_search") . "%'";
			
		if($this->isPropertySet("uni_name_search", "V"))
			$Sql .= " OR uni_name LIKE '%" . $this->getProperty("uni_name_search") . "%'";
			
		if($this->isPropertySet("program_code_like", "V"))
			$Sql .= " OR program_code LIKE '%" . $this->getProperty("program_code_like") . "%'";
		
		if($this->isPropertySet("uni_url_key", "V"))
			$Sql .= " AND uni_url_key='" . $this->getProperty("uni_url_key") . "'";	
							
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		if($this->isPropertySet("limit_2", "V"))
			$Sql .= $this->appendLimitSet($this->getProperty("limit_2"));
//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityOverViewUQ(){
		$Sql = "SELECT
					uq_uni_detail_id,
					uni_id,
					overview_detail,
					overview_type
				FROM
					rs_tbl_university_uq
				WHERE
					1=1";
		if($this->isPropertySet("uq_uni_detail_id", "V"))
			$Sql .= " AND uq_uni_detail_id=" . $this->getProperty("uq_uni_detail_id");
		
		if($this->isPropertySet("uni_id", "V"))
			$Sql .= " AND uni_id='" . $this->getProperty("uni_id") . "'";
				
		if($this->isPropertySet("overview_type", "V"))
			$Sql .= " AND overview_type='" . $this->getProperty("overview_type") . "'";
		
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
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityOverViewGIFF(){
		$Sql = "SELECT
					giff_uni_detail_id,
					uni_id,
					overview_detail,
					overview_type
				FROM
					rs_tbl_university_giff
				WHERE
					1=1";
		if($this->isPropertySet("giff_uni_detail_id", "V"))
			$Sql .= " AND giff_uni_detail_id=" . $this->getProperty("giff_uni_detail_id");
		
		if($this->isPropertySet("uni_id", "V"))
			$Sql .= " AND uni_id='" . $this->getProperty("uni_id") . "'";
				
		if($this->isPropertySet("overview_type", "V"))
			$Sql .= " AND overview_type='" . $this->getProperty("overview_type") . "'";
		
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
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityOverViewBOND(){
		$Sql = "SELECT
					bond_uni_detail_id,
					uni_id,
					overview_detail,
					overview_type
				FROM
					rs_tbl_university_bond
				WHERE
					1=1";
		if($this->isPropertySet("bond_uni_detail_id", "V"))
			$Sql .= " AND bond_uni_detail_id=" . $this->getProperty("bond_uni_detail_id");
		
		if($this->isPropertySet("uni_id", "V"))
			$Sql .= " AND uni_id='" . $this->getProperty("uni_id") . "'";
				
		if($this->isPropertySet("overview_type", "V"))
			$Sql .= " AND overview_type='" . $this->getProperty("overview_type") . "'";
		
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
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityOverViewQUT(){
		$Sql = "SELECT
					qut_uni_detail_id,
					uni_id,
					overview_detail,
					overview_type
				FROM
					rs_tbl_university_qut
				WHERE
					1=1";
		if($this->isPropertySet("qut_uni_detail_id", "V"))
			$Sql .= " AND qut_uni_detail_id=" . $this->getProperty("qut_uni_detail_id");
		
		if($this->isPropertySet("uni_id", "V"))
			$Sql .= " AND uni_id='" . $this->getProperty("uni_id") . "'";
				
		if($this->isPropertySet("overview_type", "V"))
			$Sql .= " AND overview_type='" . $this->getProperty("overview_type") . "'";
		
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
	* This method is used to get the University Search Result
	* @author Numan Tahir
	* @Date 22 March, 2014
	* @modified 27 June, 2014 by Numan Tahir
	*/
	public function lstUniversitySearch(){
		$Sql = "SELECT
					rs_tbl_university.university_id, rs_tbl_university.op, rs_tbl_university.rank, (";
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " + IF(rs_tbl_university.program_name LIKE '%".$this->getProperty("program_name")."%',1,0)";
		
		if($this->isPropertySet("mto_uni_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("university", "V"))
			$Sql .= "rs_tbl_university.uni_name LIKE '%".$this->getProperty("university")."%'";
		
		if($this->isPropertySet("university_1", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_1")."%'";
		
		if($this->isPropertySet("university_2", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_2")."%'";
			
		if($this->isPropertySet("university_3", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_3")."%'";
		
		if($this->isPropertySet("university_4", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_4")."%'";
			
		if($this->isPropertySet("university_5", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_5")."%'";
			
		if($this->isPropertySet("university_6", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_6")."%'";
			
		if($this->isPropertySet("university_7", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_7")."%'";
			
		if($this->isPropertySet("university_8", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_8")."%'";
			
		if($this->isPropertySet("university_9", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_9")."%'";
		
		if($this->isPropertySet("mto_uni_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("mto_loc_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= "rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id")."%'";
		
		if($this->isPropertySet("location_id_1", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_1")."%'";
			
		if($this->isPropertySet("location_id_2", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_2")."%'";
		
		if($this->isPropertySet("location_id_3", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_3")."%'";
			
		if($this->isPropertySet("location_id_4", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_4")."%'";
			
		if($this->isPropertySet("location_id_5", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_5")."%'";
			
		if($this->isPropertySet("location_id_6", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_6")."%'";
			
		if($this->isPropertySet("location_id_7", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_7")."%'";
			
		if($this->isPropertySet("location_id_8", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_8")."%'";
			
		if($this->isPropertySet("location_id_9", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_9")."%'";
		
		if($this->isPropertySet("mto_loc_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("mto_studyarea_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("study_area", "V"))
			$Sql .= "rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area")."%'";
		
		if($this->isPropertySet("study_area_1", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_1")."%'";
			
		if($this->isPropertySet("study_area_2", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_2")."%'";
		
		if($this->isPropertySet("study_area_3", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_3")."%'";
			
		if($this->isPropertySet("study_area_4", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_4")."%'";
			
		if($this->isPropertySet("study_area_5", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_5")."%'";
			
		if($this->isPropertySet("study_area_6", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_6")."%'";
			
		if($this->isPropertySet("study_area_7", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_7")."%'";
			
		if($this->isPropertySet("study_area_8", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_8")."%'";
			
		if($this->isPropertySet("study_area_9", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_9")."%'";
		
		if($this->isPropertySet("mto_studyarea_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " + IF(rs_tbl_university.on_campus='".$this->getProperty("on_campus")."',1,0)";
		
		if($this->isPropertySet("search_uni_text", "V"))
			$Sql .= " + IF(CONCAT(rs_tbl_university.program_name, rs_tbl_university.location_id, rs_tbl_university.program_code, rs_tbl_university.uni_name, rs_tbl_university.subjects_list) LIKE '%".$this->getProperty("search_uni_text")."%',1,0)";	
		
		if($this->isPropertySet("mto_op_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("op_start", "V"))
			$Sql .= "rs_tbl_university.op >=".$this->getProperty("op_start");
			$AddOrConditionOP = " AND ";
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= $AddOrConditionOP."rs_tbl_university.op <=".$this->getProperty("op_end");
		
		if($this->isPropertySet("mto_op_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("mto_rank_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= "rs_tbl_university.rank >=".$this->getProperty("rank_start");
			$AddOrConditionRank = " AND ";
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= $AddOrConditionRank."rs_tbl_university.rank <=".$this->getProperty("rank_end")."";
		
		if($this->isPropertySet("mto_rank_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("study_capacity", "V"))
			$Sql .= " + IF(rs_tbl_university.duration LIKE '%".$this->getProperty("study_capacity")."%',1,0)";	
		
		if($this->isPropertySet("study_capacity_2", "V"))
			$Sql .= " + IF(rs_tbl_university.delivery_mode LIKE '%".$this->getProperty("study_capacity_2")."%',1,0)";	
			
		if($this->isPropertySet("live_option", "V"))
			$Sql .= " + IF(rs_tbl_university.why_study LIKE '%".$this->getProperty("live_option")."%',1,0)";	
		
		if($this->isPropertySet("campus_id", "V"))
			$Sql .= " + IF(rs_tbl_university.campus_id LIKE '%".$this->getProperty("campus_id")."%',1,0)";	
		
		if($this->isPropertySet("mto_subject_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("subject_search", "V"))
			$Sql .= "rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search")."%'";
		
		if($this->isPropertySet("subject_search_1", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_1")."%'";
			
		if($this->isPropertySet("subject_search_2", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_2")."%'";
		
		if($this->isPropertySet("subject_search_3", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_3")."%'";
			
		if($this->isPropertySet("subject_search_4", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_4")."%'";
			
		if($this->isPropertySet("subject_search_5", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_5")."%'";
			
		if($this->isPropertySet("subject_search_6", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_6")."%'";
			
		if($this->isPropertySet("subject_search_7", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_7")."%'";
			
		if($this->isPropertySet("subject_search_8", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_8")."%'";
			
		if($this->isPropertySet("subject_search_9", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_9")."%'";
		
		if($this->isPropertySet("mto_subject_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("totalrows", "V"))
			$Sql .= " )/".$this->getProperty("totalrows")."*100 match_percent";
			
				$Sql .= " FROM
								rs_tbl_university
						INNER JOIN rs_tbl_study_area 
							ON (rs_tbl_university.study_area_id = rs_tbl_study_area.study_area_id)
				WHERE
					1=1";
		
		if($this->isPropertySet("mto_uni_start_2", "V")){
			$Sql .= " AND (";
		}
		
		if($this->isPropertySet("university", "V"))
			$Sql .= " rs_tbl_university.uni_name LIKE '%".$this->getProperty("university")."%'";
		
		if($this->isPropertySet("university_1", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_1")."%'";
		
		if($this->isPropertySet("university_2", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_2")."%'";
			
		if($this->isPropertySet("university_3", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_3")."%'";
			
		if($this->isPropertySet("university_4", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_4")."%'";
			
		if($this->isPropertySet("university_5", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_5")."%'";
			
		if($this->isPropertySet("university_6", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_6")."%'";
			
		if($this->isPropertySet("university_7", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_7")."%'";
			
		if($this->isPropertySet("university_8", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_8")."%'";
			
		if($this->isPropertySet("university_9", "V"))
			$Sql .= " OR rs_tbl_university.uni_name LIKE '%".$this->getProperty("university_9")."%'";
		
		if($this->isPropertySet("mto_uni_end_2", "V")){
			$Sql .= " )";
		}
		
		if($this->isPropertySet("mto_loc_start_2", "V")){
			$Sql .= " AND (";
		}
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id")."%'";
		
		if($this->isPropertySet("location_id_1", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_1")."%'";
			
		if($this->isPropertySet("location_id_2", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_2")."%'";
			
		if($this->isPropertySet("location_id_3", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_3")."%'";
			
		if($this->isPropertySet("location_id_4", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_4")."%'";
			
		if($this->isPropertySet("location_id_5", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_5")."%'";
			
		if($this->isPropertySet("location_id_6", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_6")."%'";
			
		if($this->isPropertySet("location_id_7", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_7")."%'";
			
		if($this->isPropertySet("location_id_8", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_8")."%'";
			
		if($this->isPropertySet("location_id_9", "V"))
			$Sql .= " OR rs_tbl_university.location_id LIKE '%".$this->getProperty("location_id_9")."%'";
		
		if($this->isPropertySet("mto_loc_end_2", "V")){
			$Sql .= " )";
		}
					
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.program_name) AGAINST ('+".$this->getProperty("program_name")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("mto_studyarea_start", "V")){
			$Sql .= " AND (";
		}
		if($this->isPropertySet("study_area", "V"))
			$Sql .= " rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area")."%'";
			//$Sql .= " MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("study_area_1", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_1")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_1")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_2", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_2")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_2")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_3", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_3")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_3")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_4", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_4")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_4")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_5", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_5")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_5")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_6", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_6")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_7", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_7")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_7")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_8", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_8")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_8")."' IN BOOLEAN MODE)";
			
		if($this->isPropertySet("study_area_9", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%%%".$this->getProperty("study_area_9")."%'";
			//$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area_9")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("mto_studyarea_end", "V")){
			$Sql .= " )";
		}
		
		if($this->isPropertySet("mto_subject_start", "V")){
			$Sql .= " AND (";
		}
		if($this->isPropertySet("subject_search", "V"))
			$Sql .= " rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search")."%'";
		
		if($this->isPropertySet("subject_search_1", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_1")."%'";
			
		if($this->isPropertySet("subject_search_2", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_2")."%'";
			
		if($this->isPropertySet("subject_search_3", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_3")."%'";
			
		if($this->isPropertySet("subject_search_4", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_4")."%'";
			
		if($this->isPropertySet("subject_search_5", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_5")."%'";
			
		if($this->isPropertySet("subject_search_6", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_6")."%'";
			
		if($this->isPropertySet("subject_search_7", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_7")."%'";
			
		if($this->isPropertySet("subject_search_8", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_8")."%'";
			
		if($this->isPropertySet("subject_search_9", "V"))
			$Sql .= " OR rs_tbl_university.subjects_list LIKE '%".$this->getProperty("subject_search_9")."%'";
		
		if($this->isPropertySet("mto_subject_end", "V")){
			$Sql .= " )";
		}
		
		if($this->isPropertySet("study_capacity", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.duration) AGAINST ('+".$this->getProperty("study_capacity")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("study_capacity_2", "V"))
			//$Sql .= " OR MATCH (rs_tbl_university.why_study) AGAINST ('+".$this->getProperty("study_capacity_2")."' IN BOOLEAN MODE)";
			$Sql .= " OR MATCH (rs_tbl_university.delivery_mode) AGAINST ('+".$this->getProperty("study_capacity_2")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("campus_id", "V"))
			//$Sql .= " OR MATCH (rs_tbl_university.why_study) AGAINST ('+".$this->getProperty("study_capacity_2")."' IN BOOLEAN MODE)";
			$Sql .= " AND MATCH (rs_tbl_university.campus_id) AGAINST ('+".$this->getProperty("campus_id")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " OR rs_tbl_university.on_campus='".$this->getProperty("on_campus")."'";
		
		if($this->isPropertySet("search_uni_text", "V"))
			$Sql .= " OR CONCAT(rs_tbl_university.program_name, rs_tbl_university.location_id, rs_tbl_university.program_code, rs_tbl_university.uni_name, rs_tbl_university.subjects_list) LIKE '".$this->getProperty("search_uni_text")."%%%'";

		if($this->isPropertySet("op_start", "V"))
			$Sql .= " AND rs_tbl_university.op >='".$this->getProperty("op_start")."'";
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= " AND rs_tbl_university.op <='".$this->getProperty("op_end")."'";
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= " AND rs_tbl_university.rank >='".$this->getProperty("rank_start")."'";
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= " AND rs_tbl_university.rank <='".$this->getProperty("rank_end")."'";
			
		if($this->isPropertySet("program_level", "V"))
			$Sql .= " AND rs_tbl_university.program_level = '".$this->getProperty("program_level")."'";
						
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
	* This method is used to get the University Search Result
	* @author Numan Tahir
	* @Date 22 March, 2014
	* @modified 27 June, 2014 by Numan Tahir
	*/
	public function lstUniversitySearch_3(){
		$Sql = "SELECT
					university_id, op, rank, uni_name, (";
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " + IF(program_name LIKE '%".$this->getProperty("program_name")."%',1,0)";
		
		if($this->isPropertySet("mto_uni_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("university", "V"))
			$Sql .= "uni_name LIKE '%".$this->getProperty("university")."%'";
		
		if($this->isPropertySet("university_1", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_1")."%'";
		
		if($this->isPropertySet("university_2", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_2")."%'";
			
		if($this->isPropertySet("university_3", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_3")."%'";
		
		if($this->isPropertySet("university_4", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_4")."%'";
			
		if($this->isPropertySet("university_5", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_5")."%'";
			
		if($this->isPropertySet("university_6", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_6")."%'";
			
		if($this->isPropertySet("university_7", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_7")."%'";
			
		if($this->isPropertySet("university_8", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_8")."%'";
			
		if($this->isPropertySet("university_9", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_9")."%'";
		
		if($this->isPropertySet("mto_uni_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("mto_loc_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= "location_id LIKE '%".$this->getProperty("location_id")."%'";
		
		if($this->isPropertySet("location_id_1", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_1")."%'";
			
		if($this->isPropertySet("location_id_2", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_2")."%'";
		
		if($this->isPropertySet("location_id_3", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_3")."%'";
			
		if($this->isPropertySet("location_id_4", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_4")."%'";
			
		if($this->isPropertySet("location_id_5", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_5")."%'";
			
		if($this->isPropertySet("location_id_6", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_6")."%'";
			
		if($this->isPropertySet("location_id_7", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_7")."%'";
			
		if($this->isPropertySet("location_id_8", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_8")."%'";
			
		if($this->isPropertySet("location_id_9", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_9")."%'";
		
		if($this->isPropertySet("mto_loc_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		/*if($this->isPropertySet("mto_studyarea_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("study_area", "V"))
			$Sql .= "rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area")."%'";
		
		if($this->isPropertySet("study_area_1", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_1")."%'";
			
		if($this->isPropertySet("study_area_2", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_2")."%'";
		
		if($this->isPropertySet("study_area_3", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_3")."%'";
			
		if($this->isPropertySet("study_area_4", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_4")."%'";
			
		if($this->isPropertySet("study_area_5", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_5")."%'";
			
		if($this->isPropertySet("study_area_6", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_6")."%'";
			
		if($this->isPropertySet("study_area_7", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_7")."%'";
			
		if($this->isPropertySet("study_area_8", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_8")."%'";
			
		if($this->isPropertySet("study_area_9", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_9")."%'";
		
		if($this->isPropertySet("mto_studyarea_end", "V")){
			$Sql .= ",1,0)";	
		}*/
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " + IF(on_campus='".$this->getProperty("on_campus")."',1,0)";
		
		if($this->isPropertySet("search_uni_text", "V"))
			$Sql .= " + IF(CONCAT(program_name, location_id, program_code, uni_name, subjects_list) LIKE '%".$this->getProperty("search_uni_text")."%',1,0)";	
		
		if($this->isPropertySet("mto_op_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("op_start", "V"))
			$Sql .= "op >=".$this->getProperty("op_start");
			$AddOrConditionOP = " AND ";
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= $AddOrConditionOP."op <=".$this->getProperty("op_end");
		
		if($this->isPropertySet("mto_op_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("mto_rank_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= "rank >=".$this->getProperty("rank_start");
			$AddOrConditionRank = " AND ";
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= $AddOrConditionRank."rank <=".$this->getProperty("rank_end")."";
		
		if($this->isPropertySet("mto_rank_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("study_capacity", "V"))
			$Sql .= " + IF(duration LIKE '%".$this->getProperty("study_capacity")."%',1,0)";	
		
		if($this->isPropertySet("study_capacity_2", "V"))
			$Sql .= " + 1";	
			
		if($this->isPropertySet("live_option", "V"))
			$Sql .= " + IF(why_study LIKE '%".$this->getProperty("live_option")."%',1,0)";	
		
		if($this->isPropertySet("mto_subject_start", "V")){
			$Sql .= " + IF(";	
		}
		
		if($this->isPropertySet("subject_search", "V"))
			$Sql .= "subjects_list LIKE '%".$this->getProperty("subject_search")."%'";
		
		if($this->isPropertySet("subject_search_1", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_1")."%'";
			
		if($this->isPropertySet("subject_search_2", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_2")."%'";
		
		if($this->isPropertySet("subject_search_3", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_3")."%'";
			
		if($this->isPropertySet("subject_search_4", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_4")."%'";
			
		if($this->isPropertySet("subject_search_5", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_5")."%'";
			
		if($this->isPropertySet("subject_search_6", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_6")."%'";
			
		if($this->isPropertySet("subject_search_7", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_7")."%'";
			
		if($this->isPropertySet("subject_search_8", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_8")."%'";
			
		if($this->isPropertySet("subject_search_9", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_9")."%'";
		
		if($this->isPropertySet("mto_subject_end", "V")){
			$Sql .= ",1,0)";	
		}
		
		if($this->isPropertySet("totalrows", "V"))
			$Sql .= " )/".$this->getProperty("totalrows")."*100 match_percent";
			
				/*$Sql .= " FROM
								rs_tbl_university
						INNER JOIN rs_tbl_study_area 
							ON (study_area_id = rs_tbl_study_area.study_area_id)
				WHERE
					1=1";*/
				$Sql .= " FROM
								rs_tbl_university
				WHERE
					1=1";
		
		if($this->isPropertySet("mto_uni_start_2", "V")){
			$Sql .= " OR (";
		}
		
		if($this->isPropertySet("university", "V"))
			$Sql .= " uni_name LIKE '%".$this->getProperty("university")."%'";
		
		if($this->isPropertySet("university_1", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_1")."%'";
		
		if($this->isPropertySet("university_2", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_2")."%'";
			
		if($this->isPropertySet("university_3", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_3")."%'";
			
		if($this->isPropertySet("university_4", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_4")."%'";
			
		if($this->isPropertySet("university_5", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_5")."%'";
			
		if($this->isPropertySet("university_6", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_6")."%'";
			
		if($this->isPropertySet("university_7", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_7")."%'";
			
		if($this->isPropertySet("university_8", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_8")."%'";
			
		if($this->isPropertySet("university_9", "V"))
			$Sql .= " OR uni_name LIKE '%".$this->getProperty("university_9")."%'";
		
		if($this->isPropertySet("mto_uni_end_2", "V")){
			$Sql .= " )";
		}
		
		if($this->isPropertySet("mto_loc_start_2", "V")){
			$Sql .= " AND (";
		}
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " location_id LIKE '%".$this->getProperty("location_id")."%'";
		
		if($this->isPropertySet("location_id_1", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_1")."%'";
			
		if($this->isPropertySet("location_id_2", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_2")."%'";
			
		if($this->isPropertySet("location_id_3", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_3")."%'";
			
		if($this->isPropertySet("location_id_4", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_4")."%'";
			
		if($this->isPropertySet("location_id_5", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_5")."%'";
			
		if($this->isPropertySet("location_id_6", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_6")."%'";
			
		if($this->isPropertySet("location_id_7", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_7")."%'";
			
		if($this->isPropertySet("location_id_8", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_8")."%'";
			
		if($this->isPropertySet("location_id_9", "V"))
			$Sql .= " OR location_id LIKE '%".$this->getProperty("location_id_9")."%'";
		
		if($this->isPropertySet("mto_loc_end_2", "V")){
			$Sql .= " )";
		}
					
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " OR MATCH (program_name) AGAINST ('+".$this->getProperty("program_name")."' IN BOOLEAN MODE)";
			
		/*if($this->isPropertySet("mto_studyarea_start", "V")){
			$Sql .= " AND (";
		}
		if($this->isPropertySet("study_area", "V"))
			$Sql .= " rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area")."%'";
		
		if($this->isPropertySet("study_area_1", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_1")."%'";
			
		if($this->isPropertySet("study_area_2", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_2")."%'";
			
		if($this->isPropertySet("study_area_3", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_3")."%'";
			
		if($this->isPropertySet("study_area_4", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_4")."%'";
			
		if($this->isPropertySet("study_area_5", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_5")."%'";
			
		if($this->isPropertySet("study_area_6", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_6")."%'";
			
		if($this->isPropertySet("study_area_7", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_7")."%'";
			
		if($this->isPropertySet("study_area_8", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_8")."%'";
			
		if($this->isPropertySet("study_area_9", "V"))
			$Sql .= " OR rs_tbl_study_area.study_area_name LIKE '%".$this->getProperty("study_area_9")."%'";
		
		if($this->isPropertySet("mto_studyarea_end", "V")){
			$Sql .= " )";
		}*/
		
		if($this->isPropertySet("mto_subject_start", "V")){
			$Sql .= " OR (";
		}
		if($this->isPropertySet("subject_search", "V"))
			$Sql .= " subjects_list LIKE '%".$this->getProperty("subject_search")."%'";
		
		if($this->isPropertySet("subject_search_1", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_1")."%'";
			
		if($this->isPropertySet("subject_search_2", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_2")."%'";
			
		if($this->isPropertySet("subject_search_3", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_3")."%'";
			
		if($this->isPropertySet("subject_search_4", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_4")."%'";
			
		if($this->isPropertySet("subject_search_5", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_5")."%'";
			
		if($this->isPropertySet("subject_search_6", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_6")."%'";
			
		if($this->isPropertySet("subject_search_7", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_7")."%'";
			
		if($this->isPropertySet("subject_search_8", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_8")."%'";
			
		if($this->isPropertySet("subject_search_9", "V"))
			$Sql .= " OR subjects_list LIKE '%".$this->getProperty("subject_search_9")."%'";
		
		if($this->isPropertySet("mto_subject_end", "V")){
			$Sql .= " )";
		}
		
		if($this->isPropertySet("study_capacity", "V"))
			$Sql .= " OR MATCH (duration) AGAINST ('+".$this->getProperty("study_capacity")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("study_capacity_2", "V"))
			$Sql .= " OR MATCH (why_study) AGAINST ('+".$this->getProperty("study_capacity_2")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " OR on_campus='".$this->getProperty("on_campus")."'";
		
		if($this->isPropertySet("search_uni_text", "V"))
			$Sql .= " OR CONCAT(program_name, location_id, program_code, uni_name, subjects_list) LIKE '".$this->getProperty("search_uni_text")."%%%'";

		if($this->isPropertySet("op_start", "V"))
			$Sql .= " AND op >=".$this->getProperty("op_start");
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= " AND op <=".$this->getProperty("op_end");
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= " AND rank >=".$this->getProperty("rank_start");
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= " AND rank <=".$this->getProperty("rank_end");
			
		if($this->isPropertySet("program_level", "V"))
			$Sql .= " AND program_level = '".$this->getProperty("program_level")."'";
						
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
	* This method is used to get the University Detail
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversitySearch_2(){
		$Sql = "SELECT
					*";
			
			$Sql .= " FROM
								rs_tbl_university
						INNER JOIN rs_tbl_study_area 
							ON (rs_tbl_university.study_area_id = rs_tbl_study_area.study_area_id)
						INNER JOIN rs_tbl_majors 
							ON (rs_tbl_university.university_id = rs_tbl_majors.university_id) 
				WHERE
					1=1";
		if($this->isPropertySet("university", "V"))
			//$Sql .= " OR MATCH (rs_tbl_university.uni_name) AGAINST ('+".$this->getProperty("university")."' IN BOOLEAN MODE)";
			$Sql .= " OR rs_tbl_university.uni_name IN ('".$this->getProperty("university")."')";
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.location_id) AGAINST ('+".$this->getProperty("location_id")."' IN BOOLEAN MODE)";
			//$Sql .= " OR rs_tbl_university.location_id IN ('".$this->getProperty("location_id")."')";
			
		if($this->isPropertySet("program_name", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.program_name) AGAINST ('+".$this->getProperty("program_name")."' IN BOOLEAN MODE)";
			//$Sql .= " OR rs_tbl_university.program_name= '".$this->getProperty("program_name")."'";
			
		if($this->isPropertySet("study_area", "V"))
			$Sql .= " OR MATCH (rs_tbl_study_area.study_area_name) AGAINST ('+".$this->getProperty("study_area")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("study_capacity", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.why_study) AGAINST ('+".$this->getProperty("study_capacity")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("study_capacity_2", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.why_study) AGAINST ('+".$this->getProperty("study_capacity_2")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("on_campus", "V"))
			$Sql .= " OR MATCH (rs_tbl_university.on_campus) AGAINST ('+".$this->getProperty("on_campus")."' IN BOOLEAN MODE)";
		
		if($this->isPropertySet("subject_search", "V"))
			$Sql .= " OR MATCH (rs_tbl_majors.major_title) AGAINST ('+".$this->getProperty("subject_search")."' IN BOOLEAN MODE)";
				
		if($this->isPropertySet("op_start", "V"))
			$Sql .= " AND rs_tbl_university.op >=".$this->getProperty("op_start");
		
		if($this->isPropertySet("op_end", "V"))
			$Sql .= " AND rs_tbl_university.op <=".$this->getProperty("op_end");
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= " AND rs_tbl_university.rank >=".$this->getProperty("rank_start");
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= " AND rs_tbl_university.rank <=".$this->getProperty("rank_end");
		
		if($this->isPropertySet("program_level", "V"))
			$Sql .= " AND rs_tbl_university.program_level = '".$this->getProperty("program_level")."'";
						
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
	* This method is used to get the University Course
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityCourse(){
		$Sql = "SELECT
					uni_course_id,
					university_id,
					customer_id,
					category_id,
					course_title,
					course_overview,
					course_fees,
					course_fee_type,
					year_of_offer,
					course_duration,
					course_start_date,
					course_end_date,
					course_campus,
					course_award,
					course_level,
					course_field_of_edu,
					course_job_outlook,
					course_date,
					isactive
				FROM
					rs_tbl_university_course
				WHERE
					1=1";
		if($this->isPropertySet("uni_course_id", "V"))
			$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
		
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id=" . $this->getProperty("university_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("category_id", "V"))
			$Sql .= " AND category_id=" . $this->getProperty("category_id");
		
		if($this->isPropertySet("course_title_search", "V"))
			$Sql .= " AND course_title LIKE '%" . $this->getProperty("course_title_search") . "%'";
		
		if($this->isPropertySet("course_fee_type", "V"))
			$Sql .= " AND course_fee_type='" . $this->getProperty("course_fee_type") . "'";
		
		if($this->isPropertySet("year_of_offer", "V"))
			$Sql .= " AND year_of_offer='" . $this->getProperty("year_of_offer") . "'";
		
		if($this->isPropertySet("course_start_date", "V"))
			$Sql .= " AND course_start_date='" . $this->getProperty("course_start_date") . "'";
			
		if($this->isPropertySet("course_end_date", "V"))
			$Sql .= " AND course_end_date='" . $this->getProperty("course_end_date") . "'";
		
		if($this->isPropertySet("course_campus_search", "V"))
			$Sql .= " AND course_campus LIKE '%" . $this->getProperty("course_campus_search") . "%'";
			
		if($this->isPropertySet("course_level", "V"))
			$Sql .= " AND course_level='" . $this->getProperty("course_level") . "'";
			
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";
			
		if($this->isPropertySet("isactive", "V"))
			$Sql .= " AND isactive='" . $this->getProperty("isactive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Course Category
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityCourseCategory(){
		$Sql = "SELECT
					uni_category_id,
					customer_id,
					category_name,
					category_detail,
					url_key,
					delete_status,
					is_active
				FROM
					rs_tbl_university_coruse_category
				WHERE
					1=1";
		if($this->isPropertySet("uni_category_id", "V"))
			$Sql .= " AND uni_category_id=" . $this->getProperty("uni_category_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("category_name", "V"))
			$Sql .= " AND category_name='" . $this->getProperty("category_name") . "'";
		
		if($this->isPropertySet("category_detail", "V"))
			$Sql .= " AND category_detail='" . $this->getProperty("category_detail") . "'";
		
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";
		
		if($this->isPropertySet("delete_status", "V"))
			$Sql .= " AND delete_status='" . $this->getProperty("delete_status") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the About University
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstLocation(){
		$Sql = "SELECT
					uni_location_id,
					location_name,
					location_type,
					is_active
				FROM
					rs_tbl_university_location
				WHERE
					1=1";
		if($this->isPropertySet("uni_location_id", "V"))
			$Sql .= " AND uni_location_id=" . $this->getProperty("uni_location_id");
		
		if($this->isPropertySet("location_name", "V"))
			$Sql .= " AND location_name='" . $this->getProperty("location_name") . "'";
			
		if($this->isPropertySet("location_type", "V"))
			$Sql .= " AND location_type='" . $this->getProperty("location_type") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the About University
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstOrganization(){
		$Sql = "SELECT
					uni_organization_id,
					organization_name,
					is_active
				FROM
					rs_tbl_university_organization
				WHERE
					1=1";
		if($this->isPropertySet("uni_organization_id", "V"))
			$Sql .= " AND uni_organization_id=" . $this->getProperty("uni_organization_id");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the About University
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityCompare(){
		$Sql = "SELECT
					compare_id,
					university_id,
					compare_title,
					customer_id,
					type_id
				FROM
					rs_tbl_university_compare
				WHERE
					1=1";
		if($this->isPropertySet("compare_id", "V"))
			$Sql .= " AND compare_id=" . $this->getProperty("compare_id");
		
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id='" . $this->getProperty("university_id") . "'";
		
		if($this->isPropertySet("compare_title", "V"))
			$Sql .= " AND compare_title='" . $this->getProperty("compare_title") . "'";
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("type_id", "V"))
			$Sql .= " AND type_id='" . $this->getProperty("type_id") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This method is used to get the University Student Course
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityStudentCourse(){
		$Sql = "SELECT
					uni_course_id,
					university_id,
					customer_id,
					major_id,
					start_date,
					end_date,
					course_grade,
					course_status
				FROM
					rs_tbl_university_student_coruse
				WHERE
					1=1";
		if($this->isPropertySet("uni_course_id", "V"))
			$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
		
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id='" . $this->getProperty("university_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
			
		if($this->isPropertySet("major_id", "V"))
			$Sql .= " AND major_id='" . $this->getProperty("major_id") . "'";
		
		if($this->isPropertySet("start_date", "V"))
			$Sql .= " AND start_date='" . $this->getProperty("start_date") . "'";
		
		if($this->isPropertySet("end_date", "V"))
			$Sql .= " AND end_date='" . $this->getProperty("end_date") . "'";
		
		if($this->isPropertySet("course_grade", "V"))
			$Sql .= " AND course_grade='" . $this->getProperty("course_grade") . "'";
		
		if($this->isPropertySet("course_status", "V"))
			$Sql .= " AND course_status='" . $this->getProperty("course_status") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Customer Save
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function lstUniversityCustomerSave(){
		$Sql = "SELECT
					uni_save_id,
					customer_id,
					op_start,
					op_end,
					rank_start,
					rank_end,
					location_id,
					university_id,
					study_area_id,
					subject_id,
					study_capacity_id,
					study_capacity_id_2,
					campus
				FROM
					rs_tbl_university_customer_save
				WHERE
					1=1";
		if($this->isPropertySet("uni_save_id", "V"))
			$Sql .= " AND uni_save_id=" . $this->getProperty("uni_save_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("op_start", "V"))
			$Sql .= " AND op_start='" . $this->getProperty("op_start") . "'";
			
		if($this->isPropertySet("op_end", "V"))
			$Sql .= " AND op_end='" . $this->getProperty("op_end") . "'";
		
		if($this->isPropertySet("rank_start", "V"))
			$Sql .= " AND rank_start='" . $this->getProperty("rank_start") . "'";
		
		if($this->isPropertySet("rank_end", "V"))
			$Sql .= " AND rank_end='" . $this->getProperty("rank_end") . "'";
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id='" . $this->getProperty("location_id") . "'";
		
		if($this->isPropertySet("university_id", "V"))
			$Sql .= " AND university_id='" . $this->getProperty("university_id") . "'";
		
		if($this->isPropertySet("study_area_id", "V"))
			$Sql .= " AND study_area_id='" . $this->getProperty("study_area_id") . "'";
			
		if($this->isPropertySet("subject_id", "V"))
			$Sql .= " AND subject_id='" . $this->getProperty("subject_id") . "'";
			
		if($this->isPropertySet("study_capacity_id", "V"))
			$Sql .= " AND study_capacity_id='" . $this->getProperty("study_capacity_id") . "'";
		
		if($this->isPropertySet("study_capacity_id_2", "V"))
			$Sql .= " AND study_capacity_id_2='" . $this->getProperty("study_capacity_id_2") . "'";
			
		if($this->isPropertySet("campus", "V"))
			$Sql .= " AND campus='" . $this->getProperty("campus") . "'";
				
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Help
	* @author Numan Tahir
	* @Date 26 March, 2014
	* @modified 26 March, 2014 by Numan Tahir
	*/
	public function lstUniversityHelp(){
		$Sql = "SELECT
					uni_help_id,
					uni_help_code,
					uni_help_title,
					uni_help_detail
				FROM
					rs_tbl_university_help
				WHERE
					1=1";
		if($this->isPropertySet("uni_help_id", "V"))
			$Sql .= " AND uni_help_id=" . $this->getProperty("uni_help_id");
		
		if($this->isPropertySet("uni_help_code", "V"))
			$Sql .= " AND uni_help_code='" . $this->getProperty("uni_help_code") . "'";
		
		if($this->isPropertySet("uni_help_title", "V"))
			$Sql .= " AND uni_help_title='" . $this->getProperty("uni_help_title") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the University Subject
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function lstUniversitySubject(){
		$Sql = "SELECT
					uni_subject_id,
					uni_subject_title
				FROM
					rs_tbl_university_subject
				WHERE
					1=1";
		if($this->isPropertySet("uni_subject_id", "V"))
			$Sql .= " AND uni_subject_id=" . $this->getProperty("uni_subject_id");
		
		if($this->isPropertySet("uni_subject_title", "V"))
			$Sql .= " AND uni_subject_title='" . $this->getProperty("uni_subject_title") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**************************************************************************/
	/**************************************************************************/
	/**************************************************************************/
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityCustomerSave($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_customer_save(
							uni_save_id,
							customer_id,
							op_start,
							op_end,
							rank_start,
							rank_end,
							location_id,
							university_id,
							study_area_id,
							subject_id,
							study_capacity_id,
							study_capacity_id_2,
							campus)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_save_id", "V") ? $this->getProperty("uni_save_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("op_start", "V") ? "'" . $this->getProperty("op_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("op_end", "V") ? "'" . $this->getProperty("op_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rank_start", "V") ? "'" . $this->getProperty("rank_start") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rank_end", "V") ? "'" . $this->getProperty("rank_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("university_id", "V") ? "'" . $this->getProperty("university_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_id", "V") ? "'" . $this->getProperty("study_area_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subject_id", "V") ? "'" . $this->getProperty("subject_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_capacity_id", "V") ? "'" . $this->getProperty("study_capacity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_capacity_id_2", "V") ? "'" . $this->getProperty("study_capacity_id_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("campus", "V") ? "'" . $this->getProperty("campus") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_customer_save SET ";
				
				if($this->isPropertySet("op_start", "K")){
					$Sql .= "$cat op_start='" . $this->getProperty("op_start") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("op_end", "K")){
					$Sql .= "$cat op_end='" . $this->getProperty("op_end") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("rank_start", "K")){
					$Sql .= "$cat rank_start='" . $this->getProperty("rank_start") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("rank_end", "K")){
					$Sql .= "$cat rank_end='" . $this->getProperty("rank_end") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("location_id", "K")){
					$Sql .= "$cat location_id='" . $this->getProperty("location_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("university_id", "K")){
					$Sql .= "$cat university_id='" . $this->getProperty("university_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("study_area_id", "K")){
					$Sql .= "$cat study_area_id='" . $this->getProperty("study_area_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("subject_id", "K")){
					$Sql .= "$cat subject_id='" . $this->getProperty("subject_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("study_capacity_id", "K")){
					$Sql .= "$cat study_capacity_id='" . $this->getProperty("study_capacity_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("study_capacity_id_2", "K")){
					$Sql .= "$cat study_capacity_id_2='" . $this->getProperty("study_capacity_id_2") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("campus", "K")){
					$Sql .= "$cat campus='" . $this->getProperty("campus") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("uni_save_id", "K")){
					$Sql .= " AND uni_save_id=" . $this->getProperty("uni_save_id");
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_customer_save 
						 WHERE 1=1";
				if($this->isPropertySet("uni_save_id", "K")){
					$Sql .= " AND uni_save_id=" . $this->getProperty("uni_save_id");
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityStudentCourse($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_student_coruse(
							uni_course_id,
							university_id,
							customer_id,
							major_id,
							start_date,
							end_date,
							course_grade,
							course_status)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_course_id", "V") ? $this->getProperty("uni_course_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("university_id", "V") ? "'" . $this->getProperty("university_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("major_id", "V") ? "'" . $this->getProperty("major_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_grade", "V") ? "'" . $this->getProperty("course_grade") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_status", "V") ? "'" . $this->getProperty("course_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_student_coruse SET ";
				
				if($this->isPropertySet("start_date", "K")){
					$Sql .= "$cat start_date='" . $this->getProperty("start_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$cat end_date='" . $this->getProperty("end_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_grade", "K")){
					$Sql .= "$cat course_grade='" . $this->getProperty("course_grade") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_status", "K")){
					$Sql .= "$cat course_status='" . $this->getProperty("course_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_student_coruse 
						 WHERE 1=1";
				if($this->isPropertySet("uni_course_id", "K")){
					$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
				}
				if($this->isPropertySet("university_id", "K")){
					$Sql .= " AND university_id=" . $this->getProperty("university_id");
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
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
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityCompare($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_compare(
							compare_id,
							university_id,
							compare_title,
							customer_id,
							type_id)
						VALUES(";
				$Sql .= $this->isPropertySet("compare_id", "V") ? $this->getProperty("compare_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("university_id", "V") ? "'" . $this->getProperty("university_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("compare_title", "V") ? "'" . $this->getProperty("compare_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_id", "V") ? "'" . $this->getProperty("type_id") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_compare 
						 WHERE 1=1";
				if($this->isPropertySet("compare_id", "K")){
					$Sql .= " AND compare_id=" . $this->getProperty("compare_id");
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityCMS($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_content(
							uni_cms_id,
							uni_cms_title,
							uni_cms_detail,
							uni_parent_id,
							uni_cms_type_id,
							uni_cms_file,
							uni_cms_date,
							is_active,
							url_key)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_cms_id", "V") ? $this->getProperty("uni_cms_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_cms_title", "V") ? "'" . $this->getProperty("uni_cms_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_cms_detail", "V") ? "'" . $this->getProperty("uni_cms_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_parent_id", "V") ? "'" . $this->getProperty("uni_parent_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_cms_type_id", "V") ? "'" . $this->getProperty("uni_cms_type_id") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_cms_file", "V") ? "'" . $this->getProperty("uni_cms_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_cms_date", "V") ? "'" . $this->getProperty("uni_cms_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_content SET ";
				
				if($this->isPropertySet("uni_cms_title", "K")){
					$Sql .= "$cat uni_cms_title='" . $this->getProperty("uni_cms_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_cms_detail", "K")){
					$Sql .= "$cat uni_cms_detail='" . $this->getProperty("uni_cms_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_parent_id", "K")){
					$Sql .= "$cat uni_parent_id='" . $this->getProperty("uni_parent_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_cms_type_id", "K")){
					$Sql .= "$cat uni_cms_type_id='" . $this->getProperty("uni_cms_type_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_cms_file", "K")){
					$Sql .= "$cat uni_cms_file='" . $this->getProperty("uni_cms_file") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_cms_id=" . $this->getProperty("uni_cms_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_content 
						 WHERE 1=1";
				if($this->isPropertySet("uni_cms_id", "K")){
					$Sql .= " AND uni_cms_id=" . $this->getProperty("uni_cms_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversity($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university(
						university_id,
						uni_name,
						program_name,
						study_area_id,
						duration,
						commencing,
						units,
						program_code,
						program_level,
						faculty,
						location_id,
						delivery_mode,
						entry_requirements,
						uni_rank,
						prerequisites,
						fees_amount,
						fees_detail,
						how_to_apply,
						closing_date,
						enquiries,
						industry_id,
						capacity_id,
						uni_type_id,
						uni_date,
						url_key,
						spotlight_status,
						uni_logo,
						is_active,
						why_study,
						op,
						rank,
						on_campus,
						subjects_list)
						VALUES(";
				$Sql .= $this->isPropertySet("university_id", "V") ? $this->getProperty("university_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_name", "V") ? "'" . $this->getProperty("uni_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_name", "V") ? "'" . $this->getProperty("program_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("study_area_id", "V") ? "'" . $this->getProperty("study_area_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("duration", "V") ? "'" . $this->getProperty("duration") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("commencing", "V") ? "'" . $this->getProperty("commencing") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("units", "V") ? "'" . $this->getProperty("units") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_code", "V") ? "'" . $this->getProperty("program_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("program_level", "V") ? "'" . $this->getProperty("program_level") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("faculty", "V") ? "'" . $this->getProperty("faculty") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delivery_mode", "V") ? "'" . $this->getProperty("delivery_mode") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entry_requirements", "V") ? "'" . $this->getProperty("entry_requirements") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_rank", "V") ? "'" . $this->getProperty("uni_rank") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prerequisites", "V") ? "'" . $this->getProperty("prerequisites") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fees_amount", "V") ? "'" . $this->getProperty("fees_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fees_detail", "V") ? "'" . $this->getProperty("fees_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("how_to_apply", "V") ? "'" . $this->getProperty("how_to_apply") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("closing_date", "V") ? "'" . $this->getProperty("closing_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enquiries", "V") ? "'" . $this->getProperty("enquiries") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_id", "V") ? "'" . $this->getProperty("industry_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? "'" . $this->getProperty("capacity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_type_id", "V") ? "'" . $this->getProperty("uni_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_date", "V") ? "'" . $this->getProperty("uni_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("spotlight_status", "V") ? "'" . $this->getProperty("spotlight_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_logo", "V") ? "'" . $this->getProperty("uni_logo") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("why_study", "V") ? "'" . $this->getProperty("why_study") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("op", "V") ? "'" . $this->getProperty("op") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rank", "V") ? "'" . $this->getProperty("rank") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("on_campus", "V") ? "'" . $this->getProperty("on_campus") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("subjects_list", "V") ? "'" . $this->getProperty("subjects_list") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university SET ";
				
				if($this->isPropertySet("op", "K")){
					$Sql .= "$cat op='" . $this->getProperty("op") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("rank", "K")){
					$Sql .= "$cat rank='" . $this->getProperty("rank") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("subjects_list", "K")){
					$Sql .= "$cat subjects_list='" . $this->getProperty("subjects_list") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_url_key", "K")){
					$Sql .= "$cat uni_url_key='" . $this->getProperty("uni_url_key") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("why_study", "K")){
					$Sql .= "$cat why_study='" . $this->getProperty("why_study") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("program_code", "K")){
					$Sql .= "$cat program_code='" . $this->getProperty("program_code") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("duration", "K")){
					$Sql .= "$cat duration='" . $this->getProperty("duration") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("closing_date", "K")){
					$Sql .= "$cat closing_date='" . $this->getProperty("closing_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("delivery_mode", "K")){
					$Sql .= "$cat delivery_mode='" . $this->getProperty("delivery_mode") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("faculty", "K")){
					$Sql .= "$cat faculty='" . $this->getProperty("faculty") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("enquiries", "K")){
					$Sql .= "$cat enquiries='" . $this->getProperty("enquiries") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("fees_amount", "K")){
					$Sql .= "$cat fees_amount='" . $this->getProperty("fees_amount") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("fees_detail", "K")){
					$Sql .= "$cat fees_detail='" . $this->getProperty("fees_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("how_to_apply", "K")){
					$Sql .= "$cat how_to_apply='" . $this->getProperty("how_to_apply") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("location_id", "K")){
					$Sql .= "$cat location_id='" . $this->getProperty("location_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("campus_id", "K")){
					$Sql .= "$cat campus_id='" . $this->getProperty("campus_id") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND university_id=" . $this->getProperty("university_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university 
						 WHERE 1=1";
				if($this->isPropertySet("university_id", "K")){
					$Sql .= " AND university_id=" . $this->getProperty("university_id");
				}
				break;
			case "SUI":
				$Sql = "UPDATE rs_tbl_university SET ";
				if($this->isPropertySet("spotlight_status", "K")){
					$Sql .= "$cat spotlight_status='" . $this->getProperty("spotlight_status") . "'";
					$cat = ",";
				}
				break;
			default:
				break;
		}
//ECHO $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_course the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityCourse($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_course(
							uni_course_id,
							university_id,
							customer_id,
							category_id,
							course_title,
							course_overview,
							course_fees,
							course_fee_type,
							year_of_offer,
							course_duration,
							course_start_date,
							course_end_date,
							course_campus,
							course_award,
							course_level,
							course_field_of_edu,
							course_job_outlook,
							course_date,
							url_key,
							isactive)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_course_id", "V") ? $this->getProperty("uni_course_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("university_id", "V") ? "'" . $this->getProperty("university_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_id", "V") ? "'" . $this->getProperty("category_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_title", "V") ? "'" . $this->getProperty("course_title") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_overview", "V") ? "'" . $this->getProperty("course_overview") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_fees", "V") ? "'" . $this->getProperty("course_fees") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_fee_type", "V") ? "'" . $this->getProperty("course_fee_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("year_of_offer", "V") ? "'" . $this->getProperty("year_of_offer") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_duration", "V") ? "'" . $this->getProperty("course_duration") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_start_date", "V") ? "'" . $this->getProperty("course_start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_end_date", "V") ? "'" . $this->getProperty("course_end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_campus", "V") ? "'" . $this->getProperty("course_campus") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_award", "V") ? "'" . $this->getProperty("course_award") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_level", "V") ? "'" . $this->getProperty("course_level") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_field_of_edu", "V") ? "'" . $this->getProperty("course_field_of_edu") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_job_outlook", "V") ? "'" . $this->getProperty("course_job_outlook") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_date", "V") ? "'" . $this->getProperty("course_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isactive", "V") ? "'" . $this->getProperty("isactive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_course SET ";
				
				if($this->isPropertySet("category_id", "K")){
					$Sql .= "$cat category_id='" . $this->getProperty("category_id") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_title", "K")){
					$Sql .= "$cat course_title='" . $this->getProperty("course_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_overview", "K")){
					$Sql .= "$cat course_overview='" . $this->getProperty("course_overview") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_fees", "K")){
					$Sql .= "$cat course_fees='" . $this->getProperty("course_fees") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_fee_type", "K")){
					$Sql .= "$cat course_fee_type='" . $this->getProperty("course_fee_type") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("year_of_offer", "K")){
					$Sql .= "$cat year_of_offer='" . $this->getProperty("year_of_offer") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_duration", "K")){
					$Sql .= "$cat course_duration='" . $this->getProperty("course_duration") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_start_date", "K")){
					$Sql .= "$cat course_start_date='" . $this->getProperty("course_start_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_end_date", "K")){
					$Sql .= "$cat course_end_date='" . $this->getProperty("course_end_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_campus", "K")){
					$Sql .= "$cat course_campus='" . $this->getProperty("course_campus") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("course_award", "K")){
					$Sql .= "$cat course_award='" . $this->getProperty("course_award") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_level", "K")){
					$Sql .= "$cat course_level='" . $this->getProperty("course_level") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_field_of_edu", "K")){
					$Sql .= "$cat course_field_of_edu='" . $this->getProperty("course_field_of_edu") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_job_outlook", "K")){
					$Sql .= "$cat course_job_outlook='" . $this->getProperty("course_job_outlook") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("course_date", "K")){
					$Sql .= "$cat course_date='" . $this->getProperty("course_date") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("isactive", "K")){
					$Sql .= "$cat isactive='" . $this->getProperty("isactive") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_course 
						 WHERE 1=1";
				if($this->isPropertySet("uni_course_id", "K")){
					$Sql .= " AND uni_course_id=" . $this->getProperty("uni_course_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_coruse_category the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actUniversityCourseCategory($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_coruse_category(
							uni_category_id,
							customer_id,
							category_name,
							category_detail,
							url_key,
							delete_status,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_category_id", "V") ? $this->getProperty("uni_category_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_name", "V") ? "'" . $this->getProperty("category_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_detail", "V") ? "'" . $this->getProperty("category_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delete_status", "V") ? "'" . $this->getProperty("delete_status") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_coruse_category SET ";
				
				if($this->isPropertySet("category_name", "K")){
					$Sql .= "$cat category_name='" . $this->getProperty("category_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("category_detail", "K")){
					$Sql .= "$cat category_detail='" . $this->getProperty("category_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("delete_status", "K")){
					$Sql .= "$cat delete_status='" . $this->getProperty("delete_status") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_category_id=" . $this->getProperty("uni_category_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_course 
						 WHERE 1=1";
				if($this->isPropertySet("uni_category_id", "K")){
					$Sql .= " AND uni_category_id=" . $this->getProperty("uni_category_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actLocation($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_location(
							uni_location_id,
							location_name,
							location_type,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_location_id", "V") ? $this->getProperty("uni_location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_name", "V") ? "'" . $this->getProperty("location_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_type", "V") ? "'" . $this->getProperty("location_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_location SET ";
				
				if($this->isPropertySet("location_name", "K")){
					$Sql .= "$cat location_name='" . $this->getProperty("location_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("location_type", "K")){
					$Sql .= "$cat location_type='" . $this->getProperty("location_type") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_location_id=" . $this->getProperty("uni_location_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_location 
						 WHERE 1=1";
				if($this->isPropertySet("uni_location_id", "K")){
					$Sql .= " AND uni_location_id=" . $this->getProperty("uni_location_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university the basis of property set
	* @author Numan Tahir
	* @Date 22 October, 2013
	* @modified 22 October, 2013 by Numan Tahir
	*/
	public function actOrganization($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_organization(
							uni_organization_id,
							organization_name,
							is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_organization_id", "V") ? $this->getProperty("uni_organization_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("organization_name", "V") ? "'" . $this->getProperty("organization_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_organization SET ";
				
				if($this->isPropertySet("organization_name", "K")){
					$Sql .= "$cat organization_name='" . $this->getProperty("organization_name") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$cat is_active='" . $this->getProperty("is_active") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_organization_id=" . $this->getProperty("uni_organization_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_organization 
						 WHERE 1=1";
				if($this->isPropertySet("uni_organization_id", "K")){
					$Sql .= " AND uni_organization_id=" . $this->getProperty("uni_organization_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_help the basis of property set
	* @author Numan Tahir
	* @Date 26 March, 2014
	* @modified 26 March, 2014 by Numan Tahir
	*/
	public function actUniveristyHelp($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_help(
							uni_help_id,
							uni_help_code,
							uni_help_title,
							uni_help_detail)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_help_id", "V") ? $this->getProperty("uni_help_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_help_code", "V") ? "'" . $this->getProperty("uni_help_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_help_title", "V") ? "'" . $this->getProperty("uni_help_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_help_detail", "V") ? "'" . $this->getProperty("uni_help_detail") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_help SET ";
				
				if($this->isPropertySet("uni_help_detail", "K")){
					$Sql .= "$cat uni_help_detail='" . $this->getProperty("uni_help_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("uni_help_title", "K")){
					$Sql .= "$cat uni_help_title='" . $this->getProperty("uni_help_title") . "'";
					$cat = ",";
				}
				
				if($this->isPropertySet("uni_help_code", "K")){
					$Sql .= "$cat uni_help_code='" . $this->getProperty("uni_help_code") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_help_id=" . $this->getProperty("uni_help_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_help 
						 WHERE 1=1";
				if($this->isPropertySet("uni_help_id", "K")){
					$Sql .= " AND uni_help_id=" . $this->getProperty("uni_help_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_subject the basis of property set
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function actUniveristySubject($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_subject(
							uni_subject_id,
							uni_subject_title)
						VALUES(";
				$Sql .= $this->isPropertySet("uni_subject_id", "V") ? $this->getProperty("uni_subject_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_subject_title", "V") ? "'" . $this->getProperty("uni_subject_title") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_subject SET ";
				
				if($this->isPropertySet("uni_subject_title", "K")){
					$Sql .= "$cat uni_subject_title='" . $this->getProperty("uni_subject_title") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				$Sql .= " AND uni_subject_id=" . $this->getProperty("uni_subject_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_subject 
						 WHERE 1=1";
				if($this->isPropertySet("uni_subject_id", "K")){
					$Sql .= " AND uni_subject_id=" . $this->getProperty("uni_subject_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_subject the basis of property set
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function actUniveristyOverViewUQ($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_uq(
							uq_uni_detail_id,
							uni_id,
							overview_detail,
							overview_type)
						VALUES(";
				$Sql .= $this->isPropertySet("uq_uni_detail_id", "V") ? $this->getProperty("uq_uni_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_id", "V") ? "'" . $this->getProperty("uni_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_detail", "V") ? "'" . $this->getProperty("overview_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_type", "V") ? "'" . $this->getProperty("overview_type") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_uq SET ";
				
				if($this->isPropertySet("overview_detail", "K")){
					$Sql .= "$cat overview_detail='" . $this->getProperty("overview_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("overview_type", "K")){
					$Sql .= "$cat overview_type='" . $this->getProperty("overview_type") . "'";
					$cat = ",";
				}

				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("uq_uni_detail_id", "K")){
					$Sql .= " AND uq_uni_detail_id=" . $this->getProperty("uq_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_uq 
						 WHERE 1=1";
				if($this->isPropertySet("uq_uni_detail_id", "K")){
					$Sql .= " AND uq_uni_detail_id=" . $this->getProperty("uq_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_subject the basis of property set
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function actUniveristyOverViewGIFF($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_giff(
							giff_uni_detail_id,
							uni_id,
							overview_detail,
							overview_type)
						VALUES(";
				$Sql .= $this->isPropertySet("giff_uni_detail_id", "V") ? $this->getProperty("giff_uni_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_id", "V") ? "'" . $this->getProperty("uni_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_detail", "V") ? "'" . $this->getProperty("overview_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_type", "V") ? "'" . $this->getProperty("overview_type") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_giff SET ";
				
				if($this->isPropertySet("overview_detail", "K")){
					$Sql .= "$cat overview_detail='" . $this->getProperty("overview_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("overview_type", "K")){
					$Sql .= "$cat overview_type='" . $this->getProperty("overview_type") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("giff_uni_detail_id", "K")){
					$Sql .= " AND giff_uni_detail_id=" . $this->getProperty("giff_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_giff 
						 WHERE 1=1";
				if($this->isPropertySet("giff_uni_detail_id", "K")){
					$Sql .= " AND giff_uni_detail_id=" . $this->getProperty("giff_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_subject the basis of property set
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function actUniveristyOverViewBOND($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_bond(
							bond_uni_detail_id,
							uni_id,
							overview_detail,
							overview_type)
						VALUES(";
				$Sql .= $this->isPropertySet("bond_uni_detail_id", "V") ? $this->getProperty("bond_uni_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_id", "V") ? "'" . $this->getProperty("uni_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_detail", "V") ? "'" . $this->getProperty("overview_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_type", "V") ? "'" . $this->getProperty("overview_type") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_bond SET ";
				
				if($this->isPropertySet("overview_detail", "K")){
					$Sql .= "$cat overview_detail='" . $this->getProperty("overview_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("overview_type", "K")){
					$Sql .= "$cat overview_type='" . $this->getProperty("overview_type") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("bond_uni_detail_id", "K")){
					$Sql .= " AND bond_uni_detail_id=" . $this->getProperty("bond_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_bond 
						 WHERE 1=1";
				if($this->isPropertySet("bond_uni_detail_id", "K")){
					$Sql .= " AND bond_uni_detail_id=" . $this->getProperty("bond_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_university_subject the basis of property set
	* @author Numan Tahir
	* @Date 08 May, 2014
	* @modified 08 May, 2014 by Numan Tahir
	*/
	public function actUniveristyOverViewQUT($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_university_qut(
							qut_uni_detail_id,
							uni_id,
							overview_detail,
							overview_type)
						VALUES(";
				$Sql .= $this->isPropertySet("qut_uni_detail_id", "V") ? $this->getProperty("qut_uni_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("uni_id", "V") ? "'" . $this->getProperty("uni_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_detail", "V") ? "'" . $this->getProperty("overview_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_type", "V") ? "'" . $this->getProperty("overview_type") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_university_qut SET ";
				
				if($this->isPropertySet("overview_detail", "K")){
					$Sql .= "$cat overview_detail='" . $this->getProperty("overview_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("overview_type", "K")){
					$Sql .= "$cat overview_type='" . $this->getProperty("overview_type") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("qut_uni_detail_id", "K")){
					$Sql .= " AND qut_uni_detail_id=" . $this->getProperty("qut_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_university_qut 
						 WHERE 1=1";
				if($this->isPropertySet("qut_uni_detail_id", "K")){
					$Sql .= " AND qut_uni_detail_id=" . $this->getProperty("qut_uni_detail_id");
				}
				if($this->isPropertySet("uni_id", "K")){
					$Sql .= " AND uni_id=" . $this->getProperty("uni_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}

}
?>