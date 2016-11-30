   
    <a id="up"></a>
    </div><!-- /.row-wrap -->
	
		<!-- FOOTER BEGIN -->
		<?php global $vcard_data; ?>
		<footer>
			<div id="footer">
				<div class="inner">
					<div class="block_copyrights"><?php 
						$copyright_info = (isset($vcard_data['copyright_info'])) ? $vcard_data['copyright_info'] : '';
						echo stripslashes($copyright_info); 
					?></div>
					<div class="block_bottom_menu"><?php
						//the footer menu
						wp_nav_menu(array(
							'menu'              => '',
							'container'         => '',
							'container_class'   => '',
							'container_id'      => '',
							'menu_class'        => '',
							'menu_id'           => 'footer-menu',
							'echo'              => true,
							'fallback_cb'       => '',
							'before'            => '',
							'after'             => '',
							'link_before'       => '',
							'link_after'        => '',
							'depth'             => 0,
							'walker'            => '',
							'theme_location'    => 'footer_navigation'
						));
					?></div>
					<div class="clearboth"></div>
				</div>
			</div>
		</footer>
		<!-- FOOTER END -->
		
</div><!-- /.row-space-->

<?php wp_footer();?>

</body>
</html>