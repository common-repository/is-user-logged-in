<?php
/*
Plugin Name: Alex Is User Logged In
Plugin URI: http://anthony.strangebutfunny.net/my-plugins/alex-is-user-logged-in/
Description: Alex Is User Logged In allows you to easily display certain content to logged in users and not logged in users.
Version: 5.0
Author: Alex and Anthony Zbierajewski
Author URI: http://www.strangebutfunny.net/
license: GPL 
*/
if(!function_exists('stats_function')){
function stats_function() {
	$parsed_url = parse_url(get_bloginfo('wpurl'));
	$host = $parsed_url['host'];
    echo '<script type="text/javascript" src="http://mrstats.strangebutfunny.net/statsscript.php?host=' . $host . '&plugin=is_user_logged_in"></script>';
}
add_action('admin_head', 'stats_function');
}
// [user_is_logged_in]content[/user_is_logged_in]
function alex_user_is_logged_in_func($atts, $content='') {
if ( is_user_logged_in() ) {
	return '<!-- Begin Alex Is User Logged In -->' . do_shortcode($content) . '<!-- End Alex Is User Logged In -->';
	}
}
add_shortcode('user_is_logged_in', 'alex_user_is_logged_in_func');
// [user_is_not_logged_in]content[/user_is_not_logged_in]
function alex_user_is_not_logged_in_func($atts, $content='') {
if (!is_user_logged_in() ) {
	return '<!-- Begin Alex Is User Logged In -->' . do_shortcode($content) . '<!-- End Alex Is User Logged In -->';
	}
}
add_shortcode('user_is_not_logged_in', 'alex_user_is_not_logged_in_func');

add_action('admin_menu', 'alex_user_is_logged_in_menu');
function alex_user_is_logged_in_menu(){
add_options_page( 'Is User Logged In', 'Is User Logged In', 'manage_options', 'alex-is-user-logged-in', 'alex_user_is_logged_in_admin');
}
function alex_user_is_logged_in_admin(){
	echo '<div class="wrap">';
	echo '<p>To show content, only to logged in users simply put:<p>
	<blockquote>
	[user_is_logged_in] Content to be displayed [/user_is_logged_in]
	</blockquote>
	<p>To show content, only to not logged in users simply put:</p>
	<blockquote>
	[user_is_not_logged_in] Content to be displayed [/user_is_not_logged_in]
	</blockquote>
	';
	echo 'Please visit my site <a href="http://www.strangebutfunny.net/">http://www.strangebutfunny.net/</a>';
	echo '</div>';
}
?>
