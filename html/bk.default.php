<?php
if($_POST["pas"]=='v'){
$pli = $_POST["pl_id"];
$rli = $_POST["rl_id"];
$pd = $_POST["pickupdate"];
$pt = $_POST["pickuptime"];
$rd = $_POST["returndate"];
$rt = $_POST["returntime"];
$ci = $_POST["ci"];

list($p_month,$p_date,$p_year)= explode('/', $pd);
list($r_month,$r_date,$r_year)= explode('/', $rd);
$startTimeStamp = strtotime($p_year.'/'.$p_month.'/'.$p_date);
$endTimeStamp = strtotime($r_year.'/'.$r_month.'/'.$r_date);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day
// and you might want to convert to integer
$numberDays = intval($numberDays);

$link = Route::_('show=book&ci='.EncData($ci).'&pli='.EncData($pli).'&rli='.EncData($rli).'&pd='.EncData($pd).'&rd='.EncData($rd).'&pt='.EncData($pt).'&rt='.EncData($rt).'&dc='.EncData($numberDays));
unset($_POST);
redirect($link);

}
?>
<div class="page-title-container">
  <div class="container">
    <div class="page-title pull-left">
      <h2 class="entry-title"> Book a car </h2>
    </div>
  </div>
</div>
<section id="content" class="gray-area">
  <div class="container">
    <div id="main">
      <div class="row">
        <div class="col-sm-10 col-md-10" style="margin-left:9%">
          
<h2 class="entry-title"> Book a car </h2>
          
          
          <div class="car-list listing-style3 car">
            <form method="post" name="frm_bookingstep2" id="frm_bookingstep2" action="#">
              <?php
            $objListofCar = new Product;
			$objListofCar->setProperty("product_id", DecData($_GET["ci"]));
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
                <div class="details col-xs-6 col-md-8 border-before border-after">
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
                  <div ><a href="<?php echo Route::_('show=cms&');?>" target="_blank" style="text-decoration:underline;">Terms & conditions</a></div>
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
              </article>
              <?php } 
			} else {
			echo 'No Results Found.';
			}
			?>
            
            
            </form>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="col-sm-10 col-md-10" style="margin-left:8%; margin-top:20px;">
            <form method="post" name="frm_bookingstep1" action="<?php echo Route::_('show=bk');?>">
            <input type="hidden" name="ci" value="<?php echo $_GET["ci"];?>" />
            <input type="hidden" name="pas" value="v" />
                <div class="row">
                  <div class="col-xs-12 col-md-12">
                    <label class="required">Location</label>
                  </div>
                  <div class="col-xs-12 col-md-12"> <span id="pickup_location">
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
                </div>
                <div class="row" style="display:none;" id="return_set">
                  <div class="col-md-12">
                    <label class="required">Return</label>
                  </div>
                  <div class="col-md-12"> <span id="return_location">
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
                </div>
                <div class="row">
                  <div class="more-search-form">
                    <div class="checkbox">
                      <input type="checkbox"  name="chk_return" id="chk_return" value="1" >
                      Return car to a different location</div>
                    <hr style="margin-top:0; margin-bottom:15px;" />
                    <div class="row">
                      <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-6 col-md-6">
                              <label>Pickup Date</label>
                              <div class="form-group">
                                <div class="datepicker-wrap">
                                  <input type="text" name="pickupdate" id="pickupdate" class="input-text full-width" placeholder="Pickup Date" value="<?php echo date("m/d/Y");?>" />
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                              <label>Time</label>
                              <div class="form-group"> <span id="pickup_date_time">
                                <div class="selector">
                                  <select class="full-width" name="pickuptime" id="pickuptime">
                                    <option value="0"  selected="selected">Pickup Time</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option selected="selected" value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                    <option value="00:00">00:00</option>
                                  </select>
                                </div>
                                </span></div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                              <label>Return Date</label>
                              <div class="datepicker-wrap">
                                <input type="text" name="returndate" id="returndate" class="input-text full-width" placeholder="Return Date"  value=""/>
                              </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                              <label>Time</label>
                              <div id="return_date_time">
                                <div class="selector valreturn">
                                  <select class="full-width" name="returntime" id="returntime">
                                    <option value="0"  selected="selected">Return Time</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option selected="selected" value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                    <option value="00:00">00:00</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12 pull-right text-right" style="padding:0px;">
                      <button name="btn_bookingstep1" value="search" id="btn_bookingstep1" class="send btn btn-primary btn-primary-color"> Book <i class="icon icon-normal-right-arrow-small"></i> </button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
        section#content {  min-height: 800px; margin:0 auto; padding: 0; position: relative; overflow: hidden; background: #fff; }
		
        #main { padding-top: 25px; }
        .page-title, .page-description { color: #fff; text-shadow:1px 2px 2px #000000; }
        .page-title { font-size: 2.8rem; font-weight: bold; }
        .page-description { font-size: 2em; margin-bottom: 50px; }
		
		.video-js {
			margin: 0 auto;
			width: 100%;
		}
		
	@media 	(max-width: 991px) {
		  section#content {   min-height: 50px;}
		}
	@media 	(max-width: 760px) {
		.page-title { font-size: 1rem; }
		}	
       
</style>