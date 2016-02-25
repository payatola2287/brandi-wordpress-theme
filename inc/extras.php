<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package brandi
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function brandi_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'brandi_body_classes' );

/**
 * Returns the company brand
 * @return html or bloginfo
 */
function get_company_brand(){
    $company_brand = '';
    $theme_options = TitanFramework::getInstance( 'brandi' );
    $logoAttachmentID = $theme_options->getOption( 'logo' );
    $logo = $logoAttachmentID;
    if ( is_numeric( $logoAttachmentID ) ) {
        $imageAttachment = wp_get_attachment_image_src( $logoAttachmentID );
        $logo = $imageAttachment[0];
        ob_start();
    ?>
            <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="logo" />
    <?php
        $company_brand = ob_get_clean(); 
    }else{
        $company_brand = get_bloginfo( 'name' );
    }
    return $company_brand;
}

/**
 *  Adding Favicon
 */
function display_favicon(){
    $theme_options = TitanFramework::getInstance( 'brandi' );
    $attachmentID = $theme_options->getOption( 'favicon' );
    $imageSrc = $attachmentID; // For the default value
    if ( is_numeric( $attachmentID ) ) {
        $imageAttachment = wp_get_attachment_image_src( $attachmentID );
        $imageSrc = $imageAttachment[0];
    }
    ?>
        <!--[if IE]><link rel="shortcut icon" href="<?php echo esc_url( $imageSrc ); ?>"><![endif]-->
        <link rel="icon" href="<?php echo esc_url( $imageSrc ); ?>">
        <link rel="apple-touch-icon" href="<?php echo esc_url( $imageSrc ); ?>">
    <?php
    
}
add_action( 'wp_head','display_favicon' );

/**
 *  Filter for the main nav classes
 */
function get_main_nav_classes( $class = '' ){
    $theme_options = TitanFramework::getInstance( 'brandi' );
    $site_nav_style =  $theme_options->getOption( 'nav_style' );
    $classes = array(
        'navbar',
        'site-nav',
        'main-nav',
        $site_nav_style
    );
    if( !is_array( $class ) && is_string( $class ) ){
        $classes[] = $class;
    }else if( is_array( $class ) ){
        $classes = array_merge( $classes,$class );
    }
    
    $classes = apply_filters( 'main_nav_class',$classes );
    
    return $classes;
}

/**
 *  Main Nav Class
 */
function main_nav_class( $class = '' ){
     echo 'class="' . join( ' ', get_main_nav_classes( $class ) ) . '"';
}