		<!-- Main page container -->
		<section class="container" role="main">
		
			<!-- Left (navigation) side -->
			<div class="navigation-block">
            
				<nav class="main-navigation" role="navigation">

					<ul>
						<li<?php if($_GET['p']==''){ echo ' class="current"';} else { echo '';}?>><a href="./" class="no-submenu"><span class="awe-home"></span>Dashboard</a></li>
						<li<?php if($_GET['p']=='sitecms_mgmt' or $_GET['p']=='sitecms_form'){ echo ' class="current"';} else { echo '';}?>>
                        <a href="./?p=sitecms_mgmt" class="no-submenu"><span class="awe-tasks"></span>Content Pages</a></li>
						
                        <li<?php if($_GET['p']=='partner_mgmt' or $_GET['p']=='partner_form'){ echo ' class="current"';} else { echo '';}?>>
                        <a href="./?p=partner_mgmt" class="no-submenu"><span class="awe-tasks"></span>Our Partner</a></li>
                        
                        <li<?php if($_GET['p']=='location_mgmt' or $_GET['p']=='location_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=location_mgmt" class="no-submenu"><span class="awe-tasks"></span>Location Management</a></li>
                        
                        <li<?php if($_GET['p']=='feedback_mgmt'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=feedback_mgmt" class="no-submenu"><span class="awe-tasks"></span>Feedback</a></li>
                        
                        <li<?php if($_GET['p']=='faq_mgmt' or $_GET['p']=='faq_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=faq_mgmt" class="no-submenu"><span class="awe-tasks"></span>FAQ Management</a></li>
                        
                        <!--<li<?php if($_GET['p']=='qust_mgmt' or $_GET['p']=='qust_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=qust_mgmt" class="no-submenu"><span class="awe-tasks"></span>Questionnaire</a></li>-->
                        
                        <li<?php if($_GET['p']=='category_mgmt' or $_GET['p']=='category_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=category_mgmt" class="no-submenu"><span class="awe-tasks"></span>Category Management</a></li>
                        
                        <li<?php if($_GET['p']=='product_mgmt' or $_GET['p']=='product_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=product_mgmt" class="no-submenu"><span class="awe-tasks"></span>Car Management</a></li>
                        
                        <li<?php if($_GET['p']=='ext_f_mgmt' or $_GET['p']=='ext_f_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=ext_f_mgmt" class="no-submenu"><span class="awe-tasks"></span>Extra Feature Management</a></li>
                        
                        <li<?php if($_GET['p']=='lease_mgmt' or $_GET['p']=='lease_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=lease_mgmt" class="no-submenu"><span class="awe-tasks"></span>Lease Management</a></li>
                        
                        <li<?php if($_GET['p']=='limousine_mgmt' or $_GET['p']=='limousine_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=limousine_mgmt" class="no-submenu"><span class="awe-tasks"></span>Limousine Management</a></li>
                        
                         <li<?php if($_GET['p']=='order_mgmt' or $_GET['p']=='order_form'){ echo ' class="current"';} else { echo '';}?>><a href="./?p=order_mgmt" class="no-submenu"><span class="awe-tasks"></span>Order Management</a></li>
                       
					</ul>

				</nav>
				<!--<section class="side-note">
					<div class="side-note-container">
						<h2>Sample Side Note</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis erat dui, quis purus.</p>
					</div>
					<div class="side-note-bottom"></div>
				</section>-->
                </div>