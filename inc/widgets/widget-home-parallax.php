<?php
/**
 * Homepage parralax section Widget
 *
 * @package BijBest
 */

/**
 * Homepage parralax section Widget Class.
 *
 * @see WP_Widget
 */
class BB_Home_Parallax extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb_home_parallax','description' => esc_html__( 'FrontPage Parallax Section', 'bb' ) );
		parent::__construct( 'bb_home_parallax', esc_html__( '[BB] Parralax Section For FrontPage','bb' ), $widget_ops );
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
		$image_src = isset( $instance['image_src'] ) ? $instance['image_src'] : '';
		$image_pos = isset( $instance['image_pos'] ) ? $instance['image_pos'] : esc_html__( 'left' , 'bb' );
		$body_content = isset( $instance['body_content'] ) ? $instance['body_content'] : '';
		$button1 = isset( $instance['button1'] ) ? $instance['button1'] : '';
		$button2 = isset( $instance['button2'] ) ? $instance['button2'] : '';
		$button1_link = isset( $instance['button1_link'] ) ? $instance['button1_link'] : '';
		$button2_link = isset( $instance['button2_link'] ) ? $instance['button2_link'] : '';

		echo $args['before_widget'];

		/* Classes */
		$class_section = ( 'background-full' == $image_pos )  ? 'cover fullscreen image-bg' : ( ( 'background-small' == $image_pos ) ? 'small-screen image-bg' : ( ( 'right' == $image_pos ) ? 'bg-secondary' : ( ( 'bottom' == $image_pos ) ? 'bg-secondary' : '' ) ) );
		$class_pos_background_parallax = ( ( 'background-full' == $image_pos ) || ( 'background-small' == $image_pos ) ) ? 'top-parallax-section' : ( ( 'right' == $image_pos ) ? 'col-md-4 col-sm-5' : ( ( 'left' == $image_pos ) ? 'col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-1' : ( ( 'bottom' == $image_pos ) ? 'col-sm-10 col-sm-offset-1 text-center' : ( ( 'top' == $image_pos ) ? 'col-sm-10 col-sm-offset-1 text-center' : '' ) ) ) );
		$class_pos_background = ( ( 'background-full' == $image_pos ) || ( 'background-small' == $image_pos ) ) ? 'col-sm-10 col-sm-offset-1 text-center' : '';
		$class_pos = ( 'left' == $image_pos || 'right' == $image_pos ) ? 'row align-children' : 'row';
		$class_pos_right = ( 'right' == $image_pos ) ? 'col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center' : '';
		$class_pos_left = ( 'left' == $image_pos ) ? 'col-md-7 col-sm-6 text-center' : '';
		$class_fullscreen = ( 'background-full' == $image_pos ) ? 'fullscreen' : '';

		/**
		 * Widget Content
		 */
	?>
		<section class="<?php echo esc_attr( $class_section ); ?>" ><?php
			if ( ( 'background-full' == $image_pos || 'background-small' == $image_pos ) && '' != $image_src ) { ?>
				<div class="parallax-window <?php echo esc_attr( $class_fullscreen ); ?>" data-parallax="scroll" data-image-src="<?php echo esc_attr( $image_src ); ?>">
				<div class="<?php echo ( 'background-full' == $image_pos ) ? 'align-transform' : ''; ?>"><?php
			} else { ?>
				<div class="container"><?php
			} ?>

				<div class="<?php echo esc_attr( $class_pos ); ?>">

					<?php
						if ( ( 'left' == $image_pos || 'top' == $image_pos ) && '' != $image_src ) { ?>
						<div class="<?php echo esc_attr( $class_pos_left ); ?>">
							<img class="cast-shadow" alt="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_attr( $image_src ); ?>">
						</div><?php
					} ?>

					<div class="<?php echo esc_attr( $class_pos_background_parallax ); ?>">
						<div class="<?php echo esc_attr( $class_pos_background ); ?>">
							<?php
							echo ( '' != $title ) ? ( ( 'background-full' == $image_pos ) || ( 'background-small' == $image_pos ) ) ? '<h1>' . $title . '</h1>': '<h3>' . $title . '</h3>' : '';
							echo ( '' != $body_content ) ? '<p>' . $body_content . '</p>' : '';
							echo ( '' != $button1 && '' != $button1_link ) ? '<a class="btn btn-lg btn-primary" href="' . esc_attr( $button1_link ) . '">' . esc_html( $button1 ) . '</a>': '';
							echo ( '' != $button2 && '' != $button2_link ) ? '<a class="btn btn-lg btn-primary" href="' . esc_attr( $button2_link ) . '">' . esc_html( $button2 ) . '</a>': '';
							?>
						</div>
					</div>
					<!--end of row-->
					<?php
						if ( ( 'right' == $image_pos || 'bottom' == $image_pos ) && '' != $image_src ) { ?>
						<div class="<?php echo esc_attr( $class_pos_right ); ?>">
							<img class="cast-shadow" alt="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_attr( $image_src ); ?>">
						</div><?php
					} ?>
				</div>
			</div>
			<?php if ( 'background-full' == $image_pos || 'background-small' == $image_pos ) { ?>
			</div><?php
			} ?>
		</section>


		<?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) { $instance['title'] = ''; }
		if ( ! isset( $instance['image_src'] ) ) { $instance['image_src'] = ''; }
		if ( ! isset( $instance['image_pos'] ) ) { $instance['image_pos'] = 'left'; }
		if ( ! isset( $instance['body_content'] ) ) { $instance['body_content'] = ''; }
		if ( ! isset( $instance['button1'] ) ) { $instance['button1'] = ''; }
		if ( ! isset( $instance['button2'] ) ) { $instance['button2'] = ''; }
		if ( ! isset( $instance['button1_link'] ) ) { $instance['button1_link'] = ''; }
		if ( ! isset( $instance['button2_link'] ) ) { $instance['button2_link'] = ''; }
	?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'image_src' ) ); ?>"><?php esc_html_e( 'Image:', 'bb' ); ?></label>
			<input name="<?php echo esc_attr( $this->get_field_name( 'image_src' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>" class="widefat image_src" type="hidden" value="<?php echo esc_url( $instance['image_src'] ); ?>" /><br><br>
			<button id="<?php echo esc_attr( $this->get_field_id( 'image_src_button' ) ); ?>" class="button button-primary custom_media_button" data-fieldid="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>"><?php esc_html_e( 'Upload Image','bb' ); ?></button>
			<img class="image_demo" id="img_demo_<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>" width="100px" height="100px" style="margin-left: 20px; vertical-align: top;" src="<?php echo esc_url( $instance['image_src'] ); ?>" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>"><?php esc_html_e( 'Content ','bb' ) ?></label>
			<textarea   name="<?php echo esc_attr( $this->get_field_name( 'body_content' ) ); ?>"
						id="<?php $this->get_field_id( 'body_content' ); ?>"
						class="widefat"><?php echo esc_attr( $instance['body_content'] ); ?></textarea>
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'image_pos' ) ); ?>"><?php esc_html_e( 'Image Position ','bb' ) ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'image_pos' ) ); ?>"
					id="<?php $this->get_field_id( 'image_pos' ); ?>" class="widefat">
					<option value="left" <?php selected( $instance['image_pos'], 'left' ); ?>><?php esc_html_e( 'Left', 'bb' ); ?></option>
					<option value="right" <?php selected( $instance['image_pos'], 'right' ); ?>><?php esc_html_e( 'Right', 'bb' ); ?></option>
					<option value="top" <?php selected( $instance['image_pos'], 'top' ); ?>><?php esc_html_e( 'Top', 'bb' ); ?></option>
					<option value="bottom" <?php selected( $instance['image_pos'], 'bottom' ); ?>><?php esc_html_e( 'Bottom', 'bb' ); ?></option>
					<option value="background-full" <?php selected( $instance['image_pos'], 'background-full' ); ?>><?php esc_html_e( 'Background Full', 'bb' ); ?></option>
					<option value="background-small" <?php selected( $instance['image_pos'], 'background-small' ); ?>><?php esc_html_e( 'Background Small', 'bb' ); ?></option>
			</select>
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button1' ) ); ?>"><?php esc_html_e( 'Button 1 Text ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['button1'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'button1' ) ); ?>"
					id="<?php $this->get_field_id( 'button1' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button1_link' ) ); ?>"><?php esc_html_e( 'Button 1 Link ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_url( $instance['button1_link'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'button1_link' ) ); ?>"
					id="<?php $this->get_field_id( 'button1_link' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button2' ) ); ?>"><?php esc_html_e( 'Button 2 Text ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['button2'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'button2' ) ); ?>"
					id="<?php $this->get_field_id( 'button2' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'button2_link' ) ); ?>"><?php esc_html_e( 'Button 2 Link ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_url( $instance['button2_link'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'button2_link' ) ); ?>"
					id="<?php $this->get_field_id( 'button2_link' ); ?>"
					class="widefat" />
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
		$instance['image_src'] = ( ! empty( $new_instance['image_src'] ) ) ? esc_url( $new_instance['image_src'] ) : '';
		$instance['image_pos'] = ( ! empty( $new_instance['image_pos'] ) ) ? esc_html( $new_instance['image_pos'] ) : '';
		$instance['body_content'] = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses_post( $new_instance['body_content'] ) : '';
		$instance['button1'] = ( ! empty( $new_instance['button1'] ) ) ? esc_html( $new_instance['button1'] ) : '';
		$instance['button2'] = ( ! empty( $new_instance['button2'] ) ) ? esc_html( $new_instance['button2'] ) : '';
		$instance['button1_link'] = ( ! empty( $new_instance['button1_link'] ) ) ? esc_url( $new_instance['button1_link'] ) : '';
		$instance['button2_link'] = ( ! empty( $new_instance['button2_link'] ) ) ? esc_url( $new_instance['button2_link'] ) : '';

		return $instance;
	}
}

?>
