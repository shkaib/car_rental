<?php
if(!empty($_GET['customer_name'])){
	$objOrder->setProperty("customer_name", $_GET['customer_name']);
}
if(!empty($_GET['customer_cd'])){
	$objOrder->setProperty("customer_cd", $_GET['customer_cd']);
}
if(!empty($_GET['order_status'])){
	$objOrder->setProperty("order_status", $_GET['order_status']);
}
if(!empty($_GET['from_dt']) && !empty($_GET['to_dt'])){
	$from_dt 	= $_GET['from_dt'];
	$to_dt 		= $_GET['to_dt'];
	if(strtotime($from_dt) >= strtotime($to_dt)){
		$objCommon->setMessage("From date must be less than to date", 'Error');
	}
	else{
		$objOrder->setProperty("from_dt", $from_dt);
		$objOrder->setProperty("to_dt", $to_dt);
		$param .= "&from_dt=" . $_GET['from_dt'] . "&to_dt=" . $_GET['to_dt'];
	}
}
$objOrder->setProperty("order_archive", "Archived");
?>
<script type="text/javascript">
function doFilter(frm){
	var qString = '';
	if(frm.customer_name.value != ""){
		qString += '&customer_name=' + escape(frm.customer_name.value);
	}
	if(frm.order_status.value != ""){
		qString += '&order_status=' + escape(frm.order_status.value);
	}
	if(frm.from_dt.value != "" && frm.to_dt.value != ""){
		qString += '&from_dt=' + frm.from_dt.value;
		qString += '&to_dt=' + frm.to_dt.value;
	}
	document.location = '?p=order_archive' + qString;
}
</script>
<div class="title_div">
	<div style="float:left;padding-top:3px;"><?php echo ORD_BRD_ARCHIVE;?></div>
	<div style="float:right; padding:0px 2px 2px; *padding: 0 4px 2px 2px;">
        <a href="./?p=order_mgmt" class="lnkButton"><?php echo _ORDER_MGMT;?></a>
    </div>
</div>
<form name="frmOrder" id="frmOrder">
<div id="divfilteration">
	<div class="holder">
        <label>Customer Name/E-mail Address</label>
        <div>
        <input type="text" name="customer_name" id="customer_name" value="<?php echo $_GET['customer_name'];?>" size="35" />
        </div>
    </div>
    <div class="holder">
        <label>Order Status</label>
        <div>
        <select id="order_status" name="order_status" class="rr_select" style="width:130px;">
            <option value="" selected="">All</option>
            <?php
			foreach($objOrder->mOrderStatus as $status){
				$sele = ($_GET['order_status'] == $status) ? " selected" : "";
				echo '<option value="' . $status . '"' . $sele . '>' . $status . '</option>' . "n";
			}
			?>
        </select>
        </div>
    </div>
    <div class="holder">
        <label>Order From</label>
        <div><input type="text" readonly size="15" value="<?php echo $_GET['from_dt'];?>" name="from_dt" id="from_dt" class="rr_input" onclick="return showCalendar('from_dt', '%Y-%m-%d', '24', true);" /><img title="Select date" style="margin-left:5px;cursor:pointer;" src="../images/img.gif" onclick="return showCalendar('from_dt', '%Y-%m-%d', '24', true);" />
		</div>
    </div>
    <div class="holder">
        <label>Order To</label>
        <div><input type="text" readonly size="15" value="<?php echo $_GET['to_dt'];?>" name="to_dt" id="to_dt" class="rr_input" onclick="return showCalendar('to_dt', '%Y-%m-%d', '24', true);" /><img title="Select date" style="margin-left:5px;cursor:pointer;" src="../images/img.gif" onclick="return showCalendar('to_dt', '%Y-%m-%d', '24', true);" />
		</div>
    </div>
    <div class="holder">
        <label>&nbsp;</label>
        <div><input class="rr_buttonsearch" type="button" onClick="doFilter(this.form);" name="Submit" id="Submit" value=" GO " /></div>
    </div>
</div>
</form>
<form name="frmOrderStatus" id="frmOrderStatus" method="post" action="">
<input type="hidden" name="order_status" id="order_status" value="" />
<input type="hidden" name="order_cd" id="order_cd" value="" />
<?php echo $objCommon->displayMessage();?>
<div class="child_main_div">
  <table id="tblList" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th style="width:15%;" class="clsleft"><?php echo ORD_CD;?></th>
      <th style="width:25%;" class="clsleft"><?php echo ORD_CUST_NAME;?></th>
      <th style="width:10%;" class="clsleft"><?php echo ORD_DATE;?></th>
      <th style="width:10%;" class="clsleft"><?php echo ORD_GRANDTOTAL;?></th>
      <th style="width:10%;" class="clsleft"><?php echo ORD_ITEMS;?></th>
      <th style="width:15%;" class="clsleft"><?php echo ORD_STATUS;?></th>
      <th style="width:15%;"><?php echo _BTN_ACTION;?></th>
    </tr>
    <?php
	$objOrder->setProperty("limit", PERPAGE);
	$objOrder->lstOrder();
	$Sql = $objOrder->getSQL();
	if($objOrder->totalRecords() >= 1){
		while($rows = $objOrder->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
    		<tr bgcolor="<?php echo $bgcolor;?>">
                <td class="clsleft"><?php echo $rows['order_cd'];?></td>
                <td class="clsleft"><?php echo $rows['fullname'];?></td>
                <td class="clsleft"><?php echo $objCommon->printDate($rows['order_date']);?></td>
                <td class="clsleft" style="text-align:right;"><?php echo $objProduct->printPrice($rows['grand_total']);?></td>
                <td class="clsleft"><?php echo $rows['total_orders'];?></td>
                <td class="clsleft"><?php echo $rows['order_status'];?></td>
                <td>
					<a class="lnk" href="javascript:void(null);" onClick="doToggle('ord_<?php echo $rows['order_cd'];?>');" title="View order details">Order Details 
					<img src="<?php echo IMAGES_URL;?>arrow-asc.png" border="0" />
					</a>
				</td>
    		</tr>
    		<tr id="ord_<?php echo $rows['order_cd'];?>" style="display:none;" bgcolor="<?php echo $bgcolor;?>">
    			<td colspan="2">
					<?php
	                $objCustomer = new Customer;
					$objCustomer->setProperty("customer_cd", $rows['customer_cd']);
					$objCustomer->lstUsers();
					$rows_cust = $objCustomer->dbFetchArray(1);
					?>
                	<table width="100%" cellpadding="0" cellspacing="0" style="padding:5px;">
						<tr>
							<th style="text-align:left; padding:3px;">Billing Address</th>
						</tr>
						<tr>
							<td style="text-align:left; padding:3px;">
								<?php echo $objCustomer->billingAddress($rows_cust, true);?>
							</td>
						</tr>
                        <tr>
							<td style="border:none;">&nbsp;</td>
						</tr>
						<tr>
							<th style="text-align:left; padding:3px;">Shipping Address</th>
						</tr>
						<tr>
							<td style="text-align:left; padding:3px;">
								<?php echo $objCustomer->shippingAddress($rows_cust);?>
							</td>
						</tr>
					</table>
				</td>
    			<td colspan="5" style="padding:5px;">
    			<?php
				$objOrderN = new Order;
				$objOrderN->setProperty("order_cd", $rows['order_cd']);
				$objOrderN->lstOrderDetails();
				?>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<th style="width:30%;text-align:left; padding:3px;">Item</th>
						<th style="width:26%;text-align:left; padding:3px;">Size</th>
						<th style="width:10%; padding:3px;">Quantity</th>
						<th style="width:17%;text-align:right; padding:3px;">Price</th>
						<th style="width:17%;text-align:right; padding:3px;">Total</th>
					</tr>
					<?php
					$subtotal = 0;
					while($rows_det = $objOrderN->dbFetchArray(1)){
						$subtotal += $rows_det['price'] * $rows_det['quantity'];
					?>
					<tr>
						<td style="text-align:left; padding:3px;"><?php echo $rows_det['product_name'];?></td>
						<td style="text-align:left; padding:3px;"><?php echo $rows_det['product_size'];?></td>
						<td style="padding:3px;"><?php echo $rows_det['quantity'];?></td>
						<td style="text-align:right; padding:3px;"><?php echo $objProduct->printPrice($rows_det['price']);?></td>
						<td style="text-align:right; padding:3px;"><?php echo $objProduct->printPrice($rows_det['price'] * $rows_det['quantity']);?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td colspan="4" style="text-align:right; padding-right:3px;">Sub Total:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $objProduct->printPrice($subtotal);?></td>
					</tr>
					<tr>
						<td colspan="4" style="text-align:right;">Shipping Charge:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $objProduct->printPrice($rows['ship_charge']);?></td>
					</tr>
					<tr>
						<td colspan="4" style="text-align:right;">Shipping Type:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['shipping_type'];?></td>
					</tr>
					<tr>
						<td colspan="4" style="text-align:right;">Delivery Time:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['delivery_time'];?></td>
					</tr>
					<tr>
						<td colspan="4" style="text-align:right;">Payment Method:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['payment_method'];?></td>
					</tr>
					<?php if($rows['payment_method'] == "AdvancePayment"){?>
                    <tr>
						<td colspan="4" style="text-align:right;">Bank Name:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['bank_name'];?></td>
					</tr>
                    <tr>
						<td colspan="4" style="text-align:right;">Account Name:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['account_name'];?></td>
					</tr>
                    <tr>
						<td colspan="4" style="text-align:right;">Account #:</td>
						<td style="text-align:right; padding-right:3px;"><?php echo $rows['account_number'];?></td>
					</tr>
                    <?php }?>
					<tr>
						<td colspan="5" style="text-align:right;">
							<span style="text-align:left;padding-right:15px;">
								<img style="cursor:pointer;" onClick="doToggle('ord_<?php echo $rows['order_cd'];?>');" src="<?php echo IMAGES_URL;?>arrow-desc.png" border="0" />
							</span>
						</td>
					</tr>
				</table>
				</td>
			</tr>
    		<?php
		}
    }
	else{
	?>
    <tr>
    	<td colspan="7" align="center"><?php echo NOT_FOUND_ORDER;?></td>
    </tr>
    <?php
	}
	?>
  </table>
</div>
</form>
<br />
<?php
if($objOrder->totalRecords() >= 1){
	$objPaginate = new Paginate($Sql, PERPAGE, OFFSET, "./?p=order_archive");
	?>
	<div class="pagination_div">
	<div style="float:left;width:150px;"><?php $objPaginate->recordMessage();?></div>
	<div id="paging" style="float:right;width:650px;text-align:right; padding-right:5px;">
	    <?php $objPaginate->showpages();?>
	</div>
<?php }?>
</div>	