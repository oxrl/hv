<?php
/*
 * Template Name: Resume
 */
?>
<?php get_header();?>


<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>		<div class="item-border"><span></span></div>
</section><!-- /#profile -->


		<section id="resume" class="item">
           <h2 class="item-title toggle noprint opened"><span class="title"><?php _e('resume','vcard'); ?></span> <span class="icon-resume"></span> <span class="arrow"></span></h2>
           <div class="item-cont clearfix" style="display: block;">

                <div class="col500 fl-left">
                    <?php $args = array(
                         'type'                     => 'employment',
                         'taxonomy'                 => 'employment_category',
                         'pad_counts'               => false );
                     ?>
                     <?php $categories = get_categories( $args ); ?>
                     <?php $j=1; foreach($categories as $category): ?>
                         <?php $args = array(
                             'post_type'        => 'employment',
                             'employment_category'         => $category->slug,
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
			
<?php get_footer();?>