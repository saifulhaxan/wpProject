<?php

/**
 * Featured Article Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.

$id = 'step-icon-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
//settings
$block_heading = get_field('block_heading');
?>
<section class="fifth-one">
      <div class="container is-fullhd">
        <?php 
        if($block_heading){
          echo '<h3 class="customized-title">'.$block_heading .'</h3>';
        }else{
          echo '<h3 class="customized-title">Featured Articles</h3>';
        }
          $args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'category_name' => 'featured', // replace with your category IDs
          );
          $fp_query = new WP_Query( $args );
          if ( $fp_query->have_posts() ) {
            $fp = 1;
            while ( $fp_query->have_posts() ) {
              $fp_query->the_post();

                $content = get_the_content();
                $content = substr(strip_tags( $content), 0, 250);
                $post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' ); 
                $author_id = get_the_author_meta( 'ID' );
                $avatar = get_avatar( $author_id, 64 );
                $categories = get_the_category();
                $category_markup = '';
                
                if($fp == 1){
                  if(!empty($categories)){
                    foreach($categories as $category){
                      $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag red is-rounded is-transparent is-border-red text-sm">'.$category->name.'</a>';
                    }
                  }
                  echo'<div class="columns is-multiline is-mobile">
                      <div class="column is-full-mobile is-half-desktop is-half-widescreen is-half-fullhd">
                        <img src="'.$post_featured_img[0].'" alt="" srcset="" class="full-width">
                      </div>
                      <div class="column is-full-mobile is-half-desktop is-half-widescreen is-half-fullhd">
                        <article class="tile transparent-invert-black is-flex-direction-column">
                          <div class="is-flex is-flex-direction-row is-justify-content-space-between">
                              <div class="category-tags">
                                '.$category_markup.'
                              </div>
                          </div>
                          <div class="content">
                          <h4>'.get_the_title().'</h4>
                          <p>'.$content.'</p>
                          </div>
                          <div class="b-author is-flex-direction-row is-align-content-center margin-right-80">
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
                        </article>
                      </div>
                  </div>
                  <div class="columns is-mobile is-multiline is-align-items-flex-start">';

                }else{
                  if(!empty($categories)){
                    foreach($categories as $category){
                      $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag is-rounded is-border-less is-transparent text-sm">'.$category->name.'</a>';
                    }
                  }
                  echo '<div class="column is-full-mobile is-one-third-desktop is-one-third-widescreen is-one-third-fullhd">
                        <article class="tile transparent-invert-black is-flex-direction-column">
                          <img class="m" src="'.$post_featured_img[0].'" alt="" srcset="">
                          <div class="is-flex is-flex-direction-row is-justify-content-space-between">
                              <div class="category-tags">
                              '.$category_markup.'
                              </div>
                            </div>
                          <div class="content">
                            <h6 class="customized">'.get_the_title().'</h6>
                            <p class="text-md">'.$content.'</p>
                          </div>
                          <div class="b-author is-flex-direction-row is-align-content-center margin-right-80">
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
                        </article>
                      </div>';

                }
                  
                $fp++;
          }
          echo '</div>';
          wp_reset_postdata();
        } else {
        echo '<p style="color: white;font-weight: bold;">No posts found to display.</p>';
        }
        ?>
      </div>
    </section>