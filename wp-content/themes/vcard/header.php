<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
      <script>
	      document.createElement('header');
	      document.createElement('nav');
	      document.createElement('section');
	      document.createElement('article');
	      document.createElement('aside');
	      document.createElement('footer');
        </script>
	<![endif]-->

    <?php 
		global $vcard_data; //, $rm_logo_class, $rm_skin_class, $bg_predefined_color, $primary_color, $bg_custom_color_option, $pred_color_arr;
		$favicon = (isset($vcard_data['favicon'])) ? $vcard_data['favicon'] : '';
		
		if ($favicon):
	 ?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	<?php else: ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/admin/assets/images/favicon.ico" />
	<?php endif; ?>
	
	<link href='http://fonts.googleapis.com/css?family=Patua+One|Montserrat|Open+Sans:400,700,600' rel='stylesheet' type='text/css' />
	
    <?php wp_head(); ?>
</head>
<body class="<?php echo rm_body_classes(); ?>">
    
    <div class="row-wrap wrapper">
        <div class="row-space">
        	
			<?php
				//the main menu navigation
				wp_nav_menu(array(
					'menu'              => '',
					'container'         => '',
					'container_class'   => '',
					'container_id'      => '',
					'menu_class'        => 'block_top_menu',
					'menu_id'           => 'main-menu',
					'echo'              => true,
					'fallback_cb'       => '',
					'before'            => '',
					'after'             => '',
					'link_before'       => '',
					'link_after'        => '',
					'depth'             => 0,
					'walker'            => '',
					'theme_location'    => 'main_navigation'
				));
			?>
			
            <header id="header" class="row noprint">
			
				<?php
					global $vcard_data;
					$logo_image = (isset($vcard_data['logo_image'])) ? $vcard_data['logo_image'] : '';
					$logo_text = (isset($vcard_data['logo_text'])) ? $vcard_data['logo_text'] : '';
					$logo_width = (isset($vcard_data['logo_width'])) ? $vcard_data['logo_width'] : '';
					$logo_height = (isset($vcard_data['logo_height'])) ? $vcard_data['logo_height'] : '';
				?>
                <?php if($logo_image): ?>
                <h1 class="head-name"><img width="<?php echo $logo_width; ?>" height="<?php echo $logo_height; ?>" src="<?php echo $logo_image; ?>"></h1>
                <?php elseif($logo_text): ?>
                    <h1 class="head-name"><?php echo $logo_text; ?></h1>
                <?php endif; ?>
                <?php global $vcard_data; ?>
                <?php if(isset($vcard_data['icons_header'])): ?>
                    <div class="head-social">
                        <ul>
                            <?php if ($twt =  $vcard_data['twitter_link']): ?>
                                <li class="tw"><a href="<?php echo $twt; ?>" target="_blank">Twitter</a></li>
                            <?php endif; ?>
                            <?php if ($fb =  $vcard_data['facebook_link']): ?>
                                <li class="fb"><a href="<?php echo $fb; ?>" target="_blank">Facebook</a></li>
                            <?php endif; ?>
                            <?php if ($lnk =  $vcard_data['linkedin_link']): ?>
                                <li class="lnkd"><a href="<?php echo $lnk; ?>" target="_blank">Linkedin</a></li>
                            <?php endif; ?>
                            <?php if ($google =  $vcard_data['google_link']): ?>
                                <li class="gplus"><a href="<?php echo $google; ?>" target="_blank">Google+</a></li>
                            <?php endif; ?>
                            <?php if ($dribble =  $vcard_data['dribbble_link']): ?>
                                <li class="drb"><a href="<?php echo $dribble; ?>" target="_blank">Dribble</a></li>
                            <?php endif; ?>
                            <?php if ($inst =  $vcard_data['instagaram_link']): ?>
                            <li class="inst"><a href="<?php echo $inst; ?>" target="_blank">Instagram</a></li>
                            <?php endif; ?>
                        </ul> 
                    </div>
                <?php endif; ?>
             </header>
