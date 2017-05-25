<?php 
//ci=&pli=&rli=&pd=&rd=&pt=&rt=
//print_r($_POST);
$Car_id = DecData($_GET["ci"]);
$pickup_lication_id = DecData($_GET["pli"]);
$return_location_id = DecData($_GET["rli"]);
$pickupdate = DecData($_GET["pd"]);
$pickuptime = DecData($_GET["pt"]);
$returndate = DecData($_GET["rd"]);
$returntime = DecData($_GET["rt"]);
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
?>

<div class="loading"></div>
<div class="page-title-container">
  <div class="container">
    <div class="page-title pull-left">
      <h2 class="entry-title"> Extras </h2>
    </div>
    <ul class="breadcrumbs pull-right">
    </ul>
  </div>
</div>
<section id="content" class="gray-area">
  <div class="container">
    <div class="row">
      <div class="sidebar col-sms-6 col-sm-4 col-md-3">
        <div class="toggle-container filters-container">
          <div class="booking-details travelo-box" >
            <h4>Booking Details</h4>
            <article class="car-detail">
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
                    <dd><?php echo DecData($_GET["dc"]);?> day(s)</dd>
                  </dl>
                </div>
              </div>
            </article>
          </div>
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
                      </select>
                    </div>
                  </div>
                  <br />
                  <div class="text-center">
                    <button name="btn_bookingstep1" value="search" id="btn_bookingstep1" class="btn btn-default btn-primary-color"> Modify search<i class="icon icon-normal-right-arrow-small"></i> </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script> 
	function Seeach_cars(){
		$("#frm_bookingstep3").attr('action', "<?php echo Route::_('show=booking');?>");
		$("#frm_bookingstep3").submit();	
	}
</script>
      <?php
$objListofCar = new Product;
$objListofCar->setProperty("product_id", $Car_id);
$objListofCar->lstProducts();
$CarList = $objListofCar->dbFetchArray(1);
?>
      <form method="post" name="frm_bookingstep3" id="frm_bookingstep3"  action="<?php echo Route::_('show=proceed');?>">
        <input type="hidden" name="ci" value="<?php echo $_GET["ci"];?>" />
        <input type="hidden" name="pli" value="<?php echo $_GET["pli"];?>" />
        <input type="hidden" name="rli" value="<?php echo $_GET["rli"];?>" />
        <input type="hidden" name="pd" value="<?php echo $_GET["pd"];?>" />
        <input type="hidden" name="rd" value="<?php echo $_GET["rd"];?>" />
        <input type="hidden" name="pt" value="<?php echo $_GET["pt"];?>" />
        <input type="hidden" name="rt" value="<?php echo $_GET["rt"];?>" />
        <div id="main" class="col-sms-6 col-sm-8 col-md-9">
          <div class="row" >
            <div class="col-xs-12" style="display:none">
              <div class=" message-bar bg-danger text-danger"> <i class="fa fa-warning"></i> </div>
            </div>
            <div class="col-md-12">
              <div class="listing-style3 car">
                <article class="box seller-badged"> 
                  <!-- best seller badge --> 
                  <!-- left wrapper -->
                  <div class="col-md-4 left-wrapper">
                    <div class="clearfix">
                      <h4 class="box-title"> <?php echo $CarList["product_name"];?> </h4>
                    </div>
                    <div class="row">
                      <figure class="col-xs-12 no-padding"> <span> <a href="#" class="slide"> <img src="<?php echo SITE_URL;?>timthumb.php?src=<?php echo SITE_URL.'product_image/orig/' . $CarList['product_image'];?>&w=267&h=169&s=0&q=100&a=t&zc=2&ct=1" alt="#"> </a> </span> </figure>
                    </div>
                  </div>
                  <div class="details col-xs-12 col-md-5 border-before border-after">
                    <div class="amenities">
                      <ul>
                        <li>
                          <div> <i class="soap-icon-user"></i> <span class="amenities-detail"> <?php echo $CarList["number_of_seats"];?> Seats </span></div>
                          </ </li>
                        <li>
                          <div style="width:100%; "> <i class="soap-icon-suitcase "></i> <span class="amenities-detail"> <?php echo $CarList["number_of_luggage"];?> Luggage(s) </span></div>
                        </li>
                        <li>
                          <div style="width:100%; "> <i class="soap-icon-fueltank "></i> <span class="amenities-detail"> <?php echo $CarList["number_of_doors"];?> Doors </span></div>
                        </li>
                        <li>
                          <div style="width:100%; "><i class="myicon-engine-gear "></i> <span class="amenities-detail"> <?php echo $CarList["l_engine"];?> Engine </span></div>
                        </li>
                        <li>
                          <div style="width:100%; "><i class="soap-icon-aircon "></i> <span class="amenities-detail"> AC </span> </div>
                        </li>
                        <li>
                          <div style="width:100%;"><i class="soap-icon-fmstereo "></i> <span class="amenities-detail"> Auto </span></div>
                        </li>
                      </ul>
                    </div>
                    <div ><a href="<?php echo Route::_('show=cms&cms_id=terms-of-use');?>" target="_blank" style="text-decoration:underline;">Terms & conditions</a></div>
                    <hr style="margin-top:5px; margin-bottom:5px;" />
                    <div class="free-features"> <strong>Included for free</strong>
                      <ul class="">
                        <?php if($CarList["other_f_1"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_1"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_2"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_2"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_3"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_3"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_4"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_4"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_5"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_5"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_6"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_6"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_7"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_7"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_8"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_8"].' </li>'; } else { echo ''; }?>
                        <?php if($CarList["other_f_9"]!=''){ echo '<li><i class="soap-icon-check"></i>'.$CarList["other_f_9"].' </li>'; } else { echo ''; }?>
                      </ul>
                    </div>
                  </div>
                  <div class="details col-md-3">
                    <div class="action"> <!--<small> Price for 1 day(s) </small> <span class="price"> BD <?php echo $CarList["product_price"] + $PickupLocation["location_price"];?> </span>-->
                    
                    
                    <?php if(DecData($_GET["dc"]) <=6){?>
                    <small> Price for <?php echo DecData($_GET["dc"]);?> day(s) <span class="price"> BD 
					
					<?php $CPD = $CarList["product_price"] * DecData($_GET["dc"]); echo $CPD + $PickupLocation["location_price"];?> </span></small>
                    <?php } elseif(DecData($_GET["dc"]) > 6 && DecData($_GET["dc"]) < 30 ){ ?>
					<small> Price for <?php echo DecData($_GET["dc"]);?> day(s) <span class="price" style="text-decoration:line-through"> BD 
					
					<?php $CPW = $CarList["product_price"] * DecData($_GET["dc"]); echo $CPW + $PickupLocation["location_price"];?> </span><br />
                    
                    <?php
						$CountPerDayPrice = $CarList["price_weekly"] / 7;
						//$FinalCarPrice = round($CountPerDayPrice,3);
						$FinalCarPrice = round($CountPerDayPrice);
					?>
                    
                    <span class="price"> BD <?php echo $FinalCarPrice * DecData($_GET["dc"]) + $PickupLocation["location_price"];?> </span>
                    </small>
                    <?php } elseif(DecData($_GET["dc"]) >= 30 ){ ?>
                    <small> Price for <?php echo DecData($_GET["dc"]);?> day(s) <span class="price" style="text-decoration:line-through"> BD 
					<?php $CPM = $CarList["product_price"] * DecData($_GET["dc"]); echo $CPM + $PickupLocation["location_price"];?> </span><br />
                    
                    
                    <?php
					$CountPerDayPrice = $CarList["price_monthly"] / 30;
					//$MFinalCarPrice = round($CountPerDayPrice,3);
					$MFinalCarPrice = round($CountPerDayPrice);
					?>
                    
                    <span class="price"> BD <?php echo $MFinalCarPrice * DecData($_GET["dc"]) + $PickupLocation["location_price"];?> </span>
                    </small>
					<?php } ?>
                    
                    
                     <!--<small> Price Per day(s) <span class="price"> BD <?php echo $CarList["product_price"] + $PickupLocation["location_price"];?> </span></small>
                    
                    <small> Price Per Weelk(s) <span class="price"> BD <?php echo $CarList["price_weekly"] + $PickupLocation["location_price"];?> </span></small>
                    
                    <small> Price Per Month(s) <span class="price"> BD <?php echo $CarList["price_monthly"] + $PickupLocation["location_price"];?> </span></small>-->
                    
                    </div>
                    <div class="good-choice"> <i class="fa fa-check"></i> <span class="text">Good choice</span> </div>
                  </div>
                </article>
              </div>
              <br />
              <?php 
			  
			  if(DecData($_GET["dc"]) <= 6){
				  $FinalCarPrice = $CarList["product_price"];
				 $casearea = 1; 
			  } elseif(DecData($_GET["dc"]) > 6 && DecData($_GET["dc"]) < 30 ){
				 //echo(round(4.96754,2)
				 $casearea = 2;
				 $CountPerDayPrice = $CarList["price_weekly"] / 7;
				 //$FinalCarPrice = round($CountPerDayPrice,3);
				 $FinalCarPrice = round($CountPerDayPrice);
			  } elseif(DecData($_GET["dc"]) >= 30){
				  $casearea = 3;
				  $CountPerDayPrice = $CarList["price_monthly"] / 30;
				 //$FinalCarPrice = round($CountPerDayPrice,3);
				 $FinalCarPrice = round($CountPerDayPrice);
			  } 
			  
			  $totalAmount = $FinalCarPrice; $finalamount = $totalAmount * DecData($_GET["dc"]) + $PickupLocation["location_price"]; ?>
              <input type="hidden" name="cas" value="<?php echo $casearea;?>" />
              <input type="hidden" name="wrond" value="<?php echo $CountPerDayPrice;?>" />
              <input type="hidden" name="ext" value="<?php echo $FinalCarPrice;?>" />
              <input type="hidden" id="insurnace_excess" value="0"  />
              <input type="hidden" id="total_days" value="<?php echo DecData($_GET["dc"]);?>"  />
              <input type="hidden" id="total_bok_amount" name="tba" value="<?php echo $finalamount; ?>"  />
              <div class="row">
                <div class=" col-md-12">
                  <div class="col-md-6 pull-left">
                    <div class="form-group manage-booking-btn"> </div>
                  </div>
                  <div class="col-md-6 text-right " style="display:none;">
                    <div class="form-group">
                      <p class="btn bg-primary disabled" style="opacity: 1"> Total Amount: BD <span class="total_booking_total"> <?php echo $finalamount; ?></span> </span></p>
                      &nbsp;&nbsp;
                      <button type="submit" class="btn btn-primary" name="btn_bookingstep3"  value="1"  > Proceed <i class="icon icon-normal-right-arrow-small"></i> </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="block" style="display:block;">
                <div class="block-inner block-shadow white">
                  <div class="extras"></div>
                  <div class="extras-item block-header" >
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="title"> Choose extra feature </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                $objExtraFeatur = new Product;
                $objExtraFeatur->setProperty("ORDERBY", 'extra_feature_id');
                $objExtraFeatur->lstExtraFeature();
				$counter_id = 0;
                while($ExtraFeatur = $objExtraFeatur->dbFetchArray(1)){
					$counter_id++;
                ?>
                  <input type="hidden" name="trf_ext<?php echo $counter_id;?>" id="trf_ext<?php echo $counter_id;?>" value="<?php echo $ExtraFeatur["feature_price"];?>"    />
                  <input type="hidden" name="trf_ext<?php echo $counter_id;?>_status" id="trf_ext<?php echo $counter_id;?>_status" value="1"  />
                  <input type="hidden" name="trf_ext<?php echo $counter_id;?>_type" id="trf_ext<?php echo $counter_id;?>_type" value="1"  />
                  <input type="hidden" name="trf_<?php echo $counter_id;?>_type" id="trf_<?php echo $counter_id;?>_type" value="0"  />
                  <div class="extras-item" style="" >
                    <div class="row">
                      <div class="col-xs-12 col-sm-1 col-md-1">
                        <!--<div class="extra-icon"> <img src="<?php echo SITE_URL;?>timthumb.php?src=<?php echo SITE_URL.'product_image/orig/' . $ExtraFeatur['feature_icon'];?>&w=57&h=80&s=0&q=100&a=t&zc=2&ct=1" alt="#"> </div>-->
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9">
                        <div class="price"> BD <?php echo $ExtraFeatur["feature_price"];?> /Per Day </div>
                        <div class="title"> <?php echo $ExtraFeatur["feature_name"];?> </div>
                        <div class="description"> <?php echo $ExtraFeatur["feature_detail"];?> </div>
                        
                      </div>
                      <div class="col-xs-push-4 col-sm-push-0 col-xs-4 col-sm-3 col-md-2">
                        <div class="form-group">
                          <div class="form-group">
                            <div class="checkbox">
                              <input type="checkbox" name="chk[]" id="chk_<?php echo $counter_id;?>" value="<?php echo $ExtraFeatur['extra_feature_id'];?>"  onclick="calculate('<?php echo $counter_id;?>')">
<!--                             <?php if($ExtraFeatur["feature_name"]=="Child Booster Seat"){ ?>
                              <select name="childseat" class="childseat" id="childseat">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                             </select>
                             <?php } ?> -->
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="row">
                <div class=" col-md-12">
                  <div class="col-md-6 pull-left">
                    <div class="form-group manage-booking-btn"> </div>
                  </div>
                  <div class="col-md-6 text-right ">
                    <div class="form-group">
                      <p class="btn bg-primary disabled" style="opacity: 1"> Total Amount: BD <span class="total_booking_total"> <?php echo $finalamount; ?> </span> </span> </p>
                      &nbsp;&nbsp;
                      <button type="submit" class="btn btn-primary" name="btn_bookingstep3"  value="1"> Proceed <i class="icon icon-normal-right-arrow-small"></i> </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script> 
<script >
 
function insurance_exc(id)
	{ 
	 var insurance = $("#insurnace_excess").val();	
	 if(id == '9')	
	 	{ 
		if($("#chk_9").is(":checked"))
		   	{
			$("#insurnace_excess_msg").hide();	 
			$("#chk_6").prop('checked', false);	
			$('#chk_6').parent().removeClass('checked');
			}
	 else
	 		{
			$("#insurnace_excess_msg").show();	
			$("#insurance_discount").text(parseFloat(insurance).toFixed(2));	 	
			}	
		}
		
	else if(id == '7')	
		{	
	 if($("#chk_7").is(":checked"))
		   	{ 
			$("#insurance_discount").text(parseFloat(0).toFixed(2));	
			$("#chk_9").prop('checked', false);	
            $("#chk_8").prop('checked', false);	 
			$("#chk_2").prop('checked', false);	
			$("#chk_9").prop('disabled', true);	
			$("#chk_8").prop('disabled', true);				
			$("#chk_2").prop('disabled', true);	
			$("#insurnace_excess_msg").show();	
			$("#trf_9_included").show();
			$("#trf_8_included").show();
			$("#trf_2_included").show();	
			$('#chk_9').parent().removeClass('checked'); 
			$('#chk_8').parent().removeClass('checked');
			$('#chk_2').parent().removeClass('checked');
			}
	 else
	 		{ 
			$("#chk_9").prop('checked', false);	
            $("#chk_8").prop('checked', false);	 
			$("#chk_2").prop('checked', false);	
			$("#chk_9").prop('disabled', false);	
			$("#chk_8").prop('disabled', false);				
			$("#chk_2").prop('disabled', false);	
			$("#trf_9_included").hide();
			$("#trf_8_included").hide();
			$("#trf_2_included").hide(); 
			$('#chk_9').parent().removeClass('checked'); 
			$('#chk_8').parent().removeClass('checked');
			$('#chk_2').parent().removeClass('checked');	
			$("#insurance_discount").text(parseFloat(insurance).toFixed(2));	
			}	
		}
	}
 
function calculate(id)
	{ 
	insurance_exc(id); 	
	var total=0;

	var sub_total=0;

	var grand_total=0;

	var total_bok_amount = $("#total_bok_amount").val(); 

 	//alert(total+":total");

	for(i=1;i<=10;i++) {

		 //  alert(total); 
	   var type = $("#trf_ext"+i+"_type").val();

	   var status = $("#trf_ext"+i+"_status").val();

	   var type_charge = $("#trf_"+i+"_type").val();

	   var amount = $("#trf_ext"+i).val();

	   var total_days = $("#total_days").val();

	   if(type == 1 && status ==1) {

	       if($("#chk_"+i).is(":checked"))

		   	{

			if(type_charge == 1)

				{	

				var total = parseFloat(total) + parseFloat(amount);
 

				var sub_total =  total;

				}

			else

				{

				var total = parseFloat(total) + (parseFloat(amount) * parseFloat(total_days)); 

				var sub_total =  total;

				}	

		

			}
 
	   }

	  else if(type == 2 && status ==1) 

	  		{

		    var count = $("#chk_"+i).val();

			if(count != 0) 

				{

				var sel_amount  = parseFloat(amount) * parseFloat(count);

				if(type_charge == 1)

					{

					var total = parseFloat(total) + parseFloat(sel_amount);	 

					var sub_total =  total;

					}

				else

					{

					var total = parseFloat(total) + (parseFloat(sel_amount) * parseFloat(total_days));	 

					var sub_total =  total;
                     
					}	

				}

			 

	  		}

    
 

	}

	var grand_total = parseFloat(sub_total)+parseFloat(total_bok_amount);
 
	$(".total_booking_total").html((parseFloat(grand_total).toFixed(2)));

	}

 	

</script> 
<script type="text/javascript">
jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
		calculate();
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
		calculate();
    });
});
</script> 