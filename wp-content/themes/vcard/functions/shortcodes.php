<?php
/*/////////////////////////////////////////////////////////////////
// Remove extra P tags
/////////////////////////////////////////////////////////////////*/
function shortcodes_formatter($content) {
 $block = join("|",array(
            "blockquote",
            "heading",
            "skill",
            "language_skill"
            )
        );

    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

    return $rep;
}
add_filter('the_content', 'shortcodes_formatter');

/*/////////////////////////////////////////////////////////////////
//blockquote
/////////////////////////////////////////////////////////////////*/
add_shortcode('blockquote', 'blockquote');
	function blockquote( $atts, $content = null ) {
    
    $out = '';
    
    $out .= '<blockquote>';
    $out .= do_shortcode($content);
    $out .= '</blockquote>';
	
    return $out;
    
}

/*/////////////////////////////////////////////////////////////////
//heading
/////////////////////////////////////////////////////////////////*/
add_shortcode('heading','heading');
function heading($atts, $cont = null){
    extract(shortcode_atts(array(
        'type'     => '',
    ), $atts));
    $str = '';
    switch(trim(strtolower($type))){
        case 'h1':
            $str .= '<h1>';
            $str .= do_shortcode($cont);
            $str .= '</h1>';
            break;
        case 'h2':
            $str .= '<h2>';
            $str .= do_shortcode($cont);
            $str .= '</h2>';
            break;
        case 'h3':
            $str .= '<h3>';
            $str .= do_shortcode($cont);
            $str .= '</h3>';
            break;
        case 'h4':
            $str .= '<h4>';
            $str .= do_shortcode($cont);
            $str .= '</h4>';
            break;
        case 'h5':
            $str .= '<h5>';
            $str .= do_shortcode($cont);
            $str .= '</h5>';
            break;
    }
    return $str;
}

/*/////////////////////////////////////////////////////////////////
// list
/////////////////////////////////////////////////////////////////*/
add_shortcode('list','list_f');
function list_f($atts, $cont = null){
    $str = '';
    $str .= '<ul>';
    $str .= do_shortcode($cont);
    $str .= '</ul>';
    return $str;
}

add_shortcode('list_item','list_item');
function list_item($atts, $cont = null){
    $str = '';
    $str .= '<li>';
    $str .= do_shortcode($cont);
    $str .= '</li>';
    return $str;
}

/*/////////////////////////////////////////////////////////////////
// Skills
/////////////////////////////////////////////////////////////////*/
add_shortcode('skill','skill');
function skill($atts, $cont = null){
    extract(shortcode_atts(array(
        'percent'     => '',
    ), $atts));
    if(empty($percent)){$percent = 0;}
    if($percent > 100){$percent = 100;}
    if($percent < 0){$percent = 0;}
    $str = '';
    $str .= '<div class="skill-row">';
    $str .= '   <h4 class="skill-title">'. do_shortcode($cont) .'</h4>';
    $str .= '   <div class="skill-data">
                    <span class="skill-percent-line" data-width="'.$percent.'" style="width: '.$percent.'%;"></span> 
                    <span class="skill-percent">'.$percent.'%</span>
                </div>
            </div>';
    
    return $str;
}

/*/////////////////////////////////////////////////////////////////
//Language Skills
/////////////////////////////////////////////////////////////////*/
add_shortcode('language_skill','language_skill');
function language_skill($atts, $cont = null){
    extract(shortcode_atts(array(
        'percent'     => '',
        'flag_url'     => '',
    ), $atts));
    if(empty($percent)){$percent = 0;}
    if($percent > 6){$percent = 6;}
    if($percent < 0){$percent = 0;}
    $str = '';
    $str .= '<aside id="skill-language">
                <div class="skill-row clearfix">
                    <h4 class="skill-title clearfix">';
                    if($flag_url):
                        $str .='<img src="'.$flag_url.'">';
                    endif;  
                        $str .='<span>'. do_shortcode($cont) .'</span>
                    </h4>
                    <div class="skill-data skill'.$percent.'"></div>
                </div>
            </aside>';
    
    return $str;
}

?>