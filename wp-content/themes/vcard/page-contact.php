<?php
/*
 * Template Name: Contact
 */
?>
<?php get_header();?>


<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>		<div class="item-border"><span></span></div>	
</section><!-- /#profile -->

		<section id="contact" class="item noprint">
            <h2 class="item-title toggle opened"><span class="title"><?php _e('Contact info','vcard'); ?></span> <span class="icon-contact"></span> <span class="arrow"></span></h2>
            <div class="item-cont" style="display: block;">
                <?php
                    $gmap_show = (isset($vcard_data['gmap_show'])) ? $vcard_data['gmap_show'] : '';
                    $gmap_lat = (isset($vcard_data['gmap_lat'])) ? $vcard_data['gmap_lat'] : '';
                    $gmap_lng = (isset($vcard_data['gmap_lng'])) ? $vcard_data['gmap_lng'] : '';

                    if ($gmap_show and $gmap_lat and $gmap_lng):
                ?>
                        <div class="map"><div id="map-canvas"></div></div>
                <?php endif;?>
                
                <div class="clearfix">
                    <div class="form col500 fl-left">
                        <h3><?php _e("Let's keep in touch",'vcard'); ?></h3>
                        <?php get_template_part('contact','form'); ?>
                    </div>
                    <?php
						if (isset($vcard_data['contact_details'])) {
							if (isset($vcard_data['contact_details']) == 1) {
					?>
                        <div class="col260 fl-right">
                            <h3>Contact info</h3>
                            <ul class="contact-info">
                                <?php $profile_adr = (isset($vcard_data['contact_address'])) ? $vcard_data['contact_address'] : '';
									  if ($profile_adr) : ?>
                                    <li class="icon-home clearfix"><span class="icon"></span> <span class="text"><?php echo $profile_adr;?></span></li>
                                <?php endif;?>
								<?php $profile_phone = (isset($vcard_data['contact_phone'])) ? $vcard_data['contact_phone'] : '';
									  if ($profile_phone) : ?>
                                    <li class="icon-phone clearfix"><span class="icon"></span> <span class="text"><?php echo $profile_phone;?></span></li>
                                <?php endif;?>
								<?php $profile_email = (isset($vcard_data['email_address'])) ? $vcard_data['email_address'] : '';
									  if ($profile_email) : ?>
                                    <li class="icon-maile clearfix"><span class="icon"></span> <span class="text"><?php echo $profile_email;?></span></li>
                                <?php endif;?>
								<?php $contact_website = (isset($vcard_data['contact_website'])) ? $vcard_data['contact_website'] : '';
									  if ($contact_website) : ?>
                                    <li class="icon-world clearfix"><span class="icon"></span> <span class="text"><?php echo $contact_website;?></span></li>
                                <?php endif;?>
                            </ul>
                        </div>
                    <?php
							}
						}
					?>
                </div>
       
            </div>
			<div class="item-border"><span></span></div>
        </section><!-- /#contact -->
		
		<?php
			$gmap_show = (isset($vcard_data['gmap_show'])) ? $vcard_data['gmap_show'] : '';
			if($gmap_show) :
                $gmap_lat = $vcard_data['gmap_lat'];
                $gmap_lng = $vcard_data['gmap_lng'];
                if ($gmap_lat and $gmap_lng):?>
                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJKlqquAA2QYiSGftlwtLJzAmmeGutZy4&sensor=false"></script>
                    <script>
                        var map;
                        var myLatlng = new google.maps.LatLng(<?php echo $gmap_lat?>, <?php echo $gmap_lng;?>);
                        function initialize() {

                          var mapOptions = {
                                zoom: 16,
                                center: myLatlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                          }
                          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                          var marker = new google.maps.Marker({
                                  position: myLatlng,
                                  map: map,
                                  icon: '<?php echo get_template_directory_uri(); ?>/images/map-pointer.png',
                                  title: 'vCard marker'
                          });
                        }
						jQuery(window).load(function(){
							google.maps.event.addDomListener(window, 'load', initialize);
							setTimeout(initialize, 1500);
						});
                    </script>
            <?php endif;?>
        <?php endif;?> 
		
<?php get_footer();?>