<?php
    // require_once("include/Mobile_Detect.php");
    // $detect = new Mobile_Detect;
    // $is_mobile = false;
    

	require_once ( get_stylesheet_directory() . '/theme-options.php' );
	function register_my_menu() {
	  register_nav_menu('main-menu',__( 'Main Menu' ));
	}
	add_action( 'init', 'register_my_menu' );
		function theme_scripts_and_styles() {
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'velocity', get_stylesheet_directory_uri() . '/js/velocity.min.js', array(), '', true );
		wp_enqueue_script( 'velocity' );
		wp_register_script( 'soundmanager', get_stylesheet_directory_uri() . '/soundmanagerv2/script/soundmanager2.js', array('jquery'), '', true );
		wp_enqueue_script( 'soundmanager' );
		// register main script
		wp_register_script( 'main-script', get_stylesheet_directory_uri() . '/js/min/main.js', array('jquery'), '', true );
		wp_enqueue_script( 'main-script' );
		wp_register_style( 'grid-css', get_stylesheet_directory_uri() . '/css/grid.css', array('main-css'), '', 'all' );
		wp_enqueue_style( 'grid-css' );
		wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css', array(), '', 'all' );
		wp_enqueue_style( 'bootstrap' );
		// register main stylesheet
		wp_register_style( 'main-css', get_stylesheet_directory_uri() . '/css/style.css', array('bootstrap'), '', 'all' );
		wp_enqueue_style( 'main-css' );
	}

	add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles', 999 );


	// let's create the function for the custom type
	function custom_post_tracks() {
		// creating (registering) the custom type
		register_post_type( 'tracks', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			// let's now add all the options for this post type
			array( 'labels' => array(
				'name' => __( 'Tracks', 'audioDH' ), /* This is the Title of the Group */
				'singular_name' => __( 'Track', 'audioDH' ), /* This is the individual type */
				'all_items' => __( 'All Tracks', 'audioDH' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'audioDH' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Track', 'audioDH' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'audioDH' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Track', 'audioDH' ), /* Edit Display Title */
				'new_item' => __( 'New Track', 'audioDH' ), /* New Display Title */
				'view_item' => __( 'View Track', 'audioDH' ), /* View Display Title */
				'search_items' => __( 'Search Track', 'audioDH' ), /* Search Custom Type Title */
				'not_found' =>  __( 'Nothing found in the Database.', 'audioDH' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'audioDH' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'Track', 'audioDH' ), /* Custom Type Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */
				'menu_icon' => 'dashicons-format-audio', /* the icon for the custom post type menu */
				'rewrite'	=> array( 'slug' => 'track', 'with_front' => false ), /* you can specify its url slug */
				'has_archive' => 'tracks', /* you can rename the slug here */
				'capability_type' => 'post',
				'hierarchical' => false,
				/* the next one is important, it tells what's enabled in the post editor */
				'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'thumbnail', 'revisions', 'sticky')
			) /* end of options */
		); /* end of register post type */

		/* this adds your post categories to your custom post type */
		// register_taxonomy_for_object_type( 'category', 'event' );
		/* this adds your post tags to your custom post type */
		// register_taxonomy_for_object_type( 'post_tag', 'event' );

	}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_tracks');



	/**
