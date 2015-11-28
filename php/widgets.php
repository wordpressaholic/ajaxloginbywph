<?php

class ALW_Widget extends WP_Widget {
     
	function __construct() {
		parent::__construct( 'alw_widget', __('Ajax Login by WPH', 'ajax-login-by-wph' ), array ( 'description' => __( 'The easy way to impliment beautiful ajax login and registe on your website', 'ajax-login-by-wph' ) ) );
	}

    function form( $instance ){
		$defaults = array(
			'depth' => '-1'
		);
		$depth = $instance[ 'depth' ];
		 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'depth' ); ?>">Depth of list:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'depth' ); ?>">Depth of list:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
		</p>
		
		
		<?php
    }
     
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'depth' ] = strip_tags( $new_instance[ 'depth' ] );
		return $instance;
    }
     
    function widget( $args, $instance ){
		extract( $args );
		?>
			<aside class="login-prompt widget widget_alw_login">
			
				<div class="member-logged-out" <?php if( is_user_logged_in( ) ) echo 'style="display: none;"' ?> >
					<a href="#" class="member-login login-lightbox-trigger" data-mfp-src=".login-lightbox"><?php _e( 'Login', 'ajax-login-by-wph' ) ?></a><span> | </span><a href="#" class="member-register registeration-lightbox-trigger" data-mfp-src=".registeration-lightbox"><?php _e( 'Register', 'ajax-login-by-wph' ) ?></a>
					<span class="registeration-done-lightbox-trigger" data-mfp-src=".registeration-done-lightbox"></span>
				</div>
				
				<div class="member-logged-in" <?php if( ! is_user_logged_in( ) ) echo 'style="display: none;"' ?> >
					<?php echo get_avatar(get_current_user_id( ), 32) ?>
					<a href="<?php bloginfo('url'); ?>/wp-admin/profile.php" class="member-profile" > <?php $user_data = get_userdata( get_current_user_id( ) ); echo $user_data->user_login; ?></a><span> | </span><a href="<?php echo wp_logout_url( get_site_url() ); ?>" class="member-signout"><?php _e( 'Signout', 'ajax-login-by-wph' ) ?></a>
				</div>

			</aside>
		<?php
		require_once( 'popup-markup.php' );
		
    }

}

/**
 * Registers the ALW_Widget
 */
function alw_register_widget() { 
    register_widget( 'ALW_Widget' );
 
}
add_action( 'widgets_init', 'alw_register_widget' );

?>