<div class='bb_metabox'>
<?php
	$this->select(	
		'portfolio_post_format',
		'Portfolio post format',
		array(
				'default'   => 'Standard',
				'video'     => 'Video',
				'directlink'     => 'Direct Link'
		),
		''
	);

	$this->text( 
		'video_or_direct_url',
		'URL',
		''
	);
?>
</div>