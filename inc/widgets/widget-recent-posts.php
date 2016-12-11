<?php
/**
 * Top Posts Widget
 *
 * @package BijBest
 */

/**
 * Top Posts Widget Class.
 *
 * @see WP_Widget
 */
class BB_Recent_Posts extends WP_Widget {

	/**
	 * PHP5 constructor.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'bb-recent-posts', 'description' => esc_html__( 'Widget to show recent posts with thumbnails', 'bb' ) );
		parent::__construct( 'bb_recent_posts', esc_html__( '[BB] Recent Posts', 'bb' ), $widget_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'bb' );
		$limit = isset( $instance['limit'] ) ? $instance['limit'] : 5;

		echo $args['before_widget'];
		?>

		<section class="bg-secondary">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h3><?php echo $title; ?></h3>

							<?php
							/**
							* Widget Content
							*/
							?>

							<!-- recent posts -->
							<div class="recent-posts-wrapper nolist">

								<?php
								$featured_args = array(
									'posts_per_page' => $limit,
									'post_type' => 'post',
									'ignore_sticky_posts' => 1,
								);

								$featured_query = new WP_Query( $featured_args );
								$bootstrap_col_width = floor( 12 / $featured_query->post_count );
								if ( $featured_query->have_posts() ) : ?>

									<ul class="link-list list-inline recent-posts"><?php

									while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

										<?php if ( get_the_content() != '' ) : ?>

										<!-- content -->
										<li class="post-content col-sm-<?php echo esc_attr( $bootstrap_col_width ); ?>">
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<?php if ( has_post_thumbnail() ) {
													the_post_thumbnail();
												} ?>
												<?php echo get_the_title(); ?>
											</a>
											<span class="date"><?php echo get_the_date( 'd M , Y' ); ?></span>
										</li>
										<!-- end content -->

										<?php endif; ?>

									<?php endwhile; ?>

									</ul><?php

								endif;
								wp_reset_query();
								?>

							</div> <!-- end posts wrapper -->

					</div>
				</div><!--end of row-->
			</div>
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

		if ( ! isset( $instance['title'] ) ) {
			$instance['title'] = esc_html__( 'Recent Posts', 'bb' );
		}
		if ( ! isset( $instance['limit'] ) ) {
			$instance['limit'] = 5;
		}
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					id="<?php $this->get_field_id( 'title' ); ?>"
					class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Limit Posts Number', 'bb' ) ?></label>
			<input  type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>"
					id="<?php $this->get_field_id( 'limit' ); ?>"
					class="widefat" />
		<p>

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
