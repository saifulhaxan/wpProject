<?php
/**
 * R2 Theme Customizer
 *
 * @package R2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function r2_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'r2_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'r2_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'r2_customize_register' );

function r2_register_footer_settings( $wp_customize ) {
    // Add Footer Section
    $wp_customize->add_section( 'footer_section', array(
        'title'    => __( 'Footer Settings', 'r2' ),
        'priority' => 30,
    ) );

    // Add Footer Logo Setting
    $wp_customize->add_setting( 'footer_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    // Add Footer Logo Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_image_control', array(
		'label'    => __( 'Footer Logo', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'footer_image',
	  ) ) );


 // Add Footer Text Setting
	$wp_customize->add_setting( 'r2_footer_html', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	

	/**********************
	 **********************
	 *Second Columns Setting 
	***********************/
	$wp_customize->add_setting( 'sec_col_headin', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sec_col_headin_control', array(
		'label'    => __( 'Footer Second Column Heading', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'sec_col_headin',
		'type'     => 'text',
	) ) );
	
	//Add Setting for menu select
	$wp_customize->add_setting( 'select_second_column_menu', array(
		'default'           => 'primary',
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	//Add Control for menu select
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'select_second_column_menu_control', array(
		'label'    => __( 'Menu for second column', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'select_second_column_menu',
		'type'     => 'select',
		'choices'  => get_r2_registered_menus(),
	) ) );
	/**********************
	 **********************
	 *Third Columns Setting 
	***********************/
	$wp_customize->add_setting( 'third_col_headin', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'third_col_headin_control', array(
		'label'    => __( 'Footer Third Column Heading', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'third_col_headin',
		'type'     => 'text',
	) ) );

	//Add Setting for menu select
	$wp_customize->add_setting( 'select_third_column_menu', array(
		'default'           => 'primary',
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	//Add Control for menu select
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'select_third_column_menu_control', array(
		'label'    => __( 'Menu for third column', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'select_third_column_menu',
		'type'     => 'select',
		'choices'  => get_r2_registered_menus(),
	) ) );
	  
	/**********************
	 **********************
	 *Last Columns Setting 
	***********************/
	$wp_customize->add_setting( 'fourth_col_headin', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fourth_col_headin_control', array(
		'label'    => __( 'Footer Last Column Heading', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'fourth_col_headin',
		'type'     => 'text',
	) ) );
	  
 // Add Footer Text Control
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'r2_footer_html_control', array(
		'label'    => __( 'Custom HTML', 'r2' ),
		'section'  => 'footer_section',
		'settings' => 'r2_footer_html',
		'type'     => 'textarea',
	  ) ) );
	  

	// Add Footer Copyright Text Setting
    $wp_customize->add_setting( 'footer_copyright_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add Footer Copyright Text Control
    $wp_customize->add_control( 'footer_copyright_text', array(
        'label'    => __( 'Copyright Text', 'r2' ),
        'section'  => 'footer_section',
        'type'     => 'text',
    ) );




}

add_action( 'customize_register', 'r2_register_footer_settings' );
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function r2_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function r2_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function r2_customize_preview_js() {
	wp_enqueue_script( 'r2-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'r2_customize_preview_js' );
