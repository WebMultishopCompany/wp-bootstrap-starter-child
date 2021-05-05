<?php

/**
 * Automatically set the image Title, Alt-Text, Caption & Description upon upload
 *
 * @param $post_ID
 */
function wp_bootstrap_starter_child_set_image_meta_upon_image_upload($post_ID) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			//'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			//'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	}
}
add_action( 'add_attachment', 'wp_bootstrap_starter_child_set_image_meta_upon_image_upload' );


/**
 * Enqueue global styles
 */
function wp_bootstrap_starter_child_stylesheets() {
	wp_enqueue_style('theme.css', get_stylesheet_directory_uri() . '/assets/css/theme.css', [], '1.0.0', 'all');
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/assets/main.js', array('jquery'), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_child_stylesheets', 100);


/**
 * Register navigation menus
 */
function wp_bootstrap_starter_child_register_menus() {
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'lp' ),
	) );
	register_nav_menus( array(
		'footer' => esc_html__( 'Footer', 'lp' ),
	) );
}
add_action( 'after_setup_theme', 'wp_bootstrap_starter_child_register_menus' );


/**
 * Remove unused parent theme's sidebars
 */
function wp_bootstrap_starter_child_remove_unused_sidebars(){
	unregister_sidebar('sidebar-1');
	unregister_sidebar('footer-1');
	unregister_sidebar('footer-2');
	unregister_sidebar('footer-3');
}
add_action( 'widgets_init', 'wp_bootstrap_starter_child_remove_unused_sidebars', 11 );


/**
 * Add new sidebars
 */
function wp_bootstrap_starter_child_add_sidebars() {
	register_sidebar( array(
		'name'          => esc_html__( 'Header right', 'lp' ),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Add widgets here.', 'lp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar on the left', 'lp' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'lp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar on the right', 'lp' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'lp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar(
		array(
			'name' => 'custom',
			'id'   => 'custom-bar',
		)
	);
}
add_action( 'widgets_init', 'wp_bootstrap_starter_child_add_sidebars' );
