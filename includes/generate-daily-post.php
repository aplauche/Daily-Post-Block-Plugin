<?php

function fsd_generate_daily_post(){

  global  $wpdb;

  $id = $wpdb->get_var(
    "SELECT ID FROM {$wpdb->posts}
    WHERE post_status='publish' AND post_type='post'
    ORDER BY rand() LIMIT 1"
  );

  set_transient( 'fsd_daily_post_id', $id, DAY_IN_SECONDS);

  return $id;
}