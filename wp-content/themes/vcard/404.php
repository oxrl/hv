<?php
/*
 * Template Name: 404 Error
 */
?>
<?php get_header();?>
<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>	<div class="item-border"><span></span></div>
</section><!-- /#profile -->

<section id="blog" class="item">
    <h2 class="item-title"><a href="<?php echo $rm_blog_page_link; ?>"><span class="title"><?php _e('my blog posts','vcard'); ?></span> <span class="icon-blog"></span></a></h2>
    <div class="item-cont clearfix">

        <div class="col535 fl-left">
            <article class="entry-box">
                <?php if(have_posts()):the_post();?>
                    <header class="entry-header">
                            <h2 class="post-title"><?php the_title();?></h2>
                    </header>
                    <div class="entry-content">
                        <div class="clearfix">
                            <div class="entry-text">
                                <div><?php the_content();?></div>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <header class="entry-header">
                        <h2 class="post-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'vcard' ); ?></h2>
                    </header>
                    <div class="entry-content">
                        <div class="clearfix">
                            <div class="entry-text">
                                <div><p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'vcard' ); ?></p></div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </article>
        </div><!-- /.col535 -->

        <div class="col230 fl-right">
            <?php get_sidebar();?>
        </div><!-- /.col230 -->
    </div><!-- /.item-cont -->	<div class="item-border"><span></span></div>
</section><!-- /#post -->
<?php get_footer();?>