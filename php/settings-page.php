<h1><?php _e( 'AJAX Login By WordPressaHolic', 'ajax-login-by-wph' ) ?></h1>
<h2><?php _e( 'Shortcode Generator', 'ajax-login-by-wph' ) ?></h2>

<style>
table.alw_settings th{
	text-align: left;
	padding-right: 30px;
}

h3.alw_settings_h3{
border-bottom: 2px solid;
display: inline-block;
    margin-top: 30px;
}

.alw_translate input{
	width: 600px;
	margin-bottom: 20px;
}

</style>

<!-- ESSENTIALS -->
<h3 class="alw_settings_h3"><?php _e( 'Essential settings:', 'ajax-login-by-wph' ) ?></h3>
<table class="alw_settings">
	<tbody>
		<!--Enable Login-->
		<tr>
			<th><label for="alw_enable_login"><?php _e( 'Enable Login', 'ajax-login-by-wph' ) ?></label></th>
			<td><input type="checkbox" name="alw_enable_login" id="alw_enable_login" checked="checked" /></td>
		</tr>
		<!--Enable Regsiteration-->
		<tr>
			<th><label for="alw_enable_regsiteration"><?php _e( 'Enable Regsiteration', 'ajax-login-by-wph' ) ?></label></th>
			<td><input type="checkbox" name="alw_enable_regsiteration" id="alw_enable_regsiteration" checked="checked" /></td>
		</tr>
		<!--Enable Popout-->
		<tr>
			<th><label for="alw_enable_popout"><?php _e( 'Enable Pop Out', 'ajax-login-by-wph' ) ?></label></th>
			<td><input type="checkbox" name="alw_enable_popout" id="alw_enable_popout" checked="checked" /></td>
			<td><em><?php _e( 'If this is unchecked then the plugin will replace the login & register box with the appropriate form that the user selects', 'ajax-login-by-wph' ) ?></em></td>
		</tr>		
	</tbody>
</table>
