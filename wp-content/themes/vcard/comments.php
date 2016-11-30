<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','vcard'));

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'vcard'); ?></p>
	<?php
		return;
	}
?>
	
<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

            <h2 class="post-title"><?php comments_number(__('0 comments', 'vcard'), __('1 comment', 'vcard'), __('% comments', 'vcard'));?></h2>

			<!-- comments-list -->
			<ul class="comments-list">
                <?php wp_list_comments( array( 'callback' => 'vcard_comment' ) ); ?>
			</ul>

            <div class="comments-navigation">
                <div class="alignleft"><?php previous_comments_link(); ?></div>
                <div class="alignright"><?php next_comments_link(); ?></div>
            </div>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="no-comments"><?php echo __('Comments are closed.', 'vcard'); ?></p>

	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond" class="section block_leave_comments form<?php if ( !have_comments() ) : ?> no_comments<?php endif;?>">
	<h3><?php comment_form_title(__("Let's keep in touch", 'vcard'), __("Let's keep in touch", 'vcard')); ?></h3>
            <?php cancel_comment_reply_link('cancel reply'); ?>
            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
            <p><?php printf(__('You must be %slogged in%s to post a comment.', 'vcard'), '<a href="'.wp_login_url( get_permalink() ).'">', '</a>'); ?></p>

            <?php else : ?>

			<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" class="comments-form" id="the_comment_list">
			
                    <?php if ( is_user_logged_in() ) : ?>
                        <div class="form-col form-marg small fl-left">
                            <label><?php echo __('Name', 'vcard'); ?><span>*</span></label>
                            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="input-name form-item" />
                        </div>
                        <div class="form-col small fl-left">
                            <label><?php echo __('Email', 'vcard'); ?><span>*</span></label>
                            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="input-email form-item"  />
                        </div>
                        <div class="form-col">
                            <label><?php echo __('Message', 'vcard'); ?><span>*</span></label>
                            <textarea name="comment" id="comment" cols="39" rows="4" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?> class="textarea-comment form-item"></textarea>
                        </div>
                        <div id="comment-submit" class="form-btn">
                            <div class="button">
                                <input type="submit" tabindex="5" value="<?php echo __('send message', 'vcard'); ?>" class="comment-submit general_button default btn" />
                            </div>
                            <?php comment_id_fields(); ?>
                            <?php do_action('comment_form', $post->ID); ?>
                        </div>
                    <?php else : ?>
                        <div class="form-col form-marg small fl-left">
                            <label><?php echo __('Name', 'vcard'); ?><span>*</span></label>
                            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="input-name form-item" />
                        </div>
                        <div class="form-col small fl-left">
                            <label><?php echo __('Email', 'vcard'); ?><span>*</span></label>
                            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="input-email form-item"  />
                        </div>
                        <div class="form-col">
                            <label><?php echo __('Message', 'vcard'); ?><span>*</span></label>
                            <textarea name="comment" id="comment" cols="39" rows="4" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?> class="textarea-comment form-item"></textarea>
                        </div>
                        <div id="comment-submit" class="form-btn">
                            <div class="button">
                                <input type="submit" tabindex="5" value="<?php echo __('send message', 'vcard'); ?>" class="comment-submit general_button default btn" />
                            </div>
                            <?php comment_id_fields(); ?>
                            <?php do_action('comment_form', $post->ID); ?>
                        </div>
                    <?php endif; ?>
            </form>
			
            <?php endif; // If registration required and not logged in ?>
</div>

<?php
	$needed_comment_form = 0;
	if ($needed_comment_form == 1) comment_form();
?>	 
<?php endif; // if you delete this the sky will fall on your head ?>