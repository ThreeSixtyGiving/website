<?php

add_theme_support( 'post-thumbnails' );

// Add custom stylesheet
function tsg_enqueue_style() {
    wp_enqueue_style( '360giving-style', get_template_directory_uri() . '/assets/css/styles.css', false );
}
add_action( 'wp_enqueue_scripts', 'tsg_enqueue_style' );

// initialise widgets
function tsg_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Front page Sidebar', 'tsg' ),
        'id'            => 'tsg-front-page',
        'before_widget' => '<div class="grid__1"><div id="%1$s" class="base-card %2$s"><div class="base-card__content">',
        'after_widget'  => '</div></div></div>',
        'before_title'  => '<h2 class="base-card__title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'tsg' ),
        'id'            => 'tsg-footer',
        'before_widget' => '<div class="footer__column-2 footer__section">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer__heading">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'tsg_widgets_init' );

// register nav menus
function tsg_register_menus() {
    register_nav_menus(
        array(
            'footer-menu-1' => __( 'Footer Menu 1' ),
            'footer-menu-2' => __( 'Footer Menu 2' )
        )
    );
}
add_action( 'init', 'tsg_register_menus' );

// load other functions files
function tsg_bootstrap(){  
    locate_template( array( 'functions/customiser.php' ), true, true );
    locate_template( array( 'functions/fp-widgets.php' ), true, true );
}
add_action( 'after_setup_theme', 'tsg_bootstrap' );
