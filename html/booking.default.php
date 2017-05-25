<?php 
//print_r($_POST);
//[] => 1 [] => 0 [] => 09/08/2016 [] => 10:00 [] => 09/11/2016 [] => 10:00 [btn_bookingstep1] => search ) 
$pickup_lication_id = $_POST["pl_id"];
$return_location_id = $_POST["rl_id"];
$pickupdate = $_POST["pickupdate"];
$pickuptime = $_POST["pickuptime"];
$returndate = $_POST["returndate"];
$returntime = $_POST["returntime"];
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
$startTimeStamp = strtotime($p_year.'/'.$p_month.'/'.$p_date);
$endTimeStamp = strtotime($r_year.'/'.$r_month.'/'.$r_date);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day
// and you might want to convert to integer
$numberDays = (intval($numberDays)+1);
?>
<!--<div id="preloader">
  <div id="status">&nbsp;</div>
</div>-->

<div class="page-title-container">
  <div class="container">
    <div class="page-title pull-left">
      <h2 class="entry-title"> Car Search Results </h2>
    </div>
  </div>
</div>
<section id="content" class="gray-area">
  <div class="container">
    <div id="main">
      <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-3">
          <div class="toggle-container filters-container">
            <div class="panel style1 arrow-right">
              <h4 class="panel-title"> <a data-toggle="collapse" href="#modify-search-panel" class="">Modify search</a> </h4>
              <div id="modify-search-panel" class="panel-collapse collapse in">
                <div class="panel-content">
                  <form method="post" action="">
                    <div class="form-group"> <span id="pickup_location">
                      <div class="form-group">
                        <div class="selector">
                          <select name="pl_id" id="txt_pickup_location"  class="full-width">
                            <option value="0">Pickup Location</option>
                            <?php
						$objLocationList = new Content;
						$objLocationList->setProperty("ORDERBY", 'location_title');
						$objLocationList->lstLocation();
						while($LocationList = $objLocationList->dbFetchArray(1)){
							if($pickup_lication_id == $LocationList["location_id"]){
								$selectp_location = ' selected="selected"';
							} else {
								$selectp_location = '';
							}
                        ?>
                            <option<?php echo $selectp_location;?> value="<?php echo $LocationList["location_id"];?>"><?php echo $LocationList["location_title"];?></option>
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
							if($return_location_id==$LocationList_2["location_id"]){
								$r_location_select = ' selected="selected"';
							} else {
								$r_location_select = '';
							}
                        ?>
                            <option<?php echo $r_location_select;?> value="<?php echo $LocationList_2["location_id"];?>"><?php echo $LocationList_2["location_title"];?></option>
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
                      <button name="btn_bookingstep1" value="search" id="btn_bookingstep1"  class="btn btn-default btn-primary-color"> Modify search <i class="icon icon-normal-right-arrow-small"></i> </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-9">
          <div class="booking-item-deails-date-location">
            <h4> Your summary </h4>
            <ul>
              <li class="col-md-6">
                <h5> Pickup                  :</h5>
                <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i><?php echo $PickupLocation["location_title"];?></p>
                <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i> <?php echo dateFormate_10($p_month);?> <?php echo $p_date;?>, <?php echo $p_year;?> </p>
                <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i> <?php echo $pickuptime;?> </p>
              </li>
              <li class="col-md-6">
                <h5> Return                  :</h5>
                <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i><?php echo $ReturnLocationName;?></p>
                <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i> <?php echo dateFormate_10($r_month);?> <?php echo $r_date;?>, <?php echo $r_year;?> </p>
                <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i> <?php echo $returntime;?> </p>
              </li>
              <span class="info text-primary"> &nbsp;</span>
            </ul>
          </div>
          <div class="car-list listing-style3 car">
            <form method="post" name="frm_bookingstep2" id="frm_bookingstep2" action="#">
              <?php
            $objListofCar = new Product;
			if($_POST["vch_category"]!=''){
			$objListofCar->setProperty("category_id", $_POST["vch_category"]);
			}
            $objListofCar->setProperty("product_type", 1);
            $objListofCar->lstProducts();
			if($objListofCar->totalRecords() >= 1){
            while($CarList = $objListofCar->dbFetchArray(1)){
            ?>
              <article class="box seller-badged"> 
                <!-- best seller badge -->
                
                <div class="col-md-4 left-wrapper">
                  <div class="clearfix">
                    <h4 class="box-title"> <?php echo $CarList["product_name"];?></h4>
                  </div>
                  <div class="row">
                    <figure class="col-xs-12 no-padding"> <span> <a href="#" class="slide"> <img src="<?php echo SITE_URL;?>timthumb.php?src=<?php echo SITE_URL.'product_image/orig/' . $CarList['product_image'];?>&w=267&h=169&s=0&q=100&a=t&zc=2&ct=1" alt="#"> </a> </span> </figure>
                  </div>
                </div>
                <div class="details col-xs-6 col-md-5 border-before border-after">
                  <div class="amenities">
                    <ul>
                      <li>
                        <div> <i class="soap-icon-user"></i> <span class="amenities-detail"> <?php echo $CarList["number_of_seats"];?> Seats </span></div>
                      </li>
                      <li>
                        <div style="width:100%; "> <i class="soap-icon-suitcase "></i> <span class="amenities-detail"><?php echo $CarList["number_of_luggage"];?> Luggage(s) </span></div>
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
                <div class="col-md-3">
                  <div class="action">
                    </h4>
                    <span style="margin-top:15px;"> 
                    <?php if($numberDays <=6){?>
                    <small> Price for <?php echo $numberDays;?> day(s) <span class="price"> BD 
					
					<?php $CPD = $CarList["product_price"] * $numberDays; echo $CPD + $PickupLocation["location_price"];?> </span></small>
                    <?php } elseif($numberDays > 6 && $numberDays < 30 ){ ?>
					<small> Price for <?php echo $numberDays;?> day(s) <span class="price" style="text-decoration:line-through"> BD 
					
					<?php $CPW = $CarList["product_price"] * $numberDays; echo $CPW + $PickupLocation["location_price"];?> </span><br />
                    
                    <?php
						$CountPerDayPrice = $CarList["price_weekly"] / 7;
						//$FinalCarPrice = round($CountPerDayPrice,3);
						$FinalCarPrice = round($CountPerDayPrice);
					?>
                    
                    <span class="price"> BD <?php echo $FinalCarPrice * $numberDays + $PickupLocation["location_price"];?> </span>
                    </small>
                    <?php } elseif($numberDays >= 30 ){ ?>
                    <small> Price for <?php echo $numberDays;?> day(s) <span class="price" style="text-decoration:line-through"> BD 
					<?php 
					$CPM = $CarList["product_price"] * $numberDays; 
					echo $CPM + $PickupLocation["location_price"];
					
					?> </span><br />
                    
                    
                    <?php
					$CountPerDayPrice = $CarList["price_monthly"] / 30;
					//$MFinalCarPrice = round($CountPerDayPrice,3);
					$MFinalCarPrice = round($CountPerDayPrice);
					?>
                    
                    <span class="price"> BD <?php echo $MFinalCarPrice * $numberDays + $PickupLocation["location_price"];?> </span>
                    </small>
					<?php } ?>
                    
   
                    <!--<small> Price for <?php echo $numberDays;?> day(s) <span class="price"> BD <?php echo $CarList["product_price"] + $PickupLocation["location_price"];?> </span></small>
                    
                    <small> Price Per Weelk(s) <span class="price"> BD <?php echo $CarList["price_weekly"] + $PickupLocation["location_price"];?> </span></small>
                    
                    <small> Price Per Month(s) <span class="price"> BD <?php echo $CarList["price_monthly"] + $PickupLocation["location_price"];?> </span></small>-->                 
                      </span>
                    
                    
                    <a href="<?php echo Route::_('show=book&ci='.EncData($CarList["product_id"]).'&pli='.EncData($pickup_lication_id).'&rli='.EncData($return_location_id).'&pd='.EncData($pickupdate).'&rd='.EncData($returndate).'&pt='.EncData($pickuptime).'&rt='.EncData($returntime).'&dc='.EncData($numberDays));?>" class="btn btn-lg btn-primary book_button">Book</a> </div>
                </div>
              </article>
              <?php } 
			} else {
			echo 'No Results Found.';
			}
			?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
