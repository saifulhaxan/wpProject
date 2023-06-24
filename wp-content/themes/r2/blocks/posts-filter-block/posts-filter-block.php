<?php

/**
 * Posts Filter Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.



?>
<section class="second-one">
      <div class="container is-fluid bg-silver">
        <div class="container is-fullhd">
          <div class="columns is-mobile">
            <div class="column is-full">
              <div class="tabs of-categories">
                <ul class="r2-cat-list">
                  <li class="is-active"><a data-cat-id="-1" href="javascript:void(0)" class="filter-post">All</a></li>
                  <?php 
                    $args = array(
                      'exclude' => 'featured',
                    );
                    $categories = get_categories( $args );
                    if(!empty($categories)){
                      foreach($categories as $cat){
                        echo '<li><a href="javascript:void(0)" class="filter-post" data-cat-id="'.$cat->term_id.'" >'.$cat->name.'</a></li>';
                      }
                    }else{
                        echo '<li><p>No Categories found. Please start adding categories to show here.</p></li>';
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <article id="r2-filtered-posts-sec" class="container is-fullhd v-pad is-top-featured-post">
        <?php 
          $toppostID = 0;
          $query = new WP_Query( array(
            'posts_per_page' => 1,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
          ) );

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $toppostID = get_the_ID();
                $post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );
                $content = get_the_content();
                $content = substr(strip_tags( $content,'<a><strong><em><ul><ol><li>'), 0, 250);
                $author_id = get_the_author_meta( 'ID' );
                $avatar = get_avatar( $author_id, 64 );
                $categories = get_the_category();
                $category_markup = '';
                if(!empty($categories)){
                  foreach($categories as $category){
                    $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag is-rounded is-transparent is-border-red text-sm">'.$category->name.'</a>';
                  }
                }
                
              echo '<div class="columns is-mobile">
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
            echo 'Post not found to display.';
        }
        ?>
          <h6 class="recent-articles">Articles from the last two weeks</h6>
          <div class="multiple-posts-slides" id="r2-recent-posts-sec">
          <?php 
              $args = array(
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish',
                'post__not_in' => array($toppostID),
                'date_query' => array(
                    array(
                        'after' => '2 weeks ago'
                    )
                )
              );
             $query = new WP_Query( $args );
             if ( $query->have_posts() ) {
                 while ( $query->have_posts() ) {
                    $query->the_post();
                    $post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );
                    $content = get_the_content();
                    $content = substr(strip_tags( $content,'<a><strong><em><ul><ol><li>'), 0, 250);
                    $author_id = get_the_author_meta( 'ID' );
                    $avatar = get_avatar( $author_id, 64 );
                     // display post content here
                     echo '
                     <div class="recent-post-slides">
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
              echo 'No posts found to display.';
             }
             ?>
            </div>
      </article>

    </section>