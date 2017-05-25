<?php  //echo '<pre>';print_r($_POST);exit;
if($_POST["save_val"]!=''){
        $ci = DecData($_POST["ci"]);
        $pli = DecData($_POST["pli"]);
        $rli = DecData($_POST["rli"]);
        $pd = DecData($_POST["pd"]);
        $pt = DecData($_POST["pt"]);
        $rd = DecData($_POST["rd"]);
        $rt = DecData($_POST["rt"]);
        $TotalAmount = $_POST["tpic"];
        $number_of_days = $_POST["number_of_days"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $nationality = $_POST["nationality"];
        $chk = $_POST["chk"];
        $total_amount = $_POST["total_amount"];
    
    if($_POST["paytype"]=='debit'){
       //echo '<pre>';print_r($_POST);exit;
        require_once("e24PaymentPipe.inc.php");
        $accATM = new e24PaymentPipe;
        $accATM->resourcePath = 'resource/';
        $accATM->alias = 'EXPRESS_RENT';
        $accATM->action = '1';
        $accATM->currency = '048';
        $accATM->language = 'USA';
        $accATM->amt = $total_amount;
        $accATM->responseURL = 'http://www.expressrcar.com/payment/response.php';
        $accATM->errorURL = 'http://www.expressrcar.com/error';
        $accATM->trackId = date('YmdHis');
        $accATM->udf2 = 'ud2465665';
        $accATM->udf3 = 'ud3231213';
        $accATM->udf4 = 'ud4785653';
        $accATM->udf5 = 'ud5554788';
        $TransVal = $accATM->performPaymentInitialization();
        $varRawResponse = $accATM->getRawResponse();
        $varPaymentId = $accATM->getPaymentId();
        $varPaymentPage = $accATM->getPaymentPage();
        $varErrorMsg = $accATM->getErrorMsg();
       // echo '<pre>';print_r($varPaymentId);exit;
        
        $objListofCar = new Product;
        $objListofCar->setProperty("product_id", $ci);
        $objListofCar->lstProducts();
        $CarList = $objListofCar->dbFetchArray(1);

        //echo $order_id = $objCart->getOrderCode();
        $customer_id = $objAdminUser->genCode("rs_tbl_customer", "customer_id");
        $objCustomer->setProperty("customer_id", $customer_id);
        $objCustomer->setProperty("email", $email);
        $objCustomer->setProperty("pass", md5('dummypass'));
        $objCustomer->setProperty("first_name", $fname);
        $objCustomer->setProperty("last_name", $lname);
        $objCustomer->setProperty("country", $nationality);
        $objCustomer->setProperty("phone", $mobile);
        $objCustomer->setProperty("is_active", 1);
        $objCustomer->setProperty("customer_type", 1);
        if($objCustomer->actCustomer("I")){
        $order_id 	= $objCart->genOrderCode($customer_id);

        $objOrder->setProperty("order_id", $order_id);
        $objOrder->setProperty("paymentid", $varPaymentId);
        $objOrder->setProperty("customer_id", $customer_id);
        $objOrder->setProperty("product_id", $ci);

        $objOrder->setProperty("product_name", $CarList["product_name"]);
        $objOrder->setProperty("order_date", date('Y-m-d H:i:s'));
        $objOrder->setProperty("grand_total", $total_amount);
        $objOrder->setProperty("order_type", 1);
        $objOrder->setProperty("start_date", $pd .' ' . $pt);
        $objOrder->setProperty("end_date", $rd .' ' . $rt);
        $objOrder->setProperty("pickup_location_id", $pli);
        $objOrder->setProperty("drop_location_id", $rli);
        $objOrder->setProperty("product_price", $TotalAmount);
        $objOrder->setProperty("order_status", 1);
        $objOrder->actOrder1("I");

        $objOrderDetail = new Order;
        $objExtraFeature = new Product;
        for($i=0;$i<=count($chk);$i++){
        //	echo $chk[$i].'---<br>';
        if($chk[$i]!=''){
        $objExtraFeature->setProperty("extra_feature_id", $chk[$i]);
        $objExtraFeature->lstExtraFeature();
        $ExtraFeature = $objExtraFeature->dbFetchArray(1);
        //$extrafeature_amount += $ExtraFeature["feature_price"];
        $order_detail_id = $objAdminUser->genCode("rs_tbl_order_details", "order_detail_id");
        $objOrderDetail->setProperty("order_detail_id", $order_detail_id);
        $objOrderDetail->setProperty("order_id", $order_id);
        $objOrderDetail->setProperty("customer_id", $customer_id);

        $objOrderDetail->setProperty("extra_feature_id", $ExtraFeature["extra_feature_id"]);
        $objOrderDetail->setProperty("feature_name", $ExtraFeature["feature_name"]);
        $objOrderDetail->setProperty("quantity", 1);
        $objOrderDetail->setProperty("price", $ExtraFeature["feature_price"]);
        $objOrderDetail->actOrderDetail("I");

        }
       }
      }
                
    }else{
        $virtualPaymentClientURL = 'https://migs.mastercard.com.au/vpcpay';    
        $vpc_Version = 1;
        $vpc_Command = 'pay';         
        $vpc_AccessCode = '849EE82A';
        $vpc_Merchant = 'E01805900';
        $vpc_ReturnURL = 'https://www.expressrcar.com/paymentresponse.php';
        $vpc_Locale = 'en_AU';
        $vpc_Currency = 'BHD';
        $vpc_AddendumData='/VER/1//SVC/1//OVR/Y//CFN/'.$fname.'//CLN/'.$lname.'//CE/'.$email.'/';    
        $objListofCar = new Product;
        $objListofCar->setProperty("product_id", $ci);
        $objListofCar->lstProducts();
        $CarList = $objListofCar->dbFetchArray(1);
        //echo $order_id = $objCart->getOrderCode();
        $customer_id = $objAdminUser->genCode("rs_tbl_customer", "customer_id");
        $objCustomer->setProperty("customer_id", $customer_id);
        $objCustomer->setProperty("email", $email);
        $objCustomer->setProperty("pass", md5('dummypass'));
        $objCustomer->setProperty("first_name", $fname);
        $objCustomer->setProperty("last_name", $lname);
        $objCustomer->setProperty("country", $nationality);
        $objCustomer->setProperty("phone", $mobile);
        $objCustomer->setProperty("is_active", 1);
        $objCustomer->setProperty("customer_type", 1);
        if($objCustomer->actCustomer("I")){
        $order_id 	= $objCart->genOrderCode($customer_id);

        $objOrder->setProperty("order_id", $order_id);        
        $objOrder->setProperty("paymentid", $order_id);        
        $objOrder->setProperty("customer_id", $customer_id);
        $objOrder->setProperty("product_id", $ci);

        $objOrder->setProperty("product_name", $CarList["product_name"]);
        $objOrder->setProperty("order_date", date('Y-m-d H:i:s'));
        $objOrder->setProperty("grand_total", $total_amount);
        $objOrder->setProperty("order_type", 1);
        $objOrder->setProperty("start_date", $pd .' ' . $pt);
        $objOrder->setProperty("end_date", $rd .' ' . $rt);
        $objOrder->setProperty("pickup_location_id", $pli);
        $objOrder->setProperty("drop_location_id", $rli);
        $objOrder->setProperty("product_price", $TotalAmount);
        $objOrder->setProperty("order_status", 1);
        $objOrder->actOrder1("I");

        $objOrderDetail = new Order;
        $objExtraFeature = new Product;
        for($i=0;$i<=count($chk);$i++){
        //	echo $chk[$i].'---<br>';
        if($chk[$i]!=''){
        $objExtraFeature->setProperty("extra_feature_id", $chk[$i]);
        $objExtraFeature->lstExtraFeature();
        $ExtraFeature = $objExtraFeature->dbFetchArray(1);
        //$extrafeature_amount += $ExtraFeature["feature_price"];
        $order_detail_id = $objAdminUser->genCode("rs_tbl_order_details", "order_detail_id");
        $objOrderDetail->setProperty("order_detail_id", $order_detail_id);
        $objOrderDetail->setProperty("order_id", $order_id);
        $objOrderDetail->setProperty("customer_id", $customer_id);

        $objOrderDetail->setProperty("extra_feature_id", $ExtraFeature["extra_feature_id"]);
        $objOrderDetail->setProperty("feature_name", $ExtraFeature["feature_name"]);
        $objOrderDetail->setProperty("quantity", 1);
        $objOrderDetail->setProperty("price", $ExtraFeature["feature_price"]);
        $objOrderDetail->actOrderDetail("I");

}
}

}
        
        
        
        
    }
//echo '<pre>';print_r($TransVal);exit;


}

?>

<div class="page-title-container">
  <div class="container">
    <div class="page-title pull-left">
      <h2 class="entry-title">Order Information</h2>
    </div>
  </div>
</div>
<section id="content" class="gray-area">
  <div class="container">
    <div class="row">
      <div style="display:none" class="col-xs-12">
        <div class=" message-bar bg-danger"> <i class="icon icon-normal-warning" ></i> </div>
      </div>
      <div class="sidebar col-sms-6 col-sm-4 col-md-3">
        <div class="booking-details travelo-box"  >
          <div class="panel style1 arrow-right">
            <h4 class="panel-title"> <a data-toggle="collapse" href="#modify-search-panel" class="">Modify search</a> </h4>
            <div id="modify-search-panel" class="panel-collapse collapse in">
              <div class="panel-content">
                <form method="post" action="<?php echo Route::_('show=booking');?>">
                  <div class="form-group">
                    <label>Pickup information</label>
                    <span id="pickup_location">
                    <div class="form-group">
                      <div class="selector">
                        <select name="pl_id" id="txt_pickup_location"  class="full-width">
                          <option value="0"  selected="selected">Pickup Location</option>
                        <?php
						$objLocationList = new Content;
						$objLocationList->setProperty("ORDERBY", 'location_title');
						$objLocationList->lstLocation();
						while($LocationList = $objLocationList->dbFetchArray(1)){
                        ?>
                          <option value="<?php echo $LocationList["location_id"];?>"><?php echo $LocationList["location_title"];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    </span> </div>
                  <div class="form-group">
                    <div class="datepicker-wrap">
                      <input type="text" name="pickupdate" placeholder="Pickup Date"  id="pickupdate" value="<?php echo $pickupdate;?>" class="input-text full-width"  />
                    </div>
                  </div>
                  <div class="form-group">
                    <div id="pickup_date_time">
                      <div class="selector">
                        <select class="full-width" name="pickuptime" id="pickuptime">
                          <option value="">Pickup Time</option>
                          <option value="00:30" >00:30</option>
                          <option value="01:00" >01:00</option>
                          <option value="01:30" >01:30</option>
                          <option value="02:00" >02:00</option>
                          <option value="02:30" >02:30</option>
                          <option value="03:00" >03:00</option>
                          <option value="03:30" >03:30</option>
                          <option value="04:00" >04:00</option>
                          <option value="04:30" >04:30</option>
                          <option value="05:00" >05:00</option>
                          <option value="05:30" >05:30</option>
                          <option value="06:00" >06:00</option>
                          <option value="06:30" >06:30</option>
                          <option value="07:00" >07:00</option>
                          <option value="07:30" >07:30</option>
                          <option value="08:00" >08:00</option>
                          <option value="08:30" >08:30</option>
                          <option value="09:00" >09:00</option>
                          <option value="09:30" >09:30</option>
                          <option value="10:00" selected>10:00</option>
                          <option value="10:30" >10:30</option>
                          <option value="11:00" >11:00</option>
                          <option value="11:30" >11:30</option>
                          <option value="12:00" >12:00</option>
                          <option value="12:30" >12:30</option>
                          <option value="13:00" >13:00</option>
                          <option value="13:30" >13:30</option>
                          <option value="14:00" >14:00</option>
                          <option value="14:30" >14:30</option>
                          <option value="15:00" >15:00</option>
                          <option value="15:30" >15:30</option>
                          <option value="16:00" >16:00</option>
                          <option value="16:30" >16:30</option>
                          <option value="17:00" >17:00</option>
                          <option value="17:30" >17:30</option>
                          <option value="18:00" >18:00</option>
                          <option value="18:30" >18:30</option>
                          <option value="19:00" >19:00</option>
                          <option value="19:30" >19:30</option>
                          <option value="20:00" >20:00</option>
                          <option value="20:30" >20:30</option>
                          <option value="21:00" >21:00</option>
                          <option value="21:30" >21:30</option>
                          <option value="22:00" >22:00</option>
                          <option value="22:30" >22:30</option>
                          <option value="23:00" >23:00</option>
                          <option value="23:30" >23:30</option>
                          <option value="00:00" >00:00</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Return information</label>
                    <div class="checkbox">
                      <input type="checkbox"  name="chk_return"   id="chk_return" value="1" >
                      Return car to a different location</div>
                  </div>
                  <span id="return_set" style="display:none">
                  <div class="form-group"> <span id="return_location">
                    <div class="form-group">
                      <div class="selector">
                        <select name="rl_id" id="txt_return_location"  class="full-width">
                          <option value="0"  selected="selected">Return Location</option>
                          <?php
						$objLocationList_2 = new Content;
						$objLocationList_2->setProperty("ORDERBY", 'location_title');
						$objLocationList_2->lstLocation();
						while($LocationList_2 = $objLocationList_2->dbFetchArray(1)){
                        ?>
                          <option value="<?php echo $LocationList_2["location_id"];?>"><?php echo $LocationList_2["location_title"];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    </span> </div>
                  </span>
                  <div class="form-group">
                    <div class="datepicker-wrap">
                      <input type="text" name="returndate" placeholder="Return Date"  id="returndate" value="<?php echo $returndate;?>" class="input-text full-width"  />
                    </div>
                  </div>
                  <div class="form-group">
                    <div id="return_date_time">
                      <div class="selector valreturn">
                        <select class="full-width" name="returntime" id="returntime">
                          <option value="">Return Time</option>
                          <option value="00:30" >00:30</option>
                          <option value="01:00" >01:00</option>
                          <option value="01:30" >01:30</option>
                          <option value="02:00" >02:00</option>
                          <option value="02:30" >02:30</option>
                          <option value="03:00" >03:00</option>
                          <option value="03:30" >03:30</option>
                          <option value="04:00" >04:00</option>
                          <option value="04:30" >04:30</option>
                          <option value="05:00" >05:00</option>
                          <option value="05:30" >05:30</option>
                          <option value="06:00" >06:00</option>
                          <option value="06:30" >06:30</option>
                          <option value="07:00" >07:00</option>
                          <option value="07:30" >07:30</option>
                          <option value="08:00" >08:00</option>
                          <option value="08:30" >08:30</option>
                          <option value="09:00" >09:00</option>
                          <option value="09:30" >09:30</option>
                          <option value="10:00" selected>10:00</option>
                          <option value="10:30" >10:30</option>
                          <option value="11:00" >11:00</option>
                          <option value="11:30" >11:30</option>
                          <option value="12:00" >12:00</option>
                          <option value="12:30" >12:30</option>
                          <option value="13:00" >13:00</option>
                          <option value="13:30" >13:30</option>
                          <option value="14:00" >14:00</option>
                          <option value="14:30" >14:30</option>
                          <option value="15:00" >15:00</option>
                          <option value="15:30" >15:30</option>
                          <option value="16:00" >16:00</option>
                          <option value="16:30" >16:30</option>
                          <option value="17:00" >17:00</option>
                          <option value="17:30" >17:30</option>
                          <option value="18:00" >18:00</option>
                          <option value="18:30" >18:30</option>
                          <option value="19:00" >19:00</option>
                          <option value="19:30" >19:30</option>
                          <option value="20:00" >20:00</option>
                          <option value="20:30" >20:30</option>
                          <option value="21:00" >21:00</option>
                          <option value="21:30" >21:30</option>
                          <option value="22:00" >22:00</option>
                          <option value="22:30" >22:30</option>
                          <option value="23:00" >23:00</option>
                          <option value="23:30" >23:30</option>
                          <option value="00:00" >00:00</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                            <div class="selector"> 
                            <select name="vch_category" id="vch_category">
                            <option value="">Select Category</option>
                            <?php
                            $objCarcategory = new Product;
                            $objCarcategory->setProperty("ORDERBY", 'category_name');
                            $objCarcategory->setProperty("category_status", 1);
                            $objCarcategory->lstCategory();
                            while($Carcategory = $objCarcategory->dbFetchArray(1)){
								if($_POST["vch_category"]==$Carcategory["category_id"]){
								$PasvalSel = ' selected="selected"';	
								} else {
									$PasvalSel = '';
								}
                            ?>
                          <option<?php echo $PasvalSel;?> value="<?php echo $Carcategory["category_id"];?>"><?php echo $Carcategory["category_name"];?></option>
                            <?php } ?>                                                                                                 
                          </select></div>
                        </div>
                  <br />
                  <div class="text-center">
                    <button name="btn_bookingstep1" value="search" id="btn_bookingstep1" class="btn btn-default btn-primary-color"> Modify search <i class="icon icon-normal-right-arrow-small"></i> </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <?php if($_POST["paytype"]=='debit'){ ?>
      <form method="get" name="frm_bookingstep3" id="" action="<?php echo $varPaymentPage;?>">
        <input id="PaymentID" name="PaymentID" type="hidden" value="<?php echo $varPaymentId; ?>" />
        <div id="main" class="col-sms-6 col-sm-8 col-md-9">
          <div class="booking-section travelo-box">
            <div class="person-information status_register" style=""  >
              <h2>Order Information</h2>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                    <label class="">First Name : <?php echo $fname?></label>
                  
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="">Last Name : <?php echo $lname?></label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="">Email Id : <?php echo $email?></label>
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="">Mobile Number : <?php echo $mobile?></label>
                </div>
                  
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="">Nationality : <?php echo $nationality?></label>
                </div>
                <div class="col-sm-6 col-md-6"> 
                    <label class=""><b>Total : <?php echo $total_amount?></b></label>
                </div>
              </div>
             <div class="form-group row">
                <div class="col-sm-3 col-md-3">
                  <label class="">Product Name : <?php echo $CarList["product_name"]?></label>                  
                </div>
                
              </div>
            </div>
           
            <div class="form-group row">
              <div class="col-sm-6 col-md-5">
                  <input type="submit" class="btn btn-primary btn-primary-color" id="btn_bookingstep4" name="submit" value="Confirm Booking">
              </div>
            </div>
          </div>
        </div>
      </form>
      <?php }else{ ?>
        <form method="post" name="frm_bookingstep3" id="" accept-charset="ISO-8859-1" action="<?php echo Route::_('show=crediorder');?>">
        <input type="hidden" name="Title" value = "express rent a car credit card transaction">
        <input type="hidden" name="virtualPaymentClientURL" value="<?php echo $virtualPaymentClientURL;?>">
        <input type="hidden" name="vpc_Version" value="<?php echo $vpc_Version;?>" >
        <input type="hidden" name="vpc_Command" value="<?php echo $vpc_Command;?>">
        <input type="hidden" name="vpc_AccessCode" value="<?php echo $vpc_AccessCode;?>" >
        <input type="hidden" name="vpc_Merchant" value="<?php echo $vpc_Merchant;?>" >
        <input type="hidden" name="vpc_ReturnURL" value="<?php echo $vpc_ReturnURL;?>">
        <input type="hidden" name="vpc_Locale" value="<?php echo $vpc_Locale;?>">
        <input type="hidden" name="vpc_Currency" value="<?php echo $vpc_Currency;?>">
        <input type="hidden" name="vpc_MerchTxnRef" value="<?php echo $order_id?>"/>                 
        <input type="hidden" name="vpc_OrderInfo" value="<?php echo $CarList["product_name"]?>" />              
        <input type="hidden" name="vpc_Amount" value="<?php echo $total_amount?>"/>
        <div id="main" class="col-sms-6 col-sm-8 col-md-9">
          <div class="booking-section travelo-box">
            <div class="person-information status_register" style=""  >
              <h2>Order Information</h2>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                    <label class="">First Name : <?php echo $fname?></label>
                  
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="">Last Name : <?php echo $lname?></label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="">Email Id : <?php echo $email?></label>
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="">Mobile Number : <?php echo $mobile?></label>
                </div>
                  
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="">Nationality : <?php echo $nationality?></label>
                </div>
                <div class="col-sm-6 col-md-6"> 
                    <label class=""><b>Total : <?php echo $total_amount?></b></label>
                </div>
              </div>
             <div class="form-group row">
                <div class="col-sm-3 col-md-3">
                  <label class="">Product Name : <?php echo $CarList["product_name"]?></label>                  
                </div>
                
              </div>
            </div>
           
            <div class="form-group row">
              <div class="col-sm-6 col-md-5">
                  <input type="submit" NAME="SubButL" class="btn btn-primary btn-primary-color" id="btn_bookingstep4"  value="Pay Now!">
              </div>
            </div>
          </div>
        </div>
            
      </form>
        
        
        <?php } ?>
    </div>
  </div>
</section>