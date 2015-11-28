<!-- Membership (login / registeration) lightbox markup begins -->
<div class="membership-lightbox-items" style="display: none;">
	
	<!-- Registeration -->
	<div class="registeration-lightbox membership-lightbox" data-action="alw_register">
		<div class="register-lightbox-header">
		</div>

		<span class="membership-lightbox-heading"><?php _e( 'Great to see you here!', 'ajax-login-by-wph' ) ?></span>
		<span class="register-lightbox-byline"><?php _e( 'Let\'s set up your account in just a couple of steps.', 'ajax-login-by-wph' ) ?></span>

		<input class="membership-lightbox-first-name" data-key="first_name" name="first_name" placeholder="<?php _e( 'First name', 'ajax-login-by-wph' ) ?>" />
		<input class="membership-lightbox-last-name" data-key="last_name" name="last_name" placeholder="<?php _e( 'Last name', 'ajax-login-by-wph' ) ?>"/>
		<input class="membership-lightbox-last-name" data-key="username" name="username" placeholder="<?php _e( 'Username', 'ajax-login-by-wph' ) ?>"/>
		<input class="membership-lightbox-email" type="email" data-key="email" name="email" placeholder="<?php _e( 'Email', 'ajax-login-by-wph' ) ?>" />
		<input class="membership-lightbox-password" type="password" data-key="password" name="password" placeholder="<?php _e( 'Password', 'ajax-login-by-wph' ) ?>" />

		<span><?php _e( 'By creating an account you agree to our', 'ajax-login-by-wph' ) ?><br>
		<a href="<?php echo get_home_url( ); ?>/terms-of-use/" target="_blank" ><?php _e( 'Terms and Conditions', 'ajax-login-by-wph' ) ?></a> <?php _e( 'and our', 'ajax-login-by-wph' ) ?> <a href="<?php echo get_home_url( ); ?>/privacy-policy/" target="_blank" ><?php _e( 'Privacy Policy', 'ajax-login-by-wph' ) ?></a></span>

		<input type="submit" value="<?php _e( 'Set Up Your GFrecipes Account', 'ajax-login-by-wph' ) ?>" name="subscribe"  class="button register-lightbox-submit" />
		
		<span class="membership-ligtbox-error"><?php _e( 'Sorry, registeration failed. Incorrect details.', 'ajax-login-by-wph' ) ?></span>

		<span class="membership-lightbox-footer"><?php _e( 'Already a member?', 'ajax-login-by-wph' ) ?> <a class="login-lightbox-trigger" data-mfp-src=".login-lightbox" href="#" target="_blank" ><?php _e( 'Sign in here', 'ajax-login-by-wph' ) ?></a></span>
	</div>
	
	<!-- Registeration Done -->
	<div class="registeration-done-lightbox membership-lightbox">
		<div class="register-lightbox-header">
		</div>

		<span class="membership-lightbox-heading"><?php _e( 'Welcome', 'ajax-login-by-wph' ) ?>, <span class="membership-lightbox-first-name">{{first_name}}</span>!</span>
		<span class="register-lightbox-byline"><?php _e( 'As a starting point we recommend new members discover the following features that are now unlocked for you:', 'ajax-login-by-wph' ) ?></span>

		<div class="register-lightbox-item">
			<strong><span class="membership-lightbox-number"><?php _e( '1', 'ajax-login-by-wph' ) ?> </span><?php _e( 'Visit and Edit you profile -', 'ajax-login-by-wph' ) ?> <a href="<?php echo get_home_url( ); ?>/profile" target="_blank" ><?php _e( 'HERE', 'ajax-login-by-wph' ) ?></a></strong>
			<span><?php _e( 'Add a bio, upload an avatar, update your password', 'ajax-login-by-wph' ) ?></span>
		</div>

		<input type="submit" value="<?php _e( 'OKAY, GOT IT!', 'ajax-login-by-wph' ) ?>" name="submit" class="button registeration-done-lightbox-submit" />
	</div>

	<!-- Login -->
	<div class="login-lightbox membership-lightbox" data-action="alw_login">
		<div class="register-lightbox-header">
		</div>

		<span class="membership-lightbox-heading"><?php _e( 'Great to have you back!', 'ajax-login-by-wph' ) ?></span>
		
		<input class="membership-lightbox-email" type="email" data-key="email" name="email" placeholder="<?php _e( 'Email / Username', 'ajax-login-by-wph' ) ?>" />
		<input class="membership-lightbox-password" type="password" data-key="password" name="password" placeholder="<?php _e( 'Password', 'ajax-login-by-wph' ) ?>" />

		<input type="submit" value="<?php _e( 'SIGN IN', 'ajax-login-by-wph' ) ?>" name="submit"  class="button login-lightbox-submit" />

		<span class="membership-ligtbox-error"><?php _e( 'Sorry, login failed. Incorrect email, and/or password.', 'ajax-login-by-wph' ) ?></span>

		<span><?php _e( 'Forgot your password?', 'ajax-login-by-wph' ) ?> <a class="forgot-password-lightbox-trigger" data-mfp-src=".forgot-password-lightbox" href="#" target="_blank" ><?php _e( 'Click here', 'ajax-login-by-wph' ) ?></a></span>
		<span class="membership-lightbox-footer"><?php _e( 'New here?', 'ajax-login-by-wph' ) ?> <a class="registeration-lightbox-trigger" data-mfp-src=".registeration-lightbox" href="#" target="_blank" ><?php _e( 'Create an account', 'ajax-login-by-wph' ) ?></a></span>
	</div>
	
	<!-- Forgot Password -->
	<div class="forgot-password-lightbox membership-lightbox" data-action="alw_forgot_password">
		<div class="register-lightbox-header">
		</div>

		<span class="membership-lightbox-heading"><?php _e( 'Forgot your password?', 'ajax-login-by-wph' ) ?></span>
		<span class="register-lightbox-byline"><?php _e( 'No problem. Just enter your username or account associated email address below and we will send you a mail with the password reset link.', 'ajax-login-by-wph' ) ?></span>

		<input class="membership-lightbox-email" type="email" data-key="email" name="email" placeholder="<?php _e( 'Email / Username', 'ajax-login-by-wph' ) ?>" />
		<input type="submit" value="<?php _e( 'SUBMIT', 'ajax-login-by-wph' ) ?>" name="submit"  class="button forgot-password-lightbox-submit" />

		<span class="membership-ligtbox-error"><?php _e( 'Sorry, login failed. Incorrect email, and/or password.', 'ajax-login-by-wph' ) ?></span>

	</div>
	
</div>
<!-- Membership (login / registeration) lightbox markup ends -->