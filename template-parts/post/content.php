<?php
/**
 * Template part for displaying posts
 *

 * @version 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
if ( is_sticky(get_the_ID()) ) :
    get_template_part( 'post-content/sticky-post' );
else :
    get_template_part( 'post-content/default-post' );
endif;
?>

</article><!-- #post-## -->

