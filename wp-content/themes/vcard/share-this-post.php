<?php global $vcard_data; ?>
<div class="post-share">

	<?php if ($vcard_data['sharing_twitter'] || $vcard_data['sharing_facebook'] || $vcard_data['sharing_pinterest'] || $vcard_data['sharing_pinterest']) : ?>
		<span><?php _e('Share:','vcard'); ?></span>
	<?php endif; ?>

		<?php if($vcard_data['sharing_twitter']): ?>
			<a target="_blank" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" class="share-tw" title="Twitter">&nbsp;</a>
		<?php endif;
			if($vcard_data['sharing_facebook']): ?>
			<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="share-fb" title="Facebook">&nbsp;</a>
		<?php endif;
			if($vcard_data['sharing_pinterest']): 
				$image_src = $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'thumbnail'  );
				if($image_src)
					$image_src = '&media='.$image_src[0]; ?>
			<a target="_blank" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); echo $image_src; ?>&description=<?php the_title(); ?>" class="share-p" title="Pinterest" data-pin-do="buttonPin" data-pin-config="above">&nbsp;</a>
		<?php endif;
			if($vcard_data['sharing_pinterest']): ?>
			<a target="_blank" class="share-in" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" rel="nofollow" onclick="NewWindow(this.href,'template_window','550','400','yes','center');return false" onfocus="this.blur()">&nbsp;</a> 
		<?php endif; ?>
</div>
