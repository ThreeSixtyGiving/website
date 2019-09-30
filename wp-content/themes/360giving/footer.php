			</div>
			<!-- CONTENT END -->

			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="row-sm-height">
							<div class="col-sm-3 col-sm-height">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
									<img src="<?php echo ASSET . 'img/logo-white.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="140" height="100">
								</a>
							</div>
							<div class="col-sm-9 col-sm-height">
								<nav class="footer-nav">
									<?php
										wp_nav_menu( array(
											'menu' => 'footer_1',
											'theme_location' => 'footer_1',
											'depth' => 2,
											'container' => '',
											'menu_class' => 'list-inline list-unstyled',
											'items_wrap' => '<ul class="%2$s">%3$s</ul>',
											'walker' => new loki_offcanvas_menu()
											)
										);
									?>
								</nav>
								<p class="contact">
									<a class="tel" href="<?php echo get_tel_link('global_tel'); ?>"><?php echo loki_meta('global_tel', array(), get_option('page_on_front')); ?></a>
									<a class="email" href="mailto:<?php echo loki_meta('global_email', array(), get_option('page_on_front')); ?>"><?php echo loki_meta('global_email', array(), get_option('page_on_front')); ?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<div class="sub-footer">
				<div class="container">
					<a class="newsletter-signup" href="https://us10.campaign-archive.com/home/?u=216b8b926250184f90c7198e8&id=91870dde44"><i class="fa fa-envelope-o"></i>Sign up to our newsletter</a>
					<p class="legal">360Giving is a company limited by guarantee <a href="https://beta.companieshouse.gov.uk/company/09668396" target="_blank" style="color:white">09668396</a> and a registered charity <a href="http://beta.charitycommission.gov.uk/charity-details/?regid=1164883&subid=0"  target="_blank" style="color:white">1164883</p>
					<nav class="footer-nav">
						<?php wp_nav_menu( array(
							'menu' => 'footer_2',
							'theme_location' => 'footer_2',
							'depth' => 2,
							'container' => '',
							'menu_class' => 'list-inline list-unstyled',
							'items_wrap' => '<ul class="%2$s">%3$s<li><a href="https://www.logicdesign.co.uk" target="_blank">Website Design by Logic Design</a></li></ul>',
							'walker' => new loki_offcanvas_menu()
							)
						); ?>
					</nav>
				</div>
			</div>

		</div>

	</div>

	<?php wp_footer(); ?>

</body>
</html>
