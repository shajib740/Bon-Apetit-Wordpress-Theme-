<?php

/**
 * The main template file of BON APPETIT
*
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
* @version 1.0.0
 */

get_header();
?>

<div class="main-wrap">

    <!-- This area for content and sidebar -->
    <div class="body-upper-part">
       <div class="container">
           <div class="row">

               <!-- This area for content -->
               <div class="col-md-9">
                   <div id="primary" class="content-area">
                       <main id="main" class="site-main">
                           <?php if ( have_posts() ) : ?>
                           <?php /* Start the Loop */ ?>

                           <?php while ( have_posts() ) : the_post();

                           /*
                           * Include the Post-Format-specific template for the content.
                           * If you want to override this in a child theme, then include a file
                           * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                           */
                           get_template_part( 'template-parts/post/content', get_post_format() );

                           endwhile; ?>

                           <?php
                           else :

                           get_template_part( 'template-parts/post/content', 'none' );

                           endif;
                           ?>

                       </main>
                   </div>
               </div>

               <!-- This area for sidebar -->
               <div class="col-md-3">
                   <?php get_sidebar(); ?>
               </div>
           </div>
       </div>
    </div>

    <!-- This area for pagination and slider -->
    <div class="body-lower-part">
        <div class="container">
        <!-- This area for pagination -->
        <div class="row">
            <div class="col-md-12">
                <div class="text-center posts-pagination">
                    <?php story_posts_pagination(); ?>
                </div>
            </div>
        </div>


        </div>
    </div>
    
    <div class="container-fluid no-padding">
        <div class="posts-slider">
            <?php
            do_action("after_listing_posts");
            ?>
        </div><!--.posts-slider-->
    </div><!--.container-fluid-->
</div>

<?php get_footer();

