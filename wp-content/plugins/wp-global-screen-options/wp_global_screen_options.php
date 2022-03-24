<?php
/*
Plugin Name: WP Global Screen Options
Plugin URI: http://stianandreassen.com/plugins/wp-global-screen-options/
Description: Hide meta boxes globally for all users on Posts and Pages in WP-Admin.
Author: Stian Andreassen
Author URI: http://www.stianandreassen.com
Version: 0.2
*/

// ADD OPTIONS PAGE
function wpglobalscreenoptions_admin() {
	add_options_page('WP Screen Options', 'WP Screen Options', '10', 'wp-screen-options', 'wpglobalscreenoptions_options');

	// SAVE WP GLOBAL SCREEN OPTIONS
	if(isset($_REQUEST['action'])){
		if($_REQUEST['action'] == 'updatewpglobalscreenoptions'):
			$wpglobalscreenoptions = $_POST;
			unset($wpglobalscreenoptions['action']);
					
			$wpglobalscreenoptions_post = array();
			$wpglobalscreenoptions_page = array();
			$wpglobalscreenoptions_dash = array();
			$wpglobalscreenoptions_general = array();
			foreach($wpglobalscreenoptions as $getoption => $val):
				if(strstr($getoption, 'post_')){
					if($getoption == 'post_tagsdiv-post_tag')
					array_push($wpglobalscreenoptions_post, 'tagsdiv-post_tag');
					else
					array_push($wpglobalscreenoptions_post, str_replace('post_', '', $getoption));
				}
				elseif(strstr($getoption, 'page_')){
					array_push($wpglobalscreenoptions_page, str_replace('page_', '', $getoption));
				}
				elseif(strstr($getoption, 'dash_')){
					array_push($wpglobalscreenoptions_dash, str_replace('dash_', '', $getoption));
				}
				else {
					array_push($wpglobalscreenoptions_general, $getoption);
				}
			endforeach;
					
			global $wpdb;
			$table_name_users = $wpdb->prefix.'users';
			$table_name_usermeta = $wpdb->prefix.'usermeta';
	
			$mysql = "SELECT * FROM $table_name_users";
			$ourusers = $wpdb->get_results($mysql, ARRAY_A);
	
			foreach($ourusers as $thisuser):
				update_user_meta($thisuser['ID'], 'metaboxhidden_post', $wpglobalscreenoptions_post);
				update_user_meta($thisuser['ID'], 'metaboxhidden_page', $wpglobalscreenoptions_page);
				update_user_meta($thisuser['ID'], 'metaboxhidden_dashboard', $wpglobalscreenoptions_dash);
			endforeach;
			
			$wpglobalscreenoptions = array('post' => $wpglobalscreenoptions_post, 'page' => $wpglobalscreenoptions_page, 'dash' => $wpglobalscreenoptions_dash, 'general' => $wpglobalscreenoptions_general);
			update_option('wpglobalscreenoptions', serialize($wpglobalscreenoptions));
	
			header('Location: '.$uri.'admin.php?page=wp-screen-options');
		endif;
	}
}
add_action('admin_menu', 'wpglobalscreenoptions_admin');


// HIDE SCREEN OPTIONS TAB 
function wpglobalscreenoptions_hidetab(){
	if(strstr($_SERVER['REQUEST_URI'], 'post.php') || strstr($_SERVER['REQUEST_URI'], 'post-new.php') ):
		$wpglobalscreenoptions = unserialize(get_option('wpglobalscreenoptions'));
		if(in_array('hidescreenoptions', $wpglobalscreenoptions['general'])){
		echo '<style type="text/css"><!-- #screen-options-link-wrap { display: none; } --></style>';	
		}
	endif;

	if($_SERVER['REQUEST_URI'] == '/wp-admin/' || $_SERVER['REQUEST_URI'] == '/wp-admin/index.php' ):
		$wpglobalscreenoptions = unserialize(get_option('wpglobalscreenoptions'));
		if(in_array('hidescreenoptionsdash', $wpglobalscreenoptions['general'])){
		echo '<style type="text/css"><!-- #screen-options-link-wrap { display: none; } --></style>';	
		}
	endif;

}
if(isset($_REQUEST['action'])){
	if($_REQUEST['action'] != 'updatewpglobalscreenoptions')
	add_action('admin_head', 'wpglobalscreenoptions_hidetab');
}


// SET SCREEN OPTIONS FOR NEW USER 
function wpglobalscreenoptions_newuser($user_id){
	$thisuser = get_userdata($user_id);
	$wpglobalscreenoptions = unserialize(get_option('wpglobalscreenoptions'));
	if(in_array('applytonewusers', $wpglobalscreenoptions['general'])){
		global $wpdb;
		$table_name_usermeta = $wpdb->prefix.'usermeta';

		$wpdb->show_errors();
		$mysql = "INSERT INTO " . $table_name_usermeta .
		"( user_id, meta_key, meta_value ) " .
		"VALUES ('" . $thisuser->ID . "' , 'metaboxhidden_post', '" . serialize($wpglobalscreenoptions['post']) . "'" .
		")";
		$wpdb->query( $mysql );

		$wpdb->show_errors();
		$mysql = "INSERT INTO " . $table_name_usermeta .
		"( user_id, meta_key, meta_value ) " .
		"VALUES ('" . $thisuser->ID . "' , 'metaboxhidden_page', '" . serialize($wpglobalscreenoptions['page']) . "'" .
		")";
		$wpdb->query( $mysql );

		$wpdb->show_errors();
		$mysql = "INSERT INTO " . $table_name_usermeta .
		"( user_id, meta_key, meta_value ) " .
		"VALUES ('" . $thisuser->ID . "' , 'metaboxhidden_dashboard', '" . serialize($wpglobalscreenoptions['dash']) . "'" .
		")";
		$wpdb->query( $mysql );
	}
}
add_action('user_register', 'wpglobalscreenoptions_newuser');


// OPTIONS PAGE
function wpglobalscreenoptions_options(){
?>
<style type="text/css">
<!--

	#wpglobalscreenoptions {
	width: 400px;
	padding: 10px 30px;
	background: #fff;
	border: 1px solid #dbdbdb;
	-moz-border-radius: 9px;
	-khtml-border-radius: 9px;
	-webkit-border-radius: 9px;
	border-radius: 9px;
	}
-->
</style>

	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br /></div>
		<h2>WP Global Screen Options</h2>
		<br />

		<h4>These options are set globally for all users, including Administrators</h4>		

		<?php
		$result = count_users();
		echo '<p><em>There are ', $result['total_users'], ' total users';
		foreach($result['avail_roles'] as $role => $count)
	    echo ', ', $count, ' are ', $role, 's';
		echo '.</em></p>';
		$wpglobalscreenoptions = unserialize(get_option('wpglobalscreenoptions'));
		if(!$wpglobalscreenoptions['post']) $wpglobalscreenoptions['post'] = array();
		if(!$wpglobalscreenoptions['page']) $wpglobalscreenoptions['page'] = array();
		if(!$wpglobalscreenoptions['dash']) $wpglobalscreenoptions['dash'] = array();
		if(!$wpglobalscreenoptions['general']) $wpglobalscreenoptions['general'] = array();
		?>
		
		<div id="wpglobalscreenoptions">
		<form method="POST">
		<p><em>Check which boxes to <strong>hide</strong> from users:</em></p>
		<h3>Screen Options for Posts</h3>
		<?php
			$wpglobalscreenoptions_post = array('categorydiv' => 'Categories', 'tagsdiv-post_tag' => 'Tags', 'postexcerpt' => 'Excerpt', 'trackbacksdiv' => 'Trackbacks', 'postcustom' => 'Custom Fields', 'commentstatusdiv' => 'Discussion', 'slugdiv' => 'Slug', 'authordiv' => 'Author');
			foreach($wpglobalscreenoptions_post as $screenoption => $screenoptionname):
				if(in_array($screenoption, $wpglobalscreenoptions['post'])) $selected = ' checked'; else $selected = '';
				echo '<p><input type="checkbox" name="post_'.$screenoption.'"'.$selected.' /> '.$screenoptionname.'</p>';
			endforeach;

		?>
		
		<h3>Screen Options for Pages</h3>
		<?php
			$wpglobalscreenoptions_page = array('pageparentdiv' => 'Page Attributes', 'postcustom' => 'Custom Fields','commentstatusdiv' => 'Discussion', 'commentsdiv' => 'Comments', 'slugdiv' => 'Slug', 'authordiv' => 'Author');
			foreach($wpglobalscreenoptions_page as $screenoption => $screenoptionname):
				if(in_array($screenoption, $wpglobalscreenoptions['page'])) $selected = ' checked'; else $selected = '';
				echo '<p><input type="checkbox" name="page_'.$screenoption.'"'.$selected.' /> '.$screenoptionname.'</p>';
			endforeach;
		?>
		
		<h3>Screen Options for Dashboard</h3>
		<?php
			$wpglobalscreenoptions_dash = array('dashboard_right_now' => 'Right Now', 'dashboard_incoming_links' => 'Incoming Links', 'dashboard_recent_comments' => 'Recent Comments', 'dashboard_plugins' => 'Plugins', 'dashboard_quick_press' => 'QuickPress', 'dashboard_recent_drafts' => 'Recent Drafts', 'dashboard_primary' => 'WordPress Development Blog', 'dashboard_secondary' => 'Other WordPress News');
			foreach($wpglobalscreenoptions_dash as $screenoption => $screenoptionname):
				if(in_array($screenoption, $wpglobalscreenoptions['dash'])) $selected = ' checked'; else $selected = '';
				echo '<p><input type="checkbox" name="dash_'.$screenoption.'"'.$selected.' /> '.$screenoptionname.'</p>';
			endforeach;
		?>

		<h3>General Settings</h3>
		<p><input type="checkbox" name="applytonewusers"<?php if(in_array('applytonewusers', $wpglobalscreenoptions['general'])) echo ' checked'; ?> /> Apply these settings to new users</p>
		<p><input type="checkbox" name="hidescreenoptions"<?php if(in_array('hidescreenoptions', $wpglobalscreenoptions['general'])) echo ' checked'; ?> /> Hide &#171;Screen Options&#187; Tab on Post and Page Admin</p>
		<p><input type="checkbox" name="hidescreenoptionsdash"<?php if(in_array('hidescreenoptionsdash', $wpglobalscreenoptions['general'])) echo ' checked'; ?> /> Hide &#171;Screen Options&#187; in Dashboard</p>
		<p>
		<input type="submit" value="<?php _e('Update'); ?>" class="button-primary" />
		<input type="hidden" name="action" value="updatewpglobalscreenoptions" />
		</p>
		</form>
		</div>


	</div>
<?php
}
?>