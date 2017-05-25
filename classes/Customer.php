<?php
/**
*
* This is a class Customer
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
* @Date 14 April, 2013
* @modified 14 April, 2013 by Numan Tahir
*
**/
class Customer extends Database{
	public $customer_login;
	public $customer_id;
	public $email;
	public $fullname;
	public $first_name;
	public $login_time;
	public $customer_type;
	public $eucountries;
	public $ProTmpID;
	public $customerwjid;
	public $workarray;
	public $pro_compl;
	public $bus_id;
	
	/**
	* This is the constructor of the class Customer
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
		$this->eucountries = array(
									'Austria', 'Belgium', 'Bulgaria', 'Cyprus',
									'Czech Republic', 'Denmark', 'Estonia', 'Finland', 
									'France', 'Germany', 'Greece', 'Hungary', 
									'Ireland', 'Italy', 'Latvia', 'Lithuania', 
									'Luxembourg', 'Malta', 'Netherlands', 'Poland', 'Portugal', 
									'Romania', 'Slovakia', 'Slovenia', 'Spain', 
									'Sweden', 'United Kingdom'
								);
		if($_SESSION['customer_login']){
			$this->customer_login 	= $_SESSION['customer_login'];
			$this->customer_id		= $_SESSION['customer_id'];
			$this->email	 		= $_SESSION['email'];
			$this->fullname			= $_SESSION['fullname'];
			$this->login_time		= $_SESSION['login_time'];
			$this->first_name		= $_SESSION['first_name']; 
			$this->customer_type	= $_SESSION['customer_type']; 
			$this->bus_id			= $_SESSION['bus_id']; 
		}
		if($_SESSION['ProTmpID']){
			$this->ProTmpID			= $_SESSION['ProTmpID'];
		}
		if($_SESSION['customerwjid']){
			$this->customerwjid 	= $_SESSION['customerwjid'];
			$this->workarray		= $_SESSION['workarray'];
		}
	}
	
	/**
	* Product::GenTrackingCode()	
	* This function is used to get 11 degit unique Tracking Code
	* @author Numan Tahir
	* @Date 19 June,2013
 	* @param int $mail_id
	* @modified 19 June,2013 by Numan Tahir
	* @return string
	*/
	public function GenTrackingCode($mail_id){
		$mail_id 	= str_pad($mail_id, 5, "0", STR_PAD_LEFT);
		$time 		= md5(time());
		$mail_cd 	= substr($time, rand(0, 22), 6);
		$mail_cd	= $mail_cd . $mail_id;
		return $mail_cd;
	}
	
	/**
	* This is the function to set the customer logged in
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function setLogin(){
		$_SESSION['customer_login'] 	= true;
		
		# Logged in customer's member code
		if($this->isPropertySet("customer_id", "V"))
			$_SESSION['customer_id'] = $this->getProperty("customer_id");
		
		# Logged in customer's email
		if($this->isPropertySet("email", "V"))
			$_SESSION['email'] = $this->getProperty("email");
		
		# Logged in customer's logged in time
		if($this->isPropertySet("login_time", "V"))
			$_SESSION['login_time'] 	= $this->getProperty("login_time");
		
		# Logged in customer's fullname
		if($this->isPropertySet("fullname", "V"))
			$_SESSION['fullname'] = $this->getProperty("fullname");
		
		# Logged in customer's first name
		if($this->isPropertySet("first_name", "V"))
			$_SESSION['first_name'] = $this->getProperty("first_name");
		
		# Logged in customer's Type
		if($this->isPropertySet("customer_type", "V"))
			$_SESSION['customer_type'] = $this->getProperty("customer_type");
			
		# Logged in customer's Business ID
		if($this->isPropertySet("bus_id", "V"))
			$_SESSION['bus_id'] = $this->getProperty("bus_id");
	}
	
	/**
	* This is the function to set the customer logged in
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function setBusinessId(){

		# Logged in customer's member code
		if($this->isPropertySet("bus_id", "V"))
			$_SESSION['bus_id'] = $this->getProperty("bus_id");
	}
	
	/**
	* This is the function to set the customer Work Array in
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function setWorkArray(){
		
		# Customer Work ID
		if($this->isPropertySet("customerwjid", "V"))
			$_SESSION['customerwjid'] = $this->getProperty("customerwjid");
		
		# Work Search Array
		if($this->isPropertySet("workarray", "V"))
			$_SESSION['workarray'] = $this->getProperty("workarray");
		
	}
	
	/**
	* This is the function to set the Customer Profile Complete Statys in
	* @author Numan Tahir
	* @Date 19 Feb, 2014
	* @modified 19 Feb, 2014 by Numan Tahir
	*/
	public function SetProCompl(){
		
		# Customer Profile Status Detail
		if($this->isPropertySet("pro_compl", "V"))
			$_SESSION['pro_compl'] = $this->getProperty("pro_compl");
		
	}
	
	/**
	* This method is used to get image extension
	* @author Numan Tahir
	* @Date : 03 June, 2013
	* @modified : 03 June, 2013 by Numan Tahir
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
	* @Date : 03 June, 2013
	* @modified : 03 June, 2013 by Numan Tahir
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
	* This function is used to check whether the customer has been logged in or not.
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function checkLogin(){
		if($this->customer_login){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	* This function is used to prepare the Month List
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function MonthList($Month_id){
			$MonthList = '';
			if($Month_id==1){
			$MonthList .= '<option value="1" selected>Jan</option>';
			} else {
			$MonthList .= '<option value="1">Jan</option>';
			}
			if($Month_id==2){
			$MonthList .= '<option value="2" selected>Feb</option>';
			} else {
			$MonthList .= '<option value="2">Feb</option>';
			}
			if($Month_id==3){
			$MonthList .= '<option value="3" selected>Mar</option>';
			} else {
			$MonthList .= '<option value="3">Mar</option>';
			}
			if($Month_id==4){
			$MonthList .= '<option value="4" selected>Apr</option>';
			} else {
			$MonthList .= '<option value="4">Apr</option>';
			}
			if($Month_id==5){
			$MonthList .= '<option value="5" selected>May</option>';
			} else {
			$MonthList .= '<option value="5">May</option>';
			}
			if($Month_id==6){
			$MonthList .= '<option value="6" selected>Jun</option>';
			} else {
			$MonthList .= '<option value="6">Jun</option>';
			}
			if($Month_id==7){
			$MonthList .= '<option value="7" selected>Jul</option>';
			} else {
			$MonthList .= '<option value="7">Jul</option>';
			}
			if($Month_id==8){
			$MonthList .= '<option value="8" selected>Aug</option>';
			} else {
			$MonthList .= '<option value="8">Aug</option>';
			}
			if($Month_id==9){
			$MonthList .= '<option value="9" selected>Sep</option>';
			} else {
			$MonthList .= '<option value="9">Sep</option>';
			}
			if($Month_id==10){
			$MonthList .= '<option value="10" selected>Oct</option>';
			} else {
			$MonthList .= '<option value="10">Oct</option>';
			}
			if($Month_id==11){
			$MonthList .= '<option value="11" selected>Nov</option>';
			} else {
			$MonthList .= '<option value="11">Nov</option>';
			}
			if($Month_id==12){
			$MonthList .= '<option value="12" selected>Dec</option>';
			} else {
			$MonthList .= '<option value="12">Dec</option>';
			}
		return $MonthList;	
	}
	
	/**
	* This function is used to prepare the Days List
	* @author Numan Tahir
	* @Date 15 Feb, 2011
	* @modified 15 Feb, 2011 by Numan Tahir
	*/
	public function DayList($Day_id){
			$Day_list = '';
			for($i=1; $i<=31; $i++){
			if($i == $Day_id){
			$Day_list .= '<option value="' . $i . '" selected>' . $i . '</option>';
			} else {
			$Day_list .= '<option value="' . $i . '">' . $i . '</option>';
			}
			}
		return $Day_list;
	}
	
	/**
	* This function is used to prepare the Year List
	* @author Numan Tahir
	* @Date 15 Feb, 2011
	* @modified 15 Feb, 2011 by Numan Tahir
	*/
	public function YearList($Year_id){
			$Year_list = '';
			
			for($y=1905; $y<=2011; $y++){
			if($y == $Year_id){
			$Year_list .= '<option value="' . $y . '" selected>' . $y . '</option>';
			} else {
			$Year_list .= '<option value="' . $y . '">' . $y . '</option>';
			}
			}
		return $Year_list;
	}
	
	/**
	* This function is used to prepare the billing address
	* @author Numan Tahir
	* @Date 24 April, 2013
	* @modified 24 April, 2013 by Numan Tahir
	*/
	public function billingAddress($rows, $name = false){
		$str = '';
		if($name)
			$str .= $rows['fullname'] . '<br />';
		$str .= $rows['address_1'] . ' ' . $rows['postal_zip'] .  '<br />' . 
				$rows['city'] . ', ' . $rows['provience'] . '<br />' . 
				$rows['country_name'] . ',<br />' . 
				'Phone: ' . $rows['day_phone'] . '<br />' . 
				'E-mail: <a href="mailto:' . $rows['email'] . '">' . $rows['email'] . '</a>';
		
		return $str;
	}
	
	/**
	* This function is used to prepare the shipping address
	* @author Numan Tahir
	* @Date 24 April, 2013
	* @modified 24 April, 2013 by Numan Tahir
	*/
	public function shippingAddress($rows, $flag = false){
		$str = '';
		if($flag)
			$str .= $rows['fullname'] . '<br />';
		$str .= $rows['saddress_1'] . ' ' . $rows['spostal_zip'] .  '<br />' . 
				$rows['scity'] . ', ' . $rows['sprovience'] . '<br />' . 
				$rows['scountry_name'];
		
		return $str;
	}
	
	/**
	* This is the function to set the Temp Request Register
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function settmpReg(){
		
		# Register Product ID
		if($this->isPropertySet("ProTmpID", "V"))
			$_SESSION['ProTmpID'] 		= $this->getProperty("ProTmpID");
	}
	
	/**
	* This is the function to set the Temp Request Un-Register
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function UnRegTmp(){
			
		unset($_SESSION['ProTmpID']);
	
	}
	
	public function CheckEmail(){
		$Sql = "SELECT 
					customer_id,
					email,
					customer_type,
					first_name,
					last_name,
					CONCAT(first_name,' ',last_name) AS fullname
				FROM
					rs_tbl_customer
				WHERE 
					1=1";
		if($this->isPropertySet("email", "V"))
			$Sql .= " AND email='" . $this->getProperty("email") . "'";
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check the customer login
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function checkCustomerLogin(){
		$Sql = "SELECT 
					customer_id,
					email,
					pass,
					first_name,
					last_name,
					CONCAT(first_name,' ',last_name) AS fullname,
					is_active,
					customer_type
				FROM
					rs_tbl_customer
				WHERE 
					1=1";
		if($this->isPropertySet("email", "V"))
			$Sql .= " AND email='" . $this->getProperty("email") . "'";
		
		if($this->isPropertySet("customer_type", "V"))
			$Sql .= " AND customer_type=" . $this->getProperty("customer_type");
			
		if($this->isPropertySet("password", "V"))
			$Sql .= " AND pass='" . $this->getProperty("password") . "'";
		
		return $this->dbQuery($Sql);
	}

	/**
	* This function is used to check the member login
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function customerActivate(){
		$Sql = "UPDATE rs_tbl_customer SET
					is_active=1
				WHERE 
					1=1";
					
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to the customers combo
	* @author Numan Tahir
	* @Date 27 April, 2013
	* @modified 27 April, 2013 by Numan Tahir
	*/
	public function customerCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					customer_id,
					CONCAT(first_name, ' ', last_name) as fullname
				FROM
					rs_tbl_customer
				WHERE
					1=1 
					AND is_active=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['customer_id'] == $sel)
				$opt .= "<option value=\"" . $rows['customer_id'] . "\" selected>" . $rows['fullname'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['customer_id'] . "\">" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}	
	
	/**
	* This method is used to the Customers Visitor Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function StudentVisitorCounter($customer_id = ""){
		$opt = "";
		$Sql = "SELECT 
					COUNT(visitor_id) as totalvisitor
				FROM
					rs_tbl_customer_visitor
				WHERE
					1=1 
					AND customer_id=".$customer_id." GROUP BY visitor_id";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalvisitor'] >= 1)
				$opt .= '<div class="round_blue">'.$rows['totalvisitor'].'</div>';
			else
				$opt .= '';
		return $opt;
	}
	
	/**
	* This method is used to the Customers Notifications Counter
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function StudentNotificationCounter($customer_id = ""){
		$opt = "";
		$Sql = "SELECT 
					COUNT(notification_id) as totalnotification
				FROM
					rs_tbl_customer_notifications
				WHERE
					1=1 
					AND customer_id=".$customer_id." AND notification_status=1";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalnotification'] >= 1)
				$opt .= '<div class="round_blue">'.$rows['totalnotification'].'</div>';
			else
				$opt .= '';
		return $opt;
	}
	
	/**
	* This method is used to the Customers Visitor Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function NewEmailCounter($customer_id = ""){
		$opt = "";
		$Sql = "SELECT 
					COUNT(mail_id) as totalmail
				FROM
					rs_tbl_customer_mailbox
				WHERE
					1=1 
					AND to_id=".$customer_id." AND msg_status=1 AND msg_frm_delete=1";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalmail'] >= 1)
				$opt .= '<div class="round_2">'.$rows['totalmail'].'</div>';
			else
				$opt .= '';
		return $opt;
	}
	
	/**
	* This method is used to the Customers Employee Mail Counter
	* @author Numan Tahir
	* @Date 02 April, 2014
	* @modified 02 April, 2014 by Numan Tahir
	*/
	public function NewEmployeeEmailCounter($customer_id = ""){
		$opt = "";
		$Sql = "SELECT 
					COUNT(mail_id) as totalmail
				FROM
					rs_tbl_customer_mailbox
				WHERE
					1=1 
					AND to_id=".$customer_id." AND msg_status=1 AND msg_frm_delete=1";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalmail'] >= 1)
				$opt .= '<div class="round_3">'.$rows['totalmail'].'</div>';
			else
				$opt .= '';
		return $opt;
	}
	
	/**
	* This method is used to the Customers Work Status Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function EmployeeWorkStatusCounter($status_id, $customer_id){
		$opt = "";
		$Sql = "SELECT 
					COUNT(customer_work_id) as totalcount
				FROM
					rs_tbl_customer_work
				WHERE
					1=1 
					AND is_active=".$status_id." AND customer_id=".$customer_id.' GROUP BY customer_id';
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalcount'] != '')
				$opt .= $rows['totalcount'];
			else
				$opt .= 0;
		return $opt;
	}
	
	/**
	* This method is used to the Customers Work Status Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function StudentLookingJobByIndustry($Industry_id){
		$opt = "";
		$Sql = "SELECT 
					COUNT(customer_work_id) as totalcount
				FROM
					rs_tbl_customer_work
				WHERE
					1=1 
					AND customer_type_id=1 AND industry_id=".$Industry_id.' GROUP BY customer_id';
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalcount'] != '')
				$opt .= $rows['totalcount'];
			else
				$opt .= 0;
		return $opt;
	}
	
	/**
	* This method is used to the Customers Work Status Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function StudentLookingJobByPosition($position_id){
		$opt = "";
		$Sql = "SELECT 
					COUNT(customer_work_id) as totalcount
				FROM
					rs_tbl_customer_work
				WHERE
					1=1 
					AND customer_type_id=1 AND position_id=".$position_id.' GROUP BY customer_id';
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalcount'] != '')
				$opt .= $rows['totalcount'];
			else
				$opt .= 0;
		return $opt;
	}
	
	/**
	* This method is used to the Customers Work Status Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function StudentLookingJobByResidential($residential_id){
		$opt = "";
		$Sql = "SELECT 
					COUNT(customer_id) as totalcount
				FROM
					rs_tbl_customer_residential
				WHERE
					1=1 
					AND country_id=".$residential_id.' GROUP BY customer_id';
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalcount'] != '')
				$opt .= $rows['totalcount'];
			else
				$opt .= 0;
		return $opt;
	}
	
	/**
	* This method is used to the Customers Work Status Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function StudentLookingJobByEducation($education_id){
		$opt = "";
		$Sql = "SELECT 
					COUNT(customer_id) as totalcount
				FROM
					rs_tbl_customer_education
				WHERE
					1=1 
					AND academic_id=".$education_id.' GROUP BY customer_id';
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['totalcount'] != '')
				$opt .= $rows['totalcount'];
			else
				$opt .= 0;
		return $opt;
	}
	
	/**
	* This method is used to the Customers Age Counter
	* @author Numan Tahir
	* @Date 11 September, 2013
	* @modified 11 September, 2013 by Numan Tahir
	*/
	public function CustomerAgeCounter($Get_customer_id){
		$CustomerAge = "";
		$Sql = "SELECT 
					customer_id,
					dob
				FROM
					rs_tbl_customer
				WHERE
					1=1 
					AND customer_id=".$Get_customer_id;
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows['dob'] != ''){
				list($dobYear,$dobMonth,$dobDate)= explode('-', $rows['dob']);
				$DOB = $dobMonth.'/'.$dobDate.'/'.$dobYear;
				$birthDate = $DOB;
				//explode the date to get month, day and year
				$birthDate = explode("/", $birthDate);
				//get age from date or birthdate
				$CustomerAge = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
			} else {
				$CustomerAge .= 0;
			}
		return $CustomerAge;
	}
	
	
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomer(){
		$Sql = "SELECT 
					customer_id,
					email,
					pass,
					first_name,
					last_name,
					CONCAT(first_name,' ',last_name) AS fullname,
					gender,
					dob,
					address,
					city,
					state,
					zip_code,
					country,
					(SELECT country_name FROM rs_tbl_countries WHERE country_id=country) as country_name,
					(SELECT iso_code_2 FROM rs_tbl_countries WHERE country_id=country) as country_code,
					phone,
					mobile,
					reg_date,
					is_active,
					customer_type,
					profile_image,
					sec_question,
					sec_answer,
					url_key,
					package_id,
					about_us,
					guide_status,
					driver_license,
					vehicle_status,
					smking_status,
					industry_id,
					position_id
				FROM
					rs_tbl_customer 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_id_not", "V"))
			$Sql .= " AND customer_id!=" . $this->getProperty("customer_id_not");
			
		if($this->isPropertySet("user_name", "V")){
			$Sql .= " AND (LOWER(first_name) LIKE '%" . $this->getProperty("user_name") . "%' OR LOWER(last_name) LIKE '%" . $this->getProperty("user_name") . "%')";
		}
		if($this->isPropertySet("email", "V"))
			$Sql .= " AND email='" . $this->getProperty("email") . "'";
		
		if($this->getProperty("customer_type")!=''){
			$Sql .= " AND customer_type='" . $this->getProperty("customer_type") ."'";
		}
		
		if($this->getProperty("pc_search")!=''){
			$Sql .= " AND address LIKE '%%%" . $this->getProperty("pc_search") ."%%%'";
		}
		
		if($this->getProperty("gender")!=''){
			$Sql .= " AND gender='" . $this->getProperty("gender") ."'";
		}
		
		if($this->getProperty("is_active")!=''){
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		}
		
		if($this->getProperty("country")!=''){
			$Sql .= " AND country='" . $this->getProperty("country") ."'";
		}
		
		if($this->getProperty("customer_type")!=''){
			$Sql .= " AND customer_type='" . $this->getProperty("customer_type") ."'";
		}
		
		if($this->getProperty("dob")!=''){
			$Sql .= " AND dob='" . $this->getProperty("dob") ."'";
		}
		
		if($this->getProperty("sec_question")!=''){
			$Sql .= " AND sec_question='" . $this->getProperty("sec_question") ."'";
		}
		
		if($this->getProperty("sec_answer")!=''){
			$Sql .= " AND sec_answer='" . $this->getProperty("sec_answer") ."'";
		}
		
		if($this->getProperty("url_key")!=''){
			$Sql .= " AND url_key='" . $this->getProperty("url_key") ."'";
		}
		
		if($this->getProperty("package_id")!=''){
			$Sql .= " AND package_id='" . $this->getProperty("package_id") ."'";
		}
		
		if($this->getProperty("guide_status")!=''){
			$Sql .= " AND guide_status='" . $this->getProperty("guide_status") ."'";
		}
		
		if($this->getProperty("driver_license")!=''){
			$Sql .= " AND driver_license='" . $this->getProperty("driver_license") ."'";
		}
		
		if($this->getProperty("vehicle_status")!=''){
			$Sql .= " AND vehicle_status='" . $this->getProperty("vehicle_status") ."'";
		}
		
		if($this->getProperty("smking_status")!=''){
			$Sql .= " AND smking_status='" . $this->getProperty("smking_status") ."'";
		}
		
		if($this->getProperty("industry_id")!=''){
			$Sql .= " AND industry_id='" . $this->getProperty("industry_id") ."'";
		}
		
		if($this->getProperty("position_id")!=''){
			$Sql .= " AND position_id='" . $this->getProperty("position_id") ."'";
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomerWork(){
		$Sql = "SELECT 
					customer_work_id,
					customer_id,
					customer_type_id,
					work_type_id,
					industry_id,
					position_id,
					capacity_id,
					start_date,
					end_date,
					current_work_status,
					working_period_id,
					job_hours_id,
					entry_date,
					monthly_date,
					is_active,
					references_text,
					search_scale,
					street_no,
					suburb_post,
					driver_license,
					vehicle_status,
					smking_status,
					job_title,
					job_feature_1,
					job_feature_2,
					job_feature_3,
					job_overview,
					job_details,
					package_type,
					package_date,
					business_id
				FROM
					rs_tbl_customer_work 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->getProperty("customer_type_id")!=''){
			$Sql .= " AND customer_type_id='" . $this->getProperty("customer_type_id") ."'";
		}
		
		if($this->getProperty("work_type_id")!=''){
			$Sql .= " AND work_type_id='" . $this->getProperty("work_type_id") ."'";
		}
		
		if($this->getProperty("industry_id")!=''){
			$Sql .= " AND industry_id='" . $this->getProperty("industry_id") ."'";
		}
		
		if($this->getProperty("position_id")!=''){
			$Sql .= " AND position_id='" . $this->getProperty("position_id") ."'";
		}
		
		if($this->getProperty("capacity_id")!=''){
			$Sql .= " AND capacity_id='" . $this->getProperty("capacity_id") ."'";
		}
		
		if($this->getProperty("working_period_id")!=''){
			$Sql .= " AND working_period_id='" . $this->getProperty("working_period_id") ."'";
		}
		
		if($this->getProperty("job_hours_id")!=''){
			$Sql .= " AND job_hours_id='" . $this->getProperty("job_hours_id") ."'";
		}
		
		if($this->getProperty("entry_date")!=''){
			$Sql .= " AND entry_date='" . $this->getProperty("entry_date") ."'";
		}
		
		if($this->getProperty("monthly_date")!=''){
			$Sql .= " AND monthly_date='" . $this->getProperty("monthly_date") ."'";
		}
		
		if($this->getProperty("is_active")!=''){
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		}
		
		if($this->getProperty("is_active_not")!=''){
			$Sql .= " AND is_active!='" . $this->getProperty("is_active_not") ."'";
		}
		
		if($this->getProperty("is_active_in")!=''){
			$Sql .= " AND is_active IN (" . $this->getProperty("is_active_in") .")";
		}
		
		if($this->getProperty("search_scale")!=''){
			$Sql .= " AND search_scale='" . $this->getProperty("search_scale") ."'";
		}
		
		if($this->getProperty("street_no")!=''){
			$Sql .= " AND street_no='" . $this->getProperty("street_no") ."'";
		}
		
		if($this->getProperty("suburb_post")!=''){
			$Sql .= " AND suburb_post='" . $this->getProperty("suburb_post") ."'";
		}
		
		if($this->getProperty("driver_license")!=''){
			$Sql .= " AND driver_license='" . $this->getProperty("driver_license") ."'";
		}
		
		if($this->getProperty("vehicle_status")!=''){
			$Sql .= " AND vehicle_status='" . $this->getProperty("vehicle_status") ."'";
		}
		
		if($this->getProperty("smking_status")!=''){
			$Sql .= " AND smking_status='" . $this->getProperty("smking_status") ."'";
		}
		
		if($this->getProperty("package_type")!=''){
			$Sql .= " AND package_type='" . $this->getProperty("package_type") ."'";
		}
		
		if($this->getProperty("package_date")!=''){
			$Sql .= " AND package_date='" . $this->getProperty("package_date") ."'";
		}
		
		if($this->getProperty("business_id")!=''){
			$Sql .= " AND business_id='" . $this->getProperty("business_id") ."'";
		}
		
		if($this->isPropertySet("search_suburb", "V")){
			$Sql .= " AND suburb_post LIKE '%%%" . $this->getProperty("search_suburb") . "%%%'";
		}
		
		
		if($this->isPropertySet("search_job", "V")){
			$Sql .= " AND job_title LIKE '%%%" . $this->getProperty("search_job") . "%%%'";
		}
		
		if($this->isPropertySet("search_suburb_1", "V")){
			$Sql .= " OR suburb_post LIKE '%%%" . $this->getProperty("search_suburb_1") . "%%%'";
		}
		
		if($this->isPropertySet("GROUPBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkAvailability(){
		$Sql = "SELECT 
					work_availability_id,
					customer_id,
					customer_work_id,
					availability_title,
					availability_start,
					availability_end,
					is_active
				FROM
					rs_tbl_customer_work_availability 
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_availability_id", "V"))
			$Sql .= " AND work_availability_id=" . $this->getProperty("work_availability_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("availability_title", "V"))
			$Sql .= " AND availability_title='" . $this->getProperty("availability_title") . "'";
			
		if($this->isPropertySet("availability_start", "V"))
			$Sql .= " AND availability_start='" . $this->getProperty("availability_start") . "'";	
			
		if($this->isPropertySet("availability_end", "V"))
			$Sql .= " AND availability_end='" . $this->getProperty("availability_end") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";		
				
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkLanguage(){
		$Sql = "SELECT 
					a.work_language_id,
					a.customer_work_id,
					a.customer_id,
					a.language_id,
					(SELECT language_name FROM rs_tbl_language WHERE language_id=a.language_id) AS language_name,
					a.is_active
				FROM
					rs_tbl_customer_work_language as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_language_id", "V"))
			$Sql .= " AND a.work_language_id=" . $this->getProperty("work_language_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND a.customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id='" . $this->getProperty("customer_id") . "'";
		//
		if($this->isPropertySet("language_id_array", "V")){
			$Sql .= " AND a.language_id IN (" . $this->getProperty("language_id_array") . ")";
		}
		
		if($this->isPropertySet("language_id", "V"))
			$Sql .= " AND a.language_id='" . $this->getProperty("language_id") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active='" . $this->getProperty("is_active") . "'";	
		
		if($this->isPropertySet("GROUPBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		}
			
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkEmployeeRequirement(){
		$Sql = "SELECT 
					employemee_requirement_id,
					customer_work_id,
					customer_id,
					education_id,
					gender_id,
					age_id,
					age_start,
					age_end,
					country_id,
					is_active
				FROM
					rs_tbl_customer_work_employee_requirement 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_work_id", "V")){
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		}
		
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		}
		
		if($this->getProperty("education_id")!=''){
			$Sql .= " AND education_id='" . $this->getProperty("education_id") ."'";
		}
		
		if($this->getProperty("gender_id")!=''){
			$Sql .= " AND gender_id='" . $this->getProperty("gender_id") ."'";
		}
		
		if($this->getProperty("age_id")!=''){
			$Sql .= " AND age_id='" . $this->getProperty("age_id") ."'";
		}
		
		if($this->getProperty("age_start")!=''){
			$Sql .= " AND age_start='" . $this->getProperty("age_start") ."'";
		}
		
		if($this->getProperty("age_end")!=''){
			$Sql .= " AND age_end='" . $this->getProperty("age_end") ."'";
		}
		
		if($this->getProperty("age_start_up")!=''){
			$Sql .= " AND age_start='" . $this->getProperty("age_start_up") ."'";
		}
		
		if($this->getProperty("age_end_down")!=''){
			$Sql .= " AND age_end='" . $this->getProperty("age_end_down") ."'";
		}
		
		if($this->getProperty("country_id")!=''){
			$Sql .= " AND country_id='" . $this->getProperty("country_id") ."'";
		}
		
		if($this->getProperty("is_active")!=''){
			$Sql .= " AND is_active='" . $this->getProperty("is_active") ."'";
		}
		
		if($this->isPropertySet("GROUPBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkPackages(){
		$Sql = "SELECT 
					customer_package_id,
					customer_work_id,
					customer_id,
					customer_type_id,
					package_id,
					total_resume,
					remaining_resume,
					entery_date,
					is_active
				FROM
					rs_tbl_customer_work_packages
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_package_id", "V"))
			$Sql .= " AND customer_package_id=" . $this->getProperty("customer_package_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("customer_type_id", "V"))
			$Sql .= " AND customer_type_id='" . $this->getProperty("customer_type_id") . "'";
			
		if($this->isPropertySet("package_id", "V"))
			$Sql .= " AND package_id='" . $this->getProperty("package_id") . "'";	
		
		if($this->isPropertySet("total_resume", "V"))
			$Sql .= " AND total_resume='" . $this->getProperty("total_resume") . "'";	
			
		if($this->isPropertySet("remaining_resume", "V"))
			$Sql .= " AND remaining_resume='" . $this->getProperty("remaining_resume") . "'";	
			
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";	
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";	
			
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Available Detail
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerAvailable(){
		$Sql = "SELECT 
					avb_time_id,
					avb_work_id,
					customer_id,
					day_id,
					avb_time,
					is_active
				FROM
					rs_tbl_customer_available_detail 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("day_id", "V"))
			$Sql .= " AND day_id=" . $this->getProperty("day_id");
			
		if($this->isPropertySet("avb_time", "V"))
			$Sql .= " AND avb_time='" . $this->getProperty("avb_time") . "'";
		
		if($this->isPropertySet("avb_work_id", "V"))
			$Sql .= " AND avb_work_id='" . $this->getProperty("avb_work_id") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
				
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Available Detail
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerAttachment(){
		$Sql = "SELECT 
					customer_attach_id,
					customer_id,
					attach_title,
					attach_file,
					attach_file_type,
					attach_file_permission,
					attach_date,
					is_active
				FROM
					rs_tbl_customer_attachment 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("attach_title", "V"))
			$Sql .= " AND attach_title='" . $this->getProperty("attach_title") . "'";
		
		if($this->isPropertySet("attach_file", "V"))
			$Sql .= " AND attach_file='" . $this->getProperty("attach_file") . "'";
		
		if($this->isPropertySet("attach_file_type", "V"))
			$Sql .= " AND attach_file_type='" . $this->getProperty("attach_file_type") . "'";
		
		if($this->isPropertySet("attach_file_permission", "V"))
			$Sql .= " AND attach_file_permission='" . $this->getProperty("attach_file_permission") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
						
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Customer Available Status
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerAvailableStatus(){
		$Sql = "SELECT 
					avb_work_id,
					customer_id,
					current_available_status
				FROM
					rs_tbl_customer_available_status 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("current_available_status", "V"))
			$Sql .= " AND current_available_status=" . $this->getProperty("current_available_status");
			
		if($this->isPropertySet("avb_work_id", "V"))
			$Sql .= " AND avb_work_id='" . $this->getProperty("avb_work_id") . "'";
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Business Detail
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerBusinessDetail(){
		$Sql = "SELECT 
					business_id,
					customer_id,
					bus_name,
					bus_address,
					industry_id,
					bus_status,
					bus_own_name,
					bus_contact_no,
					bus_about,
					bus_logo,
					is_active,
					reg_date
				FROM
					rs_tbl_customer_business_detail 
				WHERE 
					1=1";
		
		if($this->isPropertySet("business_id", "V"))
			$Sql .= " AND business_id=" . $this->getProperty("business_id");
		
		if($this->isPropertySet("industry_id", "V"))
			$Sql .= " AND industry_id=" . $this->getProperty("industry_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("bus_name", "V"))
			$Sql .= " AND bus_name='" . $this->getProperty("bus_name") . "'";
		
		if($this->isPropertySet("bus_status", "V"))
			$Sql .= " AND bus_status='" . $this->getProperty("bus_status") . "'";
			
		if($this->isPropertySet("search_busname", "V")){
			$Sql .= " AND bus_name LIKE '%" . $this->getProperty("search_busname") . "%'";
		}
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Buy Detail
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerBuyDetail(){
		$Sql = "SELECT 
					buyer_id,
					employee_id,
					business_id,
					job_id,
					current_status,
					start_date,
					end_date,
					is_active
				FROM
					rs_tbl_customer_buy_detail 
				WHERE 
					1=1";
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("business_id", "V"))
			$Sql .= " AND business_id=" . $this->getProperty("business_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND job_id=" . $this->getProperty("job_id");
		
		if($this->isPropertySet("current_status", "V"))
			$Sql .= " AND current_status=" . $this->getProperty("current_status");	
		
		if($this->isPropertySet("start_date", "V"))
			$Sql .= " AND start_date >='" . $this->getProperty("start_date") . "'";
		
		if($this->isPropertySet("end_date", "V"))
			$Sql .= " AND end_date <=" . $this->getProperty("end_date") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");	
					
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Certificates
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerCertificates(){
		$Sql = "SELECT 
					a.customer_certificate_id,
					a.customer_id,
					a.customer_work_id,
					a.customer_type_id,
					(select certificate_name from rs_tbl_certificates WHERE certificate_id=a.certificate_id) as certificate_name,
					a.certificate_id
				FROM
					rs_tbl_customer_certificates as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_certificate_id", "V"))
			$Sql .= " AND customer_certificate_id=" . $this->getProperty("customer_certificate_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
			
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		
		if($this->isPropertySet("certificate_id_array", "V")){
			$Sql .= " AND certificate_id IN (" . $this->getProperty("certificate_id_array") . ")";
		}
	
		if($this->isPropertySet("certificate_id", "V"))
			$Sql .= " AND certificate_id=" . $this->getProperty("certificate_id");
		
		if($this->isPropertySet("GROUPBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Certificates
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerCourses(){
		$Sql = "SELECT 
					a.customer_course_id,
					a.customer_id,
					(select courses_name from rs_tbl_courses WHERE courses_id=a.course_id) as courses_name,
					a.course_id
				FROM
					rs_tbl_customer_courses as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("course_id", "V"))
			$Sql .= " AND course_id=" . $this->getProperty("course_id");
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Education
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerEducation(){
		$Sql = "SELECT 
					education_id,
					customer_id,
					customer_type_id,
					academic_id,
					degree_title,
					major_subject,
					location,
					institution_name,
					completion_year,
					edu_date,
					is_active,
					institute_id,
					start_year,
					enjoyment_level,
					edu_type_id,
					capacity_id,
					eduction_leve
				FROM
					rs_tbl_customer_education 
				WHERE 
					1=1";
		
		if($this->isPropertySet("education_id", "V"))
			$Sql .= " AND education_id=" . $this->getProperty("education_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_type_id", "V"))
			$Sql .= " AND customer_type_id=" . $this->getProperty("customer_type_id");
				
		if($this->isPropertySet("academic_id", "V"))
			$Sql .= " AND academic_id='" . $this->getProperty("academic_id") . "'";
		
		if($this->isPropertySet("degree_title", "V"))
			$Sql .= " AND degree_title='" . $this->getProperty("degree_title") . "'";
			
		if($this->isPropertySet("major_subject", "V"))
			$Sql .= " AND major_subject='" . $this->getProperty("major_subject") . "'";
			
		if($this->isPropertySet("location", "V"))
			$Sql .= " AND location='" . $this->getProperty("location") . "'";
		
		if($this->isPropertySet("institution_name", "V"))
			$Sql .= " AND institution_name='" . $this->getProperty("institution_name") . "'";
		
		if($this->isPropertySet("completion_year", "V"))
			$Sql .= " AND completion_year='" . $this->getProperty("completion_year") . "'";
			
		if($this->isPropertySet("edu_date", "V"))
			$Sql .= " AND edu_date='" . $this->getProperty("edu_date") . "'";
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("institute_id", "V"))
			$Sql .= " AND institute_id='" . $this->getProperty("institute_id") . "'";
		
		if($this->isPropertySet("start_year", "V"))
			$Sql .= " AND start_year='" . $this->getProperty("start_year") . "'";
		
		if($this->isPropertySet("enjoyment_level", "V"))
			$Sql .= " AND enjoyment_level='" . $this->getProperty("enjoyment_level") . "'";
		
		if($this->isPropertySet("edu_type_id", "V"))
			$Sql .= " AND edu_type_id='" . $this->getProperty("edu_type_id") . "'";
		
		if($this->isPropertySet("capacity_id", "V"))
			$Sql .= " AND capacity_id='" . $this->getProperty("capacity_id") . "'";
		
		if($this->isPropertySet("eduction_leve", "V"))
			$Sql .= " AND eduction_leve='" . $this->getProperty("eduction_leve") . "'";
							
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Employment
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerEmployment(){
		$Sql = "SELECT 
					a.employee_id,
					a.customer_id,
					a.company_name,
					a.duration,
					a.start_date,
					a.end_date,
					a.location,
					a.industry_id,
					(SELECT industry_name FROM rs_tbl_industry WHERE industry_id=a.industry_id) as industry_name,
					a.job_title,
					(SELECT position_name FROM rs_tbl_posotion WHERE position_id=a.job_title) as position_name,
					a.job_description,
					a.emp_date,
					a.is_active
				FROM
					rs_tbl_customer_employment as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND a.employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("industry_id", "V"))
			$Sql .= " AND a.industry_id=" . $this->getProperty("industry_id");
				
		if($this->isPropertySet("start_date", "V"))
			$Sql .= " AND a.start_date >='" . $this->getProperty("start_date") . "'";
		
		if($this->isPropertySet("end_date", "V"))
			$Sql .= " AND a.end_date <='" . $this->getProperty("end_date") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Language Spoken
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerLanguageSpoken(){
		$Sql = "SELECT 
					a.lang_spk_id,
					a.customer_id,
					a.language_id,
					(SELECT language_name FROM rs_tbl_language WHERE language_id=a.language_id) AS language_name,
					a.is_active
				FROM
					rs_tbl_customer_language_spoken as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("language_id", "V"))
			$Sql .= " AND a.language_id=" . $this->getProperty("language_id");
		
		if($this->isPropertySet("language_id_array", "V")){
			$Sql .= " AND a.language_id IN (" . $this->getProperty("language_id_array") . ")";
		}
						
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Mailbox
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerMailBox(){
		$Sql = "SELECT 
					a.mail_id,
					a.to_id,
					(SELECT CONCAT(first_name, ' ', last_name) as fullname FROM rs_tbl_customer WHERE customer_id=a.to_id) as to_fullname,
					a.from_id,
					(SELECT CONCAT(first_name, ' ', last_name) as fullname FROM rs_tbl_customer WHERE customer_id=a.from_id) as from_fullname,
					a.job_id,
					a.msg_title,
					a.msg_detail,
					a.msg_status,
					a.msg_date,
					a.msg_to_delete,
					a.msg_frm_delete,
					a.tracking_code,
					a.admin_message
				FROM
					rs_tbl_customer_mailbox as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("mail_id", "V"))
			$Sql .= " AND a.mail_id=" . $this->getProperty("mail_id");
		
		if($this->isPropertySet("to_id", "V"))
			$Sql .= " AND a.to_id=" . $this->getProperty("to_id");
		
		if($this->isPropertySet("from_id", "V"))
			$Sql .= " AND a.from_id=" . $this->getProperty("from_id");
		
		if($this->isPropertySet("job_id", "V"))
			$Sql .= " AND a.job_id=" . $this->getProperty("job_id");
		
		if($this->isPropertySet("msg_status", "V"))
			$Sql .= " AND a.msg_status=" . $this->getProperty("msg_status");
		
		if($this->isPropertySet("msg_to_delete", "V"))
			$Sql .= " AND a.msg_to_delete=" . $this->getProperty("msg_to_delete");
		
		if($this->isPropertySet("msg_frm_delete", "V"))
			$Sql .= " AND a.msg_frm_delete=" . $this->getProperty("msg_frm_delete");
		
		if($this->isPropertySet("tracking_code", "V"))
			$Sql .= " AND a.tracking_code='" . $this->getProperty("tracking_code") . "'";
		
		if($this->isPropertySet("admin_message", "V"))
			$Sql .= " AND a.admin_message='" . $this->getProperty("admin_message") . "'";
										
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Contact List
	* @author Numan Tahir
	* @Date 25 November, 2013
	* @modified 25 November, 2013 by Numan Tahir
	*/
	public function lstCustomerContactList(){
		$Sql = "SELECT
				b.first_name
				, b.last_name
				, a.customer_id
				, a.contact_id
				, a.customer_msg_contact_id
				, a.is_active
			FROM
				rs_tbl_customer_mail_contact_list as a
				INNER JOIN rs_tbl_customer as b
					ON (a.contact_id = b.customer_id)";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("contact_id", "V"))
			$Sql .= " AND a.contact_id=" . $this->getProperty("contact_id");
			
		if($this->isPropertySet("customer_msg_contact_id", "V"))
			$Sql .= " AND a.customer_msg_contact_id=" . $this->getProperty("customer_msg_contact_id");
		
		if($this->isPropertySet("search_by_name", "V")){
			$Sql .= " AND b.first_name LIKE '%" . $this->getProperty("search_by_name") . "%'";
		}
										
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Contact List
	* @author Numan Tahir
	* @Date 25 November, 2013
	* @modified 25 November, 2013 by Numan Tahir
	*/
	public function lstCustomerContactListSearch(){
		$Sql = "SELECT
				a.customer_msg_contact_id as id
				, CONCAT(b.first_name, ' ', b.last_name) as name
			FROM
				rs_tbl_customer_mail_contact_list as a
				INNER JOIN rs_tbl_customer as b
					ON (a.contact_id = b.customer_id)";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("search_by_name", "V")){
			$Sql .= " AND b.first_name LIKE '%" . $this->getProperty("search_by_name") . "%'";
		}
										
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Mailbox Files
	* @author Numan Tahir
	* @Date 19 June, 2013
	* @modified 19 June, 2013 by Numan Tahir
	*/
	public function lstCustomerMailBoxFiles(){
		$Sql = "SELECT 
					mail_file_id,
					mail_id,
					tracking_code,
					file_name,
					org_file_name,
					file_size,
					file_type,
					is_active
				FROM
					rs_tbl_customer_mailbox_file
				WHERE 
					1=1";
		
		if($this->isPropertySet("mail_file_id", "V"))
			$Sql .= " AND mail_file_id=" . $this->getProperty("mail_file_id");
		
		if($this->isPropertySet("mail_id", "V"))
			$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
		
		if($this->isPropertySet("tracking_code", "V"))
			$Sql .= " AND tracking_code='" . $this->getProperty("tracking_code") . "'";
		
		if($this->isPropertySet("file_name", "V"))
			$Sql .= " AND file_name='" . $this->getProperty("file_name") . "'";
		
		if($this->isPropertySet("file_type", "V"))
			$Sql .= " AND file_type='" . $this->getProperty("file_type") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
										
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Residential
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerResidential(){
		$Sql = "SELECT 
					a.residential_id,
					a.customer_id,
					a.country_id,
					(SELECT country_name FROM rs_tbl_countries WHERE country_id=a.country_id) AS country_name,
					a.residential_city,
					a.residential_area,
					a.current_residential_status,
					a.is_active
				FROM
					rs_tbl_customer_residential as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("residential_id", "V"))
			$Sql .= " AND a.residential_id=" . $this->getProperty("residential_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("country_id", "V"))
			$Sql .= " AND a.country_id=" . $this->getProperty("country_id");
		
		if($this->isPropertySet("current_residential_status", "V"))
			$Sql .= " AND a.current_residential_status=" . $this->getProperty("current_residential_status");
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Residential
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerAvailabilityDetail(){
		$Sql = "SELECT 
					customer_available_id,
					customer_work_id,
					customer_id,
					customer_day_id,
					customer_start_time,
					customer_end_time,
					customer_day_comments,
					available_for_work,
					available_start_date,
					available_end_date
				FROM
					rs_tbl_customer_availability_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_available_id", "V"))
			$Sql .= " AND customer_available_id=" . $this->getProperty("customer_available_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_day_id", "V"))
			$Sql .= " AND customer_day_id='" . $this->getProperty("customer_day_id") . "'";
			
		if($this->isPropertySet("customer_start_time", "V"))
			$Sql .= " AND customer_start_time>='" . $this->getProperty("customer_start_time") . "'";
			
		if($this->isPropertySet("customer_end_time", "V"))
			$Sql .= " AND customer_end_time<='" . $this->getProperty("customer_end_time") . "'";
		
		if($this->isPropertySet("available_for_work", "V"))
			$Sql .= " AND available_for_work='" . $this->getProperty("available_for_work") . "'";
		
		if($this->isPropertySet("available_start_date", "V"))
			$Sql .= " AND available_start_date>='" . $this->getProperty("available_start_date") . "'";
		
		if($this->isPropertySet("available_end_date", "V"))
			$Sql .= " AND available_end_date<='" . $this->getProperty("available_end_date") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Resume
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerResume(){
		$Sql = "SELECT 
					resume_id,
					customer_id,
					resume_title,
					resume_file,
					is_active
				FROM
					rs_tbl_customer_resume
				WHERE 
					1=1";
		
		if($this->isPropertySet("resume_id", "V"))
			$Sql .= " AND resume_id=" . $this->getProperty("resume_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("search_resume", "V")){
			$Sql .= " AND resume_title LIKE '%" . $this->getProperty("search_resume") . "%'";
		}
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Skills
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerSkills(){
		$Sql = "SELECT 
					a.customer_skill_id,
					a.customer_work_id,
					a.customer_id,
					a.customer_type_id,
					a.skill_id,
					(SELECT skill_name FROM rs_tbl_skills WHERE skills_id=a.skill_id) AS skill_name,
					a.is_active
				FROM
					rs_tbl_customer_skills as a
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_skill_id", "V"))
			$Sql .= " AND a.customer_skill_id=" . $this->getProperty("customer_skill_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_type_id", "V"))
			$Sql .= " AND a.customer_type_id=" . $this->getProperty("customer_type_id");
			
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND a.customer_work_id=" . $this->getProperty("customer_work_id");
			
		if($this->isPropertySet("skill_id", "V"))
			$Sql .= " AND a.skill_id=" . $this->getProperty("skill_id");
		
		if($this->isPropertySet("skill_id_array", "V")){
			$Sql .= " AND a.skill_id IN (" . $this->getProperty("skill_id_array") . ")";
		}
		
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND a.is_active=" . $this->getProperty("is_active");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Visitor
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerVisitor(){
		$Sql = "SELECT 
					visitor_rec_id,
					customer_id,
					visitor_id,
					ip_address,
					visit_datetime
				FROM
					rs_tbl_customer_visitor
				WHERE 
					1=1";
		
		if($this->isPropertySet("visitor_rec_id", "V"))
			$Sql .= " AND visitor_rec_id=" . $this->getProperty("visitor_rec_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("visitor_id", "V"))
			$Sql .= " AND visitor_id=" . $this->getProperty("visitor_id");
		
		if($this->isPropertySet("ip_address", "V"))
			$Sql .= " AND ip_address=" . $this->getProperty("ip_address");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check the email address already exists or not.
	* @author Numan Tahir
	* @Date 14 April, 2013
	* @modified 14 April, 2013 by Numan Tahir
	*/
	public function emailExists(){
		$Sql = "SELECT 
					customer_id,
					email,
					first_name
				FROM
					rs_tbl_customer
				WHERE 
					1=1";
		if($this->isPropertySet("email", "V"))
			$Sql .= " AND email='" . $this->getProperty("email") . "'";
			
		if($this->isPropertySet("customer_type", "V"))
			$Sql .= " AND customer_type=" . $this->getProperty("customer_type");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id!=" . $this->getProperty("customer_id");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check current password in change password
	* @author Numan Tahir
	* @Date 24 April, 2013
	* @modified 24 April, 2013 by Numan Tahir
	*/
	public function checkPassword(){
		$Sql = "SELECT
					customer_id
				FROM
					rs_tbl_customer 
				WHERE 
					1=1";
		$Sql .= " AND customer_id='" . $this->customer_id . "'";
		$Sql .= " AND pass='" . $this->getProperty("cpassword") . "'";
		
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1)
			return true;
		else
			return false;
	}
	
	/**
	* This function is used to Customer Rating.
	* @author Numan Tahir
	* @Date 10 Oct, 2013
	* @modified 10 Oct, 2013 by Numan Tahir
	*/
	public function CustomerRating(){
		$Sql = "SELECT 
					rating_id,
					customer_id,
					rating,
					employee_id,
					rating_text,
					entery_date,
					dateposted,
					timestamp
				FROM
					rs_tbl_customer_rating
				WHERE 
					1=1";
		if($this->isPropertySet("rating_id", "V"))
			$Sql .= " AND rating_id='" . $this->getProperty("rating_id") . "'";
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
			
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id='" . $this->getProperty("employee_id") . "'";
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Customer Social Media Detail
	* @author Numan Tahir
	* @Date 21 November, 2013
	* @modified 21 November, 2013 by Numan Tahir
	*/
	public function lstCustomerSocial(){
		$Sql = "SELECT 
					social_id,
					customer_id,
					fb_user_id,
					fb_profile_link,
					fb_username,
					join_date
				FROM
					rs_tbl_customer_social_detail 
				WHERE 
					1=1";
		
		if($this->isPropertySet("social_id", "V"))
			$Sql .= " AND social_id=" . $this->getProperty("social_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->getProperty("fb_user_id")!=''){
			$Sql .= " AND fb_user_id='" . $this->getProperty("fb_user_id") ."'";
		}
		
		if($this->getProperty("fb_profile_link")!=''){
			$Sql .= " AND fb_profile_link='" . $this->getProperty("fb_profile_link") ."'";
		}
		
		if($this->getProperty("fb_username")!=''){
			$Sql .= " AND fb_username='" . $this->getProperty("fb_username") ."'";
		}
		
		if($this->getProperty("join_date")!=''){
			$Sql .= " AND join_date='" . $this->getProperty("join_date") ."'";
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Student list
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkStudentList(){
		$Sql = "SELECT 
					work_student_list,
					customer_work_id,
					customer_id,
					student_id
				FROM
					rs_tbl_customer_work_student_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_student_list", "V"))
			$Sql .= " AND work_student_list=" . $this->getProperty("work_student_list");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("student_id", "V"))
			$Sql .= " AND student_id=" . $this->getProperty("student_id");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Student list
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerNotifications(){
		$Sql = "SELECT 
					notification_id,
					customer_id,
					notification_detail,
					notification_date,
					notification_status
				FROM
					rs_tbl_customer_notifications
				WHERE 
					1=1";
		
		if($this->isPropertySet("notification_id", "V"))
			$Sql .= " AND notification_id=" . $this->getProperty("notification_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("notification_date", "V"))
			$Sql .= " AND notification_date='" . $this->getProperty("notification_date") . "'";
		
		if($this->isPropertySet("notification_status", "V"))
			$Sql .= " AND notification_status='" . $this->getProperty("notification_status") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Availability
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerAvailability(){
		$Sql = "SELECT 
					availability_id,
					customer_id,
					availability_title,
					availability_start,
					availability_end,
					availability_status,
					is_active
				FROM
					rs_tbl_customer_availability
				WHERE 
					1=1";
		
		if($this->isPropertySet("availability_id", "V"))
			$Sql .= " AND availability_id=" . $this->getProperty("availability_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("availability_title", "V"))
			$Sql .= " AND availability_title='" . $this->getProperty("availability_title") . "'";
		
		if($this->isPropertySet("availability_start", "V"))
			$Sql .= " AND availability_start='" . $this->getProperty("availability_start") . "'";
		
		if($this->isPropertySet("availability_end", "V"))
			$Sql .= " AND availability_end='" . $this->getProperty("availability_end") . "'";
		
		if($this->isPropertySet("availability_status", "V"))
			$Sql .= " AND availability_status='" . $this->getProperty("availability_status") . "'";
			
		if($this->isPropertySet("is_active", "V"))
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Job Applyed List
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerApplyedList(){
		$Sql = "SELECT 
					job_apply_id,
					customer_work_id,
					student_id,
					apply_date,
					student_work_id,
					match_value,
					cover_letter,
					job_type_id,
					applyed_viewes
				FROM
					rs_tbl_customer_job_applied_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_apply_id", "V"))
			$Sql .= " AND job_apply_id=" . $this->getProperty("job_apply_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
		
		if($this->isPropertySet("student_id", "V"))
			$Sql .= " AND student_id='" . $this->getProperty("student_id") . "'";
		
		if($this->isPropertySet("student_work_id", "V"))
			$Sql .= " AND student_work_id='" . $this->getProperty("student_work_id") . "'";
			
		if($this->isPropertySet("apply_date", "V"))
			$Sql .= " AND apply_date='" . $this->getProperty("apply_date") . "'";
		
		if($this->isPropertySet("match_value", "V"))
			$Sql .= " AND match_value='" . $this->getProperty("match_value") . "'";
		
		if($this->isPropertySet("job_type_id", "V"))
			$Sql .= " AND job_type_id='" . $this->getProperty("job_type_id") . "'";
		
		if($this->isPropertySet("applyed_viewes", "V"))
			$Sql .= " AND applyed_viewes='" . $this->getProperty("applyed_viewes") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Job Applyed List
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkSlotsDetail(){
		$Sql = "SELECT 
					work_slots_id,
					customer_id,
					customer_work_id,
					student_id,
					student_work_id,
					student_match_value,
					entry_date
				FROM
					rs_tbl_customer_work_slots_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_slots_id", "V"))
			$Sql .= " AND work_slots_id=" . $this->getProperty("work_slots_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("student_id", "V"))
			$Sql .= " AND student_id='" . $this->getProperty("student_id") . "'";
		
		if($this->isPropertySet("student_match_value", "V"))
			$Sql .= " AND student_match_value='" . $this->getProperty("student_match_value") . "'";
				
		if($this->isPropertySet("student_id_check", "V"))
			$Sql .= " AND student_id='0'";
			
		if($this->isPropertySet("student_work_id", "V"))
			$Sql .= " AND student_work_id='" . $this->getProperty("student_work_id") . "'";
		
		if($this->isPropertySet("student_work_id_check", "V"))
			$Sql .= " AND student_work_id='0'";
			
		if($this->isPropertySet("entry_date", "V"))
			$Sql .= " AND entry_date='" . $this->getProperty("entry_date") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Newsltter List
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkNewsletterInfo(){
		$Sql = "SELECT 
					newsletter_work_id,
					customer_work_id,
					customer_id,
					entry_date,
					sending_date,
					newsletter_status
				FROM
					rs_tbl_customer_work_newsletter_info
				WHERE 
					1=1";
		
		if($this->isPropertySet("newsletter_work_id", "V"))
			$Sql .= " AND newsletter_work_id=" . $this->getProperty("newsletter_work_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("entry_date", "V"))
			$Sql .= " AND entry_date='" . $this->getProperty("entry_date") . "'";
		
		if($this->isPropertySet("sending_date", "V"))
			$Sql .= " AND sending_date='" . $this->getProperty("sending_date") . "'";
			
		if($this->isPropertySet("newsletter_status", "V"))
			$Sql .= " AND newsletter_status='" . $this->getProperty("newsletter_status") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Newsltter Log
	* @author Numan Tahir
	* @Date 28 May, 2013
	* @modified 28 May, 2013 by Numan Tahir
	*/
	public function lstCustomerWorkNewsletterLog(){
		$Sql = "SELECT 
					newsletter_log_id,
					newsletter_id,
					customer_id,
					sending_date
				FROM
					rs_tbl_customer_work_newsletter_log
				WHERE 
					1=1";
		
		if($this->isPropertySet("newsletter_log_id", "V"))
			$Sql .= " AND newsletter_log_id=" . $this->getProperty("newsletter_log_id");
		
		if($this->isPropertySet("newsletter_id", "V"))
			$Sql .= " AND newsletter_id='" . $this->getProperty("newsletter_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("sending_date", "V"))
			$Sql .= " AND sending_date='" . $this->getProperty("sending_date") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Reference
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function lstCustomerWorkReference(){
		$Sql = "SELECT 
					work_reference_id,
					customer_work_id,
					customer_id,
					ref_f_name,
					ref_l_name,
					ref_f_position,
					ref_contact_info,
					ref_contact_email
				FROM
					rs_tbl_customer_work_reference 
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_reference_id", "V"))
			$Sql .= " AND work_reference_id=" . $this->getProperty("work_reference_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->getProperty("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") ."'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//	echo $Sql;
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Reference
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function lstCustomerAvailabilityNewStyle(){
		$Sql = "SELECT 
					c_ava_id,
					customer_id,
					mon_status,
					tues_status,
					web_status,
					thurs_status,
					fri_status,
					sat_status,
					sun_status
				FROM
					rs_tbl_customer_availability_new_style 
				WHERE 
					1=1";
		
		if($this->isPropertySet("c_ava_id", "V"))
			$Sql .= " AND c_ava_id=" . $this->getProperty("c_ava_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Reference
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function lstCustomerWorkAvailabilityNewStyle(){
		$Sql = "SELECT 
					wc_ava_id,
					customer_id,
					customer_work_id,
					mon_status,
					tues_status,
					web_status,
					thurs_status,
					fri_status,
					sat_status,
					sun_status
				FROM
					rs_tbl_customer_work_availability_new_style 
				WHERE 
					1=1";
		
		if($this->isPropertySet("wc_ava_id", "V"))
			$Sql .= " AND wc_ava_id=" . $this->getProperty("wc_ava_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Reference
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function lstCustomerWorkCapacity(){
		$Sql = "SELECT 
					customer_capacity_id,
					customer_work_id,
					customer_id,
					capacity_id
				FROM
					rs_tbl_customer_work_capacity 
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_capacity_id", "V"))
			$Sql .= " AND customer_capacity_id=" . $this->getProperty("customer_capacity_id");
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("capacity_id", "V"))
			$Sql .= " AND capacity_id='" . $this->getProperty("capacity_id") . "'";
				
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Reference
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function lstCustomerWorkNotification(){
		$Sql = "SELECT 
					work_notification_id,
					customer_id,
					customer_work_id,
					student_work_id,
					match_value,
					work_notification_date,
					work_notification_status,
					notification_type,
					apply_status
				FROM
					rs_tbl_customer_work_notifications 
				WHERE 
					1=1";
		
		if($this->isPropertySet("work_notification_id", "V"))
			$Sql .= " AND work_notification_id=" . $this->getProperty("work_notification_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("work_notification_date", "V"))
			$Sql .= " AND work_notification_date='" . $this->getProperty("work_notification_date") . "'";
		
		if($this->isPropertySet("student_work_id", "V"))
			$Sql .= " AND student_work_id='" . $this->getProperty("student_work_id") . "'";
			
		if($this->isPropertySet("work_notification_status", "V"))
			$Sql .= " AND work_notification_status='" . $this->getProperty("work_notification_status") . "'";
		
		if($this->isPropertySet("match_value", "V"))
			$Sql .= " AND match_value='" . $this->getProperty("match_value") . "'";
		
		if($this->isPropertySet("notification_type", "V"))
			$Sql .= " AND notification_type='" . $this->getProperty("notification_type") . "'";
			
		if($this->isPropertySet("apply_status", "V"))
			$Sql .= " AND apply_status='" . $this->getProperty("apply_status") . "'";
							
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		$this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Customer Work Post Code
	* @author Numan Tahir
	* @Date 06 May, 2014
	* @modified 06 May, 2014 by Numan Tahir
	*/
	public function lstCustomerWorkSearchPostCode(){
		$Sql = "SELECT 
					search_post_id,
					customer_id,
					customer_work_id,
					post_code,
					requested_post_code
				FROM
					rs_tbl_customer_work_post_search 
				WHERE 
					1=1";
		
		if($this->isPropertySet("search_post_id", "V"))
			$Sql .= " AND search_post_id=" . $this->getProperty("search_post_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		
		if($this->isPropertySet("customer_work_id", "V"))
			$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
		
		if($this->isPropertySet("post_code", "V"))
			$Sql .= " AND post_code='" . $this->getProperty("post_code") . "'";
		
		if($this->isPropertySet("requested_post_code", "V"))
			$Sql .= " AND requested_post_code='" . $this->getProperty("requested_post_code") . "'";
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		$this->dbQuery($Sql);
	}
	/*************************************************************************/
	/*************************************************************************/
	/*************************************************************************/
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 01 June, 2013
	* @modified 01 June, 2013 by Numan Tahir
	*/
	public function actCustomer($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer(
						customer_id,
						email,
						pass,
						first_name,
						last_name,
						gender,
						dob,
						address,
						city,
						state,
						zip_code,
						country,
						phone,
						mobile,
						reg_date,
						is_active,
						customer_type,
						profile_image,
						sec_question,
						sec_answer,
						url_key,
						about_us,
						guide_status,
						driver_license,
						vehicle_status,
						smking_status,
						industry_id,
						position_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("email", "V") ? "'" . $this->getProperty("email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pass", "V") ? "'" . $this->getProperty("pass") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("first_name", "V") ? "'" . $this->getProperty("first_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("last_name", "V") ? "'" . $this->getProperty("last_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gender", "V") ? "'" . $this->getProperty("gender") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("dob", "V") ? "'" . $this->getProperty("dob") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("address", "V") ? "'" . $this->getProperty("address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("city", "V") ? "'" . $this->getProperty("city") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("state", "V") ? "'" . $this->getProperty("state") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("zip_code", "V") ? "'" . $this->getProperty("zip_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("country", "V") ? "'" . $this->getProperty("country") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("phone", "V") ? "'" . $this->getProperty("phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mobile", "V") ? "'" . $this->getProperty("mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_date", "V") ? "'" . $this->getProperty("reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? $this->getProperty("is_active") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type", "V") ? "'" . $this->getProperty("customer_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("profile_image", "V") ? "'" . $this->getProperty("profile_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sec_question", "V") ? "'" . $this->getProperty("sec_question") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sec_answer", "V") ? "'" . $this->getProperty("sec_answer") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("about_us", "V") ? "'" . $this->getProperty("about_us") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("guide_status", "V") ? "'" . $this->getProperty("guide_status") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("driver_license", "V") ? "'" . $this->getProperty("driver_license") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_status", "V") ? "'" . $this->getProperty("vehicle_status") . "'" : "3";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("smking_status", "V") ? "'" . $this->getProperty("smking_status") . "'" : "3";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_id", "V") ? "'" . $this->getProperty("industry_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("position_id", "V") ? "'" . $this->getProperty("position_id") . "'" : "0";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer SET ";
				if($this->isPropertySet("first_name", "K")){
					$Sql .= "$con first_name='" . $this->getProperty("first_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("last_name", "K")){
					$Sql .= "$con last_name='" . $this->getProperty("last_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pass", "K")){
					$Sql .= "$con pass='" . $this->getProperty("pass") . "'";
					$con = ",";
				}
				if($this->isPropertySet("gender", "K")){
					$Sql .= "$con gender='" . $this->getProperty("gender") . "'";
					$con = ",";
				}
				if($this->isPropertySet("address", "K")){
					$Sql .= "$con address='" . $this->getProperty("address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("dob", "K")){
					$Sql .= "$con dob='" . $this->getProperty("dob") . "'";
					$con = ",";
				}
				if($this->isPropertySet("city", "K")){
					$Sql .= "$con city='" . $this->getProperty("city") . "'";
					$con = ",";
				}
				if($this->isPropertySet("state", "K")){
					$Sql .= "$con state='" . $this->getProperty("state") . "'";
					$con = ",";
				}
				if($this->isPropertySet("zip_code", "K")){
					$Sql .= "$con zip_code='" . $this->getProperty("zip_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("country", "K")){
					$Sql .= "$con country=" . $this->getProperty("country");
					$con = ",";
				}
				if($this->isPropertySet("phone", "K")){
					$Sql .= "$con phone='" . $this->getProperty("phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("mobile", "K")){
					$Sql .= "$con mobile='" . $this->getProperty("mobile") . "'";
					$con = ",";
				}
				if($this->isPropertySet("about_us", "K")){
					$Sql .= "$con about_us='" . $this->getProperty("about_us") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active=" . $this->getProperty("is_active");
					$con = ",";
				}
				if($this->isPropertySet("customer_type", "K")){
					$Sql .= "$con customer_type='" . $this->getProperty("customer_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("profile_image", "K")){
					$Sql .= "$con profile_image='" . $this->getProperty("profile_image") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sec_question", "K")){
					$Sql .= "$con sec_question='" . $this->getProperty("sec_question") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sec_answer", "K")){
					$Sql .= "$con sec_answer='" . $this->getProperty("sec_answer") . "'";
					$con = ",";
				}
				if($this->isPropertySet("url_key", "K")){
					$Sql .= "$con url_key='" . $this->getProperty("url_key") . "'";
					$con = ",";
				}
				if($this->isPropertySet("guide_status", "K")){
					$Sql .= "$con guide_status='" . $this->getProperty("guide_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("driver_license", "K")){
					$Sql .= "$con driver_license='" . $this->getProperty("driver_license") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_status", "K")){
					$Sql .= "$con vehicle_status='" . $this->getProperty("vehicle_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("smking_status", "K")){
					$Sql .= "$con smking_status='" . $this->getProperty("smking_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("industry_id", "K")){
					$Sql .= "$con industry_id='" . $this->getProperty("industry_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("position_id", "K")){
					$Sql .= "$con position_id='" . $this->getProperty("position_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("email", "V"))
					$Sql .= " AND email='" . $this->getProperty("email") . "'";
				else
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;

			/** ** ** Inactive Customer ** ** **/
			case "R":
				$Sql = "UPDATE rs_tbl_customer SET 
							is_active=0
						WHERE
							1=1";
				$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			/** ** ** Delete Customer ** ** **/
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer
						WHERE
							1=1";
				$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			/** ** ** Suspend Customer ** ** **/
			case "SP":
				$Sql = "UPDATE rs_tbl_customer SET ";
				if($this->isPropertySet("password", "K")){
					$Sql .= "$con pass='" . $this->getProperty("password") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				if($this->isPropertySet("email", "K")){
					$Sql .= "$con email='" . $this->getProperty("email") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			/** ** ** Change Customer Email Address ** ** **/
			case "EP":
				$Sql = "UPDATE users SET ";
				if($this->isPropertySet("email", "K")){
					$Sql .= "$con email='" . $this->getProperty("email") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerWork($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work(
						customer_work_id,
						customer_id,
						customer_type_id,
						work_type_id,
						industry_id,
						position_id,
						capacity_id,
						start_date,
						end_date,
						current_work_status,
						working_period_id,
						job_hours_id,
						entry_date,
						monthly_date,
						is_active,
						references_text,
						search_scale,
						street_no,
						suburb_post,
						driver_license,
						vehicle_status,
						smking_status,
						job_title,
						job_feature_1,
						job_feature_2,
						job_feature_3,
						job_overview,
						job_details,
						package_type,
						package_date,
						business_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? $this->getProperty("customer_work_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type_id", "V") ? "'" . $this->getProperty("customer_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("work_type_id", "V") ? "'" . $this->getProperty("work_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_id", "V") ? "'" . $this->getProperty("industry_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("position_id", "V") ? "'" . $this->getProperty("position_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? "'" . $this->getProperty("capacity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_work_status", "V") ? "'" . $this->getProperty("current_work_status") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("working_period_id", "V") ? "'" . $this->getProperty("working_period_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_hours_id", "V") ? "'" . $this->getProperty("job_hours_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entry_date", "V") ? "'" . $this->getProperty("entry_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_date", "V") ? "'" . $this->getProperty("monthly_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("references_text", "V") ? "'" . $this->getProperty("references_text") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("search_scale", "V") ? "'" . $this->getProperty("search_scale") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("street_no", "V") ? "'" . $this->getProperty("street_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("suburb_post", "V") ? "'" . $this->getProperty("suburb_post") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("driver_license", "V") ? "'" . $this->getProperty("driver_license") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_status", "V") ? "'" . $this->getProperty("vehicle_status") . "'" : "3";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("smking_status", "V") ? "'" . $this->getProperty("smking_status") . "'" : "3";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title", "V") ? "'" . $this->getProperty("job_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_feature_1", "V") ? "'" . $this->getProperty("job_feature_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_feature_2", "V") ? "'" . $this->getProperty("job_feature_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_feature_3", "V") ? "'" . $this->getProperty("job_feature_3") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_overview", "V") ? "'" . $this->getProperty("job_overview") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_details", "V") ? "'" . $this->getProperty("job_details") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_type", "V") ? "'" . $this->getProperty("package_type") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_date", "V") ? "'" . $this->getProperty("package_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("business_id", "V") ? "'" . $this->getProperty("business_id") . "'" : "0";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work SET ";
				if($this->isPropertySet("industry_id", "K")){
					$Sql .= "$con industry_id='" . $this->getProperty("industry_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("position_id", "K")){
					$Sql .= "$con position_id='" . $this->getProperty("position_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("capacity_id", "K")){
					$Sql .= "$con capacity_id='" . $this->getProperty("capacity_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("working_period_id", "K")){
					$Sql .= "$con working_period_id='" . $this->getProperty("working_period_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_hours_id", "K")){
					$Sql .= "$con job_hours_id='" . $this->getProperty("job_hours_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("monthly_date", "K")){
					$Sql .= "$con monthly_date='" . $this->getProperty("monthly_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				if($this->isPropertySet("references_text", "K")){
					$Sql .= "$con references_text='" . $this->getProperty("references_text") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("start_date", "K")){
					$Sql .= "$con start_date='" . $this->getProperty("start_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$con end_date='" . $this->getProperty("end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("current_work_status", "K")){
					$Sql .= "$con current_work_status='" . $this->getProperty("current_work_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("search_scale", "K")){
					$Sql .= "$con search_scale='" . $this->getProperty("search_scale") . "'";
					$con = ",";
				}				
				if($this->isPropertySet("street_no", "K")){
					$Sql .= "$con street_no='" . $this->getProperty("street_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("suburb_post", "K")){
					$Sql .= "$con suburb_post='" . $this->getProperty("suburb_post") . "'";
					$con = ",";
				}
				if($this->isPropertySet("driver_license", "K")){
					$Sql .= "$con driver_license='" . $this->getProperty("driver_license") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_status", "K")){
					$Sql .= "$con vehicle_status='" . $this->getProperty("vehicle_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("smking_status", "K")){
					$Sql .= "$con smking_status='" . $this->getProperty("smking_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_feature_1", "K")){
					$Sql .= "$con job_feature_1='" . $this->getProperty("job_feature_1") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_feature_2", "K")){
					$Sql .= "$con job_feature_2='" . $this->getProperty("job_feature_2") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_feature_3", "K")){
					$Sql .= "$con job_feature_3='" . $this->getProperty("job_feature_3") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_overview", "K")){
					$Sql .= "$con job_overview='" . $this->getProperty("job_overview") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_details", "K")){
					$Sql .= "$con job_details='" . $this->getProperty("job_details") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("package_type", "K")){
					$Sql .= "$con package_type='" . $this->getProperty("package_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("package_date", "K")){
					$Sql .= "$con package_date='" . $this->getProperty("package_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("business_id", "K")){
					$Sql .= "$con business_id='" . $this->getProperty("business_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work
						WHERE
							1=1";
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerWorkEmployeeRequirement($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_employee_requirement(
						employemee_requirement_id,
						customer_work_id,
						customer_id,
						education_id,
						gender_id,
						age_id,
						age_start,
						age_end,
						country_id,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("employemee_requirement_id", "V") ? $this->getProperty("employemee_requirement_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("education_id", "V") ? "'" . $this->getProperty("education_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("gender_id", "V") ? "'" . $this->getProperty("gender_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("age_id", "V") ? "'" . $this->getProperty("age_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("age_start", "V") ? "'" . $this->getProperty("age_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("age_end", "V") ? "'" . $this->getProperty("age_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("country_id", "V") ? "'" . $this->getProperty("country_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_employee_requirement SET ";
				if($this->isPropertySet("education_id", "K")){
					$Sql .= "$con education_id='" . $this->getProperty("education_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("gender_id", "K")){
					$Sql .= "$con gender_id='" . $this->getProperty("gender_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("age_id", "K")){
					$Sql .= "$con age_id='" . $this->getProperty("age_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("age_start", "K")){
					$Sql .= "$con age_start='" . $this->getProperty("age_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("age_end", "K")){
					$Sql .= "$con age_end='" . $this->getProperty("age_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("country_id", "K")){
					$Sql .= "$con country_id='" . $this->getProperty("country_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("employemee_requirement_id", "V")){
					$Sql .= " AND employemee_requirement_id='" . $this->getProperty("employemee_requirement_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work
						WHERE
							1=1";
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerWorkAvailability($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_availability(
						work_availability_id,
						customer_id,
						customer_work_id,
						availability_title,
						availability_start,
						availability_end,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_availability_id", "V") ? $this->getProperty("work_availability_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_title", "V") ? "'" . $this->getProperty("availability_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_start", "V") ? "'" . $this->getProperty("availability_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_end", "V") ? "'" . $this->getProperty("availability_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_availability SET ";
				if($this->isPropertySet("availability_title", "K")){
					$Sql .= "$con availability_title='" . $this->getProperty("availability_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("availability_start", "K")){
					$Sql .= "$con availability_start='" . $this->getProperty("availability_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("availability_end", "K")){
					$Sql .= "$con availability_end='" . $this->getProperty("availability_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("work_availability_id", "V")){
					$Sql .= " AND work_availability_id='" . $this->getProperty("work_availability_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_availability
						WHERE
							1=1";
				if($this->isPropertySet("work_availability_id", "V")){
					$Sql .= " AND work_availability_id=" . $this->getProperty("work_availability_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerWorkLanguage($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_language(
						work_language_id,
						customer_work_id,
						customer_id,
						language_id,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_language_id", "V") ? $this->getProperty("work_language_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("language_id", "V") ? "'" . $this->getProperty("language_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_language
						WHERE
							1=1";
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerWorkPackages($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_packages(
						customer_package_id,
						customer_work_id,
						customer_id,
						customer_type_id,
						package_id,
						total_resume,
						remaining_resume,
						entery_date,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_package_id", "V") ? $this->getProperty("customer_package_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type_id", "V") ? "'" . $this->getProperty("customer_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_id", "V") ? "'" . $this->getProperty("package_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_resume", "V") ? "'" . $this->getProperty("total_resume") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("remaining_resume", "V") ? "'" . $this->getProperty("remaining_resume") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_packages SET ";
				if($this->isPropertySet("total_resume", "K")){
					$Sql .= "$con total_resume='" . $this->getProperty("total_resume") . "'";
					$con = ",";
				}
				if($this->isPropertySet("remaining_resume", "K")){
					$Sql .= "$con remaining_resume='" . $this->getProperty("remaining_resume") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_package_id", "V")){
					$Sql .= " AND customer_package_id='" . $this->getProperty("customer_package_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_availability
						WHERE
							1=1";
				if($this->isPropertySet("customer_package_id", "V")){
					$Sql .= " AND customer_package_id=" . $this->getProperty("customer_package_id");
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id=" . $this->getProperty("customer_work_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerAttachment($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_attachment(
						customer_attach_id,
						customer_id,
						attach_title,
						attach_file,
						attach_file_type,
						attach_file_permission,
						attach_date,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_attach_id", "V") ? $this->getProperty("customer_attach_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("attach_title", "V") ? "'" . $this->getProperty("attach_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("attach_file", "V") ? "'" . $this->getProperty("attach_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("attach_file_type", "V") ? "'" . $this->getProperty("attach_file_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("attach_file_permission", "V") ? "'" . $this->getProperty("attach_file_permission") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("attach_date", "V") ? "'" . $this->getProperty("attach_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_attachment SET ";
				if($this->isPropertySet("attach_title", "K")){
					$Sql .= "$con attach_title='" . $this->getProperty("attach_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("attach_file", "K")){
					$Sql .= "$con attach_file='" . $this->getProperty("attach_file") . "'";
					$con = ",";
				}
				if($this->isPropertySet("attach_file_type", "K")){
					$Sql .= "$con attach_file_type='" . $this->getProperty("attach_file_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("attach_file_permission", "K")){
					$Sql .= "$con attach_file_permission='" . $this->getProperty("attach_file_permission") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_attach_id", "V")){
					$Sql .= " AND customer_attach_id='" . $this->getProperty("customer_attach_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_attachment
						WHERE
							1=1";
				if($this->isPropertySet("customer_attach_id", "V")){
					$Sql .= " AND customer_attach_id=" . $this->getProperty("customer_attach_id");
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerEducation($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_education(
						education_id,
						customer_id,
						customer_type_id,
						academic_id,
						degree_title,
						major_subject,
						location,
						institution_name,
						completion_year,
						edu_date,
						is_active,
						institute_id,
						start_year,
						enjoyment_level,
						edu_type_id,
						capacity_id,
						eduction_leve) 
						VALUES(";
				$Sql .= $this->isPropertySet("education_id", "V") ? $this->getProperty("education_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type_id", "V") ? "'" . $this->getProperty("customer_type_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("academic_id", "V") ? "'" . $this->getProperty("academic_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("degree_title", "V") ? "'" . $this->getProperty("degree_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("major_subject", "V") ? "'" . $this->getProperty("major_subject") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location", "V") ? "'" . $this->getProperty("location") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institution_name", "V") ? "'" . $this->getProperty("institution_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("completion_year", "V") ? "'" . $this->getProperty("completion_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_date", "V") ? "'" . $this->getProperty("edu_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_id", "V") ? "'" . $this->getProperty("institute_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_year", "V") ? "'" . $this->getProperty("start_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enjoyment_level", "V") ? "'" . $this->getProperty("enjoyment_level") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("edu_type_id", "V") ? "'" . $this->getProperty("edu_type_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? "'" . $this->getProperty("capacity_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("eduction_leve", "V") ? "'" . $this->getProperty("eduction_leve") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_education SET ";
				if($this->isPropertySet("academic_id", "K")){
					$Sql .= "$con academic_id='" . $this->getProperty("academic_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("degree_title", "K")){
					$Sql .= "$con degree_title='" . $this->getProperty("degree_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("major_subject", "K")){
					$Sql .= "$con major_subject='" . $this->getProperty("major_subject") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location", "K")){
					$Sql .= "$con location='" . $this->getProperty("location") . "'";
					$con = ",";
				}
				if($this->isPropertySet("institution_name", "K")){
					$Sql .= "$con institution_name='" . $this->getProperty("institution_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("completion_year", "K")){
					$Sql .= "$con completion_year='" . $this->getProperty("completion_year") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				if($this->isPropertySet("institute_id", "K")){
					$Sql .= "$con institute_id='" . $this->getProperty("institute_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("start_year", "K")){
					$Sql .= "$con start_year='" . $this->getProperty("start_year") . "'";
					$con = ",";
				}
				if($this->isPropertySet("enjoyment_level", "K")){
					$Sql .= "$con enjoyment_level='" . $this->getProperty("enjoyment_level") . "'";
					$con = ",";
				}
				if($this->isPropertySet("edu_type_id", "K")){
					$Sql .= "$con edu_type_id='" . $this->getProperty("edu_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("capacity_id", "K")){
					$Sql .= "$con capacity_id='" . $this->getProperty("capacity_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("eduction_leve", "K")){
					$Sql .= "$con eduction_leve='" . $this->getProperty("eduction_leve") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("education_id", "V")){
					$Sql .= " AND education_id='" . $this->getProperty("education_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_education
						WHERE
							1=1";
				$Sql .= " AND education_id=" . $this->getProperty("education_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerAvailabilityDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_availability_detail(
						customer_available_id,
						customer_work_id,
						customer_id,
						customer_day_id,
						customer_start_time,
						customer_end_time,
						customer_day_comments,
						available_for_work,
						available_start_date,
						available_end_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_available_id", "V") ? $this->getProperty("customer_available_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_day_id", "V") ? "'" . $this->getProperty("customer_day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_start_time", "V") ? "'" . $this->getProperty("customer_start_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_end_time", "V") ? "'" . $this->getProperty("customer_end_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_day_comments", "V") ? "'" . $this->getProperty("customer_day_comments") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("available_for_work", "V") ? "'" . $this->getProperty("available_for_work") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("available_start_date", "V") ? "'" . $this->getProperty("available_start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("available_end_date", "V") ? "'" . $this->getProperty("available_end_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_availability_detail SET ";
				if($this->isPropertySet("customer_start_time", "K")){
					$Sql .= "$con customer_start_time='" . $this->getProperty("customer_start_time") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_end_time", "K")){
					$Sql .= "$con customer_end_time='" . $this->getProperty("customer_end_time") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_day_comments", "K")){
					$Sql .= "$con customer_day_comments='" . $this->getProperty("customer_day_comments") . "'";
					$con = ",";
				}
				if($this->isPropertySet("available_for_work", "K")){
					$Sql .= "$con available_for_work='" . $this->getProperty("available_for_work") . "'";
					$con = ",";
				}
				if($this->isPropertySet("available_start_date", "K")){
					$Sql .= "$con available_start_date='" . $this->getProperty("available_start_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("available_end_date", "K")){
					$Sql .= "$con available_end_date='" . $this->getProperty("available_end_date") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_day_id", "V")){
					$Sql .= " AND customer_day_id='" . $this->getProperty("customer_day_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_availability_detail	
						WHERE
							1=1";
				$Sql .= " AND customer_available_id=" . $this->getProperty("customer_available_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerCertificates($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_certificates(
						customer_certificate_id,
						customer_id,
						customer_type_id,
						customer_work_id,
						certificate_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_certificate_id", "V") ? $this->getProperty("customer_certificate_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type_id", "V") ? "'" . $this->getProperty("customer_type_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("certificate_id", "V") ? "'" . $this->getProperty("certificate_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_certificates
						WHERE
							1=1";
				if($this->isPropertySet("customer_certificate_id", "K")){
					$Sql .= " AND customer_certificate_id='" . $this->getProperty("customer_certificate_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_work_id", "K")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("certificate_id", "K")){
					$Sql .= " AND certificate_id='" . $this->getProperty("certificate_id") . "'";
					$con = ",";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerCourses($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_courses(
						customer_course_id,
						customer_id,
						course_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_course_id", "V") ? $this->getProperty("customer_course_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("course_id", "V") ? "'" . $this->getProperty("course_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_courses
						WHERE
							1=1";
				if($this->isPropertySet("customer_course_id", "K")){
					$Sql .= " AND customer_course_id='" . $this->getProperty("customer_course_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("course_id", "K")){
					$Sql .= " AND course_id='" . $this->getProperty("course_id") . "'";
					$con = ",";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerAvailableDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_available_detail(
						avb_time_id,
						avb_work_id,
						customer_id,
						day_id,
						avb_time,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("avb_time_id", "V") ? $this->getProperty("avb_time_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("avb_work_id", "V") ? "'" . $this->getProperty("avb_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("day_id", "V") ? "'" . $this->getProperty("day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("avb_time", "V") ? "'" . $this->getProperty("avb_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_available_detail SET ";
				if($this->isPropertySet("day_id", "K")){
					$Sql .= "$con day_id='" . $this->getProperty("day_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("avb_time", "K")){
					$Sql .= "$con avb_time='" . $this->getProperty("avb_time") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("avb_time_id", "V")){
					$Sql .= " AND avb_time_id='" . $this->getProperty("avb_time_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_available_detail
						WHERE
							1=1";
				$Sql .= " AND avb_time_id=" . $this->getProperty("avb_time_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerAvailableStatus($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_available_status(
						avb_work_id,
						customer_id,
						current_available_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("avb_work_id", "V") ? $this->getProperty("avb_work_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_available_status", "V") ? "'" . $this->getProperty("current_available_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_available_status SET ";
				if($this->isPropertySet("current_available_status", "K")){
					$Sql .= "$con current_available_status='" . $this->getProperty("current_available_status") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("avb_work_id", "V")){
					$Sql .= " AND avb_work_id='" . $this->getProperty("avb_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_available_status
						WHERE
							1=1";
				$Sql .= " AND avb_work_id=" . $this->getProperty("avb_work_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerBusinessDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_business_detail(
						business_id,
						customer_id,
						bus_name,
						bus_address,
						industry_id,
						bus_status,
						bus_own_name,
						bus_contact_no,
						bus_logo,
						is_active,
						reg_date,
						bus_about) 
						VALUES(";
				$Sql .= $this->isPropertySet("business_id", "V") ? $this->getProperty("business_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_name", "V") ? "'" . $this->getProperty("bus_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_address", "V") ? "'" . $this->getProperty("bus_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_id", "V") ? "'" . $this->getProperty("industry_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_status", "V") ? "'" . $this->getProperty("bus_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_own_name", "V") ? "'" . $this->getProperty("bus_own_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_contact_no", "V") ? "'" . $this->getProperty("bus_contact_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_logo", "V") ? "'" . $this->getProperty("bus_logo") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_date", "V") ? "'" . $this->getProperty("reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bus_about", "V") ? "'" . $this->getProperty("bus_about") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_business_detail SET ";
				
				if($this->isPropertySet("bus_name", "K")){
					$Sql .= "$con bus_name='" . $this->getProperty("bus_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_address", "K")){
					$Sql .= "$con bus_address='" . $this->getProperty("bus_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("industry_id", "K")){
					$Sql .= "$con industry_id='" . $this->getProperty("industry_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_status", "K")){
					$Sql .= "$con bus_status='" . $this->getProperty("bus_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_own_name", "K")){
					$Sql .= "$con bus_own_name='" . $this->getProperty("bus_own_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_contact_no", "K")){
					$Sql .= "$con bus_contact_no='" . $this->getProperty("bus_contact_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_logo", "K")){
					$Sql .= "$con bus_logo='" . $this->getProperty("bus_logo") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bus_about", "K")){
					$Sql .= "$con bus_about='" . $this->getProperty("bus_about") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("business_id", "V")){
					$Sql .= " AND business_id='" . $this->getProperty("business_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_business_detail
						WHERE
							1=1";
				$Sql .= " AND business_id=" . $this->getProperty("business_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerBuyDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_buy_detail(
						buyer_id,
						employee_id,
						business_id,
						job_id,
						current_status,
						start_date,
						end_date,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("buyer_id", "V") ? $this->getProperty("buyer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? "'" . $this->getProperty("employee_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("business_id", "V") ? "'" . $this->getProperty("business_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_status", "V") ? "'" . $this->getProperty("current_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_buy_detail SET ";
				
				if($this->isPropertySet("current_status", "K")){
					$Sql .= "$con current_status='" . $this->getProperty("current_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("start_date", "K")){
					$Sql .= "$con start_date='" . $this->getProperty("start_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$con end_date='" . $this->getProperty("end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("buyer_id", "V")){
					$Sql .= " AND buyer_id='" . $this->getProperty("buyer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_buy_detail
						WHERE
							1=1";
				$Sql .= " AND buyer_id=" . $this->getProperty("buyer_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerEmployment($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_employment(
						employee_id,
						customer_id,
						company_name,
						duration,
						start_date,
						end_date,
						location,
						industry_id,
						job_title,
						job_description,
						emp_date,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_name", "V") ? "'" . $this->getProperty("company_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("duration", "V") ? "'" . $this->getProperty("duration") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location", "V") ? "'" . $this->getProperty("location") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("industry_id", "V") ? "'" . $this->getProperty("industry_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title", "V") ? "'" . $this->getProperty("job_title") . "'" : "NULL";				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_description", "V") ? "'" . $this->getProperty("job_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_date", "V") ? "'" . $this->getProperty("emp_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_employment SET ";
				
				if($this->isPropertySet("company_name", "K")){
					$Sql .= "$con company_name='" . $this->getProperty("company_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("duration", "K")){
					$Sql .= "$con duration='" . $this->getProperty("duration") . "'";
					$con = ",";
				}
				if($this->isPropertySet("start_date", "K")){
					$Sql .= "$con start_date='" . $this->getProperty("start_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$con end_date='" . $this->getProperty("end_date") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("location", "K")){
					$Sql .= "$con location='" . $this->getProperty("location") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("industry_id", "K")){
					$Sql .= "$con industry_id='" . $this->getProperty("industry_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_description", "K")){
					$Sql .= "$con job_description='" . $this->getProperty("job_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("emp_date", "K")){
					$Sql .= "$con emp_date='" . $this->getProperty("emp_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("employee_id", "V")){
					$Sql .= " AND employee_id='" . $this->getProperty("employee_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_employment
						WHERE
							1=1";
				$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerLanguageSpoken($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_language_spoken(
						lang_spk_id,
						customer_id,
						language_id,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("lang_spk_id", "V") ? $this->getProperty("lang_spk_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("language_id", "V") ? "'" . $this->getProperty("language_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_language_spoken SET ";
				
				if($this->isPropertySet("language_id", "K")){
					$Sql .= "$con language_id='" . $this->getProperty("language_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("lang_spk_id", "V")){
					$Sql .= " AND lang_spk_id='" . $this->getProperty("lang_spk_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_language_spoken
						WHERE
							1=1";
				if($this->isPropertySet("lang_spk_id", "V")){
					$Sql .= " AND lang_spk_id='" . $this->getProperty("lang_spk_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerMailBox($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_mailbox(
						mail_id,
						to_id,
						from_id,
						job_id,
						msg_title,
						msg_detail,
						msg_status,
						msg_date,
						msg_to_delete,
						msg_frm_delete,
						tracking_code,
						admin_message)
						VALUES(";
				$Sql .= $this->isPropertySet("mail_id", "V") ? $this->getProperty("mail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("to_id", "V") ? "'" . $this->getProperty("to_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("from_id", "V") ? "'" . $this->getProperty("from_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_id", "V") ? "'" . $this->getProperty("job_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_title", "V") ? "'" . $this->getProperty("msg_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_detail", "V") ? "'" . $this->getProperty("msg_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_status", "V") ? "'" . $this->getProperty("msg_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_date", "V") ? "'" . $this->getProperty("msg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_to_delete", "V") ? "'" . $this->getProperty("msg_to_delete") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_frm_delete", "V") ? "'" . $this->getProperty("msg_frm_delete") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tracking_code", "V") ? "'" . $this->getProperty("tracking_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("admin_message", "V") ? "'" . $this->getProperty("admin_message") . "'" : "2";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_mailbox SET ";
				
				if($this->isPropertySet("msg_status", "K")){
					$Sql .= "$con msg_status='" . $this->getProperty("msg_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("msg_to_delete", "K")){
					$Sql .= "$con msg_to_delete='" . $this->getProperty("msg_to_delete") . "'";
					$con = ",";
				}
				if($this->isPropertySet("msg_frm_delete", "K")){
					$Sql .= "$con msg_frm_delete='" . $this->getProperty("msg_frm_delete") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("mail_id", "V")){
					$Sql .= " AND mail_id='" . $this->getProperty("mail_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_mailbox
						WHERE
							1=1";
				$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 19 June, 2013
	* @modified 19 June, 2013 by Numan Tahir
	*/
	public function actCustomerMailBoxFiles($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_mailbox_file(
						mail_file_id,
						mail_id,
						tracking_code,
						file_name,
						org_file_name,
						file_size,
						file_type,
						is_active)
						VALUES(";
				$Sql .= $this->isPropertySet("mail_file_id", "V") ? $this->getProperty("mail_file_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_id", "V") ? "'" . $this->getProperty("mail_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tracking_code", "V") ? "'" . $this->getProperty("tracking_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_name", "V") ? "'" . $this->getProperty("file_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("org_file_name", "V") ? "'" . $this->getProperty("org_file_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_size", "V") ? "'" . $this->getProperty("file_size") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_type", "V") ? "'" . $this->getProperty("file_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_mailbox_file SET ";
				
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
				if($this->isPropertySet("mail_id", "K")){
					$Sql .= "$con mail_id='" . $this->getProperty("mail_id") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("tracking_code", "V")){
					$Sql .= " AND tracking_code='" . $this->getProperty("tracking_code") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_mailbox_file
						WHERE
							1=1";
				if($this->isPropertySet("mail_id", "K")){
					$Sql .= "$con mail_id='" . $this->getProperty("mail_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("mail_file_id", "K")){
					$Sql .= "$con mail_file_id='" . $this->getProperty("mail_file_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tracking_code", "K")){
					$Sql .= "$con tracking_code='" . $this->getProperty("tracking_code") . "'";
					$con = ",";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerResidential($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_residential(
						residential_id,
						customer_id,
						country_id,
						residential_city,
						residential_area,
						current_residential_status,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("residential_id", "V") ? $this->getProperty("residential_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("country_id", "V") ? "'" . $this->getProperty("country_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("residential_city", "V") ? "'" . $this->getProperty("residential_city") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("residential_area", "V") ? "'" . $this->getProperty("residential_area") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_residential_status", "V") ? "'" . $this->getProperty("current_residential_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_residential SET ";
				
				if($this->isPropertySet("residential_city", "K")){
					$Sql .= "$con residential_city='" . $this->getProperty("residential_city") . "'";
					$con = ",";
				}
				if($this->isPropertySet("residential_area", "K")){
					$Sql .= "$con residential_area='" . $this->getProperty("residential_area") . "'";
					$con = ",";
				}
				if($this->isPropertySet("current_residential_status", "K")){
					$Sql .= "$con current_residential_status='" . $this->getProperty("current_residential_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("residential_id", "V")){
					$Sql .= " AND residential_id='" . $this->getProperty("residential_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_residential
						WHERE
							1=1";
				$Sql .= " AND residential_id=" . $this->getProperty("residential_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerResume($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_resume(
						resume_id,
						customer_id,
						resume_title,
						resume_file,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("resume_id", "V") ? $this->getProperty("resume_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_title", "V") ? "'" . $this->getProperty("resume_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("resume_file", "V") ? "'" . $this->getProperty("resume_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_resume SET ";
				
				if($this->isPropertySet("resume_title", "K")){
					$Sql .= "$con resume_title='" . $this->getProperty("resume_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("resume_file", "K")){
					$Sql .= "$con resume_file='" . $this->getProperty("resume_file") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("resume_id", "V")){
					$Sql .= " AND resume_id='" . $this->getProperty("resume_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_resume
						WHERE
							1=1";
				$Sql .= " AND resume_id=" . $this->getProperty("resume_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerSkills($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_skills(
						customer_skill_id,
						customer_id,
						customer_type_id,
						customer_work_id,
						skill_id,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_skill_id", "V") ? $this->getProperty("customer_skill_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type_id", "V") ? "'" . $this->getProperty("customer_type_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("skill_id", "V") ? "'" . $this->getProperty("skill_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_skills SET ";
				
				if($this->isPropertySet("skill_id", "K")){
					$Sql .= "$con skill_id='" . $this->getProperty("skill_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_skill_id", "V")){
					$Sql .= " AND customer_skill_id='" . $this->getProperty("customer_skill_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_skills
						WHERE
							1=1";
				if($this->isPropertySet("customer_skill_id", "V")){
					$Sql .= " AND customer_skill_id='" . $this->getProperty("customer_skill_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("skill_id", "V")){
					$Sql .= " AND skill_id='" . $this->getProperty("skill_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerVisitor($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_visitor(
						visitor_rec_id,
						customer_id,
						visitor_id,
						ip_address,
						visit_datetime) 
						VALUES(";
				$Sql .= $this->isPropertySet("visitor_rec_id", "V") ? $this->getProperty("visitor_rec_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visitor_id", "V") ? "'" . $this->getProperty("visitor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ip_address", "V") ? "'" . $this->getProperty("ip_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("visit_datetime", "V") ? "'" . $this->getProperty("visit_datetime") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_visitor
						WHERE
							1=1";
				$Sql .= " AND visitor_rec_id=" . $this->getProperty("visitor_rec_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 03 June, 2013
	* @modified 03 June, 2013 by Numan Tahir
	*/
	public function actCustomerRating($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_rating(
						customer_id,
						rating,
						employee_id,
						rating_text,
						entery_date,
						dateposted,
						timestamp) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rating", "V") ? "'" . $this->getProperty("rating") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? "'" . $this->getProperty("employee_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rating_text", "V") ? "'" . $this->getProperty("rating_text") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("dateposted", "V") ? "'" . $this->getProperty("dateposted") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("timestamp", "V") ? "'" . $this->getProperty("timestamp") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_rating SET ";
				
				if($this->isPropertySet("rating", "K")){
					$Sql .= "$con rating='" . $this->getProperty("rating") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rating_text", "K")){
					$Sql .= "$con rating_text='" . $this->getProperty("rating_text") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("employee_id", "V")){
					$Sql .= " AND employee_id='" . $this->getProperty("employee_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to change the password
	* @author Numan Tahir
	* @Date 24 April, 2013
	* @modified 24 April, 2013 by Numan Tahir
	*/
	public function changePassword(){
		$Sql = "UPDATE rs_tbl_customer SET
					pass='" . $this->getProperty("npassword") . "' 
				WHERE 
					1=1";
		$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Social to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 21 November, 2013
	* @modified 21 November, 2013 by Numan Tahir
	*/
	public function actCustomerSocial($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_social_detail(
						social_id,
						customer_id,
						fb_user_id,
						fb_profile_link,
						fb_username,
						join_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("social_id", "V") ? $this->getProperty("social_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fb_user_id", "V") ? "'" . $this->getProperty("fb_user_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fb_profile_link", "V") ? "'" . $this->getProperty("fb_profile_link") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fb_username", "V") ? "'" . $this->getProperty("fb_username") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("join_date", "V") ? "'" . $this->getProperty("join_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_social_detail SET ";
				
				if($this->isPropertySet("fb_user_id", "K")){
					$Sql .= "$con fb_user_id='" . $this->getProperty("fb_user_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("fb_profile_link", "K")){
					$Sql .= "$con fb_profile_link='" . $this->getProperty("fb_profile_link") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("social_id", "V")){
					$Sql .= " AND social_id='" . $this->getProperty("social_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_social_detail
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Student List to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 21 November, 2013
	* @modified 21 November, 2013 by Numan Tahir
	*/
	public function actCustomerWorkStudentList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_student_list(
						work_student_list,
						customer_work_id,
						customer_id,
						student_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_student_list", "V") ? $this->getProperty("work_student_list") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_id", "V") ? "'" . $this->getProperty("student_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_student_list SET ";
				
				if($this->isPropertySet("customer_work_id", "K")){
					$Sql .= "$con customer_work_id='" . $this->getProperty("customer_work_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= "$con customer_id='" . $this->getProperty("customer_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("student_id", "K")){
					$Sql .= "$con student_id='" . $this->getProperty("student_id") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("work_student_list", "V")){
					$Sql .= " AND work_student_list='" . $this->getProperty("work_student_list") . "'";
				}
				
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_student_list
						WHERE
							1=1";
				
				if($this->isPropertySet("work_student_list", "V")){
					$Sql .= " AND work_student_list='" . $this->getProperty("work_student_list") . "'";
				}
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Contact List to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 25 November, 2013
	* @modified 25 November, 2013 by Numan Tahir
	*/
	public function actCustomeContactList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_mail_contact_list(
						customer_msg_contact_id,
						customer_id,
						contact_id,
						msg_contact_date,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_msg_contact_id", "V") ? $this->getProperty("customer_msg_contact_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_id", "V") ? "'" . $this->getProperty("contact_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("msg_contact_date", "V") ? "'" . $this->getProperty("msg_contact_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_mail_contact_list
						WHERE
							1=1";
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				
				if($this->isPropertySet("customer_msg_contact_id", "V")){
					$Sql .= " AND customer_msg_contact_id='" . $this->getProperty("customer_msg_contact_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Notifications to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerNotifications($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_notifications(
						notification_id,
						customer_id,
						notification_detail,
						notification_date,
						notification_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("notification_id", "V") ? $this->getProperty("notification_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("notification_detail", "V") ? "'" . $this->getProperty("notification_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("notification_date", "V") ? "'" . $this->getProperty("notification_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("notification_status", "V") ? "'" . $this->getProperty("notification_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_notifications SET ";
				
				if($this->isPropertySet("notification_status", "K")){
					$Sql .= "$con notification_status='" . $this->getProperty("notification_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("notification_id", "V")){
					$Sql .= " AND notification_id='" . $this->getProperty("notification_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_notifications
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Availability to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerAvailability($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_availability(
						availability_id,
						customer_id,
						availability_title,
						availability_start,
						availability_end,
						availability_status,
						is_active) 
						VALUES(";
				$Sql .= $this->isPropertySet("availability_id", "V") ? $this->getProperty("availability_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_title", "V") ? "'" . $this->getProperty("availability_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_start", "V") ? "'" . $this->getProperty("availability_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_end", "V") ? "'" . $this->getProperty("availability_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("availability_status", "V") ? "'" . $this->getProperty("availability_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_availability SET ";
				
				if($this->isPropertySet("availability_title", "K")){
					$Sql .= "$con availability_title='" . $this->getProperty("availability_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("availability_start", "K")){
					$Sql .= "$con availability_start='" . $this->getProperty("availability_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("availability_end", "K")){
					$Sql .= "$con availability_end='" . $this->getProperty("availability_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("is_active", "K")){
					$Sql .= "$con is_active='" . $this->getProperty("is_active") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("availability_id", "V")){
					$Sql .= " AND availability_id='" . $this->getProperty("availability_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_availability
						WHERE
							1=1";
				if($this->isPropertySet("availability_id", "V")){
					$Sql .= " AND availability_id='" . $this->getProperty("availability_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Applied List to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerAppliedList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_job_applied_list(
						job_apply_id,
						customer_work_id,
						student_id,
						apply_date,
						student_work_id,
						match_value,
						cover_letter,
						job_type_id,
						applyed_viewes) 
						VALUES(";
				$Sql .= $this->isPropertySet("job_apply_id", "V") ? $this->getProperty("job_apply_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_id", "V") ? "'" . $this->getProperty("student_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("apply_date", "V") ? "'" . $this->getProperty("apply_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_work_id", "V") ? "'" . $this->getProperty("student_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("match_value", "V") ? "'" . $this->getProperty("match_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cover_letter", "V") ? "'" . $this->getProperty("cover_letter") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_type_id", "V") ? "'" . $this->getProperty("job_type_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("applyed_viewes", "V") ? "'" . $this->getProperty("applyed_viewes") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_job_applied_list SET ";
				
				if($this->isPropertySet("job_type_id", "K")){
					$Sql .= "$con job_type_id='" . $this->getProperty("job_type_id") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("applyed_viewes", "K")){
					$Sql .= "$con applyed_viewes='" . $this->getProperty("applyed_viewes") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("job_apply_id", "V")){
					$Sql .= " AND job_apply_id='" . $this->getProperty("job_apply_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_job_applyed_list
						WHERE
							1=1";
				if($this->isPropertySet("job_apply_id", "V")){
					$Sql .= " AND job_apply_id='" . $this->getProperty("job_apply_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("student_id", "V")){
					$Sql .= " AND student_id='" . $this->getProperty("student_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Slots Detail to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerWorkSlotsDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_slots_list(
						work_slots_id,
						customer_id,
						customer_work_id,
						student_id,
						student_work_id,
						student_match_value,
						entry_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_slots_id", "V") ? $this->getProperty("work_slots_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_id", "V") ? "'" . $this->getProperty("student_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_work_id", "V") ? "'" . $this->getProperty("student_work_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_match_value", "V") ? "'" . $this->getProperty("student_match_value") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entry_date", "V") ? "'" . $this->getProperty("entry_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_slots_list SET ";
				
				if($this->isPropertySet("student_id", "K")){
					$Sql .= "$con student_id='" . $this->getProperty("student_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("student_work_id", "K")){
					$Sql .= "$con student_work_id='" . $this->getProperty("student_work_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("student_match_value", "K")){
					$Sql .= "$con student_match_value='" . $this->getProperty("student_match_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("entry_date", "K")){
					$Sql .= "$con entry_date='" . $this->getProperty("entry_date") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("work_slots_id", "V")){
					$Sql .= " AND work_slots_id='" . $this->getProperty("work_slots_id") . "'";
				}
				if($this->isPropertySet("student_id_zero", "V")){
					$Sql .= " AND student_id='0'";
				}
				if($this->isPropertySet("student_work_id_zero", "V")){
					$Sql .= " AND student_work_id='0'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_slots_list
						WHERE
							1=1";
				if($this->isPropertySet("work_slots_id", "V")){
					$Sql .= " AND work_slots_id='" . $this->getProperty("work_slots_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Newsleter Info to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerWorkNewsletterInfo($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_newsletter_info(
						newsletter_work_id,
						customer_work_id,
						customer_id,
						entry_date,
						sending_date,
						newsletter_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("newsletter_work_id", "V") ? $this->getProperty("newsletter_work_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entry_date", "V") ? "'" . $this->getProperty("entry_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_date", "V") ? "'" . $this->getProperty("sending_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("newsletter_status", "V") ? "'" . $this->getProperty("newsletter_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_newsletter_info SET ";
				
				if($this->isPropertySet("sending_date", "K")){
					$Sql .= "$con sending_date='" . $this->getProperty("sending_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("newsletter_status", "K")){
					$Sql .= "$con newsletter_status='" . $this->getProperty("newsletter_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("newsletter_work_id", "V")){
					$Sql .= " AND newsletter_work_id='" . $this->getProperty("newsletter_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_newsletter_info
						WHERE
							1=1";
				if($this->isPropertySet("newsletter_work_id", "V")){
					$Sql .= " AND newsletter_work_id='" . $this->getProperty("newsletter_work_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Newsleter Send Log to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 26 November, 2013
	* @modified 26 November, 2013 by Numan Tahir
	*/
	public function actCustomerWorkNewsletterLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_newsletter_log(
						newsletter_log_id,
						newsletter_id,
						customer_id,
						sending_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("newsletter_log_id", "V") ? $this->getProperty("newsletter_log_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("newsletter_id", "V") ? "'" . $this->getProperty("newsletter_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_date", "V") ? "'" . $this->getProperty("sending_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				/*$Sql = "UPDATE rs_tbl_customer_work_newsletter_log SET ";
				
				if($this->isPropertySet("sending_date", "K")){
					$Sql .= "$con sending_date='" . $this->getProperty("sending_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("newsletter_status", "K")){
					$Sql .= "$con newsletter_status='" . $this->getProperty("newsletter_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("newsletter_work_id", "V")){
					$Sql .= " AND newsletter_work_id='" . $this->getProperty("newsletter_work_id") . "'";
				}*/
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_newsletter_log
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("newsletter_id", "V")){
					$Sql .= " AND newsletter_id='" . $this->getProperty("newsletter_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Reference to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 13 Feb, 2014
	* @modified 13 Feb, 2014 by Numan Tahir
	*/
	public function actCustomerWorkReference($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_reference(
						work_reference_id,
						customer_work_id,
						customer_id,
						ref_f_name,
						ref_l_name,
						ref_f_position,
						ref_contact_info,
						ref_contact_email) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_reference_id", "V") ? $this->getProperty("work_reference_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ref_f_name", "V") ? "'" . $this->getProperty("ref_f_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ref_l_name", "V") ? "'" . $this->getProperty("ref_l_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ref_f_position", "V") ? "'" . $this->getProperty("ref_f_position") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ref_contact_info", "V") ? "'" . $this->getProperty("ref_contact_info") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ref_contact_email", "V") ? "'" . $this->getProperty("ref_contact_email") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_reference SET ";
				
				if($this->isPropertySet("ref_f_name", "K")){
					$Sql .= "$con ref_f_name='" . $this->getProperty("ref_f_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ref_l_name", "K")){
					$Sql .= "$con ref_l_name='" . $this->getProperty("ref_l_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ref_f_position", "K")){
					$Sql .= "$con ref_f_position='" . $this->getProperty("ref_f_position") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ref_contact_info", "K")){
					$Sql .= "$con ref_contact_info='" . $this->getProperty("ref_contact_info") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ref_contact_email", "K")){
					$Sql .= "$con ref_contact_email='" . $this->getProperty("ref_contact_email") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("work_reference_id", "V")){
					$Sql .= " AND work_reference_id='" . $this->getProperty("work_reference_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_reference
						WHERE
							1=1";
				if($this->isPropertySet("work_reference_id", "V")){
					$Sql .= " AND work_reference_id='" . $this->getProperty("work_reference_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Availability Detail to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 24 March, 2014
	* @modified 24 March, 2014 by Numan Tahir
	*/
	public function actCustomerAvailabilityNewStyle($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_availability_new_style(
						c_ava_id,
						customer_id,
						mon_status,
						tues_status,
						web_status,
						thurs_status,
						fri_status,
						sat_status,
						sun_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("c_ava_id", "V") ? $this->getProperty("c_ava_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mon_status", "V") ? "'" . $this->getProperty("mon_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tues_status", "V") ? "'" . $this->getProperty("tues_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("web_status", "V") ? "'" . $this->getProperty("web_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("thurs_status", "V") ? "'" . $this->getProperty("thurs_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fri_status", "V") ? "'" . $this->getProperty("fri_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sat_status", "V") ? "'" . $this->getProperty("sat_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sun_status", "V") ? "'" . $this->getProperty("sun_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_availability_new_style SET ";
				
				if($this->isPropertySet("mon_status", "K")){
					$Sql .= "$con mon_status='" . $this->getProperty("mon_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tues_status", "K")){
					$Sql .= "$con tues_status='" . $this->getProperty("tues_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("web_status", "K")){
					$Sql .= "$con web_status='" . $this->getProperty("web_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("thurs_status", "K")){
					$Sql .= "$con thurs_status='" . $this->getProperty("thurs_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("fri_status", "K")){
					$Sql .= "$con fri_status='" . $this->getProperty("fri_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sat_status", "K")){
					$Sql .= "$con sat_status='" . $this->getProperty("sat_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sun_status", "K")){
					$Sql .= "$con sun_status='" . $this->getProperty("sun_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("c_ava_id", "V")){
					$Sql .= " AND c_ava_id='" . $this->getProperty("c_ava_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_availability_new_style
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Availability Detail to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 24 March, 2014
	* @modified 24 March, 2014 by Numan Tahir
	*/
	public function actCustomerWorkAvailabilityNewStyle($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_availability_new_style(
						wc_ava_id,
						customer_id,
						customer_work_id,
						mon_status,
						tues_status,
						web_status,
						thurs_status,
						fri_status,
						sat_status,
						sun_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("wc_ava_id", "V") ? $this->getProperty("wc_ava_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mon_status", "V") ? "'" . $this->getProperty("mon_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tues_status", "V") ? "'" . $this->getProperty("tues_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("web_status", "V") ? "'" . $this->getProperty("web_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("thurs_status", "V") ? "'" . $this->getProperty("thurs_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fri_status", "V") ? "'" . $this->getProperty("fri_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sat_status", "V") ? "'" . $this->getProperty("sat_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sun_status", "V") ? "'" . $this->getProperty("sun_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_availability_new_style SET ";
				
				if($this->isPropertySet("mon_status", "K")){
					$Sql .= "$con mon_status='" . $this->getProperty("mon_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tues_status", "K")){
					$Sql .= "$con tues_status='" . $this->getProperty("tues_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("web_status", "K")){
					$Sql .= "$con web_status='" . $this->getProperty("web_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("thurs_status", "K")){
					$Sql .= "$con thurs_status='" . $this->getProperty("thurs_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("fri_status", "K")){
					$Sql .= "$con fri_status='" . $this->getProperty("fri_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sat_status", "K")){
					$Sql .= "$con sat_status='" . $this->getProperty("sat_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sun_status", "K")){
					$Sql .= "$con sun_status='" . $this->getProperty("sun_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("wc_ava_id", "V")){
					$Sql .= " AND wc_ava_id='" . $this->getProperty("wc_ava_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_availability_new_style
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Availability Detail to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 24 March, 2014
	* @modified 24 March, 2014 by Numan Tahir
	*/
	public function actCustomerWorkCapacity($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_capacity(
						customer_capacity_id,
						customer_work_id,
						customer_id,
						capacity_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_capacity_id", "V") ? $this->getProperty("customer_capacity_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("capacity_id", "V") ? "'" . $this->getProperty("capacity_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_capacity
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Notification to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 25 April, 2014
	* @modified 25 April, 2014 by Numan Tahir
	*/
	public function actCustomerWorkNotification($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_notifications(
						work_notification_id,
						customer_id,
						customer_work_id,
						student_work_id,
						match_value,
						work_notification_date,
						work_notification_status,
						notification_type,
						apply_status) 
						VALUES(";
				$Sql .= $this->isPropertySet("work_notification_id", "V") ? $this->getProperty("work_notification_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("student_work_id", "V") ? "'" . $this->getProperty("student_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("match_value", "V") ? "'" . $this->getProperty("match_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("work_notification_date", "V") ? "'" . $this->getProperty("work_notification_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("work_notification_status", "V") ? "'" . $this->getProperty("work_notification_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("notification_type", "V") ? "'" . $this->getProperty("notification_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("apply_status", "V") ? "'" . $this->getProperty("apply_status") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_notifications SET ";
				
				if($this->isPropertySet("work_notification_status", "K")){
					$Sql .= "$con work_notification_status='" . $this->getProperty("work_notification_status") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("apply_status", "K")){
					$Sql .= "$con apply_status='" . $this->getProperty("apply_status") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("work_notification_id", "V")){
					$Sql .= " AND work_notification_id='" . $this->getProperty("work_notification_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_notifications
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Work Notification to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	* @Date 25 April, 2014
	* @modified 25 April, 2014 by Numan Tahir
	*/
	public function actCustomerWorkSearchPostCode($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer_work_post_search(
						search_post_id,
						customer_id,
						customer_work_id,
						post_code,
						requested_post_code) 
						VALUES(";
				$Sql .= $this->isPropertySet("search_post_id", "V") ? $this->getProperty("search_post_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_work_id", "V") ? "'" . $this->getProperty("customer_work_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("post_code", "V") ? "'" . $this->getProperty("post_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("requested_post_code", "V") ? "'" . $this->getProperty("requested_post_code") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer_work_post_search SET ";
				
				if($this->isPropertySet("post_code", "K")){
					$Sql .= "$con post_code='" . $this->getProperty("post_code") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("requested_post_code", "K")){
					$Sql .= "$con requested_post_code='" . $this->getProperty("requested_post_code") . "'";
					$con = ",";
				}
							
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			case "D":
				$Sql = "DELETE FROM rs_tbl_customer_work_post_search
						WHERE
							1=1";
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("customer_work_id", "V")){
					$Sql .= " AND customer_work_id='" . $this->getProperty("customer_work_id") . "'";
				}
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
      
            public function CustomerSuccessList($customer_id){
		$Sql = "SELECT 
					customer_id,
					email,
					first_name,
					last_name,
					CONCAT(first_name,' ',last_name) AS fullname,
					phone
				
				FROM
					rs_tbl_customer 
				WHERE 
					customer_id=$customer_id";
		$this->dbQuery($Sql);
	}
	
}
?>