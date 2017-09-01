<?php
/**
 * Template part for displaying sticky posts
 *
 * @version 1.0.0
 */
?>

<div class="content-padding">
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-12">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="img-responsive img-width" alt="<?php  wp_kses( get_the_title(), array() ) ?>" >
                </a>
                <?php endif; ?>
            </div>
            <div class="col-md-12">
                <div class="sticky-post-wrap">

                    <?php
                    if(has_category()): ?>
                    <h4 class="content-category">
                        <?php the_category(', ') ?>
                    </h4>
                    <?php endif; ?>

                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                <div class="entry-meta">
                    <?php  appetit_entry_meta() ?>
                </div>

                <div class="entry-content clearfix">
                    <?php
                    if ( ! has_excerpt() ) {
                        the_content( 'READ MORE' );
                    } else {
                        the_excerpt();
                    }

                    ?>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
