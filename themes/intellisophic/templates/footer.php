<?php
$addr = get_option('theme_options_addr');
$city = get_option('theme_options_city');
$state = get_option('theme_options_state');
$zip = get_option('theme_options_zip');
$country = get_option('theme_options_country');
$phone_call = get_option('theme_options_tel');
$email = get_option('theme_options_email');
$name = get_option('theme_options_name');
?>
<div itemscope itemtype="http://schema.org/LocalBusiness">
    <footer class="container-footer">
        <div class="container pdb4">
            <div class="row">
                <div class="col-sm-5">
                    <div class="footer-col">

                        <div class="media-left"><img class="media-object" src="<?php bloginfo('template_url'); ?>/images/Layer-45.png" alt="Address Information"></div>
                        <div class="media-right">
                            <p class="footer-head">Address Information</p>
                            <span class="footer-txt" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			    <span itemprop="name"><?php echo $name ?></span> - <span itemprop="streetAddress"><?php echo $addr ?></span>, <span itemprop="addressLocality"><?php echo $city; ?></span>, <span itemprop="addressRegion"><?php echo $state; ?></span> <span itemprop="postalCode"><?php echo $zip; ?></span> - <span itemprop="addressCountry"><?php echo $country; ?></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="footer-col">

                        <div class="media-left"><img class="media-object" src="<?php bloginfo('template_url'); ?>/images/Layer-46.png" alt="Email Address"></div>
                        <div class="media-right">
                            <p class="footer-head">Email Address</p>
                            <p class="footer-txt"><span itemprop="email"><?php echo $email; ?></span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="footer-col">
                        <div class="media-left"><img class="media-object" src="<?php bloginfo('template_url'); ?>/images/Layer-47.png" alt="Contact Us"></div>
                        <div class="media-right">
                            <p class="footer-head">Contact Us</p>
                            <p class="footer-txt"><span itemprop="telephone"><?php echo $phone_call; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section8b">
            <div class="container">
                <div class="row mtop4">
                    <div class="col-sm-12">
                        <div class="footer-bar text-center center-block">
                            <p class="footer-bar-txt1 ">© <?php echo date('Y'); ?> Intellisophic - All rights reserved</p>
                            <p class="footer-bar-txt2 "><img src="http://www.intellisophic.com/wp-content/uploads/2016/09/linka-2.png"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

