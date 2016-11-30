<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$functionof_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		if($of_pages_obj):
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");
		endif;
		
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();				

$of_options[] = array( "name" => "Header Options",
					"type" => "heading");

$of_options[] = array( "name" => "Text Logo",
					"desc" => "Type text here which will display at the top of your website",
					"id" => "logo_text",
					"std" => "Robert Smith",
					"type" => "text");
					
$of_options[] = array( "name" => "Color For Text Logo",
					"desc" => "Select the color for logo",
					"id" => "logo_color",
					"std" => "Light Logo",
					"type" => "select",
					"options" => array('light_logo' => 'Light Logo', 'dark_logo' => 'Dark Logo'));

$of_options[] = array( "name" => "Logo Image",
					"desc" => "Please choose an image file for your logo instead a text logo.",
					"id" => "logo_image",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Logo Width",
					"desc" => "If logo is uploaded, please enter logo width",
					"id" => "logo_width",
					"std" => "170",
					"type" => "text");

$of_options[] = array( "name" => "Logo Height",
					"desc" => "If logo is uploaded, please enter logo height",
					"id" => "logo_height",
					"std" => "35",
					"type" => "text");
					
$of_options[] = array( "name" => "Favicon",
					"desc" => "You can put URL of an ICO image that will represent your website's favicon (16px x 16px)",
					"id" => "favicon",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => "Display social icons on header of the page:",
					"desc" => "Select the checkbox to show social media icons on the header of the page.",
					"id" => "icons_header",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Background Options",
					"type" => "heading");

$of_options[] = array( "name" => "Background Image",
					"desc" => "Please choose an image or insert an image URL to use for the background.",
					"id" => "bg_image",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => "100% Background Image",
					"desc" => "Have background image always at 100% in width and height and scale according to the browser size.",
					"id" => "bg_full",
					"std" => "false",
					"type" => "checkbox");

$of_options[] = array( "name" => "Background Repeat",
					"desc" => "",
					"id" => "bg_repeat",
					"std" => "",
					"type" => "select",
					"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));
					
$of_options[] = array( "name" => "Skin For Body",
					"desc" => "Select the skin you want to use for body",
					"id" => "body_skin",
					"std" => "Light Skin",
					"type" => "select",
					"options" => array('light' => 'Light Skin', 'dark' => 'Dark Skin'));

$of_options[] = array( "name" => "Select a Predefined Background Color",
					"desc" => "",
					"id" => "bg_predefined_color",
					"std" => "f0f2f2",
					"type" => "images",
					"options" => array(
						"f0f2f2" => get_template_directory_uri()."/images/bg_color/1.png",
						"f1d2c2" => get_template_directory_uri()."/images/bg_color/2.png",
						"c2f1f1" => get_template_directory_uri()."/images/bg_color/3.png",
						"6fa5d6" => get_template_directory_uri()."/images/bg_color/4.png",
						"197bbf" => get_template_directory_uri()."/images/bg_color/5.png",
						"f1efc2" => get_template_directory_uri()."/images/bg_color/6.png",
						"e4ddce" => get_template_directory_uri()."/images/bg_color/7.png",
						"cc3300" => get_template_directory_uri()."/images/bg_color/8.png",
						"e52b50" => get_template_directory_uri()."/images/bg_color/9.png",
						"d66fa5" => get_template_directory_uri()."/images/bg_color/10.png",
						"ffbe34" => get_template_directory_uri()."/images/bg_color/11.png",
						"e36009" => get_template_directory_uri()."/images/bg_color/12.png",
						"6f4e37" => get_template_directory_uri()."/images/bg_color/13.png",
						"132c42" => get_template_directory_uri()."/images/bg_color/14.png",
					));

$of_options[] = array( "name" => "Custom Background Color?",
						"desc" => "If yes, select the color below:",
						"id" => "bg_custom_color_option",
						"std" => "false",
						"type" => "checkbox");
					
$of_options[] = array( "name" =>  "Background Color",
					"desc" => "Pick a background color.",
					"id" => "bg_color",
					"std" => "#d7d6d6",
					"type" => "color");

$of_options[] = array( "name" => "Background Pattern?",
					"desc" => "If yes, select the pattern from below:",
					"id" => "bg_pattern_option",
					"std" => "false",
					"type" => "checkbox");

$of_options[] = array( "name" => "Select a Background Pattern",
					"desc" => "",
					"id" => "bg_pattern",
					"std" => "bg1",
					"type" => "images",
					"options" => array(
						"bg1" => get_template_directory_uri()."/images/bg/bg1.jpg",
						"bg2" => get_template_directory_uri()."/images/bg/bg2.jpg",
						"bg3" => get_template_directory_uri()."/images/bg/bg3.jpg",
						"bg4" => get_template_directory_uri()."/images/bg/bg4.jpg",
						"bg5" => get_template_directory_uri()."/images/bg/bg5.jpg",
						"bg6" => get_template_directory_uri()."/images/bg/bg6.jpg",
						"bg7" => get_template_directory_uri()."/images/bg/bg7.jpg",
						"bg8" => get_template_directory_uri()."/images/bg/bg8.jpg",
						"bg9" => get_template_directory_uri()."/images/bg/bg9.jpg",
						"bg10" => get_template_directory_uri()."/images/bg/bg10.jpg",
						"bg11" => get_template_directory_uri()."/images/bg/bg11.jpg",
						"bg12" => get_template_directory_uri()."/images/bg/bg12.jpg"
					));
 
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");

$of_options[] = array( "name" => "Predefined Color Schemes",
					"desc" => "",
					"id" => "color_scheme",
					"std" => "Select Color Scheme",
					"type" => "select",
					"options" => array('' => 'Select Color Scheme', '#53b7f9' => 'Deep Sky Blue', '#ff3500' => 'Orange Red', '#35bb2e' => 'Green', '#ff6800' => 'Orange', '#197bbf' => 'Blue', '#c7df2e' => 'Yellow Green', '#704f36' => 'Brown', '#e35039' => 'Tomato', '#df5085' => 'Orchid', '#03ae91' => 'Sea Green', '#ea3302' => 'Red', '#27ccc0' => 'Medium Turquoise', '#976ad8' => 'Purple', '#f9c100' => 'Gold'));

$of_options[] = array( "name" => "Custom Color Scheme",
					"desc" => "",
					"id" => "custom_color_scheme_intro",
					"std" => "<h3 style='margin: 0;'>Create Custom Color Scheme</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" =>  "Primary Color",
					"desc" => "",
					"id" => "primary_color",
					"std" => "",
					"type" => "color");

$of_options[] = array( "name" =>  "Headings Font Color",
					"desc" => "",
					"id" => "headings_color",
					"std" => "",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Body Text Color",
					"desc" => "",
					"id" => "body_text_color",
					"std" => "",
					"type" => "color");

$of_options[] = array( "name" =>  "Link Color",
					"desc" => "",
					"id" => "link_color",
					"std" => "",
					"type" => "color");

/* Homepage Options */
$of_options[] = array( "name" => "Homepage Options",
					"type" => "heading");

$of_options[] = array( "name" => "Expand all sections",
					"desc" => "Expand all sections on the homepage.",
					"id" => "homepage_expand",
					"std" => "false",
					"type" => "checkbox");


$of_options[] = array( "name" => "Hide Resume Section",
					"desc" => "Check this option to hide the resume section from Home Page.",
					"id" => "homepage_resume",
					"std" => "false",
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Hide Portfolio Section",
					"desc" => "Check this option to hide the portfolio section from Home Page.",
					"id" => "homepage_portfolio",
					"std" => "false",
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Hide Contact Section",
					"desc" => "Check this option to hide the contact section from Home Page.",
					"id" => "homepage_contact",
					"std" => "false",
					"type" => "checkbox");


					
					
/* Blog Options */
$of_options[] = array( "name" => "Blog Options",
					"type" => "heading");

$of_options[] = array( "name" => "Blog Posts items count",
					"desc" => "",
					"id" => "blog_posts_items_count",
					"std" => "5",
					"type" => "text");

 $of_options[] = array( "name" => "Posts Images count",
                                        "desc" => "Number of images in posts/portfolio slideshow",
                                        "id" => "posts_slideshow_number",
                                        "std" => "5",
                                        "type" => "text");

$of_options[] = array( "name" => "Social Sharing Box",
					"desc" => "Show the social sharing box.",
					"id" => "social_sharing_box",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Comments",
					"desc" => "Show comments.",
					"id" => "blog_comments",
					"std" => "true",
					"type" => "checkbox");
					
$of_options[] = array( "name" => "HomePage Link",
					"desc" => "Select the checkbox if you want to include the link to home page.",
					"id" => "profile_link_enable",
					"std" => "true",
					"type" => "checkbox");


$of_options[] = array( "name" => "Resume Options",
					"type" => "heading");

$of_options[] = array( "name" => "Download Resume",
					"desc" => "Show download resume button",
					"id" => "show_download_btn",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Print Resume",
					"desc" => "Show print resume button",
					"id" => "show_print_btn",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Upload Resume",
					"desc" => "Upload your resume here",
					"id" => "upload_download_btn",
					"std" => "",
					"type" => "upload");


					
/*$of_options[] = array( "name" => "Portfolio Options",
					"type" => "heading");

$of_options[] = array( "name" => "Number of Portfolio Items",
					"desc" => "",
					"id" => "portfolio_items",
					"std" => "10",
					"type" => "text");
*/
					
/* Profile Options */
$of_options[] = array( "name" => "Profile Options",
					"type" => "heading");

$of_options[] = array( "name" => "Your Photo",
					"desc" => "Upload your profile photo image",
					"id" => "avatar_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Profile Title",
					"desc" => "Enter a title for your profile",
					"id" => "title_profile",
					"std" => "I'm Belgium developer and businessman",
					"type" => "text");

$of_options[] = array( "name" => "Description",
					"desc" => "Enter description for your profile",
					"id" => "description_profile",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Name",
					"desc" => "",
					"id" => "name_profile",
					"std" => "Robert Smith",
					"type" => "text");

$of_options[] = array( "name" => "Age",
					"desc" => "",
					"id" => "age_profile",
					"std" => "29",
					"type" => "text");

$of_options[] = array( "name" => "Freelance",
					"desc" => "Select the checkbox if you want your freelance status to be available",
					"id" => "freelance_profile",
					"std" => "true",
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Blog Link",
					"desc" => "Select the checkbox if you want to include the link to your Blog post from your Profile.",
					"id" => "blog_link_enable",
					"std" => "true",
					"type" => "checkbox");
					

$of_options[] = array( "name" => "Social Sharing Box",
					"type" => "heading");

$of_options[] = array( "name" => "Facebook",
					"desc" => "Show the facebook sharing option in blog posts.",
					"id" => "sharing_facebook",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Twitter",
					"desc" => "Show the twitter sharing option in blog posts.",
					"id" => "sharing_twitter",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Pinterest",
					"desc" => "Show the pinterest sharing option in blog posts.",
					"id" => "sharing_pinterest",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "LinkedIn",
					"desc" => "Show the linkedin sharing option in blog posts.",
					"id" => "sharing_linkedin",
					"std" => "true",
					"type" => "checkbox");



$of_options[] = array( "name" => "Header Social Links",
					"type" => "heading");
					
$of_options[] = array( "name" => "Facebook",
					"desc" => "Place the link you want and facebook icon will appear. To remove it, just leave it blank.",
					"id" => "facebook_link",
					"std" => "https://www.facebook.com/",
					"type" => "text"); 

$of_options[] = array( "name" => "Twitter",
					"desc" => "Place the link you want and twitter icon will appear. To remove it, just leave it blank.",
					"id" => "twitter_link",
					"std" => "https://twitter.com/",
					"type" => "text");

$of_options[] = array( "name" => "Google Plus",
					"desc" => "Place the link you want and g+ icon will appear. To remove it, just leave it blank.",
					"id" => "google_link",
					"std" => "https://plus.google.com/",
					"type" => "text");


$of_options[] = array( "name" => "Dribbble",
					"desc" => "Place the link you want and dribbble icon will appear. To remove it, just leave it blank.",
					"id" => "dribbble_link",
					"std" => "http://dribbble.com/",
					"type" => "text");

$of_options[] = array( "name" => "LinkedIn",
					"desc" => "Place the link you want and linkedin icon will appear. To remove it, just leave it blank.",
					"id" => "linkedin_link",
					"std" => "https://www.linkedin.com/",
					"type" => "text");

$of_options[] = array( "name" => "Instagarm",
					"desc" => "Place the link you want and instagram icon will appear. To remove it, just leave it blank.",
					"id" => "instagaram_link",
					"std" => "http://instagram.com/",
					"type" => "text");
// Theme Specific Options
$of_options[] = array( "name" => "Contact Options",
					"type" => "heading");

$of_options[] = array( "name" => "Display Google Map",
					"desc" => "Select the checkbox if you want to display map",
					"id" => "gmap_show",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Google Map Latitude",
					"desc" => "",
					"id" => "gmap_lat",
					"std" => "50.850340",
					"type" => "text");

$of_options[] = array( "name" => "Google Map Longitude",
					"desc" => "",
					"id" => "gmap_lng",
					"std" => "4.351710",
					"type" => "text");

$of_options[] = array( "name" => "Contact Details",
					"desc" => "Select the checkbox if you want to display contact options",
					"id" => "contact_details",
					"std" => "true",
					"type" => "checkbox");

$of_options[] = array( "name" => "Contact Address",
					"desc" => "",
					"id" => "contact_address",
					"std" => "Belgium, Brussels, Liutte 27, BE",
					"type" => "text");

$of_options[] = array( "name" => "Contact Phone",
					"desc" => "",
					"id" => "contact_phone",
					"std" => "+1 256 254 84 56",
					"type" => "text");

$of_options[] = array( "name" => "Email Address",
					"desc" => "",
					"id" => "email_address",
					"std" => "robertsmith@company.com",
					"type" => "text");

$of_options[] = array( "name" => "Website",
					"desc" => "",
					"id" => "contact_website",
					"std" => "http://yourwebsite.com",
					"type" => "text");

// Footer Specific Options
$of_options[] = array( "name" => "Footer Options",
					"type" => "heading");

$of_options[] = array( "name" => "Copyright Info",
					"desc" => "Enter the copyright info.",
					"id" => "copyright_info",
					"std" => "",
					"type" => "textarea");
					
					
// Custom CSS Options
$of_options[] = array( "name" => "Custom CSS",
					"type" => "heading");

$of_options[] = array( "name" => "Custom CSS",
					"desc" => "",
					"id" => "custom_css",
					"std" => "",
					"type" => "textarea");

					
	}
}
?>