<?php
if($_POST["save_val"]!=''){
    
    
$link = Route::_('show=thank');
unset($_POST);
redirect($link);
}

$chk = $_POST["chk"];
$Car_id = DecData($_POST["ci"]);
$pickup_lication_id = DecData($_POST["pli"]);
$return_location_id = DecData($_GET["rli"]);
$pickupdate = DecData($_POST["pd"]);
$pickuptime = DecData($_POST["pt"]);
$returndate = DecData($_POST["rd"]);
$returntime = DecData($_POST["rt"]);
list($p_month,$p_date,$p_year)= explode('/', $pickupdate);
list($r_month,$r_date,$r_year)= explode('/', $returndate);
//

$objPl_id = new Content;
$objPl_id->setProperty("location_id", $pickup_lication_id);
$objPl_id->lstLocation();
$PickupLocation = $objPl_id->dbFetchArray(1);

if($return_location_id!=0){
$objRl_id = new Content;
$objRl_id->setProperty("location_id", $return_location_id);
$objRl_id->lstLocation();
$ReturnLocation = $objRl_id->dbFetchArray(1);
$ReturnLocationName = $ReturnLocation["location_title"];
} else {
	$ReturnLocationName = $PickupLocation["location_title"];
}

$objListofCar = new Product;
$objListofCar->setProperty("product_id", $Car_id);
$objListofCar->lstProducts();
$CarList = $objListofCar->dbFetchArray(1);

$startTimeStamp = strtotime($p_year.'/'.$p_month.'/'.$p_date);
$endTimeStamp = strtotime($r_year.'/'.$r_month.'/'.$r_date);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day
// and you might want to convert to integer
$numberDays = intval($numberDays);
$extrafeature_amount = 0;
$objExtraFeature = new Product;
for($i=0;$i<=count($chk);$i++){
//	echo $chk[$i].'---<br>';
if($chk[$i]!=''){
$objExtraFeature->setProperty("extra_feature_id", $chk[$i]);
$objExtraFeature->lstExtraFeature();
$ExtraFeature = $objExtraFeature->dbFetchArray(1);
$extrafeature_amount += $ExtraFeature["feature_price"];
}
}
?>
<?php 
$totalAmount = $CarList["product_price"] + $PickupLocation["location_price"] + $extrafeature_amount;
$finalamount = $totalAmount * $numberDays;
$accATM = new e24PaymentPipe;
$accATM->resourcePath = 'resource/';
$accATM->alias = 'test_EXPRESS_RENT';
$accATM->action = '1';
$accATM->currency = '048';
$accATM->language = 'USA';
$accATM->amt = '0.010';
$accATM->responseURL = 'http://www.benefitco.com/benefit_testing/response.php';
$accATM->errorURL = 'http://www.benefitco.com/benefit_testing/error.php';
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
echo '<pre>';print_r($varPaymentPage);exit;
?>

<div class="page-title-container">
  <div class="container">
    <div class="page-title pull-left">
      <h2 class="entry-title">Personal Information</h2>
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
        <div class="booking-details travelo-box">
          <h4>Booking Details</h4>
          <article class="car-detail">
            <figure class="clearfix"> <img src="<?php echo SITE_URL;?>timthumb.php?src=<?php echo SITE_URL.'product_image/orig/' . $CarList['product_image'];?>&w=200&h=150&s=0&q=100&a=t&zc=2&ct=1" alt="#"> </figure>
            <br />
            <div class="travel-title">
              <h5 class="box-title"> <?php echo $CarList["product_name"];?> </h5>
            </div>
            <div class="details">
              <div class="icon-box style11 full-width">
                <div class="icon-wrapper"> <i class="soap-icon-calendar"></i> </div>
                <dl class="details">
                  <dt class="skin-color">Pickup </dt>
                  <dd><?php echo $PickupLocation["location_title"];?><br />
                    <?php echo dateFormate_10($p_month);?> <?php echo $p_date;?>, <?php echo $p_year;?> <?php echo $pickuptime;?></dd>
                </dl>
              </div>
              <div class="icon-box style11 full-width">
                <div class="icon-wrapper"> <i class="soap-icon-calendar"></i> </div>
                <dl class="details">
                  <dt class="skin-color">Return</dt>
                  <dd><?php echo $ReturnLocationName;?><br />
                     <?php echo dateFormate_10($r_month);?> <?php echo $r_date;?>, <?php echo $r_year;?> <?php echo $returntime;?></dd>
                </dl>
              </div>
              <div class="icon-box style11 full-width">
                <div class="icon-wrapper"> <i class="soap-icon-longarrow-right"></i> </div>
                <dl class="details">
                  <dt class="skin-color">Rental length</dt>
                  <dd><?php echo $numberDays;?> day(s)</dd>
                </dl>
              </div>
            </div>
          </article>
        </div>
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
      <?php 
	  /*echo '<pre>';
	  print_r($_POST);
	  echo '</pre>';*/
	  ?>
      <form method="post" name="frm_bookingstep3" id="frm_bookingstep3" action="<?php echo Route::_('show=proceed');?>" enctype="multipart/form-data">
      <?php $TotalAmountPass = $_POST["tba"];?>
      <input type="hidden" name="save_val" value="y" />
      <input type="hidden" id="PaymentID" name="PaymentID" value="<?php echo $varPaymentId;?>" />
      
      <input type="hidden" name="ci" value="<?php echo DecData($_POST["ci"]);?>" />      
      <input type="hidden" name="pli" value="<?php echo $_POST["pli"];?>" />
      <input type="hidden" name="rli" value="<?php echo $_POST["rli"];?>" />
      <input type="hidden" name="pd" value="<?php echo $_POST["pd"];?>" />
      <input type="hidden" name="pt" value="<?php echo $_POST["pt"];?>" />
      <input type="hidden" name="rd" value="<?php echo $_POST["rd"];?>" />
      <input type="hidden" name="rt" value="<?php echo $_POST["rt"];?>" />
      <input type="hidden" name="number_of_days" value="<?php echo $numberDays;?>" />
      <input type="hidden" name="pd_price" value="<?php echo $_POST["ext"];?>" />
      <input type="hidden" name="tpic" value="<?php echo $TotalAmountPass;?>" />
        <div id="main" class="col-sms-6 col-sm-8 col-md-9">
          <div class="booking-section travelo-box">
            <div class="person-information status_register" style=""  >
              <h2>Personal Information</h2>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="required">First Name</label>
                  <input type="text" class="input-text full-width" name="fname" id="txt_booking_fname" value=""  />
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="required">Last Name</label>
                  <input type="text" class="input-text full-width" name="lname" id="txt_booking_lname"  value="" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="required">Email Id</label>
                  <input type="text" class="input-text full-width" name="email"  id="txt_booking_email" value="" />
                </div>
                <div class="col-sm-6 col-md-6">
                  <label class="required">Mobile Number</label>
                  <input type="text" class="input-text full-width" name="mobile" id="txt_booking_mobile" value=""  />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 col-md-6">
                  <label class="required">Nationality</label>
                  <select class="full-width" name="nationality" id="txt_booking_nationality" >
                    <option value="">SELECT</option>
                    <option value="AF"  >AFGHANISTAN</option>
                    <option value="AX"  >ÅLAND</option>
                    <option value="AL"  >ALBANIA</option>
                    <option value="DZ"  >ALGERIA</option>
                    <option value="AS"  >AMERICAN SAMOA</option>
                    <option value="AD"  >ANDORRA</option>
                    <option value="AO"  >ANGOLA</option>
                    <option value="AI"  >ANGUILLA</option>
                    <option value="AQ"  >ANTARCTICA</option>
                    <option value="AG"  >ANTIGUA AND BARBUDA</option>
                    <option value="AR"  >ARGENTINA</option>
                    <option value="AM"  >ARMENIA</option>
                    <option value="AW"  >ARUBA</option>
                    <option value="AU"  >AUSTRALIA</option>
                    <option value="AT"  >AUSTRIA</option>
                    <option value="AZ"  >AZERBAIJAN</option>
                    <option value="BS"  >BAHAMAS</option>
                    <option value="BH"  selected="selected"  >BAHRAIN</option>
                    <option value="BD"  >BANGLADESH</option>
                    <option value="BB"  >BARBADOS</option>
                    <option value="BY"  >BELARUS</option>
                    <option value="BE"  >BELGIUM</option>
                    <option value="BZ"  >BELIZE</option>
                    <option value="BJ"  >BENIN</option>
                    <option value="BM"  >BERMUDA</option>
                    <option value="BT"  >BHUTAN</option>
                    <option value="BO"  >BOLIVIA</option>
                    <option value="BQ"  >BONAIRE</option>
                    <option value="BA"  >BOSNIA AND HERZEGOVINA</option>
                    <option value="BW"  >BOTSWANA</option>
                    <option value="BV"  >BOUVET ISLAND</option>
                    <option value="BR"  >BRAZIL</option>
                    <option value="IO"  >BRITISH INDIAN OCEAN TERRITORY</option>
                    <option value="VG"  >BRITISH VIRGIN ISLANDS</option>
                    <option value="BN"  >BRUNEI</option>
                    <option value="BG"  >BULGARIA</option>
                    <option value="BF"  >BURKINA FASO</option>
                    <option value="BI"  >BURUNDI</option>
                    <option value="KH"  >CAMBODIA</option>
                    <option value="CM"  >CAMEROON</option>
                    <option value="CA"  >CANADA</option>
                    <option value="CV"  >CAPE VERDE</option>
                    <option value="KY"  >CAYMAN ISLANDS</option>
                    <option value="CF"  >CENTRAL AFRICAN REPUBLIC</option>
                    <option value="TD"  >CHAD</option>
                    <option value="CL"  >CHILE</option>
                    <option value="CN"  >CHINA</option>
                    <option value="CX"  >CHRISTMAS ISLAND</option>
                    <option value="CC"  >COCOS [KEELING] ISLANDS</option>
                    <option value="CO"  >COLOMBIA</option>
                    <option value="KM"  >COMOROS</option>
                    <option value="CK"  >COOK ISLANDS</option>
                    <option value="CR"  >COSTA RICA</option>
                    <option value="HR"  >CROATIA</option>
                    <option value="CU"  >CUBA</option>
                    <option value="CW"  >CURACAO</option>
                    <option value="CY"  >CYPRUS</option>
                    <option value="CZ"  >CZECH REPUBLIC</option>
                    <option value="CD"  >DEMOCRATIC REPUBLIC OF THE CONGO</option>
                    <option value="DK"  >DENMARK</option>
                    <option value="DJ"  >DJIBOUTI</option>
                    <option value="DM"  >DOMINICA</option>
                    <option value="DO"  >DOMINICAN REPUBLIC</option>
                    <option value="TL"  >EAST TIMOR</option>
                    <option value="EC"  >ECUADOR</option>
                    <option value="EG"  >EGYPT</option>
                    <option value="SV"  >EL SALVADOR</option>
                    <option value="GQ"  >EQUATORIAL GUINEA</option>
                    <option value="ER"  >ERITREA</option>
                    <option value="EE"  >ESTONIA</option>
                    <option value="ET"  >ETHIOPIA</option>
                    <option value="FK"  >FALKLAND ISLANDS</option>
                    <option value="FO"  >FAROE ISLANDS</option>
                    <option value="FJ"  >FIJI</option>
                    <option value="FI"  >FINLAND</option>
                    <option value="FR"  >FRANCE</option>
                    <option value="GF"  >FRENCH GUIANA</option>
                    <option value="PF"  >FRENCH POLYNESIA</option>
                    <option value="TF"  >FRENCH SOUTHERN TERRITORIES</option>
                    <option value="GA"  >GABON</option>
                    <option value="GM"  >GAMBIA</option>
                    <option value="GE"  >GEORGIA</option>
                    <option value="DE"  >GERMANY</option>
                    <option value="GH"  >GHANA</option>
                    <option value="GI"  >GIBRALTAR</option>
                    <option value="GR"  >GREECE</option>
                    <option value="GL"  >GREENLAND</option>
                    <option value="GD"  >GRENADA</option>
                    <option value="GP"  >GUADELOUPE</option>
                    <option value="GU"  >GUAM</option>
                    <option value="GT"  >GUATEMALA</option>
                    <option value="GG"  >GUERNSEY</option>
                    <option value="GN"  >GUINEA</option>
                    <option value="GW"  >GUINEA-BISSAU</option>
                    <option value="GY"  >GUYANA</option>
                    <option value="HT"  >HAITI</option>
                    <option value="HM"  >HEARD ISLAND AND MCDONALD ISLANDS</option>
                    <option value="HN"  >HONDURAS</option>
                    <option value="HK"  >HONG KONG</option>
                    <option value="HU"  >HUNGARY</option>
                    <option value="IS"  >ICELAND</option>
                    <option value="IN"  >INDIA</option>
                    <option value="ID"  >INDONESIA</option>
                    <option value="IR"  >IRAN</option>
                    <option value="IQ"  >IRAQ</option>
                    <option value="IE"  >IRELAND</option>
                    <option value="IM"  >ISLE OF MAN</option>
                    <option value="IL"  >ISRAEL</option>
                    <option value="IT"  >ITALY</option>
                    <option value="CI"  >IVORY COAST</option>
                    <option value="JM"  >JAMAICA</option>
                    <option value="JP"  >JAPAN</option>
                    <option value="JE"  >JERSEY</option>
                    <option value="JO"  >JORDAN</option>
                    <option value="KZ"  >KAZAKHSTAN</option>
                    <option value="KE"  >KENYA</option>
                    <option value="KI"  >KIRIBATI</option>
                    <option value="XK"  >KOSOVO</option>
                    <option value="KW"  >KUWAIT</option>
                    <option value="KG"  >KYRGYZSTAN</option>
                    <option value="LA"  >LAOS</option>
                    <option value="LV"  >LATVIA</option>
                    <option value="LB"  >LEBANON</option>
                    <option value="LS"  >LESOTHO</option>
                    <option value="LR"  >LIBERIA</option>
                    <option value="LY"  >LIBYA</option>
                    <option value="LI"  >LIECHTENSTEIN</option>
                    <option value="LT"  >LITHUANIA</option>
                    <option value="LU"  >LUXEMBOURG</option>
                    <option value="MO"  >MACAO</option>
                    <option value="MK"  >MACEDONIA</option>
                    <option value="MG"  >MADAGASCAR</option>
                    <option value="MW"  >MALAWI</option>
                    <option value="MY"  >MALAYSIA</option>
                    <option value="MV"  >MALDIVES</option>
                    <option value="ML"  >MALI</option>
                    <option value="MT"  >MALTA</option>
                    <option value="MH"  >MARSHALL ISLANDS</option>
                    <option value="MQ"  >MARTINIQUE</option>
                    <option value="MR"  >MAURITANIA</option>
                    <option value="MU"  >MAURITIUS</option>
                    <option value="YT"  >MAYOTTE</option>
                    <option value="MX"  >MEXICO</option>
                    <option value="FM"  >MICRONESIA</option>
                    <option value="MD"  >MOLDOVA</option>
                    <option value="MC"  >MONACO</option>
                    <option value="MN"  >MONGOLIA</option>
                    <option value="ME"  >MONTENEGRO</option>
                    <option value="MS"  >MONTSERRAT</option>
                    <option value="MA"  >MOROCCO</option>
                    <option value="MZ"  >MOZAMBIQUE</option>
                    <option value="MM"  >MYANMAR [BURMA]</option>
                    <option value="NA"  >NAMIBIA</option>
                    <option value="NR"  >NAURU</option>
                    <option value="NP"  >NEPAL</option>
                    <option value="NL"  >NETHERLANDS</option>
                    <option value="NC"  >NEW CALEDONIA</option>
                    <option value="NZ"  >NEW ZEALAND</option>
                    <option value="NI"  >NICARAGUA</option>
                    <option value="NE"  >NIGER</option>
                    <option value="NG"  >NIGERIA</option>
                    <option value="NU"  >NIUE</option>
                    <option value="NF"  >NORFOLK ISLAND</option>
                    <option value="KP"  >NORTH KOREA</option>
                    <option value="MP"  >NORTHERN MARIANA ISLANDS</option>
                    <option value="NO"  >NORWAY</option>
                    <option value="OM"  >OMAN</option>
                    <option value="PK"  >PAKISTAN</option>
                    <option value="PW"  >PALAU</option>
                    <option value="PS"  >PALESTINE</option>
                    <option value="PA"  >PANAMA</option>
                    <option value="PG"  >PAPUA NEW GUINEA</option>
                    <option value="PY"  >PARAGUAY</option>
                    <option value="PE"  >PERU</option>
                    <option value="PH"  >PHILIPPINES</option>
                    <option value="PN"  >PITCAIRN ISLANDS</option>
                    <option value="PL"  >POLAND</option>
                    <option value="PT"  >PORTUGAL</option>
                    <option value="PR"  >PUERTO RICO</option>
                    <option value="QA"  >QATAR</option>
                    <option value="CG"  >REPUBLIC OF THE CONGO</option>
                    <option value="RE"  >RéUNION</option>
                    <option value="RO"  >ROMANIA</option>
                    <option value="RU"  >RUSSIA</option>
                    <option value="RW"  >RWANDA</option>
                    <option value="BL"  >SAINT BARTHéLEMY</option>
                    <option value="SH"  >SAINT HELENA</option>
                    <option value="KN"  >SAINT KITTS AND NEVIS</option>
                    <option value="LC"  >SAINT LUCIA</option>
                    <option value="MF"  >SAINT MARTIN</option>
                    <option value="PM"  >SAINT PIERRE AND MIQUELON</option>
                    <option value="VC"  >SAINT VINCENT AND THE GRENADINES</option>
                    <option value="WS"  >SAMOA</option>
                    <option value="SM"  >SAN MARINO</option>
                    <option value="ST"  >SãO TOMé AND PRíNCIPE</option>
                    <option value="SA"  >SAUDI ARABIA</option>
                    <option value="SN"  >SENEGAL</option>
                    <option value="RS"  >SERBIA</option>
                    <option value="SC"  >SEYCHELLES</option>
                    <option value="SL"  >SIERRA LEONE</option>
                    <option value="SG"  >SINGAPORE</option>
                    <option value="SX"  >SINT MAARTEN</option>
                    <option value="SK"  >SLOVAKIA</option>
                    <option value="SI"  >SLOVENIA</option>
                    <option value="SB"  >SOLOMON ISLANDS</option>
                    <option value="SO"  >SOMALIA</option>
                    <option value="ZA"  >SOUTH AFRICA</option>
                    <option value="GS"  >SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                    <option value="KR"  >SOUTH KOREA</option>
                    <option value="SS"  >SOUTH SUDAN</option>
                    <option value="ES"  >SPAIN</option>
                    <option value="LK"  >SRI LANKA</option>
                    <option value="SD"  >SUDAN</option>
                    <option value="SR"  >SURINAME</option>
                    <option value="SJ"  >SVALBARD AND JAN MAYEN</option>
                    <option value="SZ"  >SWAZILAND</option>
                    <option value="SE"  >SWEDEN</option>
                    <option value="CH"  >SWITZERLAND</option>
                    <option value="SY"  >SYRIA</option>
                    <option value="TW"  >TAIWAN</option>
                    <option value="TJ"  >TAJIKISTAN</option>
                    <option value="TZ"  >TANZANIA</option>
                    <option value="TH"  >THAILAND</option>
                    <option value="TG"  >TOGO</option>
                    <option value="TK"  >TOKELAU</option>
                    <option value="TO"  >TONGA</option>
                    <option value="TT"  >TRINIDAD AND TOBAGO</option>
                    <option value="TN"  >TUNISIA</option>
                    <option value="TR"  >TURKEY</option>
                    <option value="TM"  >TURKMENISTAN</option>
                    <option value="TC"  >TURKS AND CAICOS ISLANDS</option>
                    <option value="TV"  >TUVALU</option>
                    <option value="UM"  >U.S. MINOR OUTLYING ISLANDS</option>
                    <option value="VI"  >U.S. VIRGIN ISLANDS</option>
                    <option value="UG"  >UGANDA</option>
                    <option value="UA"  >UKRAINE</option>
                    <option value="AE" >UNITED ARAB EMIRATES</option>
                    <option value="GB"  >UNITED KINGDOM</option>
                    <option value="US"  >UNITED STATES</option>
                    <option value="UY"  >URUGUAY</option>
                    <option value="UZ"  >UZBEKISTAN</option>
                    <option value="VU"  >VANUATU</option>
                    <option value="VA"  >VATICAN CITY</option>
                    <option value="VE"  >VENEZUELA</option>
                    <option value="VN"  >VIETNAM</option>
                    <option value="WF"  >WALLIS AND FUTUNA</option>
                    <option value="EH"  >WESTERN SAHARA</option>
                    <option value="YE"  >YEMEN</option>
                    <option value="ZM"  >ZAMBIA</option>
                    <option value="ZW"  >ZIMBABWE</option>
                  </select>
                </div>
                <div class="col-sm-6 col-md-6"> </div>
              </div>
              <hr />
              
              
            </div>
            
            <div class="form-group accept-checkbox">
              <div class="checkbox">
                <label class="required">
                  <input type="checkbox" value="1" checked="checked"  id="chk_terms_agree" name="chk_terms_agree" >
                  <a href="<?php echo Route::_('show=cms&cms_id=terms-of-use');?>" target="_blank" style="color:#FF0000;">I accept the terms & conditions. </a> </label>
              </div>
            </div>
            <div class="form-group col-xs-12 paynow" >
              <div class=" row  inner" > <span style="">
                
                <div class="col-xs-12 col-sm-6">
                  <div class="row">
                    <div class="col-xs-12 col-sm-8">
                      <div class="radio">
                        <label>
                          <input  type="radio" id="txt_booking_payment_method"  checked="checked"  onclick="discount_change('1')"  name="txt_booking_payment_method" value="1" >
                          <i class="soap-icon-hotel-3 "></i>Pay at location </label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                      <h4 class="text-right">BD <?php echo $TotalAmountPass;?></h4>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <hr />
                </span>
                <dl class="other-details">
                  <table width="100%">
                    <thead>
                    <th class="info-primary">ITEM</th>
                      <th class="info-primary" style="text-align:left;"> </th>
                      <th style="text-align:right;" class="info-primary"> AMOUNT</th>
                      </thead>
                    <tbody style="text-transform:capitalize;">
                      <tr>
                        <td class="feature" align="left">Rental charge </td>
                        <td class="value"></td>
                        <?php $totalAmount = $CarList["product_price"] + $PickupLocation["location_price"]; $finalamount = $totalAmount * $numberDays; ?>
                        <td class="" align="right"> BD <span id="rental_charge_online"> <?php echo  $TotalAmountPass;?> </span></td>
                      </tr>
                     <?php
					 $TotalFinalAmount = 0;
					 $objExtraFeatureList = new Product;
					for($j=0;$j<=count($chk);$j++){
					if($chk[$j]!=''){
					$objExtraFeatureList->setProperty("extra_feature_id", $chk[$j]);
					$objExtraFeatureList->lstExtraFeature();
					$ExtraFeatureList = $objExtraFeatureList->dbFetchArray(1);
					//$extrafeature_amount += $ExtraFeature["feature_price"];
					$TotalFinalAmount += $ExtraFeature["feature_price"] * $numberDays;
					?>
                    <input type="hidden" name="chk[]" value="<?php echo $ExtraFeature["extra_feature_id"];?>" />
                    <tr >
                        <td class="feature" align="left"><strong><?php echo $ExtraFeature["feature_name"];?></strong></td>
                        <td class=""></td>
                        <td class="" align="right">BD <?php echo $ExtraFeature["feature_price"] * $numberDays;?> </td>
                      </tr>
                    <?php } } ?>
                      
                    </tbody>
                  </table>
                  <dt class="total-price-value"><strong>Grand total</strong></dt>
                  <dd class="total-price-value"><strong>BD <span id="rental_charge_online_total"><?php echo $TotalAmountPass;?> </span> </strong></dd>
                </dl>
              </div>
            </div>

            <input type="hidden" name="total_amount" value="<?php echo $finalamount + $TotalFinalAmount;?>" />
            <div class="form-group row">
              <div class="col-sm-6 col-md-5">
                <input type="button" class="btn btn-primary btn-primary-color" id="btn_bookingstep4" name="btn_bookingstep4" value="Confirm Booking">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
/*****************************************/
	/**********     Validating form   ********/
	/*****************************************/
$('#btn_bookingstep4').on("click", function(e){
	//
	var error = false;
     var pattern =  /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	////// Validate First Name
    if($("#txt_booking_fname").val() == ''){
		alert('First Name is required field.');
	//	$("#txt_booking_fname").closest(".form-group").addClass( "has-error" );
	 	return false;
	}
	////// Validate Last Name
	if($("#txt_booking_lname").val() == ''){
		alert('Last Name is required field.');
		$("#txt_booking_lname").closest(".form-group").addClass( "has-error" );
		return false;
	}
	else
		{
		$("#txt_booking_lname").closest(".form-group").removeClass( "has-error" );
		}
	////// Validate Email Id	
	var email = $("#txt_booking_email").val();
	if($("#txt_booking_email").val() == ''){
		alert('Email is required field.');
		$("#txt_booking_email").closest(".form-group").addClass( "has-error" );
		return false;
	}
	else if(!pattern.test(email))
		{
		$("#txt_booking_email").closest(".form-group").addClass( "has-error" );
		}
	else  
		{
		$("#txt_booking_email").closest(".form-group").removeClass( "has-error" );
		}	
	////// Validate Mobile	
    if($("#txt_booking_mobile").val() == ''){
		alert('Mobile Number is required field.');
		$("#txt_booking_mobile").closest(".form-group").addClass( "has-error" );
		return false;
	}
	else
		{
		$("#txt_booking_mobile").closest(".form-group").removeClass( "has-error" );
		}
	if($('#chk_terms_agree').prop('checked')==false){
		alert('Please accept the terms & conditions.');
		$("#chk_terms_agree").closest(".form-group").addClass( "has-error" );
		$(".form-group .accept").css({"border":"1px solid #a94442","color":"#a94442"});
		return false;
	}
	else
		{
		$("#txt_booking_fname").closest(".form-group").addClass( "has-success" );
		$(".form-group .accept").css({"border":"1px solid #FFF"});
		}
	 
	
	$( "#frm_bookingstep3" ).submit();
	if(error == true){
		e.preventDefault();
		}
})	
function discount_change(id)
	{
	 var online_pay = $("#booking_online_discount_amt").val();	
	 var normal_pay = $("#booking_online_amt").val();
	 var online_pay_total = $("#booking_online_discount_amt_total").val();	
	 var normal_pay_total = $("#booking_online_amt_total").val();	 
	 if(id == 1)
		   	{
			$("#rental_charge_online").text(normal_pay);
			$("#rental_charge_online_total").text(normal_pay_total);			
			}
	 else
	 		{
			$("#rental_charge_online").text(online_pay);
			$("#rental_charge_online_total").text(online_pay_total);		
			}		
			
	}
function upload_docs()
	{ 
	if($("#chk_upload_docs").is(":checked"))
		{
		$("#upload_docs").show();	
		}
	else
		{
		$("#upload_docs").hide();		
		}	
	}
function check_info(id)
	{ 
	 if(id == 1)
	 	{
		$(".status_login").show();
		$(".status_register").hide()	
		}
	else
		{
		$(".status_login").hide();	
		$(".status_register").show();		
		} 
	}	
</script> 
