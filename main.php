<?php
/*
 * Plugin Name: AJAX Login By WordPressaHolic
 * Version: 1.0.0
 * Plugin URI: http://kartik.webfixfast.com
 * Description: Simplify your website user's login/registeration journey. An easy to use plugin for implementing AJAX login and registeration on your website. Beautiful front end interface and plenty of controls including styling, page redirect and input error text.
 * Author: WordPressaHolic
 * Requires at least: 4.0
 * Tested up to: 4.3.0
 *
 * Text Domain: ajax-login-by-wph
 *
 * @package WordPress
 * @author WordPressaHolic
 * @since 1.0.0
 */

require_once( 'php/functions.php' );
require_once( 'php/widget.php' );

/**
 * This plugin defines several constants to give users more customization power.
 * Simply changing the values here may not be enough as this file could be rewritten in future updates.
 * Instead you may copy these constants to your child theme's functions.php and modify their values
 */
define( 'ALW_CAPABILITY', 'manage_options' ); // shows the settings page if user capability is equal or greater than this
define( 'ALW_MENU_SLUG', 'ajax-login-by-wph' );

/**
 * Adds styles and scripts of the plugin
 */
function alw_enqueue_scripts_and_styles( ){
	$plugin_dir_url = plugin_dir_url( __FILE__ );
	//css
	wp_enqueue_style( 'magnific_css', $plugin_dir_url . 'css/magnific.css', null, null );
	wp_enqueue_style( 'alw_css', $plugin_dir_url . 'css/alw.css', null, null );
	//js
	wp_enqueue_script( 'magnific_js',  $plugin_dir_url . 'js/magnific.min.js', 'jquery', null, true );
	wp_enqueue_script( 'alw_js',  $plugin_dir_url . 'js/alw.js', 'jquery', null, true );
}
add_action( 'wp_enqueue_scripts', 'alw_enqueue_scripts_and_styles' );

/**
 * Adds the settings page using the WP function 'add_options_page' at the admin_init hook.
 */
function alw_add_settings_page( ){
	add_options_page( __( 'AJAX Login by WordPressaHolic', 'ajax-login-by-wph' ), __( 'AJAX Login by WPH', 'ajax-login-by-wph' ), ALW_CAPABILITY, ALW_MENU_SLUG, 'alw_settings_page_callback' );
}
add_action( 'admin_menu', 'alw_add_settings_page' );

/**
 * Helper function for 'alw_add_settings_page'. Pulls in content for the settings page from settings-page.php
 */
function alw_settings_page_callback( ){
	require_once( 'php/settings-page.php' );
}

/**
 * Print the JS inline with translated strings
 */
function alw_print_scripts( ){

	/*IE sniffing*/
	if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
?>
<style>
.alw_spinner, .membership-lightbox input {
  transition: .0s!important;
}

.alw_spinner_container{
width: auto!important;
}
</style>
<?php
	}

	//JS
?>
<script>
jQuery( function( $ ){

	// correct information
	var $instance_json = $()
	// get info json from widget container
	// place the information bits into the content

	// membership lightbox magnific triggers
	//-- before open magnific callback
	function alw_before_open_popup( context ){

		var $widget = $(context).closest( '.widget' );
		var json_instance = $widget.attr('data-json-instance');

		if( ! json_instance || json_instance.length < 3 ) return; // possibly invalid JSON

		var instance = JSON.parse( json_instance );
		var $membership_lightbox = $( '.membership-lightbox' );

		// header image
		var header_image = instance[ 'header-image' ].trim( );
		if( header_image ){
			$membership_lightbox.removeClass( 'no-register-lightbox-header' );
			$membership_lightbox.find( '.register-lightbox-header' ).html( '<img src="' + header_image + '" />' );
		} else {
			$membership_lightbox.addClass( 'no-register-lightbox-header' );
		}

		// redirect links
		$.each( [ 'registeration-redirect-link', 'login-redirect-link'  ], function( index, elm ){
			var val = instance[ elm ].trim( );
			var key = elm.replace(/ /g, '-');
			$membership_lightbox.attr( 'data-' + key, val );
		} )

		// inline links
		//-- terms and conditions
		if( instance[ 'terms-and-conditions-link' ] ){
			$( '.alw-terms-and-conditions' ).attr( 'href', instance[ 'terms-and-conditions-link' ] );
		}else{
			$( '.alw-terms-and-conditions' ).hide( );
		}
		//-- privacy policy
		if( instance[ 'privacy-policy-link' ] ){
			$( '.alw-privacy-policy' ).attr( 'href', instance[ 'privacy-policy-link' ] );
		}else{
			$( '.alw-privacy-policy' ).hide( );
		}
		//-- toggle 'and'
		if( instance[ 'terms-and-conditions-link' ] && instance[ 'privacy-policy-link' ] ){
			$( '.alw-links-and' ).show( );
		}else{
			$( '.alw-links-and' ).hide( );
		}
		//-- toggle links section
		if( ! instance[ 'terms-and-conditions-link' ] && ! instance[ 'privacy-policy-link' ] ){
			$( '.alw-agreement-links' ).hide( );
		}else{
			$( '.alw-agreement-links' ).show( );
		}

		// colors
		//-- link
		if( instance[ 'link-color' ] ){
			$( 'a', $membership_lightbox ).attr( 'style', 'color:' + instance[ 'link-color' ] + '!important' );
		}else{
			$( 'a', $membership_lightbox ).attr( 'style', '' );
		}
		//-- button
		if( instance[ 'button-color' ] ){
			$( 'input.button', $membership_lightbox ).attr( 'style', 'background-color:' + instance[ 'button-color' ] + '!important' );
		}else{
			$( 'input.button', $membership_lightbox ).attr( 'style', '' );
		}
		//-- input
		if( instance[ 'input-shadow-color' ] ){
			var style = '<style>.membership-lightbox input:focus, .membership-lightbox input[type]:focus{ border-color: ' + instance[ 'input-shadow-color' ] + '!important; box-shadow: 0 0 5px ' + instance[ 'input-shadow-color' ] + '!important; border-width: 1px; outline: none; background: none; }</style>';
			$( 'head' ).append( style );
		}



	}

	//-- login lightbox
	$( '.login-lightbox-trigger' ).magnificPopup( {
		type: 'inline',
		callbacks:{
			elementParse: function(item){
				alw_before_open_popup(item.el)
			},
		}
	} );

	//-- registeration lightbox
	$( '.registeration-lightbox-trigger' ).magnificPopup( {
		type: 'inline',
		callbacks:{
			elementParse: function(item){
				alw_before_open_popup(item.el)
			},
		}
	} );

	//-- registeration done lightbox
	$( '.registeration-done-lightbox-trigger' ).magnificPopup( {
		type: 'inline',
		callbacks:{
			close: function( ){
				location.reload( );
			},
		}
	} );

	//-- forgot password lightbox
	$( '.forgot-password-lightbox-trigger' ).magnificPopup( {
		type: 'inline',
	} );

	// add the spinner
	$( '.membership-lightbox input[type="submit"]' ).after( '<div class="alw_spinner_container"><div class="alw_spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>'	);

	// submit by enter
	$( 'body' ).on( 'keypress', '.membership-lightbox', function( e ){
		if ( e.keyCode == 13 ){
		$( this ).find( 'input[type=submit]:first' ).click( );
		}
	} );

	// the error message container is display:block in the beginning to indicate to $ that it is block. It needs to slideUp now
	$( '.membership-ligtbox-error' ).slideUp( );

	var response_string= {
		'no first_name': [ "<?php _e( 'Please enter a \'First Name\'', 'ajax-login-by-wph' ) ?>", 'first_name' ],
		'no last_name': [ "<?php _e( 'Please enter a \'Last Name\'', 'ajax-login-by-wph' ) ?>", 'last_name' ],

		'no username': [ "<?php _e( 'Please enter a \'Username\'', 'ajax-login-by-wph' ) ?>", 'username' ],
		'lowercase username': [ "<?php _e( 'Please enter \'Username\' in lowercase only. Capital letters are not allowed.', 'ajax-login-by-wph' ) ?>", 'username' ],
		'invalid username': [ "<?php _e( 'Please enter a valid \'Username\'', 'ajax-login-by-wph' ) ?>", 'username' ],
		'username exists': [ "<?php _e( 'Sorry, \'Username\' already taken. Please try another.', 'ajax-login-by-wph' ) ?>", 'username' ],
		'unregistered username': [ "<?php _e( 'Sorry, this username is not registered with us!', 'ajax-login-by-wph' ) ?>", 'username' ],

		'no email': [ "<?php _e( 'Please enter an \'Email\'', 'ajax-login-by-wph' ) ?>", 'email' ],
		'no username/email': [ "<?php _e( 'Please enter an \'Email/Username\'', 'ajax-login-by-wph' ) ?>", 'email' ],
		'invalid email': [ "<?php _e( 'Please enter a valid \'Email\'', 'ajax-login-by-wph' ) ?>", 'email' ],
		'email exists': [ "<?php _e( 'Email already registered. Please use another.', 'ajax-login-by-wph' ) ?>", 'email' ],
		'unregistered email': [ "<?php _e( 'Sorry, this email is not registered with us!', 'ajax-login-by-wph' ) ?>", 'email' ],

		'no password': [ "<?php _e( 'Please enter a \'Password\'', 'ajax-login-by-wph' ) ?>", 'password' ],
		'invalid password': [ "<?php _e( 'Please enter a valid \'Password\'', 'ajax-login-by-wph' ) ?>, between 6 and 25 characters long, with alpha-numeric keys. You may also use these special characters: !@#$%^&*()-_ []{}<>~`+=,.;:/?|", 'password' ],
		'incorrect password': [ "<?php _e( 'Sorry, login failed due to incorrect password. If you forgot your password, please try the link below.', 'ajax-login-by-wph' ) ?>", 'password' ],

		'failed login': [ "<?php _e( 'Sorry, login failed.', 'ajax-login-by-wph' ) ?>", '' ],

		'not allowed': [ "<?php _e( 'This action is not allowed', 'ajax-login-by-wph' ) ?>", '' ],
		'error': [ "<?php _e( 'Sorry, there was an error while performing this action', 'ajax-login-by-wph' ) ?>", '' ],

		'successful reset': [ "<?php _e( 'We have sent you an email with the password reset link. If you do not find it in your inbox, please check your spam folder as well.', 'ajax-login-by-wph' ) ?>", '' ],
	};

	// membership lightbox ajax
	$( 'body' ).on( 'click', '.membership-lightbox .button', function( ){

		var 	$this= $( this ),
				$container = $this.closest( '.membership-lightbox' ),
				data = { action: $container.attr( 'data-action' ) },
				$inputs = $container.find( 'input' ),
				$error_container = $( '.mfp-content .membership-ligtbox-error' );

		// lock the button, don't re-perform
		if( $this.hasClass( 'membership-lightbox-button-locked' ) ) return;
		$this.addClass( 'membership-lightbox-button-locked' );

		if( $container.hasClass( 'registeration-done-lightbox' ) ){
			location.reload( );
		}

		$inputs.removeClass( 'alw_input_error' );
		$error_container.slideUp( );

		$container.find( 'input[data-key]' ).each( function( ){
			var 	$this = $( this ),
					key = $this.attr( 'data-key' ),
					val = $this.val( );
				data[ key ] = val;
		} )

		$.ajax( {
			type : "post",
			dataType : "json",
			url : "<?php echo admin_url('admin-ajax.php'); ?>",
			data : data,
			success: function( response ){

				$this.removeClass( 'membership-lightbox-button-locked' );

				// registered
				if( response.message === 'successful registeration' ){

					var redirect_link = $this.closest( '.membership-lightbox' ).attr( 'data-registeration-redirect-link' );
					if( ! redirect_link )
						location.reload( );
					else
						location.href= redirect_link;

					// Registeration welcome card, but
					// all this for later perhaps:

					// replace {{first_name}} with first name of new registered user
					// var first_name = $inputs.filter( '[data-key=first_name]' ).val( );
					// $( '.membership-lightbox-first-name' ).text( first_name );
					//
					// // pull up welcome message for registered user
					// $( '.registeration-done-lightbox-trigger' ).click( );
					//
					// $( 'body' ).on( 'click', '.mfp-close', function( ){
					// 	location.reload( );
					// } )

					return;
				}

				// logged in
				if( response.message === 'successful login' ){
					var redirect_link = $this.closest( '.membership-lightbox' ).attr( 'data-login-redirect-link' );
					if( ! redirect_link )
						location.reload( );
					else
						location.href= redirect_link;
					return;
				}

				// password reset mail sent
				if( response.message === 'successful reset' ){
					// exception: this error is actually a success message
					$error_container.text( response_string[ response.message ][ 0 ] );
					$error_container.addClass( 'membership-ligtbox-success' );
					$error_container.slideDown( );
					return;
				}

				// display error
				$error_container.text( response_string[ response.message ][ 0 ] );
				$inputs.filter( '[data-key='+ response_string[ response.message ][ 1 ] +']' ).addClass( 'alw_input_error' );
				$error_container.slideDown( );

			},
		} );
	} )

	$('body').on('keydown', '.alw_input_error', function(){
		$(this).removeClass('alw_input_error');
	})

} )
</script>
<?php
}
add_action( 'wp_footer', 'alw_print_scripts' );

?>
