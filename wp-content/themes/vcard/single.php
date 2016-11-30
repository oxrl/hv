<?php get_header();?>
<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>	<div class="item-border"><span></span></div>	
</section><!-- /#profile -->

<section id="blog" class="item">
    <h2 class="item-title"><a href="<?php echo $rm_blog_page_link; ?>"><span class="title"><?php _e('my blog posts','vcard'); ?></span> <span class="icon-blog"></span></a></h2>
    <div class="item-cont clearfix">
        <?php if(have_posts()):the_post();?>
            <div class="col535 fl-left">
                <h2 class="post-title"><?php the_title();?></h2>
                <?php $archive_year  = get_the_time('Y'); ?>
                <?php $archive_month = get_the_time('m'); ?>
                <?php $archive_day = get_the_time('d'); ?>
                <div class="post-info">Posted <?php echo get_the_time('d F, Y');  _e('by','vcard'); the_author_posts_link(); _e('in','vcard'); echo get_the_category_list( ', ', '', get_the_ID() );?> <a href="#respond" class="comments-link"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a></div>

                <div class="post-cont wp-cont">
                   <?php global $vcard_data; $post_format = get_post_meta($post->ID, 'vc_blog_post_format', true );
                        if($post_format == '')
                            $post_format = 'default';
                        $k = 1;?>
                    <?php 
                            if($post_format == 'default'): 
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'post_size', false);
                                if($image): ?>
                                    <div class="entry-photo"><img src="<?php echo $image[0];?>"/></div>
                                <?php endif;
                            elseif($post_format == 'video'): 
                                $custom_post_video_url = get_post_meta($post->ID, 'vc_vimeo_video_url', true ); 
                                $video_preview_url = ($custom_post_video_url) ? $custom_post_video_url : ''; 
                                if ($video_preview_url):		
                                    $video_preview_url = str_replace('watch?v=','',$video_preview_url);
                                    $video_preview_url = str_replace('http://','http://',$video_preview_url);
                                    $video_preview_url = str_replace('youtube.com/embed/','youtube.com/',$video_preview_url);
                                    $video_preview_url = str_replace('youtube.com/','youtube.com/embed/',$video_preview_url);
                                    $video_preview_url = str_replace('youtube.com/','youtu.be/',$video_preview_url);
                                    $video_preview_url = str_replace('youtu.be/embed/','youtu.be/',$video_preview_url);
                                    $video_preview_url = str_replace('youtu.be/','youtube.com/v/',$video_preview_url);
                                    $video_preview_url = str_replace('vimeo.com','vimeo.com',$video_preview_url);
                                    $video_preview_url = str_replace('www.','',$video_preview_url);?>
                                    <div class="entry-photo">
                                        <object width="100%" height="281">
                                        <param name="allowfullscreen" value="true" />
                                        <param name="allowscriptaccess" value="always" />
                                        <param name="movie" value="<?php echo $video_preview_url;?>" />
                                        <embed src="<?php echo $video_preview_url;?>" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="281"></embed></object>
                                    </div>
                                <?php endif;
                            elseif($post_format == 'audio'): 
                                $audio_file_mp3 = get_post_meta($post->ID, 'vc_audio_file_mp3', true );
                                if($audio_file_mp3): ?>
                                <div class="entry-photo">
                                        <audio id="player<?php echo $k; ?>" width="100%" src="<?php echo $audio_file_mp3;?>" type="audio/mp3" controls="controls">
                                </div>
                                <?php
                                endif;
                            elseif($post_format == 'slider'): 
                                if(has_post_thumbnail()): ?>
                                <div class="entry-photo">
                                    <div class="container">
                                            <?php $k = uniqid(); ?>
                                            <div id="slides<?php echo $k; ?>" class="slides">
                                                    <?php
                                                    global $vcard_data;
                                                    $i = 2;
													$posts_slideshow_number = (isset($vcard_data['posts_slideshow_number'])) ? $vcard_data['posts_slideshow_number'] : 1;
													
                                                    while($i <= $posts_slideshow_number):
                                                        
                                                        $new_attachment_ID = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post'); 
                                                        if($new_attachment_ID):
                                                            $attachment_image = wp_get_attachment_image_src($new_attachment_ID, 'post_size', false);
                                                            $attachment_data = wp_get_attachment_metadata($new_attachment_ID);?>
                                                                <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_field('post_excerpt', $new_attachment_ID); ?>" />
                                                        <?php endif; $i++; 
                                                    endwhile; ?>
                                            </div>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(function(){
                                              jQuery('#slides<?php echo $k; ?>').slidesjs({
                                                    pagination: {active: false},
                                                    navigation: {active: true},
                                                    width: 534,
                                                    height: 248
                                              });
                                        });
                                    </script>
                                </div>
                                <?php $k++;
                                endif;
                            endif; ?>
                    <?php the_content();?>
					<br /><?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','weblionmedia').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                </div>

                <div class="post-bottom clearfix">
                    <div class="post-tags"><?php the_tags('<span>Tags:</span> ', '', ''); ?> </div>
                    <?php
                    /* social sharing box */
                    if(isset($vcard_data['social_sharing_box'])) :
                        get_template_part('share','this-post');
                    endif;?>
                </div>

                <?php /* comments block */
                    if(isset($vcard_data['blog_comments'])) : ?>
                	<div class="post-comments"><?php comments_template('', true); ?></div>
                <?php endif; ?> 
            </div><!-- /.col535 -->
        <?php endif;?>

        <div class="col230 fl-right">
            <?php get_sidebar('blog_sidebar');?>
        </div><!-- /.col230 -->
    </div><!-- /.item-cont -->		<div class="item-border"><span></span></div>	
</section><!-- /#post -->
<?php get_footer();?>
