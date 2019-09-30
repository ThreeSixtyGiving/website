<?php if ( has_subpages() ) : ?>
	<div class="widget widget-subpages">
		<h3 class="widget-title widget-title-link"><?php echo get_subpage_menu_title(null, true); ?></h3>
		<div class="widget-content">
			<ul>
				<?php echo get_subpage_menu(); ?>
			</ul>
		</div>
	</div>
<?php endif; ?>