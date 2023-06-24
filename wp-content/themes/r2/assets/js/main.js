var accordions = bulmaAccordion.attach();
jQuery(document).on('ready', function() {
  init_multiple_posts_slides();
  function init_multiple_posts_slides() {
    jQuery('.multiple-posts-slides').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      centerMode: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            infinite: true,
            arrows: true,
            centerMode: false,
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            infinite: true,
            arrows: true,
            centerMode: false,
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }
jQuery('.video-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows:true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows:false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows:false,
            }
          }
        ]
      });
      jQuery(".buton-toc-red").on("click", function() { $(".right").toggleClass("hide-now")
  });

  jQuery(document).on("click", "a.filter-post", function () {
      jQuery('ul.r2-cat-list li').removeClass('is-active');
      jQuery(this).parent().addClass('is-active');
      var cat_id = jQuery(this).attr("data-cat-id");
      jQuery.ajax({
        type: "POST",
        async: true,
        data: { action: "r2_filter_posts", filter_cat_id:cat_id, nonce: r2_ajax.nonce},
        url : r2_ajax.ajaxurl,
        dataType: "json",
        success: function (data) {
          console.log('message',data.message);
          //jQuery("#ajaxloader").hide();          
          if(data.success) {
            
            jQuery('#r2-filtered-posts-sec').html(data.html_markup);					
            init_multiple_posts_slides();
          }
        },
        error: function (err)
          { alert(err.responseText);}
      });
  });

  //Stop Video on slick nav change
  jQuery(".video-slides").on("beforeChange", function(event, slick) {
    var currentSlide, slideType, player, command;
    
    //find the current slide element and decide which player API we need to use.
    currentSlide = jQuery(slick.$slider).find(".slick-current");
    
    //determine which type of slide this, via a class on the slide container. This reads the second class, you could change this to get a data attribute or something similar if you don't want to use classes.
    slideType = currentSlide.attr("class").split(" ")[1];
    
    //get the iframe inside this slide.
    player = currentSlide.find("iframe").get(0);
    
    if (slideType == "vimeo") {
      command = {
        "method": "pause",
        "value": "true"
      };
    } else {
      command = {
        "event": "command",
        "func": "pauseVideo"
      };
    }
    
    //check if the player exists.
    if (player != undefined) {
      //post our command to the iframe.
      player.contentWindow.postMessage(JSON.stringify(command), "*");
    }
  });

  // Initialize the Autocomplete widget
  jQuery('#search-post').autocomplete({
    source: function(request, response) {
        jQuery.ajax({
            url: r2_ajax.ajaxurl,
            dataType: 'json',
            type: "POST",
             async: true,
            data: {
                action: 'r2_auto_complete_search',
                nonce: r2_ajax.nonce,
                query: request.term
            },
            success: function(data) {
              console.log('message', data.message);
              //jQuery("#ajaxloader").hide();          
              if(data.success) {
                jQuery('#suggestedResults').removeClass('is-hidden');
                jQuery('#suggestedResults').html(data.html_markup);					
              }
            }
        });
    },
    minLength: 2 // Minimum characters to trigger the search
  });

  jQuery('#search-post').on("blur","input",function(){
    jQuery('#suggestedResults').addClass('is-hidden');
    jQuery('#suggestedResults').html('');	
  });
  jQuery(document).on("focusout","#search-post",function(){
    jQuery('#suggestedResults').addClass('is-hidden');
    jQuery('#suggestedResults').html('');	
});
});