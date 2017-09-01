<?php 
/*Customizer : COPYRIGHT Code HERE*/
add_action('customize_register', 'theme_footer_customizer');
function theme_footer_customizer($wp_customize){
 //adding section in wordpress customizer   
$wp_customize->add_section('footer_copyright_section', array(
  'title'          => 'Add Copyright Text'
 ));
//adding setting for footer Copyright text area
$wp_customize->add_setting('copyright_text_setting', array(
 'default'        => '2017 - BONAPPETIT, All Rights Reserved',
 'transport'   => 'refresh',    
 ));
$wp_customize->add_control('copyright_text_setting', array(
 'label'   => 'Copyright Text Here',
  'section' => 'footer_copyright_section',
  'type'    => 'textarea',
));


}



/*Customizer: FOOTER LOGO CODE HERE*/
add_action('customize_register', 'theme_footer_logo_customizer');
function theme_footer_logo_customizer($wp_customize){
 //adding section in wordpress customizer   
$wp_customize->add_section('footer_logo_settings_section', array(
  'title'          => 'Footer LOGO Section'
 ));
    
    

//adding setting for footer logo
$wp_customize->add_setting('footer_logo');
$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'footer_logo',array(
 'label'      => __('Footer Logo', 'mytheme'),
 'section'    => 'footer_logo_settings_section',
 'settings'   => 'footer_logo',
 )));
    
//adding setting for footer text area
$wp_customize->add_setting('text_below_logo', array(
 'default'        => 'orem ipsum dolor sit amet, contetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',
 ));
$wp_customize->add_control('text_below_logo', array(
 'label'   => 'Text Below Logo Here',
  'section' => 'footer_logo_settings_section',
 'type'    => 'textarea',
));



}
