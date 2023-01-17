<?php
/**
 * Plugin Name:       FSD Daily Post
 * Plugin URI:        https://fullstackdigital.io
 * Description:       A daily featured post block.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            FSD
 * Text Domain:       fsd
 */

if(!function_exists('add_action')) {
  echo 'Hmmm... Nothing to see here...';
  exit;
}

// Setup
define('FSD_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Includes
$rootFiles = glob(FSD_PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob(FSD_PLUGIN_DIR . 'includes/**/*.php');
$allFiles = array_merge($rootFiles, $subdirectoryFiles);

foreach($allFiles as $filename) {
  include_once($filename);
}