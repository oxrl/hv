<?php
/*
 * Template Name: HomePage ResumeStyle
 */
get_header();?>

            <section id="profile" class="item noprint">	
               <h2 class="item-title"> <span class="title"><?php _e('my profile','vcard'); ?></span> <span class="icon-user"></span> </h2>
               <div class="item-cont clearfix">
                   <div class="hidden">
                       <div class="col500 clearfix fl-left">
						   <?php $avatar_img = (isset($vcard_data['avatar_image'])) ? $vcard_data['avatar_image'] : '';
								 if ($avatar_img) : ?>
                                <div class="profile-img"><img src="<?php echo $avatar_img;?>"/></div>
                           <?php endif;?>
                           <div class="profile-info">
                               <?php $profile_title = (isset($vcard_data['title_profile'])) ?  $vcard_data['title_profile'] : '';
									 if ($profile_title) : ?>
                                    <h3><?php echo $profile_title;?></h3>
                               <?php endif;?>
							   <?php $description_profile = (isset($vcard_data['description_profile'])) ? $vcard_data['description_profile'] : ''; ?>
                               <?php if ($profile_desc = apply_filters('the_content', $description_profile)) : ?>
                                    <?php echo $profile_desc;?>
                               <?php endif;?>
                           </div>
                       </div>

                       <div class="col260 fl-right">
                           <ul class="profile-data">
                               <?php $profile_name = (isset($vcard_data['name_profile'])) ? $vcard_data['name_profile'] : '';
									 if ($profile_name) : ?>
                                    <li><h4><?php _e('name','vcard'); ?></h4> <div><?php echo $profile_name;?></div></li>
                               <?php endif;?>
							   <?php $profile_age = (isset($vcard_data['age_profile'])) ? $vcard_data['age_profile'] : '';
									 if ($profile_age) : ?>
                                    <li><h4><?php _e('Age','vcard'); ?></h4> <div><?php echo $profile_age;?></div></li>
                               <?php endif;?>
							   <?php $profile_adr = (isset($vcard_data['contact_address'])) ? $vcard_data['contact_address'] : '';
									 if ($profile_adr) : ?>
                                    <li><h4><?php _e('Address','vcard'); ?></h4> <div><?php echo $profile_adr;?></div></li>
                               <?php endif;?>
							   <?php $profile_email = (isset($vcard_data['email_address'])) ? $vcard_data['email_address'] : '';
									 if ($profile_email) : ?>
                               <li><h4><?php _e('E-mail','vcard'); ?></h4> <div><?php echo $profile_email;?></div></li>
                               <?php endif;?>
							   <?php $profile_phone = (isset($vcard_data['contact_phone'])) ? $vcard_data['contact_phone'] : '';
									 if ($profile_phone) : ?>
                               <li><h4><?php _e('phone','vcard'); ?></h4> <div><?php echo $profile_phone;?></div></li>
                               <?php endif;?>
							   <?php $profile_freelance = (isset($vcard_data['freelance_profile'])) ? $vcard_data['freelance_profile'] : ''; ?>
							   <?php if ($profile_freelance) { ?>
                               <li><h4><?php _e('Freelance','vcard'); ?></h4> 
                                   <div>
										<?php _e('Available','vcard'); ?>
                                   </div>
                               </li>
							   <?php } ?>
                           </ul>
                       </div>
                   </div>
				   <?php if ($vcard_data['blog_link_enable'] == 1) { ?>
                    <a class="blog-link" href="<?php echo $rm_blog_page_link; ?>">
                       <span class="icon"></span>
                       <span class="label"><?php _e('MY BLOG','vcard'); ?></span>
                    </a>
					<?php } ?>
               </div>
			   <div id="profile-brd" class="item-border"><span><span></span></span></div>
           </section><!-- /#profile -->
            
			<?php if ($vcard_data['homepage_resume'] != 1) { ?>
            <section id="resume" class="item">
               <h2 class="item-title toggle <?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo 'opened'; } else { echo 'closed'; } } ?> noprint"><span class="title"><?php _e('resume','vcard'); ?></span> <span class="icon-resume"></span> <span class="arrow"></span></h2>
               <div class="item-cont clearfix"<?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo ' style="display: block;"'; } } ?>>

                <div class="col500 fl-left">
                    <?php $args = array(
                         'type' => 'employment',
                         'taxonomy' => 'employment_category',
                         'pad_counts' => false,
  						 'orderby' => 'name',
						 'order' => 'asc');
                     ?>
                     <?php $categories = get_categories( $args ); ?>
                     <?php $j=1; foreach($categories as $category): ?>
                         <?php $args = array(
                             'post_type' => 'employment',
                             'employment_category' => $category->slug,
                             'post_status' => 'publish',
                             'posts_per_page' => -1,
                             'orderby' => 'date',
                             'order' => 'DESC',
                         ); 
                         ?>
                         <?php $employment_posts = new WP_Query($args);  ?>

                             <div class="resume-category">
                                 <h3 class="resume-category-title clearfix"><?php echo $category->name;?> <span class="icon-plus"></span></h3>
                                 <?php $i=$j+1; while ($employment_posts -> have_posts()):$employment_posts -> the_post();?>
                                 <div class="resume-post">
                                     <div class="resume-post-body">
                                         <?php $from = get_post_meta($post->ID, 'vc_from_date', true ); $to = get_post_meta($post->ID, 'vc_to_date', true );?>
                                              <div class="resume-post-date"><?php echo $from; if($to): echo " - ".$to; endif;?></div>
                                         <h4 class="resume-post-title"><?php the_title();?></h4>
                                         <?php if($employer = get_post_meta($post->ID, 'vc_employer', true )):?>
                                              <h5 class="resume-post-subtitle"><?php echo $employer;?></h5>
                                         <?php endif;?>
                                         <div class="resume-post-cont">
                                             <?php the_content();?>
                                         </div>
                                     </div>
                                 </div>
                                 <?php $i++; endwhile; wp_reset_postdata();?>
                              </div>
                       <?php $j=$i; $j++; endforeach;?>
                       <?php if (isset($vcard_data['upload_download_btn'])):?>
                       <div class="resume-btns noprint" id="resume-btns">
                           <?php if($vcard_data['show_download_btn']):?>
                                <a target="_blank" href="<?php echo $vcard_data['upload_download_btn'];?>" download class="btn"><i class="icon-cloud"></i>Download resume</a>
                           <?php endif;?>
                           <?php if($vcard_data['show_print_btn']):?>
                                <a id="printBtn" onclick="window.print();return false;" target="_blank" href="#" class="btn" ><i class="icon-print"></i>print resume</a>
                           <?php endif;?>
                       </div>
                        <?php endif;?>
                   </div><!-- /.col500 -->

                   <div class="col260 fl-right noprint">
                       <div class="resume-sidebar">
                           <?php dynamic_sidebar('skills_sidebar');?>
                       </div><!-- /.resume_sidebar -->
                   </div><!-- /.col260 -->

               </div><!-- /.item-cont -->
			   <div class="item-border"><span></span></div>
            </section><!-- /#resume -->
			<?php } ?>

		<?php if ($vcard_data['homepage_portfolio'] != 1) { ?>
        <section id="portfolio" class="item noprint">
           <h2 class="item-title toggle <?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo 'opened'; } else { echo 'closed'; } } ?>"><span class="title"><?php _e('My Portfolio','vcard'); ?></span> <span class="icon-portfolio"></span> <span class="arrow"></span></h2>
           <div class="item-cont"<?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo ' style="display: block;"'; } } ?>>
               <div class="controls">
                   <ul>
                       <li class="filter active" data-filter="all"><?php _e('All','vcard'); ?></li>
                       <?php $terms = get_terms("portfolio_category");
                       foreach ( $terms as $term ) :?>
                            <li class="filter" data-filter="<?php echo 'category_'.$term->term_id?>"><?php echo $term->name?></li>
                       <?php endforeach;?>
                   </ul>
               </div>

               <!-- GRID -->
               <ul id="Grid">
                    <?php 
                        global $paged;
                        if( get_query_var( 'paged' ) )
                                $my_page = get_query_var( 'paged' );
                        else {
                                if( get_query_var( 'page' ) )
                                        $my_page = get_query_var( 'page' );
                                else
                                        $my_page = 1;
                                set_query_var( 'paged', $my_page );
                                $paged = $my_page;
                        }
                        //$posts_per_page = (isset($vcard_data['blog_posts_items_count'])) $vcard_data['blog_posts_items_count'] : '';
                        $args = array(
							'post_type' => 'portfolio',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'orderby' => 'date',
							'order' => 'DESC',
							'paged' => $paged
                        );

                    $portfolio_posts = new WP_Query($args);
                    if($portfolio_posts -> have_posts()):
                    $i = 1;while($portfolio_posts -> have_posts()):$portfolio_posts -> the_post();
                    ?>
                   <li class="mix mix_all <?php $terms = get_the_terms(get_the_ID(), 'portfolio_category');foreach ( $terms as $term ) :?>category_<?php echo $term->term_id;?> <?php endforeach;?>" <?php foreach ( $terms as $term ) :?>data-cat="<?php echo $term->term_id;?>" <?php endforeach;?>>
                        <div class="ptf-item" data-itemid="328" data-type="fullslider" data-defwidth="350">
                            
							<?php
								$video_or_direct_url = get_post_meta($post->ID, 'vc_video_or_direct_url', true );
								$portfolio_post_format = get_post_meta($post->ID, 'vc_portfolio_post_format', true );
								if ($video_or_direct_url) {
									if ($portfolio_post_format == 'video') {
										echo '<a class="fancybox various fancybox.iframe" rel="group" href="'.$video_or_direct_url.'">';
									} else if ($portfolio_post_format == 'directlink') {
										echo '<a class="fancybox_direct_link" rel="group" href="'.$video_or_direct_url.'">';
									}
								} else {
									echo '<a class="fancybox" rel="group" href="#fancy'.$i.'">';
								}
								
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'portfolio_size', false);
								if($image):
							?>
                                    <div class="ptf-img-wrap">
                                        <img src="<?php echo $image[0];?>"/>
                                    </div>
                                 <?php endif;?>
                                 <div class="ptf-cover">
                                     <div class="ptf-button"><span>View Large</span></div>
                                     <div class="ptf-details">
                                         <h2><?php the_title();?></h2>
                                         <?php
                                            $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                                            $terms = array_values($terms);
                                          ?>
                                               <span><?php echo $terms[0]->name?></span>
                                     </div>
                                 </div>
                             </a>

                            <div id="fancy<?php echo $i;?>" class="fancy-wrap">
                                 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'portfolio_fancy_size', false);
                                 if($image): ?>
                                    <img src="<?php echo $image[0];?>"/>
                                 <?php endif;?>
                                 <div class="fancy">
                                     <h2><?php the_title();?></h2>
                                     <?php the_content();?>
                                 </div>
                             </div>
                        </div>
                    </li>
                        <?php $i++; endwhile;
                    endif; wp_reset_query();?>
               </ul>
               <ul <?php if (isset($vcard_data['portfolio_items'])) { if($portfolio_count = $vcard_data['portfolio_items']):?>data="<?php echo $portfolio_count?>"<?php else:?>data="9" <?php endif; } ?>id="pagination" class="clearfix">&nbsp;</ul>

           </div>
		   <div class="item-border"><span></span></div>
       </section><!-- /#portfolio -->
	   <?php } ?>
	   
        <?php if ($vcard_data['homepage_contact'] != 1) { ?>
        <section id="contact" class="item noprint">
            <h2 class="item-title toggle <?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo 'opened'; }  else { echo 'closed'; } } ?>"><span class="title"><?php _e('Contact info','vcard'); ?></span> <span class="icon-contact"></span> <span class="arrow"></span></h2>
            <div class="item-cont"<?php if (isset($vcard_data['homepage_expand'])) { if ($vcard_data['homepage_expand'] == '1') { echo ' style="display: block;"'; } } ?>>
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
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
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
				<?php endif; ?>
				
			<?php endif; ?> 
			
		<?php } ?>
		
<?php get_footer();?>