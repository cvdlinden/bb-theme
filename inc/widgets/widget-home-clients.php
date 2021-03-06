<?php

/**
 * Homepage parralax section Widget
 * Bij Best Theme
 */
class bb_theme_home_clients extends WP_Widget
{
    function __construct(){

        $widget_ops = array('classname' => 'bb_theme_home_clients','description' => esc_html__( "Bij Best Client Section That Displays Logos In A Slider" ,'bb-theme') );
        parent::__construct('bb_theme_home_clients', esc_html__('[Bij Best] Client Section For FrontPage','bb-theme'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : __('Our Main Clients','bb-theme');
        $logos = isset($instance['client_logo']) ? $instance['client_logo'] : '';

        echo $before_widget;

    /**
		 * Widget Content
		 */
    ?>
    <?php if( isset( $logos['img'] ) && count( $logos['img'] ) != 0 ){ ?>
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
                    for( $i=0; $i<count($logos['img']); $i++ ) {
                      if( $logos['img'] != '' && $logos['link'] != '' ){ ?>
                        <li>
                            <a href="<?php echo $logos['link'][$i]; ?>">
                                <img alt="<?php _e('Logos', 'bb-theme'); ?>" src="<?php echo $logos['img'][$i]; ?>" />
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

		echo $after_widget;
    }


    function form($instance) {
        if(!isset($instance['title']) ) $instance['title']='';
        if(!isset($instance['client_logo']['img'])) $instance['client_logo']['img']=[''];
        if(!isset($instance['client_logo']['link'])) $instance['client_logo']['link']=[''];
    ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','bb-theme') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p>

      <ul class="client-sortable clone-wrapper"><?php
          $image_src = $instance['client_logo']['img'];
          $logo_link = $instance['client_logo']['link'];
          $slider_count = ( isset($image_src) && count( $image_src ) > 0 ) ? count( $image_src ) : 3 ;

          for ( $i = 0; $i < $slider_count; $i++ ): ?>
              <li class="toclone">
                <br>
                  <label class="logo_heading"><b><?php _e( 'Logo #', 'bb-theme' ); ?><span class="count"><?php echo absint( $i )+1; ?></span></b></label>
                  <input name="<?php echo $this->get_field_name('client_logo').'[img]['.$i.']';?>" id="<?php echo $this->get_field_id('image_src').'-'.$i; ?>" class="widefat image_src" type="hidden" size="36"  value="<?php echo (isset( $image_src[$i] )) ? esc_url( $image_src[$i] ) : ''; ?>" /><br>
                  <button id="<?php echo $this->get_field_id('image_src_button').'-'.$i; ?>" class="button button-primary custom_media_button" data-fieldid="<?php echo $this->get_field_id('image_src').'-'.$i; ?>"><?php _e( 'Upload Logo','bb-theme' ); ?></button>
                  <img class="image_demo" id="img_demo_<?php echo $this->get_field_id( 'image_src' ).'-'.$i; ?>" width="50px" height="50px" style="border:0; margin-left: 20px; vertical-align: top;" src="<?php echo ( isset($image_src[$i]) ) ? esc_url( $image_src[$i] ) : ''; ?>" />
                  <br/><br/>
                  <label><?php _e( 'Link:', 'bb-theme' ); ?></label>
                  <input name="<?php echo $this->get_field_name('client_logo').'[link]['.$i."]"; ?>" id="link<?php echo '-'.$i; ?>" class="widefat client-link" type="text" size="36"  value="<?php echo (isset( $logo_link[$i] )) ? esc_url( $logo_link[$i] ) : ''; ?>" /><br><br>

                  <a href="#" class="clone button-primary"><?php _e('Add', 'bb-theme'); ?></a>
                  <a href="#" class="delete button"><?php _e('Delete', 'bb-theme'); ?></a>
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

		if( isset( $new_instance['client_logo']['img'] ) && count( $new_instance['client_logo']['img'] ) != 0 ){
          for( $i=0; $i<count( $new_instance['client_logo']['img'] ); $i++ ){
            $instance['client_logo']['img'][$i] = ( ! empty( $new_instance['client_logo']['img'][$i] ) ) ? esc_url( $new_instance['client_logo']['img'][$i] ) : '';
          }
        }
		if( isset( $new_instance['client_logo']['link'] ) && count( $new_instance['client_logo']['link'] ) != 0 ){
          for( $i=0; $i<count( $new_instance['client_logo']['link'] ); $i++ ){
            $instance['client_logo']['link'][$i] = ( ! empty( $new_instance['client_logo']['link'][$i] ) ) ? esc_url( $new_instance['client_logo']['link'][$i] ) : '';
          }
        }

		return $instance;
	}

}

?>
