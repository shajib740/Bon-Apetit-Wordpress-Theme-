<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Copse:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
	<?php wp_head(); ?>
</head>
    
    
<body <?php body_class(); ?>>
<div id="page" class="site">

    <header id="masthead" class="site-header" role="banner">
        <?php if(has_custom_logo()):?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-logo text-center">
                            <?php the_custom_logo(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
       
        <?php if( has_nav_menu( 'primary' ) ) : ?>
            <div class="bg2">
                <div class="container">
                    <nav class="navbar navbar-default ba-main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ba-navbar-collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse no-padding" id="ba-navbar-collapse">
                        
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container'      =>  false,
                                    'menu_class'     => 'nav navbar-nav navbar-left text-uppercase',
                                    'walker'         =>  new BonAppetit_Walker_Nav_Primary()
                                ));
                                ?>
                                <div class="nav-search-container nav navbar-form clearfix hidden-xs">
                                    <div class="open-search pull-left"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <div class="nav-search-bar pull-left">
                                        <?php get_search_form(); ?>
                                    </div>
                                </div>
                        

                            <?php if( has_nav_menu( 'social' ) ) : ?>
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'social',
                                            'menu_class'     => 'social-links-menu nav navbar-nav navbar-right visible-md-inline-block visible-lg-inline-block',
                                            'depth'          => 1,
                                            'container'      =>  false,
                                            'link_before'    => '<span class="screen-reader-text">',
                                            'link_after'     => '</span>'. bon_appetit_get_svg( array( 'icon' => 'chain' ) ),
                                        ) );
                                    ?>
                            <?php endif; ?>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div><!--end of bg2---->
        <?php endif; ?> 
    </header><!-- #masthead -->
            