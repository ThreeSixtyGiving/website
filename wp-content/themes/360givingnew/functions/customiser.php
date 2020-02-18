<?php

define('TSG_DEFAULTS', array(
    "funder_count" => 120,
    "recipient_count" => 199000,
    "grant_count" => 349000,
    "grant_amount" => 30000000000,
    'cards_tagline' => 'We help organisations openly publish grants data, and help people
                        use it to improve charitable giving. Join the <a href="#">#opengrants</a> movement.',
    'site_description' => '360 Resources is a repository of resources to help Data Champions make better informed decisions by leveraging other people’s experiences.'
));

function tsg_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'tsg_site_description', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['site_description']
    ) );
    $wp_customize->add_control( 'tsg_site_description', array(
        'label' => __( 'Site description' ),
        'type' => 'textarea',
        'section' => 'title_tagline',
    ) );
    $wp_customize->add_setting( 'tsg_cards_tagline', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['cards_tagline']
    ) );
    $wp_customize->add_control( 'tsg_cards_tagline', array(
        'label' => __( 'Tagline' ),
        'type' => 'textarea',
        'section' => 'static_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_funder_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['funder_count'],
    ) );
    $wp_customize->add_control( 'tsg_funder_count', array(
        'label' => __( 'Funders' ),
        'type' => 'number',
        'section' => 'static_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_recipient_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['recipient_count'],
    ) );
    $wp_customize->add_control( 'tsg_recipient_count', array(
        'label' => __( 'Recipients' ),
        'type' => 'number',
        'section' => 'static_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_grant_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['grant_count'],
    ) );
    $wp_customize->add_control( 'tsg_grant_count', array(
        'label' => __( 'Grants' ),
        'type' => 'number',
        'section' => 'static_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_grant_amount', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['grant_amount'],
    ) );
    $wp_customize->add_control( 'tsg_grant_amount', array(
        'label' => __( 'Grant amount' ),
        'description' => __( 'In £. Don\'t include a £ symbol.' ),
        'type' => 'number',
        'section' => 'static_front_page',
    ) );
}
add_action( 'customize_register', 'tsg_customize_register' );