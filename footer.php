
<footer class="site-footer" >
    <div class="footer-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    
                    
                    <?php  
                    
                    if(get_theme_mod( 'footer_logo' ))?>
                    <img src="<?php echo get_theme_mod( 'footer_logo' ); ?>" class="img-responsive">
                    
                     <?php if(get_theme_mod( 'text_below_logo' ))?>
    
                     <p class="footer-text"><?php echo get_theme_mod( 'text_below_logo' );?></p>
                    
                    <!--SOCIAL NAV MENU-->
                    <?php	if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'bon-appetit' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>'. bon_appetit_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?>
                </div>
                <div class="col-md-8">
                     <?php 
                        get_template_part('template-parts/footer/footer','widgets');
                     ?>
                </div>
                
                <div class="col-md-12 text-center">
                <?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
                </div>
            </div>
        </div>
        
    
    </div>


</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>