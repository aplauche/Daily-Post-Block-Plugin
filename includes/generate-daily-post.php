<?php

function fsd_generate_daily_post($count){

  $posts = new WP_Query(array(
    "posts_per_page" => $count,
    "status" => "publish",
    "post_type" => "post",
    "orderby" => "rand"
  ));

  $post_ids = [];

  if($posts->have_posts()):
    while($posts->have_posts(  )): $posts->the_post();

      array_push($post_ids, get_the_ID());

    endwhile;
  endif; wp_reset_postdata(  );

  $transient_value = $post_ids;

  set_transient( 'fsd_daily_post_ids', $transient_value, DAY_IN_SECONDS);

  return $transient_value;
}