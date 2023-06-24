<?php

/**
 * Post Video Block Template.
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
<section class="fourth-one">
      <div class="container is-fullhd">
      <?php 
            if($block_heading){
              echo '<h3 class="customized-title">'.$block_heading .'</h3>';
            }else{
              echo '<h3 class="customized-title">Take a video bite</h3>';
            }
      ?>
        <div class="video-slides">
          <?php 
            $args = array(
              'post_type' => 'post',
              'orderby' => 'date',
              'order' => 'DESC',
              'post_status' => 'publish',
              'category_name' => 'videos', // replace with your category IDs
            );
             $vp_query = new WP_Query( $args );
             if ( $vp_query->have_posts() ) {
              while ( $vp_query->have_posts() ) {
                $vp_query->the_post();
                $video_url = get_field('video_link', get_the_ID());
                $video_place_holder = "";
                if($video_url && filter_var($video_url, FILTER_VALIDATE_URL)){
                  if (strpos($video_url, 'youtube') > 0) {
                    $video_id = '';
                    $url_parts = parse_url($video_url);
                    parse_str($url_parts['query'], $query_params);

                    // Get the video ID from the query parameters
                    if (isset($query_params['v'])) {
                      $video_id = $query_params['v'];
                    }

                    $video_url  = 'https://www.youtube.com/embed/'.$video_id.'?autoplay=0&enablejsapi=1';
                    $video_place_holder ='<iframe width="670px" height="400px"src="'.$video_url.'"></iframe>';


                  } elseif (strpos($video_url, 'vimeo') > 0) {
                    $vimeo_id = '';

                    // Extract the path from the Vimeo URL
                    $url_parts = parse_url($video_url);
                    $path = trim($url_parts['path'], '/');
                    
                    // Extract the video ID from the path using regular expressions
                    if (preg_match('/^[0-9]+$/', $path)) {
                        $vimeo_id = $path;
                    }
                    $video_url = 'https://player.vimeo.com/video/'.$vimeo_id.'?byline=0&api=1';
                    $video_place_holder = '<iframe src="'.$video_url.'" width="670px" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
                  } else {
                      //return 'unknown';
                  }
                }else{
                  $post_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' ); 
                  $video_place_holder = '<img src="'.$post_featured_img[0].'" alt="'.get_the_title().'">';
                }
                
                $author_id = get_the_author_meta( 'ID' );
                $avatar = get_avatar( $author_id, 64 );
                $categories = get_the_category();
                $category_markup = '';
                if(!empty($categories)){
                  foreach($categories as $category){
                    $category_markup .= '<a href="' . get_category_link( $category->term_id ) . '" class="custom tag red is-rounded is-transparent is-border-red text-sm">'.$category->name.'</a>';
                  }
                }
        
          echo'<div class="video-slide">
                <div class="is-flex is-flex-direction-row is-mobile direction-column is-justify-content-space-evenly is-align-items-center">
                  <div class="column-1-2">
                  '.$video_place_holder.'
                  </div>
                  <div class="column-2-2">
                    '.$category_markup.'
                    <h3 class="is-wght-700">'.get_the_title().'</h3>
                    <div class="is-flex is-flex-direction-row">
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
                      </div>
                  </div>
                </div>
              </div>';
            }
            wp_reset_postdata();
          } else {
          echo '<p style="color: white;font-weight: bold;">No posts found to display.</p>';
          }
          ?>
        </div>
      </div>
</section>