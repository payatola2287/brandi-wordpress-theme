<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brandi
 */

/**
 *  Theme Options
 */
$themeOptions = TitanFramework::getInstance( 'brandi' );
$logoAttachmentID = $themeOptions->getOption( 'logo' );
$logo = $logoAttachmentID;
if( is_numeric( $logoAttachmentID ) ){
    $attachmentLogo = wp_get_attachment_image_src( $logoAttachmentID );
    $logo = $attachmentLogo[0];
}


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'brandi' ); ?></a>
    <header class="site-header main-header " id="main-header">
        <nav <?php main_nav_class(); ?> id="main-nav" role="navigation">
            <div class="container">
                <header class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="navbar-brand"><a class="site-title" title ="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_company_brand(); ?></a></h1>
                    <?php else : ?>
                        <p class="navbar-brand site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>
                    <p class="tagline navbar-text">
                        <?php bloginfo( 'description' ); ?>
                    </p>
                </header>
                <?php 
                    wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','menu_class' => 'site-menu main-menu nav navbar-nav navbar-right','container_class'=>'collapse navbar-collapse', 'container_id'=>'main-menu' ) ); 
                ?>
            </div>
        </nav>
    </header>

	<div id="content" class="site-content">
