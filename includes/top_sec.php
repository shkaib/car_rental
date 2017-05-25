<header id="header" class="navbar-static-top">
  <div class="main-header"> <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle"> Mobile Menu Toggle </a>
    <div class="container">
      <h1 class="logo navbar-brand"> <a href="<?php echo SITE_URL;?>" title="Dollar - home"> <img src="https://expressrcar.com/images/logo_admin.png" alt="" /> </a> </h1>
      <nav id="main-menu" role="navigation">
        <ul class="menu">
          <li> <a href="<?php echo SITE_URL;?>"> Home </a> </li>
          <li class=""><a href="<?php echo Route::_('show=cms&cms_id=about-us');?>"> About </a></li>
          <!--<li class=""><a href="<?php echo Route::_('show=cms&cms_id=who-we-are');?>"> Who we are </a></li>-->
          <li class=""><a href="<?php echo Route::_('show=cms&cms_id=special-offer');?>"> Special Offer </a></li>
          <li class=""> <a href="<?php echo Route::_('show=fleet');?>"> Our Fleet </a> </li>
          <!--<li class=""><a href="<?php echo Route::_('show=leasing');?>"> Leasing </a></li>
          <li class=""> <a href="<?php echo Route::_('show=limousine');?>"> Limousine </a> </li>-->
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
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=leasing');?>"> Leasing </a> </li>
        <li class="menu-item-has-children"> <a href="<?php echo Route::_('show=cms&cms_id=contact-us');?>"> Contact Us </a> </li>
      </ul>
    </nav>
  </div>
</header>