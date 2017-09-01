<?php 
/**
 * BON APPETIT functions and definitions
 *
 *
 */

/*THIS FILE INCLUDES
* Include/Require Essntial File
* Bon Appetit Essential Support for Thumbnail ,Custom Logo, Custom Header, Text Domain etc using after_setup_theme hook
* Bon Appetit Enqueue Scripts and Style Sheet 
*/




require get_template_directory() . "/inc/custom-logo.php";
require get_template_directory() . "/inc/helper.php";
// Customizer Addition
require get_template_directory() . "/inc/customizer.php";
require get_template_directory() . "/inc/icon-functions.php";
require get_template_directory() . "/template-parts/post/related-post.php";
require get_template_directory() . "/inc/author-info-widget.php";
require get_template_directory() . "/inc/bon_popular.php";





if ( ! function_exists( 'bon_appetit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bon_appetit_setup() {
    
    //---------------Make theme available for translation.
     
	load_theme_textdomain( 'bon-appetit',get_template_directory() . '/languages' );

	//------------------------------------------------------
    
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */

	//--------------Add default posts and comments RSS feed links to head.------------------//

	add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header' );
    add_theme_support( "custom-background");
    add_theme_support( 'post-thumbnails' );
    // Supporting title tag
    add_theme_support( 'title-tag' );
    // Supporting custom logo
    add_theme_support( 'custom-logo', array(
        'flex-height' => TRUE,
    ) );
		
    //-------------------------------------------------------------------------------
    // Enable support for Post Thumbnails on posts and pages.
    // @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    //-------------------------------------------------------------------------------
 
    // default post thumbnail size
  
    add_image_size( 'bon-appetit-thumbnail', 763, 400, TRUE );

    add_image_size( 'bon-appetit-single-blog-thumbnail', 1220, 640, TRUE );
    
    // Default Related Post Thumbnail
    add_image_size( 'bon-appetit-related-post-thumbnail', 270, 155, array( 'center', 'center' ) );
    
    // Register wp_nav_menu()
    register_nav_menus(  array(

    'primary' => __( 'Primary Menu', 'bon-appetit' ),
    'social' => __( 'Social Links Menu', 'bon-appetit' ),    

    ) );

    
    //-------------------------------------------------------------------------------
    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5.
    //-------------------------------------------------------------------------------
    add_theme_support( 'html5',
                      apply_filters( 'bon_appetit_html5_theme_support', array(
				                   'comment-list',
				                   'comment-form',
				                   'search-form',
				                   'gallery',
				                   'caption'
			                   ) ) );
    
    //-------------------------------------------------------------------------------
    // Enable support for Post Formats.
    // See http://codex.wordpress.org/Post_Formats
    //-------------------------------------------------------------------------------
    add_theme_support( 'post-formats', apply_filters( 'bon_appetit_post_formats_theme_support', array(
				'aside',
				'status',
				'image',
				'audio',
				'video',
				'gallery',
				'quote',
				'link',
				'chat'
			) ) );

}

add_action( 'after_setup_theme', 'bon_appetit_setup' );
endif;


/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'bon_appetit_scripts' ) ) :

	function bon_appetit_scripts()
    {

        do_action('bon_appetit_before_enqueue_script');


        //Loading CSS from here

        // Twitter BootStrap CSS.
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

        /*===font awesome support===*/
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.3.7');


        /*===animation support===*/
        wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0');

	    /*===owl carosoul===*/
	    wp_enqueue_style('ps-ba-owl-carosoul', get_template_directory_uri(). '/css/owl.carousel.min.css', array(), '1.0.0');

	    /*===owl carosoul Theme===*/
	    wp_enqueue_style('ps-ba-owl-carosoul-theme', get_template_directory_uri(). '/css/owl.theme.default.min.css', array(), '1.0.0');

        // Theme stylesheet.
        wp_enqueue_style('bon-appetit-style', get_stylesheet_uri());

        //single post style
        wp_enqueue_style('bon-appetit-single-style', get_template_directory_uri() . '/css/ps-ba-single.css');

        // Load the html5 shiv.
        wp_enqueue_script('html5', get_theme_file_uri('/js/html5.js'), array(), '3.7.3');


        // Load the jquery.
        wp_enqueue_script('jquery');


	    // Load owl Js.
	    wp_enqueue_script( 'ps-ba-owl-carosoul', get_template_directory_uri(). '/js/owl.carousel.min.js' , array('jquery'),'1.0.0', TRUE );
	    wp_enqueue_script( 'ps-ba-owl-carosoul-script', get_template_directory_uri().'/js/owl-script.js' , array('jquery'), '1.0.0', TRUE );
    
		// ===script load===

         wp_enqueue_script( 'bs_script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', TRUE );
         wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), 1.1, TRUE );

        // ===Like Count===//
         wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
         wp_localize_script('like_post', 'ajax_var', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce')
    ));



        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
        add_action('wp_enqueue_scripts', 'bon_appetit_scripts');





endif;

// Register Widget Area

if ( ! function_exists( 'bon_appetit_widgets_init' ) ) :

function bon_appetit_widgets_init(){
    
     register_sidebar(array(
        'name'          =>__('Blog Page Bottom Area','bonappetit'),
        'id'            =>'blog-sidebar1',
        'description'   =>__('Add Widget to show below the posts'),
        'before_widget' => '<section id="%1$s" class="widget %2$s ">',
        'after_widget'  => '</section>',
        'before_title'  =>'<h2 class="widget_title">',
        'after_title'   =>'</h2>',
    
    ));
    
    register_sidebar(array(
        'name'          =>__('Footer 1','bonappetit'),
        'id'            =>'footer1',
        'description'   =>__('Add Logo here in first 4 col'),
        'before_widget' => '<section id="%1$s" class="widget %2$s footer-logo">',
        'after_widget'  => '</section>',
        'before_title'  =>'<h2 class="widget_title">',
        'after_title'   =>'</h2>',
    
    ));
    
      register_sidebar(array(
        'name'          =>__('Footer 2','bonappetit'),
        'id'            =>'footer2',
        'description'   =>__('Add widgets here in second 3 col'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  =>'<h2 class="widget_title">',
        'after_title'   =>'</h2>',
    
    ));
    
       register_sidebar(array(
        'name'          =>__('Footer 3','bonappetit'),
        'id'            =>'footer3',
        'description'   =>__('Add widgets here in third 3 col'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  =>'<h2 class="widget_title">',
        'after_title'   =>'</h2>',
    
    ));
    
       register_sidebar(array(
        'name'          =>__('Footer 4','bonappetit'),
        'id'            =>'footer4',
        'description'   =>__('Add widgets here in last four col'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  =>'<h2 class="widget_title">',
        'after_title'   =>'</h2>',
    
    ));
    
    	register_sidebar( apply_filters( 'bon_appetit_blog_sidebar', array(
				'name'          => esc_html__( 'Blog Sidebar', 'bonappetit' ),
				'id'            => 'bon_appetit_blog_sidebar',
				'description'   => esc_html__( 'Appears in the blog sidebar.', 'bonappetit' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		) ) );

}
add_action( 'widgets_init', 'bon_appetit_widgets_init' );
endif;

add_action('after_listing_posts', 'implement_posts_slider');

function implement_posts_slider(){
    get_template_part('template-parts/post/posts-slider');
}


//-------------------------------------------------------------------------------
// Custom template tags for this theme.
//-------------------------------------------------------------------------------

require get_template_directory() . "/inc/template-tags.php";


/**
 * Walker class
 */
require get_parent_theme_file_path( '/inc/walker.php' );






/*
* Like Count Area
*/


add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');


function post_like()
{

    // Check for nonce security
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Not Secured!');

    if(isset($_POST['post_like']))
    {

        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];


        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];

        if(!is_array($voted_IP))
            $voted_IP = array();

        // Get votes count for the current post
        $meta_count =  get_post_meta($post_id, "votes_count", true);
        //print_r ( $meta_count);
        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();

            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);

            // Display count (ie jQuery return value)

            die( $meta_count);
            //print_r($meta_count);
        }
        else
            echo "already";
    }
    exit;
}

//$timebeforerevote = 2; // = 2 mins

function hasAlreadyVoted($post_id)
{
//	global $timebeforerevote;

    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    if(isset($voted_IP) && !empty($meta_IP)){
    $voted_IP = $meta_IP[0];
    }
     else
    $voted_IP="";
      
    if(!is_array($voted_IP))
        $voted_IP = array();

    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();

        // Compare between current time and vote time
        //if(round(($now - $time) / 60) > $timebeforerevote)
        //	return false;

        return true;
    }

    return false;
}


/*---------------------------------------------------*/
/*AUTHOR BIO SIDEBAR BOX*/
/*---------------------------------------------------*/


/*AUTHOR BIO SIDEBAR BOX*/
add_action('add_author_bio', 'wpb_author_info_box');

function wpb_author_info_box( ) {
global $post;
// Detect if it is a single post with a post author
if (isset( $post->post_author ) ) {
// Get author's display name
$display_name = get_the_author_meta( 'display_name', $post->post_author );
$twitter_name = get_the_author_meta( 'twitter', $post->post_author );
$facebook_name = get_the_author_meta( 'facebook', $post->post_author );
$snapchat_name = get_the_author_meta( 'pinterest', $post->post_author );
$pinterest_name = get_the_author_meta( 'snapchat', $post->post_author );
   
// If display name is not available then use nickname as display name
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );
// Get author's biographical information or description
$user_description = get_the_author_meta( 'user_description', $post->post_author );
// Get author's website URL
$user_website = get_the_author_meta('url', $post->post_author);
// Get link to the author archive page
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
// Get link of Author profile page
  $author_profile= esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ));
if ( ! empty( $user_description ) )
// Author avatar and bio
$author_details="";
echo '<div class="author-bio-widget">';
$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) .'<p class="author_name"><a  href="'.$author_profile.'">' . $display_name . '</a></p>'.'<p class="author_description">'. nl2br( $user_description ).'</p>'. '</p>';
    
// Check if author has a website in their profile
if ( ! empty( $user_website ) ) {
// Display author website link
$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
} else {
// if there is no author website then just close the paragraph
$author_details .= '</p>';
}
echo "$author_details";
// Pass all this info to post content
    
$content='';    
$content .= $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
    
    
    echo '<div class="author_social_links">';
    echo '<ul class="list-inline">'; 

                if(!empty($facebook_name)):?>
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
            <?php endif;
                echo '</ul>';
            echo '</div> </div>';
    
    
}
}

/*ADD NEW SOCIAL Media box TO THE user profile */

function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';
    
    //add Facebook
    $contactmethods['pinterest'] = 'Pinterest';
    
    //add Facebook
    $contactmethods['snapchat'] = 'snapchat';
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

/*Setting Excerpt length to 20 words instead of default 55 words*/
function bon_appetit_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'bon_appetit_custom_excerpt_length', 999 );