<?php 

function ids_slider(){
return "<div du-parallax y='background' ><div slideshow class='cycle-slideshow' ></div></div>";

}

add_shortcode('ids-slide','ids_slider');
//do_shortcode( '[ids-parralax]' );
function companycr_sc($content){
    $datastr =     get_bloginfo( 'name' ).  "©"  .   date('Y');
    $content = "<span class='copy-right-style' ><p>". $datastr ."</p></span>";
    return $content;  

}

add_shortcode('companycr','companycr_sc');
//do_shortcode( '[companycr]' );




function addscriptcf7($atts, $content){
    extract( shortcode_atts(
        array(
                'src' => 'file'
        ),
        $atts
));
    $scripttag = "<script type='text/javascript' src='".$src."' ></script>";
    
    return $scripttag;

}

add_shortcode('cf7-js','addscriptcf7');



function companyname_sc($content){
    $datastr =     get_bloginfo( 'name' );
    $content = "<h1 class='company-name' >". $datastr ."</h1>";
    return $content;  

}

add_shortcode('company-name','companyname_sc');



function toolbartag_func(  ) {
	return "<div class='toolbar-container' >
    <div class='btn-toolbar dark-blue-sea' toolbar-tip='{content: '#toolbar-options', position: 'right}' id='format-toolbar'>
        <i class='fa fa-cog'></i>
    </div>
    <div id='toolbar-options' class='glass-white green-sea-color'>
    <a href='#'><i class='fa fa-money'></i></a> 
    <a href='#'><i class='fa fa-user'></i></a>
    <a  href='#'><i class='fa fa-book'></i></a>
    <a  href='#'><i class='fa fa-envelope'></i></a>
    <a  href='#'><i class='fa fa-calendar'></i></a>
    </div>
</div>";
}


add_shortcode('toolbar','toolbartag_func');
//do_shortcode( '[toolbar]' );




function coming_events()
{
   global $post;

   
    $todaysDate = date('m/d/Y H:i:s');
    
    $posts=null;
    $args = array(
        'post_type'         => 'events',
        'posts_per_page'    => -1,
        'meta_key'          => 'ids_event_date',
        'meta_value'        => date( "Y-m-d h:i:s" ), 
        'meta_compare'      => '>',
        'orderby'           => 'meta_value',
        'order'             => 'ASC'
       
    );
    

    $posts = get_posts($args); 

    $return = array();
    
    $content = "<div class='event-section animated' ><h3 class='page-title green-sea light-grey-color'>Our Events</h3><ul class='event-list'>";
    foreach ( $posts as $post ) {
        setup_postdata($post);
      
       //echo $post->post_title;
       $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));
       $eventDate = get_post_meta($post->ID, 'ids_event_date');
       $content .= "<li class='event-list-box' ><a href='".get_permalink( $post->ID )."'><img src='". $src[0] ."'><div class='overlay green-sea' ><h3 class='date light-grey-color' >".$post->post_title."</h3><span class='title light-grey-color' >".$eventDate[0]."</span></div></a><div class='clear-f'></div></li>";
        
    }
    $content .= "</ul></div>";
   return $content;
    
    wp_reset_postdata();
    

}


add_shortcode('coming-eventlist', 'coming_events');





function row_fluid($atts, $content, $tag){
   
    

return '<div class="row-fluid" >'.do_shortcode($content).'</div>';

}

add_shortcode('row-fluid', 'row_fluid');





add_shortcode( 'card-box', 'card_box_shortcode' );

function card_box_shortcode( $atts ) {
      extract( shortcode_atts(
              array(
                      'title' => 'Title',
                      'subtitle' => 'subtitle',
                      'url' => '',
                      'iconclass' => '',
                      'shortdescription' => ''
              ),
              $atts
      ));
      return '<div class="span3 ghost-white">
      <section class="animated" >
      <div class="service-box ">
      <div class="extrabox">
      <figure class="icon"><i class="'.$iconclass.'"></i></figure>
      </div>
      <div class="service-box_body"><h2 class="title"><a href="'.$url.'" title="'.$title.'" target="_self">'.$title.'</a></h2>
      <h5 class="sub-title">'.$subtitle.'</h5>
      <div class="service-box_txt">'.$shortdescription.'</div>
      <div class="btn-align"><a href="'.$url.'" title="More info" class="button" target="_self">More info</a></div>
      </div>
      </div><!-- /Service Box -->
      </section>
      </div>';
}


add_shortcode('page-section','pagesection');

function pagesection($atts, $content)
{

    extract( shortcode_atts(
        array(
                'class' => 'page',
                'title' => 'page tile',
                'titleclass' => '',
                'shortdescription' => ''
        ),
        $atts
    ));
    return "<section class='".$class."'><h3 class='".$titleclass."'>".$title."</h3><div class='page-content'>".$shortdescription."</div>".do_shortcode($content)."</section>";   

}

add_shortcode('list-container','listcontainer');

function listcontainer($atts, $content)
{

    extract( shortcode_atts(
        array(  'classContainer' => 'partner-list'  ),
        $atts
    ));
    return "<ul class='".$classContainer."'>".do_shortcode($content)."</ul>";   
}


function list_li( $atts ) {

    extract( shortcode_atts(
        array(  
            'class' => '',
            'itemtitle' => '',
            'itemurl' => '#',
            'itemimgsrc' => '',
            'overlayclass' => '',
            'titleclass' => ''
          ),
        $atts
    ));

    
    
    return "<li class='".$class."' ><a href='".$itemurl."' ><img src='".$itemimgsrc."' alt='".$itemtitle."' ><div class='".$overlayclass."' ><h3 class='".$titleclass."' >".$itemtitle."</h3></div></a></li>";

    }

add_shortcode('lithumb', 'list_li');



function register_shortdodes(){ 
   
    do_shortcode('coming-eventlist');
    do_shortcode('list-container');
    do_shortcode('lithumb');
    do_shortcode('page-section');
    do_shortcode('row-fluid');
    do_shortcode('card-box');
    do_shortcode('[su_tabs style="default" active="1" vertical="no" class=""]
[su_tab title="Bio" disabled="no" anchor="" url="" target="blank" class=""]Bio Content[/su_tab]
[su_tab title="Info" disabled="no" anchor="" url="" target="blank" class=""Information[/su_tab]
[su_tab title="Contacts" disabled="no" anchor="" url="" target="blank" class=""]Contact Info[/su_tab]
[/su_tabs]'); 
do_shortcode('[smartslider3 slider=1]');
   
}

add_action('init','register_shortdodes');





?>