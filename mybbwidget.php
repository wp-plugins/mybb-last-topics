<?php

// Creating the widget 
class mybb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'mybb_widget', 

// Widget name will appear in UI
__('MyBB Widget', 'mybb'), 

// Widget description
array( 'description' => __( 'Mybb widget show last post', 'mybb' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
mybb_forum_last_wg();
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'mybb' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mybb' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class mybb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'mybb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );