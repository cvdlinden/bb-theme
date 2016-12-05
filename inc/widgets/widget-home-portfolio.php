<?php
/**
 * Homepage Portfolio Widget
 *
 * @package BijBest
 */

/**
 * Homepage Portfolio Widget Class.
 *
 * @see WP_Widget
 */
class BB_Home_Portfolio extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb_home_portfolio','description' => esc_html__( 'Porfolio for Home Widget Section', 'bb' ) );
		parent::__construct( 'bb_home_portfolio', esc_html__( '[BB] Porfolio for Home Widget Section','bb' ), $widget_ops );
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
		$body_content = isset( $instance['body_content'] ) ? $instance['body_content'] : '';

		// Only start working if JetPack Portfolio content type is activated.
		if ( post_type_exists( 'jetpack-portfolio' ) ) {

			echo $args['before_widget'];

			/**
			* Widget Content
			*/
			?>
			<section class="projects bg-dark pb0">
				<div class="container">
					<div class="col-sm-12 text-center">
						<h3 class="mb32"><?php echo $title; ?></h3>
						<p class="mb40"><?php echo $body_content; ?></p>
					</div>
				</div><?php

				$portfolio_args = array(
					'post_type' => 'jetpack-portfolio',
					'posts_per_page' => 10,
					'ignore_sticky_posts' => 1,
				);

				$portfolio_query = new WP_Query( $portfolio_args );

				if ( $portfolio_query->have_posts() ) : ?>

				<div class="row masonry-loader fixed-center fadeOut">
					<div class="col-sm-12 text-center">
						<div class="spinner"></div>
					</div>
				</div>
				<div class="row masonry masonryFlyIn fadeIn"><?php

					while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

					if ( has_post_thumbnail() ) { ?>
					<div class="col-md-3 col-sm-6 masonry-item project fadeIn">
						<div class="image-tile inner-title hover-reveal text-center">
							<a href="<?php esc_attr( the_permalink() ); ?>" title="<?php esc_attr( the_title_attribute() ); ?>">
								<?php the_post_thumbnail( 'full' ); ?>
								<div class="title"><?php
									the_title( '<h5 class="mb0">', '</h5>' );

									$terms = get_the_terms( get_the_ID(), 'jetpack-portfolio-type' );
									if ( $terms ) {
										$out = array();
										foreach ( $terms as $term ) {
											$out[] = '<span>' . $term->name . '</span>';
										}
										echo join( ' / ', $out );
									}
									?>
								</div>
							</a>
						</div>
					</div><?php
					}
					endwhile; ?>
				</div><?php
				endif;
				wp_reset_postdata(); ?>
			</section>

			<?php
			echo $args['after_widget'];

		} else {
			echo '<div class="container"><div class="row"><div class="col-sm-12 text-center"><div class="alert alert-warning">Please activate the JetPack Portfolio Content Type in order to see the portfolio.</div></div></div></div>';
		}
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) {
			$instance['title'] = '';
		}
		if ( ! isset( $instance['body_content'] ) ) {
			$instance['body_content'] = '';
		}
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title ','bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>"><?php esc_html_e( 'Content ', 'bb' ) ?></label>
			<textarea   name="<?php echo esc_attr( $this->get_field_name( 'body_content' ) ); ?>"
						id="<?php $this->get_field_id( 'body_content' ); ?>"
						class="widefat"><?php echo esc_attr( $instance['body_content'] ); ?></textarea>
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
		$instance['body_content'] = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses_post( $new_instance['body_content'] ) : '';

		return $instance;
	}

}

?>
