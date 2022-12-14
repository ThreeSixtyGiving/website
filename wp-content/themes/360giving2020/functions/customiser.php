<?php

define('TSG_DEFAULTS', array(
    "mailchimp_url" => "https://threesixtygiving.us10.list-manage.com/subscribe",
    "mailchimp_u" => "216b8b926250184f90c7198e8",
    "mailchimp_id" => "91870dde44",
    "mailchimp_email_field" => "EMAIL",
    "funder_count" => 120,
    "recipient_count" => 199000,
    "grant_count" => 349000,
    "grant_amount" => 30000000000,
    'footer_tagline' => 'Open data for more effective grantmaking',
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
    
    $wp_customize->add_section( 'tsg_front_page' , array(
        'title'      => __( '360Giving Front Page', 'tsg' ),
        'priority'   => 30,
    ) );
    $wp_customize->add_setting( 'tsg_footer_tagline', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['footer_tagline']
    ) );
    $wp_customize->add_control( 'tsg_footer_tagline', array(
        'label' => __( 'Footer tagline' ),
        'type' => 'textarea',
        'section' => 'tsg_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_cards_tagline', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['cards_tagline']
    ) );
    $wp_customize->add_control( 'tsg_cards_tagline', array(
        'label' => __( 'Front page tagline' ),
        'type' => 'textarea',
        'section' => 'tsg_front_page',
    ) );
    $wp_customize->add_setting( 'tsg_funder_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['funder_count'],
    ) );
    // $wp_customize->add_control( 'tsg_funder_count', array(
    //     'label' => __( 'Funders' ),
    //     'type' => 'number',
    //     'section' => 'tsg_front_page',
    // ) );
    $wp_customize->add_setting( 'tsg_recipient_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['recipient_count'],
    ) );
    // $wp_customize->add_control( 'tsg_recipient_count', array(
    //     'label' => __( 'Recipients' ),
    //     'type' => 'number',
    //     'section' => 'tsg_front_page',
    // ) );
    $wp_customize->add_setting( 'tsg_grant_count', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['grant_count'],
    ) );
    // $wp_customize->add_control( 'tsg_grant_count', array(
    //     'label' => __( 'Grants' ),
    //     'type' => 'number',
    //     'section' => 'tsg_front_page',
    // ) );
    $wp_customize->add_setting( 'tsg_grant_amount', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['grant_amount'],
    ) );
    // $wp_customize->add_control( 'tsg_grant_amount', array(
    //     'label' => __( 'Grant amount' ),
    //     'description' => __( 'In £. Don\'t include a £ symbol.' ),
    //     'type' => 'number',
    //     'section' => 'tsg_front_page',
    // ) );

    $wp_customize->add_section( 'tsg_mailchimp_section' , array(
        'title'      => __( 'Mailchimp newsletter signup', 'tsg' ),
        'priority'   => 30,
    ) );
    $wp_customize->add_setting( 'tsg_mailchimp_url', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['mailchimp_url'],
    ) );
    $wp_customize->add_control( 'tsg_mailchimp_url', array(
        'label' => __( 'Mailchimp URL' ),
        'description' => __( 'The url to post the mailchimp information to. From: https://mailchimp.com/help/host-your-own-signup-forms/.' ),
        'type' => 'url',
        'section' => 'tsg_mailchimp_section',
    ) );
    $wp_customize->add_setting( 'tsg_mailchimp_u', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['mailchimp_u'],
    ) );
    $wp_customize->add_control( 'tsg_mailchimp_u', array(
        'label' => __( 'User ID' ),
        'description' => __( 'The user ID for this signup form' ),
        'type' => 'text',
        'section' => 'tsg_mailchimp_section',
    ) );
    $wp_customize->add_setting( 'tsg_mailchimp_id', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['mailchimp_id'],
    ) );
    $wp_customize->add_control( 'tsg_mailchimp_id', array(
        'label' => __( 'Audience ID' ),
        'description' => __( 'The audience ID for this signup form' ),
        'type' => 'text',
        'section' => 'tsg_mailchimp_section',
    ) );
    $wp_customize->add_setting( 'tsg_mailchimp_email_field', array(
        'type' => 'theme_mod',
        'default' => TSG_DEFAULTS['mailchimp_email_field'],
    ) );
    $wp_customize->add_control( 'tsg_mailchimp_email_field', array(
        'label' => __( 'Mailchimp Email Field' ),
        'description' => __( 'The id of the email field' ),
        'type' => 'text',
        'section' => 'tsg_mailchimp_section',
    ) );
}
add_action( 'customize_register', 'tsg_customize_register' );