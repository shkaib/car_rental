<?php
/**
*
* This is a class Customer
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
* @Date 14 April, 2008
* @modified 14 April, 2008 by Numan Tahir
*
**/
class CountrySel extends Database{
	public $site_country;
	public $country_status;
	/**
	* This is the constructor of the class Customer
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	* @Date 14 April, 2008
	* @modified 14 April, 2008 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();

		//if($_SESSION['site_country']){
			$this->site_country 	= $_SESSION['site_country'];
			$this->country_status	= $_SESSION['country_status'];
		//}
	}

	/**
	* This is the function to set the customer logged in
	* @author Numan Tahir
	* @Date 14 April, 2008
	* @modified 14 April, 2008 by Numan Tahir
	*/
	public function setCountryMake(){
	
		# Logged in customer's member code
		if($this->isPropertySet("site_country", "V"))
			$_SESSION['site_country'] 		= $this->getProperty("site_country");
		
		# Logged in customer's email
		if($this->isPropertySet("country_status", "V"))
			$_SESSION['country_status'] = $this->getProperty("country_status");
		
	}
	
}
?>