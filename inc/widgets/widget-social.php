<?php
/**
 * Social  Widget
 * Bij Best Theme
 */

class bb_social_widget extends WP_Widget {

	function __construct(){
		$widget_ops = array('classname' => 'bb-social','description' => esc_html__( "Social Widget" ,'bb') );
		parent::__construct('bb-social', esc_html__('[BB] Social Widget','bb'), $widget_ops);
	}

	function widget($args , $instance) {
		extract($args);
		$title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'bb');

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		* Widget Content
		*/
		?>

		<!-- social icons -->
		<div class="social-icons sticky-sidebar-social">

			<?php bb_social_icons(); ?>

		</div><!-- end social icons -->

		<?php
		echo $after_widget;
	}

	function form($instance) {
		if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'bb');
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','bb') ?></label>
			<input  type="text" value="<?php echo esc_attr($instance['title']); ?>"
					name="<?php echo $this->get_field_name('title'); ?>"
					id="<?php $this->get_field_id('title'); ?>"
					class="widefat" />
		</p>

		<?php
	}

}

?>
