<?php
namespace VoteForBernie\Wordpress\Assets;

function assets() {
  wp_enqueue_script('vfb_vendor_js', get_template_directory_uri() . '/dist/vendor.js', array('jquery'), null, true);
  wp_enqueue_script('vfb_site_js', get_template_directory_uri() . '/dist/site.js', array('vfb_vendor'), null, true);
  wp_enqueue_style('vfb_vendor_css', get_template_directory_uri() . '/dist/vendor.css');
  wp_enqueue_style('vfb_site_css', get_template_directory_uri() . '/dist/style.css');
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
