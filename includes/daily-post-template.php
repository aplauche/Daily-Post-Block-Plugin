<?php


function fsd_daily_post_render_cb($atts){

  $count = $atts["count"];
  $ids = get_transient( 'fsd_daily_post_ids' );

  if(!$ids || !is_array($ids)){
    $ids = fsd_generate_daily_post($count);
  }

  if(count($ids) !== $count ){
    $ids = fsd_generate_daily_post($count);
  }

  ob_start(); ?>

  <?php foreach( $ids as $id): ?>
    <div class="wp-block-udemy-plus-daily-post">
      <h6><?php echo $title ?></h6>
      <a href="<?php the_permalink( $id ); ?>">
        <img src="<?php echo get_the_post_thumbnail_url( $id, 'full' ); ?>" alt="">
        <h3><?php echo get_the_title($id) ?></h3>
      </a>
    </div>
  <?php endforeach;?>

  <?php return ob_get_clean();
}