<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
    <?php
if ( get_theme_mod( 'copyright_text_setting' ) ) ?>
	<?php  echo __(get_theme_mod( 'copyright_text_setting' ));?>
</div><!-- .site-info -->