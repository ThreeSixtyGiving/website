<?php
 
class TSG_FrontPage_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'tsg-front-page-widget',  // Base ID
            '360Giving Front Page Box'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'TSG_FrontPage_Widget' );
        });
 
    }
 
    public $args = array(
        'before_widget' => '<div class="grid__1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="base-card__title | margin-bottom:1">',
        'after_title'   => '</h2>',
    );
 
    public function widget( $args, $instance ) {

        $colour = ! empty( $instance['colour'] ) ? $instance['colour'] : 'orange';

        echo $args['before_widget'];
        if(!empty( $instance['link'])){
            echo '<a href="' . $instance['link'] . '" class="base-card base-card--' . $colour . ' base-card--spacious">';
        } else {
            echo '<div id="%1$s" class="base-card base-card--' . $colour . ' base-card--spacious">';
        }
        echo '<div class="base-card__content">';
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        if(!empty( $instance['text'])){
            echo '<p class="base-card__text">';
            echo esc_html__( $instance['text'], 'text_domain' );
            echo '</p>';
        }
 
        echo '</div>';
        echo '</a>';
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
        $link = ! empty( $instance['link'] ) ? $instance['link'] : esc_html__( '', 'text_domain' );
        $link_text = ! empty( $instance['link_text'] ) ? $instance['link_text'] : esc_html__( '', 'text_domain' );
        $colour = ! empty( $instance['colour'] ) ? $instance['colour'] : 'orange';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'text_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php echo esc_html__( 'Link:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"><?php echo esc_html__( 'Link text:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'colour' ) ); ?>"><?php echo esc_html__( 'Box colour:', 'text_domain' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'colour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'colour' ) ); ?>">
                <option value="orange" style="background-color: #DE6E26;" <?php if($colour=='orange'): ?>selected="selected"<?php endif; ?>>Orange</option>
                <option value="teal" style="background-color: #4DACB6;" <?php if($colour=='teal'): ?>selected="selected"<?php endif; ?>>Teal</option>
                <option value="yellow" style="background-color: #EFC329;" <?php if($colour=='yellow'): ?>selected="selected"<?php endif; ?>>Yellow</option>
            </select>
        </p>
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['link'] = ( !empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
        $instance['link_text'] = ( !empty( $new_instance['link_text'] ) ) ? strip_tags( $new_instance['link_text'] ) : '';
        $instance['colour'] = ( !empty( $new_instance['colour'] ) ) ? strip_tags( $new_instance['colour'] ) : '';
 
        return $instance;
    }
 
}
$my_widget = new TSG_FrontPage_Widget();
?>