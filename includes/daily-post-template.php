<?php


function fsd_daily_post_render_cb(){

  $id = get_transient( 'fsd_daily_post_id' );

  if(!$id){
    $id = fsd_generate_daily_post();
  }

  ob_start(); ?>

  <div class="wp-block-udemy-plus-daily-post">
    <h6><?php echo $title ?></h6>
    <a href="<?php the_permalink( $id ); ?>">
      <img src="<?php echo get_the_post_thumbnail_url( $id, 'full' ); ?>" alt="">
      <h3><?php echo get_the_title($id) ?></h3>
    </a>
  </div>

  <?php return ob_get_clean();
}