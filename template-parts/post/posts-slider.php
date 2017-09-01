
<?php
 $args = array(
 'post_type'      => 'post',
 'oderby'         => 'menu_order',
 'posts_per_page' => 10
 );

$slides = new WP_Query( $args );
?>
<?php if( $slides->have_posts() ):?>
<div class="owl-carousel">
<?php while( $slides->have_posts() ) : $slides->the_post(); ?>
<?php if(has_post_thumbnail()):?>
    <div class="ps-ba-slider-item">
        <a href="<?php the_permalink(); ?>" >
            <?php echo get_the_post_thumbnail( get_the_ID(), 'bon-appetit-related-post-thumbnail', array(
                'class' => 'img-responsive',
                'alt'   => get_the_title()
            ) );?>
        </a>
    </div>
        <?php endif; ?>
    <?php endwhile; ?>
</div>
<?php  endif ?>
