<?php
$quest = DecData($_GET['question_id']);
	$objContent->setProperty("question_id", $quest);
	$objContent->lstQuestions();
	$data = $objContent->dbFetchArray(1);
	extract($data);
?>
<div class="content-block" role="main">
  <div class="row"> 
    <!-- Data block -->
    <article class="span6 data-block">
      <div class="data-container">
        <header>
          <h2><?php echo $q_name;?> :: posted on <?php echo DTFormate($posted_date);?></h2>
          <ul class="data-header-actions">
            <li> <a class="btn btn-alt btn-inverse" href="./?p=qust_mgmt">Back</a> </li>
          </ul>
        </header>
        <section>
          <div class="tab-pane active" id="static">
            <table width="100%" border="0" cellspacing="5" cellpadding="5">
              <tr>
                <th width="35%" align="left">Name</th>
                <td width="65%"><?php echo $q_name;?></td>
              </tr>
              <tr>
                <th align="left">Email</th>
                <td><?php echo $q_email;?></td>
              </tr>
              <tr>
                <th align="left">Business or Organization Name</th>
                <td><?php echo $q_business_name;?></td>
              </tr>
              <tr>
                <th align="left">Phone Numaber</th>
                <td><?php echo $q_phone;?></td>
              </tr>
              <tr>
                <th align="left">Website URLs</th>
                <td><?php echo $q_website;?></td>
              </tr>
              <tr>
                <th align="left">Tell me about your Company</th>
                <td><?php echo $q_about_company;?></td>
              </tr>
              <tr>
                <th align="left">Identify your goal.</th>
                <td><?php echo idealGoal($q_identify_goal);?></td>
              </tr>
              <tr>
                <th align="left">What is the purpose of this site?</th>
                <td><?php echo PorposeOfSite($q_purpose_of_site);?></td>
              </tr>
              <tr>
                <th align="left">Do you have a time frame or deadline to get this site online?</th>
                <td><?php echo $q_time_frame;?></td>
              </tr>
              <tr>
                <th align="left">How much are you willing to spend?</th>
                <td><?php echo $q_willing__spend;?></td>
              </tr>
              <tr>
                <th align="left">What action(s) should the user perform when visiting your site?</th>
                <td><?php echo visiting_site($q_visitor_yur_site);?></td>
              </tr>
              <tr>
                <th align="left">Are there corporate colors, logo, fonts etc. that should be incorporated?</th>
                <td><?php echo $q_color_option;?></td>
              </tr>
              <tr>
                <th align="left">If you do not already have a logo, are you going to need one designed?</th>
                <td><?php echo $q_logo_option;?></td>
              </tr>
              <tr>
                <th align="left">Are there any additional features that you would like for your site or things that you would like to add in the future? Please be as specific and detailed as possible.</th>
                <td><?php echo $q_add_features;?></td>
              </tr>
              <tr>
                <th align="left">Please include at least 3 links of sites of your competition. What do you like and don't like about them? What would you like to differently or better?</th>
                <td><?php echo $q_links_cop_1;?><br />
                  <?php echo $q_links_cop_2;?><br />
                  <?php echo $q_links_cop_3;?></td>
              </tr>
              <tr>
                <th align="left">Along with putting down the site address, please comment on what you like about each site, i.e. the look and feel, functionality, colors etc. These do not have to have anything to do with your business, but could have features you like. Please include at least 3 examples. </th>
                <td><?php echo $q_links_comm_1;?><br />
                  <?php echo $q_links_comm_2;?><br />
                  <?php echo $q_links_comm_3;?></td>
              </tr>
            </table>
          </div>
        </section>
      </div>
    </article>
  </div>
</div>
<?php
//if($read_status==1){
$objQuestion = new Content;
$objQuestion->setProperty("question_id", $quest);
$objQuestion->setProperty("read_status", 2);
$objQuestion->actQuestions('U');
//}
?>