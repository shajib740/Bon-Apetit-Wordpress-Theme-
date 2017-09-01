<?php 
/**
 * The template for displaying all single posts and attachments.
 *
 * @package bonapettet
 * @since bonapettet 1.0
 */
get_header(); ?>

<div class="ps-ba-single-page">
	<div class="ps-ba-blog-post">
		<div class="container ps-ba-container-modifier">
            <div class="ps-ba-right-nopad-container">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content', 'single' );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
                ?>
            </div>
		</div>
	</div>
</div>

<?php get_footer(); ?>