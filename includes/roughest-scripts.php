<?php
/* RoughEst - Instant Estimate Calculator / Built By Inland Applications */
  // Add Scripts
  function roughest_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('roughest-main-style', plugins_url('/css/style.css', __FILE__));
    // Add Main JS
    wp_enqueue_script('roughest-main-script', plugins_url('/js/main.js', __FILE__) );

  }

  add_action('wp_enqueue_scripts', 'roughest_add_scripts');