<?php
/**
*
* This is a class Newsletter
* @version 0.01
* @author Numan Tahir <numan@elanist.com>
* @Date 30 May, 2013
* @modified 30 May, 2013 by Numan Tahir
*
**/
class Newsletter extends Database{
	/**
	* This is the constructor of the class Newsletter
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	* @Date 10 Aug, 2007
	* @modified 10 Aug, 2007 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
	}
    
	/**
    * This function is used to list the Newsletter
    * @author Numan Tahir
    * @Date 20 Dec, 2007
    * @modified 20 Dec, 2007 by Numan Tahir
    */
    public function lstNewsletter(){
        $Sql = "SELECT 
                    newsletter_id,
                    newsletter_content,
                    number_of_student,
                    start_time,
                    end_time,
					entry_date,
					newsletter_status
                FROM
                    rs_tbl_newsletter 
                WHERE 
                    1=1";
        if($this->isPropertySet("newsletter_id", "V"))
            $Sql .= " AND newsletter_id=" . $this->getProperty("newsletter_id");
        
		if($this->isPropertySet("newsletter_status", "V"))
            $Sql .= " AND newsletter_status='" . $this->getProperty("newsletter_status")."'";
        
        if($this->isPropertySet("limit", "V"))
            $Sql .= $this->appendLimit($this->getProperty("limit"));
        
        $this->dbQuery($Sql);
    }
	
	
	
	/*******************************************************************************/
	/*******************************************************************************/
	/*******************************************************************************/
	
	
	/**
    * This function is used to perform DML (Delete/Update/Add)
    * @author Numan Tahir
    * @Date 20 Dec, 2007
    * @modified 29 Oct, 2010 by Numan Tahir
   */
    public function actNewsletter($mode = "I"){
        $mode = strtoupper($mode);
        switch($mode){
            case "I":
                $Sql = "INSERT INTO rs_tbl_newsletter(
						newsletter_id,
                        newsletter_content,
                        number_of_student,
                        start_time,
                        end_time,
						entry_date,
						newsletter_status) 
                        VALUES(";
                $Sql .= $this->isPropertySet("newsletter_id", "V") ? "'" . $this->getProperty("newsletter_id") . "'" : "NULL";
                $Sql .= ",";
				$Sql .= $this->isPropertySet("newsletter_content", "V") ? "'" . $this->getProperty("newsletter_content") . "'" : "NULL";
                $Sql .= ",";
                $Sql .= $this->isPropertySet("number_of_student", "V") ? "'" . $this->getProperty("number_of_student") . "'" : "NULL";
                $Sql .= ",";
                $Sql .= $this->isPropertySet("start_time", "V") ? "'" . $this->getProperty("start_time") . "'" : "NULL";
                $Sql .= ",";
                $Sql .= $this->isPropertySet("end_time", "V") ? "'" . $this->getProperty("end_time") . "'" : "NULL";  
				$Sql .= ",";
                $Sql .= $this->isPropertySet("entry_date", "V") ? "'" . $this->getProperty("entry_date") . "'" : "NULL";
				$Sql .= ",";
                $Sql .= $this->isPropertySet("newsletter_status", "V") ? "'" . $this->getProperty("newsletter_status") . "'" : "NULL";
                $Sql .= ")";
                break;
            case "U":
                $Sql = "UPDATE rs_tbl_newsletter SET ";
                if($this->isPropertySet("end_time", "K")){
                    $Sql .= "$con end_time='" . $this->getProperty("end_time") . "'";
                    $con = ",";
                }
                if($this->isPropertySet("newsletter_status", "K")){
                    $Sql .= "$con newsletter_status='" . $this->getProperty("newsletter_status") . "'";
                    $con = ",";
                }
                if($this->isPropertySet("number_of_student", "K")){
                    $Sql .= "$con number_of_student='" . $this->getProperty("number_of_student") . "'";
                    $con = ",";
                }
                $Sql .= " WHERE 1=1";
                if($this->isPropertySet("newsletter_id", "V")){
            		$Sql .= " AND newsletter_id='" . $this->getProperty("newsletter_id") . "'";
				}
				
                break;
            case "D":
                $Sql = "DELETE  
							FROM 
								rs_tbl_newsletter 
							WHERE
								1=1";
                
				if($this->isPropertySet("newsletter_id", "V")){
            		$Sql .= " AND newsletter_id='" . $this->getProperty("newsletter_id") . "'";
				}
                break;
            default:
                break;
        }
        return $this->dbQuery($Sql);
    }
	
	
	
	
}
?>