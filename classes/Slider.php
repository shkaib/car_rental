<?php
/**
*
* This is a class Help
* @version 0.01
* @author Numan Tahir  <numan_tahir1@live.com>
* @Date 10 Aug, 2007
* @modified 10 Aug, 2007 by Numan Tahir
*
**/
class Slider extends Database{
	/**
	* This is the constructor of the class Help
	* @author Numan Tahir
	* @Date 02 Mar, 2011
	* @modified 02 Mar, 2011 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This method is used to get image extension
	* @author Numan Tahir
	* @Date : 11 Mar, 2013
	* @modified : 11 Mar, 2013 by Numan Tahir
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
	* @Date : 11 Mar, 2013
	* @modified : 11 Mar, 2013 by Numan Tahir
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
	
	/**
	* This method is used to Home Slider
	* @author Numan Tahir
	* @Date 11 Mar, 2013
	* @modified 11 Mar, 2013 by Numan Tahir
	*/
	public function lstSlider(){
		$Sql = "SELECT
					slider_id,
					slider_title,
					slider_detail,
					slider_image,
					slider_link,
					slider_status
				FROM
					rs_tbl_site_slider
				WHERE
					1=1";
		if($this->isPropertySet("slider_id", "V"))
			$Sql .= " AND slider_id=" . $this->getProperty("slider_id");
		
		if($this->isPropertySet("slider_status", "V"))
			$Sql .= " AND slider_status='" . $this->getProperty("slider_status") . "'";
		
		if($this->isPropertySet("slider_image", "V"))
			$Sql .= " AND slider_image='" . $this->getProperty("slider_image") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}

	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table rs_tbl_site_slider the basis of property set
	* @author Numan Tahir
	* @Date 11 Mar, 2013
	* @modified 11 Mar, 2013 by Numan Tahir
	*/

	public function actSlider($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_site_slider(
							slider_id,
							slider_title,
							slider_detail,
							slider_image,
							slider_link,
							slider_status)
						VALUES(";
				$Sql .= $this->isPropertySet("slider_id", "V") ? $this->getProperty("slider_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("slider_title", "V") ? "'" . $this->getProperty("slider_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("slider_detail", "V") ? "'" . $this->getProperty("slider_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("slider_image", "V") ? "'" . $this->getProperty("slider_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("slider_link", "V") ? "'" . $this->getProperty("slider_link") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("slider_status", "V") ? "'" . $this->getProperty("slider_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_site_slider SET ";
				if($this->isPropertySet("slider_title", "K")){
					$Sql .= "$cat slider_title='" . $this->getProperty("slider_title") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("slider_detail", "K")){
					$Sql .= "$cat slider_detail='" . $this->getProperty("slider_detail") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("slider_image", "K")){
					$Sql .= "$cat slider_image='" . $this->getProperty("slider_image") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("slider_link", "K")){
					$Sql .= "$cat slider_link='" . $this->getProperty("slider_link") . "'";
					$cat = ",";
				}
				if($this->isPropertySet("slider_status", "K")){
					$Sql .= "$cat slider_status='" . $this->getProperty("slider_status") . "'";
					$cat = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND slider_id=" . $this->getProperty("slider_id");
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_site_slider 
						 WHERE 1=1";
				if($this->isPropertySet("slider_id", "K")){
					$Sql .= " AND slider_id=" . $this->getProperty("slider_id");
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
}

?>