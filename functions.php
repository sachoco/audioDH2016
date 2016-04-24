<?php
	function register_my_menu() {
	  register_nav_menu('main-menu',__( 'Main Menu' ));
	}
	add_action( 'init', 'register_my_menu' );
		function theme_scripts_and_styles() {
		// wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '', 'true' );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'responsive-slides', get_stylesheet_directory_uri() . '/bower_components/jquery.responsive-slides/jquery.responsive-slides.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'responsive-slides' );
		wp_register_script( 'velocity', get_stylesheet_directory_uri() . '/js/velocity.min.js', array(), '', true );
		wp_enqueue_script( 'velocity' );
		wp_register_script( 'isotope', get_stylesheet_directory_uri() . '/bower_components/isotope/dist/isotope.pkgd.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'isotope' );
		wp_register_script( 'imagesloaded', get_stylesheet_directory_uri() . '/bower_components/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'imagesloaded' );
		wp_register_script( 'datatables', get_stylesheet_directory_uri() . '/bower_components/datatables.net/js/jquery.dataTables.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'datatables' );
		wp_register_script( 'datatables-bs', get_stylesheet_directory_uri() . '/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', array('jquery','datatables'), '', true );
		wp_enqueue_script( 'datatables-bs' );

		// register main script
		wp_register_script( 'main-script', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '', true );
		wp_enqueue_script( 'main-script' );

		wp_register_script( 'front-page-script', get_stylesheet_directory_uri() . '/js/front-page.js', array('jquery'), '', true );
		// register main stylesheet
		wp_register_style( 'main-css', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );
		wp_enqueue_style( 'main-css' );

		wp_register_style( 'grid-css', get_stylesheet_directory_uri() . '/css/grid.css', array('main-css'), '', 'all' );
		wp_enqueue_style( 'grid-css' );

		wp_register_style( 'responsive-slides-css', get_stylesheet_directory_uri() . '/bower_components/jquery.responsive-slides/jquery.responsive-slides.css', array('main-css'), '', 'all' );
		wp_enqueue_style( 'responsive-slides-css' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css', array('main-css'), '', 'all' );
		wp_enqueue_style( 'bootstrap' );

		wp_register_style( 'datatables-css', get_stylesheet_directory_uri() . '/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', array('main-css'), '', 'all' );
		wp_enqueue_style( 'datatables-css' );

		// comment reply script for threaded comments
		if ( is_front_page()) {
			wp_enqueue_script( 'front-page-script' );
		}		

	}

	add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles', 999 );

	/**
