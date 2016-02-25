<?php

/*
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 * @see	http://www.titanframework.net/get-started/
 */


add_action( 'tf_create_options', 'brandi_create_options' );

/**
 * Initialize Titan & options here
 */
function brandi_create_options() {

	$titan = TitanFramework::getInstance( 'brandi' );
	
	
	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */
	
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Theme Options', 'brandi' ),
	) );
	
    
    
	$section->createOption( array(
	    'name' => __( 'Headings Font', 'brandi' ),
	    'id' => 'headings_font',
	    'type' => 'font',
	    'desc' => __( 'Select the font for all headings in the site', 'brandi' ),
		'show_color' => false,
		'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => 'Open Sans',
	    ),
		'css' => 'h1, h2, h3, h4, h5, h6 { value }',
	) );
    
    
	
	
	/**
	 * Create an admin panel & tabs
	 * You should put options here that do not change the look of your theme
	 */
	
	$adminPanel = $titan->createAdminPanel( array(
	    'name' => __( 'Theme Settings', 'brandi' ),
	) );
	
	$generalTab = $adminPanel->createTab( array(
	    'name' => __( 'General', 'brandi' ),
	) );
	$generalTab->createOption( array(
	    'name' => __( 'Logo', 'brandi' ),
	    'id' => 'logo',
	    'type' => 'upload',
	    'desc' => __( 'Upload your logo. Leaving this blank will use your site name.', 'brandi' ),
	    'default' => get_template_directory_uri(). '/img/logo.png',
	) );
    $generalTab->createOption( array(
	    'name' => __( 'Favicon', 'brandi' ),
	    'id' => 'favicon',
	    'type' => 'upload',
	    'desc' => __( 'Upload your logo. Leaving this blank will use your site name.', 'brandi' ),
	    'default' => get_template_directory_uri(). '/img/favicon.ico',
	) );
	$generalTab->createOption( array(
	    'name' => __( 'Custom Javascript Code', 'brandi' ),
	    'id' => 'custom_js',
	    'type' => 'code',
	    'desc' => __( 'If you want to add some additional Javascript code into your site, add them here and it will be included in the frontend header. No need to add <code>script</code> tags', 'brandi' ),
	    'lang' => 'javascript',
	) );
	
	$generalTab->createOption( array(
	    'type' => 'save',
	) );
	
    $headerTab = $adminPanel->createTab( array(
	    'name' => __( 'Header', 'brandi' ),
	) );
    
    $headerTab->createOption( array(
	    'name' => __( 'Company Name Typography', 'brandi' ),
	    'id' => 'navbar_brand_text',
	    'type' => 'font',
	    'desc' => __( 'Select the font for your company name if you don\'t want to use a logo', 'brandi' ),
		'show_color' => true,
		'show_font_size' => true,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
        'show_preview' => false,
	    'default' => array(
	        'font-family' => 'Open Sans',
            'color' => '#fff',
            'font-size' => '25px'
	    ),
		'css' => '.navbar-brand{ value }',
	) );
    
	$headerTab->createOption( array(
	    'name' => __( 'Main Navigation Style', 'brandi' ),
	    'id' => 'nav_style',
	    'type' => 'select',
	    'desc' => 'The attachment of the navigation to the page',
        'options' => array(
            'navbar-fixed-top' => 'Fixed on top',
            'navbar-static-top' => 'Static',
        ),
        'default' => 'navbar-fixed-top',
	) );
    
    $headerTab->createOption( array(
	    'type' => 'save',
	) );
    
	$footerTab = $adminPanel->createTab( array(
	    'name' => __( 'Footer', 'brandi' ),
	) );
	
	$footerTab->createOption( array(
		'name' => __( 'Copyright Text', 'brandi' ),
		'id' => 'copyright',
		'type' => 'text',
		'desc' => __( 'Enter your copyright text here (sample only)', 'brandi' ),
	) );
	
	$footerTab->createOption( array(
	    'type' => 'save',
	) );
}