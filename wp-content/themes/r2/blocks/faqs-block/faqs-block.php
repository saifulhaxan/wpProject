<?php
/**
 * FAQs Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.

$faqs_block = get_field('faqs_block');

?>
<section class="sixth-one">
      <div class="container is-fullhd">
        <div class="columns is-mobile">
          <div class="column">
            <div class="accordions">
              <?php 
                if($faqs_block){
                  $faq_inc = 1;
                  
                    foreach($faqs_block as $index => $faq){ 
                      $class = "";
                      if($faq_inc == 1 ){ $class = "is-active";}
                      echo'<div class="accordion '.$class.'">
                            <div class="accordion-header toggle">
                              <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                              <button class="toggle" aria-label="toggle"></button>
                            </div>
                            <div class="accordion-body">
                              <div class="accordion-content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
                              </div>
                            </div>
                          </div>';
                      $faq_inc++;
                    }
                }else{

                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>