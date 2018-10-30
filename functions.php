<?php

	add_action('wp_footer', 'show_template');
	function show_template() {
		global $template;
		print_r($template);
	}

	function jquery_cdn(){
	  if(!is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
		wp_enqueue_script('jquery');
	  }
	}
	add_action('wp_enqueue_scripts', 'jquery_cdn');
	function northoak_scripts(){
		global $wp_query;

		wp_register_script(
			'bootstrap-script', 
			'//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', 
			array('jquery'), 
			'', 
			true
		);
		wp_register_script(
			'northoak-script', 
			'/wp-content/themes/northoak/js/northoak-script.js', 
			array('jquery'), 
			'', 
			true
		);
		wp_register_script(
			'slick-script', 
			'//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 
			array('jquery'), 
			'', 
			true
		);

		wp_enqueue_script( 'bootstrap-script' );
		wp_enqueue_script( 'northoak-script' );
		wp_enqueue_script( 'slick-script' );
	}
	add_action('wp_enqueue_scripts', 'northoak_scripts', 100);
	
	function northoak_styles(){
	  wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
	  wp_register_style('northoak', get_template_directory_uri() . '/style.css');
	  wp_register_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	  
	  wp_enqueue_style('bootstrap-css');
	  wp_enqueue_style('northoak');
	  wp_enqueue_style('slick');
	}
	add_action('wp_enqueue_scripts', 'northoak_styles');

	if(function_exists('acf_add_options_page')){
	  acf_add_options_page(array(
	    'page_title' => 'General Site Settings',
	    'menu_title' => 'General Settings',
	    'menu_slug' => 'general-settings',
	    'capability' => 'edit_posts',
	    'redirect' => false
	  ));
	}

	// load fonts
	function load_fonts() {
		wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700', false );
		wp_enqueue_style( 'open-sans-condensed', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700', false );
		wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.3.1/css/all.css' );
	}
	add_action( 'wp_enqueue_scripts', 'load_fonts' );

	// Register Navigation Menus
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'footer_menu' => 'Footer Menu',
		'copyright_menu' => 'Copyright Menu',
	) );

	// allow us to override woocommerce templates
	add_theme_support( 'woocommerce' );

	include "functions/custom-nav-walker.php";
	include "functions/button-shortcode.php";
	include "functions/script-shortcode.php";
	include "functions/subtext-shortcode.php";
	include "functions/bigtext-shortcode.php";
?>