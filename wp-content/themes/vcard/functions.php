<?php
$rm_themename = "vCard";
$rm_shortname = "rm";
$rm_themeversion = "1.1";

if ( ! isset( $content_width ) ) $content_width = 862;

/** Tell WordPress to run rm_theme_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'rm_theme_setup' );
function rm_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_editor_style();
	//add_theme_support( 'custom-header' );
	//add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );

	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'vcard', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/".$locale.".php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );	


	add_theme_support('nav-menus');
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(array( 'main_navigation' => 'Main Navigation'));
		register_nav_menus(array( 'footer_navigation' => 'Footer Navigation'));
	}
	
	/////////////////////////////////////Add image size//////////////////////////////////////////
	add_theme_support('post-thumbnails');
	update_option('thumbnail_size_w', 50);
	update_option('thumbnail_size_h', 58);

	update_option('medium_size_w', 175);
	update_option('medium_size_h', 118);

	add_image_size('post_size', 534, 249, true);
	add_image_size('portfolio_size', 250, 180, true);
	add_image_size('portfolio_fancy_size', 793, 530, true);	
}

function rm_body_classes(){
	global $vcard_data;
	$gmap_show = (isset($vcard_data['gmap_show'])) ? $vcard_data['gmap_show'] : '';
	$gmap_lat = (isset($vcard_data['gmap_lat'])) ? $vcard_data['gmap_lat'] : '';
	$gmap_lng = (isset($vcard_data['gmap_lng'])) ? $vcard_data['gmap_lng'] : '';
	$pred_color_arr = array("#53b7f9","#ff3500","#35bb2e","#ff6800","#197bbf","#c7df2e","#704f36","#e35039","#df5085","#03ae91","#ea3302","#27ccc0","#976ad8","#f9c100");
	$body_skin = (isset($vcard_data['body_skin'])) ? $vcard_data['body_skin'] : '';
	if($body_skin):
	if($body_skin == "Light Skin"):
		$skin_class = "light_skin";
	elseif($body_skin == "Dark Skin"):
		$skin_class = "dark_skin";
	endif;
	else:
		$skin_class = "light_skin";
	endif;

	$logo_color = (isset($vcard_data['logo_color'])) ? $vcard_data['logo_color'] : '';
	if($logo_color):
	if($logo_color == "Light Logo"):
		$logo_class = "logo_light";
	elseif($logo_color == "Dark Logo"):
		$logo_class = "logo_dark";
	endif;
	else:
		$logo_class = "logo_light";
	endif;

	$vcard_data['bg_predefined_color'];
	$bg_predefined_color = (isset($vcard_data['bg_predefined_color'])) ? $vcard_data['bg_predefined_color'] : '';
	$bg_custom_color_option = (isset($vcard_data['bg_custom_color_option'])) ? $vcard_data['bg_custom_color_option'] : '';
	$primary_color = (isset($vcard_data['primary_color']) && (strlen($vcard_data['primary_color']) > 0)) ? $vcard_data['primary_color'] : '#53b7f9';	
	
	$bg_pattern_option = (isset($vcard_data['bg_pattern_option'])) ? $vcard_data['bg_pattern_option'] : '';
	$bg_pattern = (isset($vcard_data['bg_pattern'])) ? $vcard_data['bg_pattern'] : '';
  
	$class_output = '';
	$class_output = $skin_class." ".$logo_class; 
	if(array_search($primary_color, $pred_color_arr)): $color_class = str_replace("#", "", $primary_color); 
		$class_output .= ' color_'.$color_class; 
	elseif($primary_color): 
		$class_output .= ' color_custom';
	endif;
	if (!$bg_custom_color_option and $bg_predefined_color and ($bg_pattern_option != 1)):
		$class_output .= ' bg_'.$bg_predefined_color;
	endif;
	return $class_output;
}


function rm_admin_enqueue_script() {
	//wp_enqueue_script("admin_script", get_template_directory_uri()."/functions/js/metaboxes.js");
}
add_action( 'admin_enqueue_scripts', 'rm_admin_enqueue_script' );

function rm_enqueue_style() {
	//Enqueue custom web fonts	
	
	wp_enqueue_style('css_fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox.css', false, '2.1.5', 'all');
	wp_enqueue_style('css_mediaelement', get_template_directory_uri().'/js/mediaelement/mediaelementplayer.css', false, '1', 'all');
	wp_enqueue_style('css_skin_style', get_template_directory_uri().'/css/skin_style.css', false, '1', 'all');	
	//wp_enqueue_style('css_print_style', get_template_directory_uri().'/css/style-print.css', false, '1', 'all');
	wp_enqueue_style('stylesheet', get_stylesheet_uri(), false, '1', 'all');
	wp_enqueue_style('css_color_cheme', get_template_directory_uri().'/css/color_cheme.css', false, '1', 'all');
	wp_enqueue_style('css_responsive', get_template_directory_uri().'/css/responsive.css', false, '1', 'all');	
	
	//Enqueue custom css styles
	wp_enqueue_style('css_custom_file', get_template_directory_uri().'/functions/custom-css-main.php', false, '1.0.0', 'screen');
}
function rm_enqueue_script() {
    wp_enqueue_script( 'jquery' );
	
	// Comment Script
	if(is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script( 'comment-reply' );
	}
	
    wp_enqueue_script( 'detect_mobilebrowser', get_template_directory_uri().'/js/detect_mobilebrowser_and_ipad.js',false,'1.0',true);
    wp_enqueue_script( 'jquery_easing', get_template_directory_uri().'/js/jquery.easing.1.3.js',false,'1.0',true);
    wp_enqueue_script( 'jquery_mixitup', get_template_directory_uri().'/js/jquery.mixitup.min.js', false,'1.0',true);
    wp_enqueue_script( 'jquery_mousewheel', get_template_directory_uri().'/js/fancybox/jquery.mousewheel-3.0.6.pack.js',false,'1.0',true);
    wp_enqueue_script( 'jquery_fancybox_pack', get_template_directory_uri().'/js/fancybox/jquery.fancybox.pack.js?v=2.1.5',false,'1.0',true );
    wp_enqueue_script( 'jquery_fullscreen', get_template_directory_uri().'/js/fancybox/jquery.fullscreen.js',false,'1.0',true );
    wp_enqueue_script( 'jquery_slides', get_template_directory_uri().'/js/jquery.slides.min.js', false,'1.0',true);
    wp_enqueue_script( 'mediaelement', get_template_directory_uri().'/js/mediaelement/mediaelement-and-player.min.js',false,'1.0',true);
    wp_enqueue_script( 'jquery.cookies.min', get_template_directory_uri().'/js/jquery.cookies.min.js',false,'1.0',true);
    wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js',false,'1.0',true );
	wp_localize_script('main', 'MyAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	wp_enqueue_script('main');
}
add_action( 'wp_enqueue_scripts', 'rm_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'rm_enqueue_script' );


///////////////////////////////////// Title/////////////////////////////////////
function vcard_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'vcard' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'vcard_wp_title', 10, 2 );

///////////////////////////////////// Load js libraries///////////////////////////////////// 



///////////////////////////////////// Register sidebars///////////////////////////////////// 

register_sidebar(array(
        'name'          => __( 'Sidebar For Blog', 'theme_text_domain' ),
        'id'            => 'blog_sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
));

register_sidebar(array(
        'name'          => __( 'Skills sidebar', 'theme_text_domain' ),
        'id'            => 'skills_sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<aside class="skill-box">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
));

///////////////////////////////////// Require important options///////////////////////////////

require_once('admin/index.php');
// Metaboxes
include_once('functions/metaboxes.php');
// Shortcodes
include_once('functions/shortcodes.php');
// widgets
include_once('functions/widgets.php');



///////////////////////////////////// Multiple featured images////////////////////////////////
global $vcard_data;
if( class_exists( 'kdMultipleFeaturedImages' ) ) {
		$i = 2;

		$posts_slideshow_number = (isset($vcard_data['posts_slideshow_number'])) ? $vcard_data['posts_slideshow_number'] : 1;
		while($i <= $posts_slideshow_number) {
	        $args = array(
	                'id' => 'featured-image-'.$i,
	                'post_type' => 'post',      // Set this to post or page
	                'labels' => array(
                        'name'      => 'Featured image '.$i,
                        'set'       => 'Set featured image '.$i,
                        'remove'    => 'Remove featured image '.$i,
                        'use'       => 'Use as featured image '.$i,
	                )
	        );

	        new kdMultipleFeaturedImages( $args );

	        $i++;
    	}

}

require_once dirname( __FILE__ ) . '/functions/class-tgm-plugin-activation.php';
if( ! defined('THEMENAME' ) ) 	 { 	define( 'THEMENAME', 'vcard' ); }

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
	$plugins = array(
		
		array(
			'name'     				=> 'Multiple Featured Images', // The plugin name
			'slug'     				=> 'multiple-featured-images', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/multiple-featured-images.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'                      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'                    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'                          => '', // If set, overrides default API URL and points to an external URL
		),
            
            
		array(
			'name'     				=> 'Custom Avatar', // The plugin name
			'slug'     				=> 'wp-user-avatar', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/wp-user-avatar.1.6.5.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'                      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'                    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'                          => '', // If set, overrides default API URL and points to an external URL
		),
		
	);

	$theme_text_domain = 'vcard';
	
	$config = array(
                        'domain'                        => THEMENAME,         	// Text domain - likely want to be the same as your theme.
                        'default_path'                  => '',                         	// Default absolute path to pre-packaged plugins
                        'parent_menu_slug'              => 'themes.php', 				// Default parent menu slug
                        'parent_url_slug'               => 'themes.php', 				// Default parent URL slug
                        'menu'                          => 'install-required-plugins', 	// Menu slug
                        'has_notices'                   => true,                       	// Show admin notices or not
                        'is_automatic'                  => false,					   	// Automatically activate plugins after installation or not
                        'message' 			=> '',							// Message to output right before the plugins table
                        'strings'                       => array(
			'page_title'                       	=> __( 'Install Required Plugins', THEMENAME ),
			'menu_title'                       	=> __( 'Install Plugins', THEMENAME ),
			'installing'                       	=> __( 'Installing Plugin: %s', THEMENAME ), // %1$s = plugin name
			'oops'                             	=> __( 'Something went wrong with the plugin API.', THEMENAME ),
			'notice_can_install_required'     	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 			=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 				=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           	=> __( 'Return to Required Plugins Installer', THEMENAME ),
			'plugin_activated'                 	=> __( 'Plugin activated successfully.', THEMENAME ),
			'complete' 				=> __( 'All plugins installed and activated successfully. %s', THEMENAME ), // %1$s = dashboard link
			'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
                                     )
                        );

	tgmpa( $plugins, $config );

}

///////////////////////////////////// Comments/////////////////////////////////////


function vcard_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>

	<li>
		<div class="comment" id="comment-<?php comment_ID() ?>">

            <div class="comment-photo">
                <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 50 ); ?>                        
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','vcard') ?></em><br />
            <?php endif; ?>
            <div class="comment-cont">
                <div class="comment-head">
                    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    <?php printf(__('<h3>%s</h3>','vcard'), get_comment_author_link()) ?>
                    <div><?php printf( __('%1$s at %2$s ','vcard'), get_comment_date(),  get_comment_time()) ?></div>
                </div>
                <?php comment_text(); ?>
            </div>
        </div>
<?php }

///////////////////////////////////// Register custom post type/////////////////////////////////////

add_action('init', 'bb_init');
function bb_init() {
        register_post_type(
		'portfolio',
		array(
			'labels' => array(
                        'name' => 'Portfolio',
                        'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio'),
			'supports' => array('title', 'editor', 'thumbnail'),
                        'taxonomies' => array('post_tag'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
        
        register_post_type(
		'employment',
		array(
			'labels' => array(
                        'name' => 'Employment',
                        'singular_name' => 'Employment'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'employment'),
			'supports' => array('title', 'editor'),
			'can_export' => true,
		)
	);
	register_taxonomy('employment_category', 'employment', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
}

///////////////////////////////////// shortcode to text widget/////////////////////////////////////

add_filter('widget_text', 'do_shortcode');

///////////////////////////////////// contact form/////////////////////////////////////

if(is_admin()){
add_action('wp_ajax_send_email', 'send_email');
add_action('wp_ajax_nopriv_send_email', 'send_email');
}

function send_email(){

	global $vcard_data;
	$hasError = false;
	if(trim($_POST['contact_name']) == '') {
		$response['errors'][] = 'contact_name';
		$hasError = true;
	} else {
		$name = trim($_POST['contact_name']);		
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$response['errors'][] = 'email';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$response['errors'][] = 'email';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Subject field is not required
	$subject = trim($_POST['contact_name']);

	//Check to make sure comments were entered
	if(trim($_POST['msg']) == '') {
		$response['errors'][] = 'comment';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['msg']));
		} else {
			$comments = trim($_POST['msg']);
		}
	}
	if($hasError == false) {
		$emailTo = $vcard_data['email_address']; //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: '.$_POST['contact_name'].' <'.$_POST['email'].'>' . "\r\n";

		$mail = wp_mail($emailTo, $subject, $body, $headers);
	}
	$response['has_error'] = $hasError;
	echo json_encode($response);
	exit;
}
	
// Add specific CSS class by filter
add_filter('body_class','my_body_class_class_names');
function my_body_class_class_names($classes) {
	// add 'class-name' to the $classes array
	unset($classes);
	$classes[] = 'custom-background';

	// return the $classes array
	return $classes;
}
	
	$blog_page_id = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value='page-blog.php'");
	$rm_blog_page_link = get_permalink($blog_page_id);
	global $rm_blog_page_link;
?>