<section class="main_student_guide">
	<div class="cloud_guide">
			<div class="main_wrapper">
			
			<div class="contact_main">
            <?php
			$objContent->setProperty("is_active", "1");			
			$objContent->lstContact();
			while($ContactDetail = $objContent->dbFetchArray(1)){
			?>
            <h2 class="contact_heading_txt"><?php echo $ContactDetail['contact_category_name'];?></h2>
			<p>Name: <?php echo $ContactDetail['contact_name'];?></p>
            <p>Email: <?php echo $ContactDetail['contact_email'];?></p>
            <p><?php echo $ContactDetail['contact_detail'];?></p>
			<div class="contact_template"></div>
            <?php } ?>
            
            
            
            
            
            
			</div>
		</div>
		
		
	</div>
</section>