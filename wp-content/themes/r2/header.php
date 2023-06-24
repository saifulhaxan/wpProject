<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package R2
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<header class="main-header">
        <div class="container is-widescreen">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                  <?php 
                    $custom_logo_id = get_theme_mod( 'custom_logo' ); 
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                  ?>
                  <a class="navbar-item" href="<?php echo get_site_url(); ?>">
                    <?php 
                    if ( has_custom_logo() ) {
                      echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                    } else {
                      echo '<h1>' . get_bloginfo('name') . '</h1>';
                    }
                    ?>
                  </a>
              
                  <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                  </a>
                </div>
              
                <div id="navbarBasicExample" class="navbar-menu">
                  <div class="navbar-end">
                  <?php
                     $menu_items = wp_get_nav_menu_items('Main Menu');
                     foreach ( $menu_items as $menu_item ) {
                       if ( $menu_item->menu_item_parent == 0 ) {
                         // display parent menu item
                         echo '<div class="navbar-item has-dropdown is-hoverable"><a class="navbar-link text-lg" href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
                   
                         // get child menu items
                         $child_menu_items = wp_filter_object_list( $menu_items, array( 'menu_item_parent' => $menu_item->ID ) );
                   
                         // display child menu items
                         if ( ! empty( $child_menu_items ) ) {
                           echo '<div class="navbar-dropdown">';
                           foreach ( $child_menu_items as $child_menu_item ) {
                             echo '<a class="navbar-item" href="' . $child_menu_item->url . '">' . $child_menu_item->title . '</a>';
                           }
                           echo '</div>';
                         }
                   
                         echo '</div>';
                       }
                     }
                  ?>
                 
                    

                    <a class="navbar-item text-lg">
                     #Trending
                    </a>
                  </div>
              
                  <div class="navbar-end">
                    <div class="navbar-item">
                      <div class="buttons">
                        <a class="button is-light">
                          Log in
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>
        </div>

    </header>
	<!---<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			// the_custom_logo();
			// if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a></h1>
				<?php
			//else :
				?>
				<p class="site-title"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a></p>
				<?php
			// endif;
			// $r2_description = get_bloginfo( 'description', 'display' );
			// if ( $r2_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php //echo $r2_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php //endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php //esc_html_e( 'Primary Menu', 'r2' ); ?></button>
			<?php
			// wp_nav_menu(
			// 	array(
			// 		'theme_location' => 'menu-1',
			// 		'menu_id'        => 'primary-menu',
			// 	)
			// );
			?>
		</nav>
	</header> -->
