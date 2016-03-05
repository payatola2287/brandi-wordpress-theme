<?php
/**
 * The header for our theme.
 *
 * @package brandi
 */
/** 
    THEME OPTIONS
**/
$logoSrc = '';
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
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'brandi' ); ?></a>
            <header id="masthead" class="site-header" role="banner">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <header class="navbar-header site-branding">
                            <?php if ( is_front_page() && is_home() ) : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">
                                    <?php if( $logoSrc == '' ):

                                    bloginfo( 'name' );

                                    else: ?>

                                    <img src="<?php echo $logoSrc; ?>" alt="<?php echo bloginfo( 'name' ); ?>" class="logo"/>

                                    <?php endif ;?>
                                </a>
                            </h1>
                            <?php else : ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </p>
                            <?php endif; ?>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-wrapper" aria-expanded="false">
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </header>
                        <p class="navbar-text hidden-sm hidden-xs tagline"><?php bloginfo( 'description' ); ?></p>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container_id' => 'main-nav-wrapper',
                            'container_class' => 'collapse navbar-collapse',
                            'menu_id' => 'main-menu',
                            'menu_class' => 'nav navbar-nav navbar-right',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker()
                        ) );
                        ?>
                    </div>
                </nav>
            </header><!-- #masthead -->

            <div id="content" class="site-content">
                <div class="container" id="main-content-wrapper">
                    <div class="row"></div>