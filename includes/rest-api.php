<?php

add_action('rest_api_init', 'fsd_rest_api_init');

function fsd_rest_api_init(){
  register_rest_route( 'fsd/v1', '/daily-post', array(
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'fsd_rest_daily_post_handler',
    'permission_callback' => '__return_true'
  ), false );
}

function fsd_rest_daily_post_handler(){
  $response = [
    "url" => "",
    "title" => "",
    "img" => "",
  ];

  $id = get_transient( 'fsd_daily_post_id' );

  if(!$id){
    $id = fsd_generate_daily_post();
  }

  $response["url"] = get_permalink( $id );
  $response["title"] = get_the_title( $id );
  $response["img"] = get_the_post_thumbnail_url( $id, 'full' );

  return $response;
}