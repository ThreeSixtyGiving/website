<?php

add_theme_support( 'post-thumbnails' );

// Add custom stylesheet
function tsg_enqueue_style() {
    wp_enqueue_style( '360giving-style', get_template_directory_uri() . '/assets/css/styles.css', false );
    wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false );
    wp_enqueue_script( '360g-top-bar', get_template_directory_uri() . '/assets/js/top-bar.js', false );
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
            'footer-menu-2' => __( 'Footer Menu 2' ),
            'footer-menu-terms' => __( 'Footer Terms and Conditions Menu' ),
            'top-bar-menu' => __( 'Top bar menu' ),
            'off-canvas-menu' => __( 'Off canvas menu' ),
        )
    );

    register_post_meta( 'page', 'tsg_page_kicker', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ) );
    register_post_meta( 'page', 'tsg_page_blurb', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ) );
}
add_action( 'init', 'tsg_register_menus' );

// load other functions files
function tsg_bootstrap(){  
    locate_template( array( 'functions/breadcrumbs.php' ), true, true );
    locate_template( array( 'functions/customiser.php' ), true, true );
    locate_template( array( 'functions/fp-widgets.php' ), true, true );
    locate_template( array( 'functions/gutenberg.php' ), true, true );
    locate_template( array( 'functions/users.php' ), true, true );
    locate_template( array( 'functions/api.php' ), true, true );
    locate_template( array( 'functions/get-numbers.php' ), true, true );
    locate_template( array( 'functions/metabox.php' ), true, true );
    
    // add custom colours
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'Orange', 'tsgLangDomain' ),
            'slug' => 'orange',
            'color' => '#DE6E26',
        ),
        array(
            'name' => __( 'Teal', 'tsgLangDomain' ),
            'slug' => 'teal',
            'color' => '#4DACB6',
        ),
        array(
            'name' => __( 'Yellow', 'tsgLangDomain' ),
            'slug' => 'yellow',
            'color' => '#EFC329',
        ),
        array(
            'name' => __( 'Red', 'tsgLangDomain' ),
            'slug' => 'red',
            'color' => '#BC2C26',
        ),
    ) );
}
add_action( 'after_setup_theme', 'tsg_bootstrap' );
