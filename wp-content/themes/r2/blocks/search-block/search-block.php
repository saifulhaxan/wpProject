<?php

/**
 * Search Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.

$static_text = get_field('static_text');
$sliding_text = get_field('sliding_text');
?>
<section class="first-one">
    <div class="container is-fullhd">
     <div class="columns is-mobile">
        <div class="column is-full">
            <h1>
                <?php 
                  if(!empty($static_text)){
                        echo $static_text; 
                  }else{
                    echo 'How to';
                  }
                ?>
                <span id="text-slider" class="text-slide">
                    <?php if($sliding_text){
                        foreach($sliding_text as $index => $text){   
                          $indx = $index + 1;   
                          echo "<span class='slide".$indx."'>".$text['text_slide']."</span>";     
                        }
                    }else{

                          echo "<span class='slide1'> start a blog</span>
                                <span class='slide2'> begin your journey</span>
                                <span class='slide3'> earn passive income</span>
                                <span class='slide4'> build a product</span>";

                    }?>
                    
                </span>
            </h1>
        </div>
    </div>
    <div class="columns is-mobile">
        <div class="column is-full">
            <?php echo get_search_form(); ?>
          </div>
        </div>
        <div class="columns is-mobile poular-keywords">
          <div class="column">
            <p class="title-popular-search">
              Popular Searches
            </p>
          </div>
          <div class="column">
            <ul>
              <li>
                <img src="img/starting-blog.svg" alt="">
                <a href="#" class="text-xl">Starting a Blog</a>
              </li>
              <li>
                <img src="img/build-ecom.svg" alt="">
                <a href="#" class="text-xl">Building an Ecommerce</a>
              </li>
            </ul>
          </div>
          <div class="column">
            <ul>
              <li>
                <img src="img/analyze-website.svg" alt="">
                <a href="#" class="text-xl">Analyse your Website</a>
              </li>
              <li>
                <img src="img/web-error.svg" alt="">
                <a href="#" class="text-xl">Website Errors</a>
              </li>
            </ul>
          </div>
          <div class="column">
            <ul>
              <li>
                <img src="img/web-performance.svg" alt="">
                <a href="#" class="text-xl">Website Performance</a>
              </li>
              <li>
                <img src="img/web-security.svg" alt="">
                <a href="#" class="text-xl">Web Security</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
 </section>