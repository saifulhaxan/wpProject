<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package R2
 */

?>

<footer>
      <div class="container is-fullhd">
        <div class="columns is-multiline is-mobile pb-6 border-bottom">
          <div class="column column is-full-mobile is-one-quarter-desktop is-one-quarter-widescreen is-one-quarter-fullhd">
            <?php if ( get_theme_mod( 'footer_image' ) ) { ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_theme_mod( 'footer_image' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
              </a> 
            <?php } ?> 
          </div>
          <div class="column is-full-mobile is-three-quarters-desktop is-three-quarters-widescreen is-three-quarters-fullhd">
            <div class="columns is-multiline is-flex is-justify-content-space-around">
              <ul class="is-half-mobile">
                <p class="text-lg"><?php echo esc_html( get_theme_mod( 'sec_col_headin' ) ); ?></p>
                <?php 
                    $menu_col_2 = esc_html( get_theme_mod( 'select_second_column_menu' ) );
                    if(empty($menu_col_2)){
                      $menu_col_2 = 'Primary Menu';
                    } 
                    $menu_items = wp_get_nav_menu_items($menu_col_2);
                    if(!empty($menu_items)){
                        foreach($menu_items as $menu_item){
                          echo '<li><a href="'.$menu_item->url.'">'.$menu_item->post_title.'</a></li>';
                        }
                    }

                ?>
              </ul>
              <ul class="is-half-mobile">
                <p class="text-lg"><?php echo esc_html( get_theme_mod( 'third_col_headin' ) ); ?></p>
                <?php 
                    $menu_col_3 = esc_html( get_theme_mod( 'select_third_column_menu' ) );
                    if(empty($menu_col_3)){
                      $menu_col_3 = 'Primary Menu';
                    } 
                    $menu_items = wp_get_nav_menu_items($menu_col_3);
                    if(!empty($menu_items)){
                        foreach($menu_items as $menu_item){
                          echo '<li><a href="'.$menu_item->url.'">'.$menu_item->post_title.'</a></li>';
                        }
                    }

                ?>
              </ul>
              <ul class="is-full-mobile">
                <p class="text-lg is-uppercase"><?php echo esc_html( get_theme_mod( 'fourth_col_headin' ) ); ?></p>
                <li class="office-location text-sm"><?php echo esc_html( get_theme_mod( 'r2_footer_html' ) ); ?></li>
                  <li>
                    <ul class="child">
                      <p class="text-lg">News letter</p>
                      <li>
                        <div class="control has-icons-right">
                          <input class="input is-medium" type="email" placeholder="Enter your email address">
                          <span class="icon is-right">
                            <img src="img/envelope.svg" alt="" srcset="">
                          </span>
                        </div>
                      </li>
                    </ul>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="columns is-mobile is-multiline is-flex is-justify-content-center">
          <div class="column is-12 social">
            <a href="#"><img src="img/i-twitter.svg" alt=""></a>
            <a href="#"><img src="img/i-linkedin.svg" alt=""></a>
            <a href="#"><img src="img/i-fb.svg" alt=""></a>
          </div>
          <div class="column is-12 is-flex is-justify-content-center">
            <p class="copy-right">
                ©<?php echo date("Y"); ?> <?php echo esc_html( get_theme_mod( 'footer_copyright_text' ) ); ?>.
            </p>
          </div>
        </div>
      </div>
    </footer><!-- footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
