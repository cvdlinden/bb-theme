<?php
/**
 * Social Widget
 *
 * @package BijBest
 */

/**
 * Social Widget Class.
 *
 * @see WP_Widget
 */
class BB_Social_Widget extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb-social','description' => esc_html__( 'Social Widget' ,'bb' ) );
		parent::__construct( 'bb-social', esc_html__( '[BB] Social Widget', 'bb' ), $widget_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Follow us' , 'bb' );

		echo $args['before_widget'];
		echo $args['before_title'] . $title . $args['after_title'];

		/**
		* Widget Content
		*/
		?>

		<!-- social icons -->
		<div class="social-icons sticky-sidebar-social">

			<?php bb_social_icons(); ?>

		</div><!-- end social icons -->

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) {
			$instance['title'] = esc_html__( 'Follow us' , 'bb' );
		}
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<?php
	}

}

?>
