<?php
/**
 * Home Clients Widget
 *
 * @package BijBest
 */

/**
 * Home Clients Widget Class.
 *
 * @see WP_Widget
 */
class BB_Home_Clients extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb_home_clients','description' => esc_html__( 'Client Section That Displays Logos In A Slider' ,'bb' ) );
		parent::__construct( 'bb_home_clients', esc_html__( '[BB] Client Section For FrontPage','bb' ), $widget_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) && ! empty( $instance['title'] ) ? $instance['title'] : __( 'Our Main Clients','bb' );
		$logos = isset( $instance['client_logo'] ) ? $instance['client_logo'] : '';

		echo $args['before_widget'];

		/**
		 * Widget Content
		 */
		?>
		<?php if ( isset( $logos['img'] ) && count( $logos['img'] ) != 0 ) { ?>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h3 class="mb64 mb-xs-40"><?php echo $title; ?></h3>
					</div>
				</div>
				<!--end of row-->
				<div class="row">
					<div class="logo-carousel">
						<ul class="slides"><?php
						for ( $i = 0; $i < count( $logos['img'] ); $i++ ) {
							if ( '' != $logos['img'] && '' != $logos['link'] ) { ?>
								<li>
									<a href="<?php echo esc_attr( $logos['link'][ $i ] ); ?>">
										<img alt="<?php esc_attr_e( 'Logos', 'bb' ); ?>" src="<?php echo esc_attr( $logos['img'][ $i ] ); ?>" />
									</a>
								</li><?php
							}
						}?>
						</ul>
					</div>
					<!--end of logo slider-->
				</div>
				<!--end of row-->
			</div>
			<!--end of container-->
		</section>
		<?php } ?>

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
		if ( ! isset( $instance['client_logo']['img'] ) ) { $instance['client_logo']['img'] = array( '' ); }
		if ( ! isset( $instance['client_logo']['link'] ) ) { $instance['client_logo']['link'] = array( '' ); }
	?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<ul class="client-sortable clone-wrapper"><?php
			$image_src = $instance['client_logo']['img'];
			$logo_link = $instance['client_logo']['link'];
			$slider_count = ( isset( $image_src ) && count( $image_src ) > 0 ) ? count( $image_src ) : 3 ;

			for ( $i = 0; $i < $slider_count; $i++ ) : ?>
				<li class="toclone">
				<br>
					<label class="logo_heading"><b><?php esc_html_e( 'Logo #', 'bb' ); ?><span class="count"><?php echo absint( $i ) + 1; ?></span></b></label>
					<input name="<?php echo esc_attr( $this->get_field_name( 'client_logo' ) . '[img][' . $i . ']' );?>" id="<?php echo esc_attr( $this->get_field_id( 'image_src' ) . '-' . $i ); ?>" class="widefat image_src" type="hidden" size="36"  value="<?php echo (isset( $image_src[ $i ] )) ? esc_url( $image_src[ $i ] ) : ''; ?>" /><br>
					<button id="<?php echo esc_attr( $this->get_field_id( 'image_src_button' ) . '-' . $i ); ?>" class="button button-primary custom_media_button" data-fieldid="<?php echo esc_attr( $this->get_field_id( 'image_src' ) . '-' . $i ); ?>"><?php esc_html_e( 'Upload Logo','bb' ); ?></button>
					<img class="image_demo" id="img_demo_<?php echo esc_attr( $this->get_field_id( 'image_src' ) . '-' . $i ); ?>" width="50px" height="50px" style="border:0; margin-left: 20px; vertical-align: top;" src="<?php echo ( isset( $image_src[ $i ] ) ) ? esc_url( $image_src[ $i ] ) : ''; ?>" />
					<br/><br/>
					<label><?php esc_html_e( 'Link:', 'bb' ); ?></label>
					<input name="<?php echo esc_attr( $this->get_field_name( 'client_logo' ) . '[link][' . $i . ']' ); ?>" id="link<?php echo '-' . $i; ?>" class="widefat client-link" type="text" size="36"  value="<?php echo (isset( $logo_link[ $i ] )) ? esc_url( $logo_link[ $i ] ) : ''; ?>" /><br><br>

					<a href="#" class="clone button-primary"><?php esc_html_e( 'Add', 'bb' ); ?></a>
					<a href="#" class="delete button"><?php esc_html_e( 'Delete', 'bb' ); ?></a>
				</li>
			<?php endfor; ?>
		</ul><?php

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

		if ( isset( $new_instance['client_logo']['img'] ) && count( $new_instance['client_logo']['img'] ) != 0 ) {
			for ( $i = 0; $i < count( $new_instance['client_logo']['img'] ); $i++ ) {
				$instance['client_logo']['img'][ $i ] = ( ! empty( $new_instance['client_logo']['img'][ $i ] ) ) ? esc_url( $new_instance['client_logo']['img'][ $i ] ) : '';
			}
		}
		if ( isset( $new_instance['client_logo']['link'] ) && count( $new_instance['client_logo']['link'] ) != 0 ) {
			for ( $i = 0; $i < count( $new_instance['client_logo']['link'] ); $i++ ) {
				$instance['client_logo']['link'][ $i ] = ( ! empty( $new_instance['client_logo']['link'][ $i ] ) ) ? esc_url( $new_instance['client_logo']['link'][ $i ] ) : '';
			}
		}

		return $instance;
	}

}

?>
