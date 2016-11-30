<?php
function get_related_posts($post_id) {
	$query = new WP_Query();
    
        $args = '';

	$args = wp_parse_args($args, array(
		'showposts' => -1,
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 0,
                'category__in' => wp_get_post_categories($post_id)
	));
	
	$query = new WP_Query($args);
	
  	return $query;
}

function get_related_projects($post_id) {
    $query = new WP_Query();
    
    $args = '';

    $item_cats = get_the_terms($post_id, 'portfolio_category');
    if($item_cats):
    foreach($item_cats as $item_cat) {
        $item_array[] = $item_cat->term_id;
    }
    endif;

    $args = wp_parse_args($args, array(
        'showposts' => -1,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'id',
                'terms' => $item_array
            )
        )
    ));
    
    $query = new WP_Query($args);
    
    return $query;
}

if(!function_exists('theme_pagination')): 
function theme_pagination($pages = '', $range = 2)
{ 
    global $vcard_data;
    
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination clearfix'>";
         //if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span> First</a>";
         if($paged > 1) echo "<a class='pagination-prev' href='".get_pagenum_link($paged - 1)."'><span class='page-prev'></span>".__('Previous', 'vcard')."</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages) echo "<a class='pagination-next' href='".get_pagenum_link($paged + 1)."'>".__('Next', 'vcard')."<span class='page-next'></span></a>";  
         //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last <span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}
endif;

function string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}

if(!function_exists('vcard_breadcrumb')): 
function vcard_breadcrumb() {
        global $vcard_data,$post;
        echo '<div class="breadcrumbs">';
        
         if ( !is_front_page() ) {
		 
			$breacrumb_prefix = '';
			if (!empty($vcard_data['breacrumb_prefix'])) $breacrumb_prefix = $vcard_data['breacrumb_prefix'];

			echo '<label>'.$breacrumb_prefix.' <a href="';
			echo home_url();
			echo '">'.__('Home','vcard');
			echo " </a></label>";
        }

        $params['link_none'] = '';
        $separator = '';

        if (is_category() && !is_singular('vcard_portfolio')) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<label><span>'.$cat_parents.'</span></label>';
        }

        if(is_singular('vcard_portfolio')) {
            echo get_the_term_list($post->ID, 'portfolio_category', '<label>', '&nbsp;/&nbsp;&nbsp;', '</label>');  
            echo '<label> / <span>'.get_the_title().'</span></label>'; 
        }

        if (is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo '<label> / <span>'.$term->name.'</span></label>';
        }

		$blog_title = '';
		if (!empty($vcard_data['blog_title'])) $blog_title = $vcard_data['blog_title'];
        if(is_home()) { echo '<label> / <span>'.$blog_title.'</span></label>'; }
        if(is_page() && !is_front_page()) {
            $parents = array();
            $parent_id = $post->post_parent;
            while ( $parent_id ) :
                $page = get_page( $parent_id );
                if ( $params["link_none"] )
                    $parents[]  = get_the_title( $page->ID );
                else
                    $parents[]  = '<label>  / <a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></label>' . $separator;
                $parent_id  = $page->post_parent;
            endwhile;
            $parents = array_reverse( $parents );
            echo join( ' ', $parents );
            echo '<label> / <span>'.get_the_title().'</span></label>';
        }
        if(is_single() && !is_singular('vcard_portfolio')) {
            $categories_1 = get_the_category($post->ID);
            if($categories_1):
                foreach($categories_1 as $cat_1):
                    $cat_1_ids[] = $cat_1->term_id;
                endforeach;
                $cat_1_line = implode(',', $cat_1_ids);
            endif;
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<label><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></label>';
                endforeach;
                echo join( ' ', $cats );
            endif;
            echo '<label> / <span>'.get_the_title().'</span></label>';
        }
        if(is_tag()){ echo '<label> / <span>'."Tag: ".single_tag_title('',FALSE).'</span></label>'; }
        if(is_404()){ echo '<label> / <span>'.__("404 - Page not Found", 'vcard').'</label>'; }
        if(is_search()){ echo '<label> / <span>'.__("Search", 'vcard').'</span></label>'; }
        if(is_year()){ echo '<label> / <span>'.get_the_time('Y').'</span></label>'; }

        echo "</div>";
}
endif;

// Custom RSS Link
add_filter('feed_link','bb_feed_link', 1, 2);
function bb_feed_link($output, $feed) {
    global $vcard_data;

    if($vcard_data['rss_link']):
    $feed_url = $vcard_data['rss_link'];

    $feed_array = array('rss' => $feed_url, 'rss2' => $feed_url, 'atom' => $feed_url, 'rdf' => $feed_url, 'comments_rss2' => '');
    $feed_array[$feed] = $feed_url;
    $output = $feed_array[$feed];
    endif;

    return $output;
}

function tf_addURLParameter($url, $paramName, $paramValue) {
     $url_data = parse_url($url);
     if(!isset($url_data["query"]))
         $url_data["query"]="";

     $params = array();
     parse_str($url_data['query'], $params);
     $params[$paramName] = $paramValue;   
     $url_data['query'] = http_build_query($params);
     return tf_build_url($url_data);
}


 function tf_build_url($url_data) {
     $url="";
     if(isset($url_data['host']))
     {
         $url .= $url_data['scheme'] . '://';
         if (isset($url_data['user'])) {
             $url .= $url_data['user'];
                 if (isset($url_data['pass'])) {
                     $url .= ':' . $url_data['pass'];
                 }
             $url .= '@';
         }
         $url .= $url_data['host'];
         if (isset($url_data['port'])) {
             $url .= ':' . $url_data['port'];
         }
     }
     $url .= $url_data['path'];
     if (isset($url_data['query'])) {
         $url .= '?' . $url_data['query'];
     }
     if (isset($url_data['fragment'])) {
         $url .= '#' . $url_data['fragment'];
     }
     return $url;
 }