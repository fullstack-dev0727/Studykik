<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
session_start();
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );



	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.

 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );
######################################



add_action('init', 'studyKIK_featuredResearchCenter');



function studyKIK_featuredResearchCenter() {



	$labelsLand = array(

		'name' => _x('F R C', 'post type general name'),

		'singular_name' => _x('F R C Item', 'post type singular name'),

		'add_new' => _x('Add New', 'F R C item'),

		'add_new_item' => __('Add New F R C Item'),

		'edit_item' => __('Edit F R C Item'),

		'new_item' => __('New F R C Item'),

		'view_item' => __('View F R C Item'),

		'search_items' => __('Search Project'),

		'not_found' =>  __('Nothing found'),

		'not_found_in_trash' => __('Nothing found in Trash'),

		'parent_item_colon' => ''

	);



	$args_Land = array(

		'labels' => $labelsLand,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'query_var' => true,

		'rewrite' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail','author','custom-fields')

	  );



register_post_type( 'frc' , $args_Land );

}

    $labels3 = array(

        'name' => _x( 'F R C Categories', 'taxonomy general name' ),

        'singular_name' => _x( 'F R C Category', 'taxonomy singular name' ),

        'search_items' =>  __( 'Search F R C Categories' ),

        'all_items' => __( 'All F R C Categories' ),

        'parent_item' => __( 'Parent Category' ),

        'parent_item_colon' => __( 'Parent Category:' ),

        'edit_item' => __( 'Edit F R C Category' ),

        'update_item' => __( 'Update F R C Category' ),

        'add_new_item' => __( 'Add F R C Category' ),

        'new_item_name' => __( 'New F R C Category' ),

        'menu_name' => __( 'Categories' )

      );



    register_taxonomy('featured-research-center',array('frc'), array(

        'hierarchical' => true,

        'labels' => $labels3,

        'query_var' => true,

        'show_ui' => true

     ));



######################################
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
function modify_contact_methods($profile_fields) {
	// Add new fields
    $profile_fields['sitename'] = 'Site Name';
    $profile_fields['address'] =  'Address';
    $profile_fields['emailadd2'] = 'Email-2';
    $profile_fields['emailadd3'] = 'Email-3';
    $profile_fields['emailadd4'] = 'Email-4';
    $profile_fields['emailadd5'] = 'Email-5';
    $profile_fields['emailadd6'] = 'Email-6';
	$profile_fields['rewards'] = 'MY STUDYKIK REWARDS';
	$profile_fields['project_manager'] = 'Site / Sales Manager';
	$profile_fields['phone_number'] = 'Site / Sales Manager Phone Number';
    $profile_fields['account_executive'] = 'Study Support';
    $profile_fields['account_executive_phone_number'] = 'Study Support Phone Number';
	$profile_fields['number_of_sites'] = 'Name of company (Only for Stats Page)';
	$profile_fields['rewards2'] = 'only for developer usages';
    $profile_fields['callfire_credits'] = 'Callfire Credits';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');
function wps_change_role_name() {
global $wp_roles;
if ( ! isset( $wp_roles ) )
$wp_roles = new WP_Roles();
$wp_roles->roles['contributor']['name'] = 'Owner';
$wp_roles->role_names['contributor'] = 'Owner';
}
add_action('init', 'wps_change_role_name');

//associating a function to login hook
add_action('wp_login', 'set_last_login');

//function for setting the last login
function set_last_login($login) {
   $user = get_userdatabylogin($login);
   $date = date('m/d/Y H:i:s');
   update_usermeta( $user->ID, 'last_login', $date );
}
//function for getting the last login
function get_last_login($user_id) {
   $last_login = get_user_meta($user_id, 'last_login', true);

   return $last_login;
}
function setAndViewPostViews($postID) {

	$Campaign = get_post_meta($postID, 'renewed',true );
	if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
	$count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
	}else{
	$count_key = 'views_'.$Campaign;
	$count = get_post_meta($postID, $count_key, true);

    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
	}
    return $count; /* so you can show it */
}
add_action('wp_ajax_dashboard_dnq', 'wp_dashboard_dnq_notes');
function wp_dashboard_dnq_notes(){
    $loopFile        = $_POST['loop_file'];
    $post_id           = $_POST['post_id'];
	get_template_part( $loopFile );
    exit;
}
/*rewards action*/
add_action('wp_ajax_dashboard_rew', 'wp_dashboard_rewards');
function wp_dashboard_rewards(){
    $loopFile        = $_POST['loop_file'];
    $post_id         = $_POST['post_id'];
	get_template_part( $loopFile );
    exit;
}
function wp_campaigndates(){
    $loopFile        = $_POST['loop_file'];
	get_template_part( $loopFile );
    exit;
}
/*rewards action*/
function wp_infinitepaginate(){
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = 20;
    # Load the posts
    query_posts(array('paged' => $paged ));
    get_template_part( $loopFile );
    exit;
}
function wp_refresh_top_labels(){
	get_template_part('refresh-top');
    exit;
}
function wp_instant_subscriber(){
	get_template_part('instant_sign_up_subscriber');
	exit;
}
function wp_add_patient_db(){
	get_template_part('add_patient_db');
	exit;
}
function wp_dashboard_callconncet(){
    $loopFile        = $_POST['loop_file'];
    $post_id         = $_POST['post_id'];
	get_template_part( $loopFile );
    exit;
}

function wp_protocolmail(){
	get_template_part('protocol_mail');
	exit;
}

add_action('wp_ajax_nopriv_fb_instant_sign_up', 'wp_fb_instant_subscriber');
add_action('wp_ajax_fb_instant_sign_up', 'wp_fb_instant_subscriber');

function wp_fb_instant_subscriber(){
    get_template_part('fb_instant_sign_up_subscriber');

    exit;
}

add_action('wp_ajax_dashboard_call_conncet', 'wp_dashboard_callconncet');

add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');           // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_dashboard_refresh_top', 'wp_refresh_top_labels');
add_action('wp_ajax_nopriv_add_patient_db', 'wp_add_patient_db');
add_action('wp_ajax_add_patient_db', 'wp_add_patient_db');
add_action('wp_ajax_nopriv_instant_sign_up', 'wp_instant_subscriber');
add_action('wp_ajax_instant_sign_up', 'wp_instant_subscriber');
add_action('wp_ajax_campaign_dates', 'wp_campaigndates');
add_action("wp_ajax_load_patient_details",'ajax_load_patient_details');
add_action("wp_ajax_nopriv_load_patient_details",'ajax_load_patient_details');

add_action('wp_ajax_protocol_mail', 'wp_protocolmail');           
add_action('wp_ajax_nopriv_protocol_mail', 'wp_protocolmail');


function format_telephone_number($phone_number) {
    $phone_number = preg_replace('/[^0-9]+/', '', $phone_number); //Strip all non number characters
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone_number); //Re Format it
}
function ajax_load_patient_details() {
    global $wpdb;
    $page_num = $_REQUEST['page_num'];
    $page_limit = $_REQUEST['page_limit'];
    $offset = $page_limit * ($page_num - 1);
    $sel_val = $_REQUEST['sel_val'];
    $pid = $_REQUEST['pid'];
    $tb_subscriber_list = $wpdb->prefix."subscriber_list";
    $subscriber_query = array();
    if($sel_val=='all') {
        for ($i = 1; $i <= 8; $i ++) {
            $subscriber_query[$i - 1] = $wpdb->get_results("SELECT * FROM $tb_subscriber_list WHERE post_id = '$pid' and row_num = $i ORDER BY id DESC LIMIT $page_limit OFFSET $offset", OBJECT);
        }
    } else {
        for ($i = 1; $i <= 8; $i ++) {
            $subscriber_query[$i - 1] = $wpdb->get_results("SELECT * FROM $tb_subscriber_list WHERE post_id = '$pid' and campaign ='$sel_val' and row_num = $i ORDER BY id DESC LIMIT $page_limit OFFSET $offset", OBJECT);
        }
    }

    $is_read_arr=array();
    $query_calldata = $wpdb->get_results("SELECT from_number FROM 0gf1ba_calldata WHERE is_read = '0'", OBJECT);
    if (count($query_calldata)> 0){
        foreach($query_calldata as $qry){
            $from_number = $qry->from_number;
            $is_read_arr[$from_number]=$from_number;
        }
    }

    $_custom_fields = get_post_custom($_REQUEST['pid']);
    if(!isset($_custom_fields['allow_international_phone_numbers'])){
        // by default use USA number format
        $allow_international_phone_numbers = false;
    }else{
        $allow_international_phone_numbers = isset($_custom_fields['allow_international_phone_numbers'][0]) ? ($_custom_fields['allow_international_phone_numbers'][0] != '') : true;
    }
    $time_zone = get_post_meta($pid, 'callfire_time_zone', true);
    $suvoda_protocol_id = get_post_meta( $pid, 'suvoda_protocol_id', true );
    $pr_no = get_post_meta($pid, 'text_message_purchased_number', true);
//        $query_notes = $wpdb->get_results("SELECT * FROM 0gf1ba_client_notes WHERE note_id = '$pid' ORDER BY id DESC", OBJECT);
    $_custom_fields = get_post_custom($pid);
    $output_arr = array();
    $common_arr = array();
    $common_arr['add_note_tooltip'] = (isset($query_notes[0]->notes) ? $query_notes[0]->notes : 'Add notes');
    $common_arr['template_url'] = get_bloginfo('template_url');
    $common_arr['site_url'] = site_url();
    $common_arr['pid'] = $pid;
    $common_arr['time_zone'] = $time_zone;
    $common_arr['suvoda_protocol_id'] = $suvoda_protocol_id;
    $common_arr['pr_no'] = $pr_no;
    if(!isset($_custom_fields['allow_delete_patients'])){
        $allow_delete_users = false;
    }else{
        $allow_delete_users = isset($_custom_fields['allow_delete_patients'][0]) ? ($_custom_fields['allow_delete_patients'][0] != '') : true;
    }
    $common_arr['allow_delete_users'] = $allow_delete_users;

    $element_id_array = array("nwPatients", "caPatients", "nqPatients", "shPatients", "cnPatients", "raPatients", "anPatients", "screen_failed");

    foreach($subscriber_query as $index => $s_query) {
        $output = "";
        $col_arr = array();
        if ($s_query) {

            foreach ($s_query as $results) {
                $row_arr = array();
                $redirect_num=$results->redirect_number;
                $aaa_ID = $results->id;
                $item = explode(" ", $results->date);
                $item2 = explode(" ", $results->last_modify);
                if ($item[0] != "") {
                    $sign_dt = date("m-d-Y", strtotime($item[0]));
                } else {
                    $sign_dt = $item[0];
                }
                if ($item2[0] != "") {
                    $act_dt = date("m-d-Y", strtotime($item2[0]));
                } else {
                    $act_dt = $item2[0];
                }
                if($results->schedule_time !=""){
                    $tm=date("m-d-Y, h:i A", strtotime($results->schedule_time));
                }
                else{
                    $tm="";
                }
                $row_arr['id'] = $results->id;
                $row_arr['name'] = $results->name;
                $row_arr['email'] = $results->email;
                $row_arr['phone'] = ( ($allow_international_phone_numbers) ? ($results->phone) : format_telephone_number($results->phone) );
                $row_arr['is_callfire_qualified'] = $results->is_callfire_qualified;
                $row_arr['is_front'] = $results->is_front;
                $row_arr['no_of_question'] = $results->no_of_question;
                $row_arr['broadcast_id'] = $results->no_of_question;
                $row_arr['redirect_number'] = $results->redirect_number;
                $row_arr['in_is_read_arr'] = in_array($results->phone,$is_read_arr);

                $row_arr['sign_dt'] = (((bool) $suvoda_protocol_id) ? '<br />' : '') . $sign_dt;
                $row_arr['act_dt'] = (((bool) $suvoda_protocol_id) ? '<br />' : '') . $act_dt;
                $row_arr['tm'] = $tm;




                $col_arr[] = $row_arr;

            }
        }
        $output_arr[$element_id_array[$index]] = $col_arr;
    }

    echo json_encode(array("data" => $output_arr, "common_data" => $common_arr));
    exit;
}

function wp_dashboard_editsite(){
	get_template_part('dashboard_editsite');
    exit;
}

function wp_text_ptient(){
 $patientfile        = $_POST['patient_file'];
    $post_id         = $_POST['post_id'];
	get_template_part( $patientfile);
    exit;

}

add_action('wp_ajax_text_aptient', 'wp_text_ptient');



/* phone mg ajax function*/

/*cron jobs*/
if(isset($_GET['rrun_cc_gn']) && ($_GET['rrun_cc_gn']=='2')){ //15 min
    addToCronJobsLog('cron_getnumbers', 'start');
    wp_cron_getnumbers();
    addToCronJobsLog('cron_getnumbers', 'stop');
    die;
}

if(isset($_GET['rrun_cc_auto_private']) && ($_GET['rrun_cc_auto_private']=='2')){ //15 min
    addToCronJobsLog('auto_private', 'start');
    get_template_part('auto_private');
    addToCronJobsLog('auto_private', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_send_msg1']) && ($_GET['rrun_cc_send_msg1']=='2')){ //1 day
    $_REQUEST['tz']=1;
    addToCronJobsLog('send_text_messages_1', 'star');
    get_template_part('send_text_messages');
    addToCronJobsLog('send_text_messages_1', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_send_msg2']) && ($_GET['rrun_cc_send_msg2']=='2')){ //1 day
    $_REQUEST['tz']=2;
    addToCronJobsLog('send_text_messages_2', 'start');
    get_template_part('send_text_messages');
    addToCronJobsLog('send_text_messages_2', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_send_msg3']) && ($_GET['rrun_cc_send_msg3']=='2')){ //1 day
    $_REQUEST['tz']=3;
    addToCronJobsLog('send_text_messages_3', 'start');
    get_template_part('send_text_messages');
    addToCronJobsLog('send_text_messages_3', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_send_msg4']) && ($_GET['rrun_cc_send_msg4']=='2')){ //1 day
    $_REQUEST['tz']=4;
    addToCronJobsLog('send_text_messages_4', 'start');
    get_template_part('send_text_messages');
    addToCronJobsLog('send_text_messages_4', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_rewards_points']) && ($_GET['rrun_cc_rewards_points']=='2')){ //1 day
    addToCronJobsLog('rewards_points', 'start');
    get_template_part('rewards_points');
    addToCronJobsLog('rewards_points', 'stop');
    exit;
}

if(isset($_GET['rrun_cc_check_cron_jobs']) && ($_GET['rrun_cc_check_cron_jobs']=='2')){
    addToCronJobsLog('check_cron_jobs', 'start');
    checkCronJobs();
    addToCronJobsLog('check_cron_jobs', 'stop');
}

/*end cron jobs*/

function wp_cron_getnumbers(){
 	get_template_part('get_callfire_numbers');
    exit;
}


add_action('wp_cron_get_numbers', 'wp_cron_getnumbers');


/* save_update popup*/
function wp_update_study_popup(){
 $update_study_file        = $_POST['update_study_file'];
    $post_id         = $_POST['post_id'];
	get_template_part( $update_study_file);
    exit;

}
add_action('wp_ajax_update_study', 'wp_update_study_popup');

function wp_set_message_as_read(){
    global $wpdb;
    $sql = 'UPDATE 0gf1ba_calldata SET is_read = 1 WHERE id = "'.mysql_real_escape_string($_POST['id']) .'";';
    $wpdb->query($sql);
    $memcache = new Memcache;
    $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);

    $unread_messages = $memcache->get('unread_messages_'.$_POST['post_id']);
    $new_unread_messages = array();
    if ($unread_messages){
        foreach($unread_messages as $key => $message){
            if ($message->message_id != $_POST['id']){
                $new_unread_messages[] = $message;
            }
        }
        $memcache->set('unread_messages_'.$_POST['post_id'], $new_unread_messages, false, 3600);
    }
}
add_action('wp_ajax_set_message_as_read', 'wp_set_message_as_read');

function wp_get_unread_messages($pid = null){
    global $wpdb;
    $post_id = isset($_GET['post_id'])?$_GET['post_id']:NULL;
    if (!$post_id && $pid){
        $post_id = $pid;
    }
    $arr = array();

    if ($post_id){
        $sql = 'SELECT * FROM 0gf1ba_calldata WHERE is_read = 0 AND study_id = "'.mysql_real_escape_string($post_id) .'" ';
        $res = $wpdb->get_results($sql, OBJECT);
        if ($res){
            foreach($res as $row){
                $message_date = new DateTime($row->created);
                $arr['messages'][] = array('sub_id' => $row->patient_id, 'message_id'  => $row->id, 'message' => $row->message, 'message_date' => $message_date->format('m-d-Y h:i A'), 'message_date_formated' => $message_date->format('Y-m-d H:i:s'));
            }
        }

        $callfir_credits = getCallfireCredits($post_id);
        $arr['callfir_credits'] = $callfir_credits;
    }

    if ($pid){
        return json_encode($arr);
    }else{
        echo json_encode($arr);
    }
}
add_action('wp_ajax_get_unread_messages', 'wp_get_unread_messages');
add_action('wp_ajax_nopriv_get_unread_messages', 'wp_get_unread_messages');

add_action('wp_ajax_buy_credits', 'wp_buy_credits');
function wp_buy_credits(){
    global $wpdb;
    $result = array();
    $now = new DateTime('now', new DateTimeZone('UTC'));
    if(isset($_POST['credits'])){

        $user_id = get_current_user_id();
        $user_data = get_userdata($user_id);
        $company = get_user_meta($user_id, "sitename", true);
        $post_id = $_POST['post_id'];
        $notes = stripslashes($_POST['notes']);
        $total_price = '$'.number_format($_POST['credits']*77/100, 2);

        $credit_card_id       = $_POST['payment_credit_card_id'];
        $profile_id           = $_POST['payment_profile_id'];
        $payment_profile_id   = $_POST['payment_payment_id'];
        $shipping_profile_id  = $_POST['payment_shipping_id'];
        $payment_card_code    = $_POST['payment_card_code'];
        $creditcard           = "";
        if ($credit_card_id) {
            $creditcard           = get_post_meta($credit_card_id, "auth_credit_card", true);
        }

        $product_arr = array();

        $product_arr['Credit'] = array("title"=>"Credit", "price" => 0.77, "qty" => $_POST['credits']);


        $first_name                         = get_user_meta($user_id, "first_name", true);
        $last_name                          = get_user_meta($user_id, "last_name", true);
        $auth_card_type                     = get_post_meta($credit_card_id, 'auth_card_type', true);
        $auth_credit_card                   = get_post_meta($credit_card_id, 'auth_credit_card', true);
        $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
        $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
        $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);


        if (is_user_logged_in() && get_user_meta(get_current_user_id(), 'allow_check', true) && $_POST['select_card'] == "Check") {
            $result['approved'] = 1;
            $result['success']= true;

            $user_id = get_current_user_id();
            $firstname = get_user_meta($user_id, "first_name", true);
            $lastname = get_user_meta($user_id, "last_name", true);
            $company = get_user_meta($user_id, "sitename", true);
            $address = get_user_meta($user_id, "address", true);
            $userData = get_userdata($user_id);

        } else {
            require('../_authorize/AuthnetCIM.php');
            try{
                // Create AuthnetCIM object. Set third parameter to "true" for developer account
                // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
                $ecommerce_user_production = get_option("ecommerce_user_production");
                if ((bool)$ecommerce_user_production) {
                    $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
                } else {
                    $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
                }

                $purchase_amount      = $_POST['credits']*77/100;
                $products             = 'x';

                $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);
                // Process the transaction
                $cim->setParameter('merchantCustomerId', $customer_id);
                $cim->setParameter('amount', $purchase_amount);
                $cim->setParameter('customerProfileId', $profile_id);
                $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
                $cim->setParameter('customerShippingAddressId', $shipping_profile_id);
                $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

                $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
                $cim->setParameter('invoiceNumber', $invoice_number);

                if ($payment_card_code) {
                    $cim->setParameter('cardCode', $payment_card_code);
                }
                $cim->setLineItem('1', 'Credit', $products, $_POST['credits'], '0.77');
                $cim->createCustomerProfileTransaction();

                // insert order
                // Get the payment profile ID returned from the request
                if ($cim->isSuccessful()){
                    $approval_code = $cim->getAuthCode();

                    $profile                = array();
                    $profile['post_title']  = 'Credit Purchase';
                    $profile['post_status'] = 'publish';
                    $profile['post_type']   = 'studykik-orders';

                    $order_post_id = wp_insert_post($profile);


                    update_field('first_name',              $card_billing_first_name, $order_post_id);
                    update_field('last_name',               $card_billing_last_name, $order_post_id);
                    update_field('zip',                     $card_billing_zip, $order_post_id);

                    update_field('post_id',                 $post_id, $order_post_id);
                    update_field('study_post_link',         get_edit_post_link($post_id), $order_post_id);
                    update_field('amount',                  $purchase_amount, $order_post_id);
                    update_field('approved',                $approval_code, $order_post_id);




                    $result['data'] = $cim;
                    $result['approved'] = $cim->getAuthCode();
                    $result['success']= true;

                }else{
                    $result['success']= false;
                    $result['data'] = $cim;
                    $result['approved'] = 'no';

                    send_order_fail_email(array(
                        "first_name" => $card_billing_first_name,
                        "last_name" => $card_billing_last_name,
                        "company" => $company,
                        "zip" => $card_billing_zip,
                        "transaction_id" => $cim->getTransactionID(),
                        "payment_type" => $auth_card_type,
                        "coupon" => "",
                        "coupon_amount" => ""
                    ));
                }




            }catch (AuthnetCIMException $e){
                send_order_fail_email(array(
                    "first_name" => $card_billing_first_name,
                    "last_name" => $card_billing_last_name,
                    "company" => $company,
                    "zip" => $card_billing_zip,
                    "transaction_id" => $cim->getTransactionID(),
                    "payment_type" => $auth_card_type,
                    "coupon" => "",
                    "coupon_amount" => ""
                ));
                $result['success']= false;
                $result['message']= $e.$cim;
                $result['approved'] = 'no';
            }
        }

        if ($result['approved'] != "no") {
            $sql = 'INSERT INTO 0gf1ba_callfire_credits (date, last_4_digits, credits) VALUES ('
                .'\''.mysql_real_escape_string($now->format('Y-m-d H:i:s')).'\','
                .'\''.mysql_real_escape_string('111').'\','
                .'\''.mysql_real_escape_string($_POST['credits']).'\''
                .');';

            $wpdb->query($sql);

            $invoice_num = $wpdb->get_var( "SELECT max(invoice_number) FROM `0gf1ba_invoice_number`");


            $pdf_attachment_path_db = '';
            $protocolnumber = get_post_meta($_POST['post_id'],'protocol_no', true);
            $final_num = $invoice_num + 1;

            $current_month = date('M');
            $current_year = date('Y');
            $full_date = date('m/d/y');
            $sitename = get_post_meta($_POST['post_id'],'name_of_site', true);
            $message_pdf = '';
            $message_pdf .= '<style type="text/css">
                                    <!--
                                    table
                                    {
                                        width:  100%;
                                        margin:0px 0px 0px 0px;
                                        padding: 0px 0px 0px 0px;
                                    }

                                    th{padding:8px 0px;}
                                    td
                                    {
                                    padding:6px 0px;
                                    }
                                    tbody{
                                    margin:0px 20px 0px 20px;
                                    padding: 0px 20px 0px 20px;

                                    }

                                    h1{ font-size:21px; margin:-15px 0px 6px 0px; padding:0px 0px 0px 0px;}
                                    tbody tr{ font-size:14px;}
                                    body{margin:0px 0px 0px 0px;
                                        padding: 0px 0px 0px 0px;}

                                    -->
                                    </style>';
            $message_pdf .= "
                          <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
                         <table cellpadding='0' cellspacing='0'>
                        <col style='width: 18%'>
                        <col style='width: 37%'>
                        <col style='width: 20%'>
                        <col style='width: 5%'>
                        <col style='width: 20%'>

                              <tr>
                            <th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
                            <th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
                            <h1>INVOICE RECEIPT</h1>
                            Invoice Number: ".$final_num."<br />
                            Date: ".$full_date."<br />
                            Payment Type: ".($creditcard ? $auth_card_type." xxxx".$auth_credit_card : "Check")."<br />";
            if ($creditcard) {
                $message_pdf .= "
                    Name on Card: ".$card_billing_first_name." ".$card_billing_last_name."<br/>
                    Account: ".$first_name. " " .$last_name."</th>";
            } else {
                $message_pdf .= "
                    Account: ".$first_name. " " .$last_name."<br/>
                    &nbsp;</th>";
            }
            $message_pdf .= "
                            </tr>
                        <tbody>
                        <tr>
                            <th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
                            <tr style='text-align:center; font-size:18px;color:#000;'>
                            <th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
                            <th align='left' colspan='2' style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
                            <th style='border-bottom:1px solid #000;'></th>
                            <th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
                            </tr>

                        <tr align='center'>
                            <td align='left'>Patient Messaging Suite Credits</td>
                            <td align='left' colspan='2'>".$_POST['credits']." Credits </td>
                            <td align='center'> </td>
                            <td align='right'>".$total_price." </td>
                        </tr>";
            for ($x=1; $x<=6; $x++){
                $message_pdf .= "<tr align='left'>
                        <td bordercolor='#000' align='left'>&nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        </tr>";
            }
            for ($x=1; $x<=1; $x++){
                $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
            }

            $message_pdf .= "

                        <tr class='sub_total' align='left'>
                        <td align='center'  style='border-top:1px solid #000;'> </td>
                        <td align='left' colspan='2'  style='border-top:1px solid #000;'> </td>
                        <td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
                        </tr>
                        <tr class='total' align='left'>
                        <td align='center'> </td>
                        <td align='left' colspan='2'> </td>
                        <td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
                        </tr>
                        </tbody>
                        <tr>";

            $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";
            $message_pdf .= "</tr>
                    </table></page>";

            require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
            $html2pdf = new HTML2PDF('P', 'Letter','en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($message_pdf);

            $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_Callfire_Credits_Invoice'.".pdf", "f");

            $pdf_attachment_path_db = '/pdf/'.$final_num.'_Callfire_Credits_Invoice.pdf';

            $attachments[] = $_SERVER['DOCUMENT_ROOT'] . $pdf_attachment_path_db;
            $attachments_pdf[] = $pdf_attachment_path_db;
            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES ('$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Callfire Credits','$full_date')", null));

            if ($_POST['select_card'] == "Check") {
                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "company" => $company,
                    "zip" => "",
                    "transaction_id" => "",
                    "payment_type" => "Check",
                    "coupon" => "",
                    "coupon_amount" => "",
                    "pdfs" => $attachments_pdf
                ), $attachments);
            } else {
                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $card_billing_first_name,
                    "last_name" => $card_billing_last_name,
                    "company" => $company,
                    "zip" => $card_billing_zip,
                    "transaction_id" => $cim->getTransactionID(),
                    "payment_type" => $auth_card_type,
                    "coupon" => "",
                    "coupon_amount" => "",
                    "invoice_number" => $invoice_number,
                    "pdfs" => $attachments_pdf
                ), $attachments);
            }

            $author_id = get_post_field( 'post_author', $post_id );
            $credits = getCallfireCredits($post_id);
            $credits_left = $credits + $_POST['credits'];

			if ($credits_left <= 0){
				$credits_left = 0;
			}
            addToCallfireCreditsLog($author_id, $credits, $credits_left, 'Buy credits');
            update_user_meta($author_id, 'callfire_credits', $credits_left);
            $memcache = new Memcache;
            $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);
            if ($is_memcache_connected){
                $memcache->set('callfir_credits_'.$author_id, $credits_left, false, 3600);
            }

            $subject = "Patient Messaging Suite credits purchase: " . $_POST['credits'].' credits ('.$total_price . ")  for " . $user_data->user_login . " ";
            $message = "
                        <body>
                            <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
                              <tr>
                                <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>Patient Messaging Suite Credits</strong></td>
                              </tr>
                              <tr>
                                <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                              </tr>
                              <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Username:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $user_data->user_login . "</td>
                              </tr>
                               <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . get_user_meta($user_id,'sitename', true) . "</td>
                              </tr>
                              <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>First Name:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . get_user_meta($user_id,'first_name', true) . "</td>
                              </tr>
                              <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong>Last Name:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . get_user_meta($user_id,'last_name', true) . "</td>
                              </tr>
                              <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong>Email:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $user_data->user_email . "</td>
                              </tr>
                              <tr style='color:#000; font-size:12px;'>
                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong>Credits:</strong></td>
                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $_POST['credits'].' credits '.$total_price . "</td>
                              </tr>
                              <tr>
                                <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                              </tr>
                            </table>
                        </body>";

            $emails = 'info@studykik.com';
            global $do_not_add_additional_emails;
            $do_not_add_additional_emails = true;
            wp_mail( $emails, $subject, $message, array('From: StudyKIK <info@studykik.com>','Content-Type: text/html'),
                $_SERVER['DOCUMENT_ROOT'].$pdf_attachment_path_db );
            $do_not_add_additional_emails = false;

            $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
            $headers_pdf[] = "MIME-Version: 1.0\r\n";
            $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $subject_pdf_email = "Patient Messaging Suite Credits";
            $pdf_email_text = "
                    Hi " . $user_data->user_login . ",<br /><br />
                    Thank you for adding " .  $_POST['credits'] . " credits with StudyKIK.<br /><br />
                    Please see invoice attached with detailed information.<br /><br />
                    If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                    Thank you!<br /><br />
                    StudyKIK<br />
                    1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                    info@studykik.com<br />
                    1-877-627-2509<br /><br /><br />
                    <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />";

            wp_mail($user_data->user_email, $subject_pdf_email, $pdf_email_text, $headers_pdf, $_SERVER['DOCUMENT_ROOT'].$pdf_attachment_path_db);

        }

    }else{
        $result['success']= false;
    }
    echo json_encode($result);
}


add_action('wp_ajax_buy_irb_creation', 'wp_buy_irb_creation');
function wp_buy_irb_creation(){
    global $wpdb;
    $result = array();
    $now = new DateTime('now', new DateTimeZone('UTC'));

//    print_r($_POST);
//    exit;
    if(isset($_POST['quantity'])){

        $user_id = $_POST['select_user'] ? $_POST['select_user'] : get_current_user_id();
        $user_data = get_userdata($user_id);
        $company = get_user_meta($user_id, "sitename", true);
        $notes = stripslashes($_POST['notes']);
        $total_price = '$'.number_format($_POST['quantity']*177, 2);

        $credit_card_id       = $_POST['payment_credit_card_id'];
        $profile_id           = $_POST['payment_profile_id'];
        $payment_profile_id   = $_POST['payment_payment_id'];
        $shipping_profile_id  = $_POST['payment_shipping_id'];
        $payment_card_code    = $_POST['payment_card_code'];
        $creditcard           = "";
        if ($credit_card_id) {
            $creditcard           = get_post_meta($credit_card_id, "auth_credit_card", true);
        }

        $product_arr = array();

        $product_arr['IRB Ad Creation'] = array("title"=>"IRB Ad Creation", "price" => 177, "qty" => $_POST['quantity']);


        $first_name                         = get_user_meta($user_id, "first_name", true);
        $last_name                          = get_user_meta($user_id, "last_name", true);
        $auth_card_type                     = get_post_meta($credit_card_id, 'auth_card_type', true);
        $auth_credit_card                   = get_post_meta($credit_card_id, 'auth_credit_card', true);
        $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
        $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
        $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);


        if (is_user_logged_in() && get_user_meta(get_current_user_id(), 'allow_check', true) && $_POST['select_card'] == "Check") {
            $result['approved'] = 1;
            $result['success']= true;

            $user_id = get_current_user_id();
            $firstname = get_user_meta($user_id, "first_name", true);
            $lastname = get_user_meta($user_id, "last_name", true);
            $company = get_user_meta($user_id, "sitename", true);
            $address = get_user_meta($user_id, "address", true);
            $userData = get_userdata($user_id);

            send_order_email($product_arr, array(
                "user_id" => $user_id,
                "first_name" => $firstname,
                "last_name" => $lastname,
                "company" => $company,
                "email" => $user_data->user_email,
                "account" => $firstname." ".$lastname,
                "zip" => "",
                "transaction_id" => "",
                "payment_type" => "Check",
                "coupon" => "",
                "coupon_amount" => ""
            ));
        } else {
            require('../_authorize/AuthnetCIM.php');
            try{
                // Create AuthnetCIM object. Set third parameter to "true" for developer account
                // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
                $ecommerce_user_production = get_option("ecommerce_user_production");
                if ((bool)$ecommerce_user_production) {
                    $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
                } else {
                    $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
                }

                $purchase_amount      = $_POST['quantity']*177;
                $products             = 'x';

                $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);
                // Process the transaction
                $cim->setParameter('merchantCustomerId', $customer_id);
                $cim->setParameter('amount', $purchase_amount);
                $cim->setParameter('customerProfileId', $profile_id);
                $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
                $cim->setParameter('customerShippingAddressId', $shipping_profile_id);
                $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

                $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
                $cim->setParameter('invoiceNumber', $invoice_number);

                if ($payment_card_code) {
                    $cim->setParameter('cardCode', $payment_card_code);
                }
                $cim->setLineItem('1', 'IRB Ad Creation', $products, $_POST['quantity'], '177');
                $cim->createCustomerProfileTransaction();

                // insert order
                // Get the payment profile ID returned from the request
                if ($cim->isSuccessful()){
                    $approval_code = $cim->getAuthCode();

                    $profile                = array();
                    $profile['post_title']  = 'IRB Ad Creation Purchase';
                    $profile['post_status'] = 'publish';
                    $profile['post_type']   = 'studykik-orders';

                    $order_post_id = wp_insert_post($profile);


                    update_field('first_name',              $card_billing_first_name, $order_post_id);
                    update_field('last_name',               $card_billing_last_name, $order_post_id);
                    update_field('zip',                     $card_billing_zip, $order_post_id);

                    update_field('amount',                  $purchase_amount, $order_post_id);
                    update_field('approved',                $approval_code, $order_post_id);




                    $result['data'] = $cim;
                    $result['approved'] = $cim->getAuthCode();
                    $result['success']= true;

                    $currentUserFirstName = get_user_meta(get_current_user_id(), "first_name", true);
                    $currentUserLastName = get_user_meta(get_current_user_id(), "last_name", true);
                    send_order_email($product_arr, array(
                        "buyer_id" => get_current_user_id(),
                        "first_name" => $card_billing_first_name,
                        "last_name" => $card_billing_last_name,
                        "user_id" => $user_id,
                        "account" => $currentUserFirstName." ".$currentUserLastName,
                        "company" => $company,
                        "email" => $user_data->user_email,
                        "zip" => $card_billing_zip,
                        "transaction_id" => $cim->getTransactionID(),
                        "payment_type" => $auth_card_type,
                        "coupon" => "",
                        "coupon_amount" => "",
                        "invoice_number" => $invoice_number
                    ));

                }else{
                    $result['success']= false;
                    $result['data'] = $cim;
                    $result['approved'] = 'no';

                    send_order_fail_email(array(
                        "first_name" => $card_billing_first_name,
                        "last_name" => $card_billing_last_name,
                        "company" => $company,
                        "email" => $user_data->user_email,
                        "zip" => $card_billing_zip,
                        "transaction_id" => $cim->getTransactionID(),
                        "payment_type" => $auth_card_type,
                        "coupon" => "",
                        "coupon_amount" => ""
                    ));
                }




            }catch (AuthnetCIMException $e){
                send_order_fail_email(array(
                    "first_name" => $card_billing_first_name,
                    "last_name" => $card_billing_last_name,
                    "company" => $company,
                    "email" => $user_data->user_email,
                    "zip" => $card_billing_zip,
                    "transaction_id" => $cim->getTransactionID(),
                    "payment_type" => $auth_card_type,
                    "coupon" => "",
                    "coupon_amount" => ""
                ));
                $result['success']= false;
                $result['message']= $e.$cim;
                $result['approved'] = 'no';
            }
        }

    }else{
        $result['success']= false;
    }
    echo json_encode($result);
}

add_action('update_callfire_leases_numbers_cron', 'update_callfire_leases_numbers');
function update_callfire_leases_numbers(){

    global $wpdb;
    $user = '41530ff4e2a8';
    $password = 'a44dd745a81cca3c';
    $authentication = 'Authorization: Basic '.base64_encode("$user:$password");

    $url = 'https://api.callfire.com/v2/numbers/leases';
    $params = array();
    $query = http_build_query($params);
    //$url .= '.json';
    $fullUrl = "$url?$query";
    $http = curl_init($fullUrl);
    curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', $authentication));
    $numbers_json = curl_exec($http);
    $numbers = json_decode($numbers_json);
    if ($numbers){
        $sql = 'SELECT * FROM 0gf1ba_callfire_numbers WHERE number_type = \'2\'';
        $result = $wpdb->get_results($sql);
        $numbers_in_db = array();
        $numbers_from_callfire = array();
        if ($result){
            foreach($result as $row){
                $numbers_in_db[] = $row->phone_number;
            }
        }
        foreach($numbers->items as $item){
            $numbers_from_callfire[] = substr($item->number,1,10);
        }

        $to_remove = array_diff($numbers_in_db, $numbers_from_callfire);
        $to_add = array_diff($numbers_from_callfire, $numbers_in_db);

        foreach($to_add as $key => $row){
            $sql = 'INSERT INTO 0gf1ba_callfire_numbers (phone_number, number_type) VALUES (\''.mysql_real_escape_string($row).'\', 2)';
            mysql_query($sql);
        }

        $text = '';
        foreach($to_remove as $key => $row){
            $sql = 'SELECT * FROM 0gf1ba_postmeta WHERE meta_key = \'purchased_number\' AND meta_value = \''.mysql_real_escape_string($row).'\' ';
            $res = $wpdb->get_results($sql);
            if(!$res){
                $sql = 'DELETE FROM 0gf1ba_callfire_numbers WHERE number_type = \'2\' AND phone_number = \''.mysql_real_escape_string($row).'\';';
                mysql_query($sql);
            }else{
                $studies = array();
                foreach ($res as $post_meta_row) {
                    if (get_post_status($post_meta_row->post_id) != 'inherit'){
                        $study_no = get_post_meta($post_meta_row->post_id, 'study_no',true );
                        $post_edit_url = site_url().'/wp-admin/post.php?post='.$post_meta_row->post_id.'&action=edit';
                        $studies[] = get_the_title($post_meta_row->post_id).' <a href=\''.$post_edit_url.'\'>'.$study_no.'</a>';
                    }
                }
                $studies = array_unique($studies);
                if (!empty($studies)){
                    $text .= "Phone number (".$row.") does not exist in Callfire. Related studies ( ".implode(', ', $studies)." )<br/>";
                }
            }
        }
        if ($text != ''){
            $emails = ['alexmanager1991@gmail.com', 'mo.tan@studykik.com', 'dnessonov@gmail.com'];
            $subject = 'Callfire phone numbers.';
            wp_mail( $emails, $subject, $text, 'Content-Type: text/html' );
        }
    }
}

/* call connect*/
function wp_call_connectfile()
{
	$callfile     = $_POST['call_file'];
    $post_id       = $_POST['post_id'];
	get_template_part( $callfile);
    exit;


}
add_action('wp_ajax_call_connect', 'wp_call_connectfile');


/*  Update popup ajax*/

function wp_updatenote_data(){

	$note_file     = $_POST['note_file'];
    $post_id       = $_POST['post_id'];
	$pid  = $_POST['pid'];
	get_template_part( $note_file);
    exit;

}


add_action('wp_ajax_updatenote', 'wp_updatenote_data');


function wp_cron_ivr(){
 	get_template_part('callfirecron');
    exit;
}

add_action('wp_cron_ivr_details', 'wp_cron_ivr');


function wp_cron_rewards(){
 	get_template_part('rewards_points');
    exit;
}

add_action('wp_cron_reward_points', 'wp_cron_rewards');


function wp_cron_msg1(){
	$_REQUEST['tz']=1;
 	get_template_part('send_text_messages');
    exit;
}

add_action('wp_cron_send_msg1', 'wp_cron_msg1');


function wp_cron_msg2(){
	$_REQUEST['tz']=2;
 	get_template_part('send_text_messages');
    exit;
}

add_action('wp_cron_send_msg2', 'wp_cron_msg2');


function wp_cron_msg3(){
	$_REQUEST['tz']=3;
 	get_template_part('send_text_messages');
    exit;
}

add_action('wp_cron_send_msg3', 'wp_cron_msg3');


function wp_cron_msg4(){
	$_REQUEST['tz']=4;
 	get_template_part('send_text_messages');
    exit;
}

add_action('wp_cron_send_msg4', 'wp_cron_msg4');


function wp_text_mess_system(){
 $msgfile   = $_POST['msg_file'];
 $post_id   = $_POST['post_id'];
 get_template_part($msgfile);
    exit;

}

add_action('wp_ajax_text_amsg', 'wp_text_mess_system');


add_action('wp_ajax_dashboard_edit_site', 'wp_dashboard_editsite');
function wp_dashboard_updatesite(){
	get_template_part('dashboard_updatesite');
    exit;
}


add_action('wp_ajax_dashboard_update_site', 'wp_dashboard_updatesite');

function wp_dashboard_savepatient(){
 	get_template_part('dashboard_savepatient');
    exit;
}


add_action('wp_ajax_dashboard_save_patient', 'wp_dashboard_savepatient');
function wp_dashboard_addpatient(){
 	get_template_part('dashboard_addpatient');
    exit;
}


add_action('wp_ajax_dashboard_add_patient', 'wp_dashboard_addpatient');
function wp_dashboard_addemail(){
 	get_template_part('dashboard_addemail');
    exit;
}


add_action('wp_ajax_dashboard_add_email', 'wp_dashboard_addemail');
add_action('wp_ajax_nopriv_dashboard_add_email', 'wp_dashboard_addemail');
function wp_dashboard_sitename(){
 	get_template_part('dashboard_sitename');
    exit;
}


add_action('wp_ajax_dashboard_site_name', 'wp_dashboard_sitename');
function wp_dashboard_studyaddress(){
 	get_template_part('dashboard_studyaddress');
    exit;
}

add_action('wp_ajax_storeDraft', 'wp_storeDraft');
function wp_storeDraft(){
    $invoice = customInvoice_load();

    if(isset($_POST['data']) && $_POST['data'] != ''){
        if(isset($_POST['draft_id']) && $_POST['draft_id'] != '' && $_POST['draft_id'] != 'new'){
            $invoice->updateDraft($_POST);
        }else{
            $invoice->saveDraft($_POST);
        }
    }
    exit;
}

add_action('wp_ajax_submitPayment', 'wp_submitPayment');
function wp_submitPayment(){
    $invoice = customInvoice_load();

    if(isset($_POST['draft_id']) && $_POST['draft_id'] != ''){
        $invoice->emulatePaymentSubmit($_POST);
    }
    exit;
}

add_action('wp_ajax_refundDraft', 'wp_refundDraft');
function wp_refundDraft(){
    $invoice = customInvoice_load();

    if(isset($_POST['draft_id']) && $_POST['draft_id'] != ''){
        $invoice->emulateRefund($_POST);
    }
    exit;
}

add_action('wp_ajax_dashboard_study_address', 'wp_dashboard_studyaddress');
function wp_dashboard_cronew(){
 	get_template_part('dashboard_cronew');
    exit;
}


add_action('wp_ajax_dashboard_cro_new', 'wp_dashboard_cronew');
add_action('wp_ajax_nopriv_dashboard_cro_new', 'wp_dashboard_cronew');
function wp_dashboard_checksite(){
 	get_template_part('dashboard_checksite');
    exit;
}


add_action('wp_ajax_dashboard_check_site', 'wp_dashboard_checksite');
if(isset($_REQUEST['action'])){
if($_REQUEST['action'] == 'profile')
{
	$pass1 = $_REQUEST['pass1'];
	$pass2 = $_REQUEST['pass2'];

	if($pass1 == $pass2)
	{
		$_SESSION['change_pass']=$pass1;
	}
	else{
		$_SESSION['change_pass']="";
	}
}
}
add_filter( 'wp_mail_from', 'wpse_new_mail_from' );
function wpse_new_mail_from( $old ) {
    return 'info@studykik.com'; // Edit it with your email address
}

add_filter('wp_mail_from_name', 'wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return 'StudyKIK'; // Edit it with your/company name
}
add_action('init', 'reward_study_points');

function reward_study_points() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'rewardspoints' ) {
	// load the file if exists
	$load = locate_template('rewards_points.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}
add_action('init', 'callfire_callsubscription');
function callfire_callsubscription() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'call-subscription' ) {
	// load the file if exists
	$load = locate_template('callfire_call_subscription.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

add_action('init', 'callfire_smssubscription');
function callfire_smssubscription() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'sms-subscription' ) {
	// load the file if exists
	$load = locate_template('callfire_sms_subscription.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

add_action('init', 'callfire_smssubscription_outbound');
function callfire_smssubscription_outbound() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'sms-subscription_outbound' ) {
        // load the file if exists
        $load = locate_template('callfire_sms_subscription_outbound.php', true);
        if ($load) {
            exit(); // just exit if template was found and loaded
        }
    }
}

add_action('init', 'callfire_callsubscription_outbound');
function callfire_callsubscription_outbound() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'call-subscription_outbound' ) {
        // load the file if exists
        $load = locate_template('callfire_call_subscription_outbound.php', true);
        if ($load) {
            exit(); // just exit if template was found and loaded
        }
    }
}

add_action( 'updated_post_meta', 'after_post_meta', 10, 4 );
function after_post_meta( $meta_id, $post_id, $meta_key, $meta_value )
{
    global $wpdb;
    if ( 'callfire_category' == $meta_key || 'study_no' == $meta_key) {


        $study_no = get_post_meta($post_id, 'study_no',true );
        $callfire_category = get_post_meta($post_id, 'callfire_category',true );
        if ($callfire_category){
            $callfire_category = get_the_category_by_ID($callfire_category);
        }else{
            $callfire_category = '';
        }
        if (!$callfire_category || !$study_no){
            $new_callfire_category = get_post_field('post_name', $post_id);
        }else{
            $new_callfire_category = $callfire_category.' '.'('.$study_no.')';
        }

        $sql = "select * from `0gf1ba_subscriber_list` where post_id='$post_id' AND callfire_category IS NOT NULL AND callfire_category != '' order by id desc LIMIT 1;";
        $result = $wpdb->get_results($sql);
        if ($result){
            $old_category_name = $result[0]->callfire_category;
            if ($old_category_name != $new_callfire_category){
                update_callfire_category($old_category_name, $new_callfire_category);
                mysql_query("UPDATE 0gf1ba_subscriber_list SET callfire_category='$new_callfire_category' WHERE post_id='$post_id' ");
            }

        }
    }
}

function update_callfire_category($old_category_name, $new_category_name){
    $user = '41530ff4e2a8';
    $password = 'a44dd745a81cca3c';
    $authentication = 'Authorization: Basic '.base64_encode("$user:$password");

    $url = 'https://api.callfire.com/v2/contacts/lists';
    $params = array('name' => $old_category_name);
    $query = http_build_query($params);
    //$url .= '.json';
    $fullUrl = "$url?$query";
    $http = curl_init($fullUrl);
    curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', $authentication));
    $contact_lists_json = curl_exec($http);
    $contact_lists = json_decode($contact_lists_json);

    if ($contact_lists){
        $contact_list_id = $contact_lists->items[0]->id;
        $params = array('name' => $new_category_name);
        $url = 'https://api.callfire.com/v2/contacts/lists/'.$contact_list_id;
        $http = curl_init($url);
        curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($http, CURLOPT_URL, $url);
        curl_setopt($http, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($http, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($http, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json', $authentication));
        $res = curl_exec($http);

        return true;
    }else{
        return false;
    }
}

add_action('get_received_messages_cron', 'get_received_messages');
function get_received_messages(){

    global $wpdb;
    $user = '41530ff4e2a8';
    $password = 'a44dd745a81cca3c';
    $authentication = 'Authorization: Basic '.base64_encode("$user:$password");

    $from_interval = new DateTime('now');
    $from_interval->sub(new DateInterval('PT20M'));

    $url = 'https://api.callfire.com/v2/texts';
    $params = array('results' => 'RECEIVED', 'intervalBegin' => $from_interval->getTimestamp().'000');
    $query = http_build_query($params);
    $fullUrl = "$url?$query";
    $http = curl_init($fullUrl);
    curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', $authentication));
    $texts_json = curl_exec($http);
    $texts = json_decode($texts_json);

    if (isset($texts->items)){
        foreach($texts->items as $item){
            $date = date('Y-m-d H:i:s', ($item->created/1000));
            $sql = 'SELECT * FROM 0gf1ba_calldata WHERE receive_date_time = \''.mysql_real_escape_string($date).'\' ';
            $res = $wpdb->get_results($sql);

            if (!$res){
                $subs_id = '';
                $to_number = substr($item->toNumber, 1, 10);
                $from_number = substr($item->fromNumber, 1, 10);
                $type = 1;
                $status = 'RECEIVED';
                $received = $date;
                $current = date('Y-m-d H:i:s',strtotime('-7 hours')); //get from get_sms_details.php:33

                $sql = "select pm.post_id as post_id, s.id as patient_id from 0gf1ba_postmeta as pm JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $from_number) where pm.meta_key='purchased_number' and pm.meta_value=$to_number order by pm.meta_id desc";
                $result2=mysql_query($sql);
                $numpostid=0;

                while($row = mysql_fetch_assoc($result2)) {
                    $stss=get_post_status( $row["post_id"] );
                    if($stss !='inherit'){
                        $numpostid=$row["post_id"];
                        $patient_id = $row["patient_id"];
                        $campaign = get_post_meta( $numpostid, 'renewed', true );
                        $sql_insert = 'INSERT INTO `0gf1ba_calldata`(`id`, message, json_data, `subscription_id`, `to_number`, `from_number`, `type`, `status`, `receive_date_time`, `created`, `campaign`, study_id, patient_id) VALUES'.
                            ' (NULL, \''.mysql_real_escape_string($item->message).'\', '.
                            ' \''.mysql_real_escape_string($texts_json).'\', '.
                            ' \''.mysql_real_escape_string($subs_id).'\', '.
                            ' \''.mysql_real_escape_string($to_number).'\', '.
                            ' \''.mysql_real_escape_string($from_number).'\', '.
                            ' \''.mysql_real_escape_string($type).'\', '.
                            ' \''.mysql_real_escape_string($status).'\', '.
                            ' \''.mysql_real_escape_string($received).'\', '.
                            ' \''.mysql_real_escape_string($current).'\', '.
                            ' \''.mysql_real_escape_string($campaign).'\', '.
                            ' \''.mysql_real_escape_string($numpostid).'\', '.
                            ' \''.mysql_real_escape_string($patient_id).'\'); ';
                        mysql_query($sql_insert);

                        if (isset($item->records) && isset($item->records[0]) && isset($item->records[0]->billedAmount)){
                            updateCallfireCredits($numpostid, $item->records[0]->billedAmount);
                        }
                    }
                }
            }
        }
    }
}

add_action('init', 'refactor_calls_table');
function refactor_calls_table(){
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'refactor_calls_table' ) {
        global $wpdb;
        $sql = 'SELECT * FROM 0gf1ba_calldata WHERE type != 2 AND message != "" AND study_id IS NULL AND patient_id is NULL ;';
        $res = $wpdb->get_results($sql);
        if ($res){
            foreach($res as $row){
                if($row->in_out == 2 && $row->sent_number != 0){
                    $sql = 'SELECT * FROM 0gf1ba_subscriber_list WHERE phone = \''.mysql_real_escape_string($row->sent_number).'\' ';
                }elseif($row->in_out == 1 && $row->to_number !=0 && $row->from_number !=0){
                    $sql = "select pm.post_id as post_id, s.id as id from 0gf1ba_postmeta as pm JOIN 0gf1ba_subscriber_list as s ON (s.post_id = pm.post_id AND s.phone = $row->from_number) where pm.meta_key='purchased_number' and pm.meta_value=$row->to_number order by pm.meta_id desc";
                }else{
                    echo 'ERROR id = '.$row->id.'<br/>';
                    continue;
                }

                $patient_info_arr = $wpdb->get_results($sql);
                if ($patient_info_arr){
                    foreach($patient_info_arr as $key => $patient){
                        if ($key == 0){
                            $wpdb->query('UPDATE 0gf1ba_calldata SET study_id = \''.mysql_real_escape_string($patient->post_id).'\', patient_id = \''.mysql_real_escape_string($patient->id).'\'  WHERE id = '.mysql_real_escape_string($row->id).' ;');
                        }else{
                            $wpdb->query('INSERT INTO 0gf1ba_calldata (subscription_id, to_number, from_number, type, status, message, call_duration, campaign, json_data, receive_date_time, created, sent_number, in_out, is_read, study_id, patient_id) VALUES ('.
                                ' \''.mysql_real_escape_string($row->subscription_id).'\', '.
                                ' \''.mysql_real_escape_string($row->to_number).'\', '.
                                ' \''.mysql_real_escape_string($row->from_number).'\', '.
                                ' \''.mysql_real_escape_string($row->type).'\', '.
                                ' \''.mysql_real_escape_string($row->status).'\', '.
                                ' \''.mysql_real_escape_string($row->message).'\', '.
                                ' \''.mysql_real_escape_string($row->call_duration).'\', '.
                                ' \''.mysql_real_escape_string($row->campaign).'\', '.
                                ' \''.mysql_real_escape_string($row->json_data).'\', '.
                                ' \''.mysql_real_escape_string($row->receive_date_time).'\', '.
                                ' \''.mysql_real_escape_string($row->created).'\', '.
                                ' \''.mysql_real_escape_string($row->sent_number).'\', '.
                                ' \''.mysql_real_escape_string($row->in_out).'\', '.
                                ' \''.mysql_real_escape_string($row->is_read).'\', '.
                                ' \''.mysql_real_escape_string($patient->post_id).'\', '.
                                ' \''.mysql_real_escape_string($patient->id).'\' )'
                            );
                        }
                    }
                }
            }
        }
        echo 'END';die;
    }
}

add_action('init', 'callfire_calldetails');
function callfire_calldetails(){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'getcalldetails' ) {
	// load the file if exists
	$load = locate_template('get_call_details.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

add_action('init', 'callfire_ivr_calldetails');
function callfire_ivr_calldetails(){
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'getivrcalldetails' ) {
        // load the file if exists
        callfireTextTestLog("ivr api call");
    }
}

add_action('init', 'callfire_smsdetails');
function callfire_smsdetails() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'getsmsdetails' ) {
	// load the file if exists
	$load = locate_template('get_sms_details.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

add_action('init', 'callfire_calldetails_outbound');
function callfire_calldetails_outbound(){
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'getcalldetails_outbound' ) {
        // load the file if exists
        $load = locate_template('getcalldetails_outbound.php', true);
        if ($load) {
            exit(); // just exit if template was found and loaded
        }
    }
}

add_action('init', 'callfire_smsdetails_outbound');
function callfire_smsdetails_outbound() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'getsmsdetails_outbound' ) {
        // load the file if exists
        $load = locate_template('getsmsdetails_outbound.php', true);
        if ($load) {
            exit(); // just exit if template was found and loaded
        }
    }
}

add_action('init', 'projectdashboard_top');
function projectdashboard_top() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'topdashboard' ) {
	// load the file if exists
	$load = locate_template('refresh-top.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}


add_action('init', 'callfire_numbers');
function callfire_numbers(){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'getnumbers' ) {
	// load the file if exists
	$load = locate_template('get_callfire_numbers.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}


add_action('init', 'callfire_ivr_details');
function callfire_ivr_details(){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'getivrdetails' ) {
	// load the file if exists
	$load = locate_template('callfirecron.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
	}
  }
}

add_action('init', 'send_messages');
function send_messages(){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'sendsms' ) {
	// load the file if exists
	$load = locate_template('send_text_messages.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

add_action('init', 'check_callfire');

function check_callfire() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'checkcallfire' ) {
	// load the file if exists
	$load = locate_template('message_new_file.php', true);
	if ($load) {
		exit(); // just exit if template was found and loaded
     }
  }
}

/*
 * Adding the column
 */
function rd_user_id_column( $columns ) {
	$columns['user_id'] = 'ID';
	return $columns;
}
add_filter('manage_users_columns', 'rd_user_id_column');

function rd_user_rewards_allowed_column( $columns ) {
    $columns['rewards_allowed'] = 'Rewards allowed';
    return $columns;
}
add_filter('manage_users_columns', 'rd_user_rewards_allowed_column');

function rd_user_backend_checkout_column( $columns ) {
    $columns['backend_checkout'] = 'Backend Checkout';
    return $columns;
}
add_filter('manage_users_columns', 'rd_user_backend_checkout_column');

/*
 * Column content
 */
function rd_user_id_column_content($value, $column_name, $user_id) {
	if ($column_name == 'user_id'){
		return $user_id;
    }
	return $value;
}
add_action('manage_users_custom_column',  'rd_user_id_column_content', 10, 3);

function rd_user_is_rewards_allowed_column_content($value, $column_name, $user_id) {
    if($column_name == 'rewards_allowed'){
        return get_user_meta($user_id, 'rewards_allowed', true);
    }
    return $value;
}
add_action('manage_users_custom_column', 'rd_user_is_rewards_allowed_column_content', 10, 3);

function rd_user_backend_checkout_column_content($value, $column_name, $user_id) {
    if($column_name == 'backend_checkout'){
        return '<a class="preview button" style="float: none;" href="users.php?page=custom-invoice&action=invite&user='.$user_id.'">Invoice</a>';
    }
    return $value;
}
add_action('manage_users_custom_column', 'rd_user_backend_checkout_column_content', 10, 3);

/*
 * Column style (you can skip this if you want)
 */
function rd_user_id_column_style(){
	echo '<style>.column-user_id{width: 5%}</style>';
}
add_action('admin_head-users.php',  'rd_user_id_column_style');
//
function my_deregister_heartbeat() {
    global $pagenow;

    if ( 'post.php' != $pagenow && 'post-new.php' != $pagenow ) {
         wp_deregister_script('heartbeat');
         wp_register_script('heartbeat', false);
     }
}
add_action( 'admin_enqueue_scripts', 'my_deregister_heartbeat' );

add_action( 'wp_ajax_nopriv_check_username', 'my_check_username' );
add_action('wp_ajax_check_username', 'my_check_username');
function my_check_username(){
  get_template_part('dashboard_check_username');
  exit;
}

add_action('auto_privatizing_cron', 'auto_privatizing');
function auto_privatizing(){
    get_template_part('auto_private');
    exit;
}

add_action('callfire_postponed_tasks', 'run_callfire_postponed_tasks');
//run_callfire_postponed_tasks();die;
function run_callfire_postponed_tasks(){
    callfireTestLog("init run_callfire_postponed_tasks");
    global $wpdb;
    $cur_date = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'SELECT * FROM 0gf1ba_callfire_postponed_requests WHERE status = \'created\' '
        .' AND start_date < \''.mysql_real_escape_string($cur_date->format('Y-m-d H:i:s')).'\' ';
    $res = $wpdb->get_results($sql);

    foreach($res as $val){
        $_REQUEST['post_id'] = unserialize($val->request)['post_id'];
        $_REQUEST['email'] = unserialize($val->request)['email'];
        $_REQUEST['phone_number12'] = unserialize($val->request)['phone_number12'];
        $_REQUEST['message'] = unserialize($val->request)['message'];
        mysql_query('UPDATE 0gf1ba_callfire_postponed_requests SET status = \'end\' WHERE id = \''.mysql_real_escape_string($val->id).'\' ');
        get_template_part('callfire_after_subscription');
        //require_once("callfire_after_subscription.php");
    }
    callfireTestLog("end run_callfire_postponed_tasks");
}

function callfireTestLog($str){
    $str = mysql_real_escape_string($str);
//    mysql_query("INSERT INTO callfire_test (value) VALUES ('$str')");
}

function callfireTextTestLog($str){
    $str = mysql_real_escape_string($str);
    mysql_query("INSERT INTO callfire_test (value) VALUES ('$str')");
}

function merge_query_posts($args1, $args2) {
    global $wp_query;
    query_posts($args1);
//            print_r($_query_base_args);
    $_tmp_results1 = $wp_query->posts;

    query_posts( $args2);
    $_tmp_results2 = $wp_query->posts;
//                                                print_r($_tmp_results2);
    // run through $_tmp_results2 to exclude posts from $_tmp_results1
    foreach($_tmp_results2 as $_tmp_results2_key => $_tmp_results2_value){
        foreach($_tmp_results1 as $_tmp_results1_value){
            if($_tmp_results2_value->ID == $_tmp_results1_value->ID){
                unset($_tmp_results2[$_tmp_results2_key]);
                break;
            }
        }
    }


    $wp_query->posts = array_merge($_tmp_results1, $_tmp_results2);
    $wp_query->post_count = count($wp_query->posts);
}
add_action( 'admin_menu', 'callfire_numbers_plugin' );

function callfire_numbers_plugin() {
    add_options_page( 'Callfire Numbers', 'Callfire Numbers', 'manage_options', 'callfire_numbers', 'callfire_numbers_plugin_options' );
    add_submenu_page( null, 'Patients', 'Patients', 'manage_options', 'study_patients', 'study_patients_page');
	add_options_page( 'Clinical Trials Subscribers', 'Clinical Trials Subscribers', 'manage_options', 'subscribers', 'main_page_subscribers' );
}

add_action( 'admin_menu', 'orders_admin_menu' );

function orders_admin_menu() {
    add_menu_page( esc_html__( 'Studykik Order Manage', 'studykik-order-manage' ), esc_html__( 'Studykik Order Manage', 'studykik-order-manage' ), 'manage_options', 'order_manage_page', 'order_manage_page' );
    add_submenu_page( null, esc_html__( 'Studykik Order Manage', 'studykik-order-manage' ), null, 'manage_options', 'order_detail_page', 'order_detail_page' );
}

function order_manage_page() {
    global $wpdb;
    if (is_user_logged_in()) {
        $user_ID = get_current_user_id();
    } else {
        wp_redirect(site_url().'/login/', 301);
        exit;
    }

    $month = $_REQUEST['month_select'];
    $year = $_REQUEST['year_select'];
    $user_id = $_REQUEST['user_id'];
    $user_login = $_REQUEST['user_login'];
    $customer = stripslashes(trim($_REQUEST['customer']));
//        $user = $_REQUEST['user'];
    $page_num = $_REQUEST['page_num'] > 0 ? $_REQUEST['page_num'] : 1;
    $limit = $_REQUEST['limit']> 0 ? $_REQUEST['limit'] : 50;
    $offset = ($page_num - 1) * $limit;

    $tb_orders = $wpdb->prefix."orders";
    $tb_users = $wpdb->prefix."users";

    $query_orders = array();
    $total_count = 0;
    $year_query = "";
    $month_query = "";
    $condition = "(customer like '%$customer%' or invoice_number like '%$customer%')";
    if ($month > 0) {
        $condition .= " and MONTH(created_at)=$month";
    }

    if ($year > 0) {
        $condition .= " and YEAR(created_at)=$year";
    }

//    print_r("SELECT * FROM $tb_orders WHERE ".$condition." ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
    $query_orders = $wpdb->get_results( "SELECT * FROM $tb_orders WHERE ".$condition." ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
    $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM $tb_orders WHERE ".$condition);

    include("order-manage-page.php");
}

function order_detail_page() {
    global $wpdb;

    $order_id = $_REQUEST['id'];
    $tb_orders = $wpdb->prefix."orders";
    $tb_ordermeta = $wpdb->prefix."ordermeta";
    $tb_users = $wpdb->prefix."users";
    $current_link = get_bloginfo("url").$_SERVER[REQUEST_URI];

    $sql = $wpdb->prepare("select $tb_orders.*, $tb_users.user_login from $tb_orders left join $tb_users on ($tb_orders.user_id = $tb_users.ID) where $tb_orders.id=$order_id");

    $order_record = $wpdb->get_results($sql);
    $user_name = $order_record[0]->user_login;
    $created_at = $order_record[0]->created_at;
    $total = $order_record[0]->total;
    $invoice_number = $order_record[0]->invoice_number;
    $customer = $order_record[0]->customer;
    if ($invoice_number == "" || $invoice_number == "0" || $invoice_number == null) {
        if ($total == 0)
            $invoice_number = "Free";
        else
            $invoice_number = "Check";
    }

    $message = get_ordermeta($order_id, "message");
    $invoices = maybe_unserialize(get_ordermeta($order_id, "invoices"));
    include("order-detail-page.php");
}

function get_ordermeta($order_id, $meta_key) {
    global $wpdb;
    $tb_ordermeta = $wpdb->prefix."ordermeta";
    $sql = $wpdb->prepare("select $tb_ordermeta.meta_value from $tb_ordermeta where $tb_ordermeta.order_id=%d and $tb_ordermeta.meta_key='%s' ", $order_id, $meta_key);
//    print_r($sql);
    $order_record = $wpdb->get_results($sql);
    if (count($order_record)>0) {
        return $order_record[0]->meta_value;
    } else {
        return null;
    }
}

function study_patients_page(){
    get_template_part( 'study-patients');
}

function callfire_numbers_plugin_options() {
    global $wpdb;
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    $sql = 'SELECT cn.phone_number, p.post_title, p.id as post_id '
            .'FROM 0gf1ba_callfire_numbers as cn '
            .'JOIN 0gf1ba_postmeta as pm ON (pm.meta_value = cn.phone_number AND meta_key = \'purchased_number\') '
            .'JOIN 0gf1ba_posts as p ON (p.id = pm.post_id AND p.post_status != \'inherit\')  '
            .'WHERE number_type = \'2\' GROUP BY p.id ORDER by cn.phone_number;';
    $result = $wpdb->get_results($sql);
    $html = '<h1>Callfire Numbers</h1>';
    if ($result){
        $html .= '<table style="border-collapse: collapse;" border="1" cellpadding="6" cellspacing="1">';
        $html .= '<thead><td>Purchased number</td><td>Study</td><td>From number</td><td>Phone #</td></thead>';
        foreach ($result as $row) {
            $post_edit_url = site_url().'/wp-admin/post.php?post='.$row->post_id.'&action=edit';
            $study_no = get_post_meta($row->post_id, 'study_no',true );
            $from_number = get_post_meta($row->post_id, 'from_number',true );
            $phone_number = get_post_meta($row->post_id, 'phone_number',true );

            $html .= '<tr>'.
                    '<td>'.$row->phone_number.'</td>'.
                    '<td>'.$row->post_title.'  (<a href=\''.$post_edit_url.'\'>'.($study_no?$study_no:'Study # is not set').'</a>)</td>'.
                    '<td>'.$from_number.' </td>'.
                    '<td>'.$phone_number.' </td>'.
                    '</tr>';
        }
        $html .= '</table>';
    }
    echo $html;
}

function updateCallfireCredits($post_id, $credits_spent, $is_send_email = true){
    $pur_num = get_post_meta($post_id, 'purchased_number', true );
    if($pur_num !=""){
        global $wpdb;
        $author_id = get_post_field( 'post_author', $post_id );
		$isEmailSend = get_user_meta($author_id, 'is_low_balance_email_send', true);
        $credits = getCallfireCredits($post_id);
        $credits_left = $credits - $credits_spent;
        if ($credits_left <= 0 && $is_send_email){
            $credits_left = 0;
            $post = get_post($post_id);
            $user = get_user_by('id', $author_id);
            $text = 'Dear Valued Study Site:<br/><br/>You are out of Account Credits for your StudyKIK Patient Messaging Suite!'.
                '<br/><br/>To continue texting your patients, please login to your MyStudyKIK Portal and click "Add Credits." '.
                '<br/><br/><a href="https://studykik.com/login">Click Here</a> to login.'.
                '<br/><br/>Thank you!<br/><br/><img src="http://studykik.com/wp-content/themes/twentythirteen/images/logo.png" />';

            $emails = array();
            $email = $user->user_email;
            if ($email && !strpos($email, '@studykik.com')){
                $emails[] = $email;
            }
            for($i = 2; $i <=5; $i++){
                $tmp_email = get_user_meta($author_id, ('emailadd'.$i), true);
                if ($tmp_email){
                    $emails[] = $tmp_email;
                }
            }

            $sql = 'SELECT p.ID FROM 0gf1ba_posts as p WHERE p.post_author = '.$author_id.';';
            $result = $wpdb->get_results($sql);
            if ($result){
                foreach ($result as $row){
                    for($i = 2; $i <=7; $i++){
                        $tmp_email = get_post_meta($row->ID, ('email_adress_'.$i), true);
                        if ($tmp_email && !strpos($tmp_email, '@studykik.com')){
							$emails[] = $tmp_email;
                        }
                    }
                }

            }
			$emails = array_unique($emails);
			if (!empty($emails)) {
				$subject = $user->user_login.' is Out of Account Credits! (StudyKIK Patient Messaging Suite)';
				if (!$isEmailSend){
					wp_mail( $emails, $subject, $text, 'Content-Type: text/html' );
					update_user_meta($author_id, 'is_low_balance_email_send', true);
				}
			}
        }else{
			update_user_meta($author_id, 'is_low_balance_email_send', false);
		}

        if ($credits_left <= 0){
            $credits_left = 0;
        }
        addToCallfireCreditsLog($author_id, $credits, $credits_left, 'Spent credits');
        update_user_meta($author_id, 'callfire_credits', $credits_left);
        $memcache = new Memcache;
        $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);
        if ($is_memcache_connected){
            $memcache->set('callfir_credits_'.$author_id, $credits_left, false, 3600);
        }
    }
}

// return false if callfire credits is set and < 0
function isEnoughCredits($post_id, $enough_is=1){
    $author_id = get_post_field( 'post_author', $post_id );
    $credits = getCallfireCredits($post_id);
    $pr_num = get_post_meta($post_id, 'purchased_number', true);
    if ($pr_num){
         if ($credits > ($enough_is - 1)){
             return true;
         }else{
             return false;
         }
    }else{
        return true;
    }
}

function getCallfireCredits($post_id){
    $author_id = get_post_field( 'post_author', $post_id );
    $credits = get_user_meta($author_id, 'callfire_credits', true);
    if ($credits === false){
        addToCallfireCreditsLog($author_id, 0, 0, 'Init credits');
        update_user_meta($author_id, 'callfire_credits', 0);
        $memcache = new Memcache;
        $is_memcache_connected = $memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT);
        if ($is_memcache_connected){
            $memcache->set('callfir_credits_'.$author_id, 0, false, 3600);
        }
        return 0;
    }else{
        return $credits;
    }
}

function callfireAddToContactList($post_id, $numb){

    $callfire_time_zone= get_post_meta($post_id, 'callfire_time_zone',true );
    $study_no=get_post_meta($post_id, 'study_no',true );
    $callfire_category=get_post_meta($post_id, 'callfire_category',true );
    $callfire_cat=$callfire_category;

    $category_real_name = '';
    if ($callfire_cat !=""){
        $category_real_name = get_the_category_by_ID($callfire_cat);
    }

    if (!$category_real_name || !$study_no){
        $callfire_category = get_post_field('post_name', $post_id);
    }else{
        $callfire_category=$category_real_name.' '.'('.$study_no.')';
    }
    $callfire_contact=$numb;


    if($callfire_category !='' && $callfire_contact !=''){
        $wsdl = "http://callfire.com/api/1.1/wsdl/callfire-service-http-soap12.wsdl";
        $client = new SoapClient($wsdl, array(
            'soap_version' => SOAP_1_2,
            'login'        => '41530ff4e2a8',
            'password'     => 'a44dd745a81cca3c'));
        $contact_no=$callfire_contact;
        $query = new stdclass();
        $query->MaxResults = 10000; // long
        $query->FirstResult = 0; // long
        try{
            callfireTestLog('try QueryContactLists');
            $response = $client->QueryContactLists($query);
        }catch (Exception $e){
            callfireTestLog('error QueryContactLists');
            callfireTestLog(serialize($e));
            sendErrorEmails($e->getMessage());
            createPostponedTask($_REQUEST);die;
        }
        $response = json_decode(json_encode($response), true);

        $category_name=$callfire_category;
        $list_arr=array();
        if(isset($response['ContactList'][0])){
            foreach($response['ContactList'] as $cnt){
                if($cnt['Name']==$category_name){
                    $list_arr=$cnt;
                    break;
                }
            }
        }
        else{
            if(isset($response['ContactList']['id'])){
                $ct_data=$response['ContactList'];
                $response['ContactList']=array();
                $response['ContactList'][0]=$ct_data;
                foreach($response['ContactList'] as $cnt){
                    if($cnt['Name']==$category_name){
                        $list_arr=$cnt;
                        break;
                    }
                }
            }
        }
        if(empty($list_arr)){
            $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$numb' order by id desc limit 1");

            while($row = mysql_fetch_assoc($result_cat)) {
                //print_r($row);
                $id=$row["id"];
                $fname=$row["name"];
            }
            $request = new stdClass();
            $request->Name =$category_name; // string required
            $request->Validate=false;
            $request->ContactSource = new stdclass(); //  required
            $request->ContactSource->Contact = array(); //required choice
            $request->ContactSource->Contact[0] = new stdClass(); // object
            //$request->ContactSource->Contact[0]->firstName = 'kamala1'; // string
            $request->ContactSource->Contact[0]->firstName = $fname; // string
            $request->ContactSource->Contact[0]->lastName = ''; // string
            $request->ContactSource->Contact[0]->mobilePhone = $callfire_contact; // PhoneNumber
            try{
                callfireTestLog('try CreateContactList');
                $response = $client->CreateContactList($request);
            }catch (Exception $e){
                callfireTestLog('error CreateContactList');
                callfireTestLog(serialize($e));
                sendErrorEmails($e->getMessage());
                createPostponedTask($_REQUEST);die;
            }

        }
        else{
            //print_r($list_arr);
            $list_id=$list_arr['id'];
            $query = new stdclass();
            $query->MaxResults = 1000; // long
            $query->FirstResult = 0; // long
            $query->Field = 'mobilePhone'; // long
            $query->ContactListId = $list_id; // long
            $query->String = $contact_no; // long
            try{
                callfireTestLog('try QueryContacts');
                $response = $client->QueryContacts($query);
            }catch (Exception $e){
                callfireTestLog('error QueryContacts');
                callfireTestLog(serialize($e));
                sendErrorEmails($e->getMessage());
                createPostponedTask($_REQUEST);die;
            }
            $response = json_decode(json_encode($response), true);
            // print_r($response);
            $is_exist=0;
            if(isset($response['TotalResults'])){
                if($response['TotalResults'] > 0 ){
                    $is_exist=1;
                }
            }
            if($is_exist==0){
                //    echo "hii";
                $result_cat=mysql_query("select * from `0gf1ba_subscriber_list` where post_id='$post_id' and phone='$numb' order by id desc limit 1");

                while($row = mysql_fetch_assoc($result_cat)) {
                    //print_r($row);
                    $id=$row["id"];
                    $fname=$row["name"];
                }
                $request = new stdClass();
                $request->ContactListId = $list_id; // long required
                $request->ContactSource = new stdClass(); // required
                $request->ContactSource->Contact = array();
                //$request->ContactSource->Contact[0]['firstName'] = "roshan";
                $request->ContactSource->Contact[0]['firstName'] =$fname;
                $request->ContactSource->Contact[0]['lastName'] = "";
                $request->ContactSource->Contact[0]['mobilePhone'] = $contact_no;
                try{
                    callfireTestLog('try AddContactsToList');
                    $client->AddContactsToList($request);
                }catch (Exception $e){
                    callfireTestLog('error AddContactsToList');
                    callfireTestLog(serialize($e));
                    sendErrorEmails($e->getMessage());
                    createPostponedTask($_REQUEST);die;
                }
            }
        }

        mysql_query("UPDATE 0gf1ba_subscriber_list SET callfire_category='$callfire_category' WHERE id='$id'");
    }
}

function process_user_option_update( $user_id, &$errors ) {
    global $wpdb;
    $total_count = $_POST['add_c_count'];
    for($i = 0; $i < $total_count; $i++){
        $username = $_POST['add_c_username_'.$i];
        $email = $_POST['add_c_email_'.$i];
        $password = $_POST['add_c_password_'.$i];
        $is_deleted = $_POST['add_c_delete_id_'.$i];
        $add_user_id = (isset($_POST['add_c_id_'.$i])?$_POST['add_c_id_'.$i]:NULL);
        if ($is_deleted ){
            //delete from db by id
            if ($add_user_id){
                $sql = 'DELETE FROM 0gf1ba_user_additional_credentials WHERE id = \''.mysql_real_escape_string($add_user_id).'\'; ';
                $wpdb->query($sql);
            }
        }elseif(!$add_user_id && $username && $password && $email){
            //insert
            if (addCredentialsIsUserUnique($username, $email, 'insert', $errors)){
                $sql = 'INSERT INTO 0gf1ba_user_additional_credentials (username, email, password, parent_id) VALUES (\''.mysql_real_escape_string($username).'\', \''.mysql_real_escape_string($email).'\', \''.mysql_real_escape_string(addCredentialsGeneratePwd($password)).'\', \''.mysql_real_escape_string($user_id).'\');';
                $wpdb->query($sql);
            }else{
                $errors->add( 'invalid_email', __( '<strong>ERROR</strong>: Error while saving credentials for '.$username  ), array( 'form-field' => 'email' ) );
            }
        }elseif($add_user_id && $username && $email){
            if (addCredentialsIsUserUnique($username, $email, 'update', $errors, $add_user_id)){
                if ($password){
                    $sql = 'UPDATE 0gf1ba_user_additional_credentials SET username = \''.mysql_real_escape_string($username).'\', email = \''.mysql_real_escape_string($email).'\', password = \''.mysql_real_escape_string(addCredentialsGeneratePwd($password)).'\' WHERE id = \''.mysql_real_escape_string($add_user_id).'\'; ';
                }else{
                    $sql = 'UPDATE 0gf1ba_user_additional_credentials SET username = \''.mysql_real_escape_string($username).'\', email = \''.mysql_real_escape_string($email).'\' WHERE id = \''.mysql_real_escape_string($add_user_id).'\'; ';
                }
            }
            $wpdb->query($sql);
        }
    }
    if (isset($_POST['callfire_credits']) && get_user_meta($user_id, 'callfire_credits', true) != $_POST['callfire_credits']){
        addToCallfireCreditsLog($user_id, get_user_meta($user_id, 'callfire_credits', true), $_POST['callfire_credits'], 'Admin user update');
    }
}

function addCredentialsGeneratePwd($password){
    global $wp_hasher;
    $hashedPassword = wp_hash_password($password);

    //var_dump($wp_hasher->CheckPassword('322555', $hashedPassword));
    return $hashedPassword;
}

function addCredentialsIsUserUnique($username, $email, $action, &$errors, $row_id = null){
    global $wpdb;

    switch($action){
        case 'update':
            $sql = 'SELECT * FROM 0gf1ba_user_additional_credentials WHERE (username = \''.mysql_real_escape_string($username).'\' OR email = \''.mysql_real_escape_string($email).'\') AND id != '.mysql_real_escape_string($row_id).';';
            $res1 = $wpdb->get_results($sql);
            break;
        case 'insert':
            default:
            $sql = 'SELECT * FROM 0gf1ba_user_additional_credentials WHERE username = \''.mysql_real_escape_string($username).'\' OR email = \''.mysql_real_escape_string($email).'\';';
            $res1 = $wpdb->get_results($sql);
            break;
    }

    $sql = 'SELECT * FROM 0gf1ba_users WHERE user_login = \''.mysql_real_escape_string($username).'\' OR user_email = \''.mysql_real_escape_string($email).'\';';
    $res2 = $wpdb->get_results($sql);

    if ($res1 || $res2){
        return false;
    }else{
        return true;
    }
}

function addToCallfireCreditsPayments($type, $value, $broadcast_id, $post_id){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'INSERT INTO callfire_credits_payments (create_date, modified_date, type, status, value, broadcast_id, post_id) VALUES ('.
            ' \''.mysql_real_escape_string($now->format('Y-m-d H:i:s')).'\', '.
            ' \''.mysql_real_escape_string($now->format('Y-m-d H:i:s')).'\', '.
            ' \''.mysql_real_escape_string($type).'\', '.
            ' \'pending\', '.
            ' \''.mysql_real_escape_string($value).'\', '.
            ' \''.mysql_real_escape_string($broadcast_id).'\', '.
            ' \''.mysql_real_escape_string($post_id).'\' '.
            '); ';
    mysql_query($sql);
}

function updateCallfireCreditsPayments($type, $value, $broadcast_id, $is_send_email){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'SELECT * FROM callfire_credits_payments WHERE '.
        ' broadcast_id = '.mysql_real_escape_string($broadcast_id).' AND type = \''.mysql_real_escape_string($type).'\' AND status = \'pending\' LIMIT 1;';

    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    if ($row){
        $diff = $value - $row['value'];

        updateCallfireCredits($row['post_id'], $diff, $is_send_email);

        $sql = 'UPDATE callfire_credits_payments SET modified_date = \''.mysql_real_escape_string($now->format('Y-m-d H:i:s')).'\', status = \'completed\' WHERE id = \''.mysql_real_escape_string($row['id']).'\';';
        mysql_query($sql);
    }
}

add_action('init', 'callfireAfterSubscription');

function callfireAfterSubscription() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'callfire_after_subscription' ) {
        if (isset($_POST['message']) && isset($_POST['phone_number12']) && isset($_POST['patient_id']) && isset($_POST['email']) && isset($_POST['post_id'])){
            $_REQUEST['message'] = $_POST['message'];
            $_REQUEST['phone_number12'] = $_POST['phone_number12'];
            $_REQUEST['patient_id'] = $_POST['patient_id'];
            $_REQUEST['email'] = $_POST['email'];
            $_REQUEST['post_id'] = $_POST['post_id'];

            require_once("callfire_after_subscription.php");
        }
        exit();
    }
}


/*  Honda - adding sections to Publish Box */

add_action( 'post_submitbox_misc_actions', 'history_publish_in_frontpage' );
function history_publish_in_frontpage($post)
{
    $value = get_post_meta($post->ID, '_history_publish_in_frontpage', true);
    echo '<div class="misc-pub-section misc-pub-section-last misc-pub-revisions">
         <span id="timestamp">'
         . 'History: <a class="hide-if-no-js" href="'.get_site_url().'/wp-admin/admin.php?page=track_history&id='.$_GET['post'].'"><span aria-hidden="true">Browse</span> <span class="screen-reader-text">Browse revisions</span></a>'
    .'</span></div>';
}





// add_action( 'save_post', 'post_updated_keep_history' );

function post_updated_keep_history($post_id, $post, $post1) {
	global $wpdb;
	$table_name = $wpdb->prefix . "posts_history";
	$user_ID = get_current_user_id();

	$post_status = get_post_status($post->id);
	$querystr = "SELECT * FROM $table_name WHERE post_id = $post_id AND user_id = $user_ID ORDER BY updated_at DESC";

	$result = $wpdb->get_results($querystr);
	if ($result[0]->history_value == $post_status)
		return;

	$wpdb->insert( $table_name, array( 'user_id' => $user_ID, 'post_id' => $post_id, 'history_title' => 'Status1', 'history_value' => $post_status ) );
}

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');

function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        null,
        'Track History',
        'Track History',
        'manage_options',
        'track_history',
        'wp_track_history' );
}

function wp_track_history() {
	global $wpdb;
	$table_name = $wpdb->prefix . "posts_history";
	$user_ID = get_current_user_id();
	$querystr = "SELECT * FROM $table_name WHERE post_id = ".$_GET["id"]." ORDER BY updated_at DESC";
	$results = $wpdb->get_results($querystr);
	echo "<h2>Track History</h2>";
	$html_content = '';
	$html_content .= '<table class="wp-list-table widefat fixed striped posts" style="width: 700px"><thead><tr>';
	$html_content .= '<th style="width: 50px">No</th><th>Author</th><th style="width: 100px;">Status</th><th>Updated_At</th>';
	$html_content .= '</tr></thead><tbody>';

	foreach ( $results as $key => $result ) {
		$display_name = get_userdata($result->user_id);
		$_index = $key + 1;
		$date = new DateTime($result->updated_at);
		$date->setTimezone(new DateTimeZone('America/Los_Angeles'));
		$html_content .= "<tr><td>$_index</td><td>$display_name->user_login</td><td>$result->history_value</td><td>".$date->format('m/d/Y g:i A')."</td></tr>";
	}
	$html_content .= '</tbody></table>';
	echo $html_content;
}

function insert_post_history($post_ID, $post_after, $post_before){
	global $wpdb;
	$table_name = $wpdb->prefix . "posts_history";
	if ($post_before->post_status == $post_after->post_status)
		return;
	$user_ID = get_current_user_id();
	$wpdb->insert( $table_name, array( 'user_id' => $user_ID, 'post_id' => $post_ID, 'history_title' => 'Status2', 'history_value' => $post_after->post_status ) );
}

add_action( 'post_updated', 'insert_post_history', 10, 3 );

add_action('init', 'newDashboardInit');

function newDashboardInit() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'project-manager-dashboard-2' ) {
		$posts_arr_test = array(1,2,3,4,5);
		//$load = locate_template('project_manager_dashboard.php', true);
	}
}

add_action('init', 'setTotalsInit');

function setTotalsInit() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'set_totals_init' ) {
		setTotals();
	}
}

add_action('init', 'setTotalsCronInit');

function setTotalsCronInit() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'set_totals_cron_init' ) {
		cron_update_all_post_totals();
	}
}

add_action('init', 'setOnlyTodayYesterdayTotals');

function setOnlyTodayYesterdayTotals() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'update_today_yesterday_totals' ) {
        updateOnlyTodayYesterdayTotals();
    }
}

function setTotals($post_id = null, $daily_update = false){

	$time_start = microtime(true);

	global $wpdb;
	if ($post_id){
		$where_part = "p.ID = ".mysql_real_escape_string($post_id);
	}else{
		$where_part = "1";
	}

	//$sql = "SELECT * FROM 0gf1ba_posts WHERE ".$where_part." AND post_status = 'publish';";
	$sql = "SELECT * FROM 0gf1ba_posts as p LEFT JOIN 0gf1ba_study_totals as st ON p.ID = st.post_id WHERE ".$where_part." AND p.post_type = 'post' AND p.post_status in ('publish', 'private')";

	$results = $wpdb->get_results($sql);
	$red_count = 0;
	$yellow_count = 0;
	$green_count = 0;
	$purple_count = 0;
	$counter = 0;

	$toal_counted = 0;
	$toal_today = 0;
	$toal_yesterday = 0;
	$new_patients_total = 0;
	$call_attempted_total = 0;
	$not_qualified_total = 0;
	$action_needed_total = 0;
	$scheduled_total = 0;
	$consented_total = 0;
	$randomized_total = 0;
	//var_dump($sql);
	//var_dump(count($results));die;
	foreach($results as $val) {
		$s_dt = get_post_meta($val->ID, 'study_start_date', true);
		$e_dt = get_post_meta($val->ID, 'study_end_date', true);
		if (true || ($e_dt && $s_dt)) {
			$counter++;

            $today = date('Y-m-d H:i:s',strtotime('-4 hours'));
            $today = new DateTime($today);

            $yesterday = date('Y-m-d H:i:s',strtotime('-28 hours'));
            $yesterday = new DateTime($yesterday);

			$Campaign = get_post_meta($val->ID, 'renewed',true );
			if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
				$Campaign = 1;
			}

			if (!$daily_update) {
				$sql_total = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND campaign = " . $Campaign . ";";
				$count_res = $wpdb->get_results($sql_total);
				if ($count_res) {
					$toal_counted = $count_res[0]->count;
				} else {
					$toal_counted = 0;
				}

				$sql_total_today = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND campaign = " . $Campaign . " AND date BETWEEN '" . $today->format('Y-m-d 00:00:00') . "' AND '" . $today->format('Y-m-d 23:59:59') . "' ;";
				$today_res = $wpdb->get_results($sql_total_today);
				if ($today_res) {
					$toal_today = $today_res[0]->count;
				} else {
					$toal_today = 0;
				}

				$sql_total_today = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND campaign = " . $Campaign . " AND date BETWEEN '" . $yesterday->format('Y-m-d 00:00:00') . "' AND '" . $yesterday->format('Y-m-d 23:59:59') . "' ;";
				$yessterday_res = $wpdb->get_results($sql_total_today);
				if ($yessterday_res) {
					$toal_yesterday = $yessterday_res[0]->count;
				} else {
					$toal_yesterday = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 1 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$new_patients_total = $res[0]->count;
				} else {
					$new_patients_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 2 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$call_attempted_total = $res[0]->count;
				} else {
					$call_attempted_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 3 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$not_qualified_total = $res[0]->count;
				} else {
					$not_qualified_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 7 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$action_needed_total = $res[0]->count;
				} else {
					$action_needed_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 4 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$scheduled_total = $res[0]->count;
				} else {
					$scheduled_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 5 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$consented_total = $res[0]->count;
				} else {
					$consented_total = 0;
				}

				$sql = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND row_num = 6 ;";
				$res = $wpdb->get_results($sql);
				if ($res) {
					$randomized_total = $res[0]->count;
				} else {
					$randomized_total = 0;
				}
			}


			$category_detail=get_the_category($val->ID);
			foreach($category_detail as $cd){
				$ct_nm=$cd->cat_name;
				$category_id = get_cat_ID( $ct_nm );
			}

			$tier =  get_option('category_'.$category_id.'_tier');
			if (!$tier){
				$tier = 0;
			}

			$custom_goal="";
			$exposure_level = get_post_meta($val->ID, 'exposure_level',true );
			$custom_goal = get_post_meta($val->ID, 'custom_goal',true );
			if($custom_goal==""){
				if($exposure_level == "Platinum")
				{
					$goal_total =  get_option('category_'.$category_id.'_platinum_goal');

				}elseif($exposure_level == "Gold")
				{
					$goal_total =   get_option('category_'.$category_id.'_gold_goal');

				}elseif($exposure_level == "Silver")
				{
					$goal_total =   get_option('category_'.$category_id.'_silver_goal');

				}elseif($exposure_level == "Bronze")
				{
					$goal_total =   get_option('category_'.$category_id.'_bronze_goal');

				}elseif($exposure_level == "Diamond")
				{
					$goal_total =   get_option('category_'.$category_id.'_diamond_goal');

				}
				elseif($exposure_level == "Ruby")
				{
					$goal_total =   get_option('category_'.$category_id.'_ruby_goal');

				}
				else{$goal_total ="";}
			}
			else{
				$goal_total=$custom_goal;
			}

			if ($goal_total == ''){
				$goal_total = 0;
			}

			if($e_dt && $s_dt) {
				if ($daily_update) {
					$toal_counted = $val->total;
				}
				$date2 = DateTime::createFromFormat('Ymd', $e_dt);
				$end_date = $date2->format('Y-m-d');
				$datetime1 = date_create(date('Y-m-d'));
				$datetime2 = date_create($end_date);
				$interval = date_diff($datetime1, $datetime2);
				$total_number_of_days = str_replace("+", "", $interval->format('%R%a'));
				$datetime3 = date_create(get_the_time('Y-m-d', $val->ID));
				$datetime4 = date_create($end_date);
				$interval2 = date_diff($datetime3, $datetime4);
				$total_number_of_days2 = str_replace("+", "", $interval2->format('%R%a'));
				$date_st = DateTime::createFromFormat('Ymd', $s_dt);
				$start_date = $date_st->format('Y-m-d');
				$fr_start_date = $date_st->format('Y-m-d');
				$datetimestart = date_create($start_date);
				$intervalstart = date_diff($datetimestart, $datetime4);
				$total_number_of_days_start = str_replace("+", "", $intervalstart->format('%R%a'));
				$daysof_total = $total_number_of_days_start;
				$days_left = $daysof_total - $total_number_of_days;
				$aa = $goal_total / $daysof_total * $days_left;
				if ($aa == 0) {
					$final_result = 0;
				} else {
					$final_result = number_format($toal_counted / $aa, 2);
				}
			}else{
				$daysof_total=0;
				$total_number_of_days=0;
				$days_left=0;
				$final_result=0;
				$end_format="";
				$end_date = '';
			}

			$is_any = 1;
			$color = "";
			if($days_left<=2){
				//purple
				$color = 'purple';
				$purple_count++;
				$is_any=0;


			} else {
				if($final_result < .87){
					//red
					$color = 'red';
					$red_count++;
					$is_any=0;

				}
				if($final_result > 1.2){
					//yellow
					$color = 'yellow';
					$yellow_count++;
					$is_any=0;
				}
			}

			if($is_any==1) {
				//green
				$color = 'green';
				$green_count++;
			}

			$sql = 'SELECT * FROM 0gf1ba_study_totals WHERE post_id = '.mysql_real_escape_string($val->ID).';';
			$row = $wpdb->get_results($sql);

			if ($row){
				if (!$daily_update) {
					$sql = '
						UPDATE 0gf1ba_study_totals SET
						total = ' . $toal_counted . ',
						today_total = ' . $toal_today . ',
						yesterday_total = ' . $toal_yesterday . ',
						campaign = '.$Campaign.',
						color = \'' . $color . '\',
					    goal = '.$goal_total.',
						tier = '.$tier.',
						final_result = '.$final_result.',
						new_patients_total = '.$new_patients_total.',
						call_attempted_total = '.$call_attempted_total.',
						not_qualified_total = '.$not_qualified_total.',
						action_needed_total = '.$action_needed_total.',
						scheduled_total = '.$scheduled_total.',
						consented_total = '.$consented_total.',
						randomized_total = '.$randomized_total.',
						start_date = \''.$fr_start_date.'\',
						days = '.$daysof_total.',
						days_left = '.$total_number_of_days.',
						end_date = \''.$end_date.'\'
						WHERE post_id = '.mysql_real_escape_string($val->ID).'
						';
				}else{
					$sql = '
						UPDATE 0gf1ba_study_totals SET
						yesterday_total = today_total,
						today_total = 0,
						campaign = '.$Campaign.',
						color = \'' . $color . '\',
					    goal = '.$goal_total.',
						tier = '.$tier.',
						final_result = '.$final_result.',
						start_date = \''.$fr_start_date.'\',
						days = '.$daysof_total.',
						days_left = '.$total_number_of_days.',
						end_date = \''.$end_date.'\'
						WHERE post_id = '.mysql_real_escape_string($val->ID).'
						';
				}

				$res = $wpdb->query($sql);
				if (!$res) {
					//var_dump($sql);
				}
			}else {
				$sql = 'INSERT INTO 0gf1ba_study_totals (post_id, total, today_total, yesterday_total, campaign, color, goal, tier, final_result, '
						. ' new_patients_total, call_attempted_total, not_qualified_total, action_needed_total, scheduled_total, consented_total, randomized_total, '
						. ' start_date, days, days_left, end_date) VALUES ('
						. ' ' . $val->ID . ', '
						. ' ' . $toal_counted . ', '
						. ' ' . $toal_today . ', '
						. ' ' . $toal_yesterday . ', '
						. ' ' . $Campaign . ', '
						. ' \'' . $color . '\', '
						. ' ' . $goal_total . ', '
						. ' ' . $tier . ', '
						. ' ' . $final_result . ', '
						. ' ' . $new_patients_total . ', '
						. ' ' . $call_attempted_total . ', '
						. ' ' . $not_qualified_total . ', '
						. ' ' . $action_needed_total . ', '
						. ' ' . $scheduled_total . ', '
						. ' ' . $consented_total . ', '
						. ' ' . $randomized_total . ', '
						. ' \'' . $fr_start_date . '\', '
						. ' ' . $daysof_total . ', '
						. ' ' . $total_number_of_days . ', '
						. ' \'' . $end_date . '\' '
						. ');';
				$res = $wpdb->query($sql);
				if (!$res) {
					//var_dump($sql);
				}
			}
			//die;
		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	var_dump($counter);
	echo "time is $time seconds\n";

}


add_action( 'save_post', 'post_updated_add_to_update_log' );

function post_updated_add_to_update_log($post_id){
	add_to_update_log($post_id);
}

function add_to_update_log($post_id){
	$sql = 'INSERT INTO 0gf1ba_update_totals_log (post_id, status) VALUES ('.mysql_real_escape_string($post_id).', \'created\');';
//	mysql_query($sql);
}

add_action('update_post_totals_from_log', 'cron_update_post_totals_from_log');
function cron_update_post_totals_from_log(){
	global $wpdb;
	$sql = 'SELECT * FROM 0gf1ba_update_totals_log WHERE status = \'created\' LIMIT 100';
	$result = $wpdb->get_results($sql);
	if ($result){
		$post_id_updated = array();
		foreach($result as $row){
			if (!in_array($row->post_id, $post_id_updated)){
				setTotals($row->post_id);
				$post_id_updated[] = $row->post_id;
			}
			$sql_upd = 'UPDATE 0gf1ba_update_totals_log SET status = \'done\' WHERE id = '.mysql_real_escape_string($row->id).';';
			mysql_query($sql_upd);
		}
	}
}

add_action('update_all_post_totals', 'cron_update_all_post_totals');
function cron_update_all_post_totals(){
	setTotals(null, true);
}

function updateOnlyTodayYesterdayTotals(){
    global $wpdb;
    $sql = "SELECT * FROM 0gf1ba_posts as p LEFT JOIN 0gf1ba_study_totals as st ON p.ID = st.post_id WHERE 1 AND p.post_type = 'post' AND p.post_status in ('publish', 'private')";

    $results = $wpdb->get_results($sql);

    $today = date('Y-m-d H:i:s',strtotime('-4 hours'));
    $today = new DateTime($today);

    $yesterday = date('Y-m-d H:i:s',strtotime('-28 hours'));
    $yesterday = new DateTime($yesterday);
    foreach($results as $val) {
        $Campaign = get_post_meta($val->ID, 'renewed',true );
        if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
            $Campaign = 1;
        }

        $sql_total_today = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND campaign = " . $Campaign . " AND date BETWEEN '" . $today->format('Y-m-d 00:00:00') . "' AND '" . $today->format('Y-m-d 23:59:59') . "' ;";
        $today_res = $wpdb->get_results($sql_total_today);
        if ($today_res) {
            $toal_today = $today_res[0]->count;
        } else {
            $toal_today = 0;
        }

        $sql_total_today = "SELECT COUNT(id) as count FROM 0gf1ba_subscriber_list WHERE post_id = " . $val->ID . " AND campaign = " . $Campaign . " AND date BETWEEN '" . $yesterday->format('Y-m-d 00:00:00') . "' AND '" . $yesterday->format('Y-m-d 23:59:59') . "' ;";
        $yessterday_res = $wpdb->get_results($sql_total_today);
        if ($yessterday_res) {
            $toal_yesterday = $yessterday_res[0]->count;
        } else {
            $toal_yesterday = 0;
        }

        $sql = '
                UPDATE 0gf1ba_study_totals SET

                today_total = ' . $toal_today . ',
                yesterday_total = ' . $toal_yesterday . '
                WHERE post_id = '.mysql_real_escape_string($val->ID).'
                ';
        $res = $wpdb->query($sql);
    }
}

/* ========================================================

SEEDCMS.com - auth.net integration

=========================================================== */

// AJAX calls ~~~~~~~~

/*
  COUPON CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_couponcode', 'go_coupon' );
add_action( 'wp_ajax_couponcode', 'go_coupon' );
function go_coupon () {
  //find coupoon send back %
  $coupon_discount = get_coupon($_POST['coupon']);
  echo json_encode($coupon_discount);
  exit;
}

/*
  COUPON CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_confirm_password', 'confirm_password' );
add_action( 'wp_ajax_confirm_password', 'confirm_password' );
function confirm_password () {
    //find coupoon send back %
    if ( !is_user_logged_in() ) {
        echo "error";
        exit;
    }
    $pass = $_REQUEST['confirm_password'];
    $user = get_userdata( get_current_user_id() );
    if ( $user && wp_check_password( $pass, $user->data->user_pass, $user->ID) )
        echo "success";
    else
        echo "error";
    exit;
}

/*
  SHOPPING CART ORDER CODE AJAX
  ================================= */

function send_non_study_purchase_email($product_title, $product_qty, $product_amount, $product_total, $args) {
    global $wpdb;
    $query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
    foreach($query_invoice_number as $query_invoice_number_value){
        $invoice_num = $query_invoice_number_value->invoice_number;
    }
    $final_num =  $invoice_num+1;

    $currdate =date('m/d/Y',strtotime('-4 hours'));

    $message_pdf = '<style type="text/css">
                    <!--
                    table
                    {
                        width:  100%;
                        margin:0px 0px 0px 0px;
                        padding: 0px 0px 0px 0px;
                    }

                    th{padding:2px 0px;}
                    td
                    {
                    padding:6px 0px;
                    }
                    tbody{
                    margin:0px 20px 0px 20px;
                    padding: 0px 20px 0px 20px;

                    }

                    h1{ font-size:21px; margin:-15px 0px 6px 0px; padding:0px 0px 0px 0px;}
                    tbody tr{ font-size:14px;}
                    body{margin:0px 0px 0px 0px;
                        padding: 0px 0px 0px 0px;}

                    -->
                    </style>';

    $message_pdf .= "
                      <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
                     <table cellpadding='0' cellspacing='0'>
                    <col style='width: 20%'>
                    <col style='width: 37%'>
                    <col style='width: 18%'>
                    <col style='width: 5%'>
                    <col style='width: 20%'>

                          <tr>
                        <th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
                        <th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
                        <h1>INVOICE RECEIPT</h1>
                        Invoice Number: ".$final_num."<br />
                        Date: ".$currdate."<br />
                        Payment Type: ".($args['last_4'] ? $args['payment_type']." xxxx".$args['last_4'] : "Check")."<br />";
    $message_pdf .= "
                    Name on Card: ".$args['first_name']." ".$args['last_name']."<br/>
                    Account: None</th>";

    $message_pdf .= "
                        </tr>
                    <tbody>
                    <tr>
                        <th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
                        <tr style='text-align:center; font-size:18px;color:#000;'>
                        <th align='left' colspan='3' style='border-bottom:1px solid #000;'>SERVICES:</th>
                        <th style='border-bottom:1px solid #000;'></th>
                        <th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
                        </tr>

                    ";

    $message_pdf .= "<tr align='center'>
                        <td align='left' colspan='3'>".($product_qty == 1 ? "" : $product_qty." ").$product_title."</td>
                        <td align='center'> </td>
                        <td align='right'>$".$product_amount." </td>
                    </tr>";

    for ($x=1; $x<=5; $x++){
        $message_pdf .= "<tr align='left'>
                        <td bordercolor='#000' align='left'>&nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        </tr>";
    }
    for ($x=1; $x<=14; $x++){
        $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
    }
    if($args['coupon']){
        $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$args['coupon']."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $args['coupon_amount'] ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

    } else {

        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

    }

    $message_pdf .= "

                    <tr class='sub_total' align='left'>
                    <td align='center'  style='border-top:1px solid #000;'> </td>
                    <td align='left' colspan='2'  style='border-top:1px solid #000;'> </td>
                    <td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; $".$product_total."</td>
                    </tr>
                    <tr class='total' align='left'>
                    <td align='center'> </td>
                    <td align='left' colspan='2'> </td>
                    <td align='right' colspan='2'><b>TOTAL:&nbsp; $".$product_total."</b></td>
                    </tr>
                    </tbody>
                    <tr>";

    $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

    $message_pdf .= "</tr>
                    </table></page>";

//        print_r($message_pdf);
//        exit;

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($message_pdf);
    //ob_end_clean();

    $rand= rand();
    $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$product_title.' Invoice_temp'.".pdf", "f");
    $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$product_title.'_Invoice_temp'.".pdf", "f");
    $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice_temp.pdf';
    $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$product_title.'_Invoice_temp.pdf';
    $attachment_arr[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice_temp.pdf';

    $current_month = date('M');
    $current_year = date('Y');
    $full_date = date('m/d/y');
//    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`
//              (`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES
//              (NULL,NULL,'','$pdf_attachment_path_db','','$final_num','$product_total','$current_month','$current_year','Study Information','$full_date')"));

    $subject_pdf_email = "Thank You for Purchasing ".$product_title."";
    $pdf_email_text = "
                      Hi ".$args['first_name'].",<br /><br />
                      Thank you for purchasing ".$product_title." with StudyKIK.<br /><br />
                      Please see invoice attached with detailed information.<br /><br />
                      If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                      Thank you!<br /><br />
                      StudyKIK<br />
                      1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                      info@studykik.com<br />
                      1-877-627-2509<br /><br /><br />
                      <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />
                      ";
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
    $headers_pdf[] = "MIME-Version: 1.0\r\n";
    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if ($args['email']) {
        wp_mail($args['email'],$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
    }
}
function send_order_email($product_arr, $args, $attachments = null, $message = "") {
    global $wpdb;
    $is_study_order = false;
    $last_product_title = "";
    $attachment_arr = [];
    $attachment_pdf_arr = [];
    $user_id = $args['user_id']?$args['user_id']:null;
    $account = $args['account']?$args['account']:"None";
    $subject_user = "New order was placed for StudyKIK".($args['invoice_number'] ? " (".$args['invoice_number'].")" : ($args['payment_type'] == "Check" ? " (Check)" : ""));
    $study_no_arr = [];
    foreach($args['study_arr'] as $study_id) {
        $study_no = get_post_meta($study_id, "study_no", true);
        if ($study_no) {
            $study_no_arr[] = $study_no;
        }
    }
    if ($study_no_arr && count($study_no_arr) > 0) {
        $subject_user .= " (Study # ".implode(", ",$study_no_arr).")";
    }
    $currdate = date ( "D M d H:i:s O Y");
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('America/Los_Angeles'));

    $body_user = "Hello StudyKIK<br /><br />
			    Order Details:<br /><br />
			    Name: ".$args['first_name']." ".$args['last_name']."<br />
                Company: ".$args['company']."<br/>
			    Zip/Postalcode: ".$args['zip']."<br/><br/>

			    Transaction ID: ".$args['transaction_id']."<br />
			    Date: ".$date->format('m-d-Y h:i:s A')." (PST)"."<br />
			    Payment Type: ".$args['payment_type']."<br /><br/>
			    <table cellspacing='0' cellpadding='0'>
			    ";
    $total_amount = 0;
    $query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` ORDER BY `id` DESC LIMIT 1");
    foreach($query_invoice_number as $query_invoice_number_value){
        $invoice_num = $query_invoice_number_value->invoice_number;
    }
    foreach($product_arr as $key => $value) {
        if (strpos($key, "Listing") > 0) {
            $is_study_order = true;
        }
    }
    foreach($product_arr as $key => $value) {

        $last_product_title = $key;

        $final_num =  $invoice_num+1;
        $invoice_num = $invoice_num + 1;

        $total_amount += $value['price']*$value['qty'];
        $body_user .= "<tr><td style='border: none; text-align:left; padding-right: 20px;'>$key</td><td style='border: none; text-align:right;'>$".number_format( $value['price'] ,  2 ,  '.' ,  ',' )." X ".$value['qty']." = $".number_format( $value['price']*$value['qty'] ,  2 ,  '.' ,  ',' )."</td></tr>";

        if (!$is_study_order && !$attachments) {
            $message_pdf = "";
            $product_title = $key;
            $product_qty = $value['qty'];
            $product_price = $value['price'];

            $product_amount = $product_qty * $product_price;
            $product_total = $product_amount;
            if ($args['coupon']) {
                $product_total = $product_amount  - $args['coupon_amount'];
                if ($product_total < 0) {
                    $product_total = 0;
                }
            }
            $product_amount = number_format( $product_amount ,  2 ,  '.' ,  ',' );
            $product_total = number_format( $product_total ,  2 ,  '.' ,  ',' );

            $message_pdf .= '<style type="text/css">
                    <!--
                    table
                    {
                        width:  100%;
                        margin:0px 0px 0px 0px;
                        padding: 0px 0px 0px 0px;
                    }

                    th{padding:2px 0px;}
                    td
                    {
                    padding:6px 0px;
                    }
                    tbody{
                    margin:0px 20px 0px 20px;
                    padding: 0px 20px 0px 20px;

                    }

                    h1{ font-size:21px; margin:-15px 0px 6px 0px; padding:0px 0px 0px 0px;}
                    tbody tr{ font-size:14px;}
                    body{margin:0px 0px 0px 0px;
                        padding: 0px 0px 0px 0px;}

                    -->
                    </style>';

            $message_pdf .= "
                      <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
                     <table cellpadding='0' cellspacing='0'>
                    <col style='width: 20%'>
                    <col style='width: 37%'>
                    <col style='width: 18%'>
                    <col style='width: 5%'>
                    <col style='width: 20%'>

                          <tr>
                        <th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
                        <th colspan='3' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px; padding: 20px 0 4px 0;'>
                        <h1>INVOICE RECEIPT</h1>
                        Invoice Number: ".$final_num."<br />
                        Date: ".$currdate."<br />
                        Payment Type: ".($args['last_4'] ? $args['payment_type']." xxxx".$args['last_4'] : "Check")."<br />";
            $message_pdf .= "
                    Name on Card: ".$args['first_name']." ".$args['last_name']."<br/>
                    Account: ".$account."</th>";

            $message_pdf .= "
                        </tr>
                    <tbody>
                    <tr>
                        <th style='text-align:left' colspan='5'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
                        <tr style='text-align:center; font-size:18px;color:#000;'>
                        <th align='left' colspan='3' style='border-bottom:1px solid #000;'>SERVICES:</th>
                        <th style='border-bottom:1px solid #000;'></th>
                        <th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
                        </tr>

                    ";

            $message_pdf .= "<tr align='center'>
                        <td align='left' colspan='3'>".($product_qty == 1 ? "" : $product_qty." ").$product_title."</td>
                        <td align='center'> </td>
                        <td align='right'>$".$product_amount." </td>
                    </tr>";

            for ($x=1; $x<=5; $x++){
                $message_pdf .= "<tr align='left'>
                        <td bordercolor='#000' align='left'>&nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='left'> &nbsp; </td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        <td bordercolor='#000' align='center'> &nbsp;</td>
                        </tr>";
            }
            for ($x=1; $x<=14; $x++){
                $message_pdf .= "<tr align='left'>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='left'> </td>
                            <td align='center'> </td>
                            <td align='center'> </td>
                            </tr>";
            }
            if($args['coupon']){
                $message_pdf .= "<tr align='center'>
                            <td align='left'>Coupon</td>
                            <td align='left' colspan='2'>".$args['coupon']."</td>
                            <td align='center'> </td>
                            <td align='right'>-$".number_format( $args['coupon_amount'] ,  2 ,  '.' ,  ',' )." </td>
				        </tr>";

            } else {

                $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left' colspan='2'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

            }

            $message_pdf .= "

                    <tr class='sub_total' align='left'>
                    <td align='center'  style='border-top:1px solid #000;'> </td>
                    <td align='left' colspan='2'  style='border-top:1px solid #000;'> </td>
                    <td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; $".$product_total."</td>
                    </tr>
                    <tr class='total' align='left'>
                    <td align='center'> </td>
                    <td align='left' colspan='2'> </td>
                    <td align='right' colspan='2'><b>TOTAL:&nbsp; $".$product_total."</b></td>
                    </tr>
                    </tbody>
                    <tr>";

            $message_pdf .= "<th colspan='5' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

            $message_pdf .= "</tr>
                    </table></page>";

//        print_r($message_pdf);
//        exit;

            require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
            $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($message_pdf);
            //ob_end_clean();

            $rand= rand();
            $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$product_title.' Invoice'.".pdf", "f");
            $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$product_title.'_Invoice'.".pdf", "f");
            $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice.pdf';
            $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$product_title.'_Invoice.pdf';
            $attachment_arr[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$product_title.' Invoice.pdf';
            $attachment_pdf_arr[] = $pdf_attachment_path_db;

            $current_month = date('M');
            $current_year = date('Y');
            $full_date = date('m/d/y');

            $invoice_amount = "$".$product_total;
            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`
              (`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES
              (NULL,$user_id,'','$pdf_attachment_path_db','','$final_num','$invoice_amount','$current_month','$current_year','Study Information','$full_date')"));

            $subject_pdf_email = "Thank You for Purchasing ".$key."";
            $pdf_email_text = "
                      Hi ".$args['first_name'].",<br /><br />
                      Thank you for purchasing ".$key." with StudyKIK.<br /><br />
                      Please see invoice attached with detailed information.<br /><br />
                      If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                      Thank you!<br /><br />
                      StudyKIK<br />
                      1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                      info@studykik.com<br />
                      1-877-627-2509<br /><br /><br />
                      <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png' />
                      ";
            $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
            $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
            $headers_pdf[] = "MIME-Version: 1.0\r\n";
            $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if ($args['email']) {
                wp_mail($args['email'],$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
            }
        }

    }
    if ($args['coupon']) {
        $total_amount -= $args['coupon_amount'];
        $body_user .= "<tr><td style='border: none; text-align:left; padding-right: 20px;'>Coupon</td><td style='border: none; text-align:right;'>".$args['coupon']." = -$".number_format( $args['coupon_amount'] ,  2 ,  '.' ,  ',' )."</td></tr>";
    }

    $body_user .= "<tr><td style='border-top: 1px solid #000000; text-align:left; padding-right: 20px;'>Total</td><td style='border-top: 1px solid #000000; text-align:right;'>$".number_format( $total_amount ,  2 ,  '.' ,  ',' )."</td></tr>";
    $body_user .= "</table>";

    $body_user .= $message;

    $headers_user[] = "From: ".$args['first_name']." ".$args['last_name'];
    $headers_user[] = "MIME-Version: 1.0\r\n";
    $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $email_result = true;
    if ($attachments) {
        $email_result = wp_mail("info@studykik.com",$subject_user, $body_user,$headers_user, $attachments);

        $now = new DateTime('now', new DateTimeZone('UTC'));
        $invoice_number = $args['invoice_number'];
        $customer = $args['first_name']. " ". $args['last_name'];
        $user_id = $args['buyer_id'] ? $args['buyer_id'] : $args['user_id'];
        $wpdb->insert(
            '0gf1ba_orders',
            array(
                'user_id' => $user_id,
                'invoice_number' => $invoice_number,
                'created_at' => $now->format('Y-m-d H:i:s'),
                'customer' => $customer,
                'total' => $total_amount
            )
        );
        $order_id = $wpdb->insert_id;

        $wpdb->insert(
            '0gf1ba_ordermeta',
            array(
                'order_id' => $order_id,
                'meta_key' => 'message',
                'meta_value' => $message
            )
        );

        $invoices = [];
        foreach ($args['pdfs'] as $pdf) {
            $invoices[] = str_replace(dirname(__FILE__), "", $pdf);
        }
        $wpdb->insert(
            '0gf1ba_ordermeta',
            array(
                'order_id' => $order_id,
                'meta_key' => 'invoices',
                'meta_value' => maybe_serialize($invoices)
            )
        );
//        wp_mail("utopia2050.kosta@gmail.com",$subject_user, $body_user,$headers_user, $attachments);
    } else {
        if ($is_study_order) {
            $email_result = wp_mail("info@studykik.com",$subject_user, $body_user,$headers_user);
//            wp_mail("utopia2050.kosta@gmail.com",$subject_user, $body_user,$headers_user);
        } else {
            $email_result = wp_mail("info@studykik.com",$subject_user, $body_user,$headers_user, $attachment_arr);

            $now = new DateTime('now', new DateTimeZone('UTC'));
            $invoice_number = $args['invoice_number'];
            $customer = $args['first_name']. " ". $args['last_name'];
            $user_id = $args['buyer_id'] ? $args['buyer_id'] : $args['user_id'];
            $wpdb->insert(
                '0gf1ba_orders',
                array(
                    'user_id' => $user_id,
                    'invoice_number' => $invoice_number,
                    'created_at' => $now->format('Y-m-d H:i:s'),
                    'customer' => $customer,
                    'total' => $total_amount
                )
            );
            $order_id = $wpdb->insert_id;

            $wpdb->insert(
                '0gf1ba_ordermeta',
                array(
                    'order_id' => $order_id,
                    'meta_key' => 'message',
                    'meta_value' => $message
                )
            );

            $invoices = [];
            foreach ($attachment_pdf_arr as $pdf) {
                $invoices[] = str_replace(dirname(__FILE__), "", $pdf);
            }
            $wpdb->insert(
                '0gf1ba_ordermeta',
                array(
                    'order_id' => $order_id,
                    'meta_key' => 'invoices',
                    'meta_value' => maybe_serialize($invoices)
                )
            );
//            wp_mail("utopia2050.kosta@gmail.com",$subject_user, $body_user,$headers_user, $attachment_arr);
        }
    }
    if ($email_result == false) {
        addToEmailLog($subject_user, $user_id);
    }
//    wp_mail("utopia2050.kosta@gmail.com",$subject_user, $body_user,$headers_user, $attachments);
}

function send_order_fail_email($args) {
    $subject_user = "New order failed for StudyKIK";
    $body_user = "Hello StudyKIK<br /><br />
			    A new order attempt through your StudyKIK account has FAILED.<br /><br />
			    The reason for the failure was: Declined<br />
			    Name: ".$args['first_name']." ".$args['last_name']."<br />
			    Company: ".$args['company']."<br />

			    Zip/Postalcode: ".$args['zip']."<br /><br />

			    Fax: <br />
			    Phone: <br />
			    Secondary Phone: <br />

			    Order ID: ".$args['transaction_id']."<br />
			    Date: ".date ( "D M d H:i:s O Y")."<br />
			    Payment Type: ".$args['payment_type']."<br />
			    Order Status: Declined<br /><br />";
    $headers_user[] = "From: ".$args['first_name']." ".$args['last_name'];
    $headers_user[] = "MIME-Version: 1.0\r\n";
    $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    wp_mail("info@studykik.com",$subject_user, $body_user,$headers_user);
}

add_action( 'wp_ajax_nopriv_go_order', 'go_order' );
add_action( 'wp_ajax_go_order', 'go_order' );
function go_order () {
    addToPaymentLog('Start payment, post data = '.serialize($_POST), $_POST['user_id']);

	// form vars
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$fullname 		= $firstname. " " . $lastname;
	$company 		= $_POST['company'];
	$phonenumber 	= $_POST['phonenumber'];
	$phonenumber2   = $_POST['phonenumber2'];
	$faxnumber 		= $_POST['faxnumber'];
	$email 			= $_POST['email'];
	$email2 		= $_POST['email2'];
	$password 		= $_POST['password'];
    $password2 		= $_POST['password2'];
    $username 		= $_POST['username'];
	$zip 			= $_POST['zip'];
	$save 			= $_POST['save'];
    $creditcard     = $_POST['creditcard'];
	$cc_name 		= $firstname." ".$lastname;
	$cc_number 		= $_POST['cc_number'];
	$last_4         = substr($_POST['cc_number'], -4);
	$cc_exp_month   = $_POST['cc_exp_month'];
	$cc_exp_year 	= $_POST['cc_exp_year'];
	$cc_cvv2 		= $_POST['cc_cvv2'];
	$amount 		= $_POST['amount'];
	$comments 		= $_POST['comments'];
	$coupon         = $_POST['coupon'];
	$message_suite_247_amount       = 0;
	$message_suite_247       = $_POST['message_suite_247'];

    $is_study_order = false;
    $has_product = false;
    $user_id      = $_POST['user_id'];

    if ($user_id) {
        $userData = get_userdata($user_id);
    }
    if ($user_id && !$company) {
        $company = get_user_meta(get_current_user_id(), "sitename", true);
    }
    $credit_card_id       = $_POST['payment_credit_card_id'];
    $profile_id           = $_POST['payment_profile_id'];
    $payment_profile_id   = $_POST['payment_payment_id'];
    $shipping_profile_id  = $_POST['payment_shipping_id'];
    $payment_card_code    = $_POST['payment_card_code'];

    $start_date    = $_POST['startdate1'];
    $condense_2_weeks    = $_POST['condense_2_weeks'];

    $product_arr = array();
    $total_price = 0;

    $study_count  = 0;
    $transaction_id       = 0;


    $qtyCount     = 1;
    $products     = '';
    $is_error     = '';
    $error_message= '';
    $message= '';


    $discount_price_arr = array();
    $price_arr          = array();
    $discount_arr       = array();
    $iterator = 0;

    foreach($_POST as $key => $value){

        if (stripos($key, "qty-") !== false) {
            $has_product = true;

            $product_id = str_replace('qty-', '', $key);
            $product_title = get_the_title($product_id);

            $product_price = (float)get_post_meta($product_id, "product_price", true);

            if ($value > 0) {
                $total_price += $product_price * $value;
                $product_arr[$product_title] = array("title" => $product_title , "price" => $product_price, "qty" => $value);

                if (strpos($product_title, "Listing") > 0) {
                    $is_study_order = true;
                    for ($i = 0; $i < $value; $i ++) {
                        $price_arr[$iterator] = $product_price;
                        $iterator ++;
                    }
                    $study_count  = $study_count + $value;
                } else {
                    $price_arr[$iterator] = $product_price * $value;
                    $iterator ++;
                }
            }

            $loopCount    = 1;
            while($loopCount <= $value){

                $arrayID                    = $qtyCount - 1;
                $studyARR[$arrayID]['id']   = str_replace('qty-', '', $key);
                $studyARR[$arrayID]['qty']  = $value;
                $qtyCount                   = $qtyCount + 1;
                $loopCount                  = $loopCount + 1;
                $products                   = 'ID:'.$studyARR[$arrayID]['id'].'|QTY:'.$studyARR[$arrayID]['qty'].',';

            } // end while */

        } // end if

        if (stripos($key, "boost_type") !== false) {

            $product_title = get_the_title($value);
            $product_price = (float)get_post_meta($value, "product_price", true);

            $total_price += $product_price;
            if ($product_arr[$product_title]) {
                $product_arr[$product_title]["qty"] = $product_arr[$product_title]["qty"] + 1;
            } else {
                $product_arr[$product_title] = array("title" => $product_title , "price" => $product_price, "qty" => 1);
            }
        }

        if (stripos($key, "message_suite_247") !== false) {
            if ($value) {
                $message_suite_247_amount = $message_suite_247_amount + 247;
                if ($product_arr["Messaging Suite"]) {
                    $product_arr["Messaging Suite"]["qty"] = $product_arr["Messaging Suite"]["qty"] + 1;
                } else {
                    $product_arr["Messaging Suite"] = array("title" => "Messaging Suite" , "price" => 247, "qty" => 1);
                }
            }
        }
    } // end foreach
    if ($has_product == false) {
        $is_study_order = true;
    }

    $c_discount = 0;
    $do_not_charge = false;
    if($coupon){
        $coupon_data = get_coupon($coupon);
        $discount         = get_coupon($coupon);

        if ($discount['type'] == "percent") {
            $percent  = (float) $discount['value'];
            $c_discount   = ($total_price / 100) * $percent;
        } else if ($discount['type'] == "fixed") {
            $c_discount   = (float) $discount['value'];
        }

    }
    if ($iterator > 0) {
        $avg_discount = $c_discount / $iterator;
        for ($i = 0; $i < $iterator; $i ++) {
            $discount_price_arr[$i] = $price_arr[$i] - $avg_discount;
        }
        $should_continue = true;
        $is_possible = false;
        $minus_value = 0;
        while($should_continue) {
            $should_continue = false;
            $is_possible = false;
            for ($i = 0; $i < $iterator; $i ++) {
                if ($discount_price_arr[$i] < 0) {
                    $minus_value += $discount_price_arr[$i];
                    $discount_price_arr[$i] = 0;
                    $should_continue = true;
                } else if($discount_price_arr[$i] > 0) {
                    $discount_price_arr[$i] = $discount_price_arr[$i] + $minus_value;
                    $minus_value = 0;
                    if ($discount_price_arr[$i] < 0) {
                        $minus_value += $discount_price_arr[$i];
                        $discount_price_arr[$i] = 0;
                        $should_continue = true;
                    }
                }
            }

            if ($is_possible) {
                $should_continue = true;
            }
        }
        for ($i = 0; $i < $iterator; $i ++) {
            $discount_arr[$i] = $price_arr[$i] - $discount_price_arr[$i];
        }
    }

    if ($total_price <= $c_discount){
        $total_price = 0;
    }else{
        $total_price = $total_price - $c_discount;
    }

    $total_price  = $total_price + $message_suite_247_amount;

    if ($total_price <= 0) {
        $do_not_charge = true;
    } else {
        $do_not_charge = false;
    }
    
    $amount  = round((float)$total_price, 2);

//    print_r($_POST);
//    print_r($amount);
    addToPaymentLog('payment progress 1', $user_id);
    if (is_user_logged_in() && get_user_meta(get_current_user_id(), 'allow_check', true) && $_POST['creditcard'] == "Check") {
        addToPaymentLog('payment progress 2', $user_id);
        $message  = 'yes|0|0|0|0|0|true';
        echo $message;

        $user_id = get_current_user_id();
        $firstname = get_user_meta($user_id, "first_name", true);
        $lastname = get_user_meta($user_id, "last_name", true);
        $company = get_user_meta($user_id, "sitename", true);
        $address = get_user_meta($user_id, "address", true);
        $userData = get_userdata($user_id);

        if (!$is_study_order) {
            send_order_email($product_arr, array(
                "user_id" => $user_id,
                "first_name" => $firstname,
                "last_name" => $lastname,
                "company" => $company,
                "email" => $userData->data->user_email,
                "zip" => "",
                "transaction_id" => "",
                "payment_type" => "Check",
                "last_4" => $last_4,
                "coupon" => $coupon,
                "coupon_amount" => $c_discount
            ));
        }
        exit;
    }

    $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);
    addToPaymentLog('payment progress 3', $user_id);
    if ($profile_id && $payment_profile_id && $credit_card_id) {
        addToPaymentLog('payment progress 4', $user_id);

        $is_study_order = true;

        $auth_card_type                     = get_post_meta($credit_card_id, 'auth_card_type', true);
        $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
        $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
        $card_billing_email                 = get_post_meta($credit_card_id, 'card_billing_email', true);
        $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);

        //if ($amount <= 0) {
        if($do_not_charge){
            addToPaymentLog('payment progress 5', $user_id);
            $message  = 'yes|0|0|0|0|true';
            echo $message;

            if (!$is_study_order) {
                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $card_billing_first_name,
                    "last_name" => $card_billing_last_name,
                    "company" => $company,
                    "email" => $card_billing_email,
                    "zip" => $card_billing_zip,
                    "transaction_id" => "",
                    "payment_type" => $auth_card_type,
                    "last_4" => $last_4,
                    "coupon" => $coupon,
                    "coupon_amount" => $c_discount
                ));
            }
            exit;
        }
        require('../_authorize/AuthnetCIM.php');
        try{
            addToPaymentLog('payment progress 6', $user_id);
            // Create AuthnetCIM object. Set third parameter to "true" for developer account
            // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
            $ecommerce_user_production = get_option("ecommerce_user_production");
            if ((bool)$ecommerce_user_production) {
                $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
            } else {
                $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
            }
            addToPaymentLog('payment progress 7', $user_id);
            // Process the transaction
            $cim->setParameter('amount', $amount);
            $cim->setParameter('customerProfileId', $profile_id);
            $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
            $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

            $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
            $cim->setParameter('invoiceNumber', $invoice_number);

            if ($payment_card_code) {
                $cim->setParameter('cardCode', $payment_card_code);
            }
            $cim->setLineItem('1', 'List Study', $products, '1', $amount);
            $cim->createCustomerProfileTransaction();
            addToPaymentLog('payment progress 8', $user_id);
            // insert order
            // Get the payment profile ID returned from the request
            if ($cim->isSuccessful()){
                addToPaymentLog('payment progress 9', $user_id);
                $transaction_id = $cim->getTransactionID();
                $approval_code = $cim->getAuthCode();
                addToPaymentLog('transaction_id = '.$transaction_id, $user_id);
                $profile                = array();
                $profile['post_title']  = 'List Study - '. $userData->display_name;
                $profile['post_status'] = 'publish';
                $profile['post_author'] = $user_id;
                $profile['post_type']   = 'studykik-orders';

                $post_id = wp_insert_post($profile);
                addToPaymentLog('payment progress 10', $user_id);
                update_field('first_name',              $card_billing_first_name, $post_id);
                update_field('last_name',               $card_billing_last_name, $post_id);
                update_field('company',                 $company, $post_id);
                update_field('phone',                   $phonenumber, $post_id);
                update_field('phone_2',                 $phonenumber2, $post_id);
                update_field('fax',                     $faxnumber, $post_id);
                update_field('email',                   $card_billing_email, $post_id);
                update_field('zip',                     $card_billing_zip, $post_id);
                update_field('amount',                  $amount, $post_id);
                update_field('coupon',                  $coupon, $post_id);
                update_field('comments',                $comments, $post_id);
                update_field('products',                $products, $post_id);
                update_field('transaction_id',          $transaction_id, $post_id);
                update_field('approved',                $approval_code, $post_id);
                update_field('error_message',           $cim->response_reason_text, $post_id);
                update_field('patient_message_suite',   $message_suite_247, $post_id);
                update_field('condense_to_2_weeks',     $condense_2_weeks, $post_id);
                update_field('start_date',              $start_date, $post_id);

                $message  = 'yes|'.$transaction_id.'|'.$post_id ;

                if (!$is_study_order) {
                    send_order_email($product_arr, array(
                        "user_id" => $user_id,
                        "first_name" => $card_billing_first_name,
                        "last_name" => $card_billing_last_name,
                        "company" => $company,
                        "email" => $card_billing_email,
                        "zip" => $card_billing_zip,
                        "transaction_id" => $cim->getTransactionID(),
                        "payment_type" => $auth_card_type,
                        "last_4" => $last_4,
                        "coupon" => $coupon,
                        "coupon_amount" => $c_discount,
                        "invoice_number" => $invoice_number
                    ));
                } else {
                    $message .= "|".$invoice_number;
                }

            }else{
                addToPaymentLog('payment progress 11', $user_id);
                $message = 'error|Can\'t process your payment.';

                send_order_fail_email(array(
                    "first_name" => $card_billing_first_name,
                    "last_name" => $card_billing_last_name,
                    "company" => $company,
                    "email" => $card_billing_email,
                    "zip" => $card_billing_zip,
                    "transaction_id" => $cim->getTransactionID(),
                    "payment_type" => $auth_card_type,
                    "coupon" => $coupon,
                    "coupon_amount" => $c_discount
                ));
            }


        }catch (AuthnetCIMException $e){
            addToPaymentLog('payment progress 12', $user_id);
            send_order_fail_email(array(
                "first_name" => $card_billing_first_name,
                "last_name" => $card_billing_last_name,
                "company" => $company,
                "email" => $card_billing_email,
                "zip" => $card_billing_zip,
                "transaction_id" => $cim->getTransactionID(),
                "payment_type" => $auth_card_type,
                "coupon" => $coupon,
                "coupon_amount" => $c_discount
            ));
            $message .= $e;
            $message .= $cim;
        }
    } else {
        addToPaymentLog('payment progress 13', $user_id);
        //if ($amount <= 0) {
        $croname=$fullname;
        $croname=strtolower($croname);
        if ($do_not_charge){
            if ($username && !username_exists( $username)) {
                addToPaymentLog('payment progress 18', $user_id);
                $userdata = array(
                    'user_login'  =>  $username,
                    'user_pass'   =>  $password,
                    'role' =>  'editor',
                    'nickname' => $fullname,
                    'user_email' => $email,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'user_nicename' => $fullname,
                );
                $user_id = wp_insert_user( $userdata ) ;
                $user = get_userdata($user_id);
                $prev_value='';
                $meta_key='sitename';
                $meta_value=$company;
                update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );

                $subject_user = "My StudyKIK Portal Login";
                $subject_admin = "StudyKIK Portal Login for".$fullname;
                $body_user = "Hi ".$firstname.",<br /><br />
			    Thank you for signing up with StudyKIK.com!<br /><br />
			    Please see the login information for your MyStudyKIK Portal below:<br /><br />
			    Login to see your current study stats, patients' contact information in real time, rewards your site can earn, and much more!<br /><br />
			    Link to My StudyKIK Portal: <a href='".site_url()."/login/'>CLICK HERE</a><br />
			    Username: ".$username."<br />
			    Email: ".$email."<br />
			    Password: ".$password."<br /><br />
			    We look forward to referring quality patients to your site and helping enroll your studies!<br /><br />
			    Thank you,<br /><br />
			    StudyKIK<br />
			    info@studykik.com<br />
			    1-877-627-2509<br />";
                $headers_user[] = 'From: StudyKIK <info@studykik.com>';
                $headers_user[] = "MIME-Version: 1.0\r\n";
                $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers_admin[] = 'From: StudyKIK <info@studykik.com>';
                $headers_admin[] = "MIME-Version: 1.0\r\n";
                $headers_admin[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                if($croname == 'testing'){
                    //$user_ID = get_current_user_id();
                    //echo get_option( 'admin_email').'aaaaaaaaaaaaa';
                    $user_info = get_userdata(70);
                    $cromail=$user_info->user_email ;
                    wp_mail($cromail,$subject_user, $body_user,$headers_admin);
                    //wp_mail('keshvendersingh145@gmail.com',$subject_user, $body_user,$headers_admin);
                }
                else{
                    wp_mail($email,$subject_user, $body_user,$headers_admin);

                }
            }
            addToPaymentLog('payment progress 14', $user_id);
            $message  = 'yes|0|0|0|0|'.$user_id;
            $subject_user = "New order was placed for StudyKIK";

            if (!$is_study_order) {
                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "company" => $company,
                    "email" => $email,
                    "zip" => $zip,
                    "transaction_id" => "",
                    "payment_type" => "",
                    "last_4" => $last_4,
                    "coupon" => $coupon,
                    "coupon_amount" => $c_discount
                ));
            } else {

                $i = 0;
                foreach($_POST as $key => $value){

                    if (stripos($key, "qty-") !== false) {
                        $has_product = true;

                        $product_id = str_replace('qty-', '', $key);
                        $product_title = get_the_title($product_id);

                        $product_price = (float)get_post_meta($product_id, "product_price", true);

                        if ($value > 0) {
                            $total_price = $product_price * $value;

                            if (strpos($product_title, "Listing") === false) {
                                send_non_study_purchase_email($product_title, $value, number_format( $total_price ,  2 ,  '.' ,  ',' ), number_format( $total_price - $discount_arr[$i + $study_count] ,  2 ,  '.' ,  ',' ), array(
                                        "first_name" => $firstname,
                                        "last_name" => $lastname,
                                        "company" => $company,
                                        "email" => $email,
                                        "zip" => $zip,
                                        "transaction_id" => "",
                                        "payment_type" => "",
                                        "coupon" => $coupon,
                                        "coupon_amount" => $discount_arr[$i + $study_count],
                                        "last_4" => $last_4,
                                        "invoice_number" => ""
                                    )
                                );
                                $i ++;
                            }
                        }

                    } // end if
                }
            }

            echo $message;
            exit;
        }

        $approved = "no";
        $is_error = "no";
        // run credit card
        include('../_authorize/anet_php_sdk/AuthorizeNet.php');
        addToPaymentLog('payment progress 15', $user_id);
        $ecommerce_user_production = get_option("ecommerce_user_production");
        if ((bool)$ecommerce_user_production) {
            define("AUTHORIZENET_API_LOGIN_ID", "5R38Kya2Sq");
            define("AUTHORIZENET_TRANSACTION_KEY", "4FRp7YUb4Fq836zQ");
            define("AUTHORIZENET_SANDBOX", false);
        } else {
            define("AUTHORIZENET_API_LOGIN_ID", "75sFujS9F4u6");
            define("AUTHORIZENET_TRANSACTION_KEY", "9gzzEV895FY8q6cm");
            define("AUTHORIZENET_SANDBOX", true);
        }

        $sale = new AuthorizeNetAIM;
        $sale->amount     			  = $amount;
        $sale->cust_id     		  = $customer_id;
        $sale->card_num   			  = $cc_number;
        $sale->exp_date   			  = $cc_exp_month.$cc_exp_year;
        $sale->first_name 			  = $firstname;
        $sale->last_name  			  = $lastname;
        $sale->zip       		      = $zip;

        $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
        $sale->invoice_num = $invoice_number;

        if ($company) {
            $sale->company            = $company;
        }
        $sale->VERIFY_PEER        = false;


        //$response = $sale->authorizeOnly();
        $response = $sale->authorizeAndCapture();
        addToPaymentLog('payment progress 16', $user_id);
        if ($response->approved) {
            addToPaymentLog('payment progress 17', $user_id);
            $transaction_id  = $response->transaction_id;
            addToPaymentLog('transaction_id ='.$transaction_id, $user_id);
            $success  = 'yes';
            $id       = 'credit';
            $message  = $success.'|'.$transaction_id;
            $approved = 'yes';



            if ($username && !username_exists( $username)) {
                addToPaymentLog('payment progress 18', $user_id);
                $userdata = array(
                    'user_login'  =>  $username,
                    'user_pass'   =>  $password,
                    'role' =>  'editor',
                    'nickname' => $fullname,
                    'user_email' => $email,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'user_nicename' => $fullname,
                );
                $user_id = wp_insert_user( $userdata ) ;
                $user = get_userdata($user_id);
                $prev_value='';
                $meta_key='sitename';
                $meta_value=$company;
                update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );

                $subject_user = "My StudyKIK Portal Login";
                $subject_admin = "StudyKIK Portal Login for".$fullname;
                $body_user = "Hi ".$firstname.",<br /><br />
			    Thank you for signing up with StudyKIK.com!<br /><br />
			    Please see the login information for your MyStudyKIK Portal below:<br /><br />
			    Login to see your current study stats, patients' contact information in real time, rewards your site can earn, and much more!<br /><br />
			    Link to My StudyKIK Portal: <a href='".site_url()."/login/'>CLICK HERE</a><br />
			    Username: ".$username."<br />
			    Email: ".$email."<br />
			    Password: ".$password."<br /><br />
			    We look forward to referring quality patients to your site and helping enroll your studies!<br /><br />
			    Thank you,<br /><br />
			    StudyKIK<br />
			    info@studykik.com<br />
			    1-877-627-2509<br />";
                $headers_user[] = 'From: StudyKIK <info@studykik.com>';
                $headers_user[] = "MIME-Version: 1.0\r\n";
                $headers_user[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers_admin[] = 'From: StudyKIK <info@studykik.com>';
                $headers_admin[] = "MIME-Version: 1.0\r\n";
                $headers_admin[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                if($croname == 'testing'){
                    //$user_ID = get_current_user_id();
                    //echo get_option( 'admin_email').'aaaaaaaaaaaaa';
                    $user_info = get_userdata(70);
                    $cromail=$user_info->user_email ;
                    wp_mail($cromail,$subject_user, $body_user,$headers_admin);
                    //wp_mail('keshvendersingh145@gmail.com',$subject_user, $body_user,$headers_admin);
                }
                else{
                    wp_mail($email,$subject_user, $body_user,$headers_admin);

                }
            }

            if (!$is_study_order) {
                addToPaymentLog('payment progress 18 - 1', $user_id);
                send_order_email($product_arr, array(
                    "user_id" => $user_id,
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "company" => $company,
                    "email" => $email,
                    "zip" => $zip,
                    "transaction_id" => $response->transaction_id,
                    "payment_type" => $response->card_type,
                    "last_4" => $last_4,
                    "coupon" => $coupon,
                    "coupon_amount" => $c_discount,
                    "invoice_number" => $invoice_number
                ));
            } else {

                $i = 0;
                foreach($_POST as $key => $value){

                    if (stripos($key, "qty-") !== false) {
                        $has_product = true;

                        $product_id = str_replace('qty-', '', $key);
                        $product_title = get_the_title($product_id);

                        $product_price = (float)get_post_meta($product_id, "product_price", true);

                        if ($value > 0) {
                            $total_price = $product_price * $value;

                            if (strpos($product_title, "Listing") === false) {
                                send_non_study_purchase_email($product_title, $value, number_format( $total_price ,  2 ,  '.' ,  ',' ), number_format( $total_price - $discount_arr[$i + $study_count] ,  2 ,  '.' ,  ',' ), array(
                                        "first_name" => $firstname,
                                        "last_name" => $lastname,
                                        "company" => $company,
                                        "email" => $email,
                                        "zip" => $zip,
                                        "transaction_id" => $response->transaction_id,
                                        "payment_type" => $response->card_type,
                                        "coupon" => $coupon,
                                        "coupon_amount" => $discount_arr[$i + $study_count],
                                        "last_4" => $last_4,
                                        "invoice_number" => $invoice_number
                                    )
                                );
                                $i ++;
                            }
                        }

                    } // end if
                }
            }

        }else{
            addToPaymentLog('payment progress 19', $user_id);
            send_order_fail_email(array(
                "first_name" => $firstname,
                "last_name" => $lastname,
                "company" => $company,
                "email" => $email,
                "zip" => $zip,
                "transaction_id" => $response->transaction_id,
                "payment_type" => $response->card_type,
                "coupon" => $coupon,
                "coupon_amount" => $c_discount
            ));

            $message = 'error|'.$response->response_reason_text;
            $approved = 'no';
        }

        $customer = new AuthorizeNetCIM;

        // description (text type field)
        $order                = array();
        if (!$creditcard) {
            $order['post_title']  = 'Order - '.$firstname.' '.$lastname;
        } else {
            $order['post_title']  = 'List Study - '.$firstname.' '.$lastname;
        }

        $order['post_status'] = 'publish';
        if ($username) {
            $order['post_author'] = $user_id;
        } else {
            $order['post_author'] = "";
        }
        $order['post_type']   = 'studykik-orders';
        $post_id              = wp_insert_post($order);
        $message .= '|'.$post_id;
        $message .= "|".$invoice_number;
        update_field('first_name', $firstname, $post_id);
        update_field('last_name', $lastname, $post_id);
        update_field('company', $company, $post_id);
        update_field('phone', $phonenumber, $post_id);
        update_field('phone_2', $phonenumber2, $post_id);
        update_field('fax', $faxnumber, $post_id);
        update_field('email', $email, $post_id);
        update_field('zip', $zip, $post_id);
        update_field('amount', $amount, $post_id);
        update_field('coupon', $coupon, $post_id);
        update_field('comments', $comments, $post_id);
        update_field('products', $products, $post_id);
        update_field('transaction_id', $transaction_id, $post_id);
        update_field('approved', $approved, $post_id);
        update_field('error_message', $response->response_reason_text, $post_id);

        // create customer profile and payment profile
        // Include AuthnetCIM class. Nothing works without it!
        addToPaymentLog('payment progress 20', $user_id);
        if ($user_id) {
            addToPaymentLog('payment progress 21', $user_id);
            require('../_authorize/AuthnetCIM.php');

            // Use try/catch so if an exception is thrown we can catch it
            // and figure out what happened
            try{
                // Create AuthnetCIM object. Set third parameter to "true" for developer account
                // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
                addToPaymentLog('payment progress 22', $user_id);
                $ecommerce_user_production = get_option("ecommerce_user_production");
                if ((bool)$ecommerce_user_production) {
                    $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
                } else {
                    $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
                }

                // Step 1: create Customer Profile
                // Create unique fake email address, description, and customer ID
                $email_address = $email;
                $description   = 'Order: '.$post_id;
                $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16); // use wordpress ID

                // Create the profile

//                if ($email_address) {
//                    $cim->setParameter('email', $email_address);
//                }
                $cim->setParameter('description', $description);
                $cim->setParameter('merchantCustomerId', $customer_id);
                $cim->setParameter('refId', $customer_id);
                if ($company) {
                    $cim->setParameter('billToCompany', $company);
                }
                $cim->createCustomerProfile();
                addToPaymentLog('payment progress 23', $user_id);
                // Get the profile ID returned from the request
                if ($cim->isSuccessful()){
                    addToPaymentLog('payment progress 24', $user_id);
                    $profile_id = $cim->getProfileID();
                    // Step 2: create Payment Profile
                    // Create the Payment Profile
                    $cim->setParameter('customerProfileId', $profile_id);
                    $cim->setParameter('billToFirstName', $firstname);
                    $cim->setParameter('billToLastName', $lastname);
                    $cim->setParameter('billToZip', $zip);
                    if ($company) {
                        $cim->setParameter('billToCompany', $company);
                    }
                    $cim->setParameter('cardNumber', $cc_number);
                    $cim->setParameter('validationMode', "none");
                    $cim->setParameter('expirationDate', $cc_exp_month.$cc_exp_year);
                    $cim->createCustomerPaymentProfile();
                    // Get the payment profile ID returned from the request
                    addToPaymentLog('payment progress 25', $user_id);
                    if ($cim->isSuccessful()){
                        addToPaymentLog('payment progress 26', $user_id);
                        $payment_profile_id = $cim->getPaymentProfileId();

                        // Step 3: create Shipping Profile
                        // Create the shipping profile
                        $cim->setParameter('customerProfileId', $profile_id);
                        $cim->setParameter('shipToFirstName', $firstname);
                        $cim->setParameter('shipToLastName', $lastname);
                        $cim->setParameter('shipToZip', $zip);
                        if ($company) {
                            $cim->setParameter('shipToCompany', $company);
                        }

                        $cim->createCustomerShippingAddress();
                        // Get the payment profile ID returned from the request
                        addToPaymentLog('payment progress 27', $user_id);
                        if ($cim->isSuccessful()){
                            addToPaymentLog('payment progress 28', $user_id);
                            $shipping_profile_id = $cim->getCustomerAddressId();
                        }else{
                            addToPaymentLog('payment progress 29', $user_id);
                            $is_error     = 'yes';
                            $error_message['error'] = true;
                            $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                            $error_message['messages'][]= 'createCustomerShippingAddress';
                            $error_message['messages'][] = $cim->getResponseSummary();
                            $error_message['messages'][] = $cim->getResponse();
                        }

                    }else{
                        addToPaymentLog('payment progress 30', $user_id);
                        $is_error     = 'yes';
                        $error_message['error'] = true;
                        $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                        $error_message['messages'][]= 'createCustomerPaymentProfile';
                        $error_message['messages'][] = $cim->getResponseSummary();
                        $error_message['messages'][] = $cim->getResponse();
                        $cim->deleteCustomerProfile();
                    }


                }else{
                    addToPaymentLog('payment progress 31', $user_id);
                    $is_error     = 'yes';
                    $error_message['error'] = true;
                    $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                    $error_message['messages'][]= 'createCustomerProfile';
                }
                addToPaymentLog('payment progress 32', $user_id);
                // insert post
                if($is_error != "Yes"){
                    addToPaymentLog('payment progress 33', $user_id);
                    $profile                = array();
                    $profile['post_title']  = 'Profile - '.$firstname.' '.$lastname;
                    $profile['post_status'] = 'publish';
                    $profile['post_author'] = $user_id;
                    $profile['post_type']   = 'studykik-payments';

                    $post_id = wp_insert_post($profile);

                    update_field('auth_profile_id', $profile_id, $post_id);
                    update_field('auth_payment_profile', $payment_profile_id, $post_id);
                    update_field('auth_shipping_profile', $shipping_profile_id, $post_id);
                    update_field('payment_user_id', $user_id, $post_id);
                    update_field('auth_credit_card', $last_4, $post_id);
                    update_field('auth_card_code', $cc_cvv2, $post_id);
                    update_field('auth_card_type', $response->card_type, $post_id);
                    update_field('auth_card_name', $cc_name, $post_id);
                    update_field('auth_card_expiration_month', $cc_exp_month, $post_id);
                    update_field('auth_card_expiration_year', $cc_exp_year, $post_id);
                    update_field('card_billing_first_name', $firstname, $post_id);
                    update_field('card_billing_last_name', $lastname, $post_id);
                    update_field('card_billing_zip', $zip, $post_id);
                    update_field('card_billing_company', $company, $post_id);

                    $message .= "|".$post_id;
                    $message .= "|".$user_id;
                } else {
                    addToPaymentLog('payment progress 34', $user_id);
                    echo json_encode($error_message);
                    exit;
                }
            }
            catch (AuthnetCIMException $e)
            {
                addToPaymentLog('payment progress 35', $user_id);
                $message .= $e;
                $message .= $cim;
            }
        }

    }
    addToPaymentLog('payment progress 36', $user_id);

  ob_start ();

  echo $message;

  $response = ob_get_contents();
  ob_end_clean();
  echo $response;
  exit;

}


/*
  ADD CARD CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_addcard', 'addcard' );
add_action( 'wp_ajax_addcard', 'addcard' );
function addcard() {

  // form vars
    $message = "";
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$zip 					= $_POST['zip'];
	$save 				= $_POST['save'];
	$cc_name 			= $firstname." ".$lastname;
	$cc_number 		= $_POST['cc_number'];
	$last_4       = substr($_POST['cc_number'], -4);
	$cc_exp_month = $_POST['cc_exp_month'];
	$cc_exp_year 	= $_POST['cc_exp_year'];
    $company 	= $_POST['company'];
	$cc_cvv2 			= $_POST['cc_cvv2'];
	$user_id      = $_POST['user_id'];
    $current_user = get_user_by( 'id', get_current_user_id() );
    $is_error     = '';
    $error_message= array();
    $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);
  // create customer profile and payment profile
  // Include AuthnetCIM class. Nothing works without it!

    include('../_authorize/anet_php_sdk/AuthorizeNet.php');
    $ecommerce_user_production = get_option("ecommerce_user_production");
    if ((bool)$ecommerce_user_production) {
        define("AUTHORIZENET_API_LOGIN_ID", "5R38Kya2Sq");
        define("AUTHORIZENET_TRANSACTION_KEY", "4FRp7YUb4Fq836zQ");
        define("AUTHORIZENET_SANDBOX", false);
    } else {
        define("AUTHORIZENET_API_LOGIN_ID", "75sFujS9F4u6");
        define("AUTHORIZENET_TRANSACTION_KEY", "9gzzEV895FY8q6cm");
        define("AUTHORIZENET_SANDBOX", true);
    }

    $sale = new AuthorizeNetAIM;
    $sale->amount     			  = "0.01";
    $sale->cust_id     		  = $customer_id;
    $sale->card_num   			  = $cc_number;
    $sale->exp_date   			  = $cc_exp_month.$cc_exp_year;
    $sale->first_name 			  = $firstname;
    $sale->last_name  			  = $lastname;
    $sale->zip       		      = $zip;
    if ($company) {
        $sale->company  	      = $company;
    }
    $sale->VERIFY_PEER        = false;


    //$response = $sale->authorizeOnly();
    $response = $sale->authorizeOnly();
    if ($response->approved) {
        require('../_authorize/AuthnetCIM.php');

        try{
            // Create AuthnetCIM object. Set third parameter to "true" for developer account
            // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
            $ecommerce_user_production = get_option("ecommerce_user_production");
            if ((bool)$ecommerce_user_production) {
                $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
            } else {
                $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
            }
            $description   = 'Add Card To User Profile';

            $cim->setParameter('description', $description.'-'.$customer_id);
            $cim->setParameter('merchantCustomerId', $customer_id);
            if ($company) {
                $cim->setParameter('billToCompany', $company);
            }

            $cim->createCustomerProfile();

            if ($cim->isSuccessful()){
                $profile_id = $cim->getProfileID();

                // Create the Payment Profile
                $cim->setParameter('customerProfileId', $profile_id);
                $cim->setParameter('billToFirstName', $firstname);
                $cim->setParameter('billToLastName', $lastname);
                if ($company) {
                    $cim->setParameter('billToCompany', $company);
                }
                $cim->setParameter('billToZip', $zip);
                $cim->setParameter('cardNumber', $cc_number);
                $cim->setParameter('expirationDate', $cc_exp_month.$cc_exp_year);
                $cim->setParameter('validationMode', "none");

                $cim->createCustomerPaymentProfile();

                // Get the payment profile ID returned from the request
                if ($cim->isSuccessful()){
                    $payment_profile_id = $cim->getPaymentProfileId();

                    // Step 3: create Shipping Profile
                    // Create the shipping profile
                    $cim->setParameter('customerProfileId', $profile_id);
                    if ($company) {
                        $cim->setParameter('shipToCompany', $company);
                    }
                    $cim->setParameter('shipToFirstName', $firstname);
                    $cim->setParameter('shipToLastName', $lastname);
                    $cim->setParameter('shipToZip', $zip);

                    $cim->createCustomerShippingAddress();

                    // Get the payment profile ID returned from the request
                    if ($cim->isSuccessful()){
                        $shipping_profile_id = $cim->getCustomerAddressId();

                        // save profile
                        if($user_id){
                            $profile                = array();
                            $profile['post_title']  = 'Profile - Add Card - '.$cc_name;
                            $profile['post_status'] = 'publish';
                            $profile['post_type']   = 'studykik-payments';

                            $post_id = wp_insert_post($profile);

                            update_field('auth_profile_id', $profile_id, $post_id);
                            update_field('auth_payment_profile', $payment_profile_id, $post_id);
                            update_field('auth_shipping_profile', $shipping_profile_id, $post_id);
                            update_field('payment_user_id', $user_id, $post_id);
                            update_field('auth_credit_card', $last_4, $post_id);
                            update_field('auth_card_code', $cc_cvv2, $post_id);
                            update_field('auth_card_type', $response->card_type, $post_id);
                            update_field('auth_card_name', $cc_name, $post_id);
                            update_field('auth_card_expiration_month', $cc_exp_month, $post_id);
                            update_field('auth_card_expiration_year', $cc_exp_year, $post_id);
                            update_field('card_billing_first_name', $firstname, $post_id);
                            update_field('card_billing_last_name', $lastname, $post_id);
                            update_field('card_billing_zip', $zip, $post_id);
                            update_field('card_billing_company', $company, $post_id);

                            $json_data                = array();
                            $json_data['profile_id']  = $profile_id;
                            $json_data['payment_id']  = $payment_profile_id;
                            $json_data['shipping_id'] = $shipping_profile_id;
                            $json_data['last_4']      = $last_4;
                            $json_data['cvv']         = $cc_cvv2;
                            $json_data['card_id']     = $post_id;
                            $json_data['post_id']     = $_POST['post_id'];
                            $message                  = json_encode($json_data);
                        }

                    }else{
                        $is_error     = 'yes';
                        $error_message['error'] = true;
                        $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                        $error_message['messages'][]= 'createCustomerShippingAddress';
                        $error_message['messages'][] = $cim->getResponseSummary();
                        $error_message['messages'][] = $cim->getResponse();
                    }

                }else{
                    $is_error     = 'yes';
                    $error_message['error'] = true;
                    $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                    $error_message['messages'][]= 'createCustomerPaymentProfile';
                    $error_message['messages'][] = $cim->getResponseSummary();
                    $error_message['messages'][] = $cim->getResponse();
                    $cim->deleteCustomerProfile();
                }


            }else{
                $is_error     = 'yes';
                $error_message['error'] = true;
                $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
                $error_message['messages'][]= 'createCustomerProfile';
            }

            if(!$profile_id){
                // look for it in the payment profiles
            }

        }catch (AuthnetCIMException $e){
            $message .= $e;
            $message .= $cim;
            $is_error     = 'yes';
            $error_message['error'] = true;
            $error_message['messages'][]= 'Error adding card, please verify all information is correct.';
            $error_message['messages'][]= $e;
        }
    }else{
        $is_error     = 'yes';
        $error_message['error'] = true;
        $error_message['messages'][] = 'Error adding card, please verify all information is correct.';
        $error_message['messages'][] = json_encode($response);
    }



  if($is_error == 'yes'){
    $message  = json_encode($error_message);
  }else{
    $message  = '['.json_encode($json_data).']';
  }

  echo $message;
  exit;
}

/*
  DELETE CARD CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_deletecard', 'deletecard' );
add_action( 'wp_ajax_deletecard', 'deletecard' );
function deletecard() {

    // form vars
    $card_id = $_POST['card_id'];
    $user_id      = $_POST['user_id'];

    $card_post = get_post($card_id);
    $json_data = array();
    if ($card_post && $card_post->post_type == "studykik-payments") {
        require('../_authorize/AuthnetCIM.php');
        try{
            // Create AuthnetCIM object. Set third parameter to "true" for developer account
            // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
            $ecommerce_user_production = get_option("ecommerce_user_production");
            if ((bool)$ecommerce_user_production) {
                $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
            } else {
                $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
            }

            $profile_id             = get_post_meta($card_id, 'auth_profile_id', true);
            $payment_profile_id     = get_post_meta($card_id, 'auth_payment_profile', true);
            $shipping_profile_id    = get_post_meta($card_id, 'auth_shipping_profile', true);
            $payment_user_id        = get_post_meta($card_id, 'payment_user_id', true);
            $auth_credit_card       = get_post_meta($card_id, 'auth_credit_card', true);
            $payment_card_code      = get_post_meta($card_id, 'auth_card_code', true);

            // Process the transaction
            $cim->setParameter('customerProfileId', $profile_id);
            $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
            $cim->setParameter('customerShippingAddressId', $shipping_profile_id);
            $cim->getCustomerProfile();
            // insert order
            // Get the payment profile ID returned from the request
            if ($cim->isSuccessful()){
                $cim->deleteCustomerProfile();
            }


        }catch (AuthnetCIMException $e){
            $json['status'] = "fail";
            $json['message'] = "Can't delete this card.";
        }

        wp_delete_post($card_id, true);
        $json['status'] = "success";
    } else {
        $json['status'] = "fail";
        $json['message'] = "Can't delete this card.";
    }

    echo json_encode($json);
    exit;
}

/*
  UPGRADE STUDY CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_upgrade_study', 'upgrade_study' );
add_action( 'wp_ajax_upgrade_study', 'upgrade_study' );
function upgrade_study() {
    $description          = 'Upgrade Study';
    $customer_id          = $_POST['user_id'];
    $purchase_amount      = 0;
    $upgrade_type = $_POST['upgrade_type'];
    $company = get_user_meta(get_current_user_id(), "sitename", true);
    $message_suite_2471            = $_POST['patient_messaging_suit_update'];

    if ($upgrade_type) {

        $pr=explode(" $",$upgrade_type);
        $prc=$pr[1];
        $purchase_amount=(int)$prc;
        $product_arr[$pr[0]." Listing"] = array("title" => $pr[0]." Listing", "price" => $purchase_amount, "qty" => 1);
    }
    if($message_suite_2471){
        $purchase_amount  = $purchase_amount + 247;
    }

    $study_id             = $_POST['study_id'];
    $coupon               = $_POST['coupon'];
    $credit_card_id       = $_POST['payment_credit_card_id'];
    $profile_id           = $_POST['payment_profile_id'];
    $payment_profile_id   = $_POST['payment_payment_id'];
    $shipping_profile_id  = $_POST['payment_shipping_id'];
    $payment_card_code    = $_POST['payment_card_code'];
    $products             = 'x';
    $json_data            = array();


    $auth_card_type                     = get_post_meta($credit_card_id, 'auth_card_type', true);
    $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
    $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
    $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);

    if($coupon){
        $discount         = get_coupon($coupon);

        if ($discount['type'] == "percent") {
            $percent  = (float) $discount['value'];
            $old_price        = (float) $purchase_amount;
            $discount_value   = ($old_price / 100) * $percent;
            $c_discount = $discount_value;
            $purchase_amount  = $old_price - $discount_value;
        } else if ($discount['type'] == "fixed") {
            $old_price        = (float) $purchase_amount;
            $discount_value   = (float) $discount['value'];
            $c_discount = $discount_value;
            if ($c_discount > $old_price) {
                $c_discount = $old_price;
            }
            $purchase_amount  = $old_price - $c_discount;
        }
    }
    if (is_user_logged_in() && get_user_meta(get_current_user_id(), 'allow_check', true) && $_POST['select_card'] == "Check") {
        $json_data = array();
        $json_data['data'] = array();
        $json_data['approved'] = 1;
        $message  = json_encode($json_data);
        echo '['.$message.']';

        $user_id = get_current_user_id();
        $firstname = get_user_meta($user_id, "first_name", true);
        $lastname = get_user_meta($user_id, "last_name", true);
        $company = get_user_meta($user_id, "sitename", true);
        $address = get_user_meta($user_id, "address", true);
        $userData = get_userdata($user_id);

        exit;
    }

    if ( $purchase_amount <= 0 ) {
        $purchase_amount = 0;
        $json_data = array();
        $json_data['data'] = array();
        $json_data['approved'] = 1;
        $message  = json_encode($json_data);
        echo '['.$message.']';

        exit;
    }

  $message = 'upgrade study';
  require('../_authorize/AuthnetCIM.php');
    try{
      // Create AuthnetCIM object. Set third parameter to "true" for developer account
      // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
        $ecommerce_user_production = get_option("ecommerce_user_production");
        if ((bool)$ecommerce_user_production) {
            $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
        } else {
            $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
        }

      // Process the transaction
      $cim->setParameter('amount', $purchase_amount);
      $cim->setParameter('customerProfileId', $profile_id);
      $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
      $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

        $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
        $cim->setParameter('invoiceNumber', $invoice_number);

        if ($payment_card_code) {
            $cim->setParameter('cardCode', $payment_card_code);
        }
      $cim->setLineItem('1', 'Upgrade Study', $products, '1', $purchase_amount);
      $cim->createCustomerProfileTransaction();

      // insert order
      // Get the payment profile ID returned from the request
      if ($cim->isSuccessful()){
          $approval_code = $cim->getAuthCode();

          $profile                = array();
          $profile['post_title']  = 'Upgrade - '.$study_id;
          $profile['post_status'] = 'publish';
          $profile['post_type']   = 'studykik-orders';

        	$post_id = wp_insert_post($profile);


          update_field('first_name',              $card_billing_first_name, $post_id);
          update_field('last_name',               $card_billing_last_name, $post_id);
          update_field('zip',                     $card_billing_zip, $post_id);


          update_field('post_id', $study_id, $post_id);
          update_field('study_post_link', get_edit_post_link($study_id), $post_id);
          update_field('amount', $purchase_amount, $post_id);
          update_field('coupon', $coupon, $post_id);
          update_field('approved', $approval_code, $post_id);

          update_field('patient_message_suite',   $message_suite_2471, $post_id);

          $json_data['data'] = $cim;
          $json_data['approved'] = $cim->getAuthCode();
          $json_data['invoice_number'] = $invoice_number;

      }else{
          $json_data['data'] = $cim;
        $json_data['approved'] = 'no';

          send_order_fail_email(array(
              "first_name" => $card_billing_first_name,
              "last_name" => $card_billing_last_name,
              "company" => $company,
              "zip" => $card_billing_zip,
              "transaction_id" => $cim->getTransactionID(),
              "payment_type" => $auth_card_type,
              "coupon" => $coupon,
              "coupon_amount" => $c_discount
          ));
      }


    }catch (AuthnetCIMException $e){
        send_order_fail_email(array(
            "first_name" => $card_billing_first_name,
            "last_name" => $card_billing_last_name,
            "company" => $company,
            "zip" => $card_billing_zip,
            "transaction_id" => $cim->getTransactionID(),
            "payment_type" => $auth_card_type,
            "coupon" => $coupon,
            "coupon_amount" => $c_discount
        ));
        $message .= $e;
        $message .= $cim;
    }
  $message  = json_encode($json_data);
  echo '['.$message.']';
  exit;
}

/*
  RENEW STUDY CODE AJAX
  ================================= */
add_action( 'wp_ajax_nopriv_renew_study', 'renew_study' );
add_action( 'wp_ajax_renew_study', 'renew_study' );
function renew_study() {
    $description          = 'Renew Study';
    $customer_id          = $_POST['user_id'];
    $purchase_amount      = $_POST['renew_type'];

    $company = get_user_meta(get_current_user_id(), "sitename", true);

    $purchase_amount      = 0;
    $product_arr = array();

    $product_id = $_POST['renew_type'];
    $product_title = get_the_title($product_id);
    $product_price = (float)get_post_meta($product_id, "product_price", true);
    $purchase_amount = $product_price;
    $product_arr[$product_title] = array("title" => $product_title, "price" => $product_price, "qty" => 1);


    $c_discount = 0;

    $study_id             = $_POST['study_id'];
    $coupon               = $_POST['coupon'];
    $credit_card_id       = $_POST['payment_credit_card_id'];
    $profile_id           = $_POST['payment_profile_id'];
    $payment_profile_id   = $_POST['payment_payment_id'];
    $shipping_profile_id  = $_POST['payment_shipping_id'];
    $payment_card_code    = $_POST['payment_card_code'];
    $select_date          = $_POST['select_date'];
    $message_suite_2471            = $_POST['message_suite_2471'];
    $condense_2_weeks1    = $_POST['condense_2_weeks1'];
    $products             = 'x';
    $json_data            = array();

    $auth_card_type            = get_post_meta($credit_card_id, 'auth_card_type', true);
    $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
    $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
    $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);

    if($coupon){
        $discount         = get_coupon($coupon);

        if ($discount['type'] == "percent") {
            $percent  = (float) $discount['value'];
            $old_price        = (float) $purchase_amount;
            $discount_value   = ($old_price / 100) * $percent;
            $c_discount = $discount_value;
            $purchase_amount  = $old_price - $discount_value;
        } else if ($discount['type'] == "fixed") {
            $old_price        = (float) $purchase_amount;
            $discount_value   = (float) $discount['value'];
            $c_discount = $discount_value;
            if ($c_discount > $old_price) {
                $c_discount = $old_price;
            }
            $purchase_amount  = $old_price - $c_discount;
        }
    }


    if($message_suite_2471){
        $pricex           = (float) $purchase_amount;
        $purchase_amount  = $purchase_amount + 247;
        $product_arr['Messaging Suite'] = array("title" => "Messaging Suite", "price" => 247, "qty" => 1);
    }
    $purchase_amount  = round($purchase_amount, 2);
    if (is_user_logged_in() && get_user_meta(get_current_user_id(), 'allow_check', true) && $_POST['select_card'] == "Check") {
        $json_data = array();
        $json_data['data'] = array();
        $json_data['approved'] = 1;
        $message  = json_encode($json_data);
        echo '['.$message.']';

        $user_id = get_current_user_id();
        $firstname = get_user_meta($user_id, "first_name", true);
        $lastname = get_user_meta($user_id, "last_name", true);
        $company = get_user_meta($user_id, "sitename", true);
        $address = get_user_meta($user_id, "address", true);
        $userData = get_userdata($user_id);

        exit;
    }

    if ( $purchase_amount <= 0 ) {

        $purchase_amount = 0;
        $json_data = array();
        $json_data['data'] = array();
        $json_data['approved'] = 1;
        $message  = json_encode($json_data);
        echo '['.$message.']';

        exit;
    }


  $message = 'upgrade study';
  require('../_authorize/AuthnetCIM.php');
    try{
      // Create AuthnetCIM object. Set third parameter to "true" for developer account
      // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
        $ecommerce_user_production = get_option("ecommerce_user_production");
        if ((bool)$ecommerce_user_production) {
            $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
        } else {
            $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
        }

        // Process the transaction
        $cim->setParameter('amount', $purchase_amount);
        $cim->setParameter('customerProfileId', $profile_id);
        $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
        $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

        $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
        $cim->setParameter('invoiceNumber', $invoice_number);

        if ($payment_card_code) {
            $cim->setParameter('cardCode', $payment_card_code);
        }
        $cim->setLineItem('1', 'Renew Study', $products, '1', $purchase_amount);
        $cim->createCustomerProfileTransaction();

        // insert order
        // Get the payment profile ID returned from the request
        if ($cim->isSuccessful()){
          $approval_code = $cim->getAuthCode();

          $profile                = array();
          $profile['post_title']  = 'Renew - '.$study_id;
          $profile['post_status'] = 'publish';
          $profile['post_type']   = 'studykik-orders';

        	$post_id = wp_insert_post($profile);



          update_field('first_name',              $card_billing_first_name, $post_id);
          update_field('last_name',               $card_billing_last_name, $post_id);
          update_field('zip',                     $card_billing_zip, $post_id);

          update_field('post_id',                 $study_id, $post_id);
          update_field('study_post_link',         get_edit_post_link($study_id), $post_id);
          update_field('amount',                  $purchase_amount, $post_id);
          update_field('approved',                $approval_code, $post_id);
          update_field('coupon',                  $coupon, $post_id);

          update_field('start_date',              $select_date, $post_id);
          update_field('patient_message_suite',   $message_suite_2471, $post_id);
          update_field('condense_to_2_weeks',     $condense_2_weeks1, $post_id);

          $json_data['data'] = $cim;
          $json_data['approved'] = $cim->getAuthCode();
          $json_data['invoice_number'] = $invoice_number;

      }else{
//            print_r($cim);
        $json_data['data'] = $cim;
        $json_data['approved'] = 'no';

            send_order_fail_email(array(
                "first_name" => $card_billing_first_name,
                "last_name" => $card_billing_last_name,
                "company" => $company,
                "zip" => $card_billing_zip,
                "transaction_id" => $cim->getTransactionID(),
                "payment_type" => $auth_card_type,
                "coupon" => $coupon,
                "coupon_amount" => $c_discount
            ));
      }


    }catch (AuthnetCIMException $e){
        send_order_fail_email(array(
            "first_name" => $card_billing_first_name,
            "last_name" => $card_billing_last_name,
            "company" => $company,
            "zip" => $card_billing_zip,
            "transaction_id" => $cim->getTransactionID(),
            "payment_type" => $auth_card_type,
            "coupon" => $coupon,
            "coupon_amount" => $c_discount
        ));
        $message .= $e;
        $message .= $cim;
    }
  $message  = json_encode($json_data);
  echo '['.$message.']';
  exit;
}

/*
  Shopping cart list a study page - mesage suite charges
  ================================= */
add_action( 'wp_ajax_nopriv_newstudymessagesuite', 'newstudymessagesuite' );
add_action( 'wp_ajax_newstudymessagesuite', 'newstudymessagesuite' );
function newstudymessagesuite() {
    $user_id              = $_POST['user_id'];
    $profile_id           = $_POST['payment_profile_id'];
    $credit_card_id       = $_POST['payment_credit_card_id'];
    $payment_profile_id   = $_POST['payment_payment_id'];
    $shipping_profile_id  = $_POST['payment_shipping_id'];
    $payment_card_code    = $_POST['payment_card_code'];
    $cc_number            = $_POST['cc_number'];
    $cc_exp_month            = $_POST['cc_exp_month'];
    $cc_exp_year            = $_POST['cc_exp_year'];
    $cc_cvv2            = $_POST['cc_cvv2'];
    $zip            = $_POST['zip'];
    $transaction_id       = $_POST['transaction_id'];
    $invoice_number       = $_POST['invoice_number'];
    $message_suites          = $_POST['message_suites'];
    $purchase_amount      = $_POST['amount'];
    $company = get_user_meta($user_id, "sitename", true);
    $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);

    $user_data = get_userdata($user_id);
    $firstname = get_user_meta($user_id, "first_name", true);
    $lastname = get_user_meta($user_id, "last_name", true);
    $product_arr = array();

    $product_arr["Messaging Suite"] = array("title" => "Messaging Suite", "price" => 247, "qty" => intval($purchase_amount / 247.0));

    $products             = 'x';
    $json_data            = array();

    if ($profile_id && $payment_profile_id && $credit_card_id) {
        $auth_card_type                     = get_post_meta($credit_card_id, 'auth_card_type', true);
        $card_billing_first_name            = get_post_meta($credit_card_id, 'card_billing_first_name', true);
        $card_billing_last_name             = get_post_meta($credit_card_id, 'card_billing_last_name', true);
        $card_billing_zip                   = get_post_meta($credit_card_id, 'card_billing_zip', true);

      $message = 'upgrade study';
      require('../_authorize/AuthnetCIM.php');
        try{
          // Create AuthnetCIM object. Set third parameter to "true" for developer account
          // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
            $ecommerce_user_production = get_option("ecommerce_user_production");
            if ((bool)$ecommerce_user_production) {
                $cim                  = new AuthnetCIM('5R38Kya2Sq', '4FRp7YUb4Fq836zQ', AuthnetCIM::USE_PRODUCTION_SERVER);
            } else {
                $cim                  = new AuthnetCIM('75sFujS9F4u6', '9gzzEV895FY8q6cm', AuthnetCIM::USE_DEVELOPMENT_SERVER);
            }

          // Process the transaction
          $cim->setParameter('amount', $purchase_amount);
          $cim->setParameter('customerProfileId', $profile_id);
          $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
          $cim->setParameter('customerShippingAddressId', $shipping_profile_id);

            if (!$invoice_number)
                $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
            $cim->setParameter('invoiceNumber', $invoice_number);

            if ($payment_card_code) {
                $cim->setParameter('cardCode', $payment_card_code);
            }
          $cim->setLineItem('1', 'Patient Messaging Suite', $products, '1', $purchase_amount);
          $cim->createCustomerProfileTransaction();

          // insert order

          // Get the payment profile ID returned from the request
          if ($cim->isSuccessful()){
              $approval_code = $cim->getAuthCode();

              $profile                = array();
              $profile['post_title']  = 'Messaging Suite - Transaction: '.$transaction_id;
              $profile['post_status'] = 'publish';
              $profile['post_author'] = $user_id;
              $profile['post_type']   = 'studykik-orders';

                $post_id = wp_insert_post($profile);

              update_field('first_name',              $card_billing_first_name, $post_id);
              update_field('last_name',               $card_billing_last_name, $post_id);
              update_field('zip',                     $card_billing_zip, $post_id);

              update_field('amount', $purchase_amount, $post_id);
              update_field('approved', $approval_code, $post_id);
              update_field('patient_message_suite', $message_suites, $post_id);


              $json_data['data'] = $cim;
              $json_data['approved'] = $cim->getAuthCode();
              $json_data['invoice_number'] = $invoice_number;

          }else{
            $json_data['data'] = $cim;
            $json_data['approved'] = 'no';

              send_order_fail_email(array(
                  "first_name" => $card_billing_first_name,
                  "last_name" => $card_billing_last_name,
                  "company" => $company,
                  "zip" => $card_billing_zip,
                  "transaction_id" => $cim->getTransactionID(),
                  "payment_type" => $auth_card_type,
                  "coupon" => "",
                  "coupon_amount" => ""
              ));
          }


        }catch (AuthnetCIMException $e){
            send_order_fail_email(array(
                "first_name" => $card_billing_first_name,
                "last_name" => $card_billing_last_name,
                "company" => $company,
                "zip" => $card_billing_zip,
                "transaction_id" => $cim->getTransactionID(),
                "payment_type" => $auth_card_type,
                "coupon" => "",
                "coupon_amount" => ""
            ));
            $message .= $e;
            $message .= $cim;
        }
    } else {
        include('../_authorize/anet_php_sdk/AuthorizeNet.php');
        addToPaymentLog('payment progress 15', $user_id);
        $ecommerce_user_production = get_option("ecommerce_user_production");
        if ((bool)$ecommerce_user_production) {
            define("AUTHORIZENET_API_LOGIN_ID", "5R38Kya2Sq");
            define("AUTHORIZENET_TRANSACTION_KEY", "4FRp7YUb4Fq836zQ");
            define("AUTHORIZENET_SANDBOX", false);
        } else {
            define("AUTHORIZENET_API_LOGIN_ID", "75sFujS9F4u6");
            define("AUTHORIZENET_TRANSACTION_KEY", "9gzzEV895FY8q6cm");
            define("AUTHORIZENET_SANDBOX", true);
        }

        $sale = new AuthorizeNetAIM;
        $sale->amount     			  = $purchase_amount;
        $sale->cust_id     		  = $customer_id;
        $sale->card_num   			  = $cc_number;
        $sale->exp_date   			  = $cc_exp_month.$cc_exp_year;
        $sale->first_name 			  = $firstname;
        $sale->last_name  			  = $lastname;
        $sale->zip       		      = $zip;

        $invoice_number = get_current_user_id() . mt_rand(100000, 999999);
        $sale->invoice_num = $invoice_number;

        if ($company) {
            $sale->company            = $company;
        }
        $sale->VERIFY_PEER        = false;


        //$response = $sale->authorizeOnly();
        $response = $sale->authorizeAndCapture();
        addToPaymentLog('payment progress 16', $user_id);
        if ($response->approved) {
            addToPaymentLog('payment progress 17', $user_id);
            $transaction_id  = $response->transaction_id;
            addToPaymentLog('transaction_id ='.$transaction_id, $user_id);
            $json_data['data'] = $response;
            $json_data['approved'] = "yes";
            $json_data['invoice_number'] = $invoice_number;

        }else{
            $json_data['data'] = $response;
            $json_data['approved'] = 'no';
            addToPaymentLog('payment progress 19', $user_id);
            send_order_fail_email(array(
                "first_name" => $firstname,
                "last_name" => $lastname,
                "company" => $company,
                "zip" => $zip,
                "transaction_id" => $response->transaction_id,
                "payment_type" => $response->card_type,
                "coupon" => "",
                "coupon_amount" => ""
            ));

            $message = 'error|'.$response->response_reason_text;
            $approved = 'no';
        }
    }
  $message  = json_encode($json_data);
  echo '['.$message.']';
  exit;  
}

/*
  GET COUPON CODE AJAX
  ================================= */
function get_coupon($coupon){
  
  $searchARR_1  = array('key'=>'coupon_code','value'=>$coupon,'compare'=>'=');
  $searchARR    = array(
    $searchARR_1
  );

  $args = array(
  	'posts_per_page'   => -1,
  	'offset'           => 0,
  	'category'         => '',
  	'category_name'    => '',
  	'include'          => '',
  	'exclude'          => '',
  	'meta_value'       => '',
  	'meta_query'       => array($searchARR),
  	'post_type'        => 'studykik-coupons',
  	'post_mime_type'   => '',
  	'post_parent'      => '',
  	'post_status'      => 'publish',
  	'suppress_filters' => true,
  	'meta_key'			   => 'coupon_code',
  	'orderby'			     => '',
  	'order'				     => 'ASC'
  );
  $coupons = get_posts( $args );
    if (count($coupons) > 0) {
        $coupon_discount = get_field('discount_percent',$coupons[0]->ID);
        $coupon_fixed_discount = get_field('fixed_discount',$coupons[0]->ID);
        if ( $coupon_fixed_discount > 0 ) {
            return array("type" => "fixed", "value" => $coupon_fixed_discount);
        } else if ($coupon_discount > 0) {
            return array("type" => "percent", "value" => $coupon_discount);
        } else {
            return array("type" => "invalid", "value" => 0);
        }
    } else {
        return array("type" => "invalid", "value" => 0);
    }
}

/*
  PRODUCTS POST TYPE
  ================================= */
add_action('init', 'studyKIK_products');
function studyKIK_products() {

  $labelsproducts = array(
		'name' => _x('Products', 'post type general name'),
		'singular_name' => _x('Products Item', 'post type singular name'),
		'add_new' => _x('Add New', 'Products item'),
		'add_new_item' => __('Add New Products Item'),
		'edit_item' => __('Edit Products Item'),
		'new_item' => __('New Products Item'),
		'view_item' => __('View Products Item'),
		'search_items' => __('Search Products'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args_products = array(
		'labels' => $labelsproducts,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','custom-fields')
  );

  register_post_type( 'studykik-products' , $args_products );

}

/*
  COUPONS POST TYPE
  ================================= */
add_action('init', 'studyKIK_coupons');
function studyKIK_coupons() {

  $labelscoupons = array(
		'name' => _x('Coupons', 'post type general name'),
		'singular_name' => _x('Coupons Item', 'post type singular name'),
		'add_new' => _x('Add New', 'Coupons item'),
		'add_new_item' => __('Add New Coupons Item'),
		'edit_item' => __('Edit Coupons Item'),
		'new_item' => __('New Coupons Item'),
		'view_item' => __('View Coupons Item'),
		'search_items' => __('Search Coupons'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args_coupons = array(
		'labels' => $labelscoupons,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','custom-fields')
  );

  register_post_type( 'studykik-coupons' , $args_coupons );

}


/*
  ORDERS POST TYPE
  ================================= */
add_action('init', 'studyKIK_orders');
function studyKIK_orders() {

  $labelsorders = array(
		'name' => _x('Orders', 'post type general name'),
		'singular_name' => _x('Orders Item', 'post type singular name'),
		'add_new' => _x('Add New', 'Orders item'),
		'add_new_item' => __('Add New Orders Item'),
		'edit_item' => __('Edit Orders Item'),
		'new_item' => __('New Orders Item'),
		'view_item' => __('View Orders Item'),
		'search_items' => __('Search Orders'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args_orders = array(
		'labels' => $labelsorders,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','custom-fields')
  );

  register_post_type( 'studykik-orders' , $args_orders );

}

/*
  PAYMENTS POST TYPE
  ================================= */
add_action('init', 'studyKIK_payments');
function studyKIK_payments() {

  $labelspayments = array(
		'name' => _x('Payment Profiles', 'post type general name'),
		'singular_name' => _x('Payment Profiles Item', 'post type singular name'),
		'add_new' => _x('Add New', 'Payment Profiles item'),
		'add_new_item' => __('Add New Payment Profiles Item'),
		'edit_item' => __('Edit Payment Profiles Item'),
		'new_item' => __('New Payment Profiles Item'),
		'view_item' => __('View Payment Profiles Item'),
		'search_items' => __('Search Payment Profiles'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args_payments = array(
		'labels' => $labelspayments,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title')
  );

  register_post_type( 'studykik-payments' , $args_payments );

}

/* ========================================================

END SEEDCMS.com - auth.net integration

=========================================================== */

add_action('init', 'checkForUserPrivileges');

function checkForUserPrivileges() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'clinical-study-information-new' ) {
        if ( !is_user_logged_in() ) {
            wp_redirect( site_url().'/login/', 301 ); exit;
        }
    }
}

add_filter('acf/field_group/get_fields', 'custom_acf_get_fields', 10, 2);
function custom_acf_get_fields( $return, $post_id )
{
    $arr = array();
    if ($_REQUEST['page_type'] == "user") {
        $option_arr = explode("_", $_REQUEST['option_name']);
        if ($option_arr[1]) {
            $userData = get_userdata($option_arr[1]);
            $user_roles = implode(', ', $userData->roles);


        }
    }
    foreach($return as $key => $val) {
        if (!($user_roles && $user_roles == "manager_username" && $val['name'] == "manager")) {
            $arr[$key] = $val;
        }

    }
    return $arr;
}
add_action( 'updated_user_meta', 'my_update_user_meta', 10, 4 );

function my_update_user_meta($meta_id, $object_id, $meta_key, $_meta_value) {
    if ($meta_key == "manager") {
        $userData = get_userdata($object_id);
        $user_roles = implode(', ', $userData->roles);
        if ($user_roles == "editor") {
            $queryArgs = array(
                'posts_per_page' => -1,
                'post__not_in' => array(108),
                'author' => $object_id
            );
//            print_r($queryArgs);
            query_posts($queryArgs);

            if (have_posts()) {
                while (have_posts()) : the_post();
                    update_post_meta($post->ID, 'manager_username', $_meta_value);
                endwhile;
            }

        }
    }
}

add_filter('acf/load_field/type=select', 'my_acf_load_select_fields', 10, 3);

function my_acf_load_select_fields($field, $field_key, $post_id = false) {

    if ($field['key'] == 'field_55d4d82a5ef7d' || $field['key'] == 'field_55d4d8455ef7e' || $field['key'] == 'field_55d4d8635ef7f' || $field['key'] == 'field_55d4d8745ef80' || $field['key'] == 'field_55d4e07ecddb6') {
        $blogusers = get_users(array('fields' => array('ID', 'user_login')));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;
        //if($field['value'] ==""){
        //    $field['value']=6;
        //}
    }
    //sponser information--> subscriber field
    if ($field['key'] == 'field_55f064525eba0') {
        $result_cat=mysql_query("SELECT * FROM 0gf1ba_callfire_numbers WHERE number_type = '2'");
        $frm_num=array();
        $x = "";
        $frm_num[$x]='Select Phone number';
        while($row = mysql_fetch_assoc($result_cat)) {
            $nm=$row['phone_number'];
            $frm_num[$nm]=$nm;
        }
        $field['choices'] = $frm_num;
    }
    if ($field['key'] == 'field_5627e4b9b6fae') {
        $result_cat=mysql_query("SELECT * FROM 0gf1ba_callfire_numbers WHERE number_type = '2'");
        $frm_num=array();
        $x = "";
        $frm_num[$x]=' Select Text Message Purchased Number';
        while($row = mysql_fetch_assoc($result_cat)) {
            $nm=$row['phone_number'];
            $frm_num[$nm]= $nm;
        }
        $field['choices'] = $frm_num;
    }


    if ($field['key'] == 'field_55d606cd6c814') {
        $blogusers = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'subscriber'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;
    }
    //Dashboard Manager--> social media manager
    if ($field['key'] == 'field_556e0849003ad') {
        $blogusers1 = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'administrator'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers1 as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $new_usr[506] = 'aarana';
        $field['choices'] = $new_usr;
    }//Dashboard Manager--> project manager
    if ($field['key'] == 'field_556e088c003ae') {
        $blogusers2 = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'author'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers2 as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;
    }
    //Dashboard Manager--> master
    if ($field['key'] == 'field_556e08bf003af') {
        $blogusers3 = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'administrator'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers3 as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;
        if($field['value'] ==""){
            $field['value']=45;
        }
    }
    //Username--> Manager Username
    if ($field['key'] == 'field_55d888588ff3a') {
        $blogusers4 = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'manager_username'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = $x;
        foreach ($blogusers4 as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;

    }
    //Username--> Manager Username
    if ($field['_name'] == 'manager') {
        $blogusers4 = get_users(array('fields' => array('ID', 'user_login'), 'role' => 'manager_username'));
        // Array of WP_User objects.
        $new_usr = array();
        $x = "";
        $new_usr[$x] = "Choose Manager";
        foreach ($blogusers4 as $user) {
            $uid = $user->ID;
            $ulogin = $user->user_login;
            $new_usr[$uid] = $ulogin;
        }
        $field['choices'] = $new_usr;

        $current_user = get_userdata($_REQUEST['user_id']);
        $editable_roles = get_editable_roles();
    }

    //Callfire ->post all category
    if ($field['key'] == 'field_55e4897cbddc2') {
        $args = array(
            'type'                     => 'post',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'hierarchical'             => 1,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category',
            'pad_counts'               => false

        );
        $categories = get_categories( $args);
        //$categories = json_decode(json_encode($categories), true);
        $opts=array();
        $x = "";
        $opts[$x] = $x;
        foreach($categories as $k=>$cd){
            $catnm=$cd->name;
            $opts[$cd->cat_ID]=$catnm;

        }
        //echo "<pre>";
        //print_r($categories);
        //print_r($opts);
        //asort($opts);

        $field['choices'] = $opts;
    }

    return $field;

}

//add_filter('acf/parse_types', 'custom_parse_types', 0, 1);

function custom_parse_types( $value )
{
    remove_filter('acf/parse_types', array(acf(), 'parse_types'), 1, 1);
    // vars
    $restricted = array(
        'label',
        'name',
        '_name',
        'value',
        'instructions'
    );


    // is value another array?
    if( is_array($value) )
    {
        foreach( $value as $k => $v )
        {
            // bail early for restricted pieces
            if( in_array($k, $restricted, true) )
            {
                continue;
            }


            // filter piece
            $value[ $k ] = apply_filters( 'acf/parse_types', $v );
        }
    }
    else
    {
        // string
        if( is_string($value) )
        {
            $value = trim( $value );
        }


        // numbers
        if( is_numeric($value) )
        {
            // check for non numeric characters
            if( preg_match('/[^0-9]/', $value) )
            {
                // leave value if it contains such characters: . + - e
                //$value = floatval( $value );
            }
            else
            {
                $value = intval( $value );
            }
        }

    }


    // return
    return $value;
}


add_action('acf/save_post', 'my_acf_save_post', 20);

function my_acf_save_post( $post_id ) {

    if (strpos($post_id, "user") != -1) {
        $option_arr = explode("_", $post_id);
        if ($option_arr[1]) {
            $userData = get_userdata($option_arr[1]);
            $user_roles = implode(', ', $userData->roles);
            if ($user_roles == "editor") {
                $value = get_user_meta($option_arr[1], 'manager', true);
                $queryArgs = array(
                    'posts_per_page' => -1,
                    'post__not_in' => array(108),
                    'author' => $option_arr[1]
                );
                query_posts($queryArgs);

                $post_results = query_posts($queryArgs);
                foreach($post_results as $key => $post_obj) {
//                    print_r($post_obj->ID);
                    update_post_meta($post_obj->ID, 'manager_username', $value);
                }
            }
        }
    }

}

function addCustomPostColumns ($defaults){
    $defaults['get_patients'] = 'Patients';
    $defaults['study_no_column'] = 'Study#';
    return $defaults;
}

function editCustomPostColumns($column_name, $post_id) {
    if ( 'get_patients' == $column_name ) {
        echo '<a href="'.get_site_url().'/wp-admin/admin.php?page=study_patients&post_id='.$post_id.'">Show</a>';
    }
    if ( 'study_no_column' == $column_name ) {
        echo (get_post_meta($post_id, 'study_no',true ) ? get_post_meta($post_id, 'study_no',true ): '-');
    }
}

add_filter( 'manage_posts_columns', 'addCustomPostColumns' );
add_action( 'manage_posts_custom_column', 'editCustomPostColumns', 10, 2 );

add_action('init', 'getStudyPatientsJson');

function getStudyPatientsJson() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'study_patients_json' ) {
        if ( !is_user_logged_in() ) {
            wp_redirect( site_url().'/login/', 301 ); exit;
        }else{
            global $wpdb;
            $start = $_GET['start'];
            $length = $_GET['length'];
            $order_col_n = isset($_GET['order'][0]['column'])?$_GET['order'][0]['column']:$_GET['order'][0][0];
            $order_dir = isset($_GET['order'][0]['dir'])?$_GET['order'][0]['dir']:$_GET['order'][0][1];
            switch($order_col_n){
                case 0:
                    $order_col_name = 'name';
                    break;
                case 1:
                    $order_col_name = 'phone';
                    break;
                case 2:
                    $order_col_name = 'email';
                    break;
                case 3:
                    $order_col_name = 'date';
                    break;
            }

            $search = isset($_GET['search']['value'])?$_GET['search']['value']:$_GET['search']['search'];
            $add_where = '';
            if ($search){
                $add_where = 'AND (name LIKE "%'.$search.'%" OR phone LIKE "%'.$search.'%" OR email LIKE "%'.$search.'%")';
            }

            if (isset($_GET['excel'])){
                $sql = 'SELECT name, email, phone, date FROM 0gf1ba_subscriber_list WHERE post_id = '.$_GET['post_id'].' '.$add_where.' AND is_deleted != 1 ORDER BY '.$order_col_name .' '.$order_dir.'';
                $patients_arr = $wpdb->get_results($sql, ARRAY_A);
                generatePatientsExcel($patients_arr);
            }

            $sql = 'SELECT name, email, phone, date FROM 0gf1ba_subscriber_list WHERE post_id = '.$_GET['post_id'].' '.$add_where.' AND is_deleted != 1 ORDER BY '.$order_col_name .' '.$order_dir.' LIMIT '.$length.' OFFSET '.$start.'  ';
            $patients_arr = $wpdb->get_results($sql, ARRAY_A);

            $sql = 'SELECT COUNT(*) as count FROM 0gf1ba_subscriber_list WHERE post_id = '.$_GET['post_id'].' '.$add_where.' AND is_deleted != 1';
            $count = $wpdb->get_results($sql, ARRAY_A);



            //$data = array('name' => 'test', 'phone' => 'test2', 'email' => 'test3', 'date' => 'test4');

            $res = array();
            $res['draw'] = $_GET['draw'];
            $res['recordsTotal'] = $count[0]['count'];
            $res['recordsFiltered'] = $count[0]['count'];
            $res['data'] = $patients_arr;

            echo json_encode($res);
            die;
        }
    }
}

function generatePatientsExcel($patients, $report_name = 'Study_Patients_Report'){
    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
    PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    if (!defined('PCLZIP_TEMPORARY_DIR')) {
        define( 'PCLZIP_TEMPORARY_DIR', '/tmp/' );
    }
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("StudyKIK Team")
        ->setLastModifiedBy("StudyKIK Team")
        ->setTitle("Download Patient Details")
        ->setSubject("Download Patient Details")
        ->setDescription("Download Patient Details")
        ->setKeywords("Download Patient Details")
        ->setCategory("Download Patient Details");
    // Add some data

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A6', 'Name')
        ->setCellValue('B6', 'Phone')
        ->setCellValue('C6', 'Email')
        ->setCellValue('D6', 'Date');

    $i=7;
    foreach($patients as $key => $patient){
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $patient['name'])
            ->setCellValue('B' . $i, $patient['phone'])
            ->setCellValue('C' . $i, $patient['email'])
            ->setCellValue('D' . $i, $patient['date']);

        $objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('C7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D7')->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->applyFromArray(
            array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => true
            )
        );
        $i++;
    }


    $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '000000'),
            'size' => 12
        ));
    $objPHPExcel->getActiveSheet()->getStyle('A6:D6')->applyFromArray($styleArray);
    //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

    $objPHPExcel->getActiveSheet()->mergeCells('A1:A4');
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $logo = dirname(__FILE__) . '/images/studylogo.png';
    $objDrawing->setPath($logo);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setHeight(40);
    $objDrawing->setWidth(250);
    $flen=round($len*8.5);
    $off=($flen-250)/2;
    if($off>0){
        $objDrawing->setOffsetX($off);
    }
    $objDrawing->setOffsetY(15);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Download Patient');
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $file = $report_name.'.xls';
    // Redirect output to a client's web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='.$file);
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');

}

add_action('init', 'updateBypassAweber');

function updateBypassAweber() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'update-bypass-aweber' ) {
        global $wpdb;
        $action = isset($_GET['action'])?$_GET['action']:'on';

        $sql = "SELECT ID FROM 0gf1ba_posts  WHERE post_type = 'post' ";
        $results = $wpdb->get_results($sql);

        foreach($results as $post){
            if ($action == 'on'){
                update_post_meta($post->ID, 'pass_aweber', array('yes'));
            }else{
                update_post_meta($post->ID, 'pass_aweber', '');
            }
        }
        echo 'end';
    }
}


///
add_action('init', 'check_suvoda_api_init');

function check_suvoda_api_init() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'check_suvoda_api_init' ) {
		check_suvoda_api();
	}
}

add_action('cron_check_suvoda_api', 'check_suvoda_api');

function check_suvoda_api(){

	global $wpdb;
	$sql = 'SELECT * FROM 0gf1ba_subscriber_list as s JOIN 0gf1ba_postmeta as pm ON pm.post_id = s.post_id '
			.' WHERE pm.meta_key = \'suvoda_protocol_id\' AND pm.meta_value != \'\' LIMIT 5;';


	$result = $wpdb->get_results($sql);
	if ($result){
		$message = '';
		foreach($result as $row){
			$user = 'suvoda';
			$password = 'suvodatest';
			$params = array('phone' => $row->phone);
			$url = 'https://studykik.com/api_v1/get_patient_info.php';

			$http = curl_init($url);

			curl_setopt($http, CURLOPT_POST, true);
			curl_setopt($http, CURLOPT_POSTFIELDS, ($params));
			curl_setopt($http, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($http, CURLOPT_USERPWD, $user . ":" . $password);
			$res = curl_exec($http);
			$res_decoded = json_decode($res);
			if (!$res || !$res_decoded || !isset($res_decoded->result)){
				$message = 'Can not get patient info for patient with ID = '.$row->id.', phone = '.$row->phone .'<br/>';
			}
		}
		if ($message){
			$emails = ['info@studykik.com', 'dnessonov@gmail.com'];
			$subject = 'Suvoda API test failed.';
			wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );
		}
	}
}


//test

add_action('init', 'main_page_subscription');

function main_page_subscription() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'main_page_subscription' ) {
		global $wpdb;
		$sql = 'SELECT * FROM main_page_subscriber WHERE email = \''.mysql_real_escape_string($_POST['email']).'\';';
		$result = $wpdb->get_results($sql);
		if ($result){
			wp_redirect( site_url().'/?registered=1', 301 ); exit;
		}else{
			$sql = 'INSERT INTO main_page_subscriber (name, email, phone) VALUES ('.
					' \''.mysql_real_escape_string($_POST['name']).'\', '.
					' \''.mysql_real_escape_string($_POST['email']).'\', '.
					' \''.mysql_real_escape_string($_POST['custom_Mobile_Phone_Number']).'\' '.
					')';
			mysql_query($sql);
			wp_redirect( site_url().'/?subscribe_success=1', 301 ); exit;
		}
	}
}

function main_page_subscribers() {
	get_template_part( 'main_page_subscribers');
}


add_action('init', 'getMainPageSubscribersJson');

function getMainPageSubscribersJson()
{
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if ($url_path === 'main_page_subscribers_json') {
		if ( !is_user_logged_in() ) {
			wp_redirect( site_url().'/login/', 301 ); exit;
		}else{
			global $wpdb;
			$start = $_GET['start'];
			$length = $_GET['length'];
			$order_col_n = isset($_GET['order'][0]['column'])?$_GET['order'][0]['column']:$_GET['order'][0][0];
			$order_dir = isset($_GET['order'][0]['dir'])?$_GET['order'][0]['dir']:$_GET['order'][0][1];
			switch($order_col_n){
				case 0:
					$order_col_name = 'name';
					break;
				case 1:
					$order_col_name = 'phone';
					break;
				case 2:
					$order_col_name = 'email';
					break;
				case 3:
					$order_col_name = 'date';
					break;
			}

			$search = isset($_GET['search']['value'])?$_GET['search']['value']:$_GET['search']['search'];
			$add_where = '';
			if ($search){
				$add_where = 'AND (name LIKE "%'.$search.'%" OR phone LIKE "%'.$search.'%" OR email LIKE "%'.$search.'%")';
			}

			if (isset($_GET['excel'])){
				$sql = 'SELECT name, email, phone, date FROM main_page_subscriber WHERE 1 '.$add_where.' ORDER BY '.$order_col_name .' '.$order_dir.'';
				$patients_arr = $wpdb->get_results($sql, ARRAY_A);
				generatePatientsExcel($patients_arr, 'Subscribed people');
			}

			$sql = 'SELECT name, email, phone, date FROM main_page_subscriber WHERE 1 '.$add_where.' ORDER BY '.$order_col_name .' '.$order_dir.' LIMIT '.$length.' OFFSET '.$start.'  ';
			$patients_arr = $wpdb->get_results($sql, ARRAY_A);

			$sql = 'SELECT COUNT(*) as count FROM main_page_subscriber WHERE 1 '.$add_where.'';
			$count = $wpdb->get_results($sql, ARRAY_A);


			$res = array();
			$res['draw'] = $_GET['draw'];
			$res['recordsTotal'] = $count[0]['count'];
			$res['recordsFiltered'] = $count[0]['count'];
			$res['data'] = $patients_arr;

			echo json_encode($res);
			die;
		}
	}
}

function addToCallfireCreditsLog($user_id, $prev_credits, $new_credits, $action, $text = ''){
    $sql = 'INSERT INTO 0gf1ba_callfire_log (user_id, prev_credits, new_credits, action, text) VALUES ('
        .' \''.mysql_real_escape_string($user_id).'\', '
        .' \''.mysql_real_escape_string($prev_credits).'\', '
        .' \''.mysql_real_escape_string($new_credits).'\', '
        .' \''.mysql_real_escape_string($action).'\', '
        .' \''.mysql_real_escape_string($text).'\' '
    .');';
    mysql_query($sql);
}

add_action('cron_checkNegativeCallfireCredits', 'checkNegativeCallfireCredits');

function checkNegativeCallfireCredits(){
    global $wpdb;
    $sql = 'SELECT * FROM 0gf1ba_usermeta WHERE meta_key = \'callfire_credits\'  AND meta_value < 0;';
    $result = $wpdb->get_results($sql);
    if ($result){
        $users_arr = array();
        foreach($result as $row){
            $users_arr[] = $row->user_id;
        }
        $users_arr = array_unique($users_arr);
        foreach($users_arr as $id){
            addToCallfireCreditsLog($id, get_user_meta($id, 'callfire_credits', true), 0, 'Changed by cron script');
            update_user_meta($id, 'callfire_credits', 0);
        }
        $emails = ['alexmanager1991@gmail.com', 'dnessonov@gmail.com'];
        $subject = 'Negative Callfire Credits.';
        $message = 'User ids = ('.implode(',', $users_arr).')';
        wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );
    }
}

function deletePatientDashboard($id){
    global $wpdb;

    $patient_info = $wpdb->get_results($wpdb->prepare("SELECT * FROM 0gf1ba_subscriber_list WHERE id = %d", $id), OBJECT);
    if ($patient_info){
        $post_id = $patient_info[0]->post_id;
        $query_delete = $wpdb->query($wpdb->prepare("UPDATE 0gf1ba_subscriber_list SET is_deleted = 1 WHERE id = %d", $id));

        $emails = ['info@studykik.com'];
        $slug = get_post_meta( $post_id, 'study_no', true );
        $custom_title_for_thank_you_page = get_post_meta( $post_id, 'custom_title_(for_thank_you_page)', true );
        $name_of_site = get_post_meta( $post_id, 'name_of_site', true );
        $phone_number12 = $patient_info[0]->phone;
        $message = '<a href="'.get_post_permalink( $post_id ).'">Landing page</a>';
        $subject = $patient_info[0]->name." was deleted from (".$slug." ".$custom_title_for_thank_you_page." ".$name_of_site." ".$phone_number12.")";
        wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );

        return $query_delete;
    }else{
        return false;
    }

}

function addToPaymentLog($val, $user_id){
    $sql = 'INSERT INTO 0gf1ba_payment_log (user_id, value) VALUES ('
        .' \''.mysql_real_escape_string($user_id).'\', '
        .' \''.mysql_real_escape_string($val).'\' '
        .');';
//    mysql_query($sql);
}

function addToEmailLog($val, $user_id){
    $sql = 'INSERT INTO 0gf1ba_email_log (user_id, value) VALUES ('
        .' \''.mysql_real_escape_string($user_id).'\', '
        .' \''.mysql_real_escape_string($val).'\' '
        .');';
    mysql_query($sql);
}


function addToCronJobsLog($name, $status){
    global $wpdb;
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $wpdb->query($wpdb->prepare("INSERT INTO 0gf1ba_cron_jobs_log (name, date, status) VALUES (%s, %s, %s)", $name, $now->format('Y-m-d H:i:s'), $status));
}

function checkCronJobs(){
    global $wpdb;
    $cronJobsNames = array(
        'post_expire',
        'wp_version_check',
        'wp_update_plugins',
        'wp_update_themes',
        'yst_ga_aggregate_data',
        'wp_scheduled_delete',
        'wp_scheduled_auto_draft_delete',
        'updraft_backup',
        'updraft_backup_database'
    );

    $currentCronJobs = get_option('cron');
    $currentCronJobsArr = array();
    $missedCronJobs = array();
    $errorMessage = '';
    if ($currentCronJobs){
        foreach($currentCronJobs as $key => $cronJob){
            if (is_array($cronJob)){
                foreach ($cronJob as $jobName => $row){
                    $currentCronJobsArr[] = $jobName;
                }
            }
        }
        foreach($cronJobsNames as $cronJob){
            if (!in_array($cronJob, $currentCronJobsArr)){
                $missedCronJobs[] = $cronJob;
            }
        }
    }else{
        $missedCronJobs[] = 'Can not get "cron" option from DB.';
    }

    if (!empty($missedCronJobs)){
        $emails = ['info@studykik.com'];
        $subject = 'Legacy Site Cron Job got deleted (wp)';
        $message = 'Deleted cron jobs ( '.implode(', ',$missedCronJobs).' )';
        wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );
    }

    $now = new DateTime('now', new DateTimeZone('UTC'));

    /*$sql = 'SELECT name, max(date) as last_date '
            .'FROM 0gf1ba_cron_jobs_log '
            .'WHERE ( (name = \'cron_getnumbers\' OR name = \'auto_private\') AND DATE_ADD(date, INTERVAL 25 MINUTE) < %s ) OR '
            .' ( (name = \'send_text_messages_1\' OR name = \'send_text_messages_2\' OR name = \'send_text_messages_3\' OR name = \'send_text_messages_3\' OR name = \'rewards_points\') AND DATE_ADD(date, INTERVAL \'1 0:15\' DAY_MINUTE) < %s) '
            .' GROUP BY name';
    $late_cron_jobs = $wpdb->get_results($wpdb->prepare($sql, $now->format('Y-m-d H:i:s'), $now->format('Y-m-d H:i:s')), OBJECT);*/

    $sql = 'SELECT name, max(date) as last_date '
        .'FROM 0gf1ba_cron_jobs_log '
        .'WHERE 1 '
        .'GROUP BY name';

    $late_cron_jobs = $wpdb->get_results($wpdb->prepare($sql, null), OBJECT);
    $late_cron_jobs_errors = array();

    foreach($late_cron_jobs as $val){
        switch($val->name){
            case 'cron_getnumbers':
            case 'auto_private':
                $date_15min = new DateTime($val->last_date, new DateTimeZone('UTC'));
                $date_15min->add(new DateInterval('PT25M'));
                if($date_15min < $now){
                    $wpdb->query($wpdb->prepare("INSERT INTO 0gf1ba_cron_jobs_errors (name, date, last_run) VALUES (%s, %s, %s)", $val->name, $now->format('Y-m-d H:i:s'), $val->last_date));
                    $late_cron_jobs_errors[] = $val->name. ' last run = '.$val->last_date;
                }
                break;

            case 'send_text_messages_1':
            case 'send_text_messages_2':
            case 'send_text_messages_3':
            case 'send_text_messages_4':
            case 'rewards_points':
                $date_1day = new DateTime($val->last_date, new DateTimeZone('UTC'));
                $date_1day->add(new DateInterval('P1DT15M'));
                if($date_1day < $now){
                    $wpdb->query($wpdb->prepare("INSERT INTO 0gf1ba_cron_jobs_errors (name, date, last_run) VALUES (%s, %s, %s)", $val->name, $now->format('Y-m-d H:i:s'), $val->last_date));
                    $late_cron_jobs_errors[] = $val->name. ' last run = '.$val->last_date;
                }
                break;
        }
    }

    if (!empty($late_cron_jobs_errors)){
        $emails = ['info@studykik.com'];
        $subject = 'Legacy Site Cron Job got deleted (shell)';
        $message = 'Late cron jobs ( '.implode(', ',$late_cron_jobs_errors).' )';
        wp_mail( $emails, $subject, $message, 'Content-Type: text/html' );
    }
}

function get_exposure_level_string($post_id) {
    $exposure_level = get_post_meta($post_id, 'exposure_level', true);
    $args 	= array(
        'orderby' => 'product_position',
        'order' => 'ASC',
        'post_status' => 'publish',
        'post_type' => 'studykik-products',
        'post_title' => $exposure_level . " Listing",
        'posts_per_page'   => -1
    );
    $products 	= get_posts( $args );
    for($i = 0; $i < count($products); $i ++) {
        if ($products[$i]->post_title == $exposure_level . " Listing") {
            $product_price = (float)get_field('product_price', $products[$i]->ID);
            return $exposure_level . " $" . $product_price;
        }
    }
    return "";
}
?>
