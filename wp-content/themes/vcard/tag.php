<?php get_header();?>
<section id="profile" class="item">
    <h2 class="item-title"><a href="<?php echo home_url();?>"><span class="title"><?php _e('home page','vcard'); ?></span> <span class="icon-user"></span></a></h2>
</section><!-- /#profile -->

<section id="blog" class="item">
    <h2 class="item-title"><a href="<?php echo $rm_blog_page_link; ?>"><span class="title"><?php _e('my blog posts','vcard'); ?></span> <span class="icon-blog"></span></a></h2>
    <div class="item-cont clearfix">

        <div class="col535 fl-left">
            <?php 
                global $vcard_data;
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
                $posts_per_page = $vcard_data['blog_posts_items_count'];
                query_posts(array('posts_per_page' => $posts_per_page, 'paged' => $paged, 'post_type' => array('portfolio','post'), 'tag' => get_query_var('tag') ));
            ?>
            <?php if(have_posts()):?>
                <?php while(have_posts()):the_post();
                    $post_format = get_post_meta($post->ID, 'vc_blog_post_format', true );
                        if($post_format == '')
                            $post_format = 'default';
                        $k = 1; 
                ?>
                    <article class="entry-box">
                        <header class="entry-header">
                            <h2 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            <div class="post-info">Posted by <?php the_author_posts_link();?> in <?php echo get_the_category_list( ', ', '', get_the_ID() );?></div>
                        </header>
                        <div class="entry-content">
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
                                                    while($i <= $vcard_data['posts_slideshow_number']):
                                                        
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
                                        $(function(){
                                              $('#slides<?php echo $k; ?>').slidesjs({
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
                            <div class="clearfix">
                                <div class="entry-data">
                                    <span class="month"><?php the_time('M');?></span>
                                    <span class="day"><?php the_time('d');?></span>
                                    <a href="<?php the_permalink();?>/#respond" class="comments-link"><i class="comments-icon"></i><?php comments_number( '0', '1', '%' ); ?></a>
                                </div>
                                <div class="entry-text">
                                    <div><?php the_excerpt();?></div>
                                </div>
                            </div>
                        </div>
                        <footer><a class="entry-more btn" href="<?php the_permalink();?>"><?php _e('Read More','vcard'); ?></a></footer>
                    </article>
                <?php endwhile;?>
            <?php endif;?>
            <div id="pageination" class="clearfix">
                <?php global $wp_query;
                    $total = $wp_query->found_posts; 
                    $page = isset( $_GET['page'] ) ? abs( (int) $_GET['page'] ) : 1;
                    $format = 'page/%#%/';
                    $current_page = max(1, $paged);
                    echo paginate_links( array(
                            'base' => add_query_arg( 'page', '%#%' ),
                            'format' => '?page=%#%',
                            'prev_next'    => false,
                            'type'         => 'list',
                            'total' => ceil($total / $posts_per_page),
                            'current' => $current_page
                    ));?>
            </div>
        </div><!-- /.col535 -->

        <div class="col230 fl-right">
            <?php get_sidebar();?>
        </div><!-- /.col230 -->

        <div class="item-border"></div>
    </div><!-- /.item-cont -->
</section><!-- /#post -->
<?php get_footer();?>
