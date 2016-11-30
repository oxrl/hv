<div class='bb_metabox'>
<?php

$this->select(	'blog_post_format',
				'Blog post format',
				array(
						'default'   => 'Standard',
						'video'     => 'Video',
						'audio'     => 'Audio',
						'slider'    => 'Image Slider',
				),
				''
			);

$this->text( 'vimeo_video_url',
				'Video URL',
				''
			);
$this->upload( 'audio_file_mp3', 'Audio mp3 or Ogg file' );

?>
</div>