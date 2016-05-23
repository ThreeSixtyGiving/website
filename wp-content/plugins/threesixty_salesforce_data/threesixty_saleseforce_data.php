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
        $publishers = array();
        foreach($dataset_list as $dataset) {
          $publishers[] = $dataset->publisher->name;
        }
        $publishers  = array_unique($publishers);
        sort($publishers);
        $html = "";          
        $html .=  '<table class="data-table tablesorter"><thead><tr><th class="sortless {sorter: false}">Logo</th><th class="header headerSortUp">Organisation</th><th class="header">Data</th><th class="header">License</th></tr></thead><tbody>';
        foreach ($publishers as $publisher) {
          $count = 0;
          $license = "";
          foreach($dataset_list as $dataset) {
            if ($dataset->publisher->name == $publisher) {
              $count ++;
              if ($count == 1) {
                  $html .= '<tr>';
                  if($dataset->publisher->logo != "") {
                      $html .= '<td class="logo-cell"><img src="'. esc_url( $dataset->publisher->logo) .'" width="100" height="100", alt="'. esc_html( $dataset->publisher->name ) .' logo"/></td>';
                  } else {
                      $html .= '<td class="logo-cell">&nbsp;</td>';
                  }
                  $html .= '<td>'. esc_html( $dataset->publisher->name) .'</td>';
                  if ($dataset->license && $dataset->license != Null) {
                    if ($dataset->license_name && $dataset->license_name != Null) {
                      $licence_name = esc_html($dataset->license_name);
                    } else {
                      $licence_name = esc_html($dataset->license);
                    }
                    
                    $license .='<a href="'. esc_html($dataset->license) . '">' . $licence_name . '</a>';
                  } else {
                    $license = "This licence is pending. Please contact the organisation directly to confirm any restrictions on using their 360Giving data";
                  }
              $html .= '<td>';
              }
              
              $html .= '<a href="'. esc_url( $dataset->distribution[0]->downloadURL ) .'">'. esc_html( $dataset->distribution[0]->title ) .'</a><br/>';
            }
              
          }
          $html .='</td>';
          $html .='<td>'. $license .'</td>';
          $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        
        return $html;
}
add_shortcode('datasets', 'list_datasets');
