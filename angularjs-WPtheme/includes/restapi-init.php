<?php

add_action( 'rest_api_init', 
function () {
        register_rest_route( 'wp/v2', '/posts/(?P<slug>[a-zA-Z0-9-]+)', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'get_posts_by_category_slug',
            'show_in_rest' => true
        )
        );
        register_rest_route( 'wp/v2', '/allsearch', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'get_posts_by_all_postypes',
            'show_in_rest' => true
        )
    );
}

);

/** READ RESTAPI Endpoint by  by Category Slug **/

function get_posts_by_category_slug( $request ) {
$cat = get_category_by_slug( $request['slug'] );
$posts = get_posts( 
    array( 
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category' => $cat->cat_ID
    )
 );
 if ( empty( $posts ) ) {
     return [];
 }

$controller = new WP_REST_Posts_Controller('post');
$return    = array();
foreach ( $posts as $post ) {

    $postcat = get_the_category( $post->ID );

    $cateslug;
    if ( ! empty( $postcat ) ) {
        $cateslug =  esc_html( $postcat[0]->slug );   
    }
    
   $return[] =array(
    
    'ID'        => $post->ID,  
    'cateslug' => $cateslug,
    'title'     => $post->post_title,
    'permalink' => get_permalink( $post->ID ),
    'post_type' => $post->post_type,
    'experct' => $post->post_excerpt,
    'content' => $post->post_content


   ); 
   $response = new WP_REST_Response( $return );
    //$response = $controller->prepare_item_for_response( $post, $request );
    //$data[] = $controller->prepare_response_for_collection( $response );
    $data = $controller->prepare_response_for_collection( $response );
}
return rest_ensure_response( $data );

}






/** Get All Post types Data. */

function get_posts_by_all_postypes( $request ) {
   
    $posts = get_posts( 
        array( 
            'post_type' => array('post','page','speakers','members', 'events'),
            'posts_per_page' => -1,
            
        )
     );
     if ( empty( $posts ) ) {
         return [];
     }
    
    $controller = new WP_REST_Posts_Controller('post');
    $return    = array();
    foreach ( $posts as $post ) {

        $return[] = array(
            'ID'        => $post->ID,
            'title'     => $post->post_title,
            'permalink' => get_permalink( $post->ID ),
            'post_type' => $post->post_type,
            'experct' => $post->post_excerpt
           
            
        );
        $response = new WP_REST_Response( $return );
      //  $response = $controller->prepare_item_for_response(  $return, $request );
      //  $data[] = $controller->prepare_response_for_collection( $response );

      $data = $controller->prepare_response_for_collection( $response );
    }
    return rest_ensure_response( $data );
    
    }



?>
