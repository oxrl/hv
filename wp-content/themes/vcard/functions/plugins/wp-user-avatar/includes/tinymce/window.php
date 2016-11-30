<?php
/**
 * @package WP User Avatar
 * @version 1.6.5
 */

if(!defined('ABSPATH')){
  die(__('You are not allowed to call this page directly.','vcard'));
  @header('Content-Type:'.get_option('html_type').';charset='.get_option('blog_charset'));
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php _e('WP User Avatar', 'wp-user-avatar'); ?></title>
  <meta http-equiv="Content-Type" content="<?php echo home_url(); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
  <base target="_self" />
  <script type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/jquery.js"></script>
  <script type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
  <script type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
  <script type="text/javascript">
    function wpuaInsertAvatar(){
      // Custom shortcode values
      var shortcode;
      var user = document.getElementById('wp_user_avatar_user').value;
      var size = document.getElementById('wp_user_avatar_size').value;
      var size_number = document.getElementById('wp_user_avatar_size_number').value;
      var align = document.getElementById('wp_user_avatar_align').value;
      var link = document.getElementById('wp_user_avatar_link').value;
      var link_external = document.getElementById('wp_user_avatar_link_external').value;
      var target = document.getElementById('wp_user_avatar_target').value;

      // Add tag to shortcode only if not blank
      var user_tag = (user != "") ? ' user="' + user + '"' : "";
      var size_tag = (size != "" && size_number == "") ? ' size="' + size + '"' : "";
      size_tag = (size_number != "") ? ' size="' + size_number + '"' : size_tag;
      var align_tag = (align != "") ? ' align="' + align + '"' : "";
      var link_tag = (link != "" && link != 'custom-url' && link_external == "") ? ' link="' + link + '"' : "";
      link_tag = (link_external != "") ? ' link="' + link_external + '"' : link_tag;
      var target_tag = document.getElementById('wp_user_avatar_target').checked && (link_tag != "") ? ' target="' + target + '"' : "";
 
      shortcode = "<p>[avatar" + user_tag + size_tag + align_tag + link_tag + target_tag + "]</p>";

      if(window.tinyMCE){
        window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.id, 'mceInsertContent', false, shortcode);
        tinyMCEPopup.editor.execCommand('mceRepaint');
        tinyMCEPopup.close();
      }
      return;
    }
    jQuery(function(){
      jQuery('#wp_user_avatar_link').change(function(){
        jQuery('#wp_user_avatar_link_external_section').toggle(jQuery('#wp_user_avatar_link').val() == 'custom-url');
      });
      jQuery('#wp_user_avatar_size').change(function(){
        jQuery('#wp_user_avatar_size_number_section').toggle(jQuery('#wp_user_avatar_size').val() == 'custom');
      });
    });
  </script>
  <style type="text/css">
    form { background: #fff; border: 1px solid #eee; }
    p, h4 { margin: 0; padding: 12px 0 0; }
    h4.center { text-align: center; }
    label { width: 150px; display: inline-block; text-align: right; }
    .mceActionPanel { padding: 7px 0 12px; text-align: center; }
    .mceActionPanel #insert { float: none; width: 180px; margin: 0 auto; }
    #wp_user_avatar_size_number_section, #wp_user_avatar_link_external_section { display: none; }
  </style>
</head>
<body id="link" class="wp-core-ui" onload="document.body.style.display="";" style="display:none;">
  <form name="wpUserAvatar" action="#">
    <p><label for="<?php esc_attr_e('wp_user_avatar_user'); ?>"><strong><?php _e('User Name','vcard'); ?>:</strong></label>
    <select id="<?php esc_attr_e('wp_user_avatar_user'); ?>" name="<?php esc_attr_e('wp_user_avatar_user'); ?>">
      <option value=""></option>
      <?php $users = get_users(); foreach($users as $user) : ?>
        <option value="<?php echo $user->user_login; ?>"><?php echo $user->display_name; ?></option>
      <?php endforeach; ?>
    </select></p>

    <p>
      <label for="<?php esc_attr_e('wp_user_avatar_size'); ?>"><strong><?php _e('Size','vcard'); ?>:</strong></label>
      <select id="<?php esc_attr_e('wp_user_avatar_size'); ?>" name="<?php esc_attr_e('wp_user_avatar_size'); ?>">
        <option value=""></option>
        <option value="original"><?php _e('Original Size','vcard'); ?></option>
        <option value="large"><?php _e('Large','vcard'); ?></option>
        <option value="medium"><?php _e('Medium','vcard'); ?></option>
        <option value="thumbnail"><?php _e('Thumbnail','vcard'); ?></option>
        <option value="custom"><?php _e('Custom','vcard'); ?></option>
      </select>
    </p>

    <p id="<?php esc_attr_e('wp_user_avatar_size_number_section'); ?>">
      <label for="<?php esc_attr_e('wp_user_avatar_size_number'); ?>"><?php _e('Size','vcard'); ?></label>
      <input type="text" size="8" id="<?php esc_attr_e('wp_user_avatar_size_number'); ?>" name="<?php esc_attr_e('wp_user_avatar_size'); ?>" value="" />
    </p>

    <p><label for="<?php esc_attr_e('wp_user_avatar_align'); ?>"><strong><?php _e('Alignment','vcard'); ?>:</strong></label>
    <select id="<?php esc_attr_e('wp_user_avatar_align'); ?>" name="<?php esc_attr_e('wp_user_avatar_align'); ?>">
      <option value=""></option>
      <option value="center"><?php _e('Center','vcard'); ?></option>
      <option value="left"><?php _e('Left','vcard'); ?></option>
      <option value="right"><?php _e('Right','vcard'); ?></option>
    </select></p>

    <p>
      <label for="<?php esc_attr_e('wp_user_avatar_link'); ?>"><strong><?php _e('Link To','vcard'); ?>:</strong></label>
      <select id="<?php esc_attr_e('wp_user_avatar_link'); ?>" name="<?php esc_attr_e('wp_user_avatar_link'); ?>">
        <option value=""></option>
        <option value="file"><?php _e('Image File','vcard'); ?></option>
        <option value="attachment"><?php _e('Attachment Page','vcard'); ?></option>
        <option value="custom-url"><?php _e('Custom URL','vcard'); ?></option>
      </select>
    </p>

    <p id="<?php esc_attr_e('wp_user_avatar_link_external_section'); ?>">
      <label for="<?php esc_attr_e('wp_user_avatar_link_external'); ?>"><?php _e('URL','vcard'); ?></label>
      <input type="text" size="36" id="<?php esc_attr_e('wp_user_avatar_link_external'); ?>" name="<?php esc_attr_e('wp_user_avatar_link_external'); ?>" value="" />
    </p>

    <p>
      <label for="<?php esc_attr_e('wp_user_avatar_target'); ?>"></label>
      <input type="checkbox" id="<?php esc_attr_e('wp_user_avatar_target'); ?>" name="<?php esc_attr_e('wp_user_avatar_target'); ?>" value="_blank" /> <strong><?php _e('Open link in a new window','vcard'); ?></strong>
    </p>

    <div class="mceActionPanel">
      <input type="submit" id="insert" class="button-primary" name="insert" value="<?php _e('Insert into Post','vcard'); ?>" onclick="wpuaInsertAvatar();" />
    </div>
  </form>
</body>
</html>
