<?php
/*
* Plugin Name: ThreeSixtyGiving Data
* Description: Display a list of datasets based on data.json format
* Version: 1.0
* Author: Tim Davies
* Author URI: http://www.opendataservices.coop
*/

// Example 1 : WP Shortcode to display form on any page or post.
function list_datasets($atts, $content=null) {

        $datasets = get_transient( 'dcat-json-data' );
        if ( false === $datasets ) {
                $datasets = wp_remote_get("http://threesixtygiving.force.com/datastore/");
                set_transient( 'dcat-json-data', $datasets,60*60);
        }
        $dataset_list = json_decode(wp_remote_retrieve_body($datasets));
        $html =  '<table class="data-table tablesorter"><thead><tr><th class="sortless {sorter: false}">Logo</th><th class="header headerSortUp">Organisation</th><th class="header">Data</th></tr></thead><tbody>';
        foreach($dataset_list as $dataset) {
            $html .= '<tr>';
            if($dataset->publisher->logo != "") {
                $html .= '<td class="logo-cell"><img src="'. esc_url( $dataset->publisher->logo) .'" width="150" height="150", alt="'. esc_html( $dataset->publisher->name ) .' logo"/></td>';
            } else {
                $html .= '<td class="logo-cell">&nbsp;</td>';
            }
            $html .= '<td class="logo-cell">'. esc_html( $dataset->publisher->name) .'</td>';
            $html .= '<td class="logo-cell">'. esc_html( $dataset->publisher->name) .':<br/><a href="'. esc_url( $dataset->distribution[0]->downloadURL ) .'">'. esc_html( $dataset->distribution[0]->title ) .'</a></td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        
        return $html;
}
add_shortcode('datasets', 'list_datasets');
