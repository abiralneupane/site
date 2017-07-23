<?php
add_action( 'after_setup_theme', 'agileholic_setup' );
function agileholic_setup() {
	load_theme_textdomain( 'agileholic' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	$GLOBALS['content_width'] = 525;

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
}

require_once __DIR__ .'/inc/classes/agileholic-postTypes.php';
require_once __DIR__ .'/inc/classes/agileholic-meta.php';
require_once __DIR__ .'/inc/classes/agileholic-taxonomy.php';

require_once __DIR__ .'/inc/agileholic-site.php';

require_once __DIR__ .'/inc/config.php';


add_action( 'admin_enqueue_scripts', 'ah_load_admin_scripts' );
function ah_load_admin_scripts() {
	wp_enqueue_script('admin', get_stylesheet_directory_uri().'/admin.js', array('jquery'), null, true);
}

add_action( 'wp_before_admin_bar_render', 'ah_admin_toolbar', 999 );
function ah_admin_toolbar() {
	global $wp_admin_bar;

	$args = array(
		'id'     => 'write_to_json',
		'title'  => __( 'Write To JSON', 'basepress' ),
		'href'   => '#',
	);

	$wp_admin_bar->add_menu( $args );
}