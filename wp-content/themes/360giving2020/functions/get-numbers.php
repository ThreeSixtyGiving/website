<?php

// fetch numbers from status.json
function tsg_get_numbers(){
    $api_url = 'http://store.data.threesixtygiving.org/reports/daily_status.json';
    $request = wp_remote_get( $api_url );
    if( is_wp_error( $request ) ) {
        return false;
    }
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body, TRUE );
    $aggs = array(
        "funders"=>array(),
        "grant_count"=>0,
        "grant_amount"=>0,
        "funder_count"=>0
    );

    foreach($data as $file){
        $aggs["grant_count"] += $file["datagetter_aggregates"]["count"];
        $aggs["grant_amount"] += $file["datagetter_aggregates"]["currencies"]["GBP"]["total_amount"];
        if(!empty($file["datagetter_aggregates"]["distinct_funding_org_identifier"])){
            $aggs["funders"] = array_merge($aggs["funders"], $file["datagetter_aggregates"]["distinct_funding_org_identifier"]);
        }
    }

    $aggs["funder_count"] = count(array_unique($aggs["funders"]));
    // wp_cache_set( 'tsg_fp_numbers', $aggs );
    if($aggs['grant_count']>0){
        set_theme_mod('tsg_grant_count', $aggs['grant_count']);
    }
    if($aggs['grant_amount']>0){
        set_theme_mod('tsg_grant_amount', $aggs['grant_amount']);
    }
    if($aggs['funder_count']>0){
        set_theme_mod('tsg_funder_count', $aggs['funder_count']);
    }
    return $aggs;
}
add_action ('tsg_cron_hook', 'tsg_get_numbers');

// create a scheduled event for updating the numbers
function tsg_cronstarter_activation() {
	if( !wp_next_scheduled( 'tsg_cron_hook' ) ) {  
	   wp_schedule_event( time(), 'daily', 'tsg_cron_hook' );  
	}
}
add_action('wp', 'tsg_cronstarter_activation');

// unschedule event upon plugin deactivation
function tsg_cronstarter_deactivate() {	
	$timestamp = wp_next_scheduled ('tsg_cron_hook');
	wp_unschedule_event ($timestamp, 'tsg_cron_hook');
} 
register_deactivation_hook (__FILE__, 'tsg_cronstarter_deactivate');

function tsg_number_format($val){
    if($val > 1000000000) {
        return number_format($val / 1000000000, 0, ".", ",") . "bn";
    } elseif($val > 1000000) {
        return number_format($val / 1000000, 0, ".", ",") . "m";
    // } elseif($val > 10000) {
    //     return number_format($val / 1000, 0, ".", ",") . "k";
    } else {
        return number_format($val, 0, ".", ",");
    }
}