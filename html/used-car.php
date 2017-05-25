<?php 
if($_POST["saveinfo"]!=''){
$leas_type = $_POST["leas_type"];
$fullname = trim($_POST["fullname"]);
$email = trim($_POST["email"]);
$mobile = trim($_POST["mobile"]);
$phone = trim($_POST["phone"]);
$address = trim($_POST["address"]);
$lease_detail = trim($_POST["lease_detail"]);

$lease_id = $objAdminUser->genCode("rs_tbl_car_lease", "lease_id");
$objProduct->setProperty("lease_id", $lease_id);
$objProduct->setProperty("lease_type", $lease_type);
$objProduct->setProperty("full_name", $fullname);
$objProduct->setProperty("email_address", $email);
$objProduct->setProperty("phone_number",  $phone);
$objProduct->setProperty("mobile_number",  $mobile);
$objProduct->setProperty("address", $address);
$objProduct->setProperty("lease_detail", $lease_detail);
$objProduct->setProperty("lease_ststus", 1);
$objProduct->setProperty("lease_date", date('Y-m-d H:i:s'));
$objProduct->actCarLease("I");
$link = Route::_('show=thank');
unset($_POST);
redirect($link);
}
$GetContentRecord = $objContent->getContent('usedcar');?>
<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?php echo $GetContentRecord["cms_title"];?></h2>
                </div>
                
            </div>
        </div>
        <section class="gray-area" id="content">
            <div class="container">
     <div id="main">
     <div style="display:none" class="alert alert-error">
                                       <span class="close"></span>
        </div>
         <div style="display:none" class="alert alert-success">
                                         <span class="close"></span>
        </div>
                
    <div class="row">
<div class="col-md-6">
    <h2><?php echo $GetContentRecord["cms_title"];?></h2></h2>
<?php echo $GetContentRecord["cms_detail"];?>  
   </div>
   <div class="col-md-6">
   
   
   
   <form method="post" name="frm_bookingstep3" action="<?php echo Route::_('show=leasing');?>" enctype="multipart/form-data">
        <div id="main" class="col-sms-12 col-sm-12">
          <div class="booking-section travelo-box">
            <div class="person-information status_register" style="display:;"  >
              <h2>Leasing</h2>
              <div class="form-group row">
                <div class="col-sm-12 col-md-12">
                  <label class="required">Lease type</label>
                  <select name="leas_type" id="txt_type">
                       <option value="2">Corporate Leasing</option>
                      <option value="1">Personal Leasing</option>       
                    </select>
                </div>
                <div class="col-sm-6 col-md-6"> </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-12">
                  <label class="required">First Name</label>
                  <input type="text" class="input-text full-width" name="fullname" id="txt_booking_fname" value=""  />
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
                 <div class="col-sm-6 col-md-6">
                  <label class="required">Phone Number</label>
                  <input type="text" class="input-text full-width" name="phone" id="txt_booking_mobile" value=""  />
                </div>
                
                  <div class="col-sm-6 col-md-6">
                  <label class="required">Address</label>
                  <input type="text" class="input-text full-width" name="address" id="txt_booking_mobile" value=""  />
                </div>
                
                 <div class="col-sm-12 col-md-12">
                  <label class="required">Detail</label>
                  <textarea class="full-width"  name="lease_detail" ></textarea>
                </div>
              </div>
              
              <hr />
              
            </div>
            

            <input type="hidden" name="total_amount" value="<?php echo $finalamount + $TotalFinalAmount;?>" />
            <div class="form-group row">
              <div class="col-sm-6 col-md-5">
                <input type="submit" class="btn btn-primary btn-primary-color" name="saveinfo" value="Send">
              </div>
            </div>
          </div>
        </div>
      </form>
   
   
   
   
   </div>
   </div>  
    
    <div class="row">
    <div class="col-sm-6 col-xs-12">
    
        </div>
        </div>
        
        


<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
  <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h2 id="myModalLabel" class="modal-title">Leasing</h2>
      </div>
      <div class="modal-body">
        <div class="row"><div class="col-sm-12">
        
           <div style="margin:0;padding: 0 30px;" class="booking-section">
		   
                   <div class="person-information">
                       
                       <div class="form-group row">
                       <h4>Lease type</h4>
                       <div class="col-sm-4 col-md-4">
                       	<div class="selector">
                                <select name="txt_type" id="txt_type">
                                   <option value="Corporate Leasing">Corporate Leasing</option>
                                  <option value="Personal Leasing">Personal Leasing</option>       
                                </select><span class="custom-select">Corporate Leasing</span></div>
                       </div>
                       </div>
                       <div class="form-group row">
                           <div class="col-sm-6 col-md-6">
                                  <label class="required">Name</label>
                               <input type="text" required="required" value="" class="input-text full-width" id="txt_name" name="txt_name" placeholder="Name">
                           </div>
                           
                           <div class="col-sm-6 col-md-6">
                               <label class="required">Email Id</label>
                               <input type="email" value="" required="required" class="input-text full-width" id="txt_email" name="txt_email" placeholder="Email Id">
                           </div>
                                        
                     </div>
                        <div class="form-group row">
                          
                          <div class="col-sm-6 col-md-6">
                             <label class="required">Phone</label>
                               <input type="text" value="" required="required" class="input-text full-width" id="txt_phone" name="txt_phone" placeholder="Phone">
                          </div>
                            
                          <div class="col-sm-6 col-md-6">
                             <label class="required">Mobile</label>
                               <input type="text" value="" required="required" class="input-text full-width" id="txt_mobile" name="txt_mobile" placeholder="Mobile">
                           </div>               
                     </div>
                       <div class="form-group row">
                                          
                                               
                            <div class="col-sm-12 col-md-12">
                             <label>Address</label>
                               <textarea required="required" class="input-text full-width" id="txt_address" name="txt_address" placeholder="Address"></textarea>
                           </div>
                                         
                     </div>
                       
                       
       <div class="form-group row">
       <h4>Lease information</h4>
                                    
                           <div class="col-sm-12 col-md-12">
                              <label>Message</label>
                              <span class="help-block">The more information you give us, the better our quotation will meet your requirements.</span>
                               <textarea class="input-text full-width" id="txt_message" name="txt_message" placeholder=""></textarea>
                            
                           </div>
                       </div>
                                   
                                    
                   </div>
                     
           </div>
						

						
       </div></div>
       <div style="color: red; display:none" id="validaion_msg">Please fill all required fields</div>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button value="Submit" name="btn_corporate_booking_lease" id="btn_corporate_booking_lease" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>
        
        
        
       
                    
   </div>
   </div>
        </section>
        
        
        

