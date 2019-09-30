<?php $categories = count(get_categories(array('parent' => 0,'hide_empty' => 0))); ?>
<?php if ( $categories > 1) : ?>
	<div class="widget widget-categories">
		<h3 class="widget-title">Categories</h3>
		<div class="widget-content">
			<ul>

				<?php
						$args = array(
						'title_li'=> __( '' ),
						'show_count'=> 1,
						'echo' => 0
					);
					$links = wp_list_categories($args);
					$links = str_replace('</a> (', '</a> <span class="count">', $links);
					$links = str_replace(')', '</span>', $links);
					echo $links;
				?>
			</ul>
		</div>
	</div>
<?php endif; ?>