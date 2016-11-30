<?php get_header();?>
<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>		<div class="item-border"><span></span></div>	
</section><!-- /#profile -->

<section id="blog" class="item">
    <h2 class="item-title"><a href="<?php echo $rm_blog_page_link; ?>"><span class="title"><?php _e('my blog posts','vcard'); ?></span> <span class="icon-blog"></span></a></h2>
    <div class="item-cont clearfix">

		<?php
			$s = $_GET['s'];
			$args=array(
				'post_type' => array('post'),
				's' => $s,
				'post_status' => 'publish',
				'paged' => $paged
			);
			$wp_query = new WP_Query($args);
		?>
			
        <div class="col535 fl-left">
                <?php if ( have_posts() ) : ?>
                    <?php while(have_posts()):the_post();?>
                        <article class="entry-box">
                           <header class="entry-header">
                               <h2 class="post-title"><?php the_title();?></h2>
                           </header>
                           <div class="entry-content">
                               <div class="clearfix">
                                   <div class="entry-photo">
                                   <?php 
                                       $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'post_size', false);
                                       if($image): ?>
                                           <div class="entry-photo"><img src="<?php echo $image[0];?>"/></div>
                                   <?php endif;?>
                                   </div>
                                   <div class="entry-text">
                                       <div><?php the_excerpt();?></div>
                                   </div>
                               </div>
                           </div>
                           <footer><a class="entry-more btn" href="http://localhost/vcard/you-sweet-realms-4/">Read More</a></footer>
                       </article>
                    <?php endwhile;?>
                <?php else:?>
                    <article class="entry-box">
                        <header class="entry-header">
                            <h2 class="post-title"><?php _e( 'Nothing Found', 'vcard' ); ?></h2>
                        </header>
                        <div class="entry-content">
                            <div class="clearfix">
                                <div class="entry-photo">
                                <?php 
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'post_size', false);
                                    if($image): ?>
                                        <div class="entry-photo"><img src="<?php echo $image[0];?>"/></div>
                                <?php endif;?>
                                </div>
                                <div class="entry-text">
                                    <div>
                                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
                                        <?php get_search_form(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif;?>
        </div><!-- /.col535 -->

        <div class="col230 fl-right">
            <?php get_sidebar();?>
        </div><!-- /.col230 -->
    </div><!-- /.item-cont -->		<div class="item-border"><span></span></div>	
</section><!-- /#post -->
<?php get_footer();?>