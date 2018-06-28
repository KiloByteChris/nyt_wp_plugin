<?php
/*
Plugin Name: New York Times Top Stories
Plugin URI: new-volume.com
Description: Widget that shows the current top stories from the New York Times
Author: chris@new-volume.com
Version: 1.0
*/
// Block direct requests
// This prevents somebody from opening the URL directly to the widget itself
if ( !defined('ABSPATH') )
	die('-1');

// Register the widget
// See Codex https://codex.wordpress.org/Function_Reference/register_widget
// Takes a class as a parameter
add_action( 'widgets_init', function(){
     register_widget( 'NYT_Top_Stories' );
});
/**
 * Adds My_Widget widget.
 */
// Codex: https://developer.wordpress.org/reference/classes/wp_widget/
class NYT_Top_Stories extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	// Class constructor
	function __construct() {
		parent::__construct(
			'NYT_Top_Stories', // Base ID
			__('NYT Top Stories', 'text_domain'), // Name
			array( 'description' => __( 'Widget that shows the current top stories from the New York Times', 'text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Codex: https://codex.wordpress.org/Widgets_API#Example
     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		// Check to see if any of the form controls are set already.
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		if ( $instance[ 'icon' ] == 'on') {
			$icon = $instance[ 'icon' ];
			$iconCheck == "checked";
		}
		else {
			$icon = "";
			$iconCheck == "";
		}
		if ( isset( $instance[ 'description' ] ) ) {
			$description = $instance[ 'description' ];
		}
		else {
			$description = "";
		}
		if ( isset( $instance[ 'temp' ] ) ) {
			$temp = $instance[ 'temp' ];
		}
		else {
			$temp = "";
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<!-- Check boxes that allow for the user to choose what weather information to display -->
		<h4>Display Options:</h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon: ' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="checkbox" value="<?php echo esc_attr( 'on' );?>" <?php echo $iconCheck ?>>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description: ' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="checkbox" value="<?php echo esc_attr( 'on' ); ?>">
			<label for="<?php echo $this->get_field_id( 'temp' ); ?>"><?php _e( 'Tempurature: ' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'temp' ); ?>" name="<?php echo $this->get_field_name( 'temp' ); ?>" type="checkbox" value="<?php echo esc_attr( 'on' ); ?>">
		</p>
		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 'off';
		$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : 'off';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : 'off';
		$instance['temp'] = ( ! empty( $new_instance['temp'] ) ) ? strip_tags( $new_instance['temp'] ) : 'off';
		return $instance;
	}
} // class My_Widget
