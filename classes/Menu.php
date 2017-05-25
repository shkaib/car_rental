<?php

/**

*

* This is a class Menu

* @version 0.01

* @author Numan Tahir  <numan_tahir1@live.com>

* @Date 10 Aug, 2007

* @modified 10 Aug, 2007 by Numan Tahir

*

**/

class Menu extends Database{

	/*

	* This is the constructor of the class Menu

	* @author Numan Tahir  <numan_tahir1@live.com>

	* @Date 10 Aug, 2007

	* @modified 10 Aug, 2007 by Numan Tahir

	*/

	public function __construct(){

		parent::__construct();

	}



	/*

	* This method is used to list the menus

	* @author Numan Tahir

	* @Date 14 Dec, 2007

	* @modified 14 Dec, 2007 by Numan Tahir

	*/

	function lstMenu(){

		$Sql = "SELECT

					menu_id,

					parent_id,

					menu_title,

					menu_link,

					frm_status

				FROM

					rs_tbl_adminmenu

				WHERE

					1=1";

		if($this->isPropertySet("menu_id", "V"))

			$Sql .= " AND menu_id=" . $this->getProperty("menu_id");

		if($this->isPropertySet("menu_link", "V"))

			$Sql .= " AND menu_link='" . $this->getProperty("menu_link") . "'";

		if($this->isPropertySet("parent_id", "V"))

			$Sql .= " AND parent_id=" . $this->getProperty("parent_id");

		if($this->isPropertySet("Mparent_id", "V"))

			$Sql .= " AND parent_id=0";

		if($this->isPropertySet("frm_status", "V"))

			$Sql .= " AND frm_status=" . $this->getProperty("frm_status");

		//else

		//	$Sql .= " AND frm_status=1";

		

		$Sql .= " ORDER BY 

					menu_order ASC";

		if($this->isPropertySet("menu_title", "V"))

			$Sql .= " AND menu_title='" . $this->getProperty("menu_title") . "'";

		$this->dbQuery($Sql);

	}

}

?>