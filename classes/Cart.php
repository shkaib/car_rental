<?php
/**
*
* This is a class Cart
* @version 0.01
* @author Numan Tahir <numan@elanist.com>
* @Date 30 May, 2013
* @modified 30 May, 2013 by Numan Tahir
*
**/
class Cart extends Database{

	private $mOrderCode = ""; # The shopping order code


	public function __construct(){

		parent::__construct();

		if($_SESSION['OrderCode']){

			$this->mOrderCode = $_SESSION['OrderCode'];
		}
	}



	/**
	* Product::genOrderCode()	
	* This function is used to get 15 degit unique order code
	* @author Numan Tahir
	* @Date 11 July,2012
 	* @param int $cart_cd	
	* @modified 14 April, 2008 by Numan Tahir
	* @return string
	*/
	public function genOrderCode($cart_cd){
		$cart_cd 	= str_pad($cart_cd, 5, "0", STR_PAD_LEFT);
		$time 		= md5(time());
		$order_cd 	= substr($time, rand(0, 22), 6);
		$order_cd	= $order_cd . $cart_cd;
		$_SESSION['OrderCode'] = $order_cd;
		setcookie("OrderCode", $order_cd, time() + 60 * 60 * 24 * 30);
		return $order_cd;
	}
	
	/**
	* Product::genOrderNewCode()	
	* This function is used to get 15 degit unique order code
	* @author Numan Tahir
	* @Date 11 July,2012
 	* @param int $cart_cd	
	* @modified 14 April, 2008 by Numan Tahir
	* @return string
	*/
	
	public function genOrderNewCode($cart_cd){
		$cart_cd 	= str_pad($cart_cd, 5, "0", STR_PAD_LEFT);
		$time 		= md5(time());
		$order_cd 	= substr($time, rand(0, 22), 6);
		$order_cd	= $order_cd . $cart_cd;
		return $order_cd;
	}


	/**
	* Product::getOrderCode()	
	* This function is used to get 15 degit unique order code
	* @author Numan Tahir
	* @Date 14 April, 2008
	* @modified 14 April, 2008 by Numan Tahir
	* @return string
	*/
	public function getOrderCode(){
		if($this->mOrderCode){
			return $this->mOrderCode;
		}
		else{
			return false;
		}
	}
	
	/**
	* Product::showCart()	
	* This function is used to show the cart
	* @author Numan Tahir
	* @Date 14 April, 2008
 	* @param int $product_id	
	* @modified 14 April, 2008 by Numan Tahir
	* @return string
	*/
	public function showCart(){
		$Sql = "SELECT 
					cart_id,
					order_id,
					customer_id,
					package_id,
					cart_quantity,
					cart_price,
					cart_lng,
					add_date,
					is_active
				FROM
					rs_tbl_cart
				WHERE
					1=1 
					AND order_id='" . $this->getProperty("order_id") . "'";
		
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		}
		
		if($this->isPropertySet("package_id", "V")){
			$Sql .= " AND package_id='" . $this->getProperty("package_id") . "'";
		}
		
		if($this->isPropertySet("is_active", "V")){
			$Sql .= " AND is_active='" . $this->getProperty("is_active") . "'";
		}

		if($this->isPropertySet("GROUPEDBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPEDBY");
		}
		
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* Product::CartSum()	
	* This function is used to show the cart Sum
	* @author Numan Tahir
	* @Date 03 March, 2013
 	* @param int $product_id	
	* @modified 03 March, 2013 by Numan Tahir
	* @return string
	*/

	public function CartSum(){
		$Sql = "SELECT 
					sum(cart_price) as total_amount
				FROM
					rs_tbl_cart
				WHERE
					1=1 
					AND order_id='" . $this->getProperty("order_id") . "'";
		
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		}
		
		if($this->isPropertySet("package_id", "V")){
			$Sql .= " AND package_id='" . $this->getProperty("package_id") . "'";
		}
		
		if($this->isPropertySet("GROUPEDBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPEDBY");
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* Product::CartSum()	
	* This function is used to show the cart Sum
	* @author Numan Tahir
	* @Date 03 March, 2013
 	* @param int $product_id	
	* @modified 03 March, 2013 by Numan Tahir
	* @return string
	*/

	public function lstCartNote(){
		$Sql = "SELECT 
					cart_note_id,
					cart_id,
					order_id,
					customer_id,
					cart_note
				FROM
					rs_tbl_cart_note
				WHERE
					1=1 
					AND order_id='" . $this->getProperty("order_id") . "'";
		
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
		}
		
		if($this->isPropertySet("GROUPEDBY", "V")){
			$Sql .= " GROUP BY " . $this->getProperty("GROUPEDBY");
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* Product::actCart()	
	* This function is used to Add/Edit/Delete the cart
	* @author Numan Tahir
	* @Date 11 July, 2012
 	* @param int $mode	
	* @modified 14 April, 2008 by Numan Tahir
	* @return string
	*/
	public function actCart($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case 'I':
				$Sql = "INSERT INTO rs_tbl_cart(
							cart_id,
							order_id,
							customer_id,
							package_id,
							cart_quantity,
							cart_price,
							cart_lng,
							add_date,
							is_active) 
						VALUES(";

				$Sql .= $this->isPropertySet("cart_id", "V") ? $this->getProperty("cart_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? "'" . $this->getProperty("order_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("package_id", "V") ? $this->getProperty("package_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cart_quantity", "V") ? "'" . $this->getProperty("cart_quantity") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cart_price", "V") ? "'" . $this->getProperty("cart_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cart_lng", "V") ? "'" . $this->getProperty("cart_lng") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("add_date", "V") ? "'" . $this->getProperty("add_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_active", "V") ? "'" . $this->getProperty("is_active") . "'" : "NULL";
				$Sql .= ")";
				break;

			case 'U':
				$Sql = "UPDATE rs_tbl_cart SET ";
				if($this->isPropertySet("quantity", "K")){
					$Sql .= "$pro quantity='" . $this->getProperty("quantity") . "'";
					$pro = ",";
				}
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= "$pro customer_id='" . $this->getProperty("customer_id") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("cart_id", "K")){
					$Sql .= " AND cart_id='" . $this->getProperty("cart_id") . "'";
				}
				if($this->isPropertySet("order_id", "K")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}	
				break;

			case 'D':
				$Sql = "DELETE FROM rs_tbl_cart  
						WHERE 1=1";
						
				if($this->isPropertySet("order_id", "V")){
				 $Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				if($this->isPropertySet("seller_id", "V")){
				 $Sql .= " AND seller_id='" . $this->getProperty("seller_id") . "'";
				}
				if($this->isPropertySet("cart_id", "V")){
				 $Sql .= " AND cart_id='" . $this->getProperty("cart_id") . "'";
				}
				break;

			default:
				break;
		}
		$this->dbQuery($Sql);
	}
	
	/**
	* Product::actCartNote()	
	* This function is used to Add/Edit/Delete the cart note
	* @author Numan Tahir
	* @Date 04 March, 2013
 	* @param int $mode	
	* @modified 04 March, 2013 by Numan Tahir
	* @return string
	*/
	public function actCartNote($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case 'I':
				$Sql = "INSERT INTO rs_tbl_cart_note(
						cart_note_id,
						order_id,
						customer_id,
						cart_note) 
						VALUES(";
						
				$Sql .= $this->isPropertySet("cart_note_id", "V") ? $this->getProperty("cart_note_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? "'" . $this->getProperty("order_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cart_note", "V") ? "'" . $this->getProperty("cart_note") . "'" : "NULL";
				$Sql .= ")";
				break;

			case 'U':
				$Sql = "UPDATE rs_tbl_cart_note SET ";
				if($this->isPropertySet("cart_note", "K")){
					$Sql .= "$pro cart_note='" . $this->getProperty("cart_note") . "'";
					$pro = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				if($this->isPropertySet("order_id", "K")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				break;

			case 'D':
				$Sql = "DELETE FROM rs_tbl_cart_note  
						WHERE 1=1";
				if($this->isPropertySet("order_id", "V")){
				 $Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
				 $Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;

			default:
				break;
		}
		$this->dbQuery($Sql);
	}
}

?>