<?php

//----------------------------------------------------------------------
// Theme Option Name
//----------------------------------------------------------------------

if (!function_exists('bonappetit_option_name')):
    function bonappetit_option_name()
    {

        if (function_exists('pxlr_plugin_theme_option_name')) {
            return pxlr_plugin_theme_option_name();
        }

        return apply_filters('pxlr_theme_option_name', 'pxlr_theme_option');
    }
endif;

//----------------------------------------------------------------------
// Getting Theme Option data
//----------------------------------------------------------------------

if (!function_exists('bonappetit_option')):
    function bonappetit_option($index = FALSE, $index2 = FALSE, $default = NULL)
    {

        if (function_exists('pxlr_plugin_theme_option')) {
            return pxlr_plugin_theme_option($index, $index2, $default);
        }

        $bonappetit_theme_option_name = bonappetit_option_name();

        if (!isset($GLOBALS[$bonappetit_theme_option_name])) {
            return $default;
        }

        $bonappetit_theme_option = $GLOBALS[$bonappetit_theme_option_name];

        if (empty($index)) {
            return $bonappetit_theme_option;
        }

        if ($index2) {
            $result = (isset($bonappetit_theme_option[$index]) and isset($bonappetit_theme_option[$index][$index2])) ? $bonappetit_theme_option[$index][$index2] : $default;
        } else {
            $result = isset($bonappetit_theme_option[$index]) ? $bonappetit_theme_option[$index] : $default;
        }

        if ($result == '1' or $result == '0') {
            return $result;
        }

        if (is_string($result) and empty($result)) {
            return $default;
        }

        return $result;
    }
endif;

//----------------------------------------------------------------------
// Associative array to html attribute conversion
//----------------------------------------------------------------------

if (!function_exists('bonappetit_array2attributes')):

    function bonappetit_array2attributes($attributes, $filter_name = '')
    {

        if (function_exists('pxlr_plugin_array2attributes')) {
            return pxlr_plugin_array2attributes($attributes, $filter_name);
        }

        $attributes = wp_parse_args($attributes, array());
        if ($filter_name) {
            $attributes = apply_filters($filter_name, $attributes);
        }

        $attributes_array = array();

        foreach ($attributes as $key => $value) {

            if (is_bool($attributes[$key]) and $attributes[$key] === TRUE) {
                return $attributes[$key] ? $key : '';
            } elseif (is_bool($attributes[$key]) and $attributes[$key] === FALSE) {
                $attributes_array[] = '';
            } else {
                $attributes_array[] = $key . '="' . $value . '"';
            }
        }

        return implode(' ', $attributes_array);
    }
endif;

//----------------------------------------------------------------------
// OffCanvas Inner Pusher Styles
//----------------------------------------------------------------------

if (!function_exists('offCanvas_On_InnerPusher')):
    function offCanvas_On_InnerPusher($animation_style)
    {

        $inner_pusher_list = apply_filters('bonappetit_off_canvas_inner_pusher_animation_name', array(
            'push-down',
            'rotate-pusher',
            'three-d-rotate-in',
            'three-d-rotate-out',
            'delayed-three-d-rotate'
        ));

        return in_array($animation_style, $inner_pusher_list);
    }
endif;

//----------------------------------------------------------------------
// Convert hexdec color string to rgb(a) string
//----------------------------------------------------------------------

if (!function_exists('bonappetit_hex2rgba')):
    function bonappetit_hex2rgba($color, $opacity = FALSE)
    {

        if (function_exists('pxlr_plugin_hex2rgba')) {
            return pxlr_plugin_hex2rgba($color, $opacity);
        }

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color)) {
            return $default;
        }

        //Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1) {
                $opacity = 1.0;
            }
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        return $output;
    }
endif;

//----------------------------------------------------------------------
// Check And return File URI
//----------------------------------------------------------------------

if (!function_exists('bonappetit_locate_template_uri')):
    function bonappetit_locate_template_uri($template_names)
    {

        if (function_exists('pxlr_plugin_locate_template_uri')) {
            return pxlr_plugin_locate_template_uri($template_names);
        }

        $located = '';
        foreach ((array)$template_names as $template_name) {
            if (!$template_name) {
                continue;
            }
            if (file_exists(trailingslashit(get_stylesheet_directory()) . $template_name)) {
                $located = trailingslashit(get_stylesheet_directory_uri()) . $template_name;
                break;
            } elseif (file_exists(trailingslashit(get_template_directory()) . $template_name)) {
                $located = trailingslashit(get_template_directory_uri()) . $template_name;
                break;
            }
        }

        return $located;
    }
endif;

//----------------------------------------------------------------------
// Get Theme Preset
//----------------------------------------------------------------------

if (!function_exists('bonappetit_get_preset')):
    function bonappetit_get_preset($suffix = '')
    {

        if (function_exists('pxlr_plugin_theme_option_get_preset')) {
            return pxlr_plugin_theme_option_get_preset($suffix);
        }

        $valid_list = apply_filters('pxlr_available_preset', array(
            'preset1',
            'preset2',
            'preset3',
            'preset4',
            'preset5'
        ));

        $preset = bonappetit_option('preset', FALSE, 'preset1');

        if (!class_exists('pxlr_Session')) {
            return apply_filters('pxlr_preset', $preset) . $suffix;
        }

        $pxlr_Session = pxlr_Session::get_instance();

        if (!apply_filters('pxlr_can_change_preset_on_fly', '__return_true')) {

            return apply_filters('pxlr_preset', $preset) . $suffix;
        }

        $session_name = '_pxlr_preset';
        $require_preset = isset($_GET['pxlr-preset']) ? wp_kses(trim($_GET['pxlr-preset']), array()) : '';

        // Reset Current Preset
        if (isset($_GET['reset-pxlr-preset'])) {
            unset($pxlr_Session[$session_name]);

            return apply_filters('pxlr_preset', $preset) . $suffix;
        }

        // Reset for Invalid
        if (!empty($require_preset) and !in_array($require_preset, $valid_list)) {
            unset($pxlr_Session[$session_name]);

            return apply_filters('pxlr_preset', $preset) . $suffix;
        }

        // Check current on-fly preset and return it
        if (!empty($require_preset)) {
            $current = $pxlr_Session[$session_name] = $require_preset;
        } elseif (empty($require_preset) and isset($pxlr_Session[$session_name])) {
            // Check current on-fly preset on session and return session value.
            $current = $pxlr_Session[$session_name];
        } else {
            // just return default preset.
            $current = $preset;
        }

        return apply_filters('pxlr_preset', $current) . $suffix;
    }
endif;

//----------------------------------------------------------------------
// Get Header Style
//----------------------------------------------------------------------

if (!function_exists('bonappetit_get_header_style')):
    function bonappetit_get_header_style()
    {

        if (function_exists('pxlr_plugin_theme_option_get_header_style')) {
            return pxlr_plugin_theme_option_get_header_style();
        }

        $valid_list = apply_filters('pxlr_available_header_style', array(
            'header-style-default',
            'header-style-box'
        ));

        $default_option = bonappetit_option('header-style', FALSE, 'header-style-default');

        if (!class_exists('pxlr_Session')) {

            return apply_filters('pxlr_header_style', $default_option);
        }

        $pxlr_Session = pxlr_Session::get_instance();

        if (!apply_filters('pxlr_can_change_header_style_on_fly', '__return_true')) {
            return apply_filters('pxlr_header_style', $default_option);
        }

        $session_name = '_pxlr_header_style';
        $method_name = 'pxlr-header-style';
        $reset_method_name = 'reset-pxlr-header-style';
        $require_option = isset($_GET[$method_name]) ? wp_kses(trim($_GET[$method_name]), array()) : '';

        // Reset Current
        if (isset($_GET[$reset_method_name])) {
            unset($pxlr_Session[$session_name]);

            return apply_filters('pxlr_header_style', $default_option);
        }

        // Reset for Invalid
        if (!empty($require_option) and !in_array($require_option, $valid_list)) {
            unset($pxlr_Session[$session_name]);

            return apply_filters('pxlr_header_style', $default_option);
        }

        // Check current on-fly and return it
        if (!empty($require_option)) {
            $current = $pxlr_Session[$session_name] = $require_option;
        } elseif (empty($require_option) and isset($pxlr_Session[$session_name])) {
            // Check current on-fly from session and return session value.
            $current = $pxlr_Session[$session_name];
        } else {
            // just return default one.
            $current = $default_option;
        }

        return apply_filters('pxlr_header_style', $current);
    }
endif;

//----------------------------------------------------------------------
// Get Named Image Size Array
//----------------------------------------------------------------------

if (!function_exists('bonappetit_get_image_size')):
    function bonappetit_get_image_size($name)
    {

        if (function_exists('pxlr_plugin_get_image_size')) {
            return pxlr_plugin_get_image_size($name);
        }

        global $_wp_additional_image_sizes;

        return $_wp_additional_image_sizes[$name];
    }
endif;

//----------------------------------------------------------------------
// Has Read More
//----------------------------------------------------------------------

if (!function_exists('bonappetit_has_post_read_more')):

    function bonappetit_has_post_read_more()
    {

        global $post;

        if (!$post) {
            _doing_it_wrong(__FUNCTION__, esc_html__('You cannot use it before or after loop or specific post.', 'bonappetit'), sprintf(esc_html__('(This message was added in %s theme version %s.)', 'bonappetit'), PXLR_THEME_NAME, '1.0'));
        }

        $content_arr = get_extended($post->post_content);

        return !empty($content_arr['extended']);

    }
endif;

//----------------------------------------------------------------------
// Remove Redux NewsFlash
//----------------------------------------------------------------------

if (!class_exists('reduxNewsflash')):
    class reduxNewsflash
    {
        public function __construct($parent, $params)
        {

        }
    }
endif;

//----------------------------------------------------------------------
// Remove Redux Ads
//----------------------------------------------------------------------

add_filter('redux/' . bonappetit_option_name() . '/aURL_filter', '__return_empty_string');


//----------------------------------------------------------------------
// Ad Before Single Post 
//----------------------------------------------------------------------


if (!function_exists('pxlr_site_ads_before_single_post')) {
    function pxlr_site_ads_before_single_post($content)
    {


        $condition = is_singular('post');
        if (!apply_filters('pxlr_site_ads_before_single_post_condition', $condition))
            return $content;

        if (!empty($GLOBALS['post'])) {
            $post = $GLOBALS['post'];
            $post_id = $post->ID;
        } else {
            $post_id = 0;
        }

        $ads='';

        if(!empty(bonappetit_option('ad-before-single-post-link')) || !empty(bonappetit_option('ad-before-single-post-html-code'))) {

            if (bonappetit_option('ad-before-single-post-type') == 'html5-animated-banner') {
                $ads = bonappetit_option('ad-before-single-post-link');
                $ads = '<div class="ad-before-single-post-content pull-right">
						<iframe src="' . $ads . '" width="300" height="250"></iframe></div>';
            } elseif (bonappetit_option('ad-before-single-post-type') == 'custom-html') {
                $ads = bonappetit_option('ad-before-single-post-html-code');
                $ads = '<div class="ad-before-single-post-content pull-right">' . stripslashes($ads) . '</div>';
            } else {
                return $content;
            }
        }


        $ads = do_shortcode(apply_filters('yt_site_ads_before_single_post', $ads, $post_id));

        $delimeter = '</p>';
        $linebreaks = substr_count($content, $delimeter);

        if ($linebreaks < apply_filters('pxlr_site_ads_before_single_post_paragraph_count', 1))
            return $content;

        $insert_after = 1;

        $paragraphs = explode($delimeter, $content);

        foreach ($paragraphs as $key => $paragraph) {
            if (trim($paragraph)) {
                $paragraphs[$key] .= $delimeter;
            }
            if ($insert_after == $key + 1) {
                $paragraphs[$key] .= $ads;
            }
        }

        return implode('', $paragraphs);

    }
}
add_filter('the_content', 'pxlr_site_ads_before_single_post', 15, 1);


//----------------------------------------------------------------------
// Ad Between Single Post
//----------------------------------------------------------------------

if (!function_exists('pxlr_site_ads_between_single_post')) {
    function pxlr_site_ads_between_single_post($content)
    {

        $condition = is_singular('post');
        if (!apply_filters('pxlr_site_ads_between_single_post_condition', $condition))
            return $content;

        if (!empty($GLOBALS['post'])) {
            $post = $GLOBALS['post'];
            $post_id = $post->ID;
        } else {
            $post_id = 0;
        }

        $ads='';

        if(!empty(bonappetit_option('ad-between-single-post-link')) || !empty(bonappetit_option('ad-between-single-post-html-code'))){

            if (bonappetit_option('ad-between-single-post-type') == 'html5-animated-banner') {
                $ads = bonappetit_option('ad-between-single-post-link');
                $ads = '<div class="ad-between-single-post-content pull-left">
						<iframe src="' . $ads . '" width="300" height="250"></iframe></div>';
            } elseif (bonappetit_option('ad-between-single-post-type') == 'custom-html') {
                $ads = bonappetit_option('ad-between-single-post-html-code');
                $ads = '<div class="ad-between-single-post-content pull-left">' . stripslashes($ads) . '</div>';
            } else {
                return $content;
            }
        }

        $ads = do_shortcode(apply_filters('pxlr_site_ads_between_single_post', $ads, $post_id));

        $delimeter = '</p>';

        $linebreaks = substr_count($content, $delimeter);

        if ($linebreaks < apply_filters('pxlr_site_ads_between_single_post_paragraph_count', 4))

            return $content;

        $insert_after = intval($linebreaks / 2) + 1;

        $paragraphs = explode($delimeter, $content);

        foreach ($paragraphs as $key => $paragraph) {
            if (trim($paragraph)) {
                $paragraphs[$key] .= $delimeter;
            }
            if ($insert_after == $key + 1) {
                $paragraphs[$key] .= $ads;
            }
        }

        return implode('', $paragraphs);
    }
}
add_filter('the_content', 'pxlr_site_ads_between_single_post', 10, 1);


//----------------------------------------------------------------------
// Ad After Singple Post
//----------------------------------------------------------------------

if (!function_exists('pxlr_site_ads_after_single_post')) {
    function pxlr_site_ads_after_single_post($content)
    {

        $condition = is_singular('post');
        if (!apply_filters('pxlr_site_ads_before_single_post_condition', $condition))
            return $content;

        if (!empty($GLOBALS['post'])) {
            $post = $GLOBALS['post'];
            $post_id = $post->ID;
        } else {
            $post_id = 0;
        }

        $ads='';

        if(!empty(bonappetit_option('ad-after-single-post-link')) || !empty(bonappetit_option('ad-after-single-post-html-code'))) {

            if (bonappetit_option('ad-after-single-post-type') == 'html5-animated-banner') {
                $ads = bonappetit_option('ad-after-single-post-link');
                $ads = '<div class="ad-after-single-post-content text-center">
						<iframe src="' . $ads . '" width="728" height="90"></iframe></div>';
            } elseif (bonappetit_option('ad-after-single-post-type') == 'custom-html') {
                $ads = bonappetit_option('ad-after-single-post-html-code');
                $ads = '<div class="ad-after-single-post-content text-center">' . stripslashes($ads) . '</div>';
            } else {
                return $content;
            }
        }

        $output = '';
        if ($ads):
            $output = '<div class="ad-after-single-post clearfix">';
            $output .= stripslashes($ads);
            $output .= '</div>';
            $output = do_shortcode(apply_filters('pxlr_site_ads_after_single_post', $output, $post_id));
        endif;

        return $content . $output;


    }
}

add_filter('the_content', 'pxlr_site_ads_after_single_post', 20);

