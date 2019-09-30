<?php
/**
*
*   WordPress Theme Framework by Logic Design
*
*   Codename: Project Loki
*
*   Copyright 2016 Logic Design under Propriatary License
*   Unauthorised use, reverse-engineering, copying, sharing is strictly prohibited.
*
**/

//attach our function to the wp_pagenavi filter
add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );

//customize the PageNavi HTML before it is output
function ik_pagination($html) {

    $out = '';

    //wrap a's and span's in li's
    $out = str_replace("<div","",$html);
    $out = str_replace("class='wp-pagenavi'>","",$out);
    $out = str_replace("<a","<li><a",$out);
    $out = str_replace("</a>","</a></li>",$out);
    $out = str_replace("<span","<li><span",$out);  
    $out = str_replace("</span>","</span></li>",$out);
    $out = str_replace("</div>","",$out);

    return '<nav class="pagination-nav"><ul class="pagination pagination-centered">'.$out.'</ul></nav>';

}