<?php
/**
 * Homepage Call for Action Widget
 *
 * @package BijBest
 */

/**
 * Homepage Call for Action Widget Class.
 *
 * @see WP_Widget
 */
class BB_Home_CfA extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb_home_CFA','description' => esc_html__( 'Call for Action Section' ,'bb' ) );
		parent::__construct( 'bb_home_CFA', esc_html__( '[BB] Call for Action Section For FrontPage','bb' ), $widget_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$button = isset( $instance['button'] ) ? $instance['button'] : '';
		$button_link = isset( $instance['button_link'] ) ? $instance['button_link'] : '';

		echo $args['before_widget'];

		/**
		* Widget Content
		*/
	?>
	<?php if ( '' != $title ) : ?>
		<section class="cfa-section bg-secondary">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<div class="overflow-hidden">
							<div class="col-sm-9">
									<h3 class="cfa-text"><?php echo $title; ?></h3>
							</div>
							<div class="col-sm-3">
									<a href="<?php echo esc_attr( $button_link ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="btn btn-lg btn-filled cfa-button"><?php echo esc_html( $button ); ?></a>
							</div>
						</div>
					</div>
				</div><!--end of row-->
			</div><!--end of container-->
		</section><?php
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) { $instance['title'] = '';
		}
		if ( ! isset( $instance['button'] ) ) { $instance['button'] = '';
		}
		if ( ! isset( $instance['button_link'] ) ) { $instance['button_link'] = '';
		}
	?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Callout Text ','bb' ) ?></label>

		<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				id="<?php $this->get_field_id( 'title' ); ?>"
				class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>"><?php esc_html_e( 'Button Text ','bb' ) ?></label>

		<input  type="text" value="<?php echo esc_attr( $instance['button'] ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>"
				id="<?php $this->get_field_id( 'button' ); ?>"
				class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_html_e( 'Button Link ','bb' ) ?></label>

		<input  type="text" value="<?php echo esc_url( $instance['button_link'] ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>"
				id="<?php $this->get_field_id( 'button_link' ); ?>"
				class="widefat" />
		</p><?php
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? esc_html( $new_instance['button'] ) : '';
		$instance['button_link'] = ( ! empty( $new_instance['button_link'] ) ) ? esc_url( $new_instance['button_link'] ) : '';

		return $instance;
	}

}

?>
