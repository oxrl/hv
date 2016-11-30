<?php	
	header("Content-type: text/css");
	$wp_load_include = "../wp-load.php";
	$i = 0;
	while (!file_exists($wp_load_include) && $i++ < 9) {
		$wp_load_include = "../$wp_load_include";
	}

	//required to include wordpress file
	require($wp_load_include);
	
	global $vcard_data;

	$primary_color = (isset($vcard_data['primary_color']) && (strlen($vcard_data['primary_color']) > 0)) ? $vcard_data['primary_color'] : '#53b7f9';	
?>
.theme_custom .block_header_info .phone p span, .theme_custom .alt_header_2 .block_header_info_2 .phone p span, .theme_custom .main_menu > ul > li.current_page_item > a,.theme_custom .main_menu > ul > li.current_page_parent > a, .theme_custom .main_menu > ul > li:hover > a, .theme_custom .main_menu ul ul li:hover > a, .theme_custom .main_menu ul ul li.current_page_item > a, .theme_custom .block_404 h2 span, .theme_custom .block_our_team_1 article h4 a:hover, .theme_custom .block_our_team_2 article h4 a:hover, .theme_custom .block_accordion_type_3 .button_outer.current .button_inner, .theme_custom .block_accordion_type_4 .button_outer.current .button_inner, .theme_custom .widget_categories li a:hover, .theme_custom .block_sidebar_popular_posts article .content h5 a:hover, .theme_custom .block_sidebar_tags li a:hover, .theme_custom .block_blog_1 .content h3 a:hover, .theme_custom .block_blog_2 .content h3 a:hover, .theme_custom .block_blog_3 .content h3 a:hover, .theme_custom .block_blog_4 .content h3 a:hover, .theme_custom .block_blog_4 .content .lnk a, .theme_custom .block_blog_2 .info div a:hover, .theme_custom .block_blog_3 .info div a:hover, .theme_custom .block_blog_post_tags li a:hover, .theme_custom .block_related_posts article h4 a:hover, .theme_custom .block_comments .comment h4 a:hover, .theme_custom .block_leave_comments .label span, .theme_custom .block_blog_post_2 .info div a:hover, .theme_custom .block_blog_post_3 .info div a:hover, .theme_custom .block_contact_1 p a, .theme_custom .block_contact_1 .label span, .theme_custom .block_contact_2 p a, .theme_custom .block_contact_2 .label span, .theme_custom .block_faq_1 .contents li a:hover, .theme_custom .block_pagination_1 .pages li.current a, .theme_custom .block_home_slider_1 .caption.type_2_1 h4, .theme_custom .blackbird_black_small_bold_animate_text, .theme_custom .block_home_slider_2 .text_3_2, .theme_custom .block_home_slider_3 .slider .caption .num, .theme_custom .block_home_slider_5 .text_1_1 h4, .theme_custom .block_home_slider_5 .text_3_1 h4, .theme_custom .block_slogan_1 h1 span, .theme_custom .block_services_5 article .lnk a, .theme_custom .block_services_10 article .lnk a, .theme_custom .block_services_12 article .lnk a, .theme_custom .block_related_projects .content h3 a:hover, .theme_custom .block_recent_projects_1 .content h3 a:hover, .theme_custom .block_recent_projects_2 .content h3 a:hover, .theme_custom .block_recent_news_1 article h4 a:hover, .theme_custom .block_recent_news_1 article .lnk a, .theme_custom .block_recent_news_2 article h4 a:hover, .theme_custom .block_recent_news_2 article .lnk a, .theme_custom .block_recent_news_3 article h4 a:hover, .theme_custom .block_recent_news_3 article p a, .theme_custom .block_recent_posts_1 .lnk_more a, .theme_custom .block_latest_posts_1 h4 a:hover, .theme_custom .block_about_3 p a, .theme_custom .block_testimonials_1 .author p a:hover, .theme_custom .block_portfolio_1.c_1 .content h3 a:hover, .theme_custom .block_portfolio_1.c_2 .content h3 a:hover, .theme_custom .block_portfolio_1.c_3 .content h3 a:hover, .theme_custom .block_portfolio_1.c_4 .content h3 a:hover, .theme_custom .block_portfolio_2 h3 a:hover, .theme_custom .block_portfolio_item_1 .details li a:hover, .theme_custom .block_portfolio_item_2 .details li a:hover, .theme_custom .block_pricing_table_5 .special .content h4, .theme_custom .block_pricing_table_5 .special .price .num, .theme_custom .block_pricing_table_7 .lnk a, .theme_custom .block_process_2 .intro .lnk a, .theme_custom .block_tabs_type_3 .tabs li a.current, .theme_custom .general_read_more:hover, .theme_custom .general_tooltip, .theme_custom .list_6 li a:hover, .theme_custom .block_footer_recent_posts article h4 a:hover, .theme_custom .alt_footer_1 .block_footer_contact_info p b span, .theme_custom .alt_footer_1 .footer_main_menu li a:hover, .theme_custom .alt_footer_1 .block_footer_tags li a:hover, .theme_custom .alt_footer_3 .block_footer_contact_form .label span, .theme_custom .alt_footer_3 .block_footer_recent_posts article h4 a:hover {color: <?php echo $primary_color; ?>}

.theme_custom .line_header, .theme_custom .line_header_2, .theme_custom .pic.w_animated_caption .caption_1_1, .theme_custom .pic.w_animated_caption .caption_2_1, .theme_custom .pic.w_animated_caption .caption_3_1, .theme_custom .block_levels.type_1 .progress div, .theme_custom .block_levels.type_2 .progress div, .theme_custom .block_slider_about_1 .caption.type_1, .theme_custom .block_blog_1 .info .icon, .theme_custom .block_blog_2 .f_content .icon, .theme_custom .block_blog_3 .f_content .icon, .theme_custom .block_blog_4 .f_content .icon, .theme_custom .block_blog_post_1 .info .icon, .theme_custom .block_blog_1 div.slider .flex-direction-nav a, .theme_custom .block_blog_2 div.slider .flex-direction-nav a, .theme_custom .block_blog_3 div.slider .flex-direction-nav a, .theme_custom .block_blog_4 .slider .flex-direction-nav a:hover, .theme_custom .block_blog_post_2 div.slider .flex-direction-nav a, .theme_custom .block_audio .mejs-controls .mejs-time-rail .mejs-time-current, .theme_custom .block_audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, .theme_custom .block_home_slider_1 .tparrows, .theme_custom .block_home_slider_1 .tp-caption span, .theme_custom .blackbird_white_text_animate_background, .theme_custom .tparrows:hover, .theme_custom .block_home_slider_3 .slider .flex-direction-nav a:hover, .theme_custom .block_home_slider_4 .flex-direction-nav a:hover, .theme_custom .block_home_slider_4 .flex-control-nav li a.flex-active, .theme_custom .block_home_slider_6 .info .buttons .arrows:hover, .theme_custom .block_home_slider_8 .flex-direction-nav a:hover, .theme_custom .block_home_slider_10 .tparrows, .theme_custom .block_home_slider_11 .tparrows, .theme_custom .block_home_slider_12 .tparrows, .theme_custom .block_home_slider_12 .caption.type_1_2 span, .theme_custom .block_recent_projects_2.type_slider .flex-direction-nav li a:hover, .theme_custom .block_related_projects.type_slider_2 .flex-direction-nav li a:hover, .theme_custom .block_services_11 article .lnk, .theme_custom .block_filter_1 .line, .theme_custom .block_portfolio_2 .image .hover a:hover, .theme_custom .the_ins_1 {background-color: <?php echo $primary_color; ?>}

.theme_custom .tp-button{
	background-color:<?php echo $primary_color; ?> !important;
	border:1px solid <?php echo $primary_color; ?> !important;
	background: <?php echo $primary_color; ?> !important;
	color:#ffffff;
	text-shadow:0px -1px rgba(0, 0, 0, 0.27);
}


<?php
  $bg_image = (isset($vcard_data['bg_image'])) ? $vcard_data['bg_image'] : '';
  $bg_repeat = (isset($vcard_data['bg_repeat'])) ? $vcard_data['bg_repeat'] : '';
  $bg_full = (isset($vcard_data['bg_full'])) ? $vcard_data['bg_full'] : '';
  $bg_color = (isset($vcard_data['bg_color'])) ? $vcard_data['bg_color'] : '';
  $bg_pattern_option = (isset($vcard_data['bg_pattern_option'])) ? $vcard_data['bg_pattern_option'] : '';
  $bg_pattern = (isset($vcard_data['bg_pattern'])) ? $vcard_data['bg_pattern'] : '';
  $body_text_color = (isset($vcard_data['body_text_color'])) ? $vcard_data['body_text_color'] : '';
  $headings_color = (isset($vcard_data['headings_color'])) ? $vcard_data['headings_color'] : '';
  $link_color = (isset($vcard_data['link_color'])) ? $vcard_data['link_color'] : '';
  $bg_predefined_color = (isset($vcard_data['bg_predefined_color'])) ? $vcard_data['bg_predefined_color'] : '';
  $bg_custom_color_option = (isset($vcard_data['bg_custom_color_option'])) ? $vcard_data['bg_custom_color_option'] : '';
  $logo_color = (isset($vcard_data['logo_color'])) ? $vcard_data['logo_color'] : '';
  $body_skin = (isset($vcard_data['body_skin'])) ? $vcard_data['body_skin'] : '';

  if($bg_image) :
?>

	body {
		background-image: url("<?php echo $bg_image; ?>") !important;
		background-position: center center !important;
		background-repeat: <?php echo $bg_repeat; ?> !important;				
		background-color:<?php echo $bg_color; ?>;
		<?php if($bg_full): ?>
		background-size: 100% 100%;
		<?php endif; ?>
	}
<?php elseif (($bg_pattern_option == 1) and (strlen($bg_pattern)>0)) : ?>
	body {
		background: url('<?php echo get_template_directory_uri(); ?>/images/bg/<?php echo $bg_pattern; ?>.jpg') repeat center center;
	}
<?php elseif($bg_custom_color_option and $bg_color): ?>
	body,.item-border span{background:<?php echo $bg_color; ?>;}
<?php endif; ?>

<?php if($primary_color): ?>
	/* styles for color */
	.color_custom .item-title [class^="icon-"],
	.color_custom .profile-data h4 ,
	.color_custom .icon-plus,
	.color_custom .skill-data .skill-percent-line,
	.color_custom .btn:hover,
	.color_custom .mejs-controls .mejs-time-rail .mejs-time-current{background-color:<?php echo $primary_color; ?>;}

	.color_custom .resume-post-body,
	.color_custom .controls li.active,
	.color_custom .profile-data h4,
	.color_custom  .form-item:focus {border-color:<?php echo $primary_color; ?>;}

	.color_custom .controls li.active,
	.color_custom .post-title a:hover,
	.color_custom  #sidebar .widget ul li a:hover{color:<?php echo $primary_color; ?>;}
	.color_custom .skill-box h3{background-position:right 5px;}
	.color_custom .post-share .share-tw:hover{background-position:0 -28px;}
	.color_custom .post-share .share-fb:hover{background-position:-29px -28px;}
	.color_custom .post-share .share-p:hover{background-position:-58px -28px;}
	.color_custom .post-share .share-in:hover{background-position:-87px -28px;}
	.color_custom .wp-cont blockquote{background-image:url('../images/color_theme/quote/53b7f9.png');}
	.color_custom .wp-cont ul li{background-image:url('../images/color_theme/check/53b7f9.png');}
	.light_skin.color_custom #skill-language .skill-data{background-image:url(../images/color_theme/skills/53b7f9.png);}
	.dark_skin.color_custom  #skill-language .skill-data{background-image:url(../images/color_theme/skills/53b7f9-dark.png);}
	.block_top_menu li.current_page_item a, .block_top_menu li a:hover {border-bottom:2px solid <?php echo $primary_color; ?>;}
<?php endif; ?>
<?php if($body_text_color): ?>
	body, .entry-text, #sidebar .widget ul li, #sidebar .widget .post-date, .wp-cont p, .comment-head div, .form label, .post-info, .skill-percent, .skill-title, .resume-post-date, .resume-post-subtitle, .contact-info span {
		color: <?php echo $body_text_color; ?> !important;
	}
<?php endif; ?>
<?php if($headings_color): ?>
	.profile-info h3, .item-title .title, #contact h3, .form h3, .skill-box h3, .post-title, .post-title a, #sidebar .widget h2, .post-bottom {
		color: <?php echo $headings_color; ?>;
	}
<?php endif; ?>
<?php if($link_color): ?>
	#sidebar .widget ul li a,.post-info span, .post-info a{
		color: <?php echo $link_color; ?>;
	}
<?php endif; ?>

<?php 
/*get custom css*/
$custom_css = (isset($vcard_data['custom_css'])) ? $vcard_data['custom_css'] : '';
echo $custom_css;
?>