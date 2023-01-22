<?php

add_action('rest_api_init', 'fsd_rest_api_init');

function fsd_rest_api_init(){
  register_rest_route( 'fsd/v1', '/daily-post', array(
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'fsd_rest_daily_post_handler',
    'permission_callback' => '__return_true'
  ), false );
}

function fsd_rest_daily_post_handler($request){
  $count =  intval($request->get_param('count'));

  $response = [];

  $ids = get_transient( 'fsd_daily_post_ids' );

  if(!$ids || !is_array($ids)){
    $ids = fsd_generate_daily_post($count);
  } 


  if(count($ids) !== $count ){
    $ids = fsd_generate_daily_post($count);
  }

  foreach($ids as $id){
    $post = [];
    $post["url"] = get_permalink( $id );
    $post["title"] = get_the_title( $id );
    $post["img"] = get_the_post_thumbnail_url( $id, 'full' );

    array_push($response, $post);
  }



  return $response;
}