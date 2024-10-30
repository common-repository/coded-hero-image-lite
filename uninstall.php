<?php  
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
 
delete_option('chi_image_upload');
delete_option('chi_image_height');
delete_option('chi_image_size');
delete_option('chi_image_size');
delete_option('chi_image_repeat');
delete_option('chi_title');
delete_option('chi_title_font-size');
delete_option('chi_title_font-family');
delete_option('chi_other_text');
delete_option('chi_title_color');
delete_option('chi_title_letter-spacing');
delete_option('chi_subtitle');
delete_option('chi_subtitle_font-size');
delete_option('chi_subtitle_font-family');
delete_option('chi_subtitle_other_text');
delete_option('chi_subtitle_color');
delete_option('chi_subtitle_letter-spacing');
delete_option('chi_text_align');
delete_option('chi_mobile_height');
delete_option('chi_mobile_on_off');
delete_option('chi_mobile_title_size');
delete_option('chi_mobile_subtitle_size');
?>
