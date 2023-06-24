<?php
/**
 * R2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package R2
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function r2_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on R2, use a find and replace
		* to change 'r2' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'r2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'r2_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			
		)
	);
}
add_action( 'after_setup_theme', 'r2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function r2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'r2_content_width', 640 );
}
add_action( 'after_setup_theme', 'r2_content_width', 0 );


function register_r2_main_menu() {
	register_nav_menus( array(
	  'primary' => __( 'Primary Menu', 'r2' ),
	) );
  }
  add_action( 'after_setup_theme', 'register_r2_main_menu' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function r2_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'r2' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'r2' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'r2_widgets_init' );

//Register R2 Blocks
function r2_register_acf_block_types() {

    /*
    ** HomePage First Block
    */
    register_block_type( __DIR__ . '/blocks/search-block/block.json' );

    /*
    ** Posts Filters Block
    */
    register_block_type( __DIR__ . '/blocks/posts-filter-block/block.json' );

    /*
    ** Posts Filters Block
    */
    register_block_type( __DIR__ . '/blocks/trending-articles-block/block.json' );
   
    /*
    ** Posts Video Block
    */
    register_block_type( __DIR__ . '/blocks/post-video-block/block.json' );

    /*
    ** Featured Article Block
    */
    register_block_type( __DIR__ . '/blocks/featured-article-block/block.json' );
    
    /*
    ** Featured Article Block
    */
    register_block_type( __DIR__ . '/blocks/faqs-block/block.json' );
}   

if ( function_exists( 'acf_register_block_type' ) ) {
    add_action( 'acf/init', 'r2_register_acf_block_types' );
}
/**
 * Enqueue scripts and styles.
 */
function r2_scripts() {
	wp_enqueue_style( 'r2-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'r2-style', 'rtl', 'replace' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_style( 'r2-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', true, _S_VERSION ,'all');
	wp_enqueue_style( 'r2-bulma-styles', get_template_directory_uri() . '/assets/css/bulma.min.css', array(), _S_VERSION);
	wp_enqueue_style( 'r2-bulma-accordion-styles', get_template_directory_uri() . '/assets/css/bulma.accordion.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'r2-slick-styles', get_template_directory_uri() . '/assets/css/slick.css', array(), _S_VERSION );
	wp_enqueue_style( 'r2-slick-theme-styles', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), _S_VERSION );
	wp_enqueue_style( 'r2-main-styles', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );

	wp_enqueue_style( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'r2-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );	
	wp_enqueue_script( 'r2-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'r2-bulma-accordion', '//cdn.jsdelivr.net/npm/bulma-accordion@2.0.1/dist/js/bulma-accordion.min.js', array(), _S_VERSION, true );
	wp_register_script( 'r2-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
	wp_localize_script( 'r2-main-script', 'r2_ajax', 
					array( 
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'nonce'=> wp_create_nonce('r2_nonce')
					)
				);
	wp_enqueue_script('r2-main-script');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'r2_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Register ACF Json sync
 */
require get_template_directory() . '/inc/acf-json.php';

/**
 * Register ACF Options Page
 */
//require get_template_directory() . '/inc/acf-options.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function r2_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'r2_mime_types');


/***************
 * Function to get all Registered Menu
 * Return an array
*/
function get_r2_registered_menus(){
	// Get all registered menus
	$registered_menus = get_registered_nav_menus();
	$r2_menus = array();

	$menus = get_terms('nav_menu');
	if(!empty($menus)){
		foreach($menus as $menu){
			// Push a new key-value pair into the array
			$r2_menus[$menu->slug] = $menu->name;
		}
	}

	$all_menus = $registered_menus + $r2_menus;
	return $all_menus;
}
//add_action('init', 'get_r2_registered_menus');

//Ajax to filter Posts
add_action('wp_ajax_nopriv_r2_filter_posts', 'r2_filter_posts');
add_action('wp_ajax_r2_filter_posts', 'r2_filter_posts');
function r2_filter_posts(){
	if ( !wp_verify_nonce( $_POST['nonce'], 'r2_nonce')) {
		exit( esc_html__('Missing Security Token! Please refresh this page.','r2'));
	} 
	
	if ((isset($_POST['filter_cat_id'])) && ($_POST['filter_cat_id'] > 0)) {
		
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'post',
			'category__in' => array($_POST['filter_cat_id']), // replace with your category IDs
			'orderby' => 'date',
            'order' => 'DESC',
			'post_status' => 'publish'
		);
		$filter_query = new WP_Query( $args );
	}else{ //if user has selected to display All Posts
		$filter_query = new WP_Query( array(
            'posts_per_page' => 1,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        ) );
	}
		$html_markup = '';
		if ( $filter_query->have_posts() ) {
            while ( $filter_query->have_posts() ) {
                $filter_query->the_post();
                
                $post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );
                $content = get_the_content();
                $content = substr(strip_tags( $content,'<a><strong><em><ul><ol><li>'), 0, 250);
                $author_id = get_the_author_meta( 'ID' );
                $avatar = get_avatar( $author_id, 64 );
                $categories = get_the_category();
                $category_markup = '';
                
                foreach($categories as $category){
                    $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag is-rounded is-transparent is-border-red text-sm">'.$category->name.'</a>';
                }
				$html_markup .='<div class="columns is-mobile">
                <div class="column full is-flex is-flex-direction-row">
                  <div class="b-author is-flex-direction-row is-align-content-center margin-right-80 m40">
                    <div class="author-img">
                     '.$avatar.'
                    </div>
                    <div class="author-detail">
                      <p class="text-md">
                        Author
                      </p>
                      <p class="text-xl is-wght-700">
                        '.get_the_author().'
                      </p>
                    </div>
      
                  </div>
                  <div class="b-published-date margin-right-80 m40">
                    <p class="text-md">
                      Published
                    </p>
                    <p class="text-xl is-wght-700">
                    '.get_the_date().'
                    </p>
                  </div>
                  
                </div>
              </div>
              <div class="columns is-mobile">
                <div class="column full is-flex is-flex-direction-row">
                  '.$category_markup.'
                </div>
              </div>
              <div class="columns is-mobile">
                <div class="column full">
                  <div class="is-flex is-flex-direction-row is-mobile direction-column-reverse">
                    <div class="is-flex is-flex-direction-column">
                      <h3>'.get_the_title().'</h3>
                      <p class="text-xl v-margin-30 color-grey">'.$content.'</p>
                      <a href="'.get_the_permalink().'" class="button button-article">Read the article <img src="img/right-arrow.svg" alt=""></a>
                    </div>
                      <img src="'.$post_featured_img[0].'" alt="first-featured-img">
                  </div>
                </div>
              </div>';
                
            }
            wp_reset_postdata();
        } else {
            // No posts found
            $html_markup .= '<p style="color: white;font-weight: bold;">Post not found to display.</p>';
        }
		$html_markup .= '<h6 class="recent-articles">Articles from the last two weeks</h6>
          <div class="multiple-posts-slides" id="r2-recent-posts-sec">';
		$args = array(
			'post_type' => 'post',
			'orderby' => 'date',
			'order' => 'DESC',
			'post_status' => 'publish',
			'category__in' => array($_POST['filter_cat_id']), // replace with your category IDs
			'date_query' => array(
				array(
					'after' => '2 weeks ago'
				)
			)
		  );
		 $recent_posts_query = new WP_Query( $args );
		 if ( $recent_posts_query->have_posts() ) {
			 while ( $recent_posts_query->have_posts() ) {
				$recent_posts_query->the_post();
				$post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );
				$content = get_the_content();
				$content = substr(strip_tags( $content,'<a><strong><em><ul><ol><li>'), 0, 250);
				$author_id = get_the_author_meta( 'ID' );
				$avatar = get_avatar( $author_id, 64 );
				 // display post content here
				 $html_markup .= '<div class="recent-post-slides">
				   <div class="is-flex is-flex-direction-row">
					 <div class="b-author is-flex-direction-row is-align-content-center margin-right-80">
					   <div class="author-img">
						 '.$avatar.'
					   </div>
					   <div class="author-detail is-flex is-flex-direction-column-reverse">
						 <p class="text-md">
						   '.get_the_author().'
						 </p>
						 <h6 class="is-wght-600">
						 '.get_the_title().'
						 </h6>
					   </div>
		 
					 </div>
				   </div>
				 </div>
			 ';
			 }
			 wp_reset_postdata();
		 } else {
			$html_markup .= '<p style="color: white;font-weight: bold;">No posts found to display.</p>';
		 }
		 $html_markup .= '</div>';
		$data = array ('success' => true, 'html_markup' => $html_markup);
		echo json_encode($data);	
	die();
}

function r2_auto_complete_search() {
	if ( !wp_verify_nonce( $_POST['nonce'], 'r2_nonce')) {
		exit( esc_html__('Missing Security Token! Please refresh this page.','r2'));
	} 

	
	if ((isset($_POST['query'])) && (!empty($_POST['query']))) {
		$query = $_POST['query'];
		$html_markup = "";
		$args = array(
			'post_type' => 'post',
			's' => $query,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_status' => 'publish',
		);
		// Perform the search query and return the results as an array
		$search_query = new WP_Query( $args );
		if ( $search_query->have_posts() ) {
			$html_markup .='<ul class="autocomplete-search-reults">';
			while ( $search_query->have_posts() ) {
				$search_query->the_post();
				
				$html_markup .= '<li><svg style="width: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></i> <a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

			}
			$html_markup .='</ul>';
		}else{
			$html_markup .= '<p style="color: white;font-weight: bold;">No posts found to display.</p>';
		}
	}else{
		$html_markup .= '<p style="color: white;font-weight: bold;">Empty Keywords.</p>';
	}
    $data = array ('success' => true, 'html_markup' => $html_markup);
	echo json_encode($data);
	die();	
}
add_action( 'wp_ajax_r2_auto_complete_search', 'r2_auto_complete_search' );
add_action( 'wp_ajax_nopriv_r2_auto_complete_search', 'r2_auto_complete_search' );
