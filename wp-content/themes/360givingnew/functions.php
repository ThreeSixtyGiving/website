

function 360giving_enqueue_style() {
    wp_enqueue_style( '360giving-style', 'assets/css/style.css', false );
}
add_action( 'wp_enqueue_scripts', '360giving_enqueue_style' );