<?php
/**
*
* This is a class Order
* @version 0.01
* @author Numan Tahir <numan@elanist.com>
* @modified by Numan Tahir
*
**/
class Order extends Database{
	public $mOrderStatus = array();
	/**
	* This is the constructor of the class Order
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	* @date 30 May, 2013
	* @modified 30 May, 2013 by Numan Tahir
	*/
	public function __construct(){
		parent::__construct();
		if($_COOKIE['OrderCode']){
			$this->mOrderCode = $_COOKIE['OrderCode'];
		}
		else if($_SESSION['OrderCode']){
			$this->mOrderCode = $_SESSION['OrderCode'];
		}
		$this->mOrderStatus = array('Pending', 'In Proccess', 'Delivered', 'Cancelled');
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
		$_SESSION['OrderCode'] = $order_cd;
		setcookie("OrderCode", $order_cd, time() + 60 * 60 * 24 * 30);
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
	* Order::lstOrder()	
	* This function is used to list all the orders
	* @author Numan Tahir
	* @modified by Numan Tahir
	* @return bool
	*/
	public function lstOrder(){
		$Sql = "SELECT 
					order_id,
					customer_id,
					product_id,
					product_name,
					order_date,
					sub_total,
					grand_total,
					order_type,
					start_date,
					end_date,
					pickup_location_id,
					drop_location_id,
					product_price,
					order_status,
					payment_method
				FROM
					rs_tbl_order
				WHERE
					1=1";
		
		if($this->isPropertySet("order_id", "V")){
			$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
		}
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		}
		if($this->isPropertySet("product_id", "V")){
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		}
		if($this->isPropertySet("order_type", "V")){
			$Sql .= " AND order_type='" . $this->getProperty("order_type") . "'";
		}
		if($this->isPropertySet("order_status", "V")){
			$Sql .= " AND order_status='" . $this->getProperty("order_status") . "'";
		}
		if($this->isPropertySet("from_dt", "V") && $this->isPropertySet("to_dt", "V")){
			$Sql .= " AND LEFT(order_date, 10) BETWEEN '" . $this->getProperty("from_dt") . "' AND '" . $this->getProperty("to_dt") . "'";
		}
		if($this->isPropertySet("from_date", "V") && $this->isPropertySet("to_date", "V")){
			$Sql .= " AND order_date BETWEEN '" . $this->getProperty("from_date") . "' AND '" . $this->getProperty("to_date") . "'";
		}
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		return $this->dbQuery($Sql);
	}
	
	/**
	* Order::lstOrderDetail()	
	* This function is used to list all the orders
	* @author Numan Tahir
	* @modified by Numan Tahir
	* @return bool
	*/
	public function lstOrderDetail(){
		$Sql = "SELECT 
					order_detail_id,
					order_id,
					customer_id,
					extra_feature_id,
					feature_name,
					quantity,
					price
				FROM
					rs_tbl_order_details
				WHERE
					1=1";
		
		if($this->isPropertySet("order_detail_id", "V")){
			$Sql .= " AND order_detail_id='" . $this->getProperty("order_detail_id") . "'";
		}
		if($this->isPropertySet("order_id", "V")){
			$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
		}
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		}
		if($this->isPropertySet("extra_feature_id", "V")){
			$Sql .= " AND extra_feature_id='" . $this->getProperty("extra_feature_id") . "'";
		}
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		return $this->dbQuery($Sql);
	}

	/**
	* Order::actOrder()	
	* This function is used to Add/Edit/Delete the order
	* @author Numan Tahir
 	* @param int $mode	
	* @return string
	*/
	public function actOrder($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case 'I':
				$Sql = "INSERT INTO rs_tbl_order(
							order_id,
							customer_id,
							product_id,
							product_name,
							order_date,
							sub_total,
							grand_total,
							order_type,
							start_date,
							end_date,
							pickup_location_id,
							drop_location_id,
							product_price,
							order_status,							
							payment_method) 
							VALUES(";
				$Sql .= $this->isPropertySet("order_id", "V") ? "'" . $this->getProperty("order_id"). "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? "'" . $this->getProperty("product_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_name", "V") ? "'" . $this->getProperty("product_name"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_date", "V") ? "'" . $this->getProperty("order_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sub_total", "V") ? "'" .$this->getProperty("sub_total"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("grand_total", "V") ? "'" .$this->getProperty("grand_total"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_type", "V") ? "'" . $this->getProperty("order_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pickup_location_id", "V") ? "'" .$this->getProperty("pickup_location_id") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("drop_location_id", "V") ? "'" .$this->getProperty("drop_location_id") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price", "V") ? "'" .$this->getProperty("product_price") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? "'" .$this->getProperty("order_status") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_method", "V") ? "'" .$this->getProperty("payment_method") ."'": "NULL";
				$Sql .= ")";
				break;

			case 'U':
				$Sql = "UPDATE rs_tbl_order SET ";
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;

			case 'D':
				$Sql = "DELETE FROM  rs_tbl_order  
						WHERE 1=1";
				if($this->isPropertySet("order_id", "V"))
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				break;
				
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* Order::actOrderDetail()	
	* This function is used to Add/Edit/Delete the order
	* @author Numan Tahir
 	* @param int $mode	
	* @return string
	*/
	public function actOrderDetail($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case 'I':
				$Sql = "INSERT INTO rs_tbl_order_details(
							order_detail_id,
							order_id,
							customer_id,
							extra_feature_id,
							feature_name,
							quantity,
							price) 
							VALUES(";
				$Sql .= $this->isPropertySet("order_detail_id", "V") ? "'" . $this->getProperty("order_detail_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? "'" . $this->getProperty("order_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_feature_id", "V") ? "'" . $this->getProperty("extra_feature_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("feature_name", "V") ? "'" . $this->getProperty("feature_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("quantity", "V") ? "'" .$this->getProperty("quantity"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("price", "V") ? "'" .$this->getProperty("price"). "'" : "NULL";
				$Sql .= ")";
				break;

			case 'U':
				$Sql = "UPDATE rs_tbl_order SET ";
				if($this->isPropertySet("extra_feature_id", "K")){
					$Sql .= "$con extra_feature_id='" . $this->getProperty("extra_feature_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("feature_name", "K")){
					$Sql .= "$con feature_name='" . $this->getProperty("feature_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("quantity", "K")){
					$Sql .= "$con quantity='" . $this->getProperty("quantity") . "'";
					$con = ",";
				}
				if($this->isPropertySet("price", "K")){
					$Sql .= "$con price='" . $this->getProperty("price") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("order_detail_id", "V")){
					$Sql .= " AND order_detail_id='" . $this->getProperty("order_detail_id") . "'";
				}
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				break;

			case 'D':
				$Sql = "DELETE FROM  rs_tbl_order_details  
						WHERE 1=1";
				if($this->isPropertySet("order_id", "V"))
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				break;
				
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
                 public function orderSuccessList($paymentid){
                 
		$Sql = "SELECT 
					order_id,
					paymentid,
					customer_id,
					product_id,
					product_name,
					order_date,
					sub_total,
					grand_total,
					order_type,
					start_date,
					end_date,
					pickup_location_id,
                                        (SELECT location_title FROM rs_tbl_location WHERE location_id=pickup_location_id) AS pickup_location_name,
					drop_location_id,
                                        (SELECT location_title FROM rs_tbl_location WHERE location_id=drop_location_id) AS drop_location_name,
					product_price,
					order_status,
					payment_method
				FROM
					rs_tbl_order
				WHERE
					paymentid='$paymentid'";
		               // echo $Sql ;exit;
		if($this->isPropertySet("order_id", "V")){
			$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
		}
		if($this->isPropertySet("paymentid", "V")){
			$Sql .= " AND paymentid='" . $this->getProperty("paymentid") . "'";
		}
		if($this->isPropertySet("customer_id", "V")){
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		}
		if($this->isPropertySet("product_id", "V")){
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		}
		if($this->isPropertySet("order_type", "V")){
			$Sql .= " AND order_type='" . $this->getProperty("order_type") . "'";
		}
		if($this->isPropertySet("order_status", "V")){
			$Sql .= " AND order_status='" . $this->getProperty("order_status") . "'";
		}
		if($this->isPropertySet("from_dt", "V") && $this->isPropertySet("to_dt", "V")){
			$Sql .= " AND LEFT(order_date, 10) BETWEEN '" . $this->getProperty("from_dt") . "' AND '" . $this->getProperty("to_dt") . "'";
		}
		if($this->isPropertySet("from_date", "V") && $this->isPropertySet("to_date", "V")){
			$Sql .= " AND order_date BETWEEN '" . $this->getProperty("from_date") . "' AND '" . $this->getProperty("to_date") . "'";
		}
		if($this->isPropertySet("ORDERBY", "V")){
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		}
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
                    
		return $this->dbQuery($Sql);
	}
	
	
	
	 public function actOrder1($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case 'I':
				$Sql = "INSERT INTO rs_tbl_order(
							order_id,
                                                        paymentid,
							customer_id,
							product_id,
							product_name,
							order_date,
							sub_total,
							grand_total,
							order_type,
							start_date,
							end_date,
							pickup_location_id,
							drop_location_id,
							product_price,
							order_status,							
							payment_method) 
							VALUES(";
				
                                
                                $Sql .= $this->isPropertySet("order_id", "V") ? "'" . $this->getProperty("order_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("paymentid", "V") ? "'" . $this->getProperty("paymentid"). "'" : "NULL";
				$Sql .= ",";                                
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? "'" . $this->getProperty("product_id"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_name", "V") ? "'" . $this->getProperty("product_name"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_date", "V") ? "'" . $this->getProperty("order_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sub_total", "V") ? "'" .$this->getProperty("sub_total"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("grand_total", "V") ? "'" .$this->getProperty("grand_total"). "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_type", "V") ? "'" . $this->getProperty("order_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pickup_location_id", "V") ? "'" .$this->getProperty("pickup_location_id") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("drop_location_id", "V") ? "'" .$this->getProperty("drop_location_id") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price", "V") ? "'" .$this->getProperty("product_price") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? "'" .$this->getProperty("order_status") ."'": "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_method", "V") ? "'" .$this->getProperty("payment_method") ."'": "NULL";
				$Sql .= ")";
				break;

			case 'U':
				$Sql = "UPDATE rs_tbl_order SET ";
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				if($this->isPropertySet("customer_id", "V")){
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
				}
				break;

			case 'D':
				$Sql = "DELETE FROM  rs_tbl_order  
						WHERE 1=1";
				if($this->isPropertySet("order_id", "V"))
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				break;
				
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	
}
?>