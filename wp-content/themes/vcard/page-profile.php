<?php
/*
 * Template Name: Profile
 */
get_header();?>


<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>		<div class="item-border"><span></span></div>	
</section><!-- /#profile -->


            <section id="profile" class="item noprint">	
               <h2 class="item-title"> <span class="title"><?php _e('my profile','vcard'); ?></span> <span class="icon-user"></span> </h2>
               <div class="item-cont clearfix">
                   <div class="hidden">
                       <div class="col500 clearfix fl-left">
                           <?php if ($avatar_img = $vcard_data['avatar_image']):?>
                                <div class="profile-img"><img src="<?php echo $avatar_img;?>"/></div>
                           <?php endif;?>
                           <div class="profile-info">
                               <?php if ($profile_title = $vcard_data['title_profile']):?>
                                    <h3><?php echo $profile_title;?></h3>
                               <?php endif;?>
                               <?php if ($profile_desc = apply_filters('the_content', $vcard_data['description_profile'])):?>
                                    <?php echo $profile_desc;?>
                               <?php endif;?>
                           </div>
                       </div>

                       <div class="col260 fl-right">
                           <ul class="profile-data">
                               <?php if ($profile_name = $vcard_data['name_profile']):?>
                                    <li><h4><?php _e('name','vcard'); ?></h4> <div><?php echo $profile_name;?></div></li>
                               <?php endif;?>
                               <?php if ($profile_age = $vcard_data['age_profile']):?>
                                    <li><h4><?php _e('Age','vcard'); ?></h4> <div><?php echo $profile_age;?></div></li>
                               <?php endif;?>
                               <?php if ($profile_adr = $vcard_data['contact_address']):?>
                                    <li><h4><?php _e('Address','vcard'); ?></h4> <div><?php echo $profile_adr;?></div></li>
                               <?php endif;?>
                               <?php if ($profile_email = $vcard_data['email_address']):?>
                               <li><h4><?php _e('E-mail','vcard'); ?></h4> <div><?php echo $profile_email;?></div></li>
                               <?php endif;?>
                               <?php if ($profile_phone = $vcard_data['contact_phone']):?>
                               <li><h4><?php _e('phone','vcard'); ?></h4> <div><?php echo $profile_phone;?></div></li>
                               <?php endif;?>
                               <li><h4><?php _e('freelance','vcard'); ?></h4> 
                                   <div>
                                        <?php if ($profile_freelance = $vcard_data['freelance_profile']):
                                                _e('Available','vcard');
                                              else:
                                                _e('busy','vcard');
                                              endif;?>
                                   </div>
                               </li>
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
            
<?php get_footer();?>