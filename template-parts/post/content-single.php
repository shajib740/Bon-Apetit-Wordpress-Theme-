<div class="row">
	<div class="col-md-9 ps-ba-single-first-col">

        <!--    Featured image showing    -->
		<?php if (has_post_thumbnail()): ?>
        <div class="ps-ba-featured-img">
                    <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="Image">
        </div>
		<?php endif;?>

        <div class="ps-ba-header-wrap">
            <!--    Showing All Categories    -->
            <div class="ps-ba-single-show-category">
                <?php $category_detail=get_the_category();
                foreach($category_detail as $cd):
                    $cat_name=$cd->cat_name;
                    // Get the ID of a given category
                    $category_id = get_cat_ID( $cat_name );

                    // Get the URL of this category
                    $category_link = get_category_link( $category_id );
                    ?>
                    <a href="<?php echo esc_url( $category_link ); ?>" title="Category Name"><?php echo $cat_name; ?></a>
                    <?php
    //                echo $cat_name;
    //	            echo " ";
                endforeach;
                ?>
            </div><!--.ps-ba-single-show-category-->

            <!--    Showing Post Title    -->
            <div class="ps-ba-single-title">
                <h1><?php  the_title() ?></h1>
            </div><!--.ps-ba-single-title-->

            <div class="ps-ba-single-post-meta">
                <?php  appetit_entry_meta() ?>
            </div><!--.ps-ba-single-post-meta-->
        </div><!--.ps-ba-header-wrap-->

        <!--    The CONTENT Goes Here    -->
		<div class="ps-ba-single-content">
            <?php the_content();?>
		</div><!--.ps-ba-single-content-->

		<?php
		$posttags = get_the_tags();
		$tag_name="";
		if ($posttags):
		?>
        <div class="ps-ba-single-tags">
			<h3>TAGS:
				<?php
				foreach ( $posttags as $tag ) :
					$tag_name=$tag->name;
					$tag_id=$tag->term_id;
					$tag_link=get_tag_link($tag_id);
					?>
					<a href="<?php echo $tag_link; ?>"> <?php echo $tag_name; ?> </a>
					<?php
				endforeach;
				?>
			</h3>
            <nav class="social-navigation no-margin" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'bon-appetit' ); ?>">
		        <div class="ps-ba-social-link-style">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'social',
                        'menu_class'     => 'social-links-menu',
                        'depth'          => 1,
                        'link_before'    => '<span class="screen-reader-text">',
                        'link_after'     => '</span>'. bon_appetit_get_svg( array( 'icon' => 'chain' ) ),
                    ) );
                    ?>
                </div>
            </nav><!-- .social-navigation -->
		</div><!--.ps-ba-single-tags-->

        <?php endif; ?>

<!--        NAVIGATION SECTION -->
        <div class="ps-ba-single-nav-section">
            <hr class="ps-ba-single-hr">
            <div class="ps-ba-single-navigation">
                <div class="ps-ba-single-nav-prev">
                    <?php previous_post_link('&lt; %link', 'PREVIOUS POST'); ?>
                </div><!--.ps-ba-single-nav-prev-->

                <div class="ps-ba-single-nav-next">
                    <?php next_post_link('%link &gt;', 'NEXT POST'); ?>
                </div><!--.ps-ba-single-nav-next-->
            </div><!--.ps-ba-single-navigation-->
            <hr class="ps-ba-single-hr">
        </div><!--.col-md-3.ps-ba-single-admin-img-->

<!--SINGLE ADMIN INFORMATION-->
        <div class="row ps-ba-single-admin">

                <div class="col-md-3 ps-ba-single-admin-img">
                    <img class="img-responsive ps-ba-single-admin-img-width" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" alt="">
                </div><!--.col-md-3.ps-ba-single-admin-img-->

                <div class="col-md-9 ps-ba-single-admin-content">

                    <h3 class="ps-ba-single-admin-content-name">
                        <?php the_author_meta( 'first_name'); ?> <?php the_author_meta( 'last_name'); ?>
                    </h3>
                    <p class="ps-ba-single-admin-content-desc"><?php  the_author_meta('description'); ?></p>
                </div><!--.col-md-9.ps-ba-single-admin-content-->
		</div><!--.row.ps-ba-single-admin-->
        <?php
          // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
        ?>
        
		</div><!-- .col-md-9 -->
        <!--    SIDEBAR SECTION HERE -->
	<div class="col-md-3">
		<?php get_sidebar();?>
	</div><!-- .col-md-3-->

        
                <div class="col-md-12">
                <div class="related-post-wrap">
                <?php get_template_part( 'template-parts/post/related-post' );?>
                </div>
                </div>
    
    
	
            
	</div>




</div><!-- .row-->
