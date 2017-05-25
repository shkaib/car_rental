<header class="container">
			<!-- Main page logo -->
			<h1><a href="<?php echo SITE_URL;?>" class="brand"></a></h1>
			<!-- Main page headline -->
			<!-- Alternative navigation -->
			<nav>
				<ul>
					 <?php if($objCustomer->customer_login){ ?>  
					<li><a href="<?php echo Route::_('show=logout');?>">Logout</a></li>
                    <?php } ?>
				</ul>
			</nav>
			<!-- /Alternative navigation -->			
</header>

		<!-- Main page container -->
		<section class="container" role="main">
		
			<!-- Left (navigation) side -->
			<div class="navigation-block">
            
				<nav class="main-navigation" role="navigation">
					<ul>
						<li><a href="<?php echo SITE_URL;?>" class="no-submenu"><span class="awe-home"></span>Home</a></li>
						
						<?php if($objCustomer->customer_login){ ?>  
                        <li<?php 
						if($_GET['show']=='profile' or 
						$_GET['show']=='profile_edu' or 
						$_GET['show']=='profile_cou' or 
						$_GET['show']=='profile_cert' or 
						$_GET['show']=='profile_lng' or 
						$_GET['show']=='profile_skill' or 
						$_GET['show']=='profile_res' or 
						$_GET['show']=='profile_empt'){ 
						echo ' class="current"'; } else { echo ''; } ?>>
                        <a href="#"><span class="awe-tasks"></span>Profile</a>
                        <ul>
                        		<li><a href="<?php echo Route::_('show=profile');?>">Basic Information</a></li>
								<li><a href="<?php echo Route::_('show=profile_edu');?>">Education</a></li>
                                <li><a href="<?php echo Route::_('show=profile_cou');?>">Courses</a></li>
                                <li><a href="<?php echo Route::_('show=profile_cert');?>">Certificate's</a></li>
                                <li><a href="<?php echo Route::_('show=profile_lng');?>">Spoken Language's</a></li>
                                <li><a href="<?php echo Route::_('show=profile_skill');?>">Skill's</a></li>
                                <li><a href="<?php echo Route::_('show=profile_res');?>">Residential History</a></li>
                                <li><a href="<?php echo Route::_('show=profile_empt');?>">Employment History</a></li>
							</ul>
                        </li>
						<!--<li><a href="./?p=sitecms_mgmt" class="no-submenu"><span class="awe-tasks"></span>Mailbox</a></li>-->
                        <?php } ?>
                        <li<?php if($_GET['show']=='cms'){ echo ' class="current"'; } else { echo ''; } ?>><a href="./?p=sitecms_mgmt"><span class="awe-tasks"></span>Content Pages</a>
                        
                        <ul>
                        <?php
						$objContentList = new Content;
						$objContentList->setProperty("cms_type_id", 1);
						$objContentList->setProperty("ORDERBY", "cms_title");
						$objContentList->lstContent();
						while($ContentList = $objContentList->dbFetchArray(1)){
						?>
                        <li><a href="<?php echo Route::_('show=cms&cms_id='.$ContentList['cms_id']);?>"><?php echo $ContentList['cms_title'];?></a></li>
                        <?php } ?>
						</ul>
                        
                        </li>
                        
                        
                        
                        
                        <li<?php if($_GET['show']=='help'){ echo ' class="current"'; } else { echo ''; } ?>><a href="./?p=sitecms_mgmt"><span class="awe-tasks"></span>Help</a>
                        <ul>
                        <?php
						$objHelpList = new Content;
						$objHelpList->setProperty("cms_type_id", 2);
						$objHelpList->setProperty("ORDERBY", "cms_title");
						$objHelpList->lstContent();
						while($HelpList = $objHelpList->dbFetchArray(1)){
						?>
                        <li><a href="<?php echo Route::_('show=help&help_id='.$HelpList['cms_id']);?>"><?php echo $HelpList['cms_title'];?></a></li>
                        <?php } ?>
						</ul>
                        </li>
                        <li<?php if($_GET['show']=='guide'){ echo ' class="current"'; } else { echo ''; } ?>><a href="./?p=sitecms_mgmt"><span class="awe-tasks"></span>Guide</a>
                        <ul>
                        <?php
						$objguideList = new Content;
						$objguideList->setProperty("cms_type_id", 3);
						$objguideList->setProperty("ORDERBY", "cms_title");
						$objguideList->lstContent();
						while($guideList = $objguideList->dbFetchArray(1)){
						?>
                        <li><a href="<?php echo Route::_('show=guide&guide_id='.$guideList['cms_id']);?>"><?php echo $guideList['cms_title'];?></a></li>
                        <?php } ?>
						</ul>
                        </li>
                        <li<?php if($_GET['show']=='news'){ echo ' class="current"'; } else { echo ''; } ?>><a href="./?p=sitecms_mgmt"><span class="awe-tasks"></span>News</a>
                        <ul>
                        <?php
						$objnewsList = new Content;
						$objnewsList->setProperty("cms_type_id", 4);
						$objnewsList->setProperty("ORDERBY", "cms_title");
						$objnewsList->lstContent();
						while($newsList = $objnewsList->dbFetchArray(1)){
						?>
                        <li><a href="<?php echo Route::_('show=news&news_id='.$newsList['cms_id']);?>"><?php echo $newsList['cms_title'];?></a></li>
                        <?php } ?>
						</ul>
                        </li>
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