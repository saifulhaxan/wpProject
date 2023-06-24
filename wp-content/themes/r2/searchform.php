<?php
/**
 * The template for the default search.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package R2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <article class="customized panel is-primary">
        <div class="panel-block">
            <div class="control has-icons-left">
                <input id="search-post" class="input is-primary" type="search" name="s" placeholder="Enter your keyword to search">
                <span class="icon is-left">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </span>
                <input type="submit" class="search-submit button button-search is-right" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
                <input type="hidden" value="post" name="post_type" id="post_type" />
            </div>
        </div>
        <div id="suggestedResults" class="panel-block is-hidden"></div>
    </article>
</form>