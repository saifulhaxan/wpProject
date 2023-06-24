<?php

/**
 * Trending Articles Block Template.
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
 <section class="third-one">
      <div class="container is-fullhd">
        <div class="columns is-mobile">
          <div class="column">
          <?php 
            if($block_heading){
              echo '<h3 class="customized-title">'.$block_heading .'</h3>';
            }else{
              echo '<h3 class="customized-title">Trending Articles</h3>';
            }
          ?>
            <div class="tile is-ancestor">
              <?php 
                $args = array(
                  'category_name' => 'trending', // replace with your category slug
                  'post_type' => 'post',
                  'posts_per_page' => 4,
                  'orderby' => 'date',
                  'order' => 'DESC',
                );
                $posts = get_posts( $args );
                if($posts){
                  $chunk_sizes = array(1, 2, 1);
                  $chunks = array();
                  foreach ( $chunk_sizes as $size ) {
                    $chunk = array_slice($posts, 0, $size);
                    array_push($chunks, $chunk);
                    array_splice($posts, 0, $size);
                  }
                  $i = 1;
                  $j = 1;
                  foreach($chunks as $chunk){
                    if($j == 1){
                      echo '<div class=" outer-'.$i.' tile is-parent is-6">';
                    }else{
                      echo '<div class=" outer-'.$i.' tile is-vertical is-3">
                              <div class="tile">
                                <div class="tile is-parent is-vertical ">';
                    }
                    foreach($chunk as $post){
                     $chucnk_count = count($chunk);
                      setup_postdata( $post );
                      $content = $post->post_content;
                      $content = substr(strip_tags( $content,'<a><strong><em><ul><ol><li>'), 0, 250);
                      $author_id = $post->post_author;
                      $avatar = get_avatar( $author_id, 64 );
                      $categories = get_the_category($post->ID);
                      $category_markup = '';
                       if(!empty($categories)){
                          foreach($categories as $category){
                            $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag is-rounded is-transparent is-border-red text-sm">'.$category->name.'</a>';
                          }
                      }
                      if($i == 1){
                        echo'<article class="tile red-invert-white is-flex-direction-column">
                              <div class="is-flex is-flex-direction-row is-justify-content-space-between">
                                <div class="category-tags">
                                  '.$category_markup.'
                                </div>
                              </div>
                              <div class="content">
                                <h4>'.$post->post_title.'</h4>
                                <p>'.$content.'</p>
                              </div>
                              <div class="b-author is-flex-direction-row is-align-content-center margin-right-80">
                                <div class="author-img">
                                  '.$avatar.'
                                </div>
                                <div class="author-detail">
                                  <p class="text-md">Author</p>
                                  <p class="text-xl is-wght-700">'.get_the_author_meta( 'user_nicename' , $author_id ).'</p>
                                </div>
                              </div>
                            </article>';
                            $i++;
                      }else{  
                          echo'<article class="tile black-invert-white is-flex-direction-column">
                                <div class="is-flex is-flex-direction-row is-justify-content-space-between">
                                  <div class="category-tags">
                                    '.$category_markup.'
                                  </div>
                                </div>
                                <div class="content">
                                  <h4 class="text-xl">'.$post->post_title.'</h4>
                                </div>
                                <div class="b-author is-flex-direction-row is-align-content-center">
                                  <div class="author-img">
                                  '.$avatar.'
                                  </div>
                                  <div class="author-detail">
                                    <p class="text-md">Author</p>
                                    <p class="text-xl is-wght-700">'.get_the_author_meta( 'user_nicename' , $author_id ).'</p>
                                  </div>
                                </div>
                              </article>';
                              if($chucnk_count < 2){
                                $cat_object = get_category_by_slug('trending');
                                echo '<article class="tile red-invert-white is-flex-direction-column is-justify-content-center">
                                    <div class="category-tags customized">
                                      <a href="'.get_category_link($cat_object).'" class="custom tag is-rounded is-transparent is-border-red text-sm">...</a>
                                      <a href="'.get_category_link($cat_object).'" class="text-lg link">More Trending Articles</a>
                                    </div>
                                </article>';
                              }

                      }
                            
                    }
                    if($j == 1){
                      echo '</div>'; //is-6
                      $j++;
                    }else{
                      echo '</div>';
                      echo '</div>';
                      echo '</div>'; //is-3
                    }   
                  }
                }else {
                  // no posts found
                }

              ?>
            </div>
          </div>
        </div>
      </div>
    </section>