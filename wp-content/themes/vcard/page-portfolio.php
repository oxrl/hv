<?php
/*
 * Template Name: Portfolio
 */
get_header();?>


<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>		<div class="item-border"><span></span></div>	
</section><!-- /#profile -->

		<section id="portfolio" class="item noprint">
           <h2 class="item-title toggle opened"><span class="title"><?php _e('My Portfolio','vcard'); ?></span> <span class="icon-portfolio"></span> <span class="arrow"></span></h2>
           <div class="item-cont" style="display: block;">
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
			
<?php get_footer();?>