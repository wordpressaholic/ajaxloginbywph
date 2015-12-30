<?php

class ALW_Widget extends WP_Widget {

  // in case you want to place default values:
  public $defaults = array(
		'header-image' => '',
		'registeration-redirect link' => '',
		'login-redirect-link' => '',
		'terms-and-conditions-link' => '',
		'privacy-policy-link' => '',
		'input-shadow-color' => '',
		'link-color' => '',
		'button-color' => '',
	);

	function __construct() {
		parent::__construct( 'alw_widget', __('Ajax Login by WPH', 'ajax-login-by-wph' ), array ( 'description' => __( 'The easy way to impliment beautiful ajax login and registe on your website', 'ajax-login-by-wph' ) ) );
	}

  function form( $instance ){
    $arr = array_merge( $this->defaults, $instance );

    ?>

    <p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'header-image' ); ?>"><?php _e( 'Header Image (400 x 80 px)', 'ajax-login-by-wph' ) ?> </label>
			<input class="widefat alw-header-image alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'header-image' ); ?>" name="<?php echo $this->get_field_name( 'header-image' ); ?>" value="<?php echo esc_attr( $arr[ 'header-image' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'registeration-redirect-link' ); ?>"><?php _e( 'Registeration Redirect Link', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat  alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'registeration-redirect-link' ); ?>" name="<?php echo $this->get_field_name( 'registeration-redirect-link' ); ?>" value="<?php echo esc_attr( $arr[ 'registeration-redirect-link' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'login-redirect-link' ); ?>"><?php _e( 'Login Redirect Link', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat  alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'login-redirect-link' ); ?>" name="<?php echo $this->get_field_name( 'login-redirect-link' ); ?>"  value="<?php echo esc_attr( $arr[ 'login-redirect-link' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'terms-and-conditions-link' ); ?>"><?php _e( 'Terms And Conditions Link', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat  alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'terms-and-conditions-link' ); ?>" name="<?php echo $this->get_field_name( 'terms-and-conditions-link' ); ?>" value="<?php echo esc_attr( $arr[ 'terms-and-conditions-link' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'privacy-policy-link' ); ?>"><?php _e( 'Privacy Policy Link', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat  alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'privacy-policy-link' ); ?>" name="<?php echo $this->get_field_name( 'privacy-policy-link' ); ?>" value="<?php echo esc_attr( $arr[ 'privacy-policy-link' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'input-shadow-color' ); ?>" style="display: inline-block; width: 160px;"><?php _e( 'Input Shadow Color', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat alw-color-picker alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'input-shadow-color' ); ?>" name="<?php echo $this->get_field_name( 'input-shadow-color' ); ?>" value="<?php echo esc_attr( $arr[ 'input-shadow-color' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'link-color' ); ?>" style="display: inline-block; width: 160px;"><?php _e( 'Link Color', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat alw-color-picker alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'link-color' ); ?>" name="<?php echo $this->get_field_name( 'link-color' ); ?>" value="<?php echo esc_attr( $arr[ 'link-color' ] ); ?>">
		</p>

		<p style="display: block;">
			<label for="<?php echo $this->get_field_id( 'button-color' ); ?>" style="display: inline-block; width: 160px;"><?php _e( 'Button Color', 'ajax-login-by-wph' ) ?></label>
			<input class="widefat alw-color-picker alw-widget-input" type="text" id="<?php echo $this->get_field_id( 'button-color' ); ?>" name="<?php echo $this->get_field_name( 'button-color' ); ?>" value="<?php echo esc_attr( $arr[ 'button-color' ] ); ?>">
		</p>

    <?php

    //scripts
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        // color picker
        $('.alw-color-picker.alw-widget-input').each( function(){

          $(this).wpColorPicker();
          // double nested color picker hack
          var $parent = $(this).closest( '.widget-content' );

          $parent.find( '.wp-picker-container' ).each( function( ){
            var $this = $( this );
            if( $this.find( '.wp-picker-container' ).length ){
              $this.find( '.wp-color-result' ).first( ).hide( );
            }
            // style
            $this.css( { 'vertical-align': 'middle' } );
            $this.prev( 'p' ).css( { 'display': 'inline-block', 'margin-right': '10px' } );
          } );

        } );

        // image selector
        $('.alw-header-image.alw-widget-input').each( function(){
          var $this = $(this);
          if( ! $this.prev().is('.button') )
            $this.before('<span class="button alw-media-frame" style="display: inline-block; margin-bottom: 1em; margin-left: 10px;">Set Image</span>');
        });

        // media frame
        if (typeof window.alw_media_frame === "undefined")
          window.alw_media_frame = wp.media({ title: 'Select/Upload Header Image For Popup', button: { text: 'Use this image' }, multiple: false });

        $( 'body' ).on( 'click', '.alw-media-frame', function () {
        	alw_media_frame.alw_target = $(this).next('input');
        	alw_media_frame.alw_target_size = 'full';
        	alw_media_frame.open();

        	// letting user set size for the image
        	alw_media_frame.$el.off( 'change', 'select.size' );
        	alw_media_frame.$el.on( 'change', 'select.size', function alw_media_frame_select_size( ){
        		alw_media_frame.alw_target_size = $( this ).val( );
        	} )
        })

        // image selection event
        alw_media_frame.on( 'select', function( ){
        	$( 'select.size' ).off( 'change', 'alw_media_frame_size_change' );

        	var selected = alw_media_frame.state( ).get( 'selection' ).first( ).toJSON( ),
        			url = selected.sizes[ alw_media_frame.alw_target_size ];
        	alw_media_frame.alw_target.val( url.url ).change( );
        } );


      });
    </script>
    <?php
  }

  function update( $new_instance, $old_instance ) {
  	return $new_instance;
  }

  function widget( $args, $instance ){
  	extract( $args );
    $json_instance = count( $instance ) ? json_encode( $instance ) : '';
  	?>

		<aside class="login-prompt widget widget_alw_login" data-json-instance='<?php echo $json_instance; ?>' >
      <div class="widget_wrap">
  			<div class="member-logged-out" <?php if( is_user_logged_in( ) ) echo 'style="display: none;"' ?> >
  				<a href="#" class="member-login login-lightbox-trigger" data-mfp-src=".login-lightbox"><?php _e( 'Login', 'ajax-login-by-wph' ) ?></a><span> | </span><a href="#" class="member-register registeration-lightbox-trigger" data-mfp-src=".registeration-lightbox"><?php _e( 'Register', 'ajax-login-by-wph' ) ?></a>
  				<span class="registeration-done-lightbox-trigger" data-mfp-src=".registeration-done-lightbox"></span>
  			</div>

  			<div class="member-logged-in" <?php if( ! is_user_logged_in( ) ) echo 'style="display: none;"' ?> >
  				<?php echo get_avatar(get_current_user_id( ), 32) ?>
  				<a href="<?php bloginfo('url'); ?>/wp-admin/profile.php" class="member-profile" > <?php $user_data = get_userdata( get_current_user_id( ) ); echo $user_data->display_name; ?></a><span> | </span><a href="<?php echo wp_logout_url( get_site_url() ); ?>" class="member-signout"><?php _e( 'Signout', 'ajax-login-by-wph' ) ?></a>
  			</div>
			</div>
		</aside>

  	<?php
  	require_once( 'popup-markup.php' );
  }

}

/**
 * Registers the ALW_Widget
 */
add_action('widgets_init',
     create_function('', 'return register_widget("ALW_Widget");')
);

?>
