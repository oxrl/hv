<?php get_header();?>
<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>	<div class="item-border"><span></span></div>
</section><!-- /#profile -->

<section id="blog" class="item">
    <h2 class="item-title"><a href="<?php echo $rm_blog_page_link; ?>"><span class="title"><?php the_title();?></span> <span class="icon-blog"></span></a></h2>
    <div class="item-cont clearfix">

        <div class="col535 fl-left">
                <?php if(have_posts()):the_post();?>
                    <article class="entry-box">
                        <!--header class="entry-header">
                            <h2 class="post-title"><?php the_title();?></h2>
                        </header-->
                        <div class="entry-content">
                            <div class="clearfix">
                                
                                <?php 
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'post_size', false);
                                    if($image): ?>
									<div class="entry-photo">
                                        <div class="entry-photo"><img src="<?php echo $image[0];?>"/></div>
									</div>
                                <?php endif;?>
                                
                                <div class="entry-text2">
                                    <div><?php the_content();?></div>
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