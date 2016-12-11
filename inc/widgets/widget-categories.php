<?php
/**
 * Categories Widget
 *
 * @package BijBest
 */

/**
 * Categories Widget Class.
 *
 * @see WP_Widget
 */
class BB_Categories extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb-cats','description' => esc_html__( 'Bij Best Categories' ,'bb' ) );
		parent::__construct( 'bb-cats', esc_html__( '[BB] Categories','bb' ), $widget_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Categories' , 'bb' );
		$enable_count = '';
		if ( isset( $instance['enable_count'] ) ) {
			$enable_count = $instance['enable_count'] ? $instance['enable_count'] : 'checked';
		}

		$limit = ($instance['limit']) ? $instance['limit'] : 4;

		echo $args['before_widget'];
		echo $args['before_title'] . $title . $args['after_title'];

		/**
		* Widget Content
		*/
		?>

		<div class="cats-widget nolist">

			<ul class="category-list"><?php
				if ( '' != $enable_count ) {
					$cat_args = array(
						'echo' => 0,
						'show_count' => 1,
						'title_li' => '',
						'depth' => 1,
						'orderby' => 'count',
						'order' => 'DESC',
						'number' => $limit,
					);
				} else {
					$cat_args = array(
						'echo' => 0,
						'show_count' => 0,
						'title_li' => '',
						'depth' => 1,
						'orderby' => 'count',
						'order' => 'DESC',
						'number' => $limit,
					);
				}
				$variable = wp_list_categories( $cat_args );
				$variable = str_replace( '(' , '<span>', $variable );
				$variable = str_replace( ')' , '</span>', $variable );
				echo $variable; ?>
			</ul>

		</div><!-- end widget content -->

		<?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) { $instance['title'] = esc_html__( 'Categories' , 'bb' );
		}
		if ( ! isset( $instance['limit'] ) ) { $instance['limit'] = 4;
		}
		if ( ! isset( $instance['enable_count'] ) ) { $instance['enable_count'] = '';
		}
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ','bb' ) ?></label>

			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"> <?php esc_html_e( 'Limit Categories ','bb' ) ?></label>

			<input  type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>"
					id="<?php $this->get_field_id( 'limit' ); ?>"
					class="widefat" />
		</p>

		<p><label>
			<input  type="checkbox"
					name="<?php echo esc_attr( $this->get_field_name( 'enable_count' ) ); ?>"
					id="<?php $this->get_field_id( 'enable_count' ); ?>" <?php if ( '' != $instance['enable_count'] ) { echo 'checked=checked ';} ?>
			/>
			<?php esc_html_e( 'Enable Posts Count','bb' ) ?></label>
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) && is_numeric( $new_instance['limit'] )  ) ? esc_html( $new_instance['limit'] ) : '';

		return $instance;
	}
}

?>
