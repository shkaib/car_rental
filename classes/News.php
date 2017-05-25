<?php

/**

*

* This is a class News

* @version 0.01

* @author Numan Tahir  <numan_tahir1@live.com>

* @Date 11 July,2012

* @modified 10 Aug, 2007 by Numan Tahir

*

**/

class News extends Database{

	public function __construct(){

		parent::__construct();
	}

	public function lstNews($lang = false){

		$Sql = "SELECT
					news_id,
					customer_id,
					language_id,
					title,
					short,
					details,
					news_date,
					news_down_date,
					ordering,
					news_file,
					status
				FROM
					rs_tbl_news
				WHERE
					1=1 ";

		if($lang === true){
			$Sql .= " AND language_id='" . SITE_LANG . "'";
		}

		if($this->isPropertySet("news_id", "V")){
			$Sql .= " AND news_id=" . $this->getProperty("news_id");
		}

		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}



	/**

	* This function is used to perform DML (Delete/Update/Add)

	* on the table rr_tbl_news the basis of property set

	* @author Numan Tahir

	* @Date 25 Dec, 2007

	* @modified 25 Dec, 2007 by Numan Tahir

	*/

	public function actNews($mode){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_news(
						news_id,
						customer_id,
						language_id,
						title,
						short,
						details,
						news_date,
						news_down_date,
						ordering,
						news_file,
						status)
						VALUES(";

				$Sql .= $this->isPropertySet("news_id", "V") ? $this->getProperty("news_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_cd", "V") ? $this->getProperty("user_cd") : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("language_cd", "V") ? "'" . $this->getProperty("language_cd") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("title", "V") ? "'" . $this->getProperty("title") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("short", "V") ? "'" . $this->getProperty("short") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("details", "V") ? "'" . $this->getProperty("details") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("news_date", "V") ? "'" . $this->getProperty("news_date") . "'" : "CURRENT_TIMESTAMP";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("news_down_date", "V") ? "'" . $this->getProperty("news_down_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ordering", "V") ? $this->getProperty("ordering") : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("news_file", "V") ? "'" . $this->getProperty("news_file") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("status", "V") ? "'" . $this->getProperty("status") . "'" : "'Y'";
				$Sql .= ")";
				break;

			case "U":
				$Sql = "UPDATE rs_tbl_news SET ";
				if($this->isPropertySet("title", "K")){
					$Sql .= "$con title='" . $this->getProperty("title") . "'";
					$con = ",";
				}

				if($this->isPropertySet("short", "K")){
					$Sql .= "$con short='" . $this->getProperty("short") . "'";
					$con = ",";
				}

				if($this->isPropertySet("language_id", "K")){
					$Sql .= "$con language_id='" . $this->getProperty("language_id") . "'";
					$con = ",";
				}

				if($this->isPropertySet("details", "K")){
					$Sql .= "$con details='" . $this->getProperty("details") . "'";
					$con = ",";
				}

				if($this->isPropertySet("status", "K")){
					$Sql .= "$con status='" . $this->getProperty("status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				$Sql .= " AND news_id=" . $this->getProperty("news_id");
				break;

			case "D":
				$Sql = "DELETE FROM rs_tbl_news WHERE news_id=" . $this->getProperty("news_id");
				break;

			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
}

?>