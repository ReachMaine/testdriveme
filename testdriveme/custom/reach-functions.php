<?php /*
  custom reach functions
*/

function rmm_get_primary_cat() {
  // retunr the primary category  ID if there is one, otherwise the first category ID.
    $primary_cat_id = 0;
    $categorys = get_the_category();
    //echo "<pre>"; var_dump($categorys); echo "</pre>";
    if ($categorys){
      // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
      $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
      $term = get_term( $wpseo_primary_term );
      if (is_wp_error($term)) {
        // Default to first category (not Yoast) if an error is returned
        $primary_cat_id = $categorys[0]->term_id;
      } else {
        $primary_cat_id = $term->term_id;
      }
    }
    else {
      $primary_cat_id = $categorys[0]->term_id;
    }
    return $primary_cat_id;
}


function rmm_primary_cat($useCatLink = true) {
  // SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
  $category = get_the_category();
  $outcat_string = "";
  // If post has a category assigned.
  if ($category){
  	$category_display = '';
  	$category_link = '';
  	if ( class_exists('WPSEO_Primary_Term') )
  	{
  		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
  		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
  		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
  		$term = get_term( $wpseo_primary_term );
  		if (is_wp_error($term)) {
  			// Default to first category (not Yoast) if an error is returned
  			$category_display = $category[0]->name;
  			$category_link = get_category_link( $category[0]->term_id );
  		} else {
  			// Yoast Primary category
  			$category_display = $term->name;
  			$category_link = get_category_link( $term->term_id );
  		}
  	}
  	else {
  		// Default, display the first category in WP's list of assigned categories
  		$category_display = $category[0]->name;
  		$category_link = get_category_link( $category[0]->term_id );
  	}
  	// Display category
  	if ( !empty($category_display) ){
  	    if ( $useCatLink == true && !empty($category_link) ){
          // $outcat_string .= '<div class="rmm-post-cat">';
  		    //$outcat_string .=  '<a href="'.$category_link.'">'.htmlspecialchars($category_display).'</a>';
					$outcat_string .=  '<a href="'.$category_link.'">'.$category_display.'</a>';
  		   //  $outcat_string .=  '</div>';
  	    } else {
          //$outcat_string .=  '<div class="rmm-post-cat">'.$category_display.'</div>';
          $outcat_string .=  $category_display;
  	    }
  	}

  }
  return  $outcat_string;
}
