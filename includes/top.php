<header id="header" class="navbar-static-top">
  <div class="main-header"> <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle"> Mobile Menu Toggle </a>
    <div class="container">
      <h1 class="logo navbar-brand"> <a href="<?php echo SITE_URL;?>" title="Dollar - home"> <img src="<?php echo SITE_URL;?>images/logo_admin.png" alt="" /> </a> </h1>
      <nav id="main-menu" role="navigation">
        <ul class="menu">
          <li> <a href="<?php echo SITE_URL;?>"> Home </a> </li>
          <li class=""><a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> About </a></li>
          <!--<li class=""><a href="<?php echo Route::_('show=cms&cms_id=who-we-are');?>"> Who we are </a></li>-->
          <li class=""><a href="<?php echo Route::_('show=cms&cms_id=special-offer');?>"> Special Offer </a></li>
          <li class=""> <a href="<?php echo Route::_('show=fleet');?>"> Our Fleet </a> </li>
          <li class=""><a href="<?php echo Route::_('show=cms&cms_id=contact-us');?>"> Contact Us </a></li>
        </ul>
      </nav>
    </div>
    <nav id="mobile-menu-01" class="mobile-menu collapse">
      <ul id="mobile-primary-menu" class="menu">
        <li class="menu-item-has-children"> <a href="<?php echo SITE_URL;?>"> Home </a> </li>
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> About </a> </li>
        <!--<li class="menu-item-has-children"> <a href="<?php echo Route::_('show=cms&cms_id=who-we-are');?>"> Who we are </a> </li>-->
        <li class="menu-item-has-children"><a href="<?php echo Route::_('show=cms&cms_id=special-offer');?>"> Special Offer </a></li>
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=fleet');?>"> Our Fleet </a> </li>
        <!--<li class="menu-item-has-children"> <a href="<?php echo Route::_('show=leasing');?>"> Leasing </a> </li>
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=limousine');?>"> Limousine </a> </li>-->
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=cms&cms_id=contact-us');?>"> Contact Us </a> </li>
      </ul>
    </nav>
  </div>
</header>
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
<script>
function changeImage()
{
    var img = document.getElementById("homepageslider");
    img.src = images[x];
    x++;

    if(x >= images.length){
        x = 0;
    } 
    //fadeImg(img, 5, true);
    setTimeout("changeImage()", 7000);
}

function fadeImg(el, val, fade){
    if(fade === true){
        val--;
    }else{
        val ++;
    }

    if(val > 0 && val < 100){
        el.style.opacity = val / 100;
        setTimeout(function(){fadeImg(el, val, fade);}, 10);
    }
}

var images = [],
x = 0;

images[0] = "<?php echo SITE_URL;?>images/carbg.jpg";
images[1] = "<?php echo SITE_URL;?>images/carbg.jpg";
images[2] = "<?php echo SITE_URL;?>images/carbg.jpg";
setTimeout("changeImage()", 7000);
</script>
<div class="loading_circle"></div>
<section id="content" class="slideshow-bg">
  <div id="slideshow">
    <div id="home-slider" class="flexslider hidden-xs"> <img id="homepageslider" src="<?php echo SITE_URL;?>images/carbg.jpg" style="width:100%">  </div>
  </div>
    <div class="container" >
        <div class="col-md-7">
        <div id="main"><br />

     <!-- <h1 class="page-title">Welcome to Trans Auto Rental</h1>-->
      <!--<h1 class="page-title"></h1>
                    <h2 class="page-description col-md-12 no-float no-padding"><i class="fa fa-chevron-circle-right "></i> Largest fleet in excess of 17,000 vehicles in the UAE<br />
                    <i class="fa fa-chevron-circle-right "></i> Over 50 locations in the UAE<br />
<i class="fa fa-chevron-circle-right "></i> Wherever you will go will find us</h2>-->
      <div class="search-box-wrapper style2 " style="width:100%;" >
        <div class="search-box">
          <ul class="search-tabs clearfix">
            <li  style="border-right: 1px solid #E7F8FE; padding:0px;" class="active"><a href="#cars-tab" data-toggle="tab"><i class="myicon-luxury-car"></i><span> Rent a Car </span></a></li>
<li style="border-right: 1px solid #E7F8FE;"><a href="https://expressrcar.com/cms/usedcar"><i class="myicon-luxury-car"></i><span>Used Car</span></a></li>
            <li style="border-right: 1px solid #E7F8FE;"><a href="<?php echo Route::_('show=limousine');?>"><i class="myicon-luxury-car"></i><span>Limousine</span></a></li>
            <li><a href="<?php echo Route::_('show=leasing');?>"><i class="myicon-luxury-car"></i><span>Lease Enquiry</span></a></li>
          </ul>
          <div class="search-tab-content">
            <div class="tab-pane fade active in" id="cars-tab">
              <form method="post" name="frm_bookingstep1" action="<?php echo Route::_('show=booking');?>">
                <div class="row">
                  <div class="col-md-2">
                    <label class="required">Location</label>
                  </div>
                  <div class="col-md-10"> <span id="pickup_location">
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
                  <div class="col-md-2">
                    <label class="required">Return</label>
                  </div>
                  <div class="col-md-10"> <span id="return_location">
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
                  <div class="more-search-form" style="display:none">
                    <div class="checkbox">
                      <input type="checkbox"  name="chk_return" id="chk_return" value="1" >
                      Return car to a different location</div>
                    <hr style="margin-top:0; margin-bottom:15px;" />
                    <div class="row">
                      <div class="col-md-2">
                        <label class="required">Date & Time</label>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-6 col-md-4">
                              <label>Pickup Date</label>
                              <div class="form-group">
                                <div class="datepicker-wrap">
                                  <input type="text" name="pickupdate" id="pickupdate" class="input-text full-width" placeholder="Pickup Date" value="<?php echo date("m/d/Y");?>" />
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-md-2">
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
                            <div class="col-xs-6 col-md-4">
                              <label>Return Date</label>
                              <div class="datepicker-wrap">
                                <input type="text" name="returndate" id="returndate" class="input-text full-width" placeholder="Return Date"  value=""/>
                              </div>
                            </div>
                            <div class="col-xs-6 col-md-2">
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
                      <button name="btn_bookingstep1" value="search" id="btn_bookingstep1" class="send btn btn-primary btn-primary-color"> Search Cars <i class="icon icon-normal-right-arrow-small"></i> </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class=""><a href="#" class="btn-show-form chev-down"><em>Open</em> <span></span> </a></div>
          </div>
        </div>
      </div>
    </div>
      </div>
      
      
      
      
      
      
      
        <div class="col-md-5">
       <div class="columns1_3">
                                    		<div class="w3-content w3-section">
											  <img class="mySlides w3-animate-top" src="<?php echo SITE_URL;?>images/Under-construction.png" style="width:60%;" >
											  <img class="mySlides w3-animate-bottom" src="<?php echo SITE_URL;?>images/Under-construction.png" style="width:60%;" >
											  <img class="mySlides w3-animate-top" src="<?php echo SITE_URL;?>images/Under-construction.png" style="width:60%;">

											</div>
									</div>
								
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 2500);
}
</script>
  </div>
    </div>
    
    
                                               

    
    
    
    
    
</section>

