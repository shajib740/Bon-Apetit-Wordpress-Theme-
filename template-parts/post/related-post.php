<?php
 
//for use in the loop, list 5 post titles related to first tag on current post

$tags = wp_get_post_tags(get_the_ID());
    if ($tags) {

        $first_tag = $tags[0]->term_id;

        $args=array(

        'tag__in' => array($first_tag),

        'post__not_in' => array($post->ID),

        'posts_per_page'=>6,

        'ignore_sticky_posts'=>1
        );
        
        $my_query = new WP_Query($args);

        if( $my_query->have_posts() ) {?>

        <h3 class="related-post-heding text-center"><?php echo _e( 'You Might Also like','bon-appetit' ); ?></h3>
        <div class="row">
       <?php  while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
       <div class="col-sm-4 related-post-grid ">
					<div class="related-post">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php if ( get_the_post_thumbnail() ) : ?>
									<?php echo get_the_post_thumbnail( get_the_ID(), 'bon-appetit-related-post-thumbnail', array(
										'class' => 'img-responsive',
										'alt'   => get_the_title()
									) );
									?>
								<?php else :
									$placeholder = 'http://placehold.it/1140x600';
									echo '<img src="' . $placeholder . '" class="img-responsive wp-post-image" alt="' . wp_kses( get_the_title(), array() ) . '">';

								endif; ?>
							</a>
						<?php endif; ?>
                        <div class="related-post-titles">
                            <h5 ><?php the_category(' ') ?></h5>
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="entry-date"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
                            <p class="excerpt"><?php echo get_the_excerpt(); ?></p>

                        </div>
					</div>
				</div>
               

    <?php
            endwhile; ?>
             </div>
        <?php }
wp_reset_query();
}?>