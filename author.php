<?php
/**
 * The template for displaying Custom Author page.
 */

get_header();
?>

<?php

$twitter_name = get_the_author_meta( 'twitter', $post->post_author );
$facebook_name = get_the_author_meta( 'facebook', $post->post_author );
$snapchat_name = get_the_author_meta( 'pinterest', $post->post_author );
$pinterest_name = get_the_author_meta( 'snapchat', $post->post_author );

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

                                <div class="author-info clearfix">
                                    <h3><?php echo get_the_author_meta('nicename'); ?></h3>
                                    <div class="author-image">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                        <?php
                                        echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'pstudio_author_bio_avatar_size', 150 ) );
                                        ?>
                                    </a></div>
                                    <div class="author-bio">
                                        <?php the_author_meta('description') ?>
                                        <div class="author-social-links">
                                            <ul class="list-inline">

                                                <?php if(!empty($facebook_name)):?>
                                                    <li class="author_social_icon"><a href="https://<?php echo "$facebook_name"; ?>" class="fa fa-facebook"></a> </li>
                                                <?php endif;

                                                if(!empty($twitter_name)):?>
                                                    <li class="author_social_icon"><a href="https://<?php echo "$twitter_name"; ?>" class="fa fa-twitter"></a> </li>
                                                <?php endif;

                                                if(!empty($pinterest_name)):?>
                                                    <li class="author_social_icon"><a href="https://<?php echo "$pinterest_name"; ?>" class="fa fa-pinterest"></a> </li>
                                                <?php endif;


                                                if(!empty($snapchat_name)):?>
                                                    <li class="author_social_icon"><a href="https://<?php echo "$snapchat_name"; ?>" class="fa fa-snapchat"></a> </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>




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

<?php get_footer();
