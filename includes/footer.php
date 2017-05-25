
<footer id="footer">
  <div class="footer-wrapper thrifty-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 one"> 
            <h3> Site Map </h3>
            <ul>
                <li><a href="<?php echo SITE_URL;?>"> Home </a> </li>
                <li><a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> About </a></li>
                <li><a href="<?php echo Route::_('show=leasing');?>"> Leasing </a></li>
                <li><a href="<?php echo Route::_('show=cms&cms_id=terms-of-use');?>"> Terms & conditions </a></li>
                <li><a href="<?php echo Route::_('show=cms&cms_id=contact-us');?>"> Contact Us </a></li>
            </ul>
        </div>
          <div class="col-md-4 two" >
            <h3> We are Social! </h3>
            <ul>
                <li><a href="<?php echo SITE_URL;?>"><i class="fa fa-facebook"></i></a> </li>
                <li><a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> <i class="fa fa-instagram"></i> </a></li>
                <li><a href="<?php echo Route::_('show=leasing');?>"> <i class="fa fa-twitter"></i> </a></li>
                
            </ul>
        </div>
          <div class="col-md-4 three">
            <h3> Reach us at </h3>
            <ul>
                <li><i class="fa fa-phone"></i><a href="<?php echo SITE_URL;?>"> +973 17 532 525 </a> </li>
                <li><i class="fa fa-mobile-phone"></i><a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> +973 39 696 326 </a></li>
                <li><i class="fa fa-fax"></i><a href="<?php echo Route::_('show=leasing');?>"> +973 17 532 526 </a></li>
                <li><i class="fa fa-envelope"></i><a href="<?php echo Route::_('show=cms&cms_id=terms-of-use');?>"> info@expressrcar.com</a></li>
            </ul>
        </div>
      </div>
      
    </div>
      <div class="copyright">
          <p> Copyright © <?php echo date("Y");?> Express Rent-a-car. Designed & Developed By <a href="www.bwadco.com"> Bells & Whistles.</a> All Rights Reserved</p>
      </div>
  </div>
</footer>
</div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery-1.11.1.min.js"></script> 
<script>tjq = jQuery.noConflict();</script> 
<script src="<?php echo SITE_URL; ?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/modernizr.2.7.1.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery-migrate-1.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.placeholder.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery-ui.1.10.4.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.flexslider-min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/theme-scripts.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.scc.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/select2.full.min.js"></script>
</body><script>
$(document).ready(function(){
$('#btn_subscribe').click(function(event){  
	 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	$('#home_footer_sub_status').hide();
	$('#home_footer_sub_success_status').hide();
	var subscribe_email = $('#subscribe_email').val(); 
	//alert(login_password);
	if(subscribe_email=='')
	{
		 $('#home_footer_sub_status').show();
		 $('#home_footer_sub_msg').html('Please enter email id'); 
	}
	else if(reg.test(subscribe_email) == false)
	{
		 $('#home_footer_sub_status').show();
		 $('#home_footer_sub_msg').html('Invalid email id'); 
	}
	 else {
			 
		 //confirm popup
		 tjq('#myModal').modal({
			keyboard: true
		  })
	$('#btn_email_confirm').click(function(){
		//alert(subscribe_email);
		var subscribe_email_confirm = $('#subscribe_email_confirm').val(); 
		if(subscribe_email_confirm=='' || reg.test(subscribe_email_confirm) == false || subscribe_email!=subscribe_email_confirm){
			$('#subscribe_email_confirm').css('border','1px solid red');
			$('#email_error').show();
			}
		else{
			
		 // get the form data
		// using jQuery (you can use the class or id also)
		var formData = {
			'email'             : $('input[name=subscribe_email]').val(),
		};
		//var $btn = $('#btn_subscribe').button('loading');
		var msg = '';
		// process the form
		$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url         : 'https://www.dollaruae.com/index.php/home/ajax_subscribe', // the url where we want to POST
			data        : formData, // our data object
		   //dataType    : 'json', // what type of data do we expect back from the server
			encode      : true
		})
			// using the done promise callback
			.done(function(data) {
				// log data to the console so we can see
				//console.log(data); 
			//$btn.button('reset') // reset button to start state
				// here we will handle errors and validation messages
				$('#home_footer_sub_success_status').show();
				$('#home_footer_sub_success_msg').html(data);
				tjq('#myModal').modal('hide');
			});
	
			 
			}	
		})	
  
	}
	// stop the form from submitting the normal way and refreshing the page
	event.preventDefault(); 
	});
});
$('#chk_return').click(function(){  
	if($("#chk_return").is(":checked"))
	 { $("#return_set").show(); }
	else
	  { $("#return_set").hide(); }
});

$(document).ready(function(){
    tjq("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false});
  });

jQuery(document).ready(function() {
  jQuery("#txt_pickup_location12").select2();
});

jQuery(document).ready(function() {

      jQuery(".niche-cars").owlCarousel({
        items : 4,
        lazyLoad : true,
        navigation : true,
		dots: false,
		pagination: false,
		navigationText: [
      "<i class='soap-icon-left icon-white'></i>",
      "<i class='soap-icon-right icon-white'></i>"]
      });

    });
	
	$(document).ready(function(e) {
		//change arrow icon on load 
		var tmpid = $('.premium-btn').data('premium-id');
		if(tmpid == 1){
			//alert('tmpid');
			$('[data-premium-id="1"]').children('i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
			}
		// end of change first arrow icon	
		
    jQuery('.premium-btn').live('click',function(){
		var premiumid, newid;
		premiumid = $(this).data('premium-id');
		$('.premium-btn').children('i').removeClass('fa-angle-double-up').addClass('fa-angle-double-down'); 
		$(this).children('i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up'); // change the icon
		
		newid = '#nich-block-'+premiumid;
		//alert(newid);
		//alert($(newid).css('display'));
		if($(newid).css('display') == 'none'){
			$('[id^="nich-block-"]').hide();
			$(newid).slideDown( "slow" );
		}else{
			$('[id^="nich-block-"]').hide();
			$('.premium-btn').children('i').removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
			}
		var owl = jQuery(newid+" .niche-cars")			   
			owl.owlCarousel();
			owl.data('owlCarousel').reinit({
				items : 4,
				navigation : true,
					dots: false,
					pagination: false,
					navigationText: [
				  "<i class='soap-icon-left icon-white'></i>",
				  "<i class='soap-icon-right icon-white'></i>"]
			  });
		
		});
});
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<script type="text/javascript">
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})
</script>
</html>