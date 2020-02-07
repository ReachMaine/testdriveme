<?php /* divi */
// add do_shortcode to footer credits
if ( ! function_exists( 'et_get_footer_credits' ) ) {
  function et_get_footer_credits() {
  	$original_footer_credits = et_get_original_footer_credits();

  	$disable_custom_credits = et_get_option( 'disable_custom_footer_credits', false );

  	if ( $disable_custom_credits ) {
  		return '';
  	}

  	$credits_format = '<%2$s id="footer-info">%1$s</%2$s>';

  	$footer_credits = et_get_option( 'custom_footer_credits', '' );

  	if ( '' === trim( $footer_credits ) ) {
  		return et_get_safe_localization( sprintf( $credits_format, $original_footer_credits, 'p' ) );
  	}
    $footer_credits = do_shortcode($footer_credits);
  	return et_get_safe_localization( sprintf( $credits_format, $footer_credits, 'div' ) );
  }
}
/// blog functions
add_action('et_before_post', 'reach_blog_top');
function reach_blog_top() {
  echo do_shortcode('[et_pb_section global_module="265"][/et_pb_section]'); // the hero image...
  echo '<div class="tdm_sponser_header_wrap"><h1 class="et_pb_module_header tdm_sponsor">This review sponsored by: ';
    //the_category(" ");
  echo rmm_primary_cat(false);
  echo '</h1></div>';
}


add_action('et_after_post', 'reach_blog_footer');
function reach_blog_footer () {
  echo do_shortcode('[et_pb_section global_module="295"][/et_pb_section]');
  echo '<div class="tdm_sponser_footerr_wrap"><div class="tdm_sponsor_desc">';
  $catID = get_the_category();
  echo category_description( $catID[0] );
  echo '</div></div>';
}
