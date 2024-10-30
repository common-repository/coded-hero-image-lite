<?php
/**
 * Plugin Name:     Coded Hero Image Lite
 * Plugin URI:      https://coded.co.nz/
 * Description:     This plugin allows you to add a hero image to wordpress header with various customizations
 * Author:          Chris Thompson + Craig Walker
 * Author URI:      https://coded.co.nz/about/
 * Text Domain:     C-HIL
 * Version:         1.0.0
 * License:         GPLv2  ::  See readme.txt for more info
 *Copyright:        Copyright (C) 2018  Chris Thompson and Craig Walker
 *
 * @package         Coded_Hero_Image
 */

class chi_settings_plugin{

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page'));
        add_action('admin_init',array( $this, 'setup_sections'));
        add_action('admin_init', array( $this, 'setup_fields'));
    }

    public function setup_sections() {
    	add_settings_section( 'chi_section_general', '', array( $this, 'chi_section_callback'), 'chi_fields');
        add_settings_section( 'chi_section_mobile', '', array( $this, 'chi_section_callback'), 'chi_fields');
        add_settings_section( 'chi_section_image', '', array( $this, 'chi_section_callback'), 'chi_fields');
        add_settings_section( 'chi_section_title', '', array( $this, 'chi_section_callback'), 'chi_fields');
        // add_settings_section( 'chi_section_subtitle', '', array( $this, 'chi_section_callback'), 'chi_fields');

    }

    public function chi_section_callback($arguments){
        switch( $arguments['id']){
            case 'chi_section_general' : echo '<h3 class="chi-section-title" id="">General Settings</h3>'; break;
            case 'chi_section_image' : echo '<h3 class="chi-section-title" id="">Image Settings</h3>'; break;
            case 'chi_section_title' : echo '<h3 class="chi-section-title" id="chi_custom_options_section">Title Settings</h3>'; break;
            case 'chi_section_subtitle' : echo '<h3 class="chi-section-title" id="chi_custom_options_section">Subtitle Settings</h3>'; break;

        }
    }

    public function setup_fields() {
        $fields = array(
        	array(
        	    'uid'           =>  'chi_display_option',
        	    'label'         =>  __('Display Options','C-HIL'),
        	    'section'       =>  'chi_section_general',
        		'type'          =>  'select',
        	    'options'       =>  array(
	        	        'all'		=> __('All Pages','C-HIL'),
	        	        'home'		=> __('Home Page Only','C-HIL'),
        	    ),
        	    'placeholder'   =>  __('All Pages','C-HIL'),
        	    'helper'        =>  __('Choose if you want your hero image to display on all pages or just the home page','C-HIL'),
        	    'supplemental'  =>  '',
        	    'default'       =>  'All Pages'
        		),
            array(
                'uid'           =>  'chi_image_upload',
                'label'         =>  __('Upload your hero image','C-HIL'),
                'section'       =>  'chi_section_image',
                'type'          =>  'upload',
                'options'       =>  false,
                'placeholder'   =>  '',
                'helper'        =>  __('Select an image to use as your hero image','C-HIL'),
                'supplemental'  =>  __('Suggested size 4:3 (1920px:1200px)','C-HIL'),
                'default'       =>  ''
            ),

            array(
                'uid'           =>  'chi_mobile_title_size',
                'label'         =>  __('Mobile Title Size','C-HIL'),
                'section'       =>  'chi_section_mobile',
                'type'          =>  'number',
                'options'       =>  false,
                'placeholder'   =>  '',
                'helper'        =>  __('Add a font size for your title on mobile','C-HIL'),
                'supplemental'  =>  '',
                'default'       =>  ''
                ),

            array(
                'uid'           =>  'chi_image_height',
                'label'         =>  __('Set your hero image height','C-HIL'),
                'section'       =>  'chi_section_image',
            	'type'          =>  'number',
                'options'       =>  false,
                'placeholder'   =>  '320',
                'helper'        =>  __('Add a height for your hero image.','C-HIL'),
                'supplemental'  =>  __('320 is the default. Do not add px on to the end','C-HIL'),
                'default'       =>  '320'
            	),

            array(
                'uid'           =>  'chi_text_align',
                'label'         =>  __('Text Alignment','C-HIL'),
                'section'       =>  'chi_section_general',
                'type'          =>  'select',
                'options'       =>  array(
                        'center'        =>  __('Center','C-HIL'),
                        'left'          =>  __('Left','C-HIL'),
                        'right'         =>  __('Right','C-HIL'),
                ),
                'placeholder'   =>  '',
                'helper'        =>  __('Choose where your text is aligned on the hero image','C-HIL'),
                'supplemental'  =>  __('All text will be centered vertically on the image','C-HIL'),
                'default'       =>  'center'
                ),
            array(
                'uid'           =>  'chi_title',
                'label'         =>  __('Add a hero image heading','C-HIL'),
                'section'       =>  'chi_section_title',
                'type'          =>  'text',
                'options'       =>  false,
                'placeholder'   =>  '',
                'helper'        =>  __('Add title text to your image','C-HIL'),
                'supplemental'  =>  '',
                'default'       =>  ''
            ),
            array(
                'uid'           =>  'chi_title_font-size',
                'label'         =>  __('Select a font size for your title','C-HIL'),
                'section'       =>  'chi_section_title',
                'type'          =>  'number',
                'options'       =>  false,
                'placeholder'   =>  '32',
                'helper'        =>  __('Choose a font size for your image','C-HIL'),
                'supplemental'  =>  __('Do not add px on to the end','C-HIL'),
                'default'       =>  '32'
            ),
            array(
                'uid'           =>  'chi_title_font-family',
                'label'         =>  __('Select a font family for your title','C-HIL'),
                'section'       =>  'chi_section_title',
                'type'          =>  'select',
                'options'       =>  chi_font_array(),
                'placeholder'   =>  '',
                'helper'        =>  __('Choose a font family for your image','C-HIL'),
                'supplemental'  =>  __('If you have a custom font please select other','C-HIL'),
                'default'       =>  ''
            ),

            array(
                'uid'           =>  'chi_title_color',
                'label'         =>  __('Choose title Color','C-HIL'),
                'section'       =>  'chi_section_title',
                'type'          =>  'color',
                'options'       =>  false,
                'placeholder'   =>  'Optional',
                'helper'        =>  __('Select a color for your title.','C-HIL'),
                'supplemental'  =>  '',
                'default'       =>  '#000000'
            ),



        );

    foreach ($fields as $field){

    add_settings_field($field['uid'], $field['label'], array($this, 'field_callback'), 'chi_fields', $field['section'], $field);
    register_setting( 'chi_fields', $field['uid']);
    }

}

public function field_callback($arguments){
    $value = get_option( $arguments['uid'] );
    if ( ! $value ) {
        $value = $arguments['default'];
    }

    switch ($arguments['type']) {
        case 'text':
        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value);
        break;
        case 'number':
        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value);
        break;
        case 'textarea':
        printf( '<textarea name="%1$s" id="%1$s placeholder="%2$s" rows="5" columns="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value);
        break;
        case 'select':
        if ( ! empty( $arguments['options'] ) && is_array( $arguments['options'] ) ) {
            $options_markup = '';
            foreach ( $arguments['options'] as $key =>  $label ) {
                $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false), $label );
            }

            printf( '<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup );
        }
        break;
        case 'radio':
        if ( ! empty( $arguments['options'] ) && is_array( $arguments['options'] ) ) {
            $options_markup = '';
            $iterator = 0;
            foreach( $arguments['options'] as $key => $label ) {
                $iterator++;
                $options_markup .= sprintf(
                    '<label for="%1$s_%5$s">
                    <input type="%2$s" name="%1$s" value="%6$s" id="%1$s_%5$s" %3$s />
                    %4$s
                    </label><br />',
                                $arguments['uid'], //1
                                $arguments['type'], //2
                                checked($value, $key, false), //3
                                $label, //4
                                $iterator, //5
                                $key //6
                            );
            }
            printf( '<fieldset>%s</fieldset>', $options_markup );

        }
        break;
        case 'upload':

        printf( '<input name="%1$s" type="text" id="%1$s" value="%2$s"/>
            <button class="upload-button" type="button" >%3$s</button>

            <br/>
            <img id="chi-media-upload-image" class="" src="%2$s" style="max-width: 300px;" />',$arguments['uid'],$value, __("Choose Image", "C-HIL"));


        wp_enqueue_media();

        break;
        case 'color':
        printf('<input name="%1$s" type="text" value="%2$s" class="my-color-field" />',$arguments['uid'], $value);
        break;
    }



    if( $helper = $arguments['helper'] ){
        printf( '<span class="helper chi-helper">%s</span>', $helper );

    };

    if ( $supplemental = $arguments['supplemental'] ) {
        printf( '<p class="description">%s</p>', $arguments['supplemental']);
    };
}

public function create_plugin_settings_page() {
    $page_title = __('Coded Hero Image Lite Settings',"C-HIL");
    $menu_title =  __('Coded Hero Image Lite',"C-HIL");
    $capability =   'manage_options';
    $slug       = 'chi_fields';
    $callback   = array($this, 'plugin_settings_page_content' );
    $icon       =  plugin_dir_url(__FILE__)  . '/img/coded_icon.png';
    $position   =   100;

    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
}
public function plugin_settings_page_content(){
    ?>
    <div class="wrap">
        <h2><?php _e("Coded Hero Image Settings","C-HIL"); ?></h2>
        <p><a href="https://coded.co.nz/product/coded-hero-image"><?php _e("Unlock more features by getting Coded Hero Image Premium", "C-HIT"); ?></a></p>

        <form method="post" action="options.php">
            <?php
            settings_errors();
            settings_fields('chi_fields');
            do_settings_sections('chi_fields');


            submit_button();
            ?>
        </form>
        <p><a href="https://coded.co.nz/product/hero-image">Unlock more features by getting Coded Hero Image Premium</a></p>
        </div><!-- /.wrap --><?php

    }

}

new chi_settings_plugin();

function chi_get_settings() {

	$heroimage_settings = array(
			'general'	=> array(
				'pages'	=> get_option('chi_display_option'),
                'text-align'        => get_option('chi_text_align'),

			),
            'mobile'    => array(

                'height'    => get_option('chi_mobile_height'),
                'title-size'     => get_option('chi_mobile_title_size'),

            ),
	        'image'		=> array(
	        	'url'	=>	get_option('chi_image_upload'),
	        	'height'	=>	get_option('chi_image_height'),

	        ),
	        'title'		=> array(
	        	'text'	=>	get_option('chi_title'),
	        	'size'	=>	get_option('chi_title_font-size'),
	        	'font'	=>	get_option('chi_title_font-family'),
	        	'color'	=> 	get_option('chi_title_color'),

	        ),


	);


	return $heroimage_settings;
}


function  chi_hero_image_content(){
	$s = chi_get_settings();



	$r  =	'<div style="display:none">';
	$r .=		'<div id="gdt-page-start">';
	$r .=		'<div id="gdt-page-start-text">';
	$r .=		'<h1>'  . $s['title']['text'] . ' </h1>';
	$r .=		'</div>';
	$r .=	'</div>';
 	$r .=	'</div>';

	if ($s['general']['pages'] == 'all'){
		echo $r;
	} else if ($s['general']['pages'] == 'home'){
		if ( is_front_page() ){
			echo $r;
		} else 	{
			return;
		}

	} else {
		return;
	}


}

add_action('wp_footer', 'chi_hero_image_content');


function chi_enqueue_scripts () {
	// wp_enqueue_style('Dynamic_Stylesheet', plugin_dir_url(__file__) . '/stylesheets/dynamic_style.php' );
	wp_enqueue_script('hero_image_js', plugin_dir_url(__file__) . '/js/heroImage.js', array('jquery'), '1.0.0', true);
	wp_enqueue_style('hero_image_style', plugin_dir_url(__file__) . '/stylesheets/style.css' );

	chi_dynamic_css();
}

add_action('wp_enqueue_scripts', 'chi_enqueue_scripts');


function chi_enqueue_admin_scripts() {
	wp_enqueue_script('Media Upload', plugin_dir_url(__FILE__) . 'js/mediaUpload.js', array('jquery','wp-color-picker'), '1.0.0', true);
	wp_enqueue_style('CPI_Admin_Style', plugin_dir_url(__FILE__) . 'stylesheets/admin.css');
}

add_action('admin_enqueue_scripts', 'chi_enqueue_admin_scripts');


function chi_dynamic_css(){
	$s = chi_get_settings();
	$img_url = $s['image']['url'];
	$img_h = $s['image']['height'];
	$title_ff = $s['title']['font'];
	$title_sz = $s['title']['size'] . 'px';
	$title_co = $s['title']['color'];
    $txt_pos = ( $img_h * 0.4 ). 'px' ;
    $txt_al = $s['general']['text-align'];
    $mob_height = $s['mobile']['height'];
    $mob_t_s = $s['mobile']['title-size'] . 'px';
    $mob_pos = ( $mob_height * 0.4 ). 'px';


        $mobile = "
            @media only screen and (max-width: 980px) {

            #wtfdivi004-page-start-img, #myprefix-page-start-img {
            display: block !important;
            width: 100%;
            }
                #top-header,
                #main-header {
                    position: relative !important;
                    top: 0 !important;
            }
            #page-container {
                padding-top: 0 !important;
            }
            #gdt-page-start {
                height: {$mob_height}px;
            }
            #gdt-page-start-text h1 {

                font-size: {$mob_t_s};
                // top: {$mob_pos};

            }
            #gdt-page-start-text h3 {

                font-size: {$mob_st_s};
                top: {$mob_pos};

            }
        }";



	$custom_css = "#gdt-page-start {
		background:url('{$img_url}');
		background-size: cover;
		background-repeat: no-repeat;
		height: {$img_h}px;
	}
	#gdt-page-start-text h1 {
		font-family: {$title_ff};
		font-size: {$title_sz};
		color: {$title_co};
        text-align: {$txt_al};
        position: relative;
        top: {$txt_pos};
        margin: 0 1rem;
	}


	" . $mobile;

	wp_add_inline_style('hero_image_style', $custom_css);

}

function chi_font_array() {
	return array(
                    'arial'             =>  'Arial',
                    'bookman'           =>  'Bookman',
                    'comic sans ms'     =>  __('Comic Sans', "C-HIL"),
                    'courier'           =>  'Courier',
                    'garamond'          =>  'Garamond',
                    'georgia'           =>  'Georgia',
                    'helvetica'         =>  'Helvetica',
                    'impact'            =>  'Impact',
                    'platino'           =>  'Platino',
                    'times'             =>  'Times',
                    'times new roman ms'   =>  'Times New Roman',
                    'trebuchet ms'      =>  'Trebuchet',
                    'verdana'           =>  'Verdana',

                );
}
