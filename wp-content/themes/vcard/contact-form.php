<form action="" method="post" id="contact_form">
    <div class="clearfix">
        <div class="form-col form-marg small fl-left">
            <label><?php _e('Name','vcard'); ?><span>*</span></label>
            <input class="form-item" type="text" id="contact_name" name="contact_name"/>
        </div>
        <div class="form-col small fl-left">
            <label><?php _e('Email','vcard'); ?><span>*</span></label>
            <input class="form-item" type="email" name="email" id="email"/>
        </div>
    </div>
    <div class="form-col">
        <label><?php _e('Message','vcard'); ?><span>*</span></label>
        <textarea name="msg" id="comment" class="form-item"></textarea>
    </div>
    <div class="form-btn">
        <input class="btn" name="submit" type="submit" id="submit" value="<?php _e('send message','vcard'); ?>"/>
    </div>
</form>
<div id="messages">&nbsp;</div>
   